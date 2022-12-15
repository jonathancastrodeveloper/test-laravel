<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// agregamos la clase para el debug con los logs
use Illuminate\Support\Facades\Log;

// creamos un trait para los response
use App\Traits\ApiResponser;

// se agrega el modelo
use App\Models\User;

use App\Interface\UserInterface;


class UserController extends Controller implements UserInterface
{

    use ApiResponser;

    // seteamos el valor del token manualmente, ya que esto es un ejercicio y el valor no cambia
    protected $token_val = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9eyJ0ZXN0IjozMjE0MTIsInVzZXIiOiJmM3IyIn0NcPLPRLSvfszQwtxZLyypsm3Y56ELRdppqYXDv2Hagk';   

    protected $msg_error;
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, $token)
    {

        if ($this->token_val == $token ) {


           $users = $user::orderBy('created_at', 'DESC')->get();            

           return $this->successResponse($users);

       }else{           

           return $this->unauthorizedResponse($this->getErrorMsg());
       }

   }

    /**
     * Display user transaction (Hacemos uso de la inyeccion de dependencias).
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction(User $user, $token, $id)
    {

       if ($this->token_val == $token ) {           

        $transactions = $user::with('transactions')->findOrFail($id);


        Log::debug($transactions);

        return $this->successResponse($transactions);

    }else{


       return $this->unauthorizedResponse($this->getErrorMsg());
   }


}


/**
     * Display error message (Hacemos uso de las interfaces del ejercicio).
     *
     * @return string
     */
public function getErrorMsg(): string
{
    $this->msg_error = 'Token incorrecto';

    return $this->msg_error;

}  


}

<?php

namespace App\Traits;

trait ApiResponser
{

	private function successResponse($data)
	{
		return response()->json($data);
	}

	private function unauthorizedResponse($message, $code = 401)
	{		

		return response()->json($message,$code);
	}
	
}
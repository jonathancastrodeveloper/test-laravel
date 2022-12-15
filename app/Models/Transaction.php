<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

	// public $timestamps = true;

	protected $fillable = [	
		'transaction',
		'user_id',			
	];

	//ManyToOne
	public function users()
	{
		return $this->belongsTo(User::class);
	}
}

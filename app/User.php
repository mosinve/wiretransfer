<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property float balance
 */
class User extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $casts = ['balance' => 'float'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $visible = ['id', 'name', 'email', 'balance'];

    public function outgoingTransactions(){
    	return $this->hasMany(Transaction::class, 'from_user', 'id');
    }

	public function incomingTransactions(){
		return $this->hasMany(Transaction::class, 'to_user', 'id');
	}
}

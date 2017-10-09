<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['from_user', 'to_user', 'sum', 'approved', 'completed', 'pincode'];

	public function fromUser(){
		return $this->belongsTo(User::class, 'from_user','id');
	}

	public function toUser(){
		return $this->belongsTo(User::class, 'to_user','id');
	}

	public function scopeNotFinished($query){
		return $query->where('completed', 0);
	}

	public function scopeNotApproved($query){
	    return $query->where('approved', 0);
    }
}

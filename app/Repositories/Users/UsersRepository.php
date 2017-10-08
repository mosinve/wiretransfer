<?php
	/**
	 * Created by PhpStorm.
	 * User: MosinVE
	 * Date: 09.10.2017
	 * Time: 1:06
	 */

	namespace App\Repositories\Users;


	use App\User;

	class UsersRepository implements UsersRepositoryInterface {

		public function getBalance(User $user)
		{
			return $user->balance;
		}

		public function changeBalance(User $user,$sum)
		{
			$user->balance += $sum;
			$user->save();
		}

		public function getByID($id){
			return User::all()->where('id', $id)->first();
		}
	}
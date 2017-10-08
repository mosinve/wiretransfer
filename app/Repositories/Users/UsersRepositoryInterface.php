<?php
	/**
	 * Created by PhpStorm.
	 * User: MosinVE
	 * Date: 09.10.2017
	 * Time: 1:07
	 */

	namespace App\Repositories\Users;


	use App\User;

	interface UsersRepositoryInterface {

		public function getBalance( User $user );

		public function changeBalance( User $user, $sum );

		public function getByID( $id );
	}
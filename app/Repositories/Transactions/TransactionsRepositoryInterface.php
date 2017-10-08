<?php
	/**
	 * Created by PhpStorm.
	 * User: MosinVE
	 * Date: 09.10.2017
	 * Time: 0:09
	 */

	namespace App\Repositories\Transactions;


	use App\Transaction;
	use App\User;

	interface TransactionsRepositoryInterface {

		/**
		 * @param Transaction $transaction
		 *
		 */
		public function ExecuteTransaction(Transaction $transaction);

		/**
		 * @param Transaction $transaction
		 *
		 */
		public function ConfirmTransaction(Transaction $transaction);

		/**
		 * @param User $from_user
		 * @param User $to_user
		 * @param $sum
		 * @param $approved boolean
		 *
		 * @return Transaction
		 */
		public function CreateTransaction( User $from_user, User $to_user, $sum, $approved = false );
	}
<?php
	/**
	 * Created by PhpStorm.
	 * User: MosinVE
	 * Date: 09.10.2017
	 * Time: 0:15
	 */

	namespace App\Repositories\Transactions;

	use App\Transaction;
	use App\User;
	use Illuminate\Support\Facades\Log;

	class TransactionsRepository implements TransactionsRepositoryInterface {

		public function getAll(){
			return Transaction::notFinished()->get();
		}
		/**
		 * @param User $from_user
		 * @param User $to_user
		 * @param $sum
		 * @param $approved boolean
		 *
		 * @return Transaction
		 */
		public function CreateTransaction( User $from_user, User $to_user, $sum, $approved = false ) {
			$transaction = new Transaction();
			$transaction->from_user = $from_user->id;
			$transaction->to_user = $to_user->id;
			$transaction->sum = $sum;
			$transaction->pincode = str_random(10);
			$transaction->approved = $approved;
			$transaction->save();
			return $transaction;
		}

		/**
		 * @param Transaction $transaction
		 *
		 */
		public function ExecuteTransaction( Transaction $transaction ) {
			if ($transaction->completed) return;

			$transaction->fromUser->balance -= $transaction->sum;
			$transaction->fromUser->save();
			$transaction->toUser->balance += $transaction->sum;
			$transaction->toUser->save();
			$transaction->completed = true;
			$transaction->save();
			Log::info("Transferred $transaction->sum from ".$transaction->fromUser->name." to ".$transaction->toUser->name);
		}

		/**
		 * @param Transaction $transaction
		 * @return boolean
		 */
		public function ConfirmTransaction( Transaction $transaction ) {
			if ($transaction->approved) return false;
			$transaction->approved = true;
			$transaction->pincode = '';
			$transaction->save();
			return true;
		}

		public function getByToken($token){
			return Transaction::all()->where('pincode', $token)->first();
		}
	}
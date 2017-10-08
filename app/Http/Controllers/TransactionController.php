<?php

namespace App\Http\Controllers;

use App\Exceptions\TransferConfirmException;
use App\Jobs\ExecuteTransaction;
use App\Repositories\Transactions\TransactionsRepository;

class TransactionController extends Controller
{
	protected $transactions_repository;

	public function __construct(TransactionsRepository $transactions_repository) {
		$this->transactions_repository = $transactions_repository;
	}

	public function verify($token){
		$transaction = $this->transactions_repository->getByToken($token);
		throw_unless($transaction, TransferConfirmException::class);
		$this->transactions_repository->ConfirmTransaction($transaction);
		ExecuteTransaction::dispatch($transaction);
		return response()->view('confirm_success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exceptions\TransferConfirmException;
use App\Jobs\ExecuteTransaction;
use App\Repositories\Transactions\TransactionsRepository;

class TransactionController extends Controller
{
	protected $transactionsRepository;

	public function __construct(TransactionsRepository $transactionsRepository) {
		$this->transactionsRepository = $transactionsRepository;
	}

	public function verify($token){
		$transaction = $this->transactionsRepository->getByToken($token);
		throw_unless($transaction, TransferConfirmException::class);
		$this->transactionsRepository->ConfirmTransaction($transaction);
		ExecuteTransaction::dispatch($transaction);
		return view('confirm_success');
    }
}

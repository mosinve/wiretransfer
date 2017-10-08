<?php

namespace App\Jobs;

use App\Repositories\Transactions\TransactionsRepository;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExecuteTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;

    /**
     * Create a new job instance.
     * @param $transaction Transaction
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @param $transactions_repository TransactionsRepository
     * @return void
     */
    public function handle(TransactionsRepository $transactions_repository)
    {
	    if ($this->transaction->completed) return;

    	$transactions_repository->ExecuteTransaction($this->transaction);
    }
}

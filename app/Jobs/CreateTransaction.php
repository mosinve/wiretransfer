<?php

namespace App\Jobs;

use App\Repositories\Transactions\TransactionsRepository;
use App\Repositories\Transactions\TransactionsRepositoryInterface;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $user_from;
	protected $user_to;
	protected $sum;
	protected $approved;

    /**
     * Create a new job instance.
     *
     * @param $user_from User
     * @param $user_to User
     * @param $sum float
     */
    public function __construct(User $user_from, User $user_to, $sum, $approved)
    {
    	$this->user_from = $user_from;
    	$this->user_to = $user_to;
    	$this->sum = $sum;
    	$this->approved = $approved;
    }

    /**
     * Execute the job.
     * @param $transactions_repository TransactionsRepository
     */
    public function handle(TransactionsRepository $transactionsRepository)
    {
    	$transaction = $transactionsRepository->CreateTransaction($this->user_from, $this->user_to, $this->sum, $this->approved);
    	SendVerificationEmails::dispatch($transaction);
    }
}

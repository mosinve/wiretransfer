<?php

namespace App\Console\Commands;

use App\Jobs\CreateTransaction;
use App\Jobs\ExecuteTransaction;
use App\Repositories\Transactions\TransactionsRepository;
use App\Repositories\Users\UsersRepository;
use Illuminate\Console\Command;

class TransferBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:transfer 
                            {--sum= : Amount to transfer} 
                            {--from= : User to transfer from} 
                            {--to= : User to transfer to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfers specified sum between users';

    protected $transactionsRepository;

    protected $usersRepository;
    /**
     * Create a new command instance.
     *
     * @param $transactions_repository TransactionsRepository
     *
     */
    public function __construct(TransactionsRepository $transactionsRepository, UsersRepository $usersRepository)
    {
    	$this->transactions_repository = $transactionsRepository;
    	$this->users_repository = $usersRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $user_from = $this->option('from');
        $user_to = $this->option('to');
        $sum = $this->option('sum');

        CreateTransaction::dispatch($this->usersRepository->getByID($user_from), $this->usersRepository->getByID($user_to), $sum, true);
        $this->transactionsRepository->getAll()->each(function ($transaction){
        	ExecuteTransaction::dispatch($transaction);
        });
    }
}

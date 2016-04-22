<?php

namespace Noah\Console\Commands\Make;

use Noah\User;
use Illuminate\Console\Command;

class MakeAdminCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {username : The username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quickly create an admin account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::createAdmin([
            'username' => $this->argument('username'),
            'name'     => $this->argument('username'),
            'email'    => $this->ask('Enter the email'),
            'password' => bcrypt($this->ask('Type in the password to complete, 3 characters minimum'))
        ]);
        
        if ($user) {
            $this->info('User successfully created, Username: ' . $user->username);
        }
    }
}

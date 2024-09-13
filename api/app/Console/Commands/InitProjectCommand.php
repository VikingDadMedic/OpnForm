<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class InitProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the default admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if the application is in self-hosted mode
        if (!config('app.self_hosted')) {
            // If not, display an error message and stop the command
            $this->error('This command can only be run in self-hosted mode.');
            return;
        }

        // Check if there are any existing users or if the ID increment is not at 0
        if (User::max('id') !== null) {
            // If there are existing users, display an error message and stop the command
            $this->error('Users already exist in the database or the User table is not empty. Aborting initialization.');
            return;
        }

        // Create a new user with default admin credentials
        User::create([
            'name' => 'Admin',
            'email' => 'admin@opnform.com',
            'password' => bcrypt('password'),
        ]);

        // Display a success message with the default admin credentials
        $this->info('Admin user created with default credentials: admin@opnform.com / password');
        return 0;
    }
}

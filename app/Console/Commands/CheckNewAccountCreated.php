<?php

namespace App\Console\Commands;

use App\Mail\NewUserRegistered;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckNewAccountCreated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newuser:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check newly created accounts';

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
     * @return int
     */
    public function handle()
    {
        $users = User::where(['isAuthorised'=>0])->whereNotNull('email_verified_at')->get();
        $role = RoleUser::where(['roleId'=>1])->pluck('userId');
        $admins = User::whereIn('id',$role)->pluck('email');
        foreach($users as $user )
        {
            Mail::to($admins)->queue(new NewUserRegistered($user));
    
        }
    }
}

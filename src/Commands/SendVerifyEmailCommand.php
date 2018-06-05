<?php

namespace Alpaca\Commands;

use Alpaca\Models\User;
use Alpaca\Notifications\VerifyAccount;
use Alpaca\Repositories\UserRepository;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;

class SendVerifyEmailCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'alpaca:user:send_verify_email';

    /**
     * @var string
     */
    protected $description = 'Send to users who are not verified a verify email';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('get users...');

        $users = User::where('verified', 0)->get();

        $this->comment('how users must verified: ' . $users->count());


        $repo = new UserRepository();

        $users->each(function ($user, $key) use ($repo) {

            // generate new token
            $token = $repo->generateVerifyToken($user);

            // send mail
            Notification::send($user, new VerifyAccount($token, $user->name));

        });


        $this->info('... done');
    }

}

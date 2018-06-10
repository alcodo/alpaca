<?php

namespace Alpaca\Commands;

use Alpaca\Models\User;
use Alpaca\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUnverifyUsersCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'alpaca:user:delete_unverify_users';

    /**
     * @var string
     */
    protected $description = 'Users who unverifoed delete';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('get users...');

        $users = User::where('verified', 0)
            ->where('created_at', Carbon::now()->subWeeks(3))
            ->get();

        $this->comment('how users are unverified: ' . $users->count());


        $repo = new UserRepository();

        $users->each(function ($user, $key) use ($repo) {

            $repo->delete($user);

        });


        $this->info('... done');
    }

}

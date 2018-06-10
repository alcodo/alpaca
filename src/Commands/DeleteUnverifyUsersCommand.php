<?php

namespace Alpaca\Commands;

use Carbon\Carbon;
use Alpaca\Models\User;
use Illuminate\Console\Command;
use Alpaca\Repositories\UserRepository;

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
        $this->info('all users: '.User::count());
        $this->info('unverified users: '.User::where('verified', 0)->count());

        $users = User::where('verified', 0)
            ->where('created_at', '<', Carbon::now()->subWeeks(3))
            ->get();

        $this->comment('unverified users (older than 3 weeks): '.$users->count());

        $repo = new UserRepository();

        $users->each(function ($user, $key) use ($repo) {
            $repo->delete($user);
        });

        $this->info('... done');
    }
}

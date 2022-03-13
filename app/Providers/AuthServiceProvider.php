<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Poll;
use App\Models\Vote;

use function PHPUnit\Framework\returnSelf;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('manage-poll', function (User $user) {
            return $user->role == 'admin';
        });
        Gate::define('vote-poll', function (User $user, Poll $poll) {
            if ($user->role == 'admin') return false;
            if (Vote::where('user_id', $user->id)->where('poll_id', $poll->id)->exists()) return false;

            return true;
        });
    }
}

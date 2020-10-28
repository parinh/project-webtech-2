<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('create-post',function ($authUser){ //กำหนดสิทให้ user สามารถสร้างโพสได้ ตามเงื่อนไข
            return $authUser->isAdmin() or $authUser->isCreator();

        });

        Gate::define('update-post',function ($authUser, $post){ //เช็ค user id ให้แก้ไขได้แค่โพสตัวเอง
           return $authUser->id === $post->user_id ;
        });

        //
    }
}

<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Form;
use App\Models\Resource;
use App\Policies\FormPol;
use App\Policies\ResourcePol;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Form::class => FormPol::class,
        Resource::class => ResourcePol::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

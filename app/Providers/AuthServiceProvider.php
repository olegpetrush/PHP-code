<?php

namespace App\Providers;

use App\Policies\EffectPolicy;
use App\Policies\FoodPolicy;
use App\Policies\NutrientLimitPolicy;
use App\Policies\NutrientPolicy;
use App\Policies\NutrientRdaPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-any-food', (FoodPolicy::class).'@viewAny');
        Gate::define('view-food', (FoodPolicy::class).'@view');
        Gate::define('create-food', (FoodPolicy::class).'@create');
        Gate::define('delete-food', (FoodPolicy::class).'@delete');
        Gate::define('update-food', (FoodPolicy::class).'@update');

        Gate::define('view-any-product', (ProductPolicy::class).'@viewAny');
        Gate::define('view-product', (ProductPolicy::class).'@view');
        Gate::define('create-product', (ProductPolicy::class).'@create');
        Gate::define('delete-product', (ProductPolicy::class).'@delete');
        Gate::define('update-product', (ProductPolicy::class).'@update');

        Gate::define('view-any-effect', (EffectPolicy::class).'@viewAny');
        Gate::define('view-effect', (EffectPolicy::class).'@view');
        Gate::define('create-effect', (EffectPolicy::class).'@create');
        Gate::define('delete-effect', (EffectPolicy::class).'@delete');
        Gate::define('update-effect', (EffectPolicy::class).'@update');

        Gate::define('view-any-nutrient', (NutrientPolicy::class).'@viewAny');
        Gate::define('view-nutrient', (NutrientPolicy::class).'@view');
        Gate::define('create-nutrient', (NutrientPolicy::class).'@create');
        Gate::define('delete-nutrient', (NutrientPolicy::class).'@delete');
        Gate::define('update-nutrient', (NutrientPolicy::class).'@update');

        Gate::define('view-any-nutrient-limit', (NutrientLimitPolicy::class).'@viewAny');
        Gate::define('view-nutrient-limit', (NutrientLimitPolicy::class).'@view');
        Gate::define('create-nutrient-limit', (NutrientLimitPolicy::class).'@create');
        Gate::define('delete-nutrient-limit', (NutrientLimitPolicy::class).'@delete');
        Gate::define('update-nutrient-limit', (NutrientLimitPolicy::class).'@update');

        Gate::define('view-any-nutrient-rda', (NutrientRdaPolicy::class).'@viewAny');
        Gate::define('view-nutrient-rda', (NutrientRdaPolicy::class).'@view');
        Gate::define('create-nutrient-rda', (NutrientRdaPolicy::class).'@create');
        Gate::define('delete-nutrient-rda', (NutrientRdaPolicy::class).'@delete');
        Gate::define('update-nutrient-rda', (NutrientRdaPolicy::class).'@update');

    }
}

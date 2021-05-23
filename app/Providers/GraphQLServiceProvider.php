<?php

namespace App\Providers;

use App\Enums\BloodType;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;
use Nuwave\Lighthouse\Schema\Types\LaravelEnumType;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(TypeRegistry $typeRegistry)
    {
        $typeRegistry->register(
            new LaravelEnumType(BloodType::class)
        );
    }
}

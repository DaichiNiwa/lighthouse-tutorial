<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersBetweenResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Builder
    {
        $minAge = $args['min_age'];
        $maxAge = $args['max_age'];
        return User::whereBetween('age', [$minAge, $maxAge])->orderBy('age');
    }
}

<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserResolver
{
    public function maskedEmail(User $user): string
    {
        return '*****' . substr($user->email, 5);
    }
}

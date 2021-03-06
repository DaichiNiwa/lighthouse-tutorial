<?php

namespace App\GraphQL\Queries;

use App\Enums\BloodType;
use App\Enums\Items;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserResolver
{
    public function maskedEmail(User $user): string
    {
        return '*****' . substr($user->email, 5);
    }

    public function bloodType(User $user): string
    {
        return BloodType::fromValue($user->blood_type)->key;
    }

    public function birthYear(User $user): int
    {
        return now()->year - $user->age;
    }

    public function getLukeyItemsRandomly(): array
    {
        $allItems = Items::asArray();
        $lukeyItemsCountToday = mt_rand(1, count($allItems));
        shuffle($allItems);

        $lukeyItems = [];
        for ($i = 1; $i <= $lukeyItemsCountToday; $i++) {
            $lukeyItems[] = array_pop($allItems);
        }

        return $lukeyItems;
    }
}

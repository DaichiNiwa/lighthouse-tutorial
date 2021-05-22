<?php

namespace App\GraphQL\Queries;

use App\Enums\BloodType;
use App\Enums\Items;
use App\Models\User;

class UserType
{
    public function bloodType(User $user): string
    {
        return BloodType::fromValue($user->blood_type)->key;
    }

    public function birthYear(User $user): int
    {
        return now()->format('Y') - $user->age;
    }

    public function lukeyItems()
    {
        $lukeyItems = [];

        $allItems = Items::asArray();
        $items_count_today = mt_rand(1, count($allItems));

        shuffle($allItems);
        for ($i = 1; $i <= $items_count_today; $i++) {
            $lukeyItems[] = array_pop($allItems);
        }

        return $lukeyItems;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::truncate();
        foreach (User::all() as $user) {
            Note::factory()->count(3)->create(['user_id' => $user->id]);
        }
    }
}

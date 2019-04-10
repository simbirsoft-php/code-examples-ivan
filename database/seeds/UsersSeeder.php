<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        for ($i = 1; $i <= 10; $i++) {
            (new User)->create([
                'id' => $i,
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password' . $i),
                'api_token' => 'ap1Tok3n_' . $i,
            ]);
        }
    }
}

<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $password = Hash::make('123456');

        /**
         * Utilisateurs
         */
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'user_email' => $faker->email,
                'user_password' => $password
            ]);
        }

        /**
         * Administrateur
         */
        User::create([
            'user_email' => 'admin@admin.com',
            'user_password' => $password,
            'role_nom' => 'administrateur'
        ]);
    }
}

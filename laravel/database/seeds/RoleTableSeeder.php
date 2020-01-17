<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['administrateur', 'utilisateur'];

        for ($i = 0; $i < count($data); $i++) {
            Role::create([
                'role_nom' => $data[$i]
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Profile;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create([
        	'name' => 'customer',
        	'description' => 'Customer Role '
        ]);

        $role = Role::create([
        	'name' => 'admin',
        	'description' => 'Admin Role'
        ]);

       $user =  User::create([
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('admin'),
        	'role_id' => $role->id
        ]);

       Profile::create([
       	'user_id' => $user->id
       ]);
    }
}

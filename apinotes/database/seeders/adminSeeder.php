<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make("Super1admin");
        $user->save();

        $userGet = User::where('email','admin@gmail.com')->get();
        foreach($userGet as $item)
        {
            $role = new Role;
            $role->userId = $item->id;
            $role->role = "admin";
            $role->save();
        }
    }
}

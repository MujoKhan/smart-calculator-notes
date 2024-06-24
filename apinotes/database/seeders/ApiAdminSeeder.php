<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ApiAdmin;

class ApiAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ApiAdmin = new ApiAdmin;
        $ApiAdmin->name = "Api Admin";
        $ApiAdmin->email = "apiadmin@gmail.com";
        $ApiAdmin->password = Hash::make("Api1admin");
        $ApiAdmin->save();
    }
}

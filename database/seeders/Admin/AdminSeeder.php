<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'firstname'     => "Super",
                'lastname'      => "Admin",
                'username'      => "superadmin",
                'email'         => "superadmin@babia.to",
                'password'      => Hash::make("appdevs"),
                'created_at'    => now(),
                'status'        => true,
            ],
            [
                'firstname'     => "Sub",
                'lastname'      => "Admin",
                'username'      => "subadmin",
                'email'         => "subadmin@babia.to",
                'password'      => Hash::make("appdevs"),
                'created_at'    => now(),
                'status'        => true,
            ],
            [
                'firstname'     => "Support",
                'lastname'      => "Admin",
                'username'      => "supportadmin",
                'email'         => "supportadmin@babia.to",
                'password'      => Hash::make("appdevs"),
                'created_at'    => now(),
                'status'        => true,
            ],
            [
                'firstname'     => "Editor",
                'lastname'      => "Admin",
                'username'      => "editoradmin",
                'email'         => "editoradmin@babia.to",
                'password'      => Hash::make("appdevs"),
                'created_at'    => now(),
                'status'        => true,
            ],
            [
                'firstname'     => "Moderator",
                'lastname'      => "Admin",
                'username'      => "moderatoradmin",
                'email'         => "moderatoradmin@babia.to",
                'password'      => Hash::make("appdevs"),
                'created_at'    => now(),
                'status'        => true,
            ],
        ];

        Admin::insert($data);
    }
}

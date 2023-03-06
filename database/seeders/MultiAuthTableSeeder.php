<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MultiAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init_admins = [
            [
                'email' => 'admin@admin.com',
                'password' => 'adminpass',
                'status' => 0,
                'delete_flg' => 0,
                'now' => now(),
            ],
        ];
        foreach($init_admins as $init_admin) {

            $mdAdmin = new Admin();
            $mdAdmin->email = $init_admin['email'];
            $mdAdmin->password = Hash::make($init_admin['password']);
            $mdAdmin->status = $init_admin['status'];
            $mdAdmin->delete_flg = $init_admin['delete_flg'];
            $mdAdmin->created_at = $init_admin['now'];
            $mdAdmin->updated_at = $init_admin['now'];
            $mdAdmin->save();
        }

        $init_members = [
            [
                'email' => 'member@test.com',
                'password' => 'testpass',
                'status' => 1,
                'delete_flg' => 0,
                'now' => now(),
            ],
            [
                'email' => 'member01@test.com',
                'password' => 'testpass',
                'status' => 0,
                'delete_flg' => 0,
                'now' => now(),
            ],
        ];
        foreach($init_members as $init_member) {
            $mdMember = new Member();
            $mdMember->email = $init_member['email'];
            $mdMember->password = Hash::make($init_member['password']);
            $mdMember->status = $init_member['status'];
            $mdMember->delete_flg = $init_member['delete_flg'];
            $mdMember->created_at = $init_member['now'];
            $mdMember->updated_at = $init_member['now'];
            $mdMember->save();
        }
    }
}

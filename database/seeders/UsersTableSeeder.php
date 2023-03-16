<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Owner;
use Hash;
use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->insert([
        //     'id' => uuid(),
        //     'username' => 'admin',
        //     'password' => Hash::make('admin'),
        // ]);

        // DB::table('owners')->insert([
        //     'id' => uuid(),
        //     'username' => 'owner',
        //     'password' => Hash::make('owner'),
        // ]);

        DB::table('users')->insert([
            // 'id' => uuid(),
            // 'username' => 'user1',
            // 'password' => Hash::make('12345'),

            'id' => uuid(),
            'username' => 'user2',
            'password' => Hash::make('12345'),

            // 'id' => uuid(),
            // 'username' => 'user',
            // 'password' => Hash::make('12345'),
        ]);
    }
}

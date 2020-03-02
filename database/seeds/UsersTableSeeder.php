<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now()->toDateTimeString();
        $users = [
            [
                'name' => 'user1',
                'email' => '123456789@qq.com',
                'password' => bcrypt('123456'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'user2',
                'email' => '987654321@qq.com',
                'password' => bcrypt('123456'),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];
        \DB::table('users')->insert($users);
    }
}

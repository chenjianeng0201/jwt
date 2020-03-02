<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now()->toDateTimeString();
        $admins = [
            [
                'name' => 'admin1',
                'email' => '123456789@qq.com',
                'password' => bcrypt('123456'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'admin2',
                'email' => '987654321@qq.com',
                'password' => bcrypt('123456'),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];
        \DB::table('admins')->insert($admins);
    }
}

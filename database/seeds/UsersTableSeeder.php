<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'トランス太郎',
            'email' => 'Trans-Taro@trans-cosmos.co.jp',
            'password' => 'test12345',
            'birthday' => '1990/02/14',
            'age' => 28,
            'reason_id' => 2,
            'comment' => 'こんにちは',
            'notice_id' => 1,
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'コスモス花子',
            'email' => 'Cosmos-Hanako@trans-cosmos.co.jp',
            'password' => 'test12345',
            'birthday' => '1995/10/10',
            'age' => 23,
            'reason_id' => 3,
            'comment' => 'こんばんは',
            'notice_id' => 2,
        ];
        DB::table('users')->insert($param);

    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dtb_customerSeeder extends Seeder
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
            'reason' => '0',
            'comment' => 'こんにちは',
            'notice' => '0',
        ];
        DB::table('dtb_customer')->insert($param);

        $param = [
            'name' => 'コスモス花子',
            'email' => 'Cosmos-Hanako@trans-cosmos.co.jp',
            'password' => 'test12345',
            'birthday' => '1995/10/10',
            'age' => 23,
            'reason' => '1',
            'comment' => 'こんばんは',
            'notice' => '1',
        ];
        DB::table('dtb_customer')->insert($param);

    }
}

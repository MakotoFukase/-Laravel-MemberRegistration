<?php

use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'reason_id' => 0,
            'reason_type'    => 'チラシを見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 1,
            'reason_type'    => '電車広告を見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 2,
            'reason_type'    => 'SNSで見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 3,
            'reason_type'    => 'お友達に聞いた'
        ];
        DB::table('reasons')->insert($param);
    }
}

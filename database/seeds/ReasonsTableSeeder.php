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
            'reason_id' => 1,
            'reason'    => 'チラシを見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 2,
            'reason'    => '電車広告を見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 3,
            'reason'    => 'SNSで見た'
        ];
        DB::table('reasons')->insert($param);
        $param = [
            'reason_id' => 4,
            'reason'    => 'お友達に聞いた'
        ];
        DB::table('reasons')->insert($param);
    }
}

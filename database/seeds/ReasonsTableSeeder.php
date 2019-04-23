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
            'reason'    => 'チラシを見た'
        ];
        $param = [
            'reason_id' => 1,
            'reason'    => '電車広告を見た'
        ];
        $param = [
            'reason_id' => 2,
            'reason'    => 'SNSで見た'
        ];
        $param = [
            'reason_id' => 3,
            'reason'    => 'お友達に聞いた'
        ];
    }
}

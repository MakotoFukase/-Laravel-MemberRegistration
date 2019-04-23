<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'notice_id' => 0,
            'notice'    => '希望する'
        ];
        $param = [
            'notice_id' => 1,
            'notice'    => '希望しない'
        ];
    }
}

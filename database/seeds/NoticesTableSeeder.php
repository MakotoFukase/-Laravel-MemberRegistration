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
            'notice_type'    => '希望する'
        ];
        DB::table('notices')->insert($param);
        $param = [
            'notice_id' => 1,
            'notice_type'    => '希望しない'
        ];
        DB::table('notices')->insert($param);
    }
}

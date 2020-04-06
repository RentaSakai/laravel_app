<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodosTableSeeder extends Seeder  //クラス
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()  //メソッド
    {
        DB::table('todos')->truncate();
        DB::table('todos')->insert([
            [
                'title'      =>'Larabel Lessonを終わらせる',
                'created_at' =>Carbon::create(2018, 1, 1), //carbonとはlaravelに標準で備わっている日付操作ライブラリ
                'updated_at' =>Carbon::create(2018, 1, 4),
            ],
            [
                'title'      =>'レビューに向けて理解を深める',
                'created_at' =>Carbon::create(2018, 2, 1),
                'updated_at' =>Carbon::create(2018, 2, 5),
            ]
        ]);
    }
}

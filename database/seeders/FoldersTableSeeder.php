<?php
//namespaceが一番上に来なければいけない
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first(); // ★

        //データを挿入するコードを記述
        $titles = ['プライベート','仕事','旅行'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'user_id' => $user->id, // ★
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }    
    }
}

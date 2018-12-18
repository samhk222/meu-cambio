<?php

use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feeds')->insert([
            'descricao' => 'G1 > Economia',
            'url' => 'http://pox.globo.com/rss/g1/economia'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class MoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('moods')->insert([
			'name' => 'Happy',
			'slug' => 'happy',
			'emoji' => ':-)'
		]);

		DB::table('moods')->insert([
			'name' => 'Unemotional',
			'slug' => 'unemotional',
			'emoji' => ':-|'
		]);

		DB::table('moods')->insert([
			'name' => 'Unhappy',
			'slug' => 'unhappy',
			'emoji' => ':-('
		]);
    }
}
<?php

use Illuminate\Database\Seeder;

class m_newsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$now = \Carbon\Carbon::now();
		for ($i=10; $i < ; $i++) {
			$data = [
					'status' => '1',
					'title' => 'タイトル' . $i,
					'text' => 'テキスト' . $i,
					'category' => '1',
					//'category' => str_random(10),
					"created_at" => $now,
					"updated_at" => $now
				]
			// code...
			DB::table('m_news')->insert($data);
		}
	}
}

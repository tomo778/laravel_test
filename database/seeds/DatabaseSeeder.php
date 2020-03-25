<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Staff;
use App\Models\Category;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Model::unguard();

    $this->call('StaffTableSeeder');
    $this->call('CategoryTableSeeder');
    $this->call('ProductTableSeeder');
    $this->call('RCategoryTableSeeder');

    Model::reguard();
    }

}

class StaffTableSeeder extends Seeder {

    public function run()
    {
        DB::table('a_staff')->truncate(); //最初に全件削除

        Staff::create([
          'id' => '1',
          'status' => '1',
          'role' => '1',
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'password' => password_hash('admin', PASSWORD_DEFAULT)
        ]);

    }

}

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('m_category')->truncate(); //最初に全件削除

        Category::create([
          'id' => '1',
          'title' => 'カテゴリ1',
          'text' => 'カテゴリ1の説明',
        ]);
        Category::create([
            'id' => '2',
            'title' => 'カテゴリ2',
            'text' => 'カテゴリ2の説明',
          ]);
    }

}

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('m_product')->truncate(); //最初に全件削除
		$now = \Carbon\Carbon::now();
		for ($i=1; $i < 20; $i++) { 
			$data = [
				'status' => 1,
				'title' => '商品名' . $i,
				'text' => '説明文' . $i,
				'price' => '1000',
				'num' => '100',
				'created_at' => $now,
				'updated_at' => $now,
			];
			DB::table('m_product')->insert($data);
		}
		for ($i=21; $i < 30; $i++) { 
			$data = [
				'status' => 1,
				'title' => '商品名' . $i,
				'text' => '説明文' . $i,
				'price' => '3000',
				'num' => '10',
				'created_at' => $now,
				'updated_at' => $now,
			];
			DB::table('m_product')->insert($data);
		}
    }
}

class RCategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('r_category')->truncate(); //最初に全件削除
		$now = \Carbon\Carbon::now();
		for ($i=1; $i < 10; $i++) { 
			$data = [
				'plugin' => 'product',
				'plugin_id' => $i,
				'category' => 'product',
				'category_id' => '1',
				'created_at' => $now,
				'updated_at' => $now,
			];
			DB::table('r_category')->insert($data);

		}
		for ($i=11; $i < 30; $i++) { 
			$data = [
				'plugin' => 'product',
				'plugin_id' => $i,
				'category' => 'product',
				'category_id' => '2',
				'created_at' => $now,
				'updated_at' => $now,
			];
			DB::table('r_category')->insert($data);

		}
    }
}
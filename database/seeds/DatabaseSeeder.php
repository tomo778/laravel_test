<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\CategorysFlont;
use App\Models\Product;
use App\Models\ProductCategory;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('AdminTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('CategorysFlontTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('ProductCategoryTableSeeder');

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'id' => '1',
            'name' => 'admin',
            'email_verified_at' => now(),
            'email' => 'admin@gmail.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'remember_token' => '',
        ]);
    }
}

class AdminTableSeeder extends Seeder
{

    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'remember_token' => '',
        ]);
    }
}

class CategorysFlontTableSeeder extends Seeder
{
    public function run()
    {
        CategorysFlont::insert([
            'title' => 'カテゴリ1',
            'text' => 'カテゴリ1の説明',
        ]);
        CategorysFlont::insert([
            'title' => 'カテゴリ2',
            'text' => 'カテゴリ2の説明',
        ]);
    }
}

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'title' => 'カテゴリ1',
            'text' => 'カテゴリ1の説明',
        ]);
        Category::create([
            'title' => 'カテゴリ2',
            'text' => 'カテゴリ2の説明',
        ]);
    }
}

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $now = \Carbon\Carbon::now();
        for ($i = 1; $i < 20; $i++) {
            $data[] = [
                'status' => 1,
                'title' => '商品名' . $i,
                'text' => '説明文' . $i,
                'price' => '1000',
                'num' => '100',
                'file_name' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        for ($i = 20; $i < 30; $i++) {
            $data[] = [
                'status' => 1,
                'title' => '商品名' . $i,
                'text' => '説明文' . $i,
                'price' => '3000',
                'num' => '10',
                'file_name' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Product::insert($data);
    }
}

class ProductCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $now = \Carbon\Carbon::now();
        for ($i = 1; $i < 10; $i++) {
            $data[] = [
                'product_id' => $i,
                'category_id' => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        for ($i = 10; $i < 30; $i++) {
            $data[] = [
                'product_id' => $i,
                'category_id' => '2',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        ProductCategory::insert($data);
    }
}

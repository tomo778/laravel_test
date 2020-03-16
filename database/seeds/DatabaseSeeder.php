<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Staff;
use App\Category;

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

    Model::reguard();
    }

}

class StaffTableSeeder extends Seeder {

    public function run()
    {
        DB::table('a_staff')->delete(); //最初に全件削除

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
        DB::table('m_category')->delete(); //最初に全件削除

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

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         // $this->call(UsersTableSeeder::class);
//     }
// }
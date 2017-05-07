<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = [
            'id' => 1,
            'name' => 'Uncategory',
            'desc' => 'This is uncategory',
            'parent_id' => 0,
            'slug' => 'uncategory'
        ];

        DB::table('categories')->insert($credentials);
    }
}

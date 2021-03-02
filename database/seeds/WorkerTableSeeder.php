<?php

use Illuminate\Database\Seeder;

class WorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('worker')->insert([
            'name' => 'Alexandr',
            'first_name' => 'Shapoval',
            'compny_id' => 2,
            'email' => 'shapovalik26@gmail.com',
            'phone' => '+380682092340',
        ]);
    }
}

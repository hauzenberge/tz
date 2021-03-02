<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('company')->insert([
            'name' => 'Apple',
            'email' => 'apple@apple.com',
            'logo'=> 'https://e7.pngegg.com/pngimages/689/128/png-clipart-apple-logo-computer-icons-macintosh-apple-stickers-logo-computer-wallpaper.png', 
            'site'=> 'https://www.apple.com/', 
        ]);
         DB::table('company')->insert([
            'name' => 'Home',
            'email' => 'home@home.com',
            'logo'=> 'https://st.depositphotos.com/1353542/2505/i/600/depositphotos_25050079-stock-photo-logo-a-house-with-a.jpg', 
            'site'=> 'https://www.localhost.com/', 
        ]);
    }
}

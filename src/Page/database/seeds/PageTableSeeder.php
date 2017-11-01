<?php

use App\Model\Page\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->delete();

        Page::create([
            'path'       => '/',
            'title'      => 'Frontpage',
            'text'       => '<p>Let us start to create a LaravelCMF...</p>',
            'visibility' => 1,
        ]);
    }
}

<?php

use Alpaca\Models\Category;
use Alpaca\Models\Page;
use Illuminate\Database\Migrations\Migration;

class InstallAlpaca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $category = Category::create([
            'active' => true,
            'path' => '/',
            'title' => 'Beiträge',
            'content' => 'Alle Seiten Beiträge',
        ]);

        Page::create([
            'active' => true,
            'path' => '/hallo-welt',
            'title' => 'Hallo Welt!',
            'teaser' => '<p>Willkommen beim AlpacaCMS System. Dies ist der erste Beitrag. Du kannst ihn bearbeiten oder löschen. Und dann starte mit dem Schreiben!</p>',
            'content' => '<p>Willkommen beim AlpacaCMS System. Dies ist der erste Beitrag. Du kannst ihn bearbeiten oder löschen. Und dann starte mit dem Schreiben!</p>',
            'user_id' => null,
            'category_id' => $category->id,
            'html_title' => null,
            'meta_robots' => null,
            'meta_description' => null,
        ]);

        Page::create([
            'active' => true,
            'path' => '/lorem/ipsum',
            'title' => 'Lorem ipsum',
            'teaser' => '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>',
            'content' => '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 

Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>',
            'user_id' => null,
            'category_id' => $category->id,
            'html_title' => null,
            'meta_robots' => null,
            'meta_description' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('pages')->truncate();
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteConfigurationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 191)->unique();
            $table->text('value');
            $table->timestamps();
        });

        DB::table('site_configurations')->insert([
            ["key" => "site_url", "value" => url('')],
            ["key" => "home_url", "value" => url('dashboard')],
            ["key" => "site_title", "value" => "Project Noah"],
            ["key" => "site_description", "value" => "A modern web tool for site owners"],
            ["key" => "site_separator", "value" => "::"],
            ["key" => "site_keywords", "value" => "modern,noah,project noah"],
            ["key" => "admin_email", "value" => "cali@projnoah.com"],
            ["key" => "registration_on", "value" => "1"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_configurations');
    }
}

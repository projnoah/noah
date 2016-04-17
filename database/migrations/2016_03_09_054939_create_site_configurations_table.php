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

        Site::homeUri('home');
        Site::socialUri('dashboard');
        Site::postUri('posts');
        Site::adminUri('admin');
        Site::siteTitle("Project Noah");
        Site::description("优雅, 现代, 简洁与全能. 服务于快速建社交/博客站的站长的工具.");
        Site::separator("::");
        Site::keywords("modern", "noah", "project noah");
        Site::siteRobotIgnores("admin");
        Site::adminIgnoresMaintenance("1");
        Site::adminEmail(env('ADMIN_EMAIL'));
        Site::registrationOn("1");
        Site::smtpEmailOn("0");
        Site::forceSsl("0");
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

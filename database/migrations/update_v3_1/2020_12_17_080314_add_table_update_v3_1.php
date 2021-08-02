<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableUpdateV31 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('blog_menu') ) {
            Schema::create('blog_menu', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('menu_id');
                $table->integer('blog_id')->unsigned();
                $table->timestamps();
            });
        }
        if ( !Schema::hasTable('subscription_items') ) {
            Schema::create('subscription_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('subscription_id');
                $table->string('stripe_id')->index();
                $table->string('stripe_plan');
                $table->integer('quantity');
                $table->timestamps();

                $table->unique(['subscription_id', 'stripe_plan']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         if(Schema::hasTable('blog_menu')){
            Schema::dropIfExists('blog_menu');
        }
        if(Schema::hasTable('subscription_items')){
            Schema::dropIfExists('subscription_items');
        }
    }
}

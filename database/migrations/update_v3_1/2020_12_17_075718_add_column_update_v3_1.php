<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUpdateV31 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('configs') ) {
            Schema::table('configs', function (Blueprint $table) {
                if (!Schema::hasColumn('configs', 'instamojo_payment')){
                    $table->integer('instamojo_payment')->nullable()->after('paypal_payment');
                }
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
         if(Schema::hasTable('configs')){
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('instamojo_payment');
            });
        }
    }
}

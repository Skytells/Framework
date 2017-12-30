<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.3
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

Class {OBJECTNAME} extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function run()
    {
        // NOTE: DO NOT FORGET TO CHANGE TABLE_NAME if you didn't assigned to a database table.
        Capsule::schema()->create('{TABLE_NAME}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public static function drop() {
        Capsule::schema()->drop('{TABLE_NAME}');
    }
}

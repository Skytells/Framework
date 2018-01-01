<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.4
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Skytells\Support\Facades\Schema;
use Skytells\Database\Schema\Blueprint;
use Skytells\Database\Migrations\Migration;
use Skytells\Database\Capsule\Manager as Capsule;

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

<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.5
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
use Skytells\Support\Facades\Schema;
use Skytells\Database\Schema\Blueprint;
use Skytells\Database\Migrations\Migration;
use Skytells\Database\Capsule\Manager as Capsule;

Class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function run()
    {
        Capsule::schema()->create('users', function (Blueprint $table) {
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
        Capsule::schema()->drop('users');
    }
}

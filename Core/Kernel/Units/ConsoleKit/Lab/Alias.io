<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.8
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
Namespace App\Controllers\Aliases;
use Skytells\Core\Console;
Class {OBJECTNAME} {

  function __construct() {
    Console::log("The Alias Controller has been loaded.");
  }

  /**
   * @method hello
   * @return string
   */
  public function hello() {
    return "Hello!";
  }

}

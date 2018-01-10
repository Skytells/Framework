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
Namespace App\Controllers\Alliances;
use Skytells\Core\Console;
Class Home extends \Home {
  function __construct() {
    Console::log("The Home Alliance Controller has been loaded.");
  }


  public function SayHello() {
    return "Hello!";
  }

}

<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.1.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */

Class Console
{

  function __construct()
    {
      global $_CONSOLE_OUTPUT;
    
    }

  public function log($value)
    {
      global $_CONSOLE_OUTPUT;
      array_push($_CONSOLE_OUTPUT, "Console :> $value");
    }

  public function logEvent($Key, $value)
    {
      global $_CONSOLE_OUTPUT;
      array_push($_CONSOLE_OUTPUT, "$Key :> $value");
    }

  public function writeln($value)
    {
      $this->log($value);
      return true;
    }


}

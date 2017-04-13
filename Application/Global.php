<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.3
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  $startScriptTime=microtime(TRUE);

    require 'Misc/Settings.php';
    require("Misc/Config/Firewall.php");
    require("Misc/Config/Terminal.php");
    require("Misc/Config/Templates.php");
    require __DIR__."/Library/Core/Bootstrap.php";
    require 'Library/Constants.php';
    require 'Library/Functions/Exceptions.php';
    $files = glob(__DIR__.'/Misc/Config/Packages/*.php');
    if (count($files) > 0){
      foreach($files as $file) {
        require $file;
      }
    }



    require 'Library/Autoloader.php';
    require 'Library/Functions/Core.php';
    require 'Library/Worker.php';


    Skytells\Core\Bootstrap::addService('AI');

    $Core = new  Controller();
      $Core->Init();
      Skytells\Core\Bootstrap::Powerup();

<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.7
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Core;
 Class Runtime {

   public static function Report($TYPE, $Name, $FILE) {
     if (DEVELOPMENT_MODE !== TRUE) { return false; }
     global $Framework;
     $FILE = str_replace('//', '/', $FILE);
     $FILE = ltrim($FILE, '/');
     $ProccessID = rand(1111,9999);
     $Framework['Runtime']['All'][] = Array('ProccessID' => $ProccessID, 'isLoaded' => true, 'Name' => $Name, 'Type' => ucfirst($TYPE), 'File' => $FILE, 'Timestamp' => microtime(true));
     $Framework['Runtime'][ucfirst($TYPE).'s'][] = Array('ProccessID' => $ProccessID, 'isLoaded' => true, 'Name' => $Name, 'Type' => ucfirst($TYPE), 'File' => $FILE, 'Timestamp' => microtime(true));
   }


   public static function isSecured($Controller, $Method) {
     $Controller = null;
     if (\Skytells\Foundation::$MVC['Method'] == $Method) {
       if (DEVELOPMENT_MODE === true){
           throw new  \ErrorException("Security Error: Cannot access method ($Method) since its secured & used by SF itself, You're seeing this message because you're in the development mode.", 8);
       }else{ show_404(); }
       return true;
     }
     return false;
   }
 }

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

 Class Logger
 {

   public static function writeln($line){

     $file = fopen(LOGS_DIR."Log-".gmdate("Y-m-d").".txt","a+");
     $line = "[ ". gmdate("Y-m-d h:i:s A")." ] ". $line;
     fwrite($file, $line."\n");
     fclose($file);
   }


   public static function logEvent($Event, $line){

     $file = fopen(LOGS_DIR."Log-".gmdate("Y-m-d").".txt","a+");
     $line = "[ ". gmdate("Y-m-d h:i:s A")." ] ". $Event . " :-> ". $line;
     fwrite($file, $line."\n");
     fclose($file);
   }


 }

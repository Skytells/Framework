<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.6
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */


 function l($string) {
  global $lang;
   return $lang[$string];
 }

 function d($str) { return var_dump($str); }

 function t($str) {
   return  htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
 }

 function toString($str) {
   return  htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
 }

 function toInt($str) {
   return  (int)$str;
 }


 

<?
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
use Skytells\Core;
use Skytells\Ecosystem\Payload;
Class Kernel {

  public static function Import($value) {
    try {
          if (!Contains($value, ".php")){ $value = $value.".php"; }
          if (!file_exists(ENV_UNITS_DIR.$value)){ throw new ErrorException("Kernel Error: This file is not exist : ".$value, 1); }
          require ENV_UNITS_DIR.$value;
          return true;
      } catch (Exception $e) { throw new ErrorException("Kernel:".$e->getMessage(), 1); }
  }

  public static function addCLICommand($Command, $Action) {
     try {
       global $_CLI_COMMANDS;
       if (!isset($Command)){
         throw new ErrorException("The Command parameter is required!", 1);

       }
       if (!isset($Action)){
         throw new ErrorException("The Action parameter is required!", 1);

       }
       $_CLI_COMMANDS[$Command] = $Action;



     } catch (Exception $e) {
       throw new ErrorException("Error Processing Request: ".$e->getMessage(), 1);

     }

   }

 }

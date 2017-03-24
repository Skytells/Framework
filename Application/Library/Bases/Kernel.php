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

 Class Kernel
  {

   public static function Import($value) {
        try {
          if (!Contains($value, ".php")){ $value = $value.".php"; }
          if (!file_exists(CORE_UNITS_DIR.$value)){
            throw new ErrorException("Kernel Error: This file is not exist : ".$value, 1);
          }


          require CORE_UNITS_DIR.$value;

          return true;
        } catch (Exception $e) {
          throw new ErrorException("Kernel:".$e->getMessage(), 1);

        }

    }

   public static function ImportService($Service) {
          try {


                if (!Contains($Service, ".php")){ $Service = $Service.".php"; }
              if (!file_exists(CORE_SERVICES_DIR.$Service)){
                throw new ErrorException("Kernel Error: The Service File for [ ".$value." ] is not exists in (Core/Services)", 1);
              }



            require CORE_SERVICES_DIR.$Service;
            return true;
          } catch (Exception $e) {
            throw new ErrorException("Kernel:".$e->getMessage(), 1);

          }

    }


   public static function addCLICommand($Command, $Action) {
     try {
       global $_CLI_COMMANDS;
       if (!isset($Command)){
         throw new Exception("The Command parameter is required!", 1);

       }
       if (!isset($Action)){
         throw new Exception("The Action parameter is required!", 1);

       }
       $_CLI_COMMANDS[$Command] = $Action;
    


     } catch (Exception $e) {
       throw new Exception("Error Processing Request: ".$e->getMessage(), 1);

     }

   }
  }

<?
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



 /**
  * @method Inject
  */
  public static function Inject($Type, $File, $to = false, $args = [], $newName = '') {
    if (empty($Type)) { throw new \ErrorException("use() expects the fist argument Type to be added. given null.", 1);}
    if (empty($File)) { throw new \ErrorException("use() expects the sec. argument file to be added. given null.", 1);}
    $Type = strtolower($Type);
    if (!Contains($File,".php")) { $File = $File.'.php'; }
     switch ($Type) {
       case 'controller':
         $Path =  APP_CONTROLLERS_DIR.$File;
         if (!file_exists($Path)) { throw new \ErrorException("Controller [$File] is not found.", 1); }
         if (is_object($to)) {
           require $Path;
           $clName = \Load::getClassNameFromFile($Path);
           $OwnerObject = $clName;
           $namespace = \Load::getClassNamespaceFromFile($Path);
           $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
           if (!empty($newName)) { $OwnerObject = $newName;  }
           if ($args != false && is_array($args)){
           $refClass = new ReflectionClass($realClassName);
           $to->$OwnerObject = $refClass->newInstanceArgs($args);
         } else { $to->$OwnerObject = new $realClassName; } }else {require $Path;}
         Skytells\Core\Runtime::Report('controller', $realClassName, $Path);
         return true;
         break;

         case 'model':
           $Path =  APP_MODELS_DIR.$File;
           if (!file_exists($Path)) { throw new \ErrorException("Model [$File] is not found.", 1); }
           if (is_object($to)) {
             require $Path;
             $clName = \Load::getClassNameFromFile($Path);
             $OwnerObject = $clName;
             $namespace = \Load::getClassNamespaceFromFile($Path);
             $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
             if (!empty($newName)) { $OwnerObject = $newName;  }
             if ($args != false && is_array($args)){
             $refClass = new ReflectionClass($realClassName);
             $to->$OwnerObject = $refClass->newInstanceArgs($args);
           } else { $to->$OwnerObject = new $realClassName; } }else {require $Path;}
           Skytells\Core\Runtime::Report('model', $realClassName, $Path);
           return true;
          break;


       default:
         return false;
         break;
     }
   }


 }

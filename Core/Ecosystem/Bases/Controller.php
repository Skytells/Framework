<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.3
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\UI\View;
 Class Controller {

   public function __construct($args = array()) {
     global $Extentions, $OXCache;
     if (CHECK_EXTENTIONS === TRUE) {
       foreach ($Extentions as $ex) {
         if (!extension_loaded($ex)) { show_error('Woops!', 'The [ '. $ex .' ] extention is missing out<br>This Extention is required for this web application, Please install it on your PHP.'); }
       }
     }
     $this->load = new \Load();
     $this->view = new View();
     // Handling Languages.
     if (MULTILANGS_DETECTION === TRUE) {
       $SISID = (empty(LANG_SESID)) ? 'SFW_LANGUAGE' : LANG_SESID;
       $LANG = (empty(DEFAULTLANG)) ? 'en_US' : DEFAULTLANG;
       if (!isset($_SESSION[$SISID]) || empty($_SESSION[$SISID])) {
         $_SESSION[$SISID] = $LANG;
       }
       // Assigning GET -X (lang)
       if (isset($_GET['lang']) && !empty($_GET['lang'])) {
         // Secure lang string from unwanted chars..
         $_GET['lang'] =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $_GET['lang']);
         $_GET['lang'] = htmlspecialchars($_GET['lang'], ENT_IGNORE, 'utf-8');
         $_SESSION[$SISID] = $_GET['lang'];

       }
       // FREE UP RAM.
       unset($_GET['lang']); unset($LANG); unset($SISID);
     }

     if (isset($_GET['action']) && $_GET['action'] == 'flushcache') {
       flush_cache();
     }


   }


  public function AddAlliance($File, $to = false, $args = array(), $newName = '') {
    if (!Contains($File,".php")) { $File = $File.'.php'; }
    $Path =  APP_CONTROLLERS_DIR.'Alliances/'.$File;

    if (is_object($to)) {
      require $Path;
      $clName = Load::getClassNameFromFile($Path);
      $OwnerObject = $clName;
      $namespace = Load::getClassNamespaceFromFile($Path);
      $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $to->$OwnerObject = $refClass->newInstanceArgs($args);
    } else { $to->$OwnerObject = new $realClassName; } }else {require $Path;}
    return true;
  }




 }

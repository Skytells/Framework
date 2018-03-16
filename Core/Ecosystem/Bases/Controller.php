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
 use Skytells\UI\View;
 Class Controller {

  private $onLoadEvents = [];
  private $onEndEvents = [];

  /**
   * @method __construct
   */
  public function __construct() {
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
       $_GET['lang'] = null;
       $LANG = null;
       $SISID = null;

     }

     if (isset($_GET['action']) && $_GET['action'] == 'flushcache') {
       flush_cache();
     }

     if (!empty($this->onLoadEvents)) { foreach ($this->onLoadEvents as $Event) {
       $Event();
       $Event = null;
     }}

   }

  /**
   * @method inject
   */
  public function inject($Type, $File, $to = false, $args = [], $newName = '') {
    if (Skytells\Core\Runtime::isSecured($this, 'AddAlias')) { return false; }
    Kernel::Inject($Type, $File, $to, $args, $newName);
    return $this;
  }

  /**
   * @method AddAlias
   */
  public function AddAlias($File, $to = false, $args = array(), $newName = '') {
    if (Skytells\Core\Runtime::isSecured($this, 'AddAlias')) { return false; }
    if (!Contains($File,".php")) { $File = $File.'.php'; }
    $Path =  APP_CONTROLLERS_DIR.'Aliases/'.$File;
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
    return $this;
  }


  /**
   * @method autoload
   * @description This method detects the classes called by the controller and load it automatically.
   */
  public function autoload() {
    if (!Skytells\Core\Runtime::isSecured($this, 'autoload'))
    return Skytells\Ecosystem\Payload::serve();
  }


  public function on($event, $function) {
    if (!Skytells\Core\Runtime::isSecured($this, 'on')) {
      switch ($event) {
        case 'load':
          if (is_callable($function)) { $this->onLoadEvents[] = $function; $function = null; }
          return $this;
          break;
        case 'end':
            if (is_callable($function)) { $this->onEndEvents[] = $function; $function = null; }
            return $this;
          break;
        default:
          return $this;
          break;
      }
      return $this;
    }
  }

  public function __destruct() {
      if (!empty($this->onEndEvents)) { foreach ($this->onEndEvents as $Event) {
        $Event();
        $Event = null;
      }}
  }




 }

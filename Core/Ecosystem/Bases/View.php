<?php
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
Namespace Skytells\UI;
Use Skytells\Core\Runtime;
 Class View {
   public $view;
   private static $OxParses = array ();
   protected static $Oxygen = false;
   private static $Extension = '.'.TEMPLATE_FILE_EXTENSION.'.php';
   private static $ExtensionResolver = false;

 /**
  * @method getOxygenInstance
  */
  public static function getOxygenInstance() {
    if (!class_exists('OxygenInstance')) {
      \Kernel::Import('Oxygen');
      View::$Oxygen = new \OxygenInstance(APP_VIEWS_DIR, APPBASE."/".TEMPLATE_CACHE_DIR.'/');
      return View::$Oxygen;
    }
    return View::$Oxygen;
  }


 /**
  * @method assign
  * @return TRUE.
  */
  public static function assign($key, $value) {
    try {
      if (!isset($key)) { throw new \Exception("Error assigning variable: You must bypass the variable.", 1); }
      if (!isset($value)) { throw new \Exception("Error assigning variable: You must bypass the values.", 1); }
      View::$OxParses = array_merge(View::$OxParses, array($key => $value));
      return true;
    } catch (Exception $e) { throw new \ErrorException("Error Assigning variables: " . $e->getMessage(), 1); }
  }



 /**
  * @method resolveExtension
  * @return string
  */
  public static function resolveExtension($view) {
    if (View::$ExtensionResolver === true) {
      return $view.View::$Extension;
    }
    return $view;
  }

 /**
  * @method setExtensionResolver
  * @return bool
  */
  public static function setExtensionResolver($bool) {
    View::$ExtensionResolver = (bool)$bool;
    return View::$ExtensionResolver;
  }


 /**
  * @method render
  * @return UI.
  */
  public static function render($view, $variables = array(), $cFilters = array()) {
    global $ENVIRONMENT_CONFIG;
    $standardView = $view;
    $view = View::resolveExtension($view);
    if (!file_exists(APP_VIEWS_DIR.$view)) {
      throw new \ErrorException("UI Error: The view of $view cannot be found in views dir.", 1);
    }
    if (Contains($view, View::$Extension)) {
      if (USE_BUILTIN_PHRASES === TRUE) {
        $ACTIVELANG = (!isset($_SESSION[LANG_SESID]) || empty($_SESSION[LANG_SESID])) ? DEFAULTLANG : $_SESSION[LANG_SESID];
        if (!file_exists(APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php')) {
          throw new \ErrorException("UI Error: The language file [$ACTIVELANG] used in view [$view] cannot be found in dir.", 1);
        }
        // Secure Lang from unwanted strings..
        $ACTIVELANG =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $ACTIVELANG);
        $lang = include APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php';
        $TParses = array_merge($lang, $variables);
        $variables = array_merge($TParses, View::$OxParses);
        Runtime::Report('Language', ucfirst(str_replace('.php', '', $ACTIVELANG)), APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php');
      }
      if (strtolower(TEMPLATE_ENGINE) === "oxygen") {
        View::getOxygenInstance();
        $filename = str_replace(View::$Extension, "", $view);
        echo View::$Oxygen->render($filename, $variables);
        }
        else if (!class_exists("TemplateEngine")) {
          require ENV_UNITS_DIR.'MicroUI.php';
          $UI_Content = file_get_contents(APP_VIEWS_DIR.$standardView);
          $te = new \TemplateEngine($UI_Content);
          if ($cFilters != null && is_array($cFilters) && !empty($cFilters)){
            foreach ($cFilters as $key => $value) { if (!empty($key)){ $te->addFilter ($key, $value); } } }
               echo $te->apply($variables);
               $te = null;
          }
        }
      else {
        // Detect Language.
          detectCurrentLanguage();
        // Assigning Vars...
        $variables = array_merge($variables, View::$OxParses);
        if (is_array($variables) && !empty($variables)) {
          foreach ($variables as $key => $value) {
           ${$key} = $value;
          }
        }
        require APP_VIEWS_DIR.$standardView;
        $variables = null;
      }
      Runtime::Report('UI', ucfirst(str_replace('.php', '', str_replace('.ui', '', $view))), APP_VIEWS_DIR.$view);
      $standardView = null; $view = null;
  }


 /**
  * @method first
  */
  public static function first($view, $variables = [], $ShowUI = true) {
    if (is_bool($variables)) { $ShowUI = $variables;  $variables = []; }
    if (USE_BUILTIN_PHRASES === TRUE) {
      $ACTIVELANG = (!isset($_SESSION[LANG_SESID]) || empty($_SESSION[LANG_SESID])) ? DEFAULTLANG : $_SESSION[LANG_SESID];
      if (!file_exists(APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php')) {
        throw new \ErrorException("UI Error: The language file [$ACTIVELANG] used in view [$view] cannot be found in dir.", 1);
      }
      // Secure Lang from unwanted strings..
      $ACTIVELANG =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $ACTIVELANG);
      $lang = include APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php';
      $TParses = array_merge($lang, $variables);
      $variables = array_merge($TParses, View::$OxParses);
      Runtime::Report('Language', ucfirst(str_replace('.php', '', $ACTIVELANG)), APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php');
    }
    View::getOxygenInstance();
    if ($ShowUI === true) {
      echo View::$Oxygen->first($view, $variables, $ShowUI);
      $view = null;
      return true;
    }
    return View::$Oxygen->first($view, $variables, $ShowUI);
  }


 /**
  * @method build
  */
  public static function build($views, $variables = array(), $cFilters = array()) {
    if (empty($views)) {
      throw new \ErrorException("bulk() method requires an array of views to be set.", 1);
    }
   $mergedvars = View::mergeLanguageWith($variables);
   if (array_search(View::$Extension, $views) && strtolower(TEMPLATE_ENGINE) === "oxygen") {
      View::getOxygenInstance();
      foreach ($views as $view => $vars) {
        $view = View::resolveExtension($view);
        if (isset($vars) && is_array($vars)) {
          $variables = array_merge($mergedvars, $vars);
        }else {
          $variables = $mergedvars;
          $view = $vars;
        }
        $filename = str_replace(View::$Extension, "", $view);
        echo View::$Oxygen->render($filename, $variables);
        Runtime::Report('UI', ucfirst(str_replace('.php', '', str_replace('.ui', '', $view))), APP_VIEWS_DIR.$view);
      }
      $mergedvars = null; $variables = null; $view = null; $filename = null;
      return true;
    }else {
      detectCurrentLanguage();
      $variables = array_merge($variables, View::$OxParses);
      foreach ($views as $view => $vars) {
        if (isset($vars) && is_array($vars)) {
          if (is_array($variables) && !empty($variables)) {
            foreach ($variables as $key => $value) {
             ${$key} = $value;
            }
          }
        }else {
          $variables = $mergedvars;
          $view = $vars;
        }
        require APP_VIEWS_DIR.$view;
        Runtime::Report('UI', ucfirst(str_replace('.php', '', str_replace('.ui', '', $view))), APP_VIEWS_DIR.$view);
      }
      $mergedvars = null; $variables = null; $view = null; $filename = null;

    }

  }


 /**
  * @method mergeLanguageWith
  */
  public static function mergeLanguageWith($variables) {
    if (USE_BUILTIN_PHRASES === TRUE) {
      $ACTIVELANG = (!isset($_SESSION[LANG_SESID]) || empty($_SESSION[LANG_SESID])) ? DEFAULTLANG : $_SESSION[LANG_SESID];
      if (!file_exists(APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php')) {
        throw new \ErrorException("UI Error: The language file [$ACTIVELANG] used in view [$view] cannot be found in dir.", 1);
      }
      // Secure Lang from unwanted strings..
      $ACTIVELANG =  str_replace(array('../', 'http', '//', 'www', '/', '__DIR__', 'dirname', '\\'), '', $ACTIVELANG);
      $lang = include APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php';
      $TParses = array_merge($lang, $variables);
      $variables = array_merge($TParses, View::$OxParses);
      Runtime::Report('Language', ucfirst(str_replace('.php', '', $ACTIVELANG)), APP_BUILTINLANGS_DIR.$ACTIVELANG.'.php');
    }
    return $variables;
  }


 /**
  * @method setExtension
  */
  public static function setExtension($ex = 'ui.php') {
    $ex = ltrim($str, '.');
    $ex = rtrim($str, '.');
    View::$Extension = '.'.$ex;
    return true;
  }


 /**
  * @method getExtension
  */
  public static function getExtension() {
    return View::$Extension;
  }

 /**
  * @method __call
  * Binding Calls to Oxygen Compiler
  */
  public function __call($method, $arguments = []) {
    if (strtolower(TEMPLATE_ENGINE) === "oxygen") {
      return call_user_func_array(array(View::getOxygenInstance(), $method), $arguments);
    }
  }


 /**
  * @method __callStatic
  * Binding Calls to Oxygen Compiler Statically.
  */
  public static function __callStatic($method, $arguments = []) {
    if (strtolower(TEMPLATE_ENGINE) === "oxygen") {
      return call_user_func_array(array(View::getOxygenInstance(), $method), $arguments);
    }
  }





 }

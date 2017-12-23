<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.1
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
  * @method render
  * @return UI.
  */
  public static function render($view, $variables = array(), $cFilters = array()) {
    global $ENVIRONMENT_CONFIG;
    if (!file_exists(APP_VIEWS_DIR.$view)) {
      throw new \ErrorException("UI Error: The view of $view cannot be found in views dir.", 1);
    }
    if (Contains($view, ".".TEMPLATE_FILE_EXTENSION.".php")) {
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
      if (strtolower(TEMPLATE_ENGINE) == "oxygen") {
        \Kernel::Import('Oxygen');
        $filename = str_replace(".".TEMPLATE_FILE_EXTENSION.".php", "", $view);
        $Oxygen = new \OxygenInstance(APP_VIEWS_DIR, APPBASE."/".TEMPLATE_CACHE_DIR.'/');
        echo $Oxygen->render($filename, $variables);
        }
        else if (!class_exists("TemplateEngine")) {
          require ENV_UNITS_DIR.'MicroUI.php';
          $UI_Content = file_get_contents(APP_VIEWS_DIR.$File);
          $te = new \TemplateEngine($UI_Content);
          if ($cFilters != null && is_array($cFilters) && !empty($cFilters)){
            foreach ($cFilters as $key => $value) { if (!empty($key)){ $te->addFilter ($key, $value); } } }
               echo $te->apply($variables);
          }
        }
      else {
        // Detect Language.
          detectCurrentLanguage();
        // Assigning Vars...
        $variables = array_merge($variables, View::$OxParses);
        if (is_array($variables) && count($variables) > 0) {
          foreach ($variables as $key => $value) {
           ${$key} = $value;
          }
        }
        require APP_VIEWS_DIR.$view;
      }
      Runtime::Report('UI', ucfirst(str_replace('.php', '', str_replace('.ui', '', $view))), APP_VIEWS_DIR.$view);

  }

 }

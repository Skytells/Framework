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


Class Viewer extends Controller
{
  public $view;
  private $OxParses = array ();
  public function __construct()
    {
      $this->load = new Loader();
      $this->Runtime = new Runtime();
    }

  /**
   * @method assign
   * @return TRUE.
   */
  public function assign($key, $value) {
    try {
      if (!isset($key)) { throw new Exception("Error assigning variable: You must bypass the variable.", 1); }
        if (!isset($value)) { throw new Exception("Error assigning variable: You must bypass the values.", 1); }
      $this->OxParses = array_merge($this->OxParses, array($key => $value));
      return true;
    } catch (Exception $e) {

    }

  }

  /**
   * @method render
   * @return Page.
   */
  public function render($File, $Params = null, $SkipCaching = false, array $Parses = [], $cFilters = null)
    {
      try
      {

        global $startScriptTime;
        if ($Params == true) { $SkipCaching = true; }
        if (is_array($SkipCaching)) { $Parses = $SkipCaching; $SkipCaching = false; }
        // This will set SkipCaching to True when passed as 2nd param.
        if ($SkipCaching == true) { flushPageCache(); }
        $this->AnalyzeLangugage();
        $Path = explode('/', $File);
        if (is_dir(VW_DIR.$Path[0]."/Controllers/")){
          $Controllers = scandir(VW_DIR.$Path[0]."/Controllers/");
          if (isset($Controllers) && is_array($Controllers))
            {
              foreach ($Controllers as $Controller)
                {
                  if (strpos($Controller, '.php') !== false) {


                   require (VW_DIR.$Path[0]."/Controllers/$Controller");
                    $this->RegController(VW_DIR.$Path[0]."/Controllers/$Controller");
                    $this->Runtime->ReportController(VW_DIR.$Path[0]."/Controllers/".$Controller);
                  }
                }
            }
        }
        if (!file_exists(VW_DIR.$File)){ throw new Exception("Viewer : [ ".VW_DIR."$File ] Doesn't Exists in Views Folder!", 5); }
        if (is_array($Params) && !empty($Params) && $Params != null){ global $_REQUEST; $_REQUEST = $Params; }


        if (Contains($File, ".".TEMPLATE_FILE_EXTENSION.".php")) {
          if (strtolower(TEMPLATE_ENGINE) == "oxygen") {
          Kernel::Import('Oxygen');
          $filename = str_replace(".".TEMPLATE_FILE_EXTENSION.".php", "", $File);
          $blade = new OxygenInstance(VW_DIR, CACHE_DIR."/Views/");
          global $lang;
          $TParses = array_merge($lang, $Parses);

          $AssginedVars = array_merge($this->OxParses, $TParses);
          echo $blade->render($filename, $AssginedVars);
          }else {
             if (!class_exists("TemplateEngine")) {
               require ENGINES_DIR.'templateengine.php';
                }
               $UI_Content = file_get_contents(VW_DIR.$File);
               $te = new TemplateEngine($UI_Content);

               if ($cFilters != null && is_array($cFilters) && !empty($cFilters)){
                 foreach ($cFilters as $key => $value) {

                   if (!empty($key)){
                     $te->addFilter ($key, $value);
                   }
                 }
               }

               global $lang;
               $TParses = array_merge($lang, $Parses);
               $AssginedVars = array_merge($this->OxParses, $TParses);
               echo $te->apply ($AssginedVars);
             }

           }
           else {
          require VW_DIR.$File;
          }
        $this->Runtime->ReportPage(VW_DIR.$File);


      }
      catch(Exception $e)
      {
        throw new Exception($e->getMessage(), 1);

      }

    }




}

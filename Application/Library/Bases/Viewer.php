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


Class Viewer extends Controller
{
  public $view;

  public function __construct()
    {
      $this->load = new Loader();
      $this->Runtime = new Runtime();
      // $this->getReady();

    }

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
        if (is_dir(VW_DIR.$Path[0]."/Controllers/"))
        {

           $Controllers = scandir(VW_DIR.$Path[0]."/Controllers/");
          if (isset($Controllers) && is_array($Controllers))
            {
              foreach ($Controllers as $Controller)
                {
                  if (strpos($Controller, '.php') !== false) {


                   require_once(VW_DIR.$Path[0]."/Controllers/$Controller");
                    $this->RegController(VW_DIR.$Path[0]."/Controllers/$Controller");
                    $this->Runtime->ReportController(VW_DIR.$Path[0]."/Controllers/".$Controller);
                  }
                }
            }
        }

         if (!file_exists(VW_DIR.$File)){
           throw new Exception("Viewer : [ ".VW_DIR."$File ] Doesn't Exists in Views Folder!", 5);

         }

         if (is_array($Params) && !empty($Params) && $Params != null){
           global $_REQUEST;
           $_REQUEST = $Params;
          }


        if (Contains($File, ".".TEMPLATE_FILE_EXTENSION.".php")) {
          if (strtolower(TEMPLATE_ENGINE) == "oxygen") {
          Kernel::Import('Oxygen');
          $filename = str_replace(".".TEMPLATE_FILE_EXTENSION.".php", "", $File);
          $blade = new OxygenInstance(VW_DIR, CACHE_DIR."/Views/");

          global $lang;
          $TParses = array_merge($lang, $Parses);
          echo $blade->render($filename, $TParses);
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
               echo $te->apply ($TParses);
             }

           }
           else {
          require_once(VW_DIR.$File);
          }
        $this->Runtime->ReportPage(VW_DIR.$File);


      }
      catch(Exception $e)
      {
        throw new Exception($e->getMessage(), 1);

      }

    }




}

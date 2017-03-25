<?
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
  global $startScriptTime;
  $endScriptTime=microtime(TRUE);
  $totalScriptTime=$endScriptTime-$startScriptTime;
   $lang = (!isset($Core) || !is_object($Core)) ? $this->ActiveLanguage  : $Core->ActiveLanguage ;
   $IsCached = isCached();
   $WARNINGS_C = 0;
   if ($IsCached == true) { $WARNINGS_C++; }
   $CModels = "";
   $CHelpers = "";
   $CPages = "";
   $CLines = "";
   $CLibs = "";
   global $_CONSOLE_OUTPUT;
   global $_DEV_LOADED_MODELS;
   global $_DB_CONNECTION_STATUS;
   global $_FILES_AUTOLOADED;
   global $_DEV_LOADED_LIBRARIES;
   global $_DEV_LOADED_HELPERS;


      $_CONS_OUTOUT = "";
  global $_LOADED_CONTROLLERS; global $_DEV_LOADED_PAGES;
  if (isset($_CONSOLE_OUTPUT) && is_array($_CONSOLE_OUTPUT) && count($_CONSOLE_OUTPUT) > 0)
   {

     foreach ($_CONSOLE_OUTPUT as $c)
       {
         $_CONS_OUTOUT =  $_CONS_OUTOUT. " &nbsp; ". rtrim(ltrim($c, '//'), '/').'<br>';
       }
   }

   if (isset($_DEV_LOADED_LIBRARIES) && is_array($_DEV_LOADED_LIBRARIES) && count($_DEV_LOADED_LIBRARIES) > 0)
    {

      foreach ($_DEV_LOADED_LIBRARIES as $c)
        {
          $CLibs =  $CLibs. " &nbsp; ". rtrim(ltrim($c, '//'), '/').'<br>';
        }
    }
  if (isset($_LOADED_CONTROLLERS) && is_array($_LOADED_CONTROLLERS) && count($_LOADED_CONTROLLERS) > 0)
   {

     foreach ($_LOADED_CONTROLLERS as $c)
       {
         $CLines =  $CLines. " &nbsp; Controller :> ". rtrim(ltrim($c, '//'), '/').'<br>';
       }
   }

   if (isset($_DEV_LOADED_PAGES) && is_array($_DEV_LOADED_PAGES) && count($_DEV_LOADED_PAGES) > 0)
   {

     foreach ($_DEV_LOADED_PAGES as $c)
       {
         $CPages =  $CPages." &nbsp; Page :> ". rtrim(ltrim($c, '//'), '/')."<br>";
       }
   }


   if (isset($_DIV_LOADED_HELPERS) && is_array($_DIV_LOADED_HELPERS) && count($_DIV_LOADED_HELPERS) > 0)
   {

     foreach ($_DIV_LOADED_HELPERS as $c)
       {
         $CHelpers =  $CHelpers." &nbsp; Helper :> ". rtrim(ltrim($c, '//'), '/')."<br>";
       }
   }


   if (isset($_SESSION["DEV_LOADED_MODELS"]) && !empty($_SESSION["DEV_LOADED_MODELS"]) && is_array($_SESSION["DEV_LOADED_MODELS"]) && count($_SESSION["DEV_LOADED_MODELS"]) > 0)
   {

     foreach ($_SESSION["DEV_LOADED_MODELS"] as $c)
       {
         $CModels = $CModels. " &nbsp; Model :> ". rtrim(ltrim($c, '//'), '/')."<br>";

       }

   }

   ?>
<style>
.bg-none{
  background:none;
  background-color:none;
}
   .devToolscol-1 {width: 8.33%;}
   .devToolscol-2 {width: 16.66%;}
   .devToolscol-3 {width: 25%;}
   .devToolscol-4 {width: 33.33%;}
   .devToolscol-5 {width: 41.66%;}
   .devToolscol-6 {width: 50%;}
   .devToolscol-7 {width: 58.33%;}
   .devToolscol-8 {width: 66.66%;}
   .devToolscol-9 {width: 75%;}
   .devToolscol-10 {width: 83.33%;}
   .devToolscol-11 {width: 91.66%;}
   .devToolscol-12 {width: 100%;}
   .devToolsFontGreen{
   color:green;
   }
   .devToolsFontRed{
   color:red;
   }
   .devToolsFontOrange{
   color:orange;
   }
   DevToolsfooter {

   position: fixed;
   left: 0;
   right: 0;
   bottom: 0;
   max-height: 0px;
   height: 140px;
   background-color: #fafafa;
   -webkit-transition: max-height 0.2s;
   transition: max-height 0.2s;
   border-top: solid 1px #ddd;
   display: none;
   font-family: "Source Code Pro", Menlo, Monaco, fixed-width;
   font-size: 12px;
   }
   .DevToolsfTab {


   position: fixed;

   left: 0;
   bottom: 0;
   padding: 0.5rem 1.7rem;
   background-color: #fafafa;
   border: solid 1px #ddd;
   border-bottom: 0;
   border-radius: 4px 4px 0 0;
   -webkit-transition: bottom 0.2s;
   transition: bottom 0.2s;
   cursor: pointer;
   }
   .DevToolsfTab.active {

     position: fixed;
     padding: 0.5rem 1.7rem;
     background-color: #fafafa;
     bottom: 114px;
      height: 10px;
   z-index: 9994;
   padding: 0.9rem 2rem;

   }
   .DevToolsfTab.active + DevToolsfooter {
     -webkit-box-shadow: 0px 0px 16px rgba(0,0,0,.2);
               -moz-box-shadow: 0px 0px 16px rgba(0,0,0,.2);
                          box-shadow: 0px 0px 16px rgba(0,0,0,.2);
   max-height: 95px;
   padding: 1.0rem;
   padding-left: 1px;
   padding-top:3px;
   position: fixed;

   display:inline-block;
   -webkit-transition: max-height 0.2s;
   transition: max-height 0.2s;
   }
   .DevTabreports{
   padding-top:6px; padding-left:2px;
   }
   }
</style>
<link rel="stylesheet" href="<?= SITEBASE; ?>/Application/Library/System/css/w3.css">
<span class="DevToolsfTab"><img src="<?= SITEBASE; ?>/Application/Library/System/images/devIcon.png" style="width: 24px; height: 24px;" title="Open Developer Tools"></span>
<DevToolsfooter id="DevToolsfooter">

   <nav class="w3-sidenav bg-none" style="width:110px; max-height: 95px; margin-top:8px; z-index:999999; padding-right:1px;">
      <a href="javascript:void(0)" class="tablink w3-text-cyan" onclick="toggleDevTab(event, 'Reports')">REPORTS</a>
      <a href="javascript:void(0)" class="tablink w3-text-teal" onclick="showResults();">DEBUGGER</a>
      <a href="javascript:void(0)" class="tablink w3-text-orange" onclick="toggleDevTab(event, 'Warnings')">WARNINGS (<?= $WARNINGS_C; ?>)</a>
      <a href="javascript:void(0)" class="tablink w3-text-khaki" onclick="toggleDevTab(event, 'Loaded')">AUTOLOADED</a>
   </nav>
   <div style="margin-left:100px; padding-top:6px;">
      <div id="Reports" class="w3-container DevTabreports active" style="display:block;" >
         <table style="border: none; width: 100%; padding:0px;">
            <div class="row">
               <tr>
                  <td>
                     <div class="devToolscol-12">
                        Page Generated in <? echo number_format($totalScriptTime, 4); ?> seconds.
                     </div>
                     <div class="devToolscol-12">
                        Total Cached &nbsp;: <? echo getTotalCached(); ?> (<a href="?Action=FlushCache">Flush Cache</a>)
                     </div>
                     <div class="devToolscol-12">
                        PHP Version &nbsp; : <devText class=" w3-text-blue-grey"><? echo phpversion(); ?></devText>
                     </div>
                     <div class="devToolscol-12">
                        MySQL Version : <? global $db; $x = (isset($_DB_CONNECTION_STATUS) && $_DB_CONNECTION_STATUS == TRUE && USE_SQL == TRUE) ?
                         '<devText class="w3-text-purple">'.$db->server_info.'</devText>' :
                           '<devText class="devToolsFontRed">Unknown</devText><cvx title="Your Database is not Connected with the Framework, Because this UI is not linked with an Model! So we can get MySQL Version while DB is offline!">(?)</cvx>'; echo $x; ?>
                     </div>
                     <div class="devToolscol-12">
                        MySQLi Status : <? $x = (isset($_DB_CONNECTION_STATUS) && $_DB_CONNECTION_STATUS == TRUE && USE_SQL == true) ? '<devText class="devToolsFontGreen">Connected</devText>' :
                           '<devText class="devToolsFontRed" title="Your Database is not Connected with the Framework, Because this UI is not linked with an Model!">Not Connected!</devText><cvx title="Your Database is not Connected with the Framework, Because this UI is not linked with an Model!">(?)</cvx>'; echo $x; ?>
                     </div>
                     <div class="devToolscol-12">
                        Total Queries : <? $x = (isset($_SESSION["DB_QUERIES_C"]) && USE_SQL == true) ? '<devText class="devToolsFontOrange">'.$_SESSION["DB_QUERIES_C"].'</devText>' :
                           '<devText class="devToolsFontRed">0</devText>'; echo $x; ?>
                     </div>


                  </td>












                  <td>
                     <div class="devToolscol-12">
                        Active Language &nbsp; &nbsp;:
                        <devText class="devToolsFontOrange"> <? echo $lang; ?> ( <a href="?lang=en">Change</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Framework Version &nbsp;:
                        <devText class="w3-text-grey"><? global $_FRAMEWORK_VER; echo $_FRAMEWORK_VER; ?> <? if (ALLOW_TERMINAL == TRUE) { ?> &nbsp;( <a href="#" title="Open Terminal" class="openModal">Terminal</a> ) <? } ?></devText>
                     </div>
                     <div class="devToolscol-12">
                        Firewall Module &nbsp; &nbsp;:
                        <? $x = (MD_Firewall == true) ? '<devText class="devToolsFontGreen">ON</devText>' : '<devText class="devToolsFontRed">OFF</devText>'; echo $x; ?>
                     </div>
                     <div class="devToolscol-12">
                        CSRF-SEC Module &nbsp; &nbsp;:
                        <? $x = (MD_CSRFProtection == true) ? '<devText class="devToolsFontGreen">ON</devText>' : '<devText class="devToolsFontRed">OFF</devText>'; echo $x; ?>
                     </div>
                     <div class="devToolscol-12">
                        XSS-SEC Module &nbsp; &nbsp; :
                        <? $x = (MD_XSSProtection == true) ? '<devText class="devToolsFontGreen">ON</devText>' : '<devText class="devToolsFontRed">OFF</devText>'; echo $x; ?>
                     </div>
                     <div class="devToolscol-12">
                        Compression &nbsp; &nbsp; &nbsp; &nbsp;: <? $x = (ENABLE_COMPRESSION && ENABLE_COMPRESSION == true) ? '<devText class="devToolsFontGreen">ON</devText>' :
                           '<devText class="devToolsFontRed">OFF</devText>'; echo $x; ?>
                     </div>
                  </td>
                  <td>
                     <div class="devToolscol-12">
                        Loaded Pages &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:
                        <devText class="devToolsFontOrange"> <? echo count($_DEV_LOADED_PAGES); ?> ( <a href="#" onclick="showResults('Pages');">Show</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Loaded Controllers  :
                        <devText class="devToolsFontOrange"> <? echo count($_LOADED_CONTROLLERS); ?> ( <a href="#" onclick="showResults('Controllers');">Show</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Loaded Models &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        <devText class="devToolsFontOrange" > <? echo count($_DEV_LOADED_MODELS); ?> ( <a href="#" onclick="showResults('Models');">Show</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Loaded Libraries &nbsp;&nbsp;:
                        <devText class="devToolsFontOrange" > <? echo count($_DEV_LOADED_LIBRARIES); ?> ( <a href="#" onclick="showResults('Libraries');">Show</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Loaded Helpers &nbsp;&nbsp;&nbsp;&nbsp;:
                        <devText class="devToolsFontOrange" > <? echo count($_DEV_LOADED_HELPERS); ?> ( <a href="#" onclick="showResults('Helpers');">Show</a> )</devText>
                     </div>
                     <div class="devToolscol-12">
                        Console Events &nbsp;&nbsp;&nbsp;&nbsp;:
                        <devText class="devToolsFontOrange" > <? echo count($_CONSOLE_OUTPUT); ?> ( <a href="#" onclick="showResults('');">Show</a> )</devText>
                     </div>
                  </td>








               </tr>
            </div>
         </table>
      </div>
      <div id="Debugger" class="w3-container DevTabreports" style="display:none; padding-top:0px;">
         <p id="debuggerLabel" class="w3-text-grey" style="margin:1px; margin-bottom:9px;">Console   </p>
         <div  id="debuggerResults" class="ta10" style="width: 100%;  overflow-x:auto;" >
           <? echo $_CONS_OUTOUT.$CLines; ?>
           <br>
         </div>
      </div>
      <div id="Warnings" class="w3-container DevTabreports" style="display:none">
        <? if ($IsCached) { ?>
        <div class="devToolscol-12 w3-text-orange">
           CACHE WARNING &nbsp; &nbsp;:
           <devText class="w3-text-purple">The entire content for this page including Controllers, Models and DB Results are completly cached, The resources for this page is not loaded.</devText>
        </div>
        <? } ?>
      </div>

      <div id="Loaded" class="w3-container DevTabreports" style="display:none; padding-top:0px;">
        <p id="debuggerLabel" class="w3-text-grey" style="margin:1px; margin-bottom:9px;">Autoloader</p>
        <div  id="AutoloaderResults" class="ta10" style="width: 100%;  overflow-x:auto;" >
          <?
           global $_AUTOLOADED;
           echo "Summary : <br>";
            echo "&nbsp; Resources used by this viewer (".count($_AUTOLOADED).") Folder(s) and (".count($_FILES_AUTOLOADED).") File(s).<br>";
            echo "Scanned Folders : ".count($_AUTOLOADED)."<br>";
           foreach ($_AUTOLOADED as $key => $value) {

                try {
                  echo "&nbsp; Library :> " .rtrim(rtrim(ltrim($value, '//'), '/'), "\/") .' ( OK )<br>';
                } catch (Exception $e) {
                    echo "Skipped";
                }

           }
           echo "Autoloaded : ".count($_FILES_AUTOLOADED)."<br>";
           foreach ($_FILES_AUTOLOADED as $key => $value) {

                try {
                  echo "&nbsp; File :> " .rtrim(rtrim(ltrim($value, '//'), '/'), "\/") .' ( OK )<br>';
                } catch (Exception $e) {
                    echo "Skipped";
                }

           }

           ?>
          <br>
        </div>
      </div>
   </div>
   <script>
      function showResults(value = "")
      {
        if (value == 'Controllers')
          {
            $('#debuggerLabel').empty().html('List of Controllers');
            var data = "<? echo $CLines; ?>";
            $('#debuggerResults').empty().html(data);

          }
        if (value == 'Pages')
            {
              $('#debuggerLabel').empty().html('List of Pages');
              $('#debuggerResults').empty().html("<? echo $CPages; ?>");
            }

            if (value == 'Models')
              {
                    $('#debuggerLabel').empty().html('List of Models');
                    $('#debuggerResults').empty().html('<? echo $CModels; ?>');
              }
        if (value == 'Helpers')
            {
                  $('#debuggerLabel').empty().html('List of Helpers');
                  $('#debuggerResults').empty().html('<? echo $CHelpers; ?>');
            }

            if (value == 'Libraries')
                {
                      $('#debuggerLabel').empty().html('List of Libraries');
                      $('#debuggerResults').empty().html('<? echo $CLibs; ?>');
                }
        if (value == "")
          {
            $('#debuggerLabel').empty().html('Console');
            $('#debuggerResults').empty().html('Files Used for this viewer ( <? echo count($_LOADED_CONTROLLERS)+count($_DEV_LOADED_PAGES)+count($_DEV_LOADED_MODELS)+count($_DEV_LOADED_HELPERS)+count($_DEV_LOADED_LIBRARIES); ?> )<BR><? echo $_CONS_OUTOUT.$CLines; ?>');

          }
        toggleDevTab(event, 'Debugger');
      }
      function toggleDevTab(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("DevTabreports");
        for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-light-grey", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-light-grey";
      }
   </script>
</DevToolsfooter>
<script type="text/javascript">

if(typeof jQuery == 'undefined'){
        document.write('<script type="text/javascript" src="<?= SITEBASE; ?>/Application/Library/System/js/jquery-1.7.1.min.js"></'+'script>');
  }

</script>


<script>
   jQuery(function($){
       $('.DevToolsfTab').on('click', function(){
           $(this).toggleClass('active');
       });
   })
</script>
<? require __DIR__."/Terminal.php"; ?>

<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.2.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class Debugger extends Controller
  {
    public $cName;
    public function __construct()
      {
        $this->cName = "Debugger";
      }

    public function ThrowException($MSG, $HEAD = "")
        {
          $this->ShowException($MSG);
            $_Content = str_replace("{MSG}", $MSG, $_Content);
          $_Content = str_replace("{HEAD}", $MSG, $_Content);
        }
    public function ShowException($MSG, $HEAD = "")
      {
      //  if (DEVELOPMENT_MODE == TRUE)
        //  {
            if ($HEAD == "")
              {
                $HEAD = "An error has occurred";
              }
            $_Content = file_get_contents(SYS_VIEWS."html/debug_error.html");
            $_Content = str_replace("{MSG}", $MSG, $_Content);
            $_Content = str_replace("{HEAD}", $HEAD, $_Content);
            exit($_Content);
        //  }
      }

    public function ShowError($errno, $errstr, $errfile = "", $errline = "", array $errcontext = null)
      {

            //if (DEVELOPMENT_MODE == TRUE)
            //  {

                $_Content = file_get_contents(SYS_VIEWS."html/debug_log.html");
                $_Content = str_replace("{MSG}", $errstr, $_Content);
                $_Content = str_replace("{ERR_LINE}", $errline, $_Content);
                $_Content = str_replace("{ERR_NO}", $errno, $_Content);
                $_Content = str_replace("{ERR_FILE}", $errfile, $_Content);
                exit($_Content);
            //  }

      }
  }

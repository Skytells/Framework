<?php

   function default_exception_handler($errstr='', $errno = '', $errline = "Unknown", $errfile = "Unknown")
    {
      $_Content = file_get_contents(SYS_VIEWS."html/debug_log.html");
      $_Content = str_replace("{MSG}", $errstr, $_Content);
      $_Content = str_replace("{ERR_LINE}", $errline, $_Content);
      $_Content = str_replace("{ERR_NO}", $errno, $_Content);
      $_Content = str_replace("{ERR_FILE}", $errfile, $_Content);
      exit($_Content);
    }

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

  function unzipPackage($Name, $Path)
    {
      if (!extension_loaded('zip') ){
        echo "PHP extension: zip needed for this action.";
        exit;
      }
      $zip = new ZipArchive;
      $res = $zip->open($Name);
      chmod($Name, 0777);
      if($res == ZipArchive::ER_OPEN){
        echo "Unable to open $Name\n";
      }

      if ($res === TRUE) {
          $zip->extractTo($Path);


          $zip->close();
          return true;
      } else {
        echo $res;
          return false;
      }
    }



  function installPackage($name, $path = "", $keep = true) {
    if ($path == null || empty($path)){
      $path = BASEPATH."/Application/";
    }
    $PackageName = $name;
    $zipFile = str_replace(".pkg", ".zip", $PackageName);
    $pkgFile = str_replace(".zip", ".pkg", $PackageName);
    rename($pkgFile,$zipFile);


    unzipPackage($zipFile, $path);
    if ($keep == true){
      sleep(1);
    rename($zipFile,$pkgFile);
  }else{ unlink($pkgFile); }
  }

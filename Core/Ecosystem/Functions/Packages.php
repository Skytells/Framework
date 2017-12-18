<?php



function downloadFile($Filename, $LocalFile) {
   ob_start();
   echo "Getting Package $Filename ...\r\n";
   ob_flush();
   flush();
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $Filename);
   $fp = fopen ($LocalFile, 'w+b');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'curl_gtprogress');
   curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
   curl_setopt($ch, CURLOPT_TIMEOUT, 50);
   curl_setopt($ch, CURLOPT_FILE, $fp);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch, CURLOPT_ENCODING, "");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_SSLVERSION,3);
    echo "Working on it.. \r\n";
     $data = curl_exec($ch);
     fputs($LocalFile, $data);
     fclose($fp);
     curl_close($ch);
     echo "---------------------------------------\r\nSkytells Package is now ready to install.\r\n---------------------------------------\r\n";
     ob_flush();
     flush();
   return $LocalFile;
  }
  function curl_gtprogress($resource,$download_size, $downloaded, $upload_size, $uploaded) {
     if($download_size > 0)
     {
         $percentage = ($download_size==0 ) ? 0.0 : $downloaded/$download_size*100;
       echo "-- Downloaded ($downloaded) of ($download_size) --> ( $percentage% )\r\n";
     }
     ob_flush();
     flush();
     usleep(100);
   }


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
      $path = BASEPATH;
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

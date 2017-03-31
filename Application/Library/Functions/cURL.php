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
  function HttpRequest($Uri, $Posts = "", $Method = "POST")
  {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Uri);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $Method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $Posts);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));


    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return $server_output;
  }


 function getCurrentUrl($full = true) {
   $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   return $url;

 }

 function getFile($Filename, $LocalFile) {
   ob_start();
   echo "Getting Package $Filename ...\r\n";
   ob_flush();
   flush();

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $Filename);
   $fp = fopen ($LocalFile, 'w');

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

     @fputs($file, $data);
     @chmod($file, 0777);
     @fclose($fp);
     curl_close($ch);
   echo "---------------------------------------\r\nSkytells Package is now ready to install.\r\n---------------------------------------";

   ob_flush();
   flush();
   return $LocalFile;
 }

  function curl_gtprogress($resource,$download_size, $downloaded, $upload_size, $uploaded)
 {


   if($download_size > 0)
   {
       $percentage = ($download_size==0 ) ? 0.0 : $downloaded/$download_size*100;
     echo "-- Downloaded ($downloaded) of ($download_size) --> ( $percentage% )\r\n";

   }
     ob_flush();
     flush();
     usleep(100);
 }


 function curldownload($file_source, $file_target) {
     $rh = fopen($file_source, 'rb');
     $wh = fopen($file_target, 'w+b');
     if (!$rh || !$wh) {
         return false;
     }

     while (!feof($rh)) {
         if (fwrite($wh, fread($rh, 4096)) === FALSE) {
             return false;
         }
         echo ' ';
         flush();
     }

     fclose($rh);
     fclose($wh);

     return true;
 }

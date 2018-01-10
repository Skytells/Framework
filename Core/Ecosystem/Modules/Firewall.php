<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.5
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */

 defined('BASEPATH') OR exit('401 - You do not have the right permission to access this area');
 Class Firewall {
   private static $ALLOWED_CHARS;
   private static $DDOS_EXP;
   function __construct() {
     Firewall::getReady();
   }
   public static function isWhitelisted($url) {
      global $Firewall;
      if (count($Firewall["WHITELISTED"]) > 0) {
        foreach ($Firewall["WHITELISTED"] as $val) {
          if (Contains($url, $val)){
            return TRUE;
          }
        }
      }
      return FALSE;
   }

   public static function allowUrl($url) {
        if (!isset($url)){ throw new \ErrorException("Error Processing Request: You need to bypass the URL that you want to allow.", 1); }
        global $Firewall;
        array_push($Firewall["WHITELISTED"], $url);
        return true;
   }
   public static function getReady() {
     global $Firewall;
     if ($Firewall['ENABLED'] === TRUE) {
       if ($Firewall['FIREWALL_ANTI_DDOS']) {
         Firewall::$DDOS_EXP = $Firewall['FIREWALL_ANTI_DDOS_INTERVAL'];
         Firewall::AntiDDoS();
       }

       Firewall::$ALLOWED_CHARS = $Firewall['ALLOWED_CHARS'];
       if (!Firewall::isWhitelisted(getUrl())) {
          Firewall::SecureURI();
       }
    }
   }
   public static function SecureURI() {
    global $_SERVER;
    $inurl = $_SERVER['REQUEST_URI'];
    $securityUlrs_url = $_SERVER['QUERY_STRING'];
    if ($securityUlrs_url != '' && preg_match(Firewall::$ALLOWED_CHARS, $securityUlrs_url)) {
      show_error('101');
    }

    return true;
   }






   public static function AntiDDoS() {
        try {
          // Assuming session is already started
            global $_SESSION; global $_SERVER;
            $uri = md5($_SERVER['REQUEST_URI']);
            $expireIn = time()+Firewall::$DDOS_EXP;
            $hash = $uri .'|'. $expireIn;
            if (isset($_SESSION["Firewall_AntiDDoS"]) && !empty($_SESSION["Firewall_AntiDDoS"])) {
            $FDcheck = explode('|', $_SESSION["Firewall_AntiDDoS"]);
            $tmcheck = $FDcheck[1];
            if ($FDcheck[0] == $uri && time() < $tmcheck) {
                header('HTTP/1.1 503 Service Unavailable');
                 die("<title>Security Warning</title><h1>DDoS Attack Detected!</h1>
                 <hr>
                      <p>Our System observed illegal requests during connecting our server!</p>
                      <p>You have been blocked from accessing our server for 1 minute due to illegal activity.</p>
                      ");
                die;
            }
          }
            // Save last request
            $_SESSION["Firewall_AntiDDoS"] = $hash;
        }
        catch(Exception $e)
          {
            throw new ErrorException("Firewall:".$e->getMessage(), 1);
          }
      }
 }

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
  function getIP()
    {
      if (!emptyempty($_SERVER['HTTP_CLIENT_IP']))
      {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
      }
      elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR']))
      //to check ip is pass from proxy
      {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      else
      {
          $ip=$_SERVER['REMOTE_ADDR'];
      }
      return $ip;
    }


  function get_client_language($availableLanguages, $default='en'){
  	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  		$langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

  		foreach ($langs as $value){
  			$choice=substr($value,0,2);
  			if(in_array($choice, $availableLanguages)){
  				return $choice;
  			}
  		}
  	}
  	return $default;
  }




  /**
   * valid_email
   *
   * @param string $email
   * @return boolean
   */
  function valid_email($email) {
      if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
          return true;
      } else {
          return false;
      }
  }


  /**
   * valid_url
   *
   * @param string $url
   * @return boolean
   */
  function valid_url($url) {
      if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false) {
          return true;
      } else {
          return false;
      }
  }


  /**
   * valid_username
   *
   * @param string $username
   * @return boolean
   */
  function valid_username($username) {
      if(strlen($username) >= 3 && preg_match('/^[a-zA-Z0-9]+([_|.]?[a-zA-Z0-9])*$/', $username)) {
          return true;
      } else {
          return false;
      }
  }



  /**
   * get_os
   *
   * @return string
   */
  function getOS() {
      $os_platform = "Unknown OS Platform";
      $os_array = array(
          '/windows nt 10/i'      =>  'Windows 10',
          '/windows nt 6.3/i'     =>  'Windows 8.1',
          '/windows nt 6.2/i'     =>  'Windows 8',
          '/windows nt 6.1/i'     =>  'Windows 7',
          '/windows nt 6.0/i'     =>  'Windows Vista',
          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
          '/windows nt 5.1/i'     =>  'Windows XP',
          '/windows xp/i'         =>  'Windows XP',
          '/windows nt 5.0/i'     =>  'Windows 2000',
          '/windows me/i'         =>  'Windows ME',
          '/win98/i'              =>  'Windows 98',
          '/win95/i'              =>  'Windows 95',
          '/win16/i'              =>  'Windows 3.11',
          '/macintosh|mac os x/i' =>  'Mac OS X',
          '/mac_powerpc/i'        =>  'Mac OS 9',
          '/linux/i'              =>  'Linux',
          '/ubuntu/i'             =>  'Ubuntu',
          '/iphone/i'             =>  'iPhone',
          '/ipod/i'               =>  'iPod',
          '/ipad/i'               =>  'iPad',
          '/android/i'            =>  'Android',
          '/blackberry/i'         =>  'BlackBerry',
          '/webos/i'              =>  'Mobile'
      );
      foreach($os_array as $regex => $value) {
          if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
              $os_platform = $value;
          }
      }
      return $os_platform;
  }


  /**
   * get_browser
   *
   * @return string
   */
  function getBrowser() {
      $browser = "Unknown Browser";
      $browser_array = array(
          '/msie/i'       =>  'Internet Explorer',
          '/firefox/i'    =>  'Firefox',
          '/safari/i'     =>  'Safari',
          '/chrome/i'     =>  'Chrome',
          '/edge/i'       =>  'Edge',
          '/opera/i'      =>  'Opera',
          '/netscape/i'   =>  'Netscape',
          '/maxthon/i'    =>  'Maxthon',
          '/konqueror/i'  =>  'Konqueror',
          '/mobile/i'     =>  'Handheld Browser'
      );
      foreach($browser_array as $regex => $value) {
          if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
              $browser = $value;
          }
      }
      return $browser;
  }

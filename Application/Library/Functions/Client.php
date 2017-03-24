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

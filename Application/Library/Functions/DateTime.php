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
function MySQLDateTime($Days = false)
  {
    if ($Days != false)
      {
        return gmdate("Y-m-d H:i:s",@strtotime("+".$Days." days"));
      }
    return gmdate("Y-m-d H:i:s");
  }

  function dt($Days = false)
    {
      return MySQLDateTime($Days);
    }

  function dtp($Days)
    {
      echo MySQLDateTime($Days);
    }

    function setTimezone($default) {
      $timezone = "";

      // On many systems (Mac, for instance) "/etc/localtime" is a symlink
      // to the file with the timezone info
      if (is_link("/etc/localtime")) {

          // If it is, that file's name is actually the "Olsen" format timezone
          $filename = readlink("/etc/localtime");

          $pos = strpos($filename, "zoneinfo");
          if ($pos) {
              // When it is, it's in the "/usr/share/zoneinfo/" folder
              $timezone = substr($filename, $pos + strlen("zoneinfo/"));
          } else {
              // If not, bail
              $timezone = $default;
          }
      }
      else {
          // On other systems, like Ubuntu, there's file with the Olsen time
          // right inside it.
          $timezone = file_get_contents("/etc/timezone");
          if (!strlen($timezone)) {
              $timezone = $default;
          }
      }
      date_default_timezone_set($timezone);
  }
  function date_convert($dt, $tz1, $df1, $tz2, $df2) {
    $res = '';
    if(!in_array($tz1, timezone_identifiers_list())) { // check source timezone
      trigger_error(__FUNCTION__ . ': Invalid source timezone ' . $tz1, E_USER_ERROR);
    } elseif(!in_array($tz2, timezone_identifiers_list())) { // check destination timezone
      trigger_error(__FUNCTION__ . ': Invalid destination timezone ' . $tz2, E_USER_ERROR);
    } else {
      // create DateTime object
      $d = DateTime::createFromFormat($df1, $dt, new DateTimeZone($tz1));
      // check source datetime
      if($d && DateTime::getLastErrors()["warning_count"] == 0 && DateTime::getLastErrors()["error_count"] == 0) {
        // convert timezone
        $d->setTimeZone(new DateTimeZone($tz2));
        // convert dateformat
        $res = $d->format($df2);
      } else {
        trigger_error(__FUNCTION__ . ': Invalid source datetime ' . $dt . ', ' . $df1, E_USER_ERROR);
      }
    }
    return $res;
  }
  function HumanTime($Date, $Short = FALSE)
    {
        if (Contains(TimeAgo($Date, $Short), "decade"))
        {
          $date = $Date; //Here is the date 24 hours format with am/pm
          $date = substr($date, 0, -2); //Removed the am/pm from date
          $NewDate = gmdate('Y-m-d H:i:s', @strtotime($date)); //then convert it to mysql date format
          if ($NewDate == "1970-01-01 02:00:00")
            {
                  $date = str_replace("/","-",$Date.':00'); //Removed the am/pm from date
                $NewDate = gmdate('Y-m-d H:i:s', @strtotime($date)); //then convert it to mysql date format
            }
              return TimeAgo($NewDate, $Short);
        }


        return TimeAgo($Date, $Short);
    }



  function TimeAgo($date,$Short = FALSE, $granularity=1)
    {
        $date = @strtotime($date);
        $difference = @time() - $date;
        if ($Short == TRUE)
        {
          $periods = array('decade' => 315360000,
              'yr' => 31536000,
              'mo' => 2628000,
              'w' => 604800,
              'd' => 86400,
              'hr' => 3600,
              'min' => 60,
              'sec' => 1);
        }else {
        $periods = array('decade' => 315360000,
            'Year' => 31536000,
            'Month' => 2628000,
            'Week' => 604800,
            'Day' => 86400,
            'Hour' => 3600,
            'Minute' => 60,
            'Second' => 1);
              }
        foreach ($periods as $key => $value) {
            if ($difference >= $value) {
                $time = floor($difference/$value);
                $difference %= $value;
                $retval .= ($retval ? ' ' : '').$time.' ';
                  if ($Short == TRUE)
                   {
                     if (Contains($key, "min") || Contains($key, "yr"))
                     {
                         $retval .= (($time > 1) ? $key.'s' : $key);
                     }else
                     {
                         $retval .= (($time > 1) ? $key : $key);
                     }

                  }else{
                $retval .= (($time > 1) ? $key.'s' : $key);
                      }
                $granularity--;
            }
            if ($granularity == '0') { break; }
        }
        if ($Short == TRUE)
         {
          return $retval;
        }
        return $retval.' ago';
    }
    function FBTime($timestamp, $Short = false)
    {
        $otherDate=$timestamp;
        $now=@date("Y-m-d H:i:s");

        $secondDifference=@strtotime($now)-@strtotime($otherDate);
        $extra="";
        if ($secondDifference == 2592000) {
        // months
        $difference = $secondDifference/2592000;
        $difference = round($difference,0);
        if ($difference>1) { $extra="s"; }
        $difference = $difference." month".$extra." ago";
    }
    elseif ($secondDifference >= 604800) {
        // weeks
        $difference = $secondDifference/604800;
        $difference = round($difference,0);
        if ($difference>1) { $extra="s"; }
        $difference = $difference." week".$extra." ago";
    }
    elseif ($secondDifference >= 86400) {
        // days
        $difference = $secondDifference/86400;
        $difference = round($difference,0);
        if ($difference>1) { $extra="s"; }
        $difference = $difference." day".$extra." ago";
    }
    elseif ($secondDifference >= 3600) {
        // hours

        $difference = $secondDifference/3600;
        $difference = round($difference,0);
        if ($difference>1) { $extra="s"; }
        $difference = $difference." hour".$extra." ago";
    }
    elseif ($secondDifference < 3600) {
        // hours
        // for seconds (less than minute)
        if($secondDifference<=60)
        {
            if($secondDifference==0)
            {
                $secondDifference=1;
            }
            if ($secondDifference>1) { $extra="s"; }
            $difference = $secondDifference." second".$extra." ago";

        }
        else
        {

    $difference = $secondDifference/60;
            if ($difference>1) { $extra="s"; }else{$extra="";}
            $difference = round($difference,0);
            $difference = $difference." minute".$extra." ago";
        }
    }

    $FinalDifference = $difference;
    if ($Short == true) {
      $FinalDifference = str_replace("second", "sec", $FinalDifference);
      $FinalDifference = str_replace("minute", "min", $FinalDifference);
      $FinalDifference = str_replace("hour", "hr", $FinalDifference);
      $FinalDifference = str_replace("week", "w", $FinalDifference);
      $FinalDifference = str_replace("weeks", "w", $FinalDifference);
      $FinalDifference = str_replace("month", "mo", $FinalDifference);
      $FinalDifference = str_replace("months", "mo", $FinalDifference);
      $FinalDifference = str_replace("year", "yr", $FinalDifference);

    }
    return $FinalDifference;
    }



  function secsToStr($secs) {
    if($secs>=86400){$days=floor($secs/86400);$secs=$secs%86400;$r=$days.' day';if($days<>1){$r.='s';}if($secs>0){$r.=', ';}}
    if($secs>=3600){$hours=floor($secs/3600);$secs=$secs%3600;$r.=$hours.' hour';if($hours<>1){$r.='s';}if($secs>0){$r.=', ';}}
    if($secs>=60){$minutes=floor($secs/60);$secs=$secs%60;$r.=$minutes.' minute';if($minutes<>1){$r.='s';}if($secs>0){$r.=', ';}}
    $r.=$secs.' second';if($secs<>1){$r.='s';}
    return $r;
    }

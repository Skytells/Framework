<?php

function micro_to_hrs($time) {
  $datetime = new DateTime();
  $datetime->setTimestamp($time);
  $format = $datetime->format('H:i:s u');
  return $format;
}

  /**
  * @method Get difference between two times
  * This function takes two dates and returns the interval between those two.
  * The result is set to be displayed in hours and minutes, you can easily change it on line 5 to fit your needs.
  */
  function dateDiff($date1, $date2){
      	$datetime1 = new DateTime($date1);
  	$datetime2 = new DateTime($date2);
  	$interval = $datetime1->diff($datetime2);
  	return $interval->format('%H:%I');
  }

  /**
  * @method Calculate age
  * This very handy function takes a date as a parameter, and returns the age.
  * Very useful on websites where you need to check that a person is over a certain age to create an account.
  */
  function age($date){
    $time = strtotime($date);
    if($time === false){
      return '';
    }
    $year_diff = '';
    $date = date('Y-m-d', $time);
    list($year,$month,$day) = explode('-',$date);
    $year_diff = date('Y') - $year;
    $month_diff = date('m') - $month;
    $day_diff = date('d') - $day;
    if ($day_diff < 0 || $month_diff < 0) { $year_diff--; }
    return $year_diff;
  }

  /**
  * @method _ago
  * Now a classic, this function turns a date into a nice "1 hour ago" or "2 days ago", like many social media sites do.
  */
  function _ago($tm,$rcs = 0) {
   $cur_tm = time(); $dif = $cur_tm-$tm;
   $pds = array('second','minute','hour','day','week','month','year','decade');
   $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

   $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
   if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
   return $x;
  }

  /**
  * @method Countdown to a date
  * A simple snippet that takes a date and tells how many days and hours are remaining until the aforementioned date.
  */
  function countdownto($Date) {
    $dt_end = new DateTime($Date);
    $remain = $dt_end->diff(new DateTime());
    return $remain->d . ' days and ' . $remain->h . ' hours';
  }



  /**
  * @method datetime
  * A simple function to view the current datetime, you can customize it as you want.
  * $format : DateTime Format, Default : Y-m-d H:i:s
  * $Customized : if not FALSE, then you can use it as : + 1 day, -1 hr ...etc.
  */
  function datetime($format = 'Y-m-d H:i:s', $Customized = false) {
    if ($Customized != false) {
        return gmdate("Y-m-d H:i:s",@strtotime($Customized));
    }
    return gmdate($format);
  }




/* ------------------------------- */
/* Date */
/* ------------------------------- */

/**
 * set_datetime
 *
 * @param string $date
 * @return string
 */
function set_datetime($date) {
    return gmdate("Y-m-d H:i:s", @strtotime($date));
}


/**
 * get_datetime
 *
 * @param string $date
 * @return string
 */
function get_datetime($date) {
    return gmdate("m/d/Y g:i A", @strtotime($date));
}

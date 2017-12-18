<?
  Class Captcha {

  	public function __construct()
  	  {
    	  try
        {
          global $_SESSION;
          if (!isset($_SESSION))
      	   @session_start();
    	  } catch (Exception $e) {

    	  }

  	  }

  	public function image($_length = 4, $_characters = "abcdefghijklmnopqrstuvwxyz1234567890") {
      global $_SESSION;
  	  @header("Content-type: image/png");
  	  $length = $_length;
  	  $characters = $_characters;
  	  $string = "";

  	  for ($p = 0; $p < $length; $p++) {
  	        $string .= $characters[mt_rand(0, strlen($characters)-1)];
  	    }

  	  $im = imagecreate(50, 20);
  	  $black = imagecolorallocate($im, 0, 0, 0);
  	  imagecolortransparent($im, $black);
  	  $orange = imagecolorallocate($im, 120, 110, 60);
  	  imagestring($im, 6, 3, 2, $string, $orange);
  	  imagepng($im);
      
  	  imagedestroy($im);
  	  $_SESSION['skytells_vcaptcha'] = $string;
  	 }

  	public function compare($text) {
  	  if ( ($_SESSION['skytells_vcaptcha'] == $text) && ($text != '') )
  	    return true;
  	  else
  	    return false;
  	  }

  	protected function getString() {
  	  return $_SESSION['skytells_vcaptcha'];
  	  }

  }

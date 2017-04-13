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
  Class HB_Inputs extends HtmlBuilder
  {

    function __construct()
    {

    }

    public function injectInput($attributes = "", $echo = true)
    {

      if (!is_array($attributes) && !empty($attributes)) {
          throw new Exception("The Html attributes is not an (array).", 102); }

      try
      {

        $_attr = "";
        foreach ($attributes as $key => $value) {
          if (!is_array($attributes[$key])){
          $_attr = $_attr. $key. '="'.$value.'" ';
          }
        }

          $_form = '<input generator="Skytells Framework" '.$_attr.'/>';
      } catch (Exception $e) {
        throw new Exception("HtmlBuilder : ".$e->getMessage(), 103);
      }
      if ($echo == false) { return $_form; }else {   echo $_form; }


    }

    public function injectButton($attributes = "", $echo = true)
    {

      if (!is_array($attributes) && !empty($attributes)) {
          throw new Exception("The Html attributes is not an (array).", 102); }

      try
      {

        $_attr = "";
        foreach ($attributes as $key => $value) {
          if (!is_array($attributes[$key])){
          $_attr = $_attr. $key. '="'.$value.'" ';
          }
        }

          $_form = '<button generator="Skytells Framework" '.$_attr.'/></button>';
      } catch (Exception $e) {
        throw new Exception("HtmlBuilder : ".$e->getMessage(), 103);
      }

      if ($echo == false) { return $_form; }else {   echo $_form; }

    }

    public function injectSubmitButton($attributes = "", $echo = true) {
      if (!is_array($attributes) && !empty($attributes)) {
          throw new Exception("The Html attributes is not an (array).", 102); }
          if (!isset($attributes["value"]) || empty($attributes["value"])){ $attributes["value"] = "Submit"; }
          try
          {

            $_attr = "";
            foreach ($attributes as $key => $value) {
              if (!is_array($attributes[$key])){
              $_attr = $_attr. $key. '="'.$value.'" ';
              }
            }

              $_form = '<input type="submit" value="'.$attributes["value"].'" generator="Skytells Framework" '.$_attr.'/>';
          } catch (Exception $e) {
            throw new Exception("HtmlBuilder : ".$e->getMessage(), 103);
          }

          if ($echo == false) { return $_form; }else {   echo $_form; }
    }

    public function injectResetButton($value = "Reset", $echo = true) {

      if ($echo == false) { return '<input type="reset" generator="Skytells Framework" value="'.$value.'" />';; }else {   echo '<input type="reset" generator="Skytells Framework" value="'.$value.'" />'; }

    }
  }

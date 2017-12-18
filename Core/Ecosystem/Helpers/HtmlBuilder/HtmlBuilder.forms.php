<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 3.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class HB_Forms extends HtmlBuilder
  {

    function __construct()
    {

    }

    public function injectForm($attributes = null)
    {
      if (!isset($attributes) || empty($attributes)) {
        throw new ErrorException("The HTML form attributes is required for this method.", 101); }

      if (!is_array($attributes)) {
          throw new Exception("The Html attributes is not an (array).", 102); }

      try
      {

        $_attr = "";
        foreach ($attributes as $key => $value) {
          if (!is_array($attributes[$key])){
          $_attr = $_attr. $key. '="'.$value.'" ';
          }
        }

          $_form = '<form generator="Skytells Framework" '.$_attr.'/>';
      } catch (Exception $e) {
        throw new Exception("HtmlBuilder : ".$e->getMessage(), 103);
      }

      echo $_form;

    }

    public function endForm(){
      echo "</form>";
    }


    public function buildForm($attributes = null, $content = "") {
      if (!isset($attributes) || empty($attributes)) {
        throw new ErrorException("The HTML form attributes is required for this method.", 101); }

      if (!is_array($attributes)) {
          throw new Exception("The Html attributes is not an (array).", 102); }
      if (!isset($content) || empty($content)) {
            throw new ErrorException("The HTML form Content is required for this method.", 105); }

      if (!is_array($content)) {
              throw new Exception("The Html Content is not an (array).", 106); }

              $this->injectForm($attributes);



              $this->endForm();


    }
  }

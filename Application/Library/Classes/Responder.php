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
  Class Responder extends Controller
    {
      public $cName;
      public function __construct()
        {
          $this->cName = "Responder";
          return $this;
        }
      public function ThrowError($Response, $Object, $Code = 0)
        {
          $ST["status"] = false;
          $ST["response"] = $Response;
          $ST["object"] = $Object;
          $ST["code"] = $Code;
          return json_encode($ST, JSON_PRETTY_PRINT);
        }
    }

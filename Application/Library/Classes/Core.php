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
  Class Core extends Controller
    {
      public $Core;
      public $cName;


      public function __construct()
        {

            $this->Init();
          //parent::__construct("Core");
        //  var_dump($this->Runtime);

          $this->cName = "Core";
          $this->Core = $this;

          return $this;

        }

      public function getReady()
        {
          try {
            $this->InitRequiredDrivers();
          } catch (Exception $e) {
            exit($this->Debugger->ShowError($e->getCode(), $e->getMessage()));
          }

        }

    }

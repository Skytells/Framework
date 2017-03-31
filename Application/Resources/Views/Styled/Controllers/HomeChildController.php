<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.2.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class HomeChildController extends Home
    {

      public function __construct()
        {
          parent::__construct("HomeChildController");
          //$this->console->logEvent("Event", "HomeChildController Loaded!");
        }
      public function SayHello()
        {

          return "	<p>Thanks for using Skytells Framework for PHP.</p>
            <p>This is a Hello World Example!</p>
            <p>You can change this Page by going to : Application/Views/Home/Index.php</p>
            <p>You're free to customize your Web-Application As ( MVC or MVHC ) or Even ( Static ) Method.</p>
            <p>You're free to Add your Classes, Controllers, Functions, Modules into (Views) Folder.</p>
            <p> This text comes from (Application/Views/Home/Controllers/HomeChildController.php)</p></div><br>";
        }



    }

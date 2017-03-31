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

  Class Home extends Controller
    {
      /**
       * @method __construct function.
       * Classes which have a constructor method call this method on each newly-created object,
       * so it is suitable for any initialization that the object may need before it is used.
       * @var PLEASE USE ( parent::__construct ) for each controller in your project.
       * This is important in order to Initialize the Framework System.
       */
      public function __construct($ref = "Core")
        {
          // This is important to include in __construct function for each controller you create.
          // To get the required method, functions, engines and etc from the base controller.
          parent::__construct();

          // Log some text in the Console.
          //$this->console->log("HomeController has been called from ". $ref);
        }

      /**
       * @method Index function.
       * This function cannot be deleted.
       * This function is responsible for rendering the view, Each controller must
       * have this public function.
       */
      public function index()
        {
          // Access this function from ( http://www.domain.com/{Framework_FOLDER}/class:{Home}/func:{index}/ )
          // Full URL : http://www.domain.com/{Framework_FOLDER}/Home/index/

          // Rendering the View.
          $this->view->render("index.php");

        }


    }

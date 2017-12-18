<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.0
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\Core;
 use Skytells\Core\Console;
 use Skytells\Runtime;
 Class Home extends Controller implements IController {

   /**
    * @method __construct function.
    * Classes which have a constructor method call this method on each newly-created object,
    * so it is suitable for any initialization that the object may need before it is used.
    * @var PLEASE USE ( parent::__construct ) for each controller in your project.
    * This is important in order to Initialize the Framework System.
    */
   public function __construct($Ref = 'Core') {
     // This is important to include in __construct function for each controller you create.
     // To get the required method, functions, engines and etc from the base controller.
     parent::__construct();

     // Log some text in the Console (YOU MUST USE 'Skytells\Core\Console' NAMESPACE.)
     Console::log("The Home Controller has been loaded.");

     // Now, We want to load the model.
     # $this->load->model('HomeModel', $this);
   }



   /**
    * @method Index function.
    * This function cannot be deleted.
    * This function is responsible for rendering the view, Each controller must
    * have this public function.
    */
   public function index($arg = '') {
    // Access this function from ( http://www.domain.com/{Framework_FOLDER}/class:{Home}/func:{index}/ )
    // Full URL : http://www.domain.com/{Framework_FOLDER}/Home/index/
    // Rendering the View.
    // In order to use one of the Template Engines, your UI must have (.ui) extention.
    // Example : View::render('index.ui.php');

    // Assigning Vars :
    # $this->view->assign('foo', 'bar');

    // OR : View::render('index.php', array("foo"=>'bar'));
     View::render('index.php', array("foo"=>'bar'));
   }



 }

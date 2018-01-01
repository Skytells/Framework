<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.4
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\UI\View;
 use Skytells\Runtime;

 Class Home extends \Controller implements \IController {
   /**
    * @method __construct function.
    * Classes which have a constructor method call this method on each newly-created object,
    * so it is suitable for any initialization that the object may need before it is used.
    * @var PLEASE USE ( parent::__construct ) for each controller in your project.
    * This is important in order to Initialize the Framework System.
    */
   public function __construct($Ref = 'Core', $IsAlliance = false) {
     // This is important to include in __construct function for each controller you create.
     // To get the required method, functions, engines and etc from the base controller.
     parent::__construct();
     // Log some text in the Console (YOU MUST USE 'Skytells\Core\Console' NAMESPACE.)
     # Console::log("The Home Controller has been loaded.");

     // use Skytells\Support\Facades\Cache; to enable Oxide Cache
     # Cache::store('file')->put('foo', 'bar', 100);
     # echo Cache::get('foo');

     // Now, We want to load the model.
    

     # $this->load->model('HomeModel', $this);
     # $Users = $this->HomeModel->getUsers();
     # d($Users);
     # d(Skytells\Elquents\Users::all());
   }

   /**
    * @method Index function.
    * This function cannot be deleted.
    * This function is responsible for rendering the view, Each controller must
    * have this public function.
    * @route /index
    */
   public function index($args = '') {

    //  $this->cache->put('test', 'This is loaded from cache.', 500);
    //  echo $this->cache->get('test');
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

   /**
     * for fast routing creation, use (@route {URI_PATH})
     * @route /Hello
     * @arguments ['arg1' => 'test']
     */
   public function Hello() {
      // This function created for demo only.
      // Did you know that you can extend you controller with other child controllers?
      // So you can (Add) or (Assign) Child-Controllers to other simply by performing
      // the following functions.
      $this->AddAlliance('Home', $this);
      echo $this->Home->SayHello();
   }

 }

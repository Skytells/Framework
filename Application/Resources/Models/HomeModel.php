<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.1
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Illuminate\Events\Dispatcher;
 use Illuminate\Container\Container;
 use Illuminate\Database\Capsule\Manager as Capsule;

 Class HomeModel extends Model {

  function __construct($Ref = '') {
     parent::__construct();
      // Connect to Database : (Default)

      // If we want to extend this model with an ORM
      // NOTE: That is option requires ORM to be on from Database config file.
       $this->AddEloquent('Users');


      // Connecting to the Selected Database Group.
       $this->Connect('Default') // Connect to db.1
            ->Join('Default'); // Joining another DB

  }

   function getUsers() {
       return $this->SQLManager['Default']->get('users');
   }

   function getUserByCapsule($ID) {
     return $this->Capsule['Default']->table('users')->where('id', '=', (int)$ID)->get();
   }


  }

 ?>

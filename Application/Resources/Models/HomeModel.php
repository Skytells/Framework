<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.9
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\Database\Capsule\Manager as Capsule;
 use Skytells\Wrappers\Model as Model;
 Class HomeModel extends Model {

  function __construct($Ref = '') {
     parent::__construct();
      // Connect to Database : (Default)

      // If we want to extend this model with an ORM
      // NOTE: That is option requires ORM to be on from Database config file.
      # $this->AddEloquent('Users');

      // Connecting to the Selected Database Group.
       $this->Connect('Default'); // Connect to db.1
      //      ->Join('Default'); // Joining another DB

  }

   function getUsers() {
       return $this->SQLManager['Default']->get('users');
   }

   function getUserByCapsule($ID = '') {
     // Requires [ORM][enabled] to be TRUE from Database config file.
     return $this->Capsule['Default']->table('users')->get();
   }

   function buildUsersTable() {
     // Requires [ORM][skytells] to be TRUE from Database config file.
     $this->AddMigration('CreateUsersTable');
     CreateUsersTable::run();
   }


  }

 ?>

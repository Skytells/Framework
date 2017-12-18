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

Class HomeModel extends Model {

  function __construct($Ref = '') {
    parent::__construct();
    // Connect to Database : (Default)
    $this->Connect('Default');
  }

  function getUsers() {
    return $this->db['Default']->get('users');
  }


}


 ?>

<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.8
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */

  function view($view, $variables = array(), $cFilters = array()) {
    Skytells\UI\View::render($view, $variables, $cFilters);
  }

  function view_assign($Key, $Value) {
    Skytells\UI\View::assign($Key, $Value);
  }

  function route($Route, $InternalRoute, $Params = []) {
    Router::assign($Route, $InternalRoute, $Params);
  }

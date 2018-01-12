<?php
@session_start();
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.6
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
  $ENV_STARTUP_TIME=microtime(TRUE);

  $ENVIRONMENT_CONFIG['ENVIRONMENT_PATH'] = "Core";
  $ENVIRONMENT_CONFIG['APPLICATION_PATH'] = "Application";
  @define(BASEPATH, __DIR__.'/', TRUE);
  @define("IS_CORE_CLI", FALSE);
  require BASEPATH.$ENVIRONMENT_CONFIG['ENVIRONMENT_PATH']."/Global.php";
  Router::Init();
  $ROOT_PATH = (ROOT_PATH == '') ? '/' : '/'.ROOT_PATH;
  Router::setBasePath($ROOT_PATH);
  forceSSLCheck(); $Core = new Boot();
  $match = Router::match();
  if( $match && is_callable( $match['target'] ) ) { call_user_func_array( $match['target'], $match['params'] ); }
  else { show_404(); }
  $ENV_END_TIME = microtime(true) - $ENV_STARTUP_TIME;
  DevTools();

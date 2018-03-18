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
 use Symfony\Component\Finder\Finder;
 use Skytells\Config\Repository;
 Class Config  {
   public static $worker;
  function __construct() {

  }
  public static function loadSettings($From) {
    $path = $From;
    $files = [];
    $phpFiles = Finder::create()->files()->name('*.php')->in($path)->depth(0);
    foreach ($phpFiles as $file) { $files[basename($file->getRealPath(), '.php')] = $file->getRealPath(); }
    $config = new Repository([]);
    foreach ($files as $fileKey => $paths) {
    $config->set($fileKey, require $paths);
    }
    Config::$worker = $config;
  }


  public static function get($var) {
    return Config::$worker->get($var);
  }
 }

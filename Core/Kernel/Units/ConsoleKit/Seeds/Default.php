<?
use ConsoleKit\Console,
    ConsoleKit\Command,
    ConsoleKit\Colors,
    ConsoleKit\Utils,
    ConsoleKit\Widgets\Dialog,
    ConsoleKit\Widgets\ProgressBar;
    use Skytells\Support\Facades\Schema;
    use Skytells\Database\Schema\Blueprint;
    use Skytells\Database\Migrations\Migration;
    use Skytells\Database\Capsule\Manager as Capsule;
global $console;
Kernel::addCLICommand("init", "init");
Kernel::addCLICommand("install", "install");
Kernel::addCLICommand("version", "version");
Kernel::addCLICommand("flushcache", "flushcache");
Kernel::addCLICommand("excheck", "excheck");
Kernel::addCLICommand("check-for-update", "checkforupdate");
Kernel::addCLICommand("perform", "perform");
Kernel::addCLICommand("mkroutes", "makeRoutes");
Kernel::addCLICommand("make", "make");
Kernel::addCLICommand("serve", "serve");
Kernel::addCLICommand("create", "create");


/**
 * @method Seeds Starts here
 */

  function init($args, $options, $console) {
    if ($options["help"] == true){
      $box = new ConsoleKit\Widgets\Box($console, "Welcome to Skytells's Virtual Machine \nOPTIONS:\n --getpkg option used for getting Skytells packages\n cf --dir To analyze your code.");
    }else{
      $box = new ConsoleKit\Widgets\Box($console, "Welcome to Skytells's Virtual Machine \nOPTIONS:\n --help for displying Help!");
    }
    $box->write();
  }


  function serve($args, $options, $console) {
    $port = 8000;
    $path = "";
    if (isset($options['p']) && !empty($options['p']) && is_string($options['p'])) {
      $port = $options['p'];
    }

    if (isset($options['t']) && !empty($options['t']) && is_string($options['t'])) {
      $path = $options['t'];
    }

    $box = new ConsoleKit\Widgets\Box($console, "Skytells Built-in server started!\nServing on: http://localhost:$port");
    $box->write();

    echo system('php -S localhost:'.$port. ' '.$path);
  }

  function flushcache($args, $options, $console) {
    flush_cache();
    $l = Colors::colorize('App Cache --FLUSH [OK]', 'green');
        $console->writeln($l);
  }

  function excheck($args, $options, $console) {
    global $Extentions;
    $l = Colors::colorize('---------------------------------------------', 'white');
    $console->writeln($l);
    $l = Colors::colorize('| PHP EXTENTIONS CHECK UP                   |', 'white');
    $console->writeln($l);
    $l = Colors::colorize('---------------------------------------------', 'white');
    $console->writeln($l);
    $l = Colors::colorize('Checking for required extentions...', 'white');
    $console->writeln($l);
    $count = count($Extentions);
    if ($count == 0) {
        $l = Colors::colorize('There is no extentions required!', 'white');
        $console->writeln($l);
        exit;
    }
    $passed = 0;
    $missed = 0;
    foreach ($Extentions as $ex) {
      sleep(1);
      if (extension_loaded($ex)) {
        $l = Colors::colorize('Extention: '.$ex.' [OK]', 'green');
        $console->writeln($l);
        $passed++;
      }else {
        $l = Colors::colorize('Extention: '.$ex.' [MISSING]', 'red');
        $console->writeln($l);
        $missed++;
      }

    }
    $l = Colors::colorize('Results: '.$passed.' Extentions loaded and ' . $missed . ' Missing.', 'yellow');
    $console->writeln($l);
  }
  /***
   * Displays a progress bar
   *
   * @opt total Number of iterations
   * @opt usleep Waiting time in microsecond between each iteration
   */
  function cliprogress($args, $options, $console) {
      $total = isset($options['total']) ? $options['total'] : 100;
      $usleep = isset($options['usleep']) ? $options['usleep'] : 10000;
      $progress = new ProgressBar($console, $total);
      for ($i = 0; $i < $total; $i++) {
          $progress->incr();
          usleep($usleep);
      }
      $progress->stop();
  }



  function create($args, $options, $console) {

    if (!isset($args[0])) {
      throw new \ErrorException("Cannot perform create() function without an argement ", 1);
    }
    if (!isset($args[1])) {
      throw new \ErrorException("Cannot perform create() function without thr 2nd argement ", 1);
    }

    $Type = $args[0];
    $Name = $args[1];
    switch ($Type) {
      case 'controller':
        if (file_exists(APP_CONTROLLERS_DIR.'/'.$Name.'.php')) {
          throw new \ErrorException("This controller is already exists!", 1);
        }
        $l = Colors::colorize("Creating $Name Controller..", 'yellow');
        $console->writeln($l);
        $Template = str_replace('{OBJECTNAME}', $Name, file_get_contents(ENV_UNITS_DIR.'/ConsoleKit/Lab/Controller.io'));
        file_put_contents(APP_CONTROLLERS_DIR.'/'.$Name.'.php', $Template);
        $l = Colors::colorize("$Name.php Created!", 'green');
        $console->writeln($l);
        break;
      case 'model':
          if (file_exists(APP_MODELS_DIR.'/'.$Name.'.php')) {
            throw new \ErrorException("This model is already exists!", 1);
          }
          $l = Colors::colorize("Creating $Name Model..", 'yellow');
          $console->writeln($l);
          $Template = str_replace('{OBJECTNAME}', $Name, file_get_contents(ENV_UNITS_DIR.'/ConsoleKit/Lab/Model.io'));
          file_put_contents(APP_MODELS_DIR.'/'.$Name.'.php', $Template);
          $l = Colors::colorize("$Name.php Created!", 'green');
          $console->writeln($l);
        break;


      case 'eloquent':
            if (file_exists(APP_ELOQUENTS_DIR.'/'.$Name.'.php')) {
              throw new \ErrorException("This model is already exists!", 1);
            }
            $l = Colors::colorize("Creating $Name eloquent..", 'yellow');
            $console->writeln($l);
            $Template = str_replace('{OBJECTNAME}', $Name, file_get_contents(APP_ELOQUENTS_DIR.'/ConsoleKit/Lab/Eloquent.io'));
            file_put_contents(APP_ELOQUENTS_DIR.'/'.$Name.'.php', $Template);
            $l = Colors::colorize("$Name.php Created!", 'green');
            $console->writeln($l);
        break;
      case 'migration':
              if (file_exists(APP_MIGRATIONS_DIR.'/'.$Name.'.php')) {
                throw new \ErrorException("This Migration is already exists!", 1);
              }
              $l = Colors::colorize("Creating $Name eloquent..", 'yellow');
              $console->writeln($l);
              $Template = str_replace('{OBJECTNAME}', $Name, file_get_contents(APP_MIGRATIONS_DIR.'/ConsoleKit/Lab/Migration.io'));
              if (isset($args[2])) {
                $Template = str_replace('{TABLE_NAME}', $args[2], file_get_contents(APP_MIGRATIONS_DIR.'/ConsoleKit/Lab/Migration.io'));
              }
              file_put_contents(APP_MIGRATIONS_DIR.'/'.$Name.'.php', $Template);
              $l = Colors::colorize("$Name.php Created!", 'green');
              $console->writeln($l);
        break;
      default:
      $l = Colors::colorize("Unrecognized Type!", 'red');
      $console->writeln($l);
        break;
    }
  }


  function make($args, $options, $console) {

    if (!isset($args[0])) {
      throw new \ErrorException("Cannot perform make() function without an argement ", 1);
    }

    switch ($args[0]) {
      case 'migration':
        require COREDIRNAME .'/Kernel/Composer/vendor/autoload.php';
        if (!isset($args[1])) { throw new \ErrorException("Cannot perform database migration function on an empty argement.", 1); }
        $file = APP_MIGRATIONS_DIR.$args[1].".php";
        require $file;
        if (!isset($args[2])) { throw new \ErrorException("Cannot perform database migration function with an empty run argement.", 1); }
        $l = Colors::colorize('Performing commands on Database...', 'yellow');
        $console->writeln($l);
        cliprogress($args, $options, $console);
        global $DBGroups, $dbconfig; $GroupID = $dbconfig['ACTIVE_GROUP'];
        $Capsule = new Capsule;
         $Capsule->addConnection(['driver' => $DBGroups[$GroupID]['ORM']['driver'],'host' => $DBGroups[$GroupID]['host'],
             'database'  => $DBGroups[$GroupID]['database'], 'username' => $DBGroups[$GroupID]['username'], 'password' => $DBGroups[$GroupID]['password'],
             'charset' => $DBGroups[$GroupID]['charset'], 'collation' => $DBGroups[$GroupID]['collation'], 'prefix' => $DBGroups[$GroupID]['prefix'],
         ]);
         $Capsule->setEventDispatcher(new \Skytells\Events\Dispatcher(new \Skytells\Container\Container));
         $Capsule->setAsGlobal();
         $Capsule->bootEloquent();
        $args[1]::$args[2]();
        $l = Colors::colorize('Database Migration: Operation finished. [SUCESS]', 'green');
        $console->writeln($l);
        break;

      case 'routes':
      $args[0] = $args[1];
      $args[0] = $args[1];
      makeRoutes($args, $options, $console);
      break;
      default:
      $l = Colors::colorize('Make reported empty response.', 'red');
      $console->writeln($l);
      break;
    }
  }
  function version($args, $options, $console) {
    global $_FRAMEWORK_VER;
    $console->writeln("This version : " . FRAMEWORK_VERSION);
  }


  function install($args, $options, $console) {
    if (!isset($options)){
    $l = Colors::colorize('Please include the options with the command.', 'red');
        $console->writeln($l); exit; }else{
          if (!is_dir(APP_PACKAGES_DIR)) {
            $l = Colors::colorize('Packages DIR is not found in (Application/Misc)', 'red');
                $console->writeln($l); exit;
          }
      $PATH = APP_PACKAGES_DIR;
      $EXTR_TO = BASEPATH;
      if (!empty($options["pkg"]) && is_string($options["pkg"])) {
        if (isset($options["to"]) && !empty($options["to"])) {
          if (!is_dir($options["to"])) {
            $l = Colors::colorize('Installation (dir) is not found!', 'red');
            $console->writeln($l);
            exit;
          }else {
            $EXTR_TO = $options["to"];
          }
        }
        $l = Colors::colorize('Searching for the Package....', 'yellow');
        $console->writeln($l);
        sleep(1);
        $localf  = substr($options["pkg"], strrpos($options["pkg"], '/') + 1);
        $filename = downloadFile($options["pkg"], $PATH.$localf);
        $l = Colors::colorize('Installing Package....', 'green');
        $console->writeln($l);
        cliprogress($args, $options, $console);
        installPackage($PATH.$localf, $EXTR_TO);
        Logger::logEvent("Core", "Package $localf installed!");
        $l = Colors::colorize('Well Done!', 'green');
        $console->writeln($l);

      }
    }
  }


  function checkforupdate($args, $options, $console) {
    $l = Colors::colorize('Checking for Framework Updates...', 'yellow');
    $console->writeln($l);
    $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
    );
    $res = file_get_contents('https://raw.githubusercontent.com/Skytells/Framework/master/Latest', false, stream_context_create($arrContextOptions));
    if (empty($res) || $res == false) {
      $l = Colors::colorize('ERROR: Unable to check for updates, Try again later.', 'red');
      $console->writeln($l);
    }

    $l = Colors::colorize('Resolving Data..', 'yellow');
    $console->writeln($l);
    $res = json_decode($res);
    if ($res == false || !is_object($res)) {
      $l = Colors::colorize('ERROR: Unable to decode server response.', 'red');
      $console->writeln($l);
    }
    if ((string)FRAMEWORK_VERSION != (string)$res->lastversion) {
      $l = Colors::colorize("You're not up to date!", 'red');
      $console->writeln($l);
      $l = Colors::colorize("You're running Skytells Framework on version ".FRAMEWORK_VERSION, 'white');
      $console->writeln($l);
      $l = Colors::colorize("The latest version is : ". $res->lastversion, 'white');
      $console->writeln($l);
    }else {
      $l = Colors::colorize("You're up to date!", 'green');
      $console->writeln($l);
    }
  }




  function perform($args, $options, $console) {
    if (isset($options['selfcheck'])) {
      $l = Colors::colorize('-------------------------------------', 'white');
      $console->writeln($l);
      $l = Colors::colorize('Performing Self-Check..', 'yellow');
      $console->writeln($l);
      $l = Colors::colorize('-------------------------------------', 'white');
      $console->writeln($l);
      sleep(0.4);
      $l = Colors::colorize('Checking for Updates...', 'white');
      $console->writeln($l);
      checkforupdate($args, $options, $console);
      $l = Colors::colorize('-------------------------------------', 'white');
      $console->writeln($l);
      $l = Colors::colorize("Checking Framework's Environment..", 'yellow');
      $console->writeln($l);

      sleep(0.4);
      if (file_exists(BASEPATH.'.env')) {
        $l = Colors::colorize('CHECKING .ENV FILE IN ROOT-DIR [SUCCESS]', 'green');
        $console->writeln($l);
        $CF = parse_ini_file(BASEPATH.'.env', true);
        if (!isset($CF['ENVIRONMENT_PATH']) || empty($CF['ENVIRONMENT_PATH']) || $CF['ENVIRONMENT_PATH'] != 'Core') {
          $l = Colors::colorize('ENVIRONMENT_PATH is not defined as (Core) in .env file [ERROR]', 'red');
          $console->writeln($l);
        }

        if (!isset($CF['APPLICATION_PATH']) || empty($CF['APPLICATION_PATH']) || $CF['APPLICATION_PATH'] != 'Application') {
          $l = Colors::colorize('APPLICATION_PATH is not defined as (Application) in .env file [ERROR]', 'red');
          $console->writeln($l);
        }
      }else {
        $l = Colors::colorize('CHECKING .ENV FILE IS NOT IN ROOT-DIR [ERROR]', 'red');
        $console->writeln($l);
      }

      $l = Colors::colorize('-------------------------------------', 'white');
      $console->writeln($l);

    }


    if (isset($options['envfix'])) {
      $data = "     # -------------------------------------------------------------
      # Environment Settings
      # DO NOT CHANGE ANYTHING HERE.
        ENVIRONMENT_PATH=Core
        APPLICATION_PATH=Application
      # -------------------------------------------------------------";
      file_put_contents(BASEPATH.'.env', $data);
      $l = Colors::colorize('ENV File fixed.', 'green');
      $console->writeln($l);
    }
  }



  function makeRoutes($args, $options, $console) {
      if (!isset($args)) {
        $l = Colors::colorize('ERROR: Please write an argument with a class name.', 'red');
        $console->writeln($l);
      }
      foreach ([APP_CONTROLLERS_DIR, APP_CONTROLLERS_DIR.'/Alliances/'] as $dir) {
          foreach(glob($dir .'*.php') as $class) {
              require $class;
          }
      }
      $className = $args[0];

      if (isset($options['regen'])) {
        @unlink(APP_MISC_DIR.'Config/Autorouting.php');
      }
      if (!file_exists(APP_MISC_DIR.'Config/Autorouting.php')) {
        file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', "<?php\r\n/**\n* @package: Auto Routing System for Skytells Framework\n* @copyright: (C) 2018 Skytells, Inc, All rights reserved. \n* @license: MIT\n* @see: https://developers.skytells.net for more info.\n*/\n\n", FILE_APPEND);
      }
      require ENV_UNITS_DIR.'DocBlock.php';
      $box = new ConsoleKit\Widgets\Box($console, 'Skytells Framework Routes Generator');
      $box->write();
    if ($className == 'all') {
      foreach(glob($dir .'*.php') as $class) {
        $className = \Load::getClassNameFromFile($class);
        $console->writeln('Making Routes for ' . $className .'..');
        $reflector = new ReflectionClass($className);
        $console->writeln('Getting ['.$className.'] Methods..');
        $methods = get_class_methods($className);
        $console->writeln('Generating Routes..');
        file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', "\n/**\n * @category: $className (Controller)\n */\n", FILE_APPEND);
      foreach ($methods as $fn) {
        $r = new ReflectionMethod($className, $fn);
        $block = $r->getDocComment();
        $block = str_replace('@Route', '@route', $block);
        $block = str_replace('@Arguments', '@arguments', $block);
        if (strpos($block, '@route') !== false) {
            $block = new DocBlock($block);
            $summary = "\n/**\n * @date : ".gmdate(LOG_DT_FORMAT)."\n * @URL : ".Base().$block->route."\n */\n";
            $endsummary = "\n// -------------------------------- \n";
            $blockArgs = $block->arguments;
            if (strpos($block, '@arguments') !== false && !empty($blockArgs)) {
              file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', $summary."Router::assign('$block->route', '$className@$fn', $block->arguments);".$endsummary, FILE_APPEND);
            }else{
              file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', $summary."Router::assign('$block->route', '$className@$fn');".$endsummary, FILE_APPEND);
            }
            $l = Colors::colorize('Routing ['.$fn.'] to '.Base().$block->route .' [OK]', 'yellow');
            $console->writeln($l);
        }
        sleep(0.3);
      }
      $l = Colors::colorize('All Routes has been generated [SUCCESS]', 'green');
      $console->writeln($l);
    }
    }else {
      if (!class_exists($className)) {
        $l = Colors::colorize("Class $className is not exists.", 'red');
        $console->writeln($l); exit;
      }
      $console->writeln('Making Routes for ' . $className .'..');
      $reflector = new ReflectionClass($className);
      $console->writeln('Getting Methods..');
      $methods = get_class_methods($className);
        $console->writeln('Generating Routes..');
        file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', "\n/**\n * @category: $className (Controller)\n */\n", FILE_APPEND);
      foreach ($methods as $fn) {
        $r = new ReflectionMethod($className, $fn);
        $block = $r->getDocComment();
        $block = str_replace('@Route', '@route', $block);
        $block = str_replace('@Arguments', '@arguments', $block);
        if (strpos($block, '@route') !== false) {
            $block = new DocBlock($block);
            $summary = "\n/**\n * @date : ".gmdate(LOG_DT_FORMAT)."\n * @URL : ".Base().$block->route."\n */\n";
            $endsummary = "\n// -------------------------------- \n";
            $blockArgs = $block->arguments;
            if (strpos($block, '@arguments') !== false && !empty($blockArgs)) {
              file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', $summary."Router::assign('$block->route', '$className@$fn', $block->arguments);".$endsummary, FILE_APPEND);
            }else{
              file_put_contents(APP_MISC_DIR.'Config/Autorouting.php', $summary."Router::assign('$block->route', '$className@$fn');".$endsummary, FILE_APPEND);
            }
            $l = Colors::colorize('Routing ['.$fn.'] to '.Base().$block->route .' [OK]', 'yellow');
            $console->writeln($l);
        }
        sleep(0.3);
      }
      $l = Colors::colorize('All Routes has been generated [SUCCESS]', 'green');
      $console->writeln($l);
      $console->writeln($l);
    }

  }

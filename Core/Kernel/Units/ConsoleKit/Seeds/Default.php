<?
use ConsoleKit\Console,
    ConsoleKit\Command,
    ConsoleKit\Colors,
    ConsoleKit\Utils,
    ConsoleKit\Widgets\Dialog,
    ConsoleKit\Widgets\ProgressBar;
global $console;
Kernel::addCLICommand("init", "init");
Kernel::addCLICommand("install", "install");
Kernel::addCLICommand("version", "version");
Kernel::addCLICommand("flushcache", "flushcache");
Kernel::addCLICommand("excheck", "excheck");
Kernel::addCLICommand("check-for-update", "checkforupdate");
Kernel::addCLICommand("perform", "perform");
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
    $res = file_get_contents('https://raw.githubusercontent.com/Skytells/Framework/master/Latest');
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

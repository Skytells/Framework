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
/**
 * @method Seeds Starts here
 */

  function init($args, $options, $console) {


    if ($options["help"] == true){
      $box = new ConsoleKit\Widgets\Box($console, "Welcome to Skytells's Virtual Machine \nOPTIONS:\n --getpkg option used for getting Skytells packages");
    }else{
      $box = new ConsoleKit\Widgets\Box($console, "Welcome to Skytells's Virtual Machine \nOPTIONS:\n --help for displying Help! this is help");
    }
    $box->write();
  }


  /***
   * Displays a progress bar
   *
   * @opt total Number of iterations
   * @opt usleep Waiting time in microsecond between each iteration
   */
  function cliprogress($args, $options, $console)
  {
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
    $console->writeln("This version : " . $_FRAMEWORK_VER);
  }
  function install($args, $options, $console) {
    if (!isset($options)){
    $l = Colors::colorize('Please include the options with the command.', 'red');
        $console->writeln($l);
    }else{

      if (!empty($options["pkg"]) && is_string($options["pkg"]))
      {
        $l = Colors::colorize('Searching for the Package....', 'yellow');
            $console->writeln($l);
          sleep(1);

          $localf  = substr($options["pkg"], strrpos($options["pkg"], '/') + 1);

        $filename = curldownload($options["pkg"], PACKAGES_DIR.$localf);

        $l = Colors::colorize('Installing Package....', 'green');
            $console->writeln($l);
            cliprogress($args, $options, $console);
            installPackage(PACKAGES_DIR.$localf);
            Logger::logEvent("Core", "Package $localf installed!");
            $l = Colors::colorize('Well Done!', 'green');
                $console->writeln($l);

      }
    }
  }

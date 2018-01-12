<?php
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
function createServiceProvider($console, $Namespace, $Contract, $Service, $Provider) {
  $l = Colors::colorize("Checking exiting service providers..", 'white');
  $console->writeln($l);
  sleep(0.5);
  if (file_exists(APP_PROVIDERS_DIR.'/Contracts/'.$Contract.'.php')) {
    throw new \ErrorException("Cannot create contract file for $Provider, Because the contract [$Contract] is already exists in Contracts dir.", 1);
  }
  if (file_exists(APP_PROVIDERS_DIR.'/Services/'.$Service.'.php')) {
    throw new \ErrorException("Cannot create service file for $Service, Because the Service [$Service] is already exists in Services dir.", 1);
  }
  if (file_exists(APP_PROVIDERS_DIR.'/Services/'.$Provider.'.php')) {
    throw new \ErrorException("Cannot create provider file for $Provider, Because the Provider [$Provider] is already exists in Services dir.", 1);
  }


  $l = Colors::colorize("Creating [$Contract] as $Namespace\\$Contract Contract..", 'yellow');
  $console->writeln($l);
  sleep(0.5);
  $Template = str_replace('{CONTRACTNAME}', $Contract, file_get_contents(ENV_UNITS_DIR.'/ConsoleKit/Lab/Providers/Contract.io'));
  $Template = str_replace('{NAMESPACE}', $Namespace, $Template);
  file_put_contents(APP_PROVIDERS_DIR.'/Contracts/'.$Contract.'.php', $Template);
  $l = Colors::colorize("Service Provider Contract : $Namespace\\$Contract Created!", 'yellow');
  $console->writeln($l);
  sleep(0.5);
  $l = Colors::colorize("Creating [$Service] as $Namespace\\$Service Class..", 'yellow');
  $console->writeln($l);
  $Template = str_replace('{CONTRACTNAME}', $Contract, file_get_contents(ENV_UNITS_DIR.'/ConsoleKit/Lab/Providers/Service.io'));
  $Template = str_replace('{NAMESPACE}', $Namespace, $Template);
  $Template = str_replace('{SERVICENAME}', $Service, $Template);
  file_put_contents(APP_PROVIDERS_DIR.'/Services/'.$Service.'.php', $Template);

  $l = Colors::colorize("Service : $Namespace\\$Service Created!", 'yellow');
  $console->writeln($l);

  sleep(0.5);

  $l = Colors::colorize("Creating [$Provider] Bootstrapping file as [$Namespace\\$Provider] ..", 'yellow');
  $console->writeln($l);
  $Template = str_replace('{CONTRACTNAME}', $Contract, file_get_contents(ENV_UNITS_DIR.'/ConsoleKit/Lab/Providers/Provider.io'));
  $Template = str_replace('{NAMESPACE}', $Namespace, $Template);
  $Template = str_replace('{SERVICENAME}', $Service, $Template);
  $Template = str_replace('{PROVIDERNAME}', $Provider, $Template);
  file_put_contents(APP_PROVIDERS_DIR.'/'.$Provider.'.php', $Template);
  sleep(0.1);
  $l = Colors::colorize("Service Bootstrap : $Provider Created as $Namespace\\$Provider !", 'yellow');
  $console->writeln($l);
  return true;

}

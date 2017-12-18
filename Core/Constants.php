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

define(FRAMEWORK_VERSION, '3.0');
define(ENVCORE, BASEPATH.$ENVIRONMENT_CONFIG['ENVIRONMENT_PATH'].'/');
define(ENV_DIR, BASEPATH.$ENVIRONMENT_CONFIG['ENVIRONMENT_PATH'].'/');
define(APPBASE, BASEPATH.$ENVIRONMENT_CONFIG['APPLICATION_PATH'].'/');
define(COREDIRNAME, $ENVIRONMENT_CONFIG['ENVIRONMENT_PATH'].'/');
define(APPDIRNAME, $ENVIRONMENT_CONFIG['APPLICATION_PATH'].'/');
define(ENV_KERNEL_DIR, ENVCORE.'Kernel/');
define(ENV_BASES_DIR, ENVCORE.'Ecosystem/Bases/');
define(ENV_INTERFACES_DIR, ENVCORE.'Ecosystem/Bases/Interfaces/');
define(ENV_EXCEPTIONS_DIR, ENVCORE.'Kernel/Exceptions/');
define(ENV_UNITS_DIR, ENVCORE.'Kernel/Units/');
define(ENV_FUNCTIONS_DIR, ENVCORE.'Ecosystem/Functions/');
define(ENV_ECOSYSTEM_DIR, ENVCORE.'Ecosystem');
define(ENV_RESOURCES_DIR, ENVCORE.'Ecosystem/Resources/');
define(ENV_SYSTEM_DIR, ENVCORE.'Ecosystem/Resources/System/');
define(ENV_VIEWS_DIR, ENVCORE.'Ecosystem/Resources/Views/');
define(ENV_HANDLERS_DIR, ENVCORE.'Ecosystem/Handlers/');
define(ENV_MODULES_DIR, ENVCORE.'Ecosystem/Modules/');
define(ENV_DRIVERS_DIR, ENVCORE.'Ecosystem/Drivers/');

// APPLICATION CONSTANTS.
define(APP_SETTINGS_DIR, APPBASE.'Misc/');
define(APP_CONTROLLERS_DIR, APPBASE.'Resources/Controllers/');
define(APP_VIEWS_DIR, APPBASE.'Resources/Views/');
define(APP_LANGS_DIR, APPBASE.'Misc/Languages/');
define(APP_STORAGE_DIR, APPBASE.'Storage/');
define(APP_STORAGE_LOGS, APPBASE.'Storage/Logs/');
define(APP_PACKAGES_DIR, APPBASE.'Misc/Packages/');

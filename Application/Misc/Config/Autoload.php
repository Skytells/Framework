<?
/*
| -------------------------------------------------------------------
| AUTOLOAD Settings
| -------------------------------------------------------------------
| BY DEFAULT; Skytells Framework doesn't load the controllers, models,
| db seeds ..etc all at once for performance optimization.
| You can configure there settings to allow the framework to load
| what you want automatically
*/
// Turn this to true to enable the features below.
$ALCONF['Autoload'] = false;

// Turn this to true to automatically load all of your controllers.
$ALCONF['Controllers'] = false;

// Turn this to true to automatically load all of your controllers Alliances.
$ALCONF['Alliances'] = false;

// Turn this to true to automatically load all of your Models.
$ALCONF['Models'] = false;

// Turn this to true to automatically load all of your Models Eloquents.
$ALCONF['Eloquents'] = false;

// Turn this to true to automatically load all of your Models Migrations.
$ALCONF['Migrations'] = false;



/*
|--------------------------------------------------------------------------
| PRE-LOADED SERVICES
|--------------------------------------------------------------------------
|
| Sometimes you need your handlers or libraries to be ready at anytime
| without loading them each time you need to use
| In order to auto-load a handler or a library, write it real-file name
| on the belonging array.
| NOTE: That Http handler is required by the Framework.
*/

$_Preloaded['Handlers'] = ["Http"];
$_Preloaded['Helpers'] = [];
$_Preloaded['Libraries'] = [];






/*
| -------------------------------------------------------------------
| EXTRA Autoload
| -------------------------------------------------------------------
| BY DEFAULT; SKYTELLS FRAMEWORK LOADS ITS LIBRARIES, FUNCTIONS ..ETC
|
| You cab customize it to add extra files to load upon starting up.
| $_Autoload : is an global array which contains the dirs. to load.
| Example of use : Array("path/to/dir");
| You can refere to the predefined Constants.
| APPBASE : Returns the Application Path.
| ENV_DIR : Returns the Core Path.
| -------------------------------------------------------------------
*/

 $_Autoload = Array();
 // NOTE: Please remove the (#) Sign from (Core/Global.php) After filling out the array.

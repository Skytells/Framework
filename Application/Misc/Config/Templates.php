<?php
  /**
  * Template Engine ------------------------------------------------------
  * Here you can choose which Template Engine you want to use.
  * @method Oxygen :: Oxygen is the simple, yet powerful templating engine
  * Developed by Skytells, Unlike other popular PHP templating engines,
  * Oxygen does not restrict you from using plain PHP code in your views.
  * In fact, all Oxygen views are compiled into plain PHP code and cached until they are modified,
  * meaning Blade adds essentially zero overhead to your application.
  * Oxygen view files use the (.ui.php) file extension.
  * And are typically stored in the resources/views directory.
  * -------
  * @method MicroUI :: Well, MicroUI is a micro Template Engine Provided by Skytells,
  * It's super-easy to use, And Ultra-fast, which allows the Framework to render
  * The view within 2ms, BUT it's not fully professional like Oxygen, In fact,
  * Using this Template Engine you cannot use PHP codes inside your view, but
  * You'll be able to define filters by yourself.
  * MicroUI view files use the (.ui.php) file extension.
  * And are typically stored in the resources/views directory.
  * The Default Template Engine is Oxygen  ----------*/
  $Settings["TEMPLATE_ENGINE"] = "Oxygen"; // Warning (Case-Sensitive)
  /**
   * @var TEMPLATE_FILE_EXTENSION : Here you can change the default extention
   * for template files, this option is (ui) by default.
   * PLEASE DO NOT USE (.) OR (.PHP) WITH THE EXTENTION.
   */
  $Settings["TEMPLATE_FILE_EXTENSION"] = "ui";

  /**
   * @var TEMPLATE_CACHE_DIR :
   * the cache path of the template cache that will be stored on.
   */
  $Settings["TEMPLATE_CACHE_DIR"] = "Storage/Cache/Views";

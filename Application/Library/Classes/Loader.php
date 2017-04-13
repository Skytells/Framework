<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.3
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */

   Class Loader
    {
      public function __construct() {

        $this->Runtime = new Runtime();
        }

      /**
      * @method Initializing a Single Model
      * - Models Stored in ( Models ) Folder
      */
      public function model($File, $setOwner = false, $args = false, $newName = "")
        {
              $path = BASEPATH.'/Application/Models/';
              if (!is_dir($path)){
                throw new Exception("The Models Folder does not exist in the main Application dir.", 90);
                return false;
              }
              if (!Contains($File, '.php')){
                $File = $File.".php";
              }

              if (file_exists($path.$File)){

                $class_name = str_replace(".php", "", $File);
                  if (!class_exists($class_name)){

                      set_include_path($path);
                      spl_autoload_extensions('.php');
                      spl_autoload($class_name);
                      //-------------------------------------------------------------------
                      if ($setOwner != false && is_object($setOwner)){
                       if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }

                        $clName = $this->getClassNameFromFile($path.$File); $OwnerObject = $clName;

                        if (!empty($newName)) { $OwnerObject = $newName;  }

                        if ($args != false && is_array($args)){
                          $refClass = new ReflectionClass($clName);
                          $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
                          }
                        else { $setOwner->$OwnerObject = new $clName; }
                      }
                      // ----------------------------------------------------------------
                      $this->Runtime->ReportModel($path.$File);
                      return true;
                    }

              }else {
                throw new Exception("Unable to load : ".$File." Please make sure to type the file name correctly.", 91);
              }
          }

      /**
      * @method Initializing a Single Model
      * - Models Stored in ( Models ) Folder
      */
      public function childModel($File, $setOwner = false, $args = false, $newName = "")
            {
                  $path = BASEPATH.'/Application/Views/';
                  if (!is_dir($path)){
                    throw new Exception("The Models Folder does not exist in the main Application dir.", 90);
                    return false;
                  }
                  if (!Contains($File, '.php')){
                    $File = $File.".php";
                  }

                  if (file_exists($path.$File)){

                    $class_name = str_replace(".php", "", $File);
                      if (!class_exists($class_name)){

                          set_include_path($path);
                          spl_autoload_extensions('.php');
                          spl_autoload($class_name);
                          //-------------------------------------------------------------------
                          if ($setOwner != false && is_object($setOwner)){
                           if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }

                            $clName = $this->getClassNameFromFile($path.$File); $OwnerObject = $clName;

                            if (!empty($newName)) { $OwnerObject = $newName;  }

                            if ($args != false && is_array($args)){
                              $refClass = new ReflectionClass($clName);
                              $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
                              }
                            else { $setOwner->$OwnerObject = new $clName; }
                          }
                          // ----------------------------------------------------------------
                          $this->Runtime->ReportModel($path.$File);
                          return true;
                        }

                  }else {
                    throw new Exception("Unable to load : ".$File." Please make sure to type the file name correctly.", 91);
                  }
              }



      /**
      * @method Initializing a Single Model
      * - Models Stored in ( Models ) Folder
      */
      public function engine($File, $setOwner = false, $args = false, $newName = "")
        {
          $path = BASEPATH.'/Application/Library/Engines/';
            if (!is_dir($path)){
              throw new Exception("The Engines Folder does not exist in the main Application/Library/Engines dir.", 90);
              return false;
              }
                  if (!Contains($File, '.php')){
                    $File = $File.".php";
                  }

                  if (file_exists($path.$File)){

                    $class_name = str_replace(".php", "", $File);
                      if (!class_exists($class_name)){

                          set_include_path($path);
                          spl_autoload_extensions('.php');
                          spl_autoload($class_name);

                          //-------------------------------------------------------------------
                          if ($setOwner != false && is_object($setOwner)){
                           if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }

                            $clName = $this->getClassNameFromFile($path.$File); $OwnerObject = $clName;
                            $namespace = $this->getClassNamespaceFromFile($path.$File);
                            $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
                            if (!empty($newName)) { $OwnerObject = $newName;  }

                            if ($args != false && is_array($args)){
                              $refClass = new ReflectionClass($realClassName);
                              $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
                              }
                            else {  $setOwner->$OwnerObject = new $realClassName(); }
                          }
                          // ----------------------------------------------------------------


                          $this->Runtime->ReportController($path.$File);
                          return true;
                        }

                  }else {
                    throw new Exception("Unable to load : ".$File." Please make sure to type the file name correctly.", 91);
                  }
          }


      static public function autoload($name) {
            require_once $name;
      }
      /**
      * @method Initializing a Single Lib
      * - Models Stored in ( Models ) Folder
      */
      public function library($File, $setOwner = null, $args = false, $newName = "")
        {
          $path = BASEPATH.'/Application/Library/Libraries/';
            if (!is_dir($path)){
              throw new Exception("The Engines Folder does not exist in the main Application/Library/Libraries dir.", 90);
                  return false;
              }
              if (!Contains($File, '.php')){
                  $File = $File.".php";
                }

              if (file_exists($path.$File)){
                $class_name = str_replace(".php", "", $File);


                    require $path.$File;

                      //-------------------------------------------------------------------
                      if ($setOwner != false && is_object($setOwner)){
                       if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }

                        $clName = $this->getClassNameFromFile($path.$File); $OwnerObject = $clName;
                        $namespace = $this->getClassNamespaceFromFile($path.$File);
                        $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
                        if (!empty($newName)) { $OwnerObject = $newName;  }

                        if ($args != false && is_array($args)){
                          $refClass = new ReflectionClass($realClassName);
                          $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
                          }
                        else {  $setOwner->$OwnerObject = new $realClassName(); }
                      }
                      // ----------------------------------------------------------------

                      $this->Runtime->ReportLibrary($path.$File);




                      }else {
                  throw new Exception("Unable to load : ".$File." Please make sure to type the file name correctly.", 91);
                  }
            }

      /**
      * @method Initializing a Single Helper
      * - Models Stored in ( Models ) Folder
      */
      public function helper($File, $setOwner = false, $args = false, $newName = "")
        {
          $path = BASEPATH.'/Application/Library/Helpers/';
            if (!is_dir($path)){
              throw new Exception("The Helper Folder does not exist in the main Application/Library/Helpers dir.", 90); return false; }
                    if (!Contains($File, '.php')){ $File = $File.".php"; }

                    if (file_exists($path.$File)){
                      require $path.$File;
                      $this->Runtime->ReportHelper($path.$File);

                      //-------------------------------------------------------------------
                      if ($setOwner != false && is_object($setOwner)){
                       if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }

                        $clName = $this->getClassNameFromFile($path.$File); $OwnerObject = $clName;
                        $namespace = $this->getClassNamespaceFromFile($path.$File);
                        $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
                        if (!empty($newName)) { $OwnerObject = $newName;  }

                        if ($args != false && is_array($args)){
                          $refClass = new ReflectionClass($realClassName);
                          $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
                          }
                        else {  $setOwner->$OwnerObject = new $realClassName(); }
                      }
                      // ----------------------------------------------------------------
                      }else {
                        throw new Exception("Unable to load : ".$File." Please make sure to type the file name correctly.", 91);
                }
          }





      public function getClassFullNameFromFile($filePathName)
        {
            return $this->getClassNamespaceFromFile($filePathName) . '\\' . $this->getClassNameFromFile($filePathName);
        }


      /**
       * build and return an object of a class from its file path
       *
       * @param $filePathName
       *
       * @return  mixed
       */
      public function getClassObjectFromFile($filePathName)
      {
          $classString = $this->getClassFullNameFromFile($filePathName);

          $object = new $classString;

          return $object;
      }


        /**
         * get the class namespace form file path using token
         *
         * @param $filePathName
         *
         * @return  null|string
         */
        public function getClassNamespaceFromFile($filePathName)
        {
            $src = file_get_contents($filePathName);

            $tokens = token_get_all($src);
            $count = count($tokens);
            $i = 0;
            $namespace = '';
            $namespace_ok = false;
            while ($i < $count) {
                $token = $tokens[$i];
                if (is_array($token) && $token[0] === T_NAMESPACE) {
                    // Found namespace declaration
                    while (++$i < $count) {
                        if ($tokens[$i] === ';') {
                            $namespace_ok = true;
                            $namespace = trim($namespace);
                            break;
                        }
                        $namespace .= is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                    }
                    break;
                }
                $i++;
            }
            if (!$namespace_ok) {
                return null;
            } else {
                return $namespace;
            }
        }

      /**
       * get the class name form file path using token
       *
       * @param $filePathName
       *
       * @return  mixed
       */
      public function getClassNameFromFile($filePathName)
      {
          $php_code = file_get_contents($filePathName);
        //  exit(var_dump($php_code));

          $classes = array();
          $tokens = token_get_all($php_code);
          $count = count($tokens);
          for ($i = 2; $i < $count; $i++) {
              if ($tokens[$i - 2][0] == T_CLASS
                  && $tokens[$i - 1][0] == T_WHITESPACE
                  && $tokens[$i][0] == T_STRING
              ) {

                  $class_name = $tokens[$i][1];
                  $classes[] = $class_name;
              }
          }

          return $classes[0];
      }
    }

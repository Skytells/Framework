<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.1
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 use Skytells\Core\Runtime;
	Class Load {
    private static $Imported = Array();
    private static $Reporter = TRUE;

    public static function setReporter($MODE) {
      Load::$Reporter = $MODE;
    }

    public static function getReporterStatus($MODE) {
      return Load::$Reporter;
    }

    public static function handler($File, $setOwner = false, $args = false, $newName = "") {
      try {
          $path = ENVCORE.'/Ecosystem/Handlers/';
          $InternalPath = BASEPATH.'Application/Misc/Handlers/';
          if (!is_dir($path)){ throw new \Exception("The Handlers Folder does not exist in the main Application dir.", 90); return false; }
          if (!Contains($File, '.php')){ $File = $File.".php"; }
          $TruePath = $path.$File;
          if (!file_exists($TruePath)){
              if (file_exists($InternalPath.$File)) { $TruePath = $InternalPath.$File; }else {
            throw new \Exception("Error loading Handler: [$File], The Handler is not found!", 1); }
          }

          $className = Load::getClassNameFromFile($TruePath);
          if (class_exists($className)){ throw new \Exception("Handler: [$File] is already loaded, Cannot load it twice.", 1); }
          require $TruePath;
          //-------------------------------------------------------------------
          if ($setOwner != false && is_object($setOwner)){
          if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }
          $clName = Load::getClassNameFromFile($TruePath); $OwnerObject = $clName;
          $namespace = Load::getClassNamespaceFromFile($TruePath);
          $realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
          if (!empty($newName)) { $OwnerObject = $newName;  }
          if ($args != false && is_array($args)){
          $refClass = new ReflectionClass($realClassName);
          $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
          } else { $setOwner->$OwnerObject = new $realClassName; } }
         // ----------------------------------------------------------------
         Runtime::Report('handler', $className, $TruePath);
        }
      catch (Exception $e) { throw new \Exception("Error Processing [Handler] On Loader: " .$e->getMessage(), 1); }
    }


		public static function model($File, $setOwner = false, $args = false, $newName = "") {
			$path = BASEPATH.'/Application/Resources/Models/';
      if (!is_dir($path)){ throw new \Exception("The Models Folder does not exist in the main Application dir.", 90); return false; }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
			$TruePath = $path.$File;
			if (!file_exists($TruePath)){ throw new \Exception("Error loading model: [$File], The model is not found!", 1); }
			$className = Load::getClassNameFromFile($TruePath);
			if (class_exists($className)){ throw new \Exception("Model: [$File] is already loaded, Cannot load it twice.", 1); }
			require $TruePath;
			//-------------------------------------------------------------------
      if ($setOwner != false && is_object($setOwner)){
      if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }
      $clName = Load::getClassNameFromFile($TruePath); $OwnerObject = $clName;
			$namespace = Load::getClassNamespaceFromFile($path.$File);
			$realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
      } else { $setOwner->$OwnerObject = new $realClassName; } }
     // ----------------------------------------------------------------
		 Runtime::Report('model', $className, $TruePath);
		}


    public static function library($File, $setOwner = false, $args = false, $newName = "") {
			$path = ENVCORE.'/Ecosystem/Libraries/';
      $InternalPath = BASEPATH.'Application/Misc/Libraries/';
      if (!is_dir($path)){ throw new \Exception("The Libraries Folder does not exist in the main Application dir.", 90); return false; }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
			$TruePath = $path.$File;
			if (!file_exists($TruePath)){
          if (file_exists($InternalPath.$File)) { $TruePath = $InternalPath.$File; }else {
        throw new \Exception("Error loading Library: [$File], The Library is not found!", 1); }
      }

			$className = Load::getClassNameFromFile($TruePath);
			if (class_exists($className)){ throw new \Exception("Library: [$File] is already loaded, Cannot load it twice.", 1); }
			require $TruePath;
			//-------------------------------------------------------------------
      if ($setOwner != false && is_object($setOwner)){
      if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }
      $clName = Load::getClassNameFromFile($TruePath); $OwnerObject = $clName;
			$namespace = Load::getClassNamespaceFromFile($TruePath);
			$realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
      } else { $setOwner->$OwnerObject = new $realClassName; } }
     // ----------------------------------------------------------------
		 Runtime::Report('library', $className, $TruePath);
		}

    public static function helper($File, $setOwner = false, $args = false, $newName = "") {
			$path = ENVCORE.'/Ecosystem/Helpers/';
      $InternalPath = BASEPATH.'Application/Misc/Helpers/';
      if (!is_dir($path)){ throw new \Exception("The Helpers Folder does not exist in the main Core dir.", 90); return false; }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
			$TruePath = $path.$File;
			if (!file_exists($TruePath)){
          if (file_exists($InternalPath.$File)) { $TruePath = $InternalPath.$File; }else {
        throw new \Exception("Error loading Helper: [$File], The Helper is not found!", 1); }
      }
			require $TruePath;
		 Runtime::Report('helper', $File, $TruePath);
		}



    public static function driver($File, $setOwner = false, $args = false, $newName = "") {
			$path = ENVCORE.'/Ecosystem/Drivers/';
      $InternalPath = BASEPATH.'Application/Misc/Drivers/';
      if (!is_dir($path)){ throw new \Exception("The Drivers Folder does not exist in the main Core dir.", 90); return false; }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
			$TruePath = $path.$File;
			if (!file_exists($TruePath)){
          if (file_exists($InternalPath.$File)) { $TruePath = $InternalPath.$File; }else {
        throw new \Exception("Error loading Helper: [$File], The Driver is not found!", 1); }
      }

			$className = Load::getClassNameFromFile($TruePath);
			if (class_exists($className)){ throw new \Exception("Driver: [$File] is already loaded, Cannot load it twice.", 1); }
			require $TruePath;
			//-------------------------------------------------------------------
      if ($setOwner != false && is_object($setOwner)){
      if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }
      $clName = Load::getClassNameFromFile($TruePath); $OwnerObject = $clName;
			$namespace = Load::getClassNamespaceFromFile($TruePath);
			$realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
      } else { $setOwner->$OwnerObject = new $realClassName; } }
     // ----------------------------------------------------------------
		 Runtime::Report('Driver', $className, $TruePath);
		}

    public static function hook($File, $setOwner = false, $args = false, $newName = "") {
			$path = ENVCORE.'/Ecosystem/Hooks/';
      $InternalPath = BASEPATH.'Application/Misc/Hooks/';
      if (!is_dir($path)){ throw new \Exception("The Hooks Folder does not exist in the main Core dir.", 90); return false; }
      if (!Contains($File, '.php')){ $File = $File.".php"; }
			$TruePath = $path.$File;
			if (!file_exists($TruePath)){
          if (file_exists($InternalPath.$File)) { $TruePath = $InternalPath.$File; }else {
        throw new \Exception("Error loading Hook: [$File], The Hook is not found!", 1); }
      }

			$className = Load::getClassNameFromFile($TruePath);
			if (class_exists($className)){ throw new \Exception("Hook: [$File] is already loaded, Cannot load it twice.", 1); }
			require $TruePath;
			//-------------------------------------------------------------------
      if ($setOwner != false && is_object($setOwner)){
      if (!is_array($args) && $args != false && $args != true){ $newName = $args; $args = false; }
      $clName = Load::getClassNameFromFile($TruePath); $OwnerObject = $clName;
			$namespace = Load::getClassNamespaceFromFile($TruePath);
			$realClassName = (class_exists($namespace."\\".$clName)) ? $namespace."\\".$clName : $clName;
      if (!empty($newName)) { $OwnerObject = $newName;  }
      if ($args != false && is_array($args)){
      $refClass = new ReflectionClass($realClassName);
      $setOwner->$OwnerObject = $refClass->newInstanceArgs($args);
      } else { $setOwner->$OwnerObject = new $realClassName; } }
     // ----------------------------------------------------------------
		 Runtime::Report('hook', $className, $TruePath);
		}

    public static function getClassFullNameFromFile($filePathName) {
            return Load::getClassNamespaceFromFile($filePathName) . '\\' . Load::getClassNameFromFile($filePathName);
    }

    public static function getClassObjectFromFile($filePathName) {
          $classString = Load::getClassFullNameFromFile($filePathName);
          $object = new $classString;
          return $object;
    }

    public static function getClassNamespaceFromFile($filePathName) {
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

    public static function getClassNameFromFile($filePathName) {
      $php_code = file_get_contents($filePathName);
      $classes = array();
      $tokens = token_get_all($php_code);
      $count = count($tokens);
      for ($i = 2; $i < $count; $i++) {
        if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
            $class_name = $tokens[$i][1];
            $classes[] = $class_name;
              }
            }
            return $classes[0];
    }


  }

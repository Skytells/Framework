<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.9
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */

 abstract class SFInternalPath {
     const APP = APPBASE;
     const CORE = COREDIRNAME;
     const STORAGE = APP_STORAGE_DIR;
     const CACHE = APP_STORAGE_DIR.'Cache/';
     const HELPERS = APPBASE.'Misc/Helpers/';
     const HANDLERS = APPBASE.'Misc/Handlers/';
     const LIBRARIES = APPBASE.'Misc/Libraries/';
     const PACKAGES = APPBASE.'Misc/Packages/';
     const PHRASES = APPBASE.'Misc/Phrases/';
     const PROVIDERS = APPBASE.'Misc/Providers/';
     const MISC = APP_MISC_DIR;
     const SFPUBLIC = APPBASE.'Public/';
 }

 function getPath($path) {
   return $path;
 }

 function appPath() { return getPath(SFInternalPath::APP); }
 function corePath() { return getPath(SFInternalPath::CORE); }
 function cachePath() { return getPath(SFInternalPath::CACHE); }

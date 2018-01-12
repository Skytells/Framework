<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.6
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
global $dbconfig;
 if (!class_exists('SQLManager')) {
    require __DIR__.'/SQLManager.php';
 }

 if ($dbconfig['DBOBJECT'] == TRUE && !class_exists('DBObject')) {
 require __DIR__.'/DBObject.php'; }

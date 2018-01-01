<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.4
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Core;
 use Skytells\Core\Runtime;
 Class Console extends Runtime {

   public static function log($EVENT) {
     if (DEVELOPMENT_MODE !== TRUE) { return false; }
     global $Framework;
     $ProccessID = rand(1111,9999);
     $Framework['Runtime']['All'][] = Array('ProccessID' => $ProccessID, 'Type' => 'cLog', 'Message' => $EVENT, 'Timestamp' => microtime(true));
     $Framework['Runtime']['Console'][] = Array('ProccessID' => $ProccessID, 'Type' => 'cLog', 'Message' => $EVENT, 'Timestamp' => microtime(true));
   }

   public static function logEvent($EVENT, $Message) {
     if (DEVELOPMENT_MODE !== TRUE) { return false; }
     global $Framework;
     $ProccessID = rand(1111,9999);
     $Framework['Runtime']['All'][] = Array('ProccessID' => $ProccessID, 'Type' => 'cLog', 'Message' => $EVENT.':'.$Message, 'Timestamp' => microtime(true));
     $Framework['Runtime']['Console'][] = Array('ProccessID' => $ProccessID, 'Type' => 'cLog', 'Message' => $EVENT.':'.$Message, 'Timestamp' => microtime(true));
   }

 }

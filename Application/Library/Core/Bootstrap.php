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
 Namespace Skytells\Core;
 Class Bootstrap
 {
   private static $Services = [];
   public static function Powerup() {
     try {
       if (!empty(Bootstrap::$Services))
       foreach (Bootstrap::$Services as $Service) {
         \Kernel::Import($Service.".php");
       }
       return true;
     } catch (Exception $e) {
       throw new Exception($e->getMessage(), 1);

     }

   }

   public static function addService($Name) {
     try {
       array_push(Bootstrap::$Services, $Name);
     } catch (Exception $e) {
       throw new Exception($e->getMessage(), 1);

     }

   }

 }

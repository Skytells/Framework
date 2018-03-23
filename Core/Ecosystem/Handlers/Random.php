<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 3.8
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
 Namespace Skytells\Handlers;
  Class Random {

    /**
     * @method Serial
     * @description Generates a Product Serial
     * @param $Size (Array)
     * @param $tokens
     * @param $Splitter
     * @return string
     */
    public static function Serial($Size = [4,5], $Splitter = '-', $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
      if (!is_array($Size) && count($Size) != 2) {
        throw new \ErrorException("The first parameter (size) for the genSerial method needs to be array which contains the size of the tokens (ex. [3,5])", 1);
      }
      $serial = '';
      for ($i = 0; $i < $Size[0]; $i++) {
          for ($j = 0; $j < $Size[1]; $j++) {
              $serial .= $tokens[rand(0, 35)];
          }
          if ($i < $Size[0]-1) { if ($Splitter != false) { $serial .= $Splitter; } }
      }
      return $serial;
    }

    /**
     * @method String
     * @description Generates an string
     * @param $length (int)
     * @param $characters string
     * @return string
     */
    public static function String($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    /**
     * @method Number
     * @description Generates a random number
     * @param $Size (int)
     * @return int
     */
    public static function Number($Size = 10) {
      $random_number='';
       $count=0;
       while ($count < $Size ) {
               $random_digit = mt_rand(0, 9);
               $random_number .= $random_digit;
               $count++;
       }
       return $random_number;
    }


  }

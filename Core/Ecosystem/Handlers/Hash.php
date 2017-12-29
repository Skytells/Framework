<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 3.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
Namespace Skytells\Handlers;
Class Hash {
    const DEFAULT_WORK_FACTOR = 8;
    public static function make($password, $work_factor = 0)
    {
        if (version_compare(PHP_VERSION, '5.3') < 0) throw new Exception('Bcrypt requires PHP 5.3 or above');
        if (! function_exists('openssl_random_pseudo_bytes')) {
            throw new Exception('Bcrypt requires openssl PHP extension');
        }
        if ($work_factor < 4 || $work_factor > 31) $work_factor = self::DEFAULT_WORK_FACTOR;
        $salt =
            '$2a$' . str_pad($work_factor, 2, '0', STR_PAD_LEFT) . '$' .
            substr(
                strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+', '.'),
                0, 22
            )
        ;
        return crypt($password, $salt);
    }
    public static function check($password, $stored_hash, $legacy_handler = NULL)
    {
        if (version_compare(PHP_VERSION, '5.3') < 0) throw new Exception('Bcrypt requires PHP 5.3 or above');
        if (self::is_legacy_hash($stored_hash)) {
            if ($legacy_handler) return call_user_func($legacy_handler, $password, $stored_hash);
            else throw new Exception('Unsupported hash format');
        }
        return crypt($password, $stored_hash) == $stored_hash;
    }

    public static function verify($password, $stored_hash, $legacy_handler = NULL) {
      return Hash::check($password, $stored_hash, $legacy_handler);
    }

    public static function is_legacy_hash($hash) { return substr($hash, 0, 4) != '$2a$'; }
}

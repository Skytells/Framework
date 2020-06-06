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

 /**
 * is_empty
 *
 * @param string $value
 * @return boolean
 */
function is_empty($value) {
    if(strlen(trim(preg_replace('/\xc2\xa0/',' ',$value))) == 0) {
        return true;
    } else {
        return false;
    }
}


/**
 * valid_email
 *
 * @param string $email
 * @return boolean
 */
function valid_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    } else {
        return false;
    }
}


/**
 * valid_url
 *
 * @param string $url
 * @return boolean
 */
function valid_url($url) {
    if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false) {
        return true;
    } else {
        return false;
    }
}


/**
 * valid_username
 *
 * @param string $username
 * @return boolean
 */
function valid_username($username) {
    if(strlen($username) >= 3 && preg_match('/^[a-zA-Z0-9]+([_|.]?[a-zA-Z0-9])*$/', $username)) {
        return true;
    } else {
        return false;
    }
}


/**
 * valid_name
 *
 * @param string $name
 * @return boolean
 */
function valid_name($name) {
    if(preg_match("/^[\\p{L} ]+$/ui", $name)) {
        return true;
    } else {
        return false;
    }
}


/**
 * valid_location
 *
 * @param string $location
 * @return boolean
 */
function valid_location($location) {
    if(preg_match("/^[\\p{L} ,]+$/ui", $location)) {
        return true;
    } else {
        return false;
    }
}



/**
 * valid_extension
 *
 * @param string $extension
 * @param string $allowed_extensions
 * @return boolean
 */
function valid_extension($extension, $allowed_extensions) {
    $extensions = explode(',', $allowed_extensions);
    foreach ($extensions as $key => $value) {
        $extensions[$key] = strtolower(trim($value));
    }
    if(is_array($extensions) && in_array($extension, $extensions)) {
        return true;
    }
    return false;
}


/**
 * isAjax
 *
 * @return bool
 */
function isAjax() {
    if( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) || ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') ) {
      return false;
    }
    return true;
}

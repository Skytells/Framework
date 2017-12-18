<?

// ALLOW TEMINAL ( In Development Mode Only. )
$Settings["ALLOW_TERMINAL"] = TRUE;

// Disable login (don't ask for credentials, be careful)
// Example: $NO_LOGIN = true;
$CLI_CONFIG["NO_LOGIN"] = false;

// Single-user credentials
// Example: $USER = 'user'; $PASSWORD = 'password';
$CLI_CONFIG["USERNAME"] = "root";
$CLI_CONFIG["PASSWORD"] = "0000";

// Multi-user credentials
// Example: $ACCOUNTS = array('user1' => 'password1', 'user2' => 'password2');
$CLI_CONFIG["ACCOUNTS"] = Array();



// Password hash algorithm (password must be hashed)
// Example: $PASSWORD_HASH_ALGORITHM = 'md5';
//          $PASSWORD_HASH_ALGORITHM = 'sha256';
$CLI_CONFIG["PASSWORD_HASH_ALGORITHM"] = '';

// Home directory (multi-user mode supported)
// Example: $HOME_DIRECTORY = '/tmp';
//          $HOME_DIRECTORY = array('user1' => '/home/user1', 'user2' => '/home/user2');
$CLI_CONFIG["HOME_DIRECTORY"] = '';

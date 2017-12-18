<?
/** ------------------- [ Firewall Settings ] ---------------------------------- */

// If Firewall Module is Enabled.


// TURN FIREWALL ON or OFF
 $Firewall['ENABLED'] = TRUE;

// THIS OPTION SECURES THE URIS BEFORE IT BEING PROCESSED BY THE CONTROLLER.
 $Firewall['SECURE_URIS'] = TRUE;
 $Firewall['ALLOWED_CHARS'] = '/[^a-z0-9-=&#_]+/i';


// Check Browser before accessing the website.
 $Firewall["FCHECK_BROWSER"] = TRUE;
 $Firewall["STRONG_ENC_KEY"] = "vDx$2S0@cVk-w#";



 // AntiDDoS
  $Firewall["FIREWALL_ANTI_DDOS"] = TRUE;
  $Firewall["FIREWALL_ANTI_DDOS_INTERVAL"] = 1;



// Some Libraries may asks for a permission to skip the Checkpoint, URI Checks,
// We're strongly recommending to add the (password) validation routes into the whitelisted uris.
 $Firewall["WHITELISTED"] = Array();

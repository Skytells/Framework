<?

/** ------------------- [ Firewall Settings ] ---------------------------------- */

  // If Firewall Module is Enabled.
  $Settings["FIREWALL_ANTI_DDOS"] = TRUE;
  $Settings["FIREWALL_ANTI_DDOS_INTERVAL"] = 1;

  // Check Browser before accessing the website.
  $Settings["FCHECK_BROWSER"] = TRUE;
  $Settings["STRONG_ENC_KEY"] = "vDx$2S0@cVk-w#";

  // Some Libraries may asks for a permission to skip the Checkpoint.
  $Firewall["WHITELISTED"] = Array("http://localhost/Framework/static_route");

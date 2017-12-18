<?
function QRCode($data, $type = "TXT", $size ='150', $ec='L', $margin='0')
{
   $types = array("URL" => "http://", "TEL" => "TEL:", "TXT" => "", "EMAIL" => "MAILTO:");
  if(!in_array($type,array("URL", "TEL", "TXT", "EMAIL")))
  {
      $type = "TXT";
  }
  if (!preg_match('/^'.$types[$type].'/', $data))
  {
      $data = str_replace("\\", "", $types[$type]).$data;
  }
  $ch = curl_init();
  $data = urlencode($data);
  curl_setopt($ch, CURLOPT_URL, 'http://chart.apis.google.com/chart');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'chs='.$size.'x'.$size.'&cht=qr&chld='.$ec.'|'.$margin.'&chl='.$data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);

  $response = curl_exec($ch);

  curl_close($ch);
  return $response;
}

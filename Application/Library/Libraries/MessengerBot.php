<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.1.0
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */
  Class MessengerBot
  {
    protected $AccessToken;
    private   $verify_token;
    protected $Responses = array("Hi" => "Hello!", "name" => "My name is Skytells Framework!", "programming lan" => "My programming language is PHP <3 !", "made you" => "Dr. Hazem Ali, His my father!");
    private   $hub_verify_token = null;
    private   $DefaultReply = "Huh!, I did not get that!";
    function __construct($_accesstoken, $VerificationToken = "skytells_framework")
    {
      if (!isset($_accesstoken) || empty($_accesstoken)) {
        throw new ErrorException("Initialization Error: This Library needs to be intialized with the Facebook AccessToken", 0);
        return false;
      }
      if (!isset($VerificationToken) || empty($VerificationToken)) {
        throw new ErrorException("Initialization Error: This Library needs to be intialized with the Facebook AccessToken and Verification Token", 0);
        return false;
      }
      $this->AccessToken = $_accesstoken;
      $this->verify_token = $VerificationToken;

    }

    public function setDefaultReply($Reply)
    {
      if (!isset($Reply)){
        throw new ErrorException("Default Reply parameter is missing!", 1);
      }
      if (is_array($Reply) || is_object($Reply)){
        throw new ErrorException("The default reply cannot be Array or Object.", 1);

      }
      $this->DefaultReply = $Reply;
      return true;
    }
    public function setReplies($_array_of_replies)
    {
      if (!is_array($_array_of_replies)){
        throw new ErrorException("The replies must be an array", 1);

      }
      $this->Responses = $_array_of_replies;
      return true;
    }


    public function run()
    {
      if (isset($_REQUEST['hub_challenge'])) {
            $challenge = Request("hub_challenge");
            $hub_verify_token = Request("hub_verify_token");
            if ($hub_verify_token === $this->verify_token) {
                echo $challenge;
            }
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
        $message = $input['entry'][0]['messaging'][0]['message']['text'];
        $message_to_reply = '';
           if (isset($message) && !empty($message)){
             $message = strtolower($message);
             $is_responded = false;
             foreach ($this->Responses as $key => $Reply) {
               $key = strtolower($key);
               if(!empty($Reply)){

                 if (strpos($key, $message) !== false){
                   return $this->sendReply($input, $sender, $Reply);

                 }
               }
             }
           }

        return $this->sendReply($input, $sender, $this->DefaultReply);
    }


    function sendReply($input, $sender, $message_to_reply)
    {
      try {
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$this->AccessToken;

        $ch = curl_init($url);

        $jsonData = '{
            "recipient":{
                "id":"'.$sender.'"
            },
            "message":{
                "text":"'.$message_to_reply.'"
            }
        }';

        $jsonDataEncoded = $jsonData;

        curl_setopt($ch, CURLOPT_POST, 1);
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        //Execute the request
        if(!empty($input['entry'][0]['messaging'][0]['message'])){
            $result = curl_exec($ch);
        }
        return true;
      } catch (Exception $e) {
        throw new Exception($e->getMessage(), 1);

      }


    }

  }

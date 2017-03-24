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

  Class FacebookClient
  {
    private $Accesstoken = null;
    function __construct($_AccessToken = "")
    {
      if (!isset($_AccessToken) || empty($_AccessToken))
        {
          throw new Exception("The Facebook AccessToken is required for this Engine.", 0);
        }
        $this->Accesstoken = $_AccessToken;
    }


    public function get($value)
    {
      if (!isset($value) || empty($value))
        {
          throw new Exception("This method needs to be performed with parameters", 0);
        }

        return HttpRequest("https://graph.facebook.com/{$value}?access_token={$this->Accesstoken}", null, "GET");
    }


    public function post($target, $postData)
      {
        if (!isset($target) || empty($target))
          {
            throw new Exception("This method needs to be performed with parameters", 0);
          }

        if (!isset($postData) || empty($postData))
          {
            throw new Exception("This method needs to be performed with parameters", 0);
          }

          return HttpRequest("https://graph.facebook.com/?access_token={$this->Accesstoken}", $value, "POST");
      }


    public function getAccountDetails()
    {
      return $this->get("me");
    }


    public function getHomeFeed()
    {
      return $this->get("me/feed");
    }


    public function getMyPosts()
    {
      return $this->get("me/posts");
    }


    public function like($object_id)
    {
      return $this->post($object_id."/likes");
    }


  }

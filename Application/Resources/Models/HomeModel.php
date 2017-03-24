<?php

  /**
   *
   */
  Class HomeModel extends Model
  {

    function __construct()
      {
        // Get Parent..
        parent::__construct();

        // Report model to the Console for Debugging..
        $this->console->writeln("Home Model is Called!");
      }


    public function getUsers()
    {
    
      return $this->db->get("users"); // Get the First 2 Rows from Users Table in Database.
    }

  }

<?
    /**
    *-------------------------- [ CONTROLLERS ROUTING ] ------------------------------------------\
    * The default controller is the default controller for your project.
    * By another words, it's the main home page for your MVC project.
    * @param DEFAULT_CONTROLLER : is the main controller name in (Controllers) folder.
    * @param DEFAULT_METHOD : is the default function in your home controller that will
    * be automatically Initialized by default when the controller being called.
    *--------------------------------------------------------------------------------------------*/
    $Routes["CONFIG"]["DEFAULT_CONTROLLER"] = "Home"; // -> The main controller.
    $Routes["CONFIG"]["DEFAULT_METHOD"] = "index"; // -> the main method.


    /**
     * @param INIT_DEFALUT_METHOD_AUTOMATICALLY
     * If TRUE, The Framework will automatically Initialize the default method which defined in
     * the DEFAULT_METHOD option for each controller if the request goes to the controller it self.
     * eg. : localhost/YOURCONTROLLER will react like localhost/YOURCONTROLLER/index (DEFAULT_METHOD)
     * @see : BY TURNING THIS METHOD TO (TRUE) YOUR FUNCTION SHOULD'NT CONTAINS AN ARGUMENTS,
     * OR YOU HAVE TO SET THE DEFAULT VALUES FOR YOUR DEFAULT METHOD'S ARGUMENTS.
     */
    $Routes["CONFIG"]["INIT_DEFALUT_METHOD_AUTOMATICALLY"] = TRUE;



    /**
     * ---------------------------- [ Static Routing ] ---------------------------------------------
     * Map a route to a target
     *
     * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
     * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
     * @param mixed $target The target where this route should point to. Can be anything.
     * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
     */
     /**  (*)             // Match all request URIs
     [i]                  // Match an integer
     [i:id]               // Match an integer as 'id'
     [a:action]           // Match alphanumeric characters as 'action'
     [h:key]              // Match hexadecimal characters as 'key'
     [:action]            // Match anything up to the next / or end of the URI as 'action'
     [create|edit:action] // Match either 'create' or 'edit' as 'action'
     [*]                  // Catch all (lazy, stops at the next trailing slash)
     [*:trailing]         // Catch all as 'trailing' (lazy)
     [**:trailing]        // Catch all (possessive - will match the rest of the URI)
     .[:format]?          // Match an optional parameter 'format' - a / or . before the block is also optional
     * --------------------------------------------------------------------------------------*/

     
     Router::map('GET|POST', "/static_route", function() { $home = new Home(); $home->index(); });

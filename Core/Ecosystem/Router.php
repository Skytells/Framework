<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.8
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */
	Class Router  {
		/**
		 * @var array Array of all routes (incl. named routes).
		 */
		static $routes = array();
		/**
		 * @var array Array of all named routes.
		 */
		static $namedRoutes = array();
		/**
		 * @var string Can be used to ignore leading part of the Request URL (if main file lives in subdirectory of host)
		 */
		static $basePath = '';
		/**
		 * @var array Array of default match types (regex helpers)
		 */
		static protected $matchTypes = array(
			'i'  => '[0-9]++',
			'a'  => '[0-9A-Za-z]++',
			'h'  => '[0-9A-Fa-f]++',
			'*'  => '.+?',
			'**' => '.++',
			''   => '[^/\.]++'
		);
		/**
		  * Create router in one call from config.
		  *
		  * @param array $routes
		  * @param string $basePath
		  * @param array $matchTypes
		  */
			public function __construct( $routes = array(), $basePath = '', $matchTypes = array() ) {
					Router::addRoutes($routes);
					Router::setBasePath($basePath);
					Router::addMatchTypes($matchTypes);
				}
			public static function Init($routes = array(), $basePath = '', $matchTypes = array() ){
				Router::addRoutes($routes);

				Router::setBasePath($basePath);
				Router::addMatchTypes($matchTypes);
			}
		/**
		 * Retrieves all routes.
		 * Useful if you want to process or display routes.
		 * @return array All routes.
		 */
		public static function getRoutes() {
			return Router::$routes;
		}
		/**
		 * Add multiple routes at once from array in the following format:
		 *
		 *   $routes = array(
		 *      array($method, $route, $target, $name)
		 *   );
		 *
		 * @param array $routes
		 * @return void
		 * @author Koen Punt
		 * @throws Exception
		 */
		public static function addRoutes($routes){
			if(!is_array($routes) && !$routes instanceof Traversable) {
				throw new \Exception('Routes should be an array or an instance of Traversable');
			}
			foreach($routes as $route) {
				call_user_func_array(array('Router', 'map'), $route);

			}
		}
		/**
		 * Set the base path.
		 * Useful if you are running your application from a subdirectory.
		 */
		public static function setBasePath($basePath) {
			if ($basePath == '!') { $basePath = ''; }
			Router::$basePath = $basePath;
		}
		/**
		 * Add named match types. It uses array_merge so keys can be overwritten.
		 *
		 * @param array $matchTypes The key is the name and the value is the regex.
		 */
		public static function addMatchTypes($matchTypes) {
			Router::$matchTypes = array_merge(Router::$matchTypes, $matchTypes);
		}
		/**
		 * Map a route to a target
		 *
		 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
		 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
		 * @param mixed $target The target where this route should point to. Can be anything.
		 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
		 * @throws Exception
		 */
		public static function map($method, $route, $target, $name = null) {
			Router::$routes[] = array($method, $route, $target, $name);
			if($name) {
				if(isset(Router::$namedRoutes[$name])) {
					throw new \Exception("Can not redeclare route '{$name}'");
				} else {
					Router::$namedRoutes[$name] = $route;
				}
			}
			return;
		}
		public static function endsWith($haystack, $needle)
		{
		    $length = strlen($needle);
		    if ($length == 0) {
		        return true;
		    }

		    return (substr($haystack, -$length) === $needle);
		}
		public static function assign($route, $Target, $methodArgs = false, $RequestMethod = 'GET|POST')  {
			if (is_array($route)) {
				foreach ($route as $r) {
					Router::map($RequestMethod, $r, function() use($Target, $methodArgs){
						if (strpos($Target, '@') !== false) {
							$Target = explode('@', $Target);
							if ($methodArgs !== false) {
								Boot::Controller($Target[0], $Target[1], $methodArgs);
							}else {
								Boot::Controller($Target[0], $Target[1]);
							}
						}
					});
				}
			}else{
				Router::map($RequestMethod, $route, function() use($Target, $methodArgs){

					if (strpos($Target, '@') !== false) {
						$Target = explode('@', $Target);
						if ($methodArgs !== false) {
							Boot::Controller($Target[0], $Target[1], $methodArgs);
						}else {
							Boot::Controller($Target[0], $Target[1]);
						}
					}
				});
			}

		}
		/**
		 * Reversed routing
		 *
		 * Generate the URL for a named route. Replace regexes with supplied parameters
		 *
		 * @param string $routeName The name of the route.
		 * @param array @params Associative array of parameters to replace placeholders with.
		 * @return string The URL of the route with named parameters in place.
		 * @throws Exception
		 */
		public static function generate($routeName, array $params = array()) {
			// Check if named route exists
			if(!isset(Router::$namedRoutes[$routeName])) {
				throw new \Exception("Route '{$routeName}' does not exist.");
			}
			// Replace named parameters
			$route = Router::$namedRoutes[$routeName];
			// prepend base path to route url again
			$url = Router::$basePath . $route;
			if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
				foreach($matches as $match) {
					list($block, $pre, $type, $param, $optional) = $match;
					if ($pre) {
						$block = substr($block, 1);
					}
					if(isset($params[$param])) {
						$url = str_replace($block, $params[$param], $url);
					} elseif ($optional) {
						$url = str_replace($pre . $block, '', $url);
					}
				}
			}
			return $url;
		}
		/**
		 * Match a given Request Url against stored routes
		 * @param string $requestUrl
		 * @param string $requestMethod
		 * @return array|boolean Array with route information on success, false on failure (no match).
		 */
		public static function match($requestUrl = null, $requestMethod = null) {
			$params = array();
			$match = false;
			// set Request Url if it isn't passed as parameter
			if($requestUrl === null) {
				$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
			}
			// strip base path from request url
			$requestUrl = substr($requestUrl, strlen(Router::$basePath));
			// Strip query string (?a=b) from Request Url
			if (($strpos = strpos($requestUrl, '?')) !== false) {
				$requestUrl = substr($requestUrl, 0, $strpos);
			}
			// set Request Method if it isn't passed as a parameter
			if($requestMethod === null) {
				$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
			}
			foreach(Router::$routes as $handler) {
				list($methods, $route, $target, $name) = $handler;
				$method_match = (stripos($methods, $requestMethod) !== false);
				// Method did not match, continue to next route.
				if (!$method_match) continue;
				if ($route === '*') {
					// * wildcard (matches all)
					$match = true;
				} elseif (isset($route[0]) && $route[0] === '@') {
					// @ regex delimiter
					$pattern = '`' . substr($route, 1) . '`u';
					$match = preg_match($pattern, $requestUrl, $params) === 1;
				} elseif (($position = strpos($route, '[')) === false) {
					// No params in url, do string comparison
					$match = strcmp($requestUrl, $route) === 0;
				} else {
					// Compare longest non-param string with url
					if (strncmp($requestUrl, $route, $position) !== 0) {
						continue;
					}
					$regex = Router::compileRoute($route);
					$match = preg_match($regex, $requestUrl, $params) === 1;
				}
				if ($match) {
					if ($params) {
						foreach($params as $key => $value) {
							if(is_numeric($key)) unset($params[$key]);
						}
					}
					return array(
						'target' => $target,
						'params' => $params,
						'name' => $name
					);
				}
			}
			return false;
		}
		/**
		 * Compile the regex for a given route (EXPENSIVE)
		 */
		private static function compileRoute($route) {
			if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
				$matchTypes = Router::$matchTypes;
				foreach($matches as $match) {
					list($block, $pre, $type, $param, $optional) = $match;
					if (isset($matchTypes[$type])) {
						$type = $matchTypes[$type];
					}
					if ($pre === '.') {
						$pre = '\.';
					}
					//Older versions of PCRE require the 'P' in (?P<named>)
					$pattern = '(?:'
							. ($pre !== '' ? $pre : null)
							. '('
							. ($param !== '' ? "?P<$param>" : null)
							. $type
							. '))'
							. ($optional !== '' ? '?' : null);
					$route = str_replace($block, $pattern, $route);
				}
			}
			return "`^$route$`u";
		}
	}

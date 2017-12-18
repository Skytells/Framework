<?
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version    3.0
 * @copyright  2007-2018 Skytells, Inc. All rights reserved.
 * @license    MIT | https://www.skytells.net/us/terms .
 * @author     Dr. Hazem Ali ( fb.com/Haz4m )
 * @see        The Framework's changelog to be always up to date.
 */

Class Cache {
  public $driver = 'apc';
  protected $_adapter = null;

  function __construct($args = array()) {
    global $Memcache;
    define('MEMCACHED_HOST', $Memcache["Settings"]['HOST']);
    define('MEMCACHED_PORT', $Memcache["Settings"]['PORT']);
    if (!isset($args['driver'])) {
      $this->_adapter = CACHE_DRIVER;
      $driver = CACHE_DRIVER;
     }
     $this->_adapter = $args['driver'];
     $driver = $this->_adapter;
     require __DIR__.'/Adapters/'.$this->_adapter.'.php';
     $this->{$this->_adapter} = new $driver();
  }

  public function get($key = '') {
    try {
      return $this->{$this->_adapter}->get($key);
    } catch (Exception $e) { throw new \Exception($e->getMessage(), $e->getCode()); }
  }


  public function set($key, $data, $ttl = 0, $overwrite = false) {
    try {
      return $this->{$this->_adapter}->set($key, $data, $ttl, $overwrite);
    } catch (Exception $e) { throw new \Exception($e->getMessage(), $e->getCode()); }
  }


  public function delete($id) {
    try {
      return $this->{$this->_adapter}->delete($id);
    } catch (Exception $e) { throw new \Exception($e->getMessage(), $e->getCode()); }
  }


  public function exists($id) {
    try {
      return $this->{$this->_adapter}->exists($id);
    } catch (Exception $e) { throw new \Exception($e->getMessage(), $e->getCode()); }
  }


  public function clear($id) {
    try {
      return $this->{$this->_adapter}->clear($id);
    } catch (Exception $e) { throw new \Exception($e->getMessage(), $e->getCode()); }
  }

  public static function erase() {
    try {
      flush_cache();
    } catch (Exception $e) { throw new \Exception($e->getMessage(), 1); }
  }


}

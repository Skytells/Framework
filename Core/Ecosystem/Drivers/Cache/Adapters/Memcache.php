<?
Class Memcache
{
    protected $memcache;
    public function __construct() {
        $this->memcache = new Memcache;
        $this->memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
    }
    public function set($key, $values = [])
    {
        $this->memcache->set($key, $values);
    }
    public function get($key)
    {
        $cache = $this->memcache->get($key);
        if($cache) return $cache;
        return false;
    }
}

<?

Class APC extends Cache {

    function __construct() {

    }
    /**
     * Retrieves cached information from APC's data store.
     *
     * @param string $type - If $type is "user", information about the user cache will be returned.
     * @param boolean $limited - If $limited is true, the return value will exclude the individual
     *                           list of cache entries. This is useful when trying to optimize calls
     *                           for statistics gathering.
     *
     * @return array of cached data (and meta-data) or false on failure.
     */
    public function info($type = '', $limited = false)
    {
        try {
            return apc_cache_info($type, $limited);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Checks if APC key exists.
     *
     * @param mixed $key - A string, or an array of strings, that contain keys.
     *
     * @return mixed - Returns true if the key exists, otherwise false or if an
     *                 array was passed to keys, then an array is returned that
     *                 contains all existing keys, or an empty array if none exist.
     */
    public function exists($key = '')
    {
        try {
            return apc_exists($key);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Cache a variable in the data store.
     *
     * @param string $key - Store the variable using this name.
     * @param string $data - The variable to store.
     * @param string $ttl - Time To Live; store var in the cache for ttl seconds.
     *
     * @return boolean - Returns true on success or false on failure.
    */
    public function set($key, $data, $ttl = 0, $overwrite = false)
    {
        try {
            if ($overwrite) {
                return apc_store($key, $data, $ttl);
            } else {
                return apc_add($key, $data, $ttl);
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Fetch stored value in APC from key.
     *
     * @param string $key - The key used to store the value.
     *
     * @return boolean - The stored variable or array of variables on success; false on failure.
     */
    public function get($key = '')
    {
        try {
            if (self::exists($key)) {
                return apc_fetch($key);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Removes a stored variable from the cache.
     *
     * @param string $key - The key used to store the value (with apc_store()).
     *
     * @return boolean - Returns true on success or false on failure.
     */
    public function delete($key = '')
    {
        try {
            return apc_delete($key);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Clears the APC cache.
     *
     * @param string $type - If $type is "user", the user cache will be cleared; otherwise,
     *                       the system cache (cached files) will be cleared.
     *
     * @return boolean - Returns true on success or false on failure.
     */
    public function clear($type = '') {
        try {
            return apc_clear_cache($type);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}

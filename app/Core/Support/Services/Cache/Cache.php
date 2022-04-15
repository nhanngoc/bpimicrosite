<?php

namespace App\Core\Support\Services\Cache;

use File;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Arr;

class Cache implements CacheInterface
{
    /**
     * @var string
     */
    public $cacheGroup;
    /**
     * @var CacheManager
     */
    protected $cache;
    /**
     * @var array
     */
    protected $config;

    /**
     * Cache constructor.
     * @param \Illuminate\Cache\Repository|CacheManager $cache
     * @param null $cacheGroup
     * @param array $config
     */
    public function __construct(CacheManager $cache, $cacheGroup, $config = [])
    {
        $this->cache = $cache;
        $this->cacheGroup = $cacheGroup;
        $this->config = !empty($config) ? $config : [
            'cache_time'  => 600,
            'stored_keys' => storage_path('cache_keys.json'),
        ];
    }

    /**
     * Retrieve data from cache.
     *
     * @param string $key Cache item key
     * @return mixed
     */
    public function get($key)
    {
        if (!file_exists($this->config['stored_keys'])) {
            return null;
        }
        return $this->cache->get($this->generateCacheKey($key));
    }

    /**
     * @param $key
     * @return string
     */
    public function generateCacheKey($key)
    {
        return md5($this->cacheGroup) . $key;
    }

    /**
     * Add data to the cache.
     *
     * @param string $key Cache item key
     * @param mixed $value The data to store
     * @param boolean $minutes The number of minutes to store the item
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function put($key, $value, $minutes = false)
    {
        if (!$minutes) {
            $minutes = $this->config['cache_time'];
        }

        $key = $this->generateCacheKey($key);

        $this->storeCacheKey($key);

        $this->cache->put($key, $value, $minutes);

        return true;
    }

    /**
     * Store cache key to file
     *
     * @param $key
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function storeCacheKey($key)
    {
        if (file_exists($this->config['stored_keys'])) {
            $cacheKeys = get_file_data($this->config['stored_keys']);
            if (!empty($cacheKeys) && !in_array($key, Arr::get($cacheKeys, $this->cacheGroup, []))) {
                $cacheKeys[$this->cacheGroup][] = $key;
            }
        } else {
            $cacheKeys = [];
            $cacheKeys[$this->cacheGroup][] = $key;
        }
        save_file_data($this->config['stored_keys'], $cacheKeys);

        return true;
    }

    /**
     * Test if item exists in cache
     * Only returns true if exists && is not expired.
     *
     * @param string $key Cache item key
     * @return bool If cache item exists
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function has($key)
    {
        if (!file_exists($this->config['stored_keys'])) {
            return false;
        }
        $key = $this->generateCacheKey($key);

        return $this->cache->has($key);
    }

    /**
     * Clear cache of an object
     *
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function flush()
    {
        $cacheKeys = [];
        if (file_exists($this->config['stored_keys'])) {
            $cacheKeys = get_file_data($this->config['stored_keys']);
        }
        if (!empty($cacheKeys)) {
            $caches = Arr::get($cacheKeys, $this->cacheGroup);
            if ($caches) {
                foreach ($caches as $cache) {
                    $this->cache->forget($cache);
                }
                unset($cacheKeys[$this->cacheGroup]);
            }
        }
        if (!empty($cacheKeys)) {
            save_file_data($this->config['stored_keys'], $cacheKeys);
        } else {
            File::delete($this->config['stored_keys']);
        }

        return true;
    }
}

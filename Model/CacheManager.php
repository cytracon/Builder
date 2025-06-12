<?php
/**
 * Cytracon
 *
 * This source file is subject to the Cytracon Software License, which is available at https://www.cytracon.com/license
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to https://www.cytracon.com for more information.
 *
 * @category  Cytracon
 * @package   Cytracon_Builder
 * @copyright Copyright (C) 2019 Cytracon (https://www.cytracon.com)
 */

namespace Cytracon\Builder\Model;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\ObjectManager;

class CacheManager
{
    /**
     * Cache group Tag
     */
    const CACHE_GROUP = \Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER;

    /**
     * Cache tag used to distinguish the cache type from all other cache
     */
    const CACHE_TAG   = \Magento\Framework\App\Cache\Type\Config::CACHE_TAG;

    /**
     * Prefix for cache key of block
     */
    const CACHE_KEY_PREFIX = 'CYTRACON_BUILDER_';

    /**
     * @var CacheInterface
     */
    private $_cacheManager;

    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    protected $cacheState;

    /**
     * @var \Cytracon\Core\Helper\Data
     */
    protected $coreHelper;

    /**
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState 
     * @param \Cytracon\Core\Helper\Data                   $coreHelper 
     */
	public function __construct(
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Cytracon\Core\Helper\Data $coreHelper
	) {
        $this->cacheState = $cacheState;
        $this->coreHelper = $coreHelper;
	}

    /**
     * @param  string $key 
     * @return string      
     */
    public function getCacheKey($key)
    {
        return self::CACHE_KEY_PREFIX . $key;
    }

	public function getFromCache($key)
	{
        if ($this->cacheState->isEnabled(self::CACHE_GROUP)) {
            $key = $this->getCacheKey($key);
    		$config = $this->getCacheManager()->load($key);
            if ($config) {
                return $this->coreHelper->unserialize($config);
            }
        }
	}

	public function saveToCache($key, $value)
	{
        if ($this->cacheState->isEnabled(self::CACHE_GROUP)) {
            $key = $this->getCacheKey($key);
    		$this->getCacheManager()->save(
                $this->coreHelper->serialize($value),
                $key,
                [
                    self::CACHE_TAG
                ]
            );
        }
	}

    /**
     * Retrieve cache interface
     *
     * @return CacheInterface
     * @deprecated 101.0.3
     */
    private function getCacheManager()
    {
        if (!$this->_cacheManager) {
            $this->_cacheManager = ObjectManager::getInstance()
                ->get(CacheInterface::class);
        }
        return $this->_cacheManager;
    }
}
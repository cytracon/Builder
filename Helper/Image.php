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

namespace Cytracon\Builder\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;

class Image extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;

    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $_imageFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param \Magento\Framework\App\Helper\Context      $context      
     * @param \Magento\Framework\Filesystem              $filesystem   
     * @param \Magento\Framework\Image\AdapterFactory    $imageFactory 
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager 
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Image\AdapterFactory $imageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_filesystem   = $filesystem;
        $this->_imageFactory = $imageFactory;
        $this->_storeManager = $storeManager;
    }

    /**
     * @param  string  $src           
     * @param  integer $width         
     * @param  integer $height        
     * @param  integer $quality       
     * @param  string  $dir          
     * @return string                 
     */
    public function resize($src, $width = 150, $height = 0, $quality = 100, $dir = 'cytracon/resized', $attributes = [])
    {
        $dir = $dir . '/' . $width;
        if ($height) $dir .= 'x' . $height;
        $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $absPath = $mediaDir->getAbsolutePath($src);
        $imageResized = $mediaDir->getAbsolutePath($dir . '/' . $src);    
        $imageResize  = $this->_imageFactory->create(); 
        $resizedURL   = '';
        if (file_exists($absPath)) {
            $imageResize->open($absPath);
            $imageResize->backgroundColor([255, 255, 255]);
            $imageResize->constrainOnly(true);
            $imageResize->keepTransparency(true);
            $imageResize->keepAspectRatio((isset($attributes['keepAspectRatio']) ? $attributes['keepAspectRatio'] : true));
            if ($height) $imageResize->keepFrame(true);
            $imageResize->quality($quality);
            if ($height) {
                $imageResize->resize($width, $height);    
            } else {
                $imageResize->resize($width);
            }
            $imageResize->save($imageResized);
            $resizedURL = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $dir . '/' . $src;
        }
        return $resizedURL;
    }
}

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

namespace Cytracon\Builder\Controller\Adminhtml\Ajax;

class LoadElement extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Backend\App\Action\Context
     */
    protected $resultRawFactory;

    /**
     * @var \Magento\Store\Model\App\Emulation
     */
    protected $_appEmulation;

    /**
     * @var \Magento\Framework\App\State
     */
    protected $_appState;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Cytracon\Builder\Data\Elements
     */
    protected $elements;

    /**
     * @param \Magento\Backend\App\Action\Context             $context          
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory 
     * @param \Magento\Store\Model\App\Emulation              $appEmulation     
     * @param \Magento\Framework\App\State                    $appState         
     * @param \Magento\Store\Model\StoreManagerInterface      $storeManager     
     * @param \Magento\Framework\Registry                     $registry         
     * @param \Cytracon\Builder\Data\Elements                  $elements         
     * @param \Cytracon\Core\Helper\Data                       $coreHelper       
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Framework\App\State $appState,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Cytracon\Builder\Data\Elements $elements,
        \Cytracon\Core\Helper\Data $coreHelper
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
        $this->_appEmulation    = $appEmulation;
        $this->_appState        = $appState;
        $this->_storeManager    = $storeManager;
        $this->registry         = $registry;
        $this->elements         = $elements;
        $this->coreHelper       = $coreHelper;
    }

    public function execute()
    {
        $this->registry->register('cytracon_builder_loadelement', true);
        $content = '';
        $post = $this->getRequest()->getPostvalue();
        $data = $this->coreHelper->unserialize($post['element']);
        unset($data['component']);
        unset($data['$$hashKey']);
        foreach ($data as $key => &$value) {
            if ($value=='true') $value = 1;
            if ($value=='false') $value = 0;
        }

        $element = $this->elements->getElementModel($data);
        $element->setEnableCache(false);
        $storeId = $this->_storeManager->getDefaultStoreView()->getId();
        $store   = $this->getRequest()->getParam('store_id', $this->_storeManager->getStore($storeId));
        $this->_appEmulation->startEnvironmentEmulation($storeId, \Magento\Framework\App\Area::AREA_FRONTEND, true);
        if ($block = $element->getElementBlock()) {
            $block->setStore($store);
            $content = $this->_appState->emulateAreaCode(
                \Magento\Framework\App\Area::AREA_FRONTEND,
                [$block, 'toHtml']
            );
        }
        $this->_appEmulation->stopEnvironmentEmulation();
    	$resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($content);
    }
}
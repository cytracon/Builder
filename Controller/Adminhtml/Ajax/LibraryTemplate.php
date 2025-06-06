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

class LibraryTemplate extends \Magento\Backend\App\Action
{
    /**
     * @var \Cytracon\Builder\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param \Magento\Backend\App\Action\Context $context    
     * @param \Cytracon\Builder\Helper\Data        $dataHelper 
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Cytracon\Builder\Helper\Data $dataHelper
    ) {
        parent::__construct($context);
        $this->dataHelper = $dataHelper;
    }

    public function execute()
    {
        $result = [];
        $post   = $this->getRequest()->getPostValue();
        if (isset($post['url']) && $post['url']) {
            $result = $this->dataHelper->getTemplates($post['url']);
        }
    	$this->getResponse()->representJson(
            $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($result)
        );
    }
}
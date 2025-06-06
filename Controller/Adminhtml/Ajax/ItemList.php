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

class ItemList extends \Magento\Backend\App\Action
{
    /**
     * @var \Cytracon\Builder\Data\SourcesFactory
     */
    protected $sourcesFactory;

    /**
     * @param \Magento\Backend\App\Action\Context  $context        
     * @param \Cytracon\Builder\Data\SourcesFactory $sourcesFactory 
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Cytracon\Builder\Data\SourcesFactory $sourcesFactory
    ) {
        parent::__construct($context);
        $this->sourcesFactory = $sourcesFactory;
    }

    public function execute()
    {
        $data = [];
        try {
            $post = $this->getRequest()->getPostValue();
            if (isset($post['type']) && $post['type']) {
                $sources = $this->sourcesFactory->create();
                $source  = $sources->getSource($post['type']);
                $field   = isset($post['field']) ? $post['field'] : '';
                if ($source) {
                    $q = isset($post['q']) ? $post['q'] : '';
                    $data = $source->getList($q, $field);
                }
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while processing the request.'));
        }
        $this->getResponse()->representJson(
            $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($data)
        );
        return;
    }
}
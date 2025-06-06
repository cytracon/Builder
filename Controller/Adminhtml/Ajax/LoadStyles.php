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

class LoadStyles extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @var \Cytracon\Core\Helper\Data
     */
    protected $coreHelper;

    /**
     * @var \Cytracon\Builder\Helper\Data
     */
    protected $builderHelper;

    /**
     * @param \Magento\Backend\App\Action\Context   $context       
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory 
     * @param \Cytracon\Core\Helper\Data             $coreHelper    
     * @param \Cytracon\Builder\Helper\Data          $builderHelper 
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Cytracon\Core\Helper\Data $coreHelper,
        \Cytracon\Builder\Helper\Data $builderHelper
    ) {
        parent::__construct($context);
        $this->layoutFactory = $layoutFactory;
        $this->coreHelper    = $coreHelper;
        $this->builderHelper = $builderHelper;
    }

    public function execute()
    {
        $result = [];
        try {
            $html    = '';
            $profile = str_replace('"disable_element":true', '"disable_element":false', $this->getRequest()->getPost('profile'));
            $profile = $this->coreHelper->unserialize($profile);
            if (is_array($profile) && isset($profile['elements']) && is_array($profile['elements'])) {
                $block = $this->layoutFactory->create()->createBlock(\Cytracon\Builder\Block\Profile::class);
                $block->setElements($profile['elements']);
                $html = $block->getStylesHtml();
            }
            if (isset($profile['custom_css'])) {
                $html .= '<style>' . $profile['custom_css'] . '</style>';
            }
            $html .= $this->builderHelper->getConfig('customization/css');
            $result['html']   = $html;
            $result['status'] = true;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
        } catch (\Exception $e) {
            $result['status']  = false;
            $result['message'] = __('Something went wrong while process preview styles.');
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the page.'));
        }
        $this->getResponse()->setBody($this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($result));
    }
}
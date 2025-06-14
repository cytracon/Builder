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

class ConditionsValue extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $result['status'] = false;
        try {
            $post    = $this->getRequest()->getPostValue();
            $options = [];
            parse_str($post['values'], $options);
            $result['value']  = json_encode($options['parameters']['conditions']);
            $result['status'] = true;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $result['message'] = $e->getMessage();
            $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
        } catch (\Exception $e) {
            $result['message'] = __('Something went wrong while process the request.');
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while processing the request.'));
        }
        $this->getResponse()->setBody($this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($result));
    }
}
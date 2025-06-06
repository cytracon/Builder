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

namespace Cytracon\Builder\Data\Element;

class MagentoWidget extends AbstractElement
{
    /**
     * Prepare modal components
     */
    public function prepareForm()
    {
    	parent::prepareForm();
    	$this->prepareMagentoWidgetTab();
    	return $this;
    }

    /**
     * @return Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareMagentoWidgetTab()
    {
    	$magentoWidget = $this->addTab(
            'tab_magento_widget',
            [
                'sortOrder'       => 50,
                'templateOptions' => [
                    'label' => __('Magento Widget')
                ]
            ]
        );

	    	$magentoWidget->addChildren(
	            'magento_widget',
	            'text',
	            [
					'sortOrder'       => 10,
					'key'             => 'magento_widget',
					'templateOptions' => [
						'templateUrl' => 'Cytracon_Builder/js/templates/form/element/magento-widget.html',
						'element'     => 'Cytracon_Builder/js/form/element/magento-widget'
	                ]
	            ]
	        );

    	return $magentoWidget;
    }
}
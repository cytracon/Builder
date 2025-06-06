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

namespace Cytracon\Builder\Data\Modal;

class Shortcode extends \Cytracon\Builder\Data\Element\AbstractElement
{
	public function prepareForm()
    {
    	$general = $this->addTab(
            self::TAB_GENERAL,
            [
                'sortOrder'       => 0,
                'templateOptions' => [
                    'label' => __('General')
                ]
            ]
        );

            $general->addChildren(
                'shortcode',
                'textarea',
                [
                    'sortOrder'       => 10,
                    'key'             => 'shortcode',
                    'templateOptions' => [
                        'rows' => 20,
                        'note' => __('<a href="%1" target="_blank">How to copy page contents between pages/ domains</a>', 'https://blog.cytracon.com/how-to-copy-page-contents-between-pages-domains?utm_campaign=builder&utm_source=userguide&utm_medium=backend')
                    ]
                ]
            );

    	return $this;
    }
}
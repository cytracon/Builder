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

class Text extends AbstractElement
{
    /**
     * @return \Cytracon\Builder\Data\Form\Element\Fieldset
     */
    public function prepareGeneralTab()
    {
        $general = parent::prepareGeneralTab();

            $general->addChildren(
                'content',
                'editor',
                [
                    'sortOrder'       => 10,
                    'key'             => 'content',
                    'defaultValue'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                    'templateOptions' => [
                        'label' => __('Content')
                    ]
                ]
            );

        return $general;
    }
}

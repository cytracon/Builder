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

namespace Cytracon\Builder\Data\Form\Element;

class Date extends AbstractElement
{
    public function _construct()
    {
        $this->setType('date');
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $config = array_replace_recursive([
            'templateOptions' => [
                'element'            => 'Cytracon_Builder/js/form/element/date',
                'templateUrl'        => 'Cytracon_Builder/js/templates/form/element/date.html',
                'wrapperTemplateUrl' => 'Cytracon_Builder/js/templates/form/field.html'
            ]
        ], (array) $this->getData('config'));

        return [
            'config' => $config
        ];
    }
}

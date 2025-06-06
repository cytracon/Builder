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

class UiSelect extends AbstractElement
{
    public function _construct()
    {
        $this->setType('uiselect');
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $_config = $this->getData('config');
        if (isset($_config['templateOptions']['multiple']) && $_config['templateOptions']['multiple'] && !isset($_config['templateOptions']['templateUrl'])) {
            $_config['templateOptions']['templateUrl'] = 'Cytracon_Builder/js/templates/form/element/ui-multiple-select.html';
        }
        
        $config = array_replace_recursive([
            'templateOptions' => [
                'element'            => 'Cytracon_Builder/js/form/element/ui-select',
                'templateUrl'        => 'Cytracon_Builder/js/templates/form/element/ui-select.html',
                'wrapperTemplateUrl' => 'Cytracon_Builder/js/templates/form/field.html',
                'groupBy'            => 'optgroup'
            ]
        ], (array) $_config);

        return [
            'config' => $config
        ];
    }
}
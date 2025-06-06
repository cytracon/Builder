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

class Icon extends AbstractElement
{
    public function _construct()
    {
        $this->setType('icon');
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $_config = (array) $this->getData('config');
        if (isset($_config['className'])) {
            $_config['className'] .= ' mgz-form-element-icon';
        } else {
            $_config['className'] = 'mgz-form-element-icon';
        }

        $config = array_replace_recursive([
            'templateOptions' => [
                'element'            => 'Cytracon_Builder/js/form/element/icon',
                'templateUrl'        => 'Cytracon_Builder/js/templates/form/element/icon.html',
                'groupBy'            => 'group',
                'label'              => __('Icon'),
                'iconLibraryLabel'   => __('Icon Library'),
                'defaultFont'        => 'awesome'
            ]
        ], (array) $_config);

        return [
            'config' => $config
        ];
    }
}

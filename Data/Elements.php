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

namespace Cytracon\Builder\Data;

use \Magento\Framework\App\ObjectManager;

class Elements
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \Cytracon\Builder\Model\ElementFactory
     */
    protected $elementFactory;

    /**
     * @var array
     */
    protected $sortableElements;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Cytracon\Builder\Model\ElementFactory     $elementFactory
     * @param array                                     $elements
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Cytracon\Builder\Model\ElementFactory $elementFactory,
        array $elements = []
    ) {
        $this->elements       = array_merge($this->elements, $elements);
        $this->objectManager  = $objectManager;
        $this->elementFactory = $elementFactory;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        if ($this->sortableElements == null && $this->elements) {
            $elements = $this->elements;
            $sortableElements = [];
            foreach ($elements as $type => $data) {
                if (!isset($data['class'])) {
                    $data['class'] = \Cytracon\Builder\Data\Element\Element::class;
                }
                $element = $this->objectManager->create(
                    $data['class']
                )->setType(
                    $type
                )->addData(
                    $data
                );
                $sortableElements[] = $element;
            }
            usort($sortableElements, function ($a, $b) {
                return $a['sortOrder'] <=> $b['sortOrder'];
            });
            $this->sortableElements = $sortableElements;
        }

        return $this->sortableElements;
    }

    /**
     * @param  string $type
     * @return \Cytracon\Builder\Data\Elements|null
     */
    public function getElement($type)
    {
        $elements = $this->getElements();
        foreach ($elements as $element) {
            if ($element['type'] == $type) {
                return $element;
            }
        }
        return null;
    }

    /**
     * @param  array|object $data
     * @return \Cytracon\Builder\Model\Element
     */
    public function getElementModel($data)
    {
        if (is_array($data)) {
            $element = $this->elementFactory->create();
            $element->setData($data);
        } else {
            $element = $data;
        }
        return $element;
    }
}

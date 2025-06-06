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

use Cytracon\Builder\Data\Form\Element\AbstractElement;
use Cytracon\Builder\Data\Form\Element\Factory;
use Cytracon\Builder\Data\Form\Element\CollectionFactory;

class Form extends \Cytracon\Builder\Data\Form\AbstractForm
{
    /**
     * All form elements collection
     *
     * @var ElementCollection
     */
    protected $_allElements;

    /**
     * @param Factory           $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param array             $data
     */
    public function __construct(
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $data);
        $this->_allElements = $this->_factoryCollection->create(['container' => $this]);
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        $html = '';
        foreach ($this->getElements() as $element) {
            $html .= $element->toHtml();
        }
        return $html;
    }

    /**
     * Add form element
     *
     * @param AbstractElement $element
     * @param bool $after
     * @return $this
     */
    public function addElement(AbstractElement $element, $after = false)
    {
        $this->checkElementId($element->getId());
        parent::addElement($element, $after);
        $this->addElementToCollection($element);
        return $this;
    }

    /**
     * Check existing element
     *
     * @param   string $elementId
     * @return  bool
     */
    protected function _elementIdExists($elementId)
    {
        return isset($this->_elementsIndex[$elementId]);
    }

    /**
     * @param AbstractElement $element
     * @return $this
     */
    public function addElementToCollection($element)
    {
        $this->_elementsIndex[$element->getId()] = $element;
        $this->_allElements->add($element);
        return $this;
    }

    /**
     * @param string $elementId
     * @return bool
     * @throws \Exception
     */
    public function checkElementId($elementId)
    {
        if ($this->_elementIdExists($elementId)) {
            throw new \InvalidArgumentException('Element with id "' . $elementId . '" already exists');
        }
        return true;
    }
}

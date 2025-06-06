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

namespace Cytracon\Builder\Model;

class Element extends \Magento\Framework\DataObject
{
	/**
	 * @var \Cytracon\Builder\Data\Elements
	 */
	protected $_elementsManager;

	/**
	 * @var array
	 */
	protected $_wrapperClasses = [];

	/**
	 * @var \Magento\Framework\View\LayoutInterface
	 */
	protected $layout;

	/**
	 * @var \Cytracon\Builder\Helper\Data
	 */
	protected $dataHelper;

	/**
	 * @var \Cytracon\Builder\Data\Elements
	 */
	protected $elements;

	protected $builderElement;

	protected $_elementBlock;

	/**
	 * @param \Magento\Framework\View\LayoutInterface $layout     
	 * @param \Cytracon\Builder\Helper\Data            $dataHelper 
	 * @param \Cytracon\Builder\Data\Elements          $elements   
	 */
	public function __construct(
        \Magento\Framework\View\LayoutInterface $layout,
		\Cytracon\Builder\Helper\Data $dataHelper,
		\Cytracon\Builder\Data\Elements $elements
	) {
		$this->layout     = $layout;
		$this->dataHelper = $dataHelper;
		$this->elements   = $elements;
	}

    /**
     * @return \Cytracon\Builder\Data\Elements
     */
    public function getElementsManager()
    {
    	if ($this->_elementsManager==NULL) {
    		$this->_elementsManager = $this->elements;
	    }
	    return $this->_elementsManager;
    }

	/**
	 * @param string $class
	 */
	public function addWrapperClasses($class)
	{
		$this->_wrapperClasses[] = $class;
		return $this;
	}

	/**
	 * @var array
	 */
	public function getWrapperClasses()
	{
		return $this->_wrapperClasses;
	}

	/**
	 * @return string
	 */
	public function getHtmlId()
	{
		return $this->getId();
	}

    public function getParallaxId()
    {
    	return $this->getId() . '-p';
    }

    public function getStyleHtmlId()
    {
    	return $this->getId() . '-s';
    }

	/**
	 * @return string
	 */
	public function getBackgroundImage()
	{
		if ($backgroundImage = $this->getData('background_image')) {
			return $this->dataHelper->getImageUrl($backgroundImage);
		}
	}

	/**
	 * @return Cytracon\Builder\Data\Element
	 */
	public function getBuilderElement()
	{
		return $this->getElementsManager()->getElement($this->getType());
	}

    /**
     * @return \Magento\Framework\View\Element\Template
     */
    public function getElementBlock()
    {
    	if ($this->_elementBlock == null) {
			$builderElement = $this->getElementsManager()->getElement($this->getType());
			if ($builderElement) {
				$elemBlock = $builderElement->getBlock();
		        if (!$elemBlock) {
		            $elemBlock = $this->getDefaultBlock();
		        }
		        $data = [
		            'element_id'   => $this->getId(),
		            'element_type' => $this->getType()
		        ];
		        if ($this->getEnableCache()) {
		            $data['enable_cache']   = $this->getEnableCache();
		            $data['cache_lifetime'] = $this->getCacheLifetime();
		        }
		        $block = $this->layout->createBlock($elemBlock, '', [
		            'data' => $data
		        ]);
		        $template = $builderElement->getTemplate();
		        if ($template) {
		            $block->setTemplate($template);
		        };
		        $block->setElement($this);
		        $this->_elementBlock = $block;
		    }
		}
		if ($parent = $this->getParentElement()) {
			$this->_elementBlock->setParentElement($parent);
		}
		return $this->_elementBlock;
    }

    public function toHtml()
    {
    	return $this->getElementBlock()->toHtml();
    }

    public function getDefaultBlock()
    {
    	return '\Cytracon\Builder\Block\Element';
    }
}
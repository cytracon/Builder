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

namespace Cytracon\Builder\Block\Element;

class SocialIcons extends \Cytracon\Builder\Block\Element
{
	/**
	 * @var \Cytracon\Builder\Helper\Data
	 */
	protected $dataHelper;

	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context    
	 * @param \Cytracon\Builder\Helper\Data                     $dataHelper 
	 * @param array                                            $data       
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Cytracon\Builder\Helper\Data $dataHelper,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->dataHelper = $dataHelper;
	}

	/**
	 * @param  string $icon 
	 * @return string|null       
	 */
	public function getSocialLabel($icon)
	{
		$socialIcons = $this->dataHelper->getListSocial();
		foreach ($socialIcons as $social) {
			if ($social['value'] == $icon) {
				return $social['label'];
			}
		}
	}
	/**
	 * @return string
	 */
	public function getAdditionalStyleHtml()
	{
		$styleHtml = '';
		$element   = $this->getElement();
		$items     = (array) $element->getItems();
		$id        = $element->getHtmlId();

		foreach ($items as $index => $_item) {
			if (isset($_item['background_color']) && $_item['background_color']) {
				$styles = [];
				$styles['background-color'] = $this->getStyleColor($_item['background_color']);
				$styleHtml .= $this->getStyles('#' . $id . '-mgz-socialicons-item' . $index, $styles);
			}
			if (isset($_item['hover_background_color']) && $_item['hover_background_color']) {
				$styles = [];
				$styles['background-color'] = $this->getStyleColor($_item['hover_background_color']);
				$styleHtml .= $this->getStyles('#' . $id . '-mgz-socialicons-item' . $index, $styles, ':hover');
			}
		}

		$styles = [];
		$styles['border-radius'] = $this->getStyleProperty($element->getData('icon_radius'));
		if ($element->getData('icon_size')) {
			$styles['font-size'] = $this->getStyleProperty($element->getData('icon_size'));
			$styles['width']       = $this->getStyleProperty($element->getData('icon_size') * 2);
			$styles['height']      = $this->getStyleProperty($element->getData('icon_size') * 2);
			$styles['line-height'] = $this->getStyleProperty($element->getData('icon_size') * 2);
		}
		$styleHtml .= $this->getStyles('.mgz-socialicons i', $styles);

		return $styleHtml;
	}
}
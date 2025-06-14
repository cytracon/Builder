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

class Separator extends \Cytracon\Builder\Block\Element
{
	/**
	 * @return string
	 */
	public function getAdditionalStyleHtml()
	{
		$element = $this->getElement();
		$styles['border-color']     = $this->getStyleColor($element->getData('color'));
		$styles['border-top-style'] = $this->getStyleProperty($element->getData('style'));
		if ($element->getData('border_width')) {
			$styles['border-top-width'] = $this->getStyleProperty($element->getData('border_width'));
		}
		if ($element->getData('line_weight')) {
			$styles['border-top-width'] = $this->getStyleProperty($element->getData('line_weight'));
		}
		$styles['width'] = $this->getStyleProperty($element->getData('el_width'));
		$styleHtml = $this->getStyles('.mgz-element-separator-line', $styles);

		$styleHtml .= $this->getLineStyles();

		return $styleHtml;
	}
}
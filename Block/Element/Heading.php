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

class Heading extends \Cytracon\Builder\Block\Element
{
	/**
	 * @return string
	 */
	public function getAdditionalStyleHtml()
	{
		$element = $this->getElement();
		$styles['font-size']   = $this->getStyleProperty($element->getData('font_size'));
		$styles['color']       = $this->getStyleColor($element->getData('color'));
		$styles['line-height'] = $element->getData('line_height');
		$styles['font-weight'] = $element->getData('font_weight');
		$styleHtml = $this->getStyles('.mgz-element-heading-text', $styles);
		return $styleHtml;
	}
}
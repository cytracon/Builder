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

class EmptySpace extends \Cytracon\Builder\Block\Element
{
	/**
	 * @return string
	 */
	public function getAdditionalStyleHtml()
	{
		$element = $this->getElement();
		$styleHtml = $this->getDataHelper()->getStylesHtml('.' . $element->getHtmlId(), 'custom', $element, [
			'height' => [
				'type'     => 'unit',
				'property' => 'height'
			]
		]);
		return $styleHtml;
	}
}
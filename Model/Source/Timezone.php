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
 * @package   Cytracon_PageBuilder
 * @copyright Copyright (C) 2019 Cytracon (https://www.cytracon.com)
 */

namespace Cytracon\Builder\Model\Source;

class Timezone extends \Magento\Config\Model\Config\Source\Locale\Timezone
{
	/**
	 * @return array
	 */
	public function getConfig()
	{
		$options = $this->toOptionArray();
		array_unshift($options, [
			'label' => 'UTC',
			'value' => 'UTC'
		]);
		return $options;
	}
}
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

namespace Cytracon\Builder\Model\Source;

class CategoryList implements \Cytracon\Builder\Model\Source\ListInterface
{
	/**
	 * @var \Magento\Catalog\Model\CategoryFactory
	 */
	protected $categoryFactory;

	/**
	 * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
	 */
	protected $collectionFactory;

	/**
	 * @param \Magento\Catalog\Model\CategoryFactory                          $categoryFactory   
	 * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory 
	 */
	public function __construct(
		\Magento\Catalog\Model\CategoryFactory $categoryFactory,
		\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory
	) {
		$this->categoryFactory = $categoryFactory;
		$this->collectionFactory = $collectionFactory;
	}

	public function getItem($id) {
		$data = [];
		$category = $this->categoryFactory->create();
		$category->load($id);
		if ($category->getId()) {
			$data = [
				'label' => $category->getName(),
				'value' => $category->getId()
			];
		}
		return $data;
	}

	public function getList($q = '', $field = '') {
		$list = [];
		$collection = $this->collectionFactory->create();
        $collection->addIsActiveFilter();
		$collection->addFieldToSelect('name');
		$collection->setOrder('name', 'ASC');
		if ($q) {
			if (is_array($q)) {
				$collection->addAttributeToFilter('entity_id', ['in' => $q]);
			} else if (is_numeric($q)) {
	            $collection->addAttributeToFilter('entity_id', $q);
	        } else {
				$collection->addAttributeToFilter('name', ['like' => '%' . $q . '%']);
	        }
	    }
		foreach ($collection as $item) {
            $list[] = [
				'label' => $item->getName(),
				'value' => $item->getId()
            ];
        }
        return $list;
	}
}
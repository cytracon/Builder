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

class Sources
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var array
     */
    protected $types = [];

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager 
     * @param array                                     $types         
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $types = []
    ) {
        $this->objectManager = $objectManager;
        $this->types         = $types;
    }

    /**
     * @return array
     */
    public function getSource($type)
    {
        if (isset($this->types[$type])) {
            $source = $this->objectManager->create(
                $this->types[$type]
            );
            if (!$source instanceof \Cytracon\Builder\Model\Source\ListInterface) {
                throw new \InvalidArgumentException(
                    $this->types[$type] . ' does not implement interface ' . \Cytracon\Builder\Model\Source\ListInterface::class
                );
            }
            return $source;
        }
    }
}

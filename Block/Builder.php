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

namespace Cytracon\Builder\Block;

class Builder extends \Magento\Framework\View\Element\Template
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Cytracon_Builder::builder.phtml';

	/**
	 * @var \Cytracon\Builder\Model\CompositeConfigProvider
	 */
	protected $configProvider;

    /**
     * @var array
     */
    protected $_config;

	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context        
	 * @param \Cytracon\Builder\Model\CompositeConfigProvider   $configProvider 
	 * @param array                                            $data           
	 */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Cytracon\Builder\Model\CompositeConfigProvider $configProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
		$this->configProvider = $configProvider;
    }

    /**
     * @return bool|string
     */
    public function getSerializedBuilderConfig()
    {
        return json_encode($this->getBuilderConfig(), JSON_HEX_TAG);
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getBuilderConfig()
    {
        if ($this->_config == NULL) {
            $config                  = $this->configProvider->getConfig();
            $config['htmlId']        = $this->getRequest()->getParam('html_id');
            $config['targetId']      = $this->getTargetId();
            $config['allowed_types'] = ['row'];
            $this->_config = $config;
        }
        return $this->_config;
    }

    /**
     * @return string
     */
    public function getBuilderViewFileUrl() {
        return $this->getViewFileUrl('/') . '/';
    }

    /**
     * @return string
     */
    public function getModuleKeys()
    {
        $builderConfig = $this->getBuilderConfig();
        $modules       = isset($builderConfig['modules']) ? $builderConfig['modules'] : [];
        $moduleKeys    = '';
        $x             = 0;
        $count         = count($modules);
        foreach ($modules as $moduleName => $path) {
            $moduleKeys .= "'" . $moduleName . "'";
            if ($x!=$count-1) {
                $moduleKeys .= ',';
            }
            $x++;
        }
        if ($moduleKeys) {
            $moduleKeys = ',' . $moduleKeys;
        }
        return $moduleKeys;
    }

    /**
     * @return string
     */
    public function getModulePaths()
    {
        $builderConfig = $this->getBuilderConfig();
        $modules       = isset($builderConfig['modules']) ? $builderConfig['modules'] : [];
        $controllers   = isset($builderConfig['controllers']) ? $builderConfig['controllers'] : [];
        $elements      = array_merge($modules, $controllers);
        $modulePaths   = '';
        $x             = 0;
        $count         = count($elements);
        foreach ($elements as $path) {
            $modulePaths .= "'" . $path. "'";
            if ($x!=$count-1) {
                $modulePaths .= ',';
            }
            $x++;
        }
        if ($modulePaths) {
            $modulePaths = ',' . $modulePaths;
        }
        return $modulePaths;
    }
}
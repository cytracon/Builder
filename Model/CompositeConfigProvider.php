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

class CompositeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ConfigProviderInterface[]
     */
    private $configProviders;

    /**
     * @param ConfigProviderInterface[] $configProviders
     * @codeCoverageIgnore
     */
    public function __construct(
        array $configProviders
    ) {
        $this->configProviders = $configProviders;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $config = [];
        foreach ($this->configProviders as $key => $configProvider) {
            if (is_array($configProvider)) {
                $arr = [];
                $arr[$key] = $configProvider;
                $config = array_merge_recursive($config, $arr);
            } else {
                $config = array_merge_recursive($config, $configProvider->getConfig());
            }
        }
        if (isset($config['directives'])) {
            foreach ($config['directives'] as $k => &$directive) {
                $directive['type'] = $k;
            }
            usort($config['directives'], function ($firstLink, $secondLink) {
                if (!isset($firstLink['sortOrder'])) {
                    $firstLink['sortOrder'] = 0;
                }
                if (!isset($secondLink['sortOrder'])) {
                    $secondLink['sortOrder'] = 0;
                }
                return $firstLink['sortOrder'] <=> $secondLink['sortOrder'];
            });
        }
        if (isset($config['modals'])) {
            foreach ($config['modals'] as &$modal) {
                if (isset($modal['form']) && $modal['form'] && (!isset($modal['element']) || !$modal['element'])) {
                    $modal['element'] = 'Cytracon_Builder/js/modal/form';
                }
                if (!isset($modal['disabled'])) {
                    $modal['disabled'] = false;
                }
            }
        }
        return $config;
    }
}

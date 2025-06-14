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

class WysiwygConfigProvider
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $wysiwygConfig;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $assetRepo;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param \Magento\Cms\Model\Wysiwyg\Config        $wysiwygConfig
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param array                                    $settings
     */
    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        array $settings
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        $this->assetRepo = $assetRepo;
        $this->settings = $settings;
    }

    /**
     * Returns configuration data
     *
     * @param \Magento\Framework\DataObject $config
     * @return \Magento\Framework\DataObject|array
     */
    public function getConfig($config = '')
    {
        $isTinymce4 = true;
        $settings = array_replace_recursive($this->wysiwygConfig->getConfig()->getData(), [
            'height' => '260px',
        ]);
        if (isset($settings['tinymce'])) {
            $settings['tinymce']['toolbar'] .= ' code';
        }
        if (!isset($settings['plugins'])) {
            $settings['plugins'] = [];
        }
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
        if ($productMetadata->getVersion() >= '2.4.0') {
            //fontselect
            $settings['toolbar'] = 'fullscreen | undo redo | formatselect | fontsizeselect | lineheightselect | forecolor backcolor ' .
                '| bold italic underline strikethrough | alignleft aligncenter alignright | numlist bullist ' .
                '| link image media table | searchreplace charmap code hr removeformat | help | magentowidget | magentovariable';
            array_push(
                $settings['plugins'],
                'advlist',
                'autolink',
                'lists',
                'link',
                'charmap',
                'media',
                'noneditable',
                'table',
                'contextmenu',
                'paste',
                'code',
                'help',
                'table',
                'textcolor',
                'image',
                'colorpicker',
                'lineheight',
                'fullscreen',
                'hr',
                'wordcount',
                'searchreplace'
            );
            $settings['content_css'] = $this->assetRepo->getUrl('mage/adminhtml/wysiwyg/tiny_mce/themes/ui.css');
            if (is_array($this->settings)) {
                if (isset($this->settings['fonts']) && is_array($this->settings['fonts'])) {
                    $fonts = implode(';', $this->settings['fonts']);
                    unset($this->settings['fonts']);
                    $settings['theme_advanced_fonts'] = $fonts;
                }
                $settings = array_replace_recursive($settings, $this->settings);
            }
                      
            if ($productMetadata->getVersion() >= '2.4.4') {
                $settings['tinymce5'] = true;
            } else if ($productMetadata->getVersion() > '2.4.0') {
                $settings['tinymce4'] = true;
            }
        }
        if (is_array($config)) {
            $settings = array_replace_recursive($settings, $config);
        }
        return $settings;
    }
}

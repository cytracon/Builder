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

namespace Cytracon\Builder\Ui\Component\Form\Element;

use Magento\Framework\Data\Form\Element\Editor;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\Data\Form;
use Magento\Framework\Data\FormFactory;
use Magento\Ui\Component\Wysiwyg\ConfigInterface;

class Builder extends \Magento\Ui\Component\Form\Element\AbstractElement
{
    const NAME = 'wysiwyg';

    /**
     * @var Form
     * @since 100.1.0
     */
    protected $form;

    /**
     * @var Editor
     * @since 100.1.0
     */
    protected $editor;

    /**
     * @param ContextInterface                      $context
     * @param FormFactory                           $formFactory
     * @param ConfigInterface                       $wysiwygConfig
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $components
     * @param array                                 $data
     * @param array                                 $config
     */
    public function __construct(
        ContextInterface $context,
        FormFactory $formFactory,
        ConfigInterface $wysiwygConfig,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Registry $registry,
        array $components = [],
        array $data = [],
        array $config = []
    ) {
        if (!isset($config['disableCytraconBuilder']) || !$config['disableCytraconBuilder']) {
            $htmlId                        = $context->getNamespace() . '_' . $data['name'];
            $data['config']['htmlId']      = $htmlId;
            $data['config']['component']   = 'Cytracon_Builder/js/ui/form/element/builder';
            $data['config']['elementTmpl'] = 'Cytracon_Builder/ui/form/element/builder';
            $data['config']['template']    = 'ui/form/field';
            $block  = $layoutFactory->create()->createBlock(\Magento\Backend\Block\Template::class)
            ->addData($config)
            ->setTemplate('Cytracon_Builder::ajax.phtml')
            ->setTargetId($htmlId);
            if (isset($config['ajax_data'])) {
                $block->setAjaxData($config['ajax_data']);
                $data['config']['content'] = $block->toHtml();
            }
        } else {
            $wysiwygConfigData = isset($config['wysiwygConfigData']) ? $config['wysiwygConfigData'] : [];
            $this->form = $formFactory->create();
            $wysiwygId = $context->getNamespace() . '_' . $data['name'];
            $this->editor = $this->form->addField(
                $wysiwygId,
                \Magento\Framework\Data\Form\Element\Editor::class,
                [
                    'force_load' => true,
                    'rows'       => isset($config['rows']) ? $config['rows'] : 20,
                    'name'       => $data['name'],
                    'config'     => $wysiwygConfig->getConfig($wysiwygConfigData),
                    'wysiwyg'    => isset($config['wysiwyg']) ? $config['wysiwyg'] : null
                ]
            );
            $data['config']['content'] = $this->editor->getElementHtml();
            $data['config']['wysiwygId'] = $wysiwygId;
        }

        parent::__construct($context, $components, $data);
    }

    /**
     * Get component name
     *
     * @return string
     */
    public function getComponentName()
    {
        return static::NAME;
    }
}

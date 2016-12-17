<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Block\Adminhtml\Requests\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
 
class General extends Generic implements TabInterface{
    protected $_wysiwygConfig;
    protected $_newsStatus;
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    protected function _prepareForm(){
        $model = $this->_coreRegistry->registry('callback_request');
        $form = $this->_formFactory->create();
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
 
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'firstname',
            'text',
            [
                'name'        => 'firstname',
                'label'    => __('Firstname'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'lastname',
            'text',
            [
                'name'        => 'lastname',
                'label'    => __('Lastname'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'telephone',
            'text',
            [
                'name'        => 'telephone',
                'label'    => __('Telephone'),
                'required'     => true
            ]
        );
        if($model->getData('product_id')){
            $_product = \Magento\Framework\App\ObjectManager::getInstance()->create('Magento\Catalog\Model\Product');
            $_product->load($model->getData('product_id'));
            $productUrl = $_product->getProductUrl();
            $productName = $_product->getName();
            $link = '<a href="'.$productUrl.'" target="_blank">'.$productName.'</a>';
            $after_element_html = '<p style="margin:8px 0 0;">'.$link.'</p>';
            $fieldset->addField(
                'product_id',
                'text',
                [
                    'name'        => 'product_id',
                    'label'    => __('Product'),
                    'readonly'     => true,
                    'after_element_html' => $after_element_html
                ]
            );
        }
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'comment',
            'textarea',
            [
                'name'      => 'comment',
                'label'     => __('Comment'),
                'required'  => true,
                'style'     => 'height: 15em; width: 100%;',
                'config'    => $wysiwygConfig
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
    public function getTabLabel(){
        return __('Request Info');
    }
    public function getTabTitle(){
        return __('Request Info');
    }
    public function canShowTab(){
        return true;
    }
    public function isHidden(){
        return false;
    }
}
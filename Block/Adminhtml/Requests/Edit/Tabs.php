<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Block\Adminhtml\Requests\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs{
    protected function _construct(){
        parent::_construct();
        $this->setId('request_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Request Information'));
    }
    protected function _beforeToHtml(){
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'SY\Callback\Block\Adminhtml\Requests\Edit\Tab\General'
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}
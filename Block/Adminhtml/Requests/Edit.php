<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Block\Adminhtml\Requests;

class Edit extends \Magento\Backend\Block\Widget\Form\Container {
    protected $_coreRegistry = null;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    protected function _construct(){
        $this->_objectId = 'request_id';
        $this->_blockGroup = 'SY_Callback';
        $this->_controller = 'adminhtml_requests';

        parent::_construct();

        if ($this->_isAllowedAction('SY_Callback::requests')) {
        	$this->buttonList->remove('reset');
            $this->buttonList->update('save', 'label', __('Save Request'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('SY_Callback::requests')) {
            $this->buttonList->update('delete', 'label', __('Delete Request'));
        } else {
            $this->buttonList->remove('delete');
        }
    }
    public function getHeaderText(){
        if ($this->_coreRegistry->registry('callback_request')->getId()) {
            return __("Edit Request '%1'", $this->escapeHtml($this->_coreRegistry->registry('callback_request')->getId()));
        } else {
            return __('New Request');
        }
    }
    protected function _isAllowedAction($resourceId){
        return $this->_authorization->isAllowed($resourceId);
    }
    protected function _getSaveAndContinueUrl(){
        return $this->getUrl('sy_callback/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
    protected function _prepareLayout(){
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('general_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'general_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'general_content');
                }
            };
        ";
        return parent::_prepareLayout();
    }
}
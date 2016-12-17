<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Controller\Adminhtml\Requests;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action{
    protected $_coreRegistry = null;
    protected $resultPageFactory;
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    protected function _isAllowed(){
        return $this->_authorization->isAllowed('SY_Callback::requests');
    }
    protected function _initAction(){
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SY_Callback::header')
            ->addBreadcrumb(__('Customer'), __('Customer'))
            ->addBreadcrumb(__('Callback'), __('Callback'))
            ->addBreadcrumb(__('Requests'), __('Requests'))
            ->addBreadcrumb(__('Edit'), __('Edit'));
        return $resultPage;
    }
    public function execute(){
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('SY\Callback\Model\Request');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('callback_request', $model);
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Callback'));
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Edit'));

        return $resultPage;
    }
}
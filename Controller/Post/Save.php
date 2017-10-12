<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Controller\Post;
use Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
class Save extends \Magento\Framework\App\Action\Action {
	protected $_resultPageFactory;
	public function __construct(Context $context, PageFactory $resultPageFactory){
		$this->_resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	public function execute(){
		$resultRedirect = $this->resultRedirectFactory->create();
		$model = $this->_objectManager->create('SY\\Callback\\Model\\Request');
		$params = $this->getRequest()->getPostValue();
		if($this->getRequest()->getParam('is_product') != "1"){
			unset($params['product_id']);
		}
		$model->setData($params);
		try {
			$model->save();
			$this->messageManager->addSuccess(__('We\'ll call you very soon, wait plese.'));
		} catch (\Exception $e) {
			$this->messageManager->addException($e, __('Something went wrong.'));
		}
		return $resultRedirect->setPath($this->_redirect->getRefererUrl());
	}
}
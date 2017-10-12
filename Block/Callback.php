<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Magento\Customer\Model\Session;
use \Magento\Customer\Model\Customer;
class Callback extends Template {
	protected $registry;
	protected $product;
	public function __construct(
			Context $context,
			Registry $registry,
			Session $session,
			Customer $customer,
			\SY\Callback\Helper\Data $helper,
			array $data = []
		){
		$this->session = $session;
		$this->customer = $customer;
		$this->registry = $registry;
		$this->helper = $helper;
		$this->product = \Magento\Framework\App\ObjectManager::getInstance()->create('Magento\Catalog\Model\Product');
		if($registry->registry('current_product')){
			$id = $registry->registry('current_product')->getId();
			$this->product->load($id);
		}
		if($this->session && $this->session->getData('customer_id')){
			$this->customer->load($this->session->getData('customer_id'));
		}
		parent::__construct($context, $data);
	}
	public function isProductPage(){
		if($this->product->getId()){
			return true;
		}
	}
	public function getProductId(){
		return $this->product->getId();
	}
	public function getProductName(){
		return $this->product->getName();
	}
	public function getFirstname(){
		return $this->customer->getFirstname();
	}
	public function getLastname(){
		return $this->customer->getLastname();
	}
	public function getTelephone(){
		if($defaultAddress = $this->customer->getDefaultBillingAddress()){
			return $defaultAddress->getTelephone();
		}
	}
	public function isActive(){
		if($this->helper->getConfig('general/enable') == "1"){
			return true;
		}
	}
}
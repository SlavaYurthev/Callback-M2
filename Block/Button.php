<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
class Button extends Template {
	protected $session;
	public function __construct(
			Context $context,
			\SY\Callback\Helper\Data $helper,
			array $data = []
		){
		$this->helper = $helper;
		parent::__construct($context, $data);
	}
	public function isActive(){
		if($this->helper->getConfig('general/enable') == "1"){
			return true;
		}
	}
}
<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;
class Data extends AbstractHelper {
	public function getConfig($key){
		return $this->scopeConfig->getValue('sy_callback_configuration/'.$key, ScopeInterface::SCOPE_STORE);
	}
}
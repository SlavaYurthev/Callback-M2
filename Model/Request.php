<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Model;
use Magento\Framework\Model\AbstractModel;
class Request extends AbstractModel {
	protected function _construct() {
		$this->_init('SY\Callback\Model\ResourceModel\Request');
	}
}
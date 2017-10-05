<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Request extends AbstractDb {
	protected function _construct() {
		$this->_init('sy_callback_entity', 'id');
	}
}
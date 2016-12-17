<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Model\Resource\Request;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection {
	protected function _construct() {
		$this->_init(
			'SY\Callback\Model\Request',
			'SY\Callback\Model\Resource\Request'
		);
	}
}
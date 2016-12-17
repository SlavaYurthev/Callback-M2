<?php
/**
 * Callback
 * 
 * @author Slava Yurthev
 */
namespace SY\Callback\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();
		$tableName = $installer->getTable('sy_callback_entity');
		if ($installer->getConnection()->isTableExists($tableName) != true) {
			$table = $installer->getConnection()
				->newTable($tableName)
				->addColumn('id', Table::TYPE_INTEGER, null, [
						'identity' => true,
						'unsigned' => true,
						'nullable' => false,
						'primary' => true
					], 'ID')
				->addColumn('firstname', Table::TYPE_TEXT, null, [
						'length' => 255,
						'nullable' => true
					], 'Firstname')
				->addColumn('lastname', Table::TYPE_TEXT, null, [
						'length' => 255,
						'nullable' => true
					], 'Lastname')
				->addColumn('telephone', Table::TYPE_TEXT, null, [
						'length' => 255,
						'nullable' => true
					], 'Telephone')
				->addColumn('comment', Table::TYPE_TEXT, null, [
						'nullable' => true
					], 'Comment')
				->addColumn('product_id', Table::TYPE_INTEGER, null, [
						'length' => 255,
						'nullable' => true
					], 'Product_ID')
				->addColumn('submit', Table::TYPE_INTEGER, null, [
						'length' => 1,
						'nullable' => true
					], 'Submit')
				->addColumn('created', Table::TYPE_TIMESTAMP, null, [
						'nullable' => false,
						'default' => Table::TIMESTAMP_INIT
					], 'Created')
				->setComment('Callback Table');
			$installer->getConnection()->createTable($table);
		}
		$installer->endSetup();
	}
}
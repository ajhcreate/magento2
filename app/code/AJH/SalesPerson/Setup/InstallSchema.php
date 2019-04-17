<?php

namespace AJH\SalesPerson\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface {

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('ajh_salesperson')) {
            $table = $installer->getConnection()->newTable(
                                    $installer->getTable('ajh_salesperson')
                            )
                            ->addColumn(
                                    'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                                'identity' => true,
                                'nullable' => false,
                                'primary' => true,
                                'unsigned' => true,
                                    ], 'ID'
                            )
                            ->addColumn(
                                    'sales_order_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Sales Order ID'
                            )
                            ->addColumn(
                                    'sales_person', \Magento\Framework\DB\Ddl\Table::TYPE_VARCHAR, 255, [], 'Sales Person'
                            )->addColumn(
                    'note', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'Note'
            );

            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('ajh_salesperson_orders')) {
            $table = $installer->getConnection()->newTable(
                                    $installer->getTable('ajh_salesperson')
                            )
                            ->addColumn(
                                    'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [
                                'identity' => true,
                                'nullable' => false,
                                'primary' => true,
                                'unsigned' => true,
                                    ], 'ID'
                            )
                            ->addColumn(
                                    'sales_order_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Sales Order ID'
                            )
                            ->addColumn(
                                    'salesperson_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable => false'], 'Sales Person ID'
                            )->addColumn(
                    'note', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'Note'
            );

            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}

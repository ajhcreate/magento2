<?php

namespace AJH\SalesPerson\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface {

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        
        $installer = $setup;
        $installer->startSetup();

        //handle all possible upgrade versions
        if (!$context->getVersion()) {
            //no previous version found, installation, InstallSchema was just executed
            //be careful, since everything below is true for installation !


            $table = $installer->getConnection()->newTable(
                            $installer->getTable('ajh_salesperson')
                    )->addColumn(
                    'notes', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'Notes'
            );

            $installer->getConnection()->createTable($table);

            if (!$installer->tableExists('ajh_salesperson_orders')) {
                $table = $installer->getConnection()->newTable(
                                        $installer->getTable('ajh_salesperson_orders')
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

        /* if (version_compare($context->getVersion(), '1.0.3') < 0) {
          //code to upgrade to 1.0.3
          } */

        $setup->endSetup();
    }

}

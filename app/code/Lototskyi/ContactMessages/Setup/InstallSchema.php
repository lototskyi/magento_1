<?php

namespace Lototskyi\ContactMessages\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\DB\Ddl\Table;
use \Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('lototskyi_contact_messages')) {

            $table = $installer->getConnection()->newTable(
                $installer->getTable('lototskyi_contact_messages')
            )
                ->addColumn(
                    'message_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Message ID'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'User Name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'User Email'
                )
                ->addColumn(
                    'phone_number',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Phone Number'
                )
                ->addColumn(
                    'message',
                    Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Message'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_INTEGER,
                    1,
                    [],
                    'Post Status'
                )
                ->addColumn(
                    'answer',
                    Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Message'
                )
                ->addColumn(
                    'answered_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false],
                    'Answered At')
                ->setComment('Contact us table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('lototskyi_contact_messages'),
                $setup->getIdxName(
                    $installer->getTable('lototskyi_contact_messages'),
                    ['name', 'email', 'message', 'answer'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'email', 'message', 'answer'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
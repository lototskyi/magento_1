<?php

namespace Lototskyi\ContactMessages\Model\ResourceModel\Messages;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'message_id';
    protected $_eventPrefix = 'lototskyi_contactmessages_messages_collection';
    protected $_eventObject = 'messages_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Lototskyi\ContactMessages\Model\Messages', 'Lototskyi\ContactMessages\Model\ResourceModel\Messages');
    }

}
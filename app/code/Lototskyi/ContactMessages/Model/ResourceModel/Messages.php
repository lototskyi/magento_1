<?php

namespace Lototskyi\ContactMessages\Model\ResourceModel;


class Messages extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('lototskyi_contact_messages', 'message_id');
    }
}
<?php

namespace Lototskyi\ContactMessages\Model;


class Messages extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'lototskyi_contactmessages_messages';

    protected $_cacheTag = 'lototskyi_contactmessages_messages';

    protected $_eventPrefix = 'lototskyi_contactmessages_messages';

    protected function _construct()
    {
        $this->_init('Lototskyi\ContactMessages\Model\ResourceModel\Messages');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
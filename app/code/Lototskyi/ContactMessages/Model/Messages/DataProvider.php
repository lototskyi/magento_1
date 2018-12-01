<?php

namespace Lototskyi\ContactMessages\Model\Messages;

use Lototskyi\ContactMessages\Model\ResourceModel\Messages\CollectionFactory;
use Lototskyi\ContactMessages\Model\Messages;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();

        /** @var Messages $message */
        foreach ($items as $message) {
            $this->loadedData[$message->getId()]['messages'] = $message->getData();
        }

        return $this->loadedData;
    }
}
<?php

namespace Lototskyi\ContactMessages\Ui\Component\Listing\Columns;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;

class MessageStatus extends Column
{
    protected $_orderRepository;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {

                $status = $item['status'];

                if ($status) {
                    $message = 'Closed';
                } else {
                    $message = 'Open';
                }

                $item[$this->getData('name')] = $message;
            }
        }

        return $dataSource;
    }
}
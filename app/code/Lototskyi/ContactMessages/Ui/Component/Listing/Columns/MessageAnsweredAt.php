<?php

namespace Lototskyi\ContactMessages\Ui\Component\Listing\Columns;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;

class MessageAnsweredAt extends Column
{
    protected $_orderRepository;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $this->getDates($dataSource);
        }
        return $dataSource;
    }

    private function getDates($dataSource)
    {
        foreach ($dataSource['data']['items'] as &$item) {
            $this->hideOrShowDate($item);
        }
        return $dataSource;
    }

    private function hideOrShowDate(&$item)
    {
        $anweredAt = $item['answered_at'];

        if ($anweredAt == '0000-00-00 00:00:00') {
            $message = '';
        } else {
            $message = $anweredAt;
        }

        $item[$this->getData('name')] = $message;
    }
}
<?php

namespace Lototskyi\ContactMessages\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;


class Actions extends Column
{

    const URL_PATH_EDIT = 'lototskyi_contactmessages/messages/edit';

    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $dataSource = $this->getLinks($dataSource);
        }

        return $dataSource;
    }

    private function getLinks($dataSource)
    {
        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($item['message_id'])) {
                $this->getEditLink($item);
            }
        }

        return $dataSource;
    }

    private function getEditLink(&$item)
    {
        $item[$this->getData('name')] = [
            'edit' => [
                'href' => $this->builEditdUrl($item),
                'label' => __('Edit')
            ],
        ];
    }

    private function builEditdUrl($item)
    {
        return $this->urlBuilder->getUrl(
            static::URL_PATH_EDIT,
            [
                'id' => $item['message_id']
            ]);
    }
}
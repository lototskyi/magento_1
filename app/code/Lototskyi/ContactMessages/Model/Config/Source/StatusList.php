<?php

namespace Lototskyi\ContactMessages\Model\Config\Source;

class StatusList implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Open')],
            ['value' => 1, 'label' => __('Closed')],
        ];
    }
}
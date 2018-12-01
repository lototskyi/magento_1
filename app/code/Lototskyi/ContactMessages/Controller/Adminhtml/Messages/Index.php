<?php

namespace Lototskyi\ContactMessages\Controller\Adminhtml\Messages;

use \Magento\Backend\App\Action;
use \Magento\Framework\View\Result\PageFactory;

/**
 * Action Index
 * @package Lototskyi\ContactMessages\Controller\Adminhtml\Messages
 */
class Index extends Action
{
    /**
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Contact messages')));

        return $resultPage;
    }
}
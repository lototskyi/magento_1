<?php

namespace Lototskyi\ContactMessages\Controller\Adminhtml\Messages;

use \Magento\Backend\App\Action;
use Lototskyi\ContactMessages\Model\Messages;

/**
 * Action Edit
 * @package Lototskyi\ContactMessages\Controller\Adminhtml\Messages
 */
class Edit extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $messageData = $this->getRequest()->getParam('id');

        if (is_array($messageData)) {
            $contact = $this->_objectManager->create(Messages::class);
            $contact->setData($messageData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
<?php

namespace Lototskyi\ContactMessages\Controller\Adminhtml\Messages;

use \Magento\Backend\App\Action;
use Lototskyi\ContactMessages\Model\Messages;

class Delete extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('message_id');

        if (!($contact = $this->_objectManager->create(Messages::class)->load($id))) {
            $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
            $contact->delete();
            $this->messageManager->addSuccessMessage(__('Your message has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete contact: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
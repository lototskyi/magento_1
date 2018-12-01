<?php

namespace Lototskyi\ContactMessages\Controller\Adminhtml\Messages;

use \Magento\Backend\App\Action;
use Lototskyi\ContactMessages\Model\Messages;
use Lototskyi\ContactMessages\Helper\Email;

/**
 * Action Edit
 * @package Lototskyi\ContactMessages\Controller\Adminhtml\Messages
 */
class Edit extends Action
{
    protected $helperEmail;

    public function __construct(Action\Context $context, Email $email)
    {
        $this->helperEmail = $email;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $messageData = $this->getRequest()->getParam('messages');

        if (is_array($messageData)) {

            if (!($message = $this->_objectManager->create(Messages::class))) {
                $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            }
            try{
                $message->setData($messageData)->save();

                //$name = $messageData['name'];
                //$email = $messageData['email'];

                //send email
                //$this->helperEmail->notify($name, $email);

                $this->messageManager->addSuccessMessage(__('The message has been answered!'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('Error while trying to answer message: '));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

    }

    private function sendEmail()
    {


    }
}
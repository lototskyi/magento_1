<?php

namespace Lototskyi\ContactMessages\Controller\Adminhtml\Messages;

use \Magento\Backend\App\Action;
use Lototskyi\ContactMessages\Model\Messages;
use Lototskyi\ContactMessages\Helper\Email;
use Magento\Framework\Exception\MailException;
use Psr\Log\LoggerInterface;

/**
 * Action Edit
 * @package Lototskyi\ContactMessages\Controller\Adminhtml\Messages
 */
class Edit extends Action
{
    /**
     * @var Email
     */
    protected $helperEmail;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(Action\Context $context, Email $email, LoggerInterface $logger)
    {
        parent::__construct($context);
        $this->helperEmail = $email;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $messageData = $this->getRequest()->getParam('messages');

        if (is_array($messageData)) {

            $message = $this->_objectManager->create(Messages::class);

            $resultRedirect = $this->resultRedirectFactory->create();

            if (!$message) {
                $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));

                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            }
            try {
                $currentData = $message->load($messageData['message_id'])->getData();

                $messageData['answered_at'] = time();
                $message->setData($messageData)->save();

                $this->sendEmail($currentData, $messageData);

                $this->messageManager->addSuccessMessage(__('The message has been answered!'));
            } catch (MailException $e) {
                $this->messageManager->addErrorMessage(__('Email was not send!'));
                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            } catch (Exception $e) {
                $this->logger->critical($e);
                $this->messageManager->addErrorMessage(__('Error while trying to answer message: '));
                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

    }

    private function sendEmail($currentData, $messageData)
    {
        if (trim($currentData['answer']) != trim($messageData['answer'])) {
            $name = $messageData['name'];
            $email = $messageData['email'];

            $this->helperEmail->notify($name, $email, $messageData['answer']);
        }
    }
}
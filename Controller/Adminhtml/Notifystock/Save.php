<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Controller\Adminhtml\Notifystock;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var $dataPersistor
     */
    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context                   $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /**
 * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
*/
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('notifystock_id');
            $model = $this->_objectManager->create(
                \Bluethinkinc\NotifyStockAvailability\Model\Notifystock::class
            )
                ->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Notifystock no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Notifystock.'));
                $this->dataPersistor->clear('bluethinkinc_notifystockavailability_notifystock');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['notifystock_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the Notifystock.')
                );
            }

            $this->dataPersistor->set(
                'bluethinkinc_notifystockavailability_notifystock',
                $data
            );
            return $resultRedirect->setPath(
                '*/*/edit',
                ['notifystock_id' => $this->getRequest()
                    ->getParam('notifystock_id')]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
}

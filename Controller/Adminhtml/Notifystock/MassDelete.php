<?php

/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bluethinkinc\NotifyStockAvailability\Controller\Adminhtml\Notifystock;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock\CollectionFactory;
use Bluethinkinc\NotifyStockAvailability\Model\NotifystockFactory;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Bluethinkinc_NotifyStockAvailability::notifystock_id';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    public $collectionFactory;

    /**
     * @var NotifystockFactory
     */
    protected $notifystockFactory;

    /**
     * @param Context            $context
     * @param Filter             $filter
     * @param CollectionFactory  $collectionFactory
     * @param NotifystockFactory $notifystockFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        NotifystockFactory $notifystockFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->notifystockFactory = $notifystockFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $job_application) {
            $result = $this->notifystockFactory->create()->load($job_application->getNotifystockId());
            $result->delete();
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}

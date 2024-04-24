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
use Bluethinkinc\NotifyStockAvailability\Helper\NotifyEmail;

class MassNotifyme extends \Magento\Backend\App\Action implements HttpPostActionInterface
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
     * @var \Magento\Framework\Stdlib\DateTime
     */
    private $dateTime;
    /**
     * @var helperNotifyEmail
     */
    protected $helperNotifyEmail;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var Context
     */
    protected $context;
    /**
     * @param Filter                                          $filter
     * @param CollectionFactory                               $collectionFactory
     * @param NotifystockFactory                              $notifystockFactory
     * @param \Magento\Framework\Stdlib\DateTime              $dateTime
     * @param NotifyEmail                                     $helperNotifyEmail
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param Context                                         $context
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        NotifystockFactory $notifystockFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        NotifyEmail $helperNotifyEmail,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        Context $context,
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->notifystockFactory = $notifystockFactory;
        $this->dateTime = $dateTime;
        $this->helperNotifyEmail = $helperNotifyEmail;
        $this->productRepository = $productRepository;
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
            $product_name = $result->getProductName();
            $product_sku = $result->getProductSku();
            $first_name = $result->getFirstName();
            $last_name = $result->getLastName();
            $email = $result->getEmail();
            $updatestatus = $result->getStatus();
            $product_url = $result->getProductUrl();
            if ($updatestatus == 'Notify') {
                $message = 'A total of %1 record(s) have been already Notify customer.
                if some product not Notify so may be product not in stock.';
            } else {
                $productdata = $this->productRepository->get($product_sku);
                $isAvailable = $productdata->isAvailable();
                if ($isAvailable == 1) {
                    $customerdetails = ['product_name' => $product_name,
                    'product_sku' => $product_sku,'first_name' => $first_name,
                    'last_name' => $last_name,'enquiry_email' => $email,
                    'product_url' => $product_url];
                    $emailresponce = $this->helperNotifyEmail->sendEmail($customerdetails);
                    $status = 'Notify';
                    $updated = $this->dateTime->formatDate(true);
                    $result->setStatus($status);
                    $result->setUpdateAt($updated);
                    $result->save();
                    $message = 'A total of %1 record(s) have been Notify customer for product.';
                } else {
                    $message = 'A total of %1 record(s) have been
                not Notify customer because product was out of stock.';
                }
            }
        }
        $this->messageManager->addSuccessMessage(
            __(
                $message,
                $collectionSize
            )
        );
        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}

<?php

/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bluethinkinc\NotifyStockAvailability\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Bluethinkinc\NotifyStockAvailability\Model\Notifystock;
use Magento\Framework\Controller\Result\JsonFactory;
use Bluethinkinc\NotifyStockAvailability\Helper\Data;
use Bluethinkinc\NotifyStockAvailability\Helper\Email;

class Save extends Action
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Notifystock
     */
    protected $Notifystock;
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    private $dateTime;
    /**
     * @var helperData
     */
    protected $helperData;
    /**
     * @var helperEmail
     */
    protected $helperEmail;
    /**
     * @param Context                            $context
     * @param PageFactory                        $resultPageFactory
     * @param Notifystock                        $Notifystock
     * @param JsonFactory                        $resultJsonFactory
     * @param \Magento\Framework\Stdlib\DateTime $dateTime
     * @param Data                               $helperData
     * @param Email                              $helperEmail
     */

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Notifystock $Notifystock,
        JsonFactory $resultJsonFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        Data $helperData,
        Email $helperEmail
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->Notifystock = $Notifystock;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->dateTime = $dateTime;
        $this->helperData = $helperData;
        $this->helperEmail = $helperEmail;
        parent::__construct($context);
    }

    /**
     * Execute method.
     *
     * @return ResultFactory
     */
    public function execute()
    {
        try {
            $resultJson = $this->resultJsonFactory->create();
            $created_at = $this->dateTime->formatDate(true);
            $product_id = $this->getRequest()->getPost('pid');
            $product_name = $this->getRequest()->getPost('product_name');
            $product_sku =  $this->getRequest()->getPost('product_sku');
            $first_name  =   $this->getRequest()->getPost('first_name');
            $last_name   =   $this->getRequest()->getPost('last_name');
            $email = $this->getRequest()->getPost('email');
            $product_url = $this->getRequest()->getPost('product_url');
            $status = 'pending';
            $data = ['product_id' => $product_id,'product_name' => $product_name,'product_sku' => $product_sku,
            'first_name' => $first_name,'last_name' => $last_name,
            'email' => $email,'status' => $status,
            'create_at' => $created_at,'update_at' => $created_at,'product_url' => $product_url];
            if ($data) {
                $congigmessage = $this->helperData->MODELSUCCESSMESSAGE();
                $pagereloadtime = $this->helperData->MODELPAGELOADTIME();
                $customerdetails = ['product_name' => $product_name,'product_sku' => $product_sku,
                'first_name' => $first_name,'last_name' => $last_name,
                'enquiry_email' => $email,'product_url' => $product_url];
                $emailresponce = $this->helperEmail->sendEmail($customerdetails);
                $model = $this->Notifystock;
                $model->setData($data)->save();
                $result = ["success" => 200,"messages" => __($congigmessage),"pagereloadtime" => $pagereloadtime];
            }
        } catch (\Exception $e) {
            $result = ["success" => 400,"messages" => __($e->getMessage())];
        }
        return $resultJson->setData($result);
    }
}

<?php

namespace Bluethinkinc\NotifyStockAvailability\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Bluethinkinc\NotifyStockAvailability\Helper\Data;
use Magento\Store\Model\StoreManagerInterface;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * This is a inlineTranslation
     *
     * @var inlineTranslation $inlineTranslation
     */
    protected $inlineTranslation;
    /**
     * This is a transportBuilder
     *
     * @var transportBuilder $transportBuilder
     */
    protected $transportBuilder;
    /**
     * @var logger
     */
    protected $logger;
    /**
     * @var helperData
     */
    protected $helperData;
    /**
     * This is a storeManager
     *
     * @var storeManager $storeManager
     */
    private $storeManager;
    /**
     * This is a construct
     *
     * @param Context               $context
     * @param StateInterface        $inlineTranslation
     * @param TransportBuilder      $transportBuilder
     * @param LoggerInterface       $logger
     * @param Data                  $helperData
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        LoggerInterface $logger,
        Data $helperData,
        StoreManagerInterface $storeManager,
    ) {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
        $this->helperData = $helperData;
        $this->storeManager = $storeManager;
    }
    /**
     * This is a sendEmail
     *
     * @param customerdetails $customerdetails
     */
    public function sendEmail($customerdetails)
    {
        $productname = $customerdetails['product_name'];
        $productsku = $customerdetails['product_sku'];
        $firstname = $customerdetails['first_name'];
        $lastname = $customerdetails['last_name'];
        $enquiryemail = $customerdetails['enquiry_email'];
        $product_url = $customerdetails['product_url'];
            $this->logger->debug('Product Notify Stock Availability start');
            $email_subject = $this->helperData->EMAILSUBJECT();
            $data = [
            'customer_name' => $firstname . ' ' . $lastname,
            'customer_email' => $enquiryemail,
            'product_name' => $productname,
            'product_sku' => $productsku,
            'email_subject' => $email_subject,
            'product_url' => $product_url,
            'store' => $this->storeManager->getStore()
            ];
                $this->logger->debug('toEmail == ' . $enquiryemail);
                $this->inlineTranslation->suspend();
                $template = $this->helperData->EMAILTEMPLATE();
                $sender = $this->helperData->EMAILSENDER();
                $transport = $this->transportBuilder
                    ->setTemplateIdentifier($template)
                    ->setTemplateOptions(
                        [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getid()
                        ]
                    )
                    ->setTemplateVars($data)
                    ->setFrom($sender)
                    ->addTo($enquiryemail)
                    ->getTransport();
        try {
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            //return 1;
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
            $this->inlineTranslation->resume();
            $this->logger->debug('Product Notify Stock Availability end');
    }
}

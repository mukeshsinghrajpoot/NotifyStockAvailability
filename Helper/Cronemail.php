<?php

namespace Bluethinkinc\NotifyStockAvailability\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Bluethinkinc\NotifyStockAvailability\Helper\Data;
use Magento\Store\Model\StoreManagerInterface;
use Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock\CollectionFactory;
use Bluethinkinc\NotifyStockAvailability\Model\NotifystockFactory;

class Cronemail extends \Magento\Framework\App\Helper\AbstractHelper
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
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * This is a construct
     *
     * @param Context                                         $context
     * @param StateInterface                                  $inlineTranslation
     * @param TransportBuilder                                $transportBuilder
     * @param LoggerInterface                                 $logger
     * @param Data                                            $helperData
     * @param StoreManagerInterface                           $storeManager
     * @param CollectionFactory                               $collectionFactory
     * @param NotifystockFactory                              $notifystockFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Stdlib\DateTime              $dateTime
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        LoggerInterface $logger,
        Data $helperData,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        NotifystockFactory $notifystockFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Stdlib\DateTime $dateTime
    ) {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
        $this->helperData = $helperData;
        $this->storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
        $this->notifystockFactory = $notifystockFactory;
        $this->dateTime = $dateTime;
        $this->productRepository = $productRepository;
    }
    /**
     * This is Notify user for instock Product.
     *
     * @return syncnotifyuser
     */
    public function syncnotifyuser()
    {
        $notifyenabledisable = $this->helperData->PRODUCTSTOCKENABLEDISABLE();
        if ($notifyenabledisable == 1) {
            $collectiondata = $this->collectionFactory->create()->getData();
            foreach ($collectiondata as $key => $value) {
                $product_id = $value['product_id'];
                $product_name = $value['product_name'];
                $product_sku = $value['product_sku'];
                $first_name = $value['first_name'];
                $last_name = $value['last_name'];
                $email = $value['email'];
                $status = $value['status'];
                $create_at = $value['create_at'];
                $update_at = $value['update_at'];
                $product_url = $value['product_url'];
                if ($status == 'Notify') {
                    $message = 'Product have been already Notify customer.
                    if some product not Notify so may be product not in stock.';
                } else {
                    $productdata = $this->productRepository->get($product_sku);
                    $isAvailable = $productdata->isAvailable();
                    if ($isAvailable == 1) {
                        $result = $this->notifystockFactory->create()
                            ->load($value['notifystock_id']);
                        $customerdetails = ['product_name' => $product_name,
                        'product_sku' => $product_sku,'first_name' => $first_name,
                        'last_name' => $last_name,'enquiry_email' => $email,
                        'product_url' => $product_url];
                        $emailresponce = $this->sendEmail($customerdetails);
                        $status = 'Notify';
                        $updated = $this->dateTime->formatDate(true);
                        $result->setStatus($status);
                        $result->setUpdateAt($updated);
                        $result->save();
                        $message = 'Product have been Notify customer for product.
                        If you are using localhost server may be not send mail.';
                    } else {
                        $message = 'Product have been not Notify customer because product was out of stock.';
                    }
                }
            }
                    $message = __($message);

                    $error = __('');
                    $data = ['response' => $message, 'error' => $error];
                    return $data;
        } else {
            $message = __('Please Enable This Module.');
            $error = __('true');
            $data = ['response' => $message, 'error' => $error];
            return $data;
        }
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
            $this->logger->debug('cron Product customer in stock Notify Stock Availability start');
            $email_subject = $this->helperData->EMAILSUBJECTNOTIFY();
            $data = [
            'customer_name' => $firstname . ' ' . $lastname,
            'customer_email' => $enquiryemail,
            'product_url' => $product_url,
            'product_name' => $productname,
            'product_sku' => $productsku,
            'email_subject' => $email_subject,
            'store' => $this->storeManager->getStore()
            ];
                $this->logger->debug('toEmail == ' . $enquiryemail);
                $this->inlineTranslation->suspend();
                $template = $this->helperData->NOTIFYEMAILTEMPLATE();
                $this->logger->debug($template);
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
            $this->logger->debug('cron Product customer in stock Notify Stock Availability end');
    }
}

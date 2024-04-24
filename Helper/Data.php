<?php

namespace Bluethinkinc\NotifyStockAvailability\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const PRODUCT_STOCK_ENABLE_DISABLE = 'product_stock/general/enable';
    public const PRODUCT_STOCK_BUTTON_ENABLE = 'product_stock/options/button_enable';
    public const PRODUCT_STOCK_PDP_TITLE = 'product_stock/options/product_page_button_title';
    public const PRODUCT_STOCK_PLP_TITLE = 'product_stock/options/catagory_page_button_title';
    public const EMAIL_TEMPLATE = 'product_stock/email_configuration/email_template_stock';
    public const EMAIL_SENDER = 'product_stock/email_configuration/sender';
    public const EMAIL_SUBJECT = 'product_stock/email_configuration/notify_email_subject';
    public const EMAIL_SUBJECT_NOTIFY = 'product_stock/email_configuration/notify_email_subject_notify';
    public const NOTIFY_EMAIL_TEMPLATE = 'product_stock/email_configuration/email_template_notify';
    public const PRODUCT_STOCK_POPUPMODEL_MESSAGE = 'product_stock/options/modelmessage';
    public const PRODUCT_STOCK_POPUPMODEL_PAGERELOADTIME = 'product_stock/options/pagereloadtime';
    public const PRODUCT_STOCK_POPUPMODEL_HEADER_TITLE = 'product_stock/options/popupmodelheadertitle';
    /**
     * This is a storemanager
     *
     * @var storeManager $storeManager
     */
    private $storeManager;
    /**
     * This is a scopeConfig
     *
     * @var scopeConfig $scopeConfig
     */
    protected $scopeConfig;
    /**
     * @var Configurationvalue
     */
    /**
     * This is a construct
     *
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface  $scopeConfig
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * This is a Product stock enable disable value Get
     *
     * @return PRODUCTSTOCKENABLEDISABLE
     */
    public function PRODUCTSTOCKENABLEDISABLE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_ENABLE_DISABLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a Product stock button enable disable value Get
     *
     * @return PRODUCTSTOCKBUTTONENABLEDISABLE
     */
    public function PRODUCTSTOCKBUTTONENABLEDISABLE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_BUTTON_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product stock product detail page button title get value
     *
     * @return PRODUCTSTOCKPDPTITLE
     */
    public function PRODUCTSTOCKPDPTITLE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_PDP_TITLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product stock plp page button title value Get
     *
     * @return PRODUCTSTOCKPLPTITLE
     */
    public function PRODUCTSTOCKPLPTITLE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_PLP_TITLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product enquiry Email Template value Get
     *
     * @return EMAILTEMPLATE
     */
    public function EMAILTEMPLATE()
    {
        return $this->scopeConfig->getValue(
            self::EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product enquiry Email Sender value Get
     *
     * @return EMAILSENDER
     */
    public function EMAILSENDER()
    {
        return $this->scopeConfig->getValue(
            self::EMAIL_SENDER,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product enquiry Email Subject value Get
     *
     * @return EMAILSUBJECT
     */
    public function EMAILSUBJECT()
    {
        return $this->scopeConfig->getValue(
            self::EMAIL_SUBJECT,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product enquiry notify Email Template value Get
     *
     * @return NOTIFYEMAILTEMPLATE
     */
    public function NOTIFYEMAILTEMPLATE()
    {
        return $this->scopeConfig->getValue(
            self::NOTIFY_EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a product enquiry notify Email Subject value Get
     *
     * @return EMAILSUBJECTNOTIFY
     */
    public function EMAILSUBJECTNOTIFY()
    {
        return $this->scopeConfig->getValue(
            self::EMAIL_SUBJECT_NOTIFY,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a sussess meaage value Get
     *
     * @return MODELSUCCESSMESSAGE
     */
    public function MODELSUCCESSMESSAGE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_POPUPMODEL_MESSAGE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a popup model time value Get
     *
     * @return MODELPAGELOADTIME
     */
    public function MODELPAGELOADTIME()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_POPUPMODEL_PAGERELOADTIME,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
    /**
     * This is a popup model Header Title value Get
     *
     * @return MODELHEADERTITLE
     */
    public function MODELHEADERTITLE()
    {
        return $this->scopeConfig->getValue(
            self::PRODUCT_STOCK_POPUPMODEL_HEADER_TITLE,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }
}

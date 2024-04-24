<?php

namespace Bluethinkinc\NotifyStockAvailability\Block\Product;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ProductList\Item\Block;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Registry;
use Magento\Catalog\Model\CategoryFactory;
use Bluethinkinc\NotifyStockAvailability\Helper\Data;

class ListProduct extends Block
{
    /**
     * @var Registry
     */
    protected $_registry;
    /**
     * @var categoryFactory
     */
    protected $_categoryFactory;
    /**
     * @var Data
     */
    protected $_helperData;
    /**
     * @var customerSession
     */
    public $_customerSession;

    /**
     * ListProduct constructor.
     *
     * @param Context         $context
     * @param Registry        $_registry
     * @param CategoryFactory $_categoryFactory
     * @param Data            $_helperData
     * @param customerSession $_customerSession
     * @param array           $data
     */
    public function __construct(
        Context $context,
        Registry $_registry,
        CategoryFactory $_categoryFactory,
        Data $_helperData,
        \Magento\Customer\Model\SessionFactory $_customerSession,
        array $data = []
    ) {
        $this->_registry = $_registry;
        $this->_categoryFactory = $_categoryFactory;
        $this->_helperData = $_helperData;
        $this->_customerSession = $_customerSession;
        parent::__construct($context, $data);
    }
    /**
     * Get product button Enable Extention
     *
     * @return data
     */
    public function getbuttonEndable()
    {
        return $this->_helperData->PRODUCTSTOCKBUTTONENABLEDISABLE();
    }
    /**
     * Get Button Title List page
     *
     * @return data
     */
    public function getplpTitle()
    {
        return $this->_helperData->PRODUCTSTOCKPLPTITLE();
    }
    /**
     * Get Model Header Title List page
     *
     * @return data
     */
    public function getmodelheaderTitle()
    {
        return $this->_helperData->MODELHEADERTITLE();
    }
    /**
     * Get Current Customer
     */
    public function getCustomer()
    {
        $customer = $this->_customerSession->create();
        $data = ['fname' => $customer->getCustomer()->getFirstname(),
        'lname' => $customer->getCustomer()->getLastname(),
        'email' => $customer->getCustomer()->getEmail()];
        return $data;
    }
}

<?php

namespace Bluethinkinc\NotifyStockAvailability\viewModel;

use Bluethinkinc\NotifyStockAvailability\Helper\Data;

class StockAvailabilityview implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var helperData
     */
    protected $helperData;
    /**
     * @var SessionFactory
     */
    protected $_customerSession;

    /**
     * Get The Helper data
     *
     * @param Data $helperData
     * @param SessionFactory $_customerSession
     */
    public function __construct(
        Data $helperData,
        \Magento\Customer\Model\SessionFactory $_customerSession
    ) {
        $this->helperData = $helperData;
        $this->_customerSession = $_customerSession;
    }
    /**
     * Get The getButtonEnable data
     *
     * @return $data
     */
    public function getButtonEnable()
    {
        $data = $this->helperData->PRODUCTSTOCKBUTTONENABLEDISABLE();
        return $data;
    }
    /**
     * This is a product stock product detail page button title get value
     *
     * @return $data
     */
    public function getpdpTitle()
    {
        $data = $this->helperData->PRODUCTSTOCKPDPTITLE();
        return $data;
    }
    /**
     * This is a product stock plp page button title value Get
     *
     * @return $data
     */
    public function getplpTitle()
    {
        $data = $this->helperData->PRODUCTSTOCKPLPTITLE();
        return $data;
    }
    /**
     * This is a pop up model header title value Get
     *
     * @return $data
     */
    public function getmodelheaderTitle()
    {
        $data = $this->helperData->MODELHEADERTITLE();
        return $data;
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

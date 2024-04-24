<?php

namespace Bluethinkinc\NotifyStockAvailability\Block\Notify;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock\Collection as NotifyCollection;

class Productnotifylist extends Template
{
    /**
     * @var NotifyCollection
     */
    protected $notifyCollection;
    /**
     * @var customerSession
     */
    public $_customerSession;
    /**
     * Get The Helper data
     *
     * @param Context          $context
     * @param NotifyCollection $notifyCollection
     * @param customerSession  $_customerSession
     */
    public function __construct(
        Context $context,
        NotifyCollection $notifyCollection,
        \Magento\Customer\Model\SessionFactory $_customerSession
    ) {
        $this->notifyCollection = $notifyCollection;
        $this->_customerSession = $_customerSession;
        parent::__construct($context);
    }
    /**
     * Get _prepareLayout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('notifiy list product'));
        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'bt.notify.pager'
            )->setAvailableLimit([10 => 10,20 => 20,30 => 30])->setShowPerPage(true)->setCollection(
                $this->getCustomCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }
    /**
     * Get getPagerHtml
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    /**
     * Get getCustomCollection
     */
    public function getCustomCollection()
    {
        $currentemail = $this->getCustomer();
        //get values of current page. if not the param value then it will set to 1
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        //get values of current limit. if not the param value then it will set to 1
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 10;
        $collection = $this->notifyCollection->addFieldToFilter('email', ['eq' => $currentemail]);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }
    /**
     * Get Current Customer
     */
    public function getCustomer()
    {

        $customer = $this->_customerSession->create();
        $email = $customer->getCustomer()->getEmail();
        return $email;
    }
}

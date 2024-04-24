<?php

namespace Bluethinkinc\NotifyStockAvailability\Cron;

use Exception;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Bluethinkinc\NotifyStockAvailability\Helper\Cronemail;

class Notifyuseristockproduct
{
    /**
     * This is a helperData
     *
     * @var helperData $helperData
     */
    private $helperData;
    /**
     * This is a construct
     *
     * @param Cronemail $helperData
     */
    public function __construct(
        Cronemail $helperData
    ) {
        $this->helperData = $helperData;
    }

    /**
     * This Is Execute function
     *
     * @return execute
     */
    public function execute()
    {
        try {
            $data = $this->helperData->syncnotifyuser();
        } catch (Exception  $e) {
            $message = $e->getMessage();
            $error = __('true');
            $data = ['response' => $message, 'error' => $error];
        }
        return $data;
    }
}

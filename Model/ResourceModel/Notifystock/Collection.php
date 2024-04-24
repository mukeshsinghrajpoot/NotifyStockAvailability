<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * This is a _idFieldName
     *
     * @var $_idFieldName
     */
    protected $_idFieldName = 'notifystock_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Bluethinkinc\NotifyStockAvailability\Model\Notifystock::class,
            \Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock::class
        );
    }
}

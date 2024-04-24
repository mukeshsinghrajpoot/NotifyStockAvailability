<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Api\Data;

interface NotifystockSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get notifystock list.
     *
     * @return \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface[]
     */
    public function getItems();

    /**
     * Set product_id list.
     *
     * @param  \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

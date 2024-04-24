<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface NotifystockRepositoryInterface
{
    /**
     * Save notifystock
     *
     * @param  \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface $notifystock
     * @return \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface $notifystock
    );

    /**
     * Retrieve notifystock
     *
     * @param  string $notifystockId
     * @return \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($notifystockId);

    /**
     * Retrieve notifystock matching the specified criteria.
     *
     * @param  \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete notifystock
     *
     * @param  \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface $notifystock
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface $notifystock
    );

    /**
     * Delete notifystock by ID
     *
     * @param  string $notifystockId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($notifystockId);
}

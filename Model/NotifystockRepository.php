<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Model;

use Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface;
use Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterfaceFactory;
use Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockSearchResultsInterfaceFactory;
use Bluethinkinc\NotifyStockAvailability\Api\NotifystockRepositoryInterface;
use Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock as ResourceNotifystock;
use Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock\CollectionFactory
as NotifystockCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class NotifystockRepository implements NotifystockRepositoryInterface
{
    /**
     * @var ResourceNotifystock
     */
    protected $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var NotifystockInterfaceFactory
     */
    public $notifystockFactory;

    /**
     * @var Notifystock
     */
    protected $searchResultsFactory;

    /**
     * @var NotifystockCollectionFactory
     */
    protected $notifystockCollectionFactory;

    /**
     * @param ResourceNotifystock                      $resource
     * @param NotifystockInterfaceFactory              $notifystockFactory
     * @param NotifystockCollectionFactory             $notifystockCollectionFactory
     * @param NotifystockSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface             $collectionProcessor
     */
    public function __construct(
        ResourceNotifystock $resource,
        NotifystockInterfaceFactory $notifystockFactory,
        NotifystockCollectionFactory $notifystockCollectionFactory,
        NotifystockSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->notifystockFactory = $notifystockFactory;
        $this->notifystockCollectionFactory = $notifystockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(NotifystockInterface $notifystock)
    {
        try {
            $this->resource->save($notifystock);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the notifystock: %1',
                    $exception->getMessage()
                )
            );
        }
        return $notifystock;
    }

    /**
     * @inheritDoc
     */
    public function get($notifystockId)
    {
        $notifystock = $this->notifystockFactory->create();
        $this->resource->load($notifystock, $notifystockId);
        if (!$notifystock->getId()) {
            throw new NoSuchEntityException(__('notifystock with id "%1" does not exist.', $notifystockId));
        }
        return $notifystock;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->notifystockCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(NotifystockInterface $notifystock)
    {
        try {
            $notifystockModel = $this->notifystockFactory->create();
            $this->resource->load($notifystockModel, $notifystock->getNotifystockId());
            $this->resource->delete($notifystockModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete the notifystock: %1',
                    $exception->getMessage()
                )
            );
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($notifystockId)
    {
        return $this->delete($this->get($notifystockId));
    }
}

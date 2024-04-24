<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Model;

use Bluethinkinc\NotifyStockAvailability\Api\Data\NotifystockInterface;
use Magento\Framework\Model\AbstractModel;

class Notifystock extends AbstractModel implements NotifystockInterface
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Bluethinkinc\NotifyStockAvailability\Model\ResourceModel\Notifystock::class);
    }

    /**
     * @inheritDoc
     */
    public function getNotifystockId()
    {
        return $this->getData(self::NOTIFYSTOCK_ID);
    }

    /**
     * @inheritDoc
     */
    public function setNotifystockId($notifystockId)
    {
        return $this->setData(self::NOTIFYSTOCK_ID, $notifystockId);
    }

    /**
     * @inheritDoc
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheritDoc
     */
    public function getProductName()
    {
        return $this->getData(self::PRODUCT_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setProductName($productName)
    {
        return $this->setData(self::PRODUCT_NAME, $productName);
    }

    /**
     * @inheritDoc
     */
    public function getProductSku()
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * @inheritDoc
     */
    public function setProductSku($productSku)
    {
        return $this->setData(self::PRODUCT_SKU, $productSku);
    }

    /**
     * @inheritDoc
     */
    public function getFirstName()
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setFirstName($firstName)
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    /**
     * @inheritDoc
     */
    public function getLastName()
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setLastName($lastName)
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getCreateAt()
    {
        return $this->getData(self::CREATE_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreateAt($createAt)
    {
        return $this->setData(self::CREATE_AT, $createAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdateAt()
    {
        return $this->getData(self::UPDATE_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdateAt($updateAt)
    {
        return $this->setData(self::UPDATE_AT, $updateAt);
    }
    /**
     * @inheritDoc
     */
    public function getProductUrl()
    {
        return $this->getData(self::PRODUCT_URL);
    }

    /**
     * @inheritDoc
     */
    public function setProductUrl($productUrl)
    {
        return $this->setData(self::PRODUCT_URL, $productUrl);
    }
}

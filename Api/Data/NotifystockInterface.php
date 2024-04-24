<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Api\Data;

interface NotifystockInterface
{
    public const NOTIFYSTOCK_ID = 'notifystock_id';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const CREATE_AT = 'create_at';
    public const UPDATE_AT = 'update_at';
    public const PRODUCT_SKU = 'product_sku';
    public const PRODUCT_NAME = 'product_name';
    public const STATUS = 'status';
    public const FIRST_NAME = 'first_name';
    public const PRODUCT_ID = 'product_id';
    public const PRODUCT_URL = 'product_url';

    /**
     * Get notifystock_id
     *
     * @return string|null
     */
    public function getNotifystockId();

    /**
     * Set notifystock_id
     *
     * @param  string $notifystockId
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setNotifystockId($notifystockId);

    /**
     * Get product_id
     *
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     *
     * @param  string $productId
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setProductId($productId);

    /**
     * Get product_name
     *
     * @return string|null
     */
    public function getProductName();

    /**
     * Set product_name
     *
     * @param  string $productName
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setProductName($productName);

    /**
     * Get product_sku
     *
     * @return string|null
     */
    public function getProductSku();

    /**
     * Set product_sku
     *
     * @param  string $productSku
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setProductSku($productSku);

    /**
     * Get first_name
     *
     * @return string|null
     */
    public function getFirstName();

    /**
     * Set first_name
     *
     * @param  string $firstName
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setFirstName($firstName);

    /**
     * Get last_name
     *
     * @return string|null
     */
    public function getLastName();

    /**
     * Set last_name
     *
     * @param  string $lastName
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setLastName($lastName);

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param  string $email
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setEmail($email);

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param  string $status
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setStatus($status);

    /**
     * Get create_at
     *
     * @return string|null
     */
    public function getCreateAt();

    /**
     * Set create_at
     *
     * @param  string $createAt
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setCreateAt($createAt);

    /**
     * Get update_at
     *
     * @return string|null
     */
    public function getUpdateAt();

    /**
     * Set update_at
     *
     * @param  string $updateAt
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setUpdateAt($updateAt);

    /**
     * Get product_url
     *
     * @return string|null
     */
    public function getProductUrl();

    /**
     * Set product_url
     *
     * @param  string $productUrl
     * @return \Bluethinkinc\NotifyStockAvailability\Notifystock\Api\Data\NotifystockInterface
     */
    public function setProductUrl($productUrl);
}

<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Block\Adminhtml\Notifystock\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * This is a get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getModelId()) {
            $data = [
                'label' => __('Delete Notifystock'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Get URL for delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['notifystock_id' => $this->getModelId()]);
    }
}

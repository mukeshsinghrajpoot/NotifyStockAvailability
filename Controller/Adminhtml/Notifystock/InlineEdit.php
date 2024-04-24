<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Bluethinkinc\NotifyStockAvailability\Controller\Adminhtml\Notifystock;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * @var $jsonFactory
     */
    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context              $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /**
 * @var \Magento\Framework\Controller\Result\Json $resultJson
*/
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    /**
 * @var \Bluethinkinc\NotifyStockAvailability\Model\Notifystock $model
*/
                    $model = $this->_objectManager
                        ->create(\Bluethinkinc\NotifyStockAvailability\Model\Notifystock::class)
                        ->load($modelid);
                    try {
                        $id = $postItems[$modelid];
                        $data = $this->meargedata($model, $id);
                        $model->setData($data);
                        $model->save($data);
                    } catch (\Exception $e) {
                        $messages[] = "[Notifystock ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData(
            [
            'messages' => $messages,
            'error' => $error
            ]
        );
    }
    /**
     * Inline edit action mearge data
     *
     * @param  model $model
     * @param  id    $id
     * @return meargedata
     */
    public function meargedata($model, $id)
    {
        return array_merge($model->getData(), $id);
    }
}

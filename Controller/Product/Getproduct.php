<?php

/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bluethinkinc\NotifyStockAvailability\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable;

class Getproduct extends Action
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $_productRepository;
    /**
     * @var Configurable
     */
    protected $_productTypeConfigurable;
    /**
     * @param Context                                         $context
     * @param PageFactory                                     $resultPageFactory
     * @param JsonFactory                                     $resultJsonFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param Configurable                                    $catalogProductTypeConfigurable
     */

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        Configurable $catalogProductTypeConfigurable
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_productRepository = $productRepository;
        $this->_productTypeConfigurable = $catalogProductTypeConfigurable;
        parent::__construct($context);
    }

    /**
     * Execute method.
     *
     * @return ResultFactory
     */
    public function execute()
    {
        try {
            $resultJson = $this->resultJsonFactory->create();
            $selectProId = $this->getRequest()->getPost('selectProId');
            $product = $this->_productRepository->getById($selectProId);
            $parentByChild = $this->_productTypeConfigurable->getParentIdsByChild($selectProId);
            if ($parentByChild[0]) {
                $parentproduct = $this->_productRepository->getById($parentByChild[0]);
                $parentgetSku = $parentproduct->getSku();
            }
            if ($product) {
                $isAvailable = $product->isAvailable();
                $getName = $product->getName();
                $getSku = $product->getSku();
                $result = ["success" => 200,'pid' => $selectProId,
                'isAvailable' => $isAvailable,'product_name' => $getName,
                'sku' => $getSku,'parentgetSku' => $parentgetSku];
            }
        } catch (\Exception $e) {
            $result = ["success" => 400,"messages" => __($e->getMessage())];
        }
        return $resultJson->setData($result);
    }
}

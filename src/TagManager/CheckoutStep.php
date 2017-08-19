<?php

namespace GtmEnhancedEcommercePlugin\TagManager;

use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Xynnn\GoogleTagManagerBundle\Service\GoogleTagManagerInterface;

/**
 * Class CheckoutStep
 * @package SyliusGoogleAnalyticsEnhancedEcommerceTrackingBundle\TagManager
 */
final class CheckoutStep implements CheckoutStepInterface
{
    const STEP_CART = 1;
    const STEP_ADDRESS = 2;
    const STEP_SHIPPING = 3;
    const STEP_PAYMENT = 4;
    const STEP_CONFIRM = 5;
    const STEP_THANKYOU = 6;

    /**
     * @var array
     */
    private $products = [];

    /**
     * @var GoogleTagManagerInterface
     */
    private $googleTagManager;

    /**
     * CheckoutStep constructor.
     * @param GoogleTagManagerInterface $googleTagManager
     */
    public function __construct(GoogleTagManagerInterface $googleTagManager)
    {
        $this->googleTagManager = $googleTagManager;
    }

    /**
     * @inheritdoc
     */
    public function addStep(OrderInterface $order, int $step): void
    {
        if ($step < self::STEP_THANKYOU) {
            $this->setProducts($order);
        }

        $this->googleTagManager->addData('event', 'checkout');
        $this->googleTagManager->addData('ecommerce', [
            'checkout' => [
                'actionField' => [
                    'step' => $step,
                ],
                'products' => $this->products,
            ],
        ]);
    }

    /**
     * @param OrderInterface $order
     */
    private function setProducts(OrderInterface $order): void
    {
        foreach ($order->getItems() as $item) {
            $this->addProduct($item);
        }
    }

    /**
     * @param OrderItemInterface $item
     */
    private function addProduct(OrderItemInterface $item): void
    {
        $this->products[] = [
            'name' => $item->getProduct()->getName(),
            'id' => $item->getProduct()->getId(),
            'quantity' => $item->getQuantity(),
            'variant' => $item->getVariant()->getName() ?? $item->getVariant()->getCode(),
            'category' => $item->getProduct()->getMainTaxon()->getName(),
            'price' => $item->getTotal() / 100,
        ];
    }
}

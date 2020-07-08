<?php
class Cart
{
    protected $customer;
    protected $discountsList;


    public function __construct($registry)
    {
        $this->customer = $registry->get('customer');
        $this->discountsList =  new DiscountList($registry);
    }

    public function add()
    {
    }

    public function update()
    {
    }

    public function remove()
    {
    }

    /**
    * check if products available
    * @return	boolean
    **/
    public function hasProducts()
    {
    }

    /**
     * check if the payment method is chosen
     * @return	boolean
     **/
    public function hasPaymentChosen()
    {
    }

    /**
     *  return cart products
     * @return	array
     **/
    public function getProducts()
    {
    }

    protected function getProductPrice($product)
    {
        $price = $product['price'];

        // Each product type can have only one discount associated with it
        foreach ($this->discountsList->productDiscounts as $discount) {
            if ($discount->productTypeId === $product['type_id']) {
                return $discount->calculate($product['price']);
            }
        }

        return $price;
    }

    protected function getCartProductTypes()
    {
        foreach ($this->getProducts() as $product) {
            $types[] =  $product['type_id'];
        }
        return $types;
    }

    protected function getCartDiscountTotal($total)
    {
        // the cart can have only one product combination for discount
        $cartProductTypes = $this->getCartProductTypes();
        foreach ($this->discountsList->compexDiscounts as $coplexDiscount) {
            if (count($coplexDiscount->productCombinations) === count(array_intersect($coplexDiscount->productCombinations, $cartProductTypes))) {
                return $coplexDiscount->calculate($total);
            }
        }
        return $total;
    }

    //
    public function getTotal()
    {
        if (!$this->hasProducts()) {
            return 0;
        }

        $total = 0;
        // Applying discounts for individual products
        if ($this->discountsList->productDiscounts !== 0) {
            foreach ($this->getProducts() as $product) {
                $total +=  $this->getProductPrice($product) * $product['quantity'];
            }
        }

        // Applying discounts for a combination of  products
        if ($this->discountsList->compexDiscounts !== 0) {
            $total = $this->getCartDiscountTotal($total);
        }
        return $total;
    }

    public function isReadyForCheckout()
    {
        return ($this->customer->isRegistered  && $this->hasProducts() && $this->hasPaymentChosen) ? true : false;
    }
}

<?php
class DiscountList
{
    public $productDiscounts = [];
    public $compexDiscounts = [];

    public function __construct($registry)
    {
        $this->productDiscountsList = $registry->get('productDiscounts');
        $this->complexDiscountsList = $registry->get('complexDiscounts');
    }

    protected function getProductDiscounts()
    {
        $this->productDiscounts[] = $this->discountFactory($this->productDiscountsList);
    }

    protected function getCompexDiscounts()
    {
        $this->compexDiscounts[] = $this->discountFactory($this->complexDiscountsList);
    }

    /**
     * here we use factory pattern to
     * @return	array of discount objects
     **/
    protected function discountFactory($discounts)
    {
        $currentDiscounts = [];

        foreach ($discounts as $discount) {
            if (class_exists($discount)) {
                $currentDiscounts[] = new $discount;
            }
        }
        
        return  $currentDiscounts;
    }
}

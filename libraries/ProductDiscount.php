<?php
abstract class ProductDiscount
{
    protected $discountValue;
    public $productTypeId;
    abstract public function calculate($productPrice);
}

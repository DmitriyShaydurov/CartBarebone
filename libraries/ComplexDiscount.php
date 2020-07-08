<?php
abstract class ComplexDiscount
{
    public array $productCombinations; //array of product type_id's;
    protected $discountValue;
    abstract public function calculate($productPrice);
}

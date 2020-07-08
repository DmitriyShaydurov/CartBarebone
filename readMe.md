## Task

Imagine you are working on an e-commerce project and you are assigned the task to design its checkout system. The checkout system should receive a shopping cart associated to a user with at least one product. It should also be able to apply zero or more discount policies based on configuration such as: 3% off for jeans, 5% off for smartphones, RM20 off if the shopping cart contains jeans and smartphones, or a combination of some or all of them. It should also accept different payment methods such as: cash on delivery, credit card, Google Pay, etc. The challenge is more on how to design this checkout system and less on specific implementation of its parts.

## Solution

The cart can use 2 types of discount (combinations are possible)
1) for individual types of products (extends ProductDiscount)
2) for a combination of products (extends ComplexDiscount)

The cart only checks if a payment method is chosen (no specific implementation);

The DiscountList class use factory pattern for discounts object Initialization.
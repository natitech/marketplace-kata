# Marketplace kata
A user (buyer) wants to buy a product from another user (seller). You are in charge of the marketplace development.

## Scenario
1/ First, the buyer has to pay for it. In other words, there has to be a "Bank" transfer from user wallet to a pivot wallet.

2/ Then the product needs to be automatically removed from the seller inventory. Sometimes, the product is not available anymore.

3/ And finally :
- 3a/ if the product is removed (the product was available), the money is transfered to the seller
- 3b/ if not, money is refunded to the buyer 

If you want to work on you test and refactoring skills, you can use the contracts for "Bank" (1, 3a, 3b) and "Inventory" (2) given, see inside "external" folder.

If you want to work on your design skills, you can start from scratch.

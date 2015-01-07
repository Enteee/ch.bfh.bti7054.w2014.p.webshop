# ch.bfh.bti7054.w2014.p.webshop

## Tasks

### Task 1.1: Development Environment

Code repository: https://github.com/Enteee/ch.bfh.bti7054.w2014.p.webshop

### Task 1.2: Web Shop Basics [done]

#### Product
Source code

#### Idea
We're selling source code on our webshop. People can upload source code and other people can buy source code from them. The basis for trading is a virtual currency which is only valid on our page.

#### Categories
* Snippets
* Scripts
* Full software
* Classes
* Frameworks

#### Extensions
* Source code in other languages
* With/Without comments
* Support
* Different versions


#### Products on launch
* Hello world
* Bubble sort
* Quick sort
* ...

### Task 1.3: Target User and Requirements [done]

#### Target users

**Tommy**

* Gender: Male
* Age: 35
* Skills: Managing, social skills
* Job: Project manager
* Interest: Can not code, but needs to buy ideas / example implementations for project X
* Income: Money from project

**Marc**

* Gender: Male
* Age: 25
* Skill: Basic coding
* Job: New coder in project x
* Interest: Can not code that good. Needs implementation examples and support from experienced coders
* Income: 2500.-

#### Use case

##### UC1

**Actors:** Tommy, Shop

**Intention:** Tommy want's to buy source code

**Preconditions:** Tommy has virtual money

**Postconditions:** Tommy gets source code as archive

1. Tommy logs in 
2. Tommy enters a search text in the search field 
3. Tommy gets a list of search results 
4. Tommy gets information to products  
5. Tommy selects one of them 
6. Tommy chooses extensions 
7. Tommy puts the item in his basket 
8. Tommy can continue shopping 
9. Tommy preceeds to checkout 
10. Tommy gets a overview of his order 
11. Tommy sends accept 
12. He can now dowload the source code

##### UC2

**Actors:** Marc, Shop

**Intention:** Marc want's to sell source code

**Preconditions:** Marc has a account

**Postconditions:** Source code of marc is ready for purchase

1. Marc logs in
2. Marc goes to 'my code'-page
3. Marc uploads a project
4. Marc adds information. Description, language, version
5. Marc adds tags
6. Marc publishes source code

#### Requirements

##### UC1

1. Login form
3. Text search input
4. Search results page
5. Expand result
6. Shopping basket
7. Checkout page
8. "my code"-page

##### UC2

1. Project upload
2. Project information add page
3. Project tagging
4. Project publishing

### Task 1.4: Design Principles [done]

* Simplicity
* Responsive design

### Task 2.1: General Design [done]

**Name:** CodeShop

**Address:** codeshop.ch

#### Site map

* Show products
  * Search
  * Browse by category
* Show product details

Only registered users:
* My orders (only registered users)
* My offers
* Add offer

### Task 2.2: Main HTML Page [done]

### Task 3.1: Basic Design [done]

* Bootstrap & jquery integrated

### Task 3.2: Content [done]

### Task 4.1: PHP Setup [done]

### Task 4.2: Dynamic Navigation Menu [done]

* Top navigation for registered user
* Side navigation with product categories

### Task 4.3: List of Products [done]

* Animated list with jquery
* More information on click
* Start rating
* AVG rating

### Task 5.1: External PHP Files [done]

* CSS, JavaScript and PHP classes as external files
* Classes are loaded by a class loader

### Task 5.2: Multi-Page PHP File [done]

* MVC pattern used with controllers and methods to provide access over one single page

### Task 5.3: Multiple Languages [done]

* language resources are stored in a .json file
* search works in any language

### Task 6.1: "Buy Now" Links [open]

* Show price for products (+ dynamic pricing, customization)

### Task 6.2: Select Options [done]

* Different offers per product (by programming languages)

### Task 6.3: Shipping Address [done]

* Feature not implemented, bought files are downloadable instead

### Task 6.4: Confirmation [done]

* Checkout into shopping cart
* Confirmation view before buy
* Confirm email (only when send mail is configured correctly)

### Task 6.5: Refactoring and Code Beautification [done]

* MVC pattern with controller classes and view templates
* URI routing: /{language}/{controller}/{method}
* SaveVars: typed superglobals

### Task 7.1: Purchase Confirmation [done]

* Confirm box in the confirm overview

### Task 7.2: Form Validation [done]

* HTML 5 form validation in the "add code" form

### Task 7.3: DHTML [done]

* Rating of products
* Adding reviews without reloading the page

### Task 8.1: Cookies [done]

* Language of user is stored in a cookie
* $_COOKIE wrapped in SaveVars

### Task 8.2: Shopping Cart [done]

* Shopping cart on the left side
* Removing of items via AJAX

### Task 8.3: User Accounts [done]

* Problem solved by using *Google Identity Toolkit* no need for password saving
* Login with Gmail account

### Task 9.1: OO Shopping Cart [done]

* Initial design

### Task 9.2 : OO Product List [done]

* Propel generated objects used

### Task 9.3: Even more OO [done]

* Multiple classes for various functions (Language, Repository, Session...)

### Task 10.1: Database Schema Design [done]

### Task 10.2: Database Setup [done]

* Database created and designed with MySQL Workbench

### Task 10.3: PHP Integration [done]

* Code generated with Propel ORM

### Task 10.4: Administrator [done]

* Populate controller to insert data
* "Add code" form to add new products (no admin function, every user can add code)

### Task 11.1: Web Service Integration [done]

* Integrated Wikipedia api for further product description

### Task 12.1: AJAX [done]

* Adding reviews works with AJAX
* Removing items from shopping cart is also based on AJAX

### Task 12.3: HTML Templates [done]

* Created own simple template system based on our MVC engine

### Task 12.4: Regular Expressions [done]

* Validation of language and country codes
* Parsing of user language over browser
* Parsing of uri

## Installation

* Install script
  * ZIP extract (with password from form)
  * Composer vendor libraries installation
  * Populate database (populate controller)
  * Document installation

**The banana tree**

THE webshop for banana related products.

**following features of this website:**
- a product overview page where users and admins can view the available products in a product card style.
- a cart system.
- a account registering and login system.
- a admin page where you can view and remove orders and orderlines showing what was bought, by who, for how much and on what day. you can also edit and add products to the database from the admin page and you can edit the accounts and change it's roles.
- a order viewing page where regular users can view orders to see on what date and for how much a order was made.

**code languages used on this site:**
- php.
- html.
- css.
- database pdo.
- mysql for the database.

**installation:** 

1. Clone or download this repository.
2. Copy the sql from db.sql in the database folder into your chosen database (developer used phpmyadmin)
3. update the database configuration in connection.php in the database folder update $host, $db for the database name, $user for the username,   and $pass for the password according to your connection details.
4. start the webserver and database server
5. open the website in your browser

**layout:**
- mainfolder 
  - contains the home page and the cart page.
- product_pages folder 
  - contains all of the product pages.
- order_pages folder 
  - contains all of the pages necessarry for the orders.
- database folder 
  - contains the files needed to have the proper database.
- CSS folder 
  - contains all of the css files.
- admin_page folder
  - contains the files for the admin pages.
- account_system folder 
  - contains the register and login pages.
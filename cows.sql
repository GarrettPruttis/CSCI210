drop database cows;
create database cows;

use cows;
create table products (product_ID int AUTO_INCREMENT Not Null, product_name varchar(22) NOT NULL, image_link varchar(122), price float, quantity float, PRIMARY KEY (product_ID));
desc products;

create table customers (cust_ID int AUTO_INCREMENT Not Null, username varchar(22) Not Null Unique, first_name varchar(22) NOT NULL, last_name varchar(22) NOT NULL, email varchar(55), create_date DATE, PRIMARY KEY (cust_ID) );
desc customers;

select * from customers;

create table carts(order_num int Not Null, cust_ID int Not Null, product_ID int not null, Quantity int not null, Constraint PK_ORDER primary key (order_num,product_ID),  foreign key(cust_ID) references customers(cust_ID), foreign key(product_ID) references products(product_ID) );
create table orders(order_num int Not Null, cust_ID int Not Null, product_ID int not null, Quantity int not null, Constraint PK_ORDER primary key (order_num,product_ID),  foreign key(cust_ID) references customers(cust_ID), foreign key(product_ID) references products(product_ID) );
desc orders;

insert into customers (username,first_name,last_name,email,create_date) Values ('bsmith','bob','smith', 'bobsmith123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('tony','tony','smith', 'tonysmith123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('sandy','san','davis', 'sandavis123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('eggohome','Emma','garcia', 'emmagarcia123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('sophia','Sophia','jones', 'sophiajones123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('jack','jack','williams', 'williamsjack123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('amelia','amelia','johnson', 'johnson123@gmail.com', CURRENT_DATE());
insert into customers (username,first_name,last_name,email,create_date) Values ('hosea','hosea','cordone', 'cordonehosea123@gmail.com', CURRENT_DATE());

insert into products (product_name,image_link,price,quantity) Values ('Black Angus','blackangus.jpg', 1500.24, 10);
insert into products (product_name,image_link,price,quantity) Values ('Brown Swiss','brownswiss.jpg', 1820.00, 30);
insert into products (product_name,image_link,price,quantity) Values ('Charolais','charolais.jpg', 1300.92, 24);
insert into products (product_name,image_link,price,quantity) Values ('Hereford','hereford.jpg', 1201.30, 13);
insert into products (product_name,image_link,price,quantity) Values ('Holstein','holstein.jpg', 1000.73, 19);
insert into products (product_name,image_link,price,quantity) Values ('Jersey','jersey.jpg', 2132.00, 80);
insert into products (product_name,image_link,price,quantity) Values ('Red Angus','redangus.jpg', 1298.04, 6);

CREATE USER 'www-data'@'localhost' IDENTIFIED BY 'abcde12345';
Flush privileges;
GRANT SELECT, INSERT, UPDATE, DELETE ON cows.* TO 'www-data'@'localhost';
Flush privileges;

Select * from products;

SELECT product_ID, image_link, product_name, quantity, price FROM cows.products WHERE product_ID=2;


desc orders;
desc carts;
SELECT * FROM orders;
select * from cows.carts;
select * from cows.customers;


    			SELECT 
        				cows.products.product_ID, cows.products.image_link, cows.products.product_name, cows.products.price, cows.products.quantity 
				FROM 
    				    cows.products 
    			LEFT JOIN cows.carts 
        			ON cows.carts.product_ID = cows.products.product_ID 
				LEFT JOIN cows.customers 
        			ON cows.carts.cust_ID = cows.customers.cust_ID
    			WHERE 
        			cows.customers.cust_ID = "1";







CREATE TABLE Login (
  id_Login int PRIMARY KEY AUTO_INCREMENT,
  username varchar(20),
  password varchar(20),
  role varchar(50)
);

CREATE TABLE Customer (
  id_User int PRIMARY KEY AUTO_INCREMENT,
  username varchar(50),
  email varchar(100),
  phone_number varchar(20),
  address varchar(200),
  login_id int
);

CREATE TABLE Products (
  id_Product int PRIMARY KEY AUTO_INCREMENT,
  product_name varchar(200),
  quantity int,
  description longtext,
  price int,
  created_at datetime,
  update_at datetime
);

CREATE TABLE Product_Image (
  id_PdImg int,
  product_id int,
  image_path varchar(200),
  color varchar(30)
);

CREATE TABLE Cart (
  id_Cart int PRIMARY KEY AUTO_INCREMENT,
  user_id int,
  product_id int,
  image varchar(250),
  product_name varchar(200),
  price int,
  order_date datetime,
  status int,
  quantity int,
  total_money decimal(10, 2)
);


CREATE TABLE Customer_Information (
  id_CtInformation int PRIMARY KEY AUTO_INCREMENT,
  user_id int,
  username varchar(100),
  email varchar(100),
  card_number varchar(100),
  expire_date varchar(20),
  cvv varchar(20),
  phone_number varchar(20),
  address varchar(200)
);
CREATE TABLE Management_Product (
  id_MProduct int PRIMARY KEY AUTO_INCREMENT,
  product_id int,
  name varchar(100),
  image varchar(200),
  quantity int,
  price decimal(10,2)
);
CREATE TABLE Management_User (
  id_MUser int PRIMARY KEY AUTO_INCREMENT,
  user_id int,
  username varchar(100),
  password varchar(32),
  email varchar(200),
  address varchar(200)
);
CREATE TABLE Feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rating INT NOT NULL DEFAULT 0
);
-- Bảng Đơn hàng (Orders)
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    order_date DATE,
    status_id INT,
    total_amount DECIMAL(10, 2),
    shipping_address VARCHAR(255),
    shipping_method VARCHAR(100),
    payment_method VARCHAR(100),
    notes TEXT

);

-- Bảng Chi tiết đơn hàng (Order Details)
CREATE TABLE OrderDetails (
    order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT,
    unit_price DECIMAL(10, 2)

);

-- Bảng Khách hàng (Customers)
CREATE TABLE Customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(255),
    email VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255)
);

-- Bảng Trạng thái đơn hàng (Order Status)
CREATE TABLE OrderStatus (
    status_id INT PRIMARY KEY AUTO_INCREMENT,
    status_name VARCHAR(50)
);

-- Bảng Thông tin giao hàng (Shipping Information)
CREATE TABLE ShippingInformation (
    shipping_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    shipping_date DATE,
    estimated_delivery_date DATE,
    shipping_status VARCHAR(50)
   
);

-- Bảng Thông tin thanh toán (Payment Information)
CREATE TABLE PaymentInformation (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    payment_date DATE,
    payment_amount DECIMAL(10, 2)
 
);

-- Bảng Ghi chú (Notes)
CREATE TABLE Notes (
    note_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    note_content TEXT

);

ALTER TABLE Management_Product ADD FOREIGN KEY (product_id) REFERENCES Products (id_Product);

ALTER TABLE Management_User ADD FOREIGN KEY (user_id) REFERENCES Customer (id_User);

ALTER TABLE Cart ADD FOREIGN KEY (user_id) REFERENCES Customer (id_User);

ALTER TABLE Product_Image ADD FOREIGN KEY (product_id) REFERENCES Products (id_Product);

ALTER TABLE Customer_Information ADD FOREIGN KEY (user_id) REFERENCES Customer (id_User);

ALTER TABLE Customer ADD FOREIGN KEY (login_id) REFERENCES Login (id_Login);

ALTER TABLE Cart ADD FOREIGN KEY (product_id) REFERENCES Products (id_Product); 

ALTER TABLE shippinginformation ADD FOREIGN KEY (order_id) REFERENCES orders (order_id);

ALTER TABLE paymentinformation ADD FOREIGN KEY (order_id) REFERENCES orders (order_id);

ALTER TABLE notes ADD FOREIGN KEY (order_id) REFERENCES orders (order_id);
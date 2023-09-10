
/* --------------------------------------------------- 
PRIMARY TABLES: Client, Product, Cost_Option, Supplier
--------------------------------------------------- */

CREATE TABLE Client (
	Client_ID VARCHAR(6) NOT NULL PRIMARY KEY DEFAULT '0',
    Client_Name VARCHAR(30) NOT NULL UNIQUE,
    Email_Address VARCHAR(50) UNIQUE,
    Office_Address VARCHAR(150) UNIQUE,
    Office_Number VARCHAR(13) UNIQUE,
    First_Manager_Name VARCHAR(30) NOT NULL,
    First_Manager_Number VARCHAR(13) NOT NULL UNIQUE,
    Second_Manager_Name VARCHAR(30),
    Second_Manager_Number VARCHAR(13) UNIQUE
);

CREATE TABLE Client_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Client_Insert
BEFORE INSERT ON Client
FOR EACH ROW
BEGIN
	INSERT INTO Client_Seq VALUES (NULL);
    SET NEW.Client_ID = CONCAT('C-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

INSERT INTO Client(Client_Name, First_Manager_Name, First_Manager_Number) VALUES('Bruhhhh', 'lol', '00000');
DROP TABLE Client;
DROP TRIGGER TG_Client_Insert;
DROP TABLE Client_Seq;

SELECT * FROM Client;

/* ------------------------------------------------------------------ */

CREATE TABLE Product (
	Product_ID VARCHAR(6) NOT NULL PRIMARY KEY DEFAULT '0',
    Client_ID VARCHAR(6) NOT NULL, -- FK
    Product_Name VARCHAR(50) NOT NULL UNIQUE,
    Product_Creation_Date DATE NOT NULL,
    FOREIGN KEY(Client_ID) REFERENCES Client(Client_ID) ON DELETE CASCADE
);

CREATE TABLE Product_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Product_Insert
BEFORE INSERT ON Product
FOR EACH ROW
BEGIN
	INSERT INTO Product_Seq VALUES (NULL);
    SET NEW.Product_ID = CONCAT('P-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

INSERT INTO Product(Client_ID, Product_Name, Product_Creation_Date) VALUES('C-0002', 'Bruh', '2004-06-20');
SELECT * FROM Product;
DROP TABLE Product;
DROP TABLE Product_Seq;
DROP TRIGGER TG_Product_Insert;

/* ------------------------------------------------------------------ */

CREATE TABLE Cost_Option (
	CO_ID VARCHAR(7) NOT NULL PRIMARY KEY DEFAULT '0', -- PRIMARY KEY
    Product_ID VARCHAR(6) NOT NULL, -- FOREIGN KEY
    Product_Name VARCHAR(50) NOT NULL,
    
    -- Integer fields (units + costs)
    Units INTEGER NOT NULL,
    Printing INTEGER NOT NULL,
    Design INTEGER NOT NULL,
    Plate INTEGER NOT NULL,
    Die_Cut_Mould INTEGER NOT NULL,
    
    -- Decimal fields (cost rates)
    Die_Cutting DECIMAL(4,3) NOT NULL,
    Lamination DECIMAL(4,3),
    Emboss DECIMAL(4,3),
    Hot_Stamping DECIMAL(4,3),
    Gluing DECIMAL(4,3),
    
    -- Integer fields (costs)
    Packing INTEGER NOT NULL,
    Transportation INTEGER NOT NULL,
    Packing_Material INTEGER NOT NULL,
    
    -- Calculated fields
    Unit_Cost DECIMAL(7,2) GENERATED ALWAYS AS
    ((Printing + Design + Plate + Die_Cut_Mould + 
    (Die_Cutting * Units) + (Lamination * Units) + (Emboss * Units) +
    (Hot_Stamping * Units) + (Gluing * Units) +
    Packing + Transportation + Packing_Material) / Units),
    
    Total_Cost DECIMAL(7,2) GENERATED ALWAYS AS
    (Printing + Design + Plate + Die_Cut_Mould + 
    (Die_Cutting * Units) + (Lamination * Units) + (Emboss * Units) +
    (Hot_Stamping * Units) + (Gluing * Units) +
    Packing + Transportation + Packing_Material),
    
    FOREIGN KEY(Product_ID) REFERENCES Product(Product_ID) ON DELETE CASCADE
);

-- Cost Option ID Sequencing Table
CREATE TABLE Cost_Option_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

-- Cost Option ID Trigger
DELIMITER $$
CREATE TRIGGER TG_Cost_Option_Insert
BEFORE INSERT ON Cost_Option
FOR EACH ROW
BEGIN
	INSERT INTO Cost_Option_Seq VALUES (NULL);
    SET NEW.CO_ID = CONCAT('CO-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

SELECT * FROM Cost_Option;
DROP TABLE Cost_Option;
DROP TABLE Cost_Option_Seq;
DROP TRIGGER TG_Cost_Option_Insert;

ALTER TABLE Cost_Option
ADD Product_Name VARCHAR(50);

/* ------------------------------------------------------------------ */

CREATE TABLE Supplier (
	Supplier_ID VARCHAR(6) NOT NULL PRIMARY KEY DEFAULT '0',
    Supplier_Name VARCHAR(30) NOT NULL UNIQUE,
    Supplier_Type VARCHAR(20) NOT NULL,
    Email_Address VARCHAR(50) UNIQUE,
    Office_Address VARCHAR(150) UNIQUE,
    Office_Number VARCHAR(13) UNIQUE,
    Manager_Name VARCHAR(30) NOT NULL,
    Manager_Number VARCHAR(13) NOT NULL UNIQUE
);

CREATE TABLE Supplier_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Supplier_Insert
BEFORE INSERT ON Supplier
FOR EACH ROW
BEGIN
	INSERT INTO Supplier_Seq VALUES (NULL);
    SET NEW.Supplier_ID = CONCAT('S-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

DROP TABLE Supplier;
DROP TABLE Supplier_Seq;
DROP TRIGGER TG_Supplier_Insert;
SELECT * FROM Supplier;

/* ------------------------------------------------------------------ */




/* ----------------------------------------------------------------- 
SECONDARY TABLES: Quotation, Invoice, Delivery Order, Purchase_Order 
----------------------------------------------------------------- */

CREATE TABLE Quotation (
	Quotation_ID VARCHAR(6) NOT NULL PRIMARY KEY DEFAULT '0',
    Quotation_Creation_Date DATE NOT NULL,
    
    Client_ID VARCHAR(6) NOT NULL, -- FK
    FOREIGN KEY(Client_ID) REFERENCES Client(Client_ID) ON DELETE CASCADE,
    
    
    Product_ID VARCHAR(6) NOT NULL, -- FK
    FOREIGN KEY(Product_ID) REFERENCES Product(Product_ID) ON DELETE CASCADE,
    
    -- unique quotation fields
    CO1_ID VARCHAR(7) NOT NULL,
    CO2_ID VARCHAR(7),
    CO3_ID VARCHAR(7),
    FOREIGN KEY(CO1_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(CO2_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(CO3_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    
    Lead_Time INTEGER NOT NULL,
    Tolerance_Of_Quantity INTEGER NOT NULL,
    Terms_Of_Payment VARCHAR(70) NOT NULL,
    Quotation_Validity_Period INTEGER NOT NULL
);

ALTER TABLE Quotation
MODIFY COLUMN Lead_Time INTEGER;

ALTER TABLE Quotation
MODIFY COLUMN Tolerance_Of_Quantity INTEGER;

ALTER TABLE Quotation
MODIFY COLUMN Quotation_Validity_Period INTEGER;

CREATE TABLE Quotation_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Quotation_Insert
BEFORE INSERT ON Quotation
FOR EACH ROW
BEGIN
	INSERT INTO Quotation_Seq VALUES (NULL);
    SET NEW.Quotation_ID = CONCAT('Q-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

SELECT * FROM Quotation;
DROP TABLE Quotation;
DROP TABLE Quotation_Seq;
DROP TRIGGER TG_Quotation_Insert;

/* ------------------------------------------------------------------ */

CREATE TABLE Delivery_Order (
	DO_ID VARCHAR(7) NOT NULL PRIMARY KEY DEFAULT '0',
    
    Client_ID VARCHAR(6) NOT NULL, -- FK
    FOREIGN KEY(Client_ID) REFERENCES Client(Client_ID) ON DELETE CASCADE,

	-- unique DO fields
	Delivery_Address VARCHAR(150) NOT NULL,
    DO_Creation_Date DATE NOT NULL,
    Delivery_Mode VARCHAR(20) NOT NULL,
    Term_Days VARCHAR(20) NOT NULL,
    Salesman_Name VARCHAR(30) NOT NULL,
    
	Item_One_ID VARCHAR(7) NOT NULL,
    Item_Two_ID VARCHAR(7),
    Item_Three_ID VARCHAR(7),
    FOREIGN KEY(Item_One_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(Item_Two_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(Item_Three_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    Total_Packets INTEGER NOT NULL    
);

CREATE TABLE Delivery_Order_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Delivery_Order_Insert
BEFORE INSERT ON Delivery_Order
FOR EACH ROW
BEGIN
	INSERT INTO Delivery_Order_Seq VALUES(NULL);
    SET NEW.DO_ID = CONCAT('DO-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

SELECT * FROM Delivery_Order;

/* ------------------------------------------------------------------ */

CREATE TABLE Invoice (
	Invoice_ID VARCHAR(6) NOT NULL PRIMARY KEY DEFAULT '0',
    DO_ID VARCHAR(7) NOT NULL, -- FK
    FOREIGN KEY(DO_ID) REFERENCES Delivery_Order(DO_ID) ON DELETE CASCADE,
    
    Client_ID VARCHAR(6) NOT NULL, -- FK
    FOREIGN KEY(Client_ID) REFERENCES Client(Client_ID) ON DELETE CASCADE,
    
    -- unique invoice fields
    Delivery_Address VARCHAR(150) NOT NULL,
    Invoice_Creation_Date DATE NOT NULL,
    Term_Days VARCHAR(20) NOT NULL,
    Salesman_Name VARCHAR(30) NOT NULL,
    
    Item_One_ID VARCHAR(7) NOT NULL,
    Item_Two_ID VARCHAR(7),
    Item_Three_ID VARCHAR(7),
    FOREIGN KEY(Item_One_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(Item_Two_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    FOREIGN KEY(Item_Three_ID) REFERENCES Cost_Option(CO_ID) ON DELETE CASCADE,
    
    Tariff_Code VARCHAR(12) NOT NULL
);

CREATE TABLE Invoice_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Invoice_Insert
BEFORE INSERT ON Invoice
FOR EACH ROW
BEGIN
	INSERT INTO Invoice_Seq VALUES (NULL);
    SET NEW.Invoice_ID = CONCAT('I-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

SELECT * FROM Invoice;

/* ------------------------------------------------------------------ */

CREATE TABLE Purchase_Order (
	PO_ID VARCHAR(7) NOT NULL PRIMARY KEY DEFAULT '0',
    
    Supplier_ID VARCHAR(6) NOT NULL, -- FK
    
    FOREIGN KEY(Supplier_ID) REFERENCES Supplier(Supplier_ID) ON DELETE CASCADE,
    
    -- unique PO fields
    PO_Creation_Date DATE NOT NULL,
    Delivery_Address VARCHAR(150) NOT NULL,
    Description VARCHAR(60) NOT NULL,
    Quantity INTEGER NOT NULL,
    Unit_Price DECIMAL(7,2) NOT NULL,
    Total_Price DECIMAL(7,2) GENERATED ALWAYS AS
    (Quantity * Unit_Price)
);

CREATE TABLE Purchase_Order_Seq (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY
);

DELIMITER $$
CREATE TRIGGER TG_Purchase_Order_Insert
BEFORE INSERT ON Purchase_Order
FOR EACH ROW
BEGIN
	INSERT INTO Purchase_Order_Seq VALUES (NULL);
    SET NEW.PO_ID = CONCAT('PO-', LPAD(LAST_INSERT_ID(), 4, '0'));
END$$

SELECT * FROM Purchase_Order;
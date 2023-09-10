-- DATA VALIDATION FOR CLIENT TABLE
-- ------------------------------------

-- Email_Address
DELIMITER $$
CREATE TRIGGER TG_Client_Email_Check_BI BEFORE INSERT ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Email_Address REGEXP "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+(\.([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+)*\.[a-z]{2,6}$") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Enter a valid email address.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Client_Email_Check_BU BEFORE UPDATE ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Email_Address REGEXP "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+(\.([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+)*\.[a-z]{2,6}$") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Enter a valid email address.';
END IF; 
END$$
DELIMITER ;

-- Office_Number
DELIMITER $$
CREATE TRIGGER TG_Client_Office_Number_Check_BI BEFORE INSERT ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Office_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Client_Office_Number_Check_BU BEFORE UPDATE ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Office_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

-- First_Manager_Number
DELIMITER $$
CREATE TRIGGER TG_Client_First_Manager_Number_Check_BI BEFORE INSERT ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.First_Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Client_First_Manager_Number_Check_BU BEFORE UPDATE ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.First_Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

-- Second_Manager_Number
DELIMITER $$
CREATE TRIGGER TG_Client_Second_Manager_Number_Check_BI BEFORE INSERT ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Second_Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Client_Second_Manager_Number_Check_BU BEFORE UPDATE ON Client
FOR EACH ROW 
BEGIN 
IF (NEW.Second_Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

-- DATA VALIDATION FOR COST OPTION TABLE
-- ------------------------------------

-- Units, printing, design, plate, die_cut_mould
DELIMITER $$
CREATE TRIGGER TG_CO_Integer1_Check_BI BEFORE INSERT ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Units < 0 OR NEW.Printing < 0 OR NEW.Design < 0 OR NEW.Plate < 0 OR NEW.Die_Cut_Mould < 0) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Error: there is a negative value in units, printing, design, plate or die_cut_mould.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_CO_Integer1_Check_BU BEFORE UPDATE ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Units < 0 OR NEW.Printing < 0 OR NEW.Design < 0 OR NEW.Plate < 0 OR NEW.Die_Cut_Mould < 0) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Error: there is a negative value in units, printing, design, plate or die_cut_mould.';
END IF; 
END$$
DELIMITER ;

-- Die_cutting, lamination, emboss, hot_stamping, gluing
DELIMITER $$
CREATE TRIGGER TG_CO_Decimal_Check_BI BEFORE INSERT ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Die_Cutting < 0 OR NEW.Die_Cutting > 1 OR
	NEW.Lamination < 0 OR NEW.Lamination > 1 OR
    NEW.Emboss < 0 OR NEW.Emboss > 1 OR
    NEW.Hot_Stamping < 0 OR NEW.Hot_Stamping > 1 OR
    NEW.Gluing < 0 OR NEW.Gluing > 1) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Die_cutting, lamination, emboss, hot_stamping and gluing rates cannot be < 0 OR > 1.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_CO_Decimal_Check_BU BEFORE UPDATE ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Die_Cutting < 0 OR NEW.Die_Cutting > 1 OR
	NEW.Lamination < 0 OR NEW.Lamination > 1 OR
    NEW.Emboss < 0 OR NEW.Emboss > 1 OR
    NEW.Hot_Stamping < 0 OR NEW.Hot_Stamping > 1 OR
    NEW.Gluing < 0 OR NEW.Gluing > 1) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Die_cutting, lamination, emboss, hot_stamping and gluing rates cannot be < 0 OR > 1.';
END IF; 
END$$
DELIMITER ;

-- Packing, transportation, packing_material
DELIMITER $$
CREATE TRIGGER TG_CO_Integer2_Check_BI BEFORE INSERT ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Packing < 0 OR NEW.Transportation < 0 OR NEW.Packing_Material < 0) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Error: there is a negative value in packing, transportation or packing_material.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_CO_Integer2_Check_BU BEFORE UPDATE ON Cost_Option
FOR EACH ROW 
BEGIN 
IF (NEW.Packing < 0 OR NEW.Transportation < 0 OR NEW.Packing_Material < 0) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Error: there is a negative value in packing, transportation or packing_material.';
END IF; 
END$$
DELIMITER ;

-- DATA VALIDATION FOR SUPPLIER TABLE
-- ------------------------------------

-- Supplier_Type
DELIMITER $$
CREATE TRIGGER TG_Supplier_Type_Check_BI BEFORE INSERT ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Supplier_Type = 'Paper' OR NEW.Supplier_Type = 'Printing' OR NEW.Supplier_Type = 'Finishing') = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Invalid supplier type - options are paper, printing and finishing.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Supplier_Type_Check_BU BEFORE UPDATE ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Supplier_Type = 'Paper' OR NEW.Supplier_Type = 'Printing' OR NEW.Supplier_Type = 'Finishing') = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Invalid supplier type - options are paper, printing and finishing.';
END IF; 
END$$
DELIMITER ;

-- Email_Address
DELIMITER $$
CREATE TRIGGER TG_Supplier_Email_Check_BI BEFORE INSERT ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Email_Address REGEXP "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+(\.([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+)*\.[a-z]{2,6}$") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Enter a valid email address.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Supplier_Email_Check_BU BEFORE UPDATE ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Email_Address REGEXP "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+(\.([a-z0-9]+[a-z0-9-]*)*[a-z0-9]+)*\.[a-z]{2,6}$") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Enter a valid email address.';
END IF; 
END$$
DELIMITER ;

-- Office_Number
DELIMITER $$
CREATE TRIGGER TG_Supplier_Office_Number_Check_BI BEFORE INSERT ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Office_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Supplier_Office_Number_Check_BU BEFORE UPDATE ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Office_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

-- Manager_Number
DELIMITER $$
CREATE TRIGGER TG_Supplier_Manager_Number_Check_BI BEFORE INSERT ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Supplier_Manager_Number_Check_BU BEFORE UPDATE ON Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.Manager_Number REGEXP "0[0-9]*-[0-9]* [0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'There must be a dash and space to separate numbers in the phone number. (e.g. 012-3456 7890)';
END IF; 
END$$
DELIMITER ;

-- Quotation
-- ----------------------------

-- Lead_Time
DELIMITER $$
CREATE TRIGGER TG_Quotation_Lead_Time_Check_BI BEFORE INSERT ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Lead_Time OR NEW.Lead_Time > 365) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Lead_Time integer can only be between 1 to 365 days.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Quotation_Lead_Time_Check_BU BEFORE UPDATE ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Lead_Time OR NEW.Lead_Time > 365) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Lead_Time integer can only be between 1 to 365 days.';
END IF; 
END$$
DELIMITER ;

-- Tolerance_Of_Quantity
DELIMITER $$
CREATE TRIGGER TG_Quotation_TOQ_Check_BI BEFORE INSERT ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Tolerance_Of_Quantity OR NEW.Tolerance_Of_Quantity > 25) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Tolerance_Of_Quantity integer can only be between 1% to 25%.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Quotation_TOQ_Check_BU BEFORE UPDATE ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Tolerance_Of_Quantity OR NEW.Tolerance_Of_Quantity > 25) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Tolerance_Of_Quantity integer can only be between 1% to 25%.';
END IF; 
END$$
DELIMITER ;

-- Quotation_Validity_Period
DELIMITER $$
CREATE TRIGGER TG_Quotation_QVP_Check_BI BEFORE INSERT ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Quotation_Validity_Period OR NEW.Quotation_Validity_Period > 30) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Quotation_Validity_Period integer can only be between 1 to 30 days.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Quotation_QVP_Check_BU BEFORE UPDATE ON Quotation
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Quotation_Validity_Period OR NEW.Quotation_Validity_Period > 30) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Quotation_Validity_Period integer can only be between 1 to 30 days.';
END IF; 
END$$
DELIMITER ;

-- Delivery_Order
-- ----------------------

-- Total_Packets
DELIMITER $$
CREATE TRIGGER TG_DO_Total_Packets_Check_BI BEFORE INSERT ON Delivery_Order
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Total_Packets OR NEW.Total_Packets > 1000) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Total_Packets can only be between 1 to 1000.';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_DO_Total_Packets_Check_BU BEFORE UPDATE ON Delivery_Order
FOR EACH ROW 
BEGIN 
IF (1 > NEW.Total_Packets OR NEW.Total_Packets > 1000) THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Total_Packets can only be between 1 to 1000.';
END IF; 
END$$
DELIMITER ;

-- Invoice
-- ----------------------

-- Tariff_Code
DELIMITER $$
CREATE TRIGGER TG_Invoice_Tariff_Code_Check_BI BEFORE INSERT ON Invoice
FOR EACH ROW 
BEGIN 
IF (NEW.Tariff_Code REGEXP "[0-9]*-[0-9]*-[0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Tariff_Code must be in the format 1234-56-7890';
END IF; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TG_Invoice_Tariff_Code_Check_BU BEFORE UPDATE ON Invoice
FOR EACH ROW 
BEGIN 
IF (NEW.Tariff_Code REGEXP "[0-9]*-[0-9]*-[0-9]*") = 0 THEN 
  SIGNAL SQLSTATE '45000'
     SET MESSAGE_TEXT = 'Tariff_Code must be in the format 1234-56-7890';
END IF; 
END$$
DELIMITER ;

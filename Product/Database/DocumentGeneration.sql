
/* ----------------------------------------------------------------- 
MERGING FIELDS - DOCUMENT GENERATION 
----------------------------------------------------------------- */

/* QUOTATION FULL INFORMATION
----------------------------------------------------------------- */
CREATE VIEW Complete_Quotation AS
SELECT q.*,

c.Client_Name, c.Office_Address, c.First_Manager_Name,
c.First_Manager_Number, c.Second_Manager_Name, c.Second_Manager_Number,

p.Product_Name,

co1.Units CO1_Units, co1.Unit_Cost CO1_Unit_Cost,

co2.Units CO2_Units, co2.Unit_Cost CO2_Unit_Cost,

co3.Units CO3_Units, co3.Unit_Cost CO3_Unit_Cost

FROM Quotation q
JOIN Client c ON c.Client_ID = q.Client_ID
JOIN Product p ON p.Product_ID = q.Product_ID
JOIN Cost_Option co1 ON q.CO1_ID = co1.CO_ID
JOIN Cost_Option co2 ON q.CO2_ID = co2.CO_ID
JOIN Cost_Option co3 ON q.CO3_ID = co3.CO_ID;

/* DELIVERY ORDER FULL INFORMATION
----------------------------------------------------------------- */
CREATE VIEW Complete_Delivery_Order AS
SELECT do.*,

c.Client_Name,

co1.Product_Name Item_One_Name, co1.Units Item_One_Units,

co2.Product_Name Item_Two_Name, co2.Units Item_Two_Units,

co3.Product_Name Item_Three_Name, co3.Units Item_Three_Units 

FROM Delivery_Order do
JOIN Client c ON c.Client_ID = do.Client_ID
JOIN Cost_Option co1 ON do.Item_One_ID = co1.CO_ID
JOIN Cost_Option co2 ON do.Item_Two_ID = co2.CO_ID
JOIN Cost_Option co3 ON do.Item_Three_ID = co3.CO_ID;

/* INVOICE ADDITIONAL INFORMATION
----------------------------------------------------------------- */
CREATE VIEW Complete_Invoice AS
SELECT i.*, -- all invoice fields

c.Client_Name, c.Office_Address,
c.Office_Number, c.Email_Address, -- client fields

-- cost option fields
co1.Product_Name Item_One_Name, co1.Units Item_One_Units, co1.Unit_Cost Item_One_Unit_Cost, co1.Total_Cost Item_One_Total_Cost,

co2.Product_Name Item_Two_Name, co2.Units Item_Two_Units, co2.Unit_Cost Item_Two_Unit_Cost, co2.Total_Cost Item_Two_Total_Cost,

co3.Product_Name Item_Three_Name, co3.Units Item_Three_Units, co3.Unit_Cost Item_Three_Unit_Cost, co3.Total_Cost Item_Three_Total_Cost,

-- calculated fields
ROUND(((co1.Total_Cost + co2.Total_Cost + co3.Total_Cost) * 0.1), 2) Sales_Tax_Amount,
ROUND(((co1.Total_Cost + co2.Total_Cost + co3.Total_Cost) + (co1.Total_Cost + co2.Total_Cost + co3.Total_Cost) * 0.1), 2) Total_Price 

FROM Invoice i
JOIN Client c ON c.Client_ID = i.Client_ID
JOIN Cost_Option co1 ON i.Item_One_ID = co1.CO_ID
JOIN Cost_Option co2 ON i.Item_Two_ID = co2.CO_ID
JOIN Cost_Option co3 ON i.Item_Three_ID = co3.CO_ID; -- joining fields based on common IDs.

/* PURCHASE ORDER ADDITIONAL INFORMATION
----------------------------------------------------------------- */
CREATE VIEW Complete_Purchase_Order AS
SELECT po.*,

s.Supplier_Type, s.Supplier_Name, s.Office_Address,
s.Office_Number, s.Manager_Name, s.Manager_Number

FROM Purchase_Order po
JOIN Supplier s ON s.Supplier_ID = po.Supplier_ID;
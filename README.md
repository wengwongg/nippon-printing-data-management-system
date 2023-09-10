# Nippon Printing Data Management System

This is a project I did for my IBDP Computer Science coursework. It is a data management system for a packaging firm owner to manage their costs and orders data. There are two parts to the system. There is a database to store and manipulate all the costs and orders data while a front-end application is linked to the database, to allow the user to easily filter database records and automatically generate order documentation based on the data.

## Contents

Contained in this repo are two folders, "Documentation" and "Product". The "Documentation" folder contains the documentation of the entire project progress and on the system itself, while the "Product" folder contains the files to actually run the system.

Below are a whole list of installation steps. If you don't wish to perform all these installation steps, you can take a look at the "Documentation" folder. In that folder, there is a video file of me demonstrating the use of the system.

## How do I run and use the system?

1. Ensure that you have PHP, XAMPP, MySQL Workbench and MySQL Server installed.
2. Download the "Product" folder.

3. Run XAMPP and within the control panel, run the MySQL and Apache services to be able to run the web application on localhost.
4. Find the "htdocs" folder in the xampp application folder and drag and drop all the three folders in the "WebBasedApplication" folder (inside the "Product" folder) into it.

5. Open MySQL Workbench and create a new schema called "db_nippon_printing". This name is a must because I have ignorantly hard-coded this name in some areas of the project.
6. Select your new schema in MySQL Workbench.
7. Time to use the "Database" folder in the "Product" folder. First open the "TableCreation" script which is divided into different sections. Go through each section and highlight the portions of each section which include the "CREATE TABLE" and "CREATE TRIGGER" statements, and run them using the lightning icon.
8. Then, open the "DocumentGeneration" and "DataValidation" scripts and there is no need to highlight anything, just run each entire script.

9. Now, you have to alter the "config.php" files in the "nipponprintingdbdocgeneration" and "nipponprintingtables" folders found in the "WebBasedApplication" folder. This file establishes the connection to your database. You just have to input your password you set when configuring your MySQL workbench MySQL connection, into the "yourpassword" placeholder, IF you did set a password. Otherwise, leave the password value as "".

10. Now everything is ready and set up! To use the system, insert your own records into the database using MySQL workbench and use the web application by entering "localhost/nipponprintingmainpage" into your browser.

## Issues

- If you are having issues with the schema content not loading in MySQL Workbench, check <a target="_blank" href="https://stackoverflow.com/questions/56564410/tables-could-not-be-fetched-error-loading-schema-content">this</a> out.
- There is an issue with documentation database views. Records won't be automatically created unless all the fields of records in respective tables are completely filled out (e.g. a quotation record contains all three cost option values although the last two should be optional). To be able to generate order documentation, you have to completely fill in the fields when creating records in the Delivery_Order, Invoice, Quotation and Purchase_Order tables.
- I am also aware of the issue where empty order documentation is generated when you enter a non-existent, but "valid" id. Just one of the few flaws of the system as this was my first real project.
- I know that the web application isn't completely responsive. This is a result of my previous lack of experience with responsive web design.

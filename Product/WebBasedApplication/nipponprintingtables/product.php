<?php

$errorsearch = '';
$errordate = '';

include "config.php";

$sql = "SELECT * FROM Product ";

if (isset($_POST['search'])) {
    
    // data validation
    if (empty($_POST['search-box'])) {
        $errorsearch = 'You have not inputted a value to search.';
    } else {
        // search for value. If there are no matching values, present headings only.
        $result = mysqli_real_escape_string($mysqli, $_POST['search-box']);
        $sql .= "WHERE Product_ID = '{$result}'";
        $sql .= " OR Client_ID = '{$result}'";
        $sql .= " OR Product_Name = '{$result}'";
    }
}

if (isset($_POST['search-date'])) {

    // data validation
    if (empty($_POST['search-date-box'])) {
        $errordate = 'You have not inputted a date value to search.';
    } else {
        $result = mysqli_real_escape_string($mysqli, $_POST['search-date-box']);

        if(!preg_match('^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$^', $result)) {
            $errordate = 'You must enter the date in YYYY-MM-DD.';
        } else {
            $sql .= "WHERE Product_Creation_Date = '{$result}'";
        }
    }
}

$query = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Product</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="images/logoonly.png">
  </head>

  <body>
    
    
    <form name="search-form" method="POST" action="product.php">
        <input class="form-control form-input" type="text" name="search-box" value="" placeholder="Search for record(s) with specified value here.">
        <div class="red-text"><?php echo $errorsearch; ?></div>
        <input class="search-button" type="submit" name="search" value="Search">
    </form>

    <form name="search-date-form" method="POST" action="product.php">
        <input class="form-control form-input" type="text" name="search-date-box" value="" placeholder="Search for record(s) with specified date (YYYY-MM-DD) here.">
        <div class="red-text"><?php echo $errordate; ?></div>
        <input class="search-button" type="submit" name="search-date" value="Search">
    </form>
    

    <table width="80%" cellpadding="8" cellspace="7">
        <tr class="field-names">
            <td>Product_ID</td>
            <td>Client_ID</td>
            <td>Product_Name</td>
            <td>Product_Creation_Date</td>
        </tr>
    
        <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['Product_ID']; ?></td>
            <td><?php echo $row['Client_ID']; ?></td>
            <td><?php echo $row['Product_Name']; ?></td>
            <td><?php echo $row['Product_Creation_Date']; ?></td>
        </tr>
        <?php } ?>

    </table>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
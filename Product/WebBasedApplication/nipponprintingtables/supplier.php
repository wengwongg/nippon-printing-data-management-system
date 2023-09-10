<?php

$error = '';

include "config.php";

$sql = "SELECT * FROM Supplier ";

if (isset($_POST['search'])) {

  // data validation
  if(empty($_POST['search-box'])) {
    $error = 'You have not inputted a value to search.';
  } else {
    // search for value.
    $result = mysqli_real_escape_string($mysqli, $_POST['search-box']);
    $sql .= "WHERE Supplier_ID = '{$result}'";
    $sql .= " OR Supplier_Name = '{$result}'";
    $sql .= " OR Supplier_Type = '{$result}'";
    $sql .= " OR Email_Address = '{$result}'";
    $sql .= " OR Office_Address = '{$result}'";
    $sql .= " OR Office_Number = '{$result}'";
    $sql .= " OR Manager_Name = '{$result}'";
    $sql .= " OR Manager_Number = '{$result}'";
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

    <title>Supplier</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="images/logoonly.png">
  </head>

  <body>
    
    <form name="search-form" method="POST" action="supplier.php">
        <input class="form-control form-input" type="text" name="search-box" value="" placeholder="Search for record(s) with specified value here.">
        <div class="red-text"><?php echo $error; ?></div>
        <input class="search-button" type="submit" name="search" value="Search">
    </form>

    <table width="80%" cellpadding="8" cellspace="7">
        <tr class="field-names">
            <td>Supplier_ID</td>
            <td>Supplier_Name</td>
            <td>Supplier_Type</td>
            <td>Email_Address</td>
            <td>Office_Address</td>
            <td>Office_Number</td>
            <td>Manager_Name</td>
            <td>Manager_Number</td>
        </tr>
    
        <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['Supplier_ID']; ?></td>
            <td><?php echo $row['Supplier_Name']; ?></td>
            <td><?php echo $row['Supplier_Type']; ?></td>
            <td><?php echo $row['Email_Address']; ?></td>
            <td><?php echo $row['Office_Address']; ?></td>
            <td><?php echo $row['Office_Number']; ?></td>
            <td><?php echo $row['Manager_Name']; ?></td>
            <td><?php echo $row['Manager_Number']; ?></td>
        </tr>
        <?php } ?>

    </table>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
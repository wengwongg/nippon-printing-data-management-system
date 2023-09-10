<?php

$error = '';

include "config.php";

$sql = "SELECT * FROM Cost_Option ";

if (isset($_POST['search'])) {

  // data validation
  if(empty($_POST['search-box'])) {
    $error = 'You have not inputted a value to search.';
  } else {
    // search for value.
    $result = mysqli_real_escape_string($mysqli, $_POST['search-box']);
    $sql .= "WHERE CO_ID = '{$result}'";
    $sql .= " OR Product_ID = '{$result}'";
    $sql .= " OR Product_Name = '{$result}'";
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

    <title>Cost Option</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="images/logoonly.png">
  </head>

  <body>
    
    <form name="search-form" method="POST" action="cost_option.php">
        <input class="form-control form-input" type="text" name="search-box" value="" placeholder="Search for record(s) with specified value here.">
        <div class="red-text"><?php echo $error; ?></div>
        <input class="search-button" type="submit" name="search" value="Search">
    </form>

    <table width="80%" cellpadding="8" cellspace="7">
        <tr class="field-names">
            <td>CO_ID</td>
            <td>Product_ID</td>
            <td>Product_Name</td>
            <td>Units</td>
            <td>Printing</td>
            <td>Design</td>
            <td>Plate</td>
            <td>Die_Cut_Mould</td>
            <td>Die_Cutting</td>
            <td>Lamination</td>
            <td>Emboss</td>
            <td>Hot_Stamping</td>
            <td>Gluing</td>
            <td>Packing</td>
            <td>Transportation</td>
            <td>Packing_Material</td>
            <td>Unit_Cost</td>
            <td>Total_Cost</td>
        </tr>
    
        <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['CO_ID']; ?></td>
            <td><?php echo $row['Product_ID']; ?></td>
            <td><?php echo $row['Product_Name']; ?></td>
            <td><?php echo $row['Units']; ?></td>
            <td><?php echo $row['Printing']; ?></td>
            <td><?php echo $row['Design']; ?></td>
            <td><?php echo $row['Plate']; ?></td>
            <td><?php echo $row['Die_Cut_Mould']; ?></td>
            <td><?php echo $row['Die_Cutting']; ?></td>
            <td><?php echo $row['Lamination']; ?></td>
            <td><?php echo $row['Emboss']; ?></td>
            <td><?php echo $row['Hot_Stamping']; ?></td>
            <td><?php echo $row['Gluing']; ?></td>
            <td><?php echo $row['Packing']; ?></td>
            <td><?php echo $row['Transportation']; ?></td>
            <td><?php echo $row['Packing_Material']; ?></td>
            <td><?php echo $row['Unit_Cost']; ?></td>
            <td><?php echo $row['Total_Cost']; ?></td>
        </tr>
        <?php } ?>

    </table>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
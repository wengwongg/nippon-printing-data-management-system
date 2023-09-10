<?php
$error = '';

include "config.php";

if (isset($_GET['pdf_quotation_generate'])) {
  // data validation
  if (empty($_GET['Quotation_ID'])) {
    $error = 'You have not inputted an ID to search.';
  } else {
    $result = mysqli_real_escape_string($mysqli, $_GET['Quotation_ID']);

    if(!preg_match('^Q-\d{4}^', $result)) {
      $error = 'You must input a value in the form of Q-0001';
    } else {
      header('Location: generatequotationpdf.php?Quotation_ID='.$result.'&pdf_quotation_generate=');
    }
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Nippon Printing Database Document Generation Tool</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="images/logoonly.png">
  </head>

  <body>
    
    <div class="container">
      <div class="heading">
        <img class="logo" src="images/logotransparentright.png">
        <h1 id="title">Quotation</h1>
      </div>

      <form method="get" action="quotation.php">
        <div class="form-group">
          <label for="Quotation_ID">Enter Quotation ID</label>
          <input type="text" class="form-control form-input" id="Quotation_ID" name="Quotation_ID" placeholder="Please input quotation ID in the form of Q-0001.">
          <div class="red-text"><?php echo $error; ?></div>
        </div>

        <button type="submit" name="pdf_quotation_generate">Generate</button>
      </form>

      <!-- DONE? # CHECK NAME ABOVE. weird name and value attributes - check sources doc for link -->
      
    </div>
    

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
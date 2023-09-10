<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Nippon Printing Database Viewer</title>

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
        <h1 id="title">Database Viewer</h1>
      </div>
      
      <div class="nav">
        <button onclick="document.location='client.php'">Client</button>
        <button onclick="document.location='product.php'">Product</button>
        <button onclick="document.location='cost_option.php'">Cost Option</button>
        <button onclick="document.location='supplier.php'">Supplier</button>
        <button onclick="document.location='quotation.php'">Quotation</button>
        <button onclick="document.location='delivery_order.php'">Delivery Order</button>
        <button onclick="document.location='invoice.php'">Invoice</button>
        <button onclick="document.location='purchase_order.php'">Purchase Order</button>
      </div>
    </div>
    

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
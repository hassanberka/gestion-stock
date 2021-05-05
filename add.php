<?php

// require the configration database 
require_once 'config/db_connect.php';
require_once 'check.php';


// init the variable for prevent the undefined error
$email = $productname = $quantity =  $quantity_min = '';

// init the error arrays
$errors = array('email' => '', 'productname' => '', 'quantity' => '', 'quantity-minimal' => '');

// check if the submit button is set
if (isset($_POST['submit'])) {

  // validate the email
  if (empty($_POST['Email'])) {
    $errors['email'] = "Email is required <br/>";
  } else {
    $email = $_POST['Email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "email must be a valid email";
    }
  }

  // validate the product name
  if (empty($_POST['product-name'])) {
    $errors['productname'] =  "product name is required <br/>";
  } else {
    $productname = $_POST['product-name'];
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $productname)) {
      $errors['productname'] = 'product name must be letter,numbers and spaces only';
    }
  }

  // validate the quantity
  if (empty($_POST['quantity'])) {
    $errors['quantity'] = "quantity is required <br/>";
  } else {
    $quantity = $_POST['quantity'];
    if (!preg_match('/^[1-9\s]+$/', $quantity)) {
      $errors['quantity'] = 'quantity must be just numbers';
    }
  }

  // validate the quantity minimale
  if (empty($_POST['quantity-minimal'])) {
    $errors['quantity-minimal'] = "quantity minimal is required <br/>";
  } else {
    $quantity_min = $_POST['quantity-minimal'];
    if (!preg_match('/^[0-9\s]+$/', $quantity_min)) {
      $errors['quantity-minimal'] = 'quantity minimale must be just numbers';
    }
  }



  // insert into the product pages 
  if (!array_filter($errors)) {

    // define variable 

    $productname = mysqli_real_escape_string($conn, $_POST['product-name']);
    $quantity_min = mysqli_real_escape_string($conn, $_POST['quantity-minimal']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);

    // insert into produit table 
    $sql = "INSERT INTO produit(libelle , quantite_minimale , quantite_en_stock ,email) VALUES ('$productname' , '$quantity_min' , '$quantity' , '$email')";

    // redirect to home page
    header('location: home.php');

    if (!mysqli_query($conn, $sql)) {
      echo 'query error' . mysqli_error($conn);
    }
  }
} // end 

?>

<?php
require_once 'templates/header.php';

?>
<h4 class="text-center">Add a new product</h4>


<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="row g-3 align-items-center mb-3 ml-5">
      <div class="col-auto">
        <label id="product" class="label">Email</label>
        <input type="text" id="product-name" class="form-control" name="Email" value="<?php echo htmlspecialchars($email)  ?>">
        <div class="text-danger label"><?php echo $errors['email']; ?></div>
      </div>
    </div>
    <div class="row g-3 align-items-center mb-3 ml-5">
      <div class="col-auto">
        <label id="product" class="label">Product name</label>
        <input type="text" id="product-name" class="form-control" name="product-name" value="<?php echo htmlspecialchars($productname) ?>">
        <div class="text-danger label"><?php echo $errors['productname']; ?></div>
      </div>
    </div>
    <div class="row g-3 align-items-center mb-3 ml-5">
      <div class="col-auto">
        <label class="label">quantity</label>
        <input type="text" id="quantity" class="form-control" name="quantity" value="<?php echo htmlspecialchars($quantity) ?>">
        <div class="text-danger label"><?php echo $errors['quantity']; ?></div>
      </div>
    </div>
    <div class="row g-3 align-items-center mb-3 ml-5">
      <div class="col-auto">

        <label class="label">quantity-minimal</label>
        <input type="text" id="quantity-minimal" class="form-control" name="quantity-minimal" value="<?php echo htmlspecialchars($quantity_min) ?>">
        <div class="text-danger label"><?php echo $errors['quantity-minimal']; ?></div>
      </div>
    </div>
    <button type="submit" class="btn btn-success button" name="submit">Add new product</button>
  </form>
</div>
<?php
require_once 'templates/footer.php';
?>
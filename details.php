<?php

require_once 'config/db_connect.php';
require_once 'check.php';

//delete
if (isset($_POST['delete'])) {

  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete_edit']);

  $sql = "DELETE FROM `produit` WHERE id = $id_to_delete";


  if (mysqli_query($conn, $sql)) {
    header('location: home.php');
  } else {
    echo 'query error' . mysqli_error($conn);
  }
}
// edit
if (isset($_POST['edit'])) {
  $id_to_edit = mysqli_real_escape_string($conn, $_POST['id_to_delete_edit']);

  $updated_quantity =  $_POST['edit_quantity'];

  $sql =  "UPDATE `produit` SET quantite_en_stock = $updated_quantity WHERE id = $id_to_edit";

  if (mysqli_query($conn, $sql)) {

    header('location: home.php');
  } else {

    echo 'query error' . mysqli_error($conn);
  }
}

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM `produit` WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  $product = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'templates/header.php'; ?>
<h3 class="text-center">Details</h3>
<div class="container text-center">
  <?php if ($product) : ?>
    <h4><?php echo htmlspecialchars($product['libelle']) ?></h4>
    <h4>id : <?php echo htmlspecialchars($product['id']) ?></h4>
    <h4> Created by : <?php echo htmlspecialchars($product['email']) ?></h4>
    <h4> quantity minimale : <?php echo htmlspecialchars($product['quantite_minimale']) ?></h4>
    <h4> quantity en stock : <?php echo htmlspecialchars($product['quantite_en_stock']) ?></h4>
    <form class="mt-5 mb-5" action="details.php" method="POST">
      <input type="hidden" name="id_to_delete_edit" value="<?php echo $product['id'] ?>">
      <input type="submit" name="delete" value="Delete" class="btn btn-danger">
    </form>
  <?php else : ?>
    <h4>no such a product existe</h4>
  <?php endif; ?>
  <form class="mb-5" action="details.php" method="POST">
    <input type="hidden" name="id_to_delete_edit" value="<?php echo $product['id'] ?>">
    <input type="text" name="edit_quantity" placeholder="edit_quantity" class="form-control mb-5">
    <input type="submit" name="edit" value="edit" class="btn btn-primary">
  </form>
</div>
<?php require_once 'templates/footer.php'; ?>
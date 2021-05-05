<?php

require_once 'config/db_connect.php';
require_once 'check.php';

//select the product that almost finish
$sql = "SELECT * FROM `produit`  WHERE quantite_minimale > quantite_en_stock";

$result = mysqli_query($conn, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);
?>
<?php require_once 'templates/header.php'; ?>
<h4 class="text-center mb-5 mt-4">Productes that almost finish</h4>
<div class="container">
  <div class="row ">
    <?php foreach ($products as $product) : ?>
      <div class="card ml-5 mb-5" style="width: 18rem;">
        <img src="img/img.jpg" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title text-center"><?php echo htmlspecialchars($product['libelle']) ?></h5>
          <p class="card-text mt-4"><?php echo 'quantite_minimale : ' . htmlspecialchars($product['quantite_minimale']) ?></p>
          <p class="card-text text-danger"><?php echo 'quantite_en_stock : ' .  htmlspecialchars($product['quantite_en_stock']) ?></p>
          <a href="details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary ml-5 mg">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require_once 'templates/footer.php'; ?>
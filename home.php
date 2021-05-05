 <?php
  require_once 'config/db_connect.php';
  require_once 'check.php';

  // display the data from database
  $sql = "SELECT * FROM `produit`  ORDER BY `id`";

  // query the data into the database
  $result = mysqli_query($conn, $sql);

  // fetch the data into a assoc array
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free the result
  mysqli_free_result($result);

  //close the connection
  mysqli_close($conn);

  // check if the button click for filter the data
  if (isset($_POST['Almostefinish'])) {
    header("location: almost.php");
  }
  ?>

 <?php require_once 'templates/header.php'; ?>
 <h4 class="text-center mb-5 mt-4">Productes</h4>
 <div class="container ">
   <form action="home.php" method="POST" class="ml-5 mb-5 center">
     <input type="submit" name="Almostefinish" value="Almoste finish" class="btn btn-danger ml-5">
   </form>
 </div>
 <div class="container">
   <div class="row ">
     <?php foreach ($products as $product) : ?>
       <div class="card ml-5 mb-5" style="width: 18rem;">
         <img src="img/img.jpg" class="card-img-top">
         <div class="card-body">
           <h5 class="card-title text-center"><?php echo htmlspecialchars($product['libelle']) ?></h5>
           <p class="card-text mt-4"><?php echo 'quantite_minimale : ' . htmlspecialchars($product['quantite_minimale']) ?></p>

           <p class="card-text <?php if (htmlspecialchars($product['quantite_minimale']) > htmlspecialchars($product['quantite_en_stock'])) : ?>text-danger <?php else :  ?>text-success<?php endif; ?>">


             <?php echo 'quantite_en_stock : ' .  htmlspecialchars($product['quantite_en_stock']) ?></p>
           <a href="details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary ml-5 mg">Edit</a>
         </div>
       </div>
     <?php endforeach; ?>
   </div>
 </div>
 <?php require_once 'templates/footer.php'; ?>
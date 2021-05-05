
<?php
// connect to dtatbase
$conn = mysqli_connect('localhost', 'root', '', 'souqstock');
if (!$conn) {
  echo 'connection err' . mysqli_connect_error();
}
?>

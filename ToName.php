<?php
include_once 'filmClass.php';
include 'main_menu.html';
if (isset( $_GET['film'] )) {
  foreach ($_GET['film'] as $film) {
    $delimiter =  ",";
    $token = strtok($film, $delimiter);
    $title = $token;
    $token =strtok($delimiter);
    $desc = $token;
    $token =strtok($delimiter);
    $rey = $token;
    $token =strtok($delimiter);
    $_SESSION['films'][] = new film($title,$desc,$rey);
  }
}
if (isset($_GET['show'])&&isset($_SESSION['films'])) {
  ?>
  <form action="ToName.php" method="get">
    <input type="submit" value="Hide wishlist">
  </form>
  <table style="text-align:center" border="1">
        <tr>
          <td>Title</td>
          <td>Description</td>
          <td>Release Year</td>
        </tr>
        <?php
        foreach ($_SESSION['films'] as $film) {
          $title=$film->title;
          $desc=$film->description;
          $rey=$film->release_year;
          echo "
          <tr>
          <td>$title</td>
          <td>$desc</td>
          <td>$rey</td>
          </tr>";
        }
  ?>
</table>
<?php
}
else{?>
  <form action="ToName.php" method="get">
    <input type="submit" name="show" value="show wishlist">
  </form>
  <?php
}
 ?>

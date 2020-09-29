<?php
  include_once 'filmClass.php';
  $IP = "localhost";
  $port = "3308";
  $user="root";
  $password="";
  $dbname="sakila";
  $By = $_GET['By'];
  $keyword = $_GET['keyword'];
  $query = "select title,description,release_year from film where ".$By." like '%".$keyword."%';";
  $con = mysqli_connect($IP.":".$port, $user, $password, $dbname);
  $link = "searchBy.php?By=$By&keyword=$keyword";
  if (!$con) {
    die("the connection to the sakila db has encontred some error(s)");
  }
  $set = mysqli_query($con,$query);
  if (!$set) {
    die("the connection was successful but there is an error regarding the query !!!");
  }?>
  <form action="ToName.php" method="get" align="center">
    <table align="center" style="text-align:center" border="1">
      <tr>
        <td>Title</td>
        <td>Description</td>
        <td>Release Year</td>
      </tr>
      <?php
      if (isset($_GET['page'])) {
        mysqli_data_seek($set,$_GET['page']);
      }
      $line = mysqli_fetch_array($set,MYSQLI_ASSOC);
      $counter=0;
      while ($line&&$counter!=10  ) {
        $title=$line['title'];
        $desc=$line['description'];
        $rey=$line['release_year'];
        echo '
          <tr>
            <td>'.$title.'</td>
            <td>'.$desc.'</td>
            <td>'.$rey.'</td>
            <td><input type="checkbox" name="film[]" value="'."$title,$desc,$rey".'"></td>
          </tr>';
        $line = mysqli_fetch_array($set,MYSQLI_ASSOC);
        $counter++;
      }
      ?>
    </table>
    <input type="submit" value="add checked to wishlist">
</form>
  <div style="text-align:center">
  <?php
  for ($i=0; $i < mysqli_num_rows($set)/10; $i++) {
		echo '<a href="'.$link.'&page='.$i.'">'.($i+1).'</a>&nbsp&nbsp&nbsp&nbsp&nbsp';
	}
 ?>
</div>

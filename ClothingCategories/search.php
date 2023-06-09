<?php
include_once '../header.php';
?>

<?php
require_once '../includeFiles/db.inc.php';
$searchTerm = $_GET['search'];
$sql = "SELECT * FROM listing WHERE Title LIKE '%{$searchTerm}%' AND Visibility = 1";
$statement = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../ClothingCategories/search.php?error=statementfailed");
    exit();
}
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($statement);
?>
<h2> Displaying results for "<?php echo $searchTerm ?>" </h2>
<?php
if ($rows !== false && count($rows) > 0) {
    foreach ($rows as $l) {
        $id = $l['ListingID'];
        $price = $l['Price'];
        $title = $l['Title'];
        $gallery = $l['GalleryID'];
        $sql = "SELECT PhotoURL FROM photo WHERE GalleryID = $gallery";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location: ../ClothingCategories/search.php?error=statementfailed");
            exit();
        }
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $image = mysqli_fetch_assoc($result)['PhotoURL'];
        mysqli_stmt_close($statement);
        ?>
        <div class = "item">
            <h1 class = "item"> <a href="item.php?product=<?php echo $id ?>" style="text-decoration:none; color:inherit;"><?php echo $title ?></a> </h1>
            <br> <a href="item.php?product=<?php echo $id ?>"><img src = <?php echo $image ?> class = "img_dis" width="200" height="200"> </a>
            <br><h2 class = "price">$ <?php echo $price; ?></h2>
        </div>
        <?php 
    }
}
else{?>
    <section class="None Found">
    <h1> Sorry, no items with this search term were found! </h1>
    </section>
<?php 
}  ?>

<?php
include_once '../footer.php';
?>

<style>
  .item {
    display: inline-block;
    margin-right: 20px; 
    margin-left: 20px; 
    vertical-align: top; 
    color: black;
  }
  .price {
    display: inline-block;
    margin-right: 20px; 
    margin-left: 20px; 
    vertical-align: top; 
    left: 25%;
  }
</style>
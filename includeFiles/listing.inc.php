<!DOCTYPE html>
<html>

<head>
    <title>Create Listing</title>
</head>

<body>
    <center>
        <?php
        require_once 'db.inc.php';

        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        // Retrieve form data
        $color = $_REQUEST['color'];
        $condition = $_REQUEST['condition'];
        $brand = $_REQUEST['brand'];
        $gender = $_REQUEST['gender'];
        $price = $_REQUEST['price'];
        $title = $_REQUEST['title'];
        $url = "url/testing";
        $category = $_REQUEST['category'];
        $image = $_REQUEST['photo'];
        $verificationID = uniqid();
        $date = date("Y-m-d");
        $visibility = "available";

        // Insert into verification table
        $sql = "INSERT INTO verification (`Verification ID`) VALUES ('$verificationID')";

        // Disable foreign key checks
        $sql = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($conn, $sql);

        // Insert into photos table
        $sql = "INSERT INTO photos (`Image`, `URL`) VALUES ('$image', '$url')";
        mysqli_query($conn, $sql);
        $galleryID = mysqli_insert_id($conn);

        // Insert into listing table
        $sql = "INSERT INTO listing (`Clothing Category`, `Date`, Visibility, Price, `Verification ID`, Title, `Gallery ID`) VALUES ('$category', '$date', '$visibility', '$price', '$verificationID', '$title', '$galleryID')";
        mysqli_query($conn, $sql);

        $listingID = mysqli_insert_id($conn);

        // Insert into clothing table
        $sql = "INSERT INTO clothing ( `Colour`, `Clothing Condition`, `Brand`, `Gender`, `Listing ID`) VALUES ('$color', '$condition', '$brand', '$gender', '$listingID')";
        mysqli_query($conn, $sql);
        $clothingID = mysqli_insert_id($conn);

        // Insert into appropriate clothing category table
        switch ($category) {
            case "bottoms":
                $inseam = $_POST['inseam'];
                $waist = $_POST['waist'];
                $hip = $_POST['hip'];
                $sql = "INSERT INTO bottoms (`Clothing ID`, Inseam, Waist, Hip) VALUES ('$clothingID', '$inseam', '$waist', '$hip')";
                header("location: ../../ClothingCategories/Bottoms.php");
                break;
            case "tops":
                $chest = $_POST['chest'];
                $waist = $_POST['waist'];
                $hip = $_POST['hip'];
                $sql = "INSERT INTO tops (`Clothing ID`, Chest, Waist, Hip) VALUES ('$clothingID', '$chest', '$waist', '$hip')";
                header("location: ../../ClothingCategories/Tops.php");
                break;
            case "shoes":
                $shoe_size = $_POST['shoe_size'];
                $sql = "INSERT INTO shoes (`Clothing ID`, `Shoe Size`) VALUES ('$clothingID', '$shoe_size')";
                header("location: ../../ClothingCategories/Shoes.php");
                break;
            case "accessories":
                $type = $_POST['accessory_type'];
                $sql = "INSERT INTO accessories (`Clothing ID`, Type) VALUES ('$clothingID', '$type')";
                header("location: ../../ClothingCategories/Accessories.php");
                break;
        }


        mysqli_query($conn, $sql);

        mysqli_close($conn);



        ?>
    </center>
</body>

</html>
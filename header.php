<!-- Modularizes code by putting the header/navbar that is included in every page, on a 
seperate page. Is included in every page along with the footer. -->
<?php
session_start();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ClotheSwap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">ClotheSwap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../ClothingCategories/Tops.php">Tops</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../ClothingCategories/Bottoms.php">Bottoms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../ClothingCategories/Shoes.php">Shoes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../ClothingCategories/Accessories.php">Accessories</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sign Up/Login
                            </a>
                            <ul class="dropdown-menu">

                                <!-- Adding buttons to visit profile page and logout, for users who have signed in and are logged in -->
                                <?php
                                if (isset($_SESSION["sessPwd"])) {
                                    echo "<li><a class='dropdown-item' href='../UserRegistration/profile.php'>Profile Page</a></li>";
                                    echo "<li><a class='dropdown-item' href='../includeFiles/logout.inc.php'>Log Out</a></li>";
                                } else {
                                    echo "<li><a class='dropdown-item' href='../UserRegistration/signup.php'>Sign Up</a></li>";
                                    echo "<li><a class='dropdown-item' href='../UserRegistration/login.php'>Log In</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="../ClothingCategories/search.php">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
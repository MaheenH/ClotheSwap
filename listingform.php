<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a Listing</title>
    <link href="<https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css>" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        main {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            margin-bottom: 10px;
            padding: 8px 4px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #0B7189;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00796b;
        }

    </style>
</head>

<body>
    <main>
        <h1>Make a Listing</h1>
        <form action="includeFiles/listing.inc.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">

            <label for="category">Category:</label>
            <select name="category" id="category" onchange="showOptions(this.value)">
                <option value="bottoms" selected>Bottoms</option>
                <option value="tops">Tops</option>
                <option value="shoes">Shoes</option>
                <option value="accessories">Accessories</option>
            </select>

            <div id="options">
                <label for="inseam">Inseam:</label>
                <input type="text" name="inseam" id="inseam" style="max-width: 50px">

                <label for="waist">Waist:</label>
                <input type="text" name="waist" id="waist"style="max-width: 50px">

                <label for="hip">Hip:</label>
                <input type="text" name="hip" id="hip"style="max-width: 50px">
            </div>

            <label for="price">Price:</label>
            <input type="text" name="price" id="price">

            <label for="color-select">Select a color:</label>
            <select id="color-select" name="color">
                <option value="red">Red</option>
                <option value="orange">Orange</option>
                <option value="yellow">Yellow</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="purple">Purple</option>
                <option value="white">White</option>
                <option value="black">Black</option>
            </select>

            <label for="style-select">Select a style:</label>
            <select id="style-select" name="style">
                <option value="casual">Casual</option>
                <option value="professional">Professional</option>
                <option value="formal">Formal</option>
                <option value="athletic">Athletic</option>
                <option value="vintage">Vintage</option>
            </select>

            <label for="condition-select">Select a condition:</label>
            <select id="condition-select" name="condition">
                <option value="nwt">New With Tags</option>
                <option value="likenew">Like New</option>
                <option value="used">Gently Used</option>
            </select>

            <label for="gender-select">Select a gender:</label>
            <select id="gender-select" name="gender">
                <option value="male">Men's</option>
                <option value="female">Women's</option>
                <option value="unisex">Unisex</option>
            </select>

            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand">

            <label for="photo">Upload Photo:</label>
            <input type="file" name="photo" id="photo" style="padding: 20px;" multiple> <br><br>

			<input type="submit" value="Submit">

        </form>
    </main>
    <script>
        function showOptions(val) {
            let options = document.getElementById("options");
            options.innerHTML = "";
            if (val == "bottoms") {
                options.innerHTML += `
                <label for="inseam">Inseam:</label>
                <input type="text" name="inseam" id="inseam" style="max-width: 50px">

                <label for="waist">Waist:</label>
                <input type="text" name="waist" id="waist" style="max-width: 50px">

                <label for="hip">Hip:</label>
                <input type="text" name="hip" id="hip" style="max-width: 50px">
                `;
            }
            else if (val == "tops") {
                options.innerHTML += `
                <label for="chest">Chest:</label>
                <input type="text" name="chest" id="chest" style="max-width: 50px">

                <label for="waist">Waist:</label>
                <input type="text" name="waist" id="waist" style="max-width: 50px">

                <label for="hip">Hip:</label>
                <input type="text" name="hip" id="hip" style="max-width: 50px">
                `;
            }
            else if (val == "shoes") {
                options.innerHTML += `
                <label for="shoe_size">Shoe Size:</label>
                <input type="text" name="shoe_size" id="shoe_size" style="max-width: 50px">
                `;
            }
            else if (val == "accessories") {
                options.innerHTML += `
                <label for="accessory_type">Type:</label>
                <select name="accessory_type" id="accessory_type">
                    <option value="hat">Hat</option>
                    <option value="bag">Bag</option>
                    <option value="jewelry">Jewelry</option>
                    <option value="belt">Belt</option>
                    <option value="scarf">Scarf</option>
                </select>
                `;
            }
        }
    </script>
</body>

</html>

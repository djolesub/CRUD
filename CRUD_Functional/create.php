<?php
    require_once "config/db_params.php";
    $prodect_name=$prodect_description=$prodect_price="";
    function getClean($data){
        $data = trim($data);
        $data = htmlentities($data);
        return $data;
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $errors = array();
        //Product Name
        if(isset($_POST['name']) && !empty($_POST['name'])){
            $product_name = $_POST['name'];
        }else {
            $errors['name'] = "You must enter product name";
        }
        //Product Description
        if(isset($_POST['description']) && !empty($_POST['description'])){
            $product_description = $_POST['description'];
        }else {
            $errors['description'] = "You must enter product description";
        }

        //Product Price
        if(isset($_POST['price']) && !empty($_POST['price'])){
            $product_price = (float)($_POST['price']);
        }else {
            $errors['price'] = "You must enter product price";
        }
        if(!$errors){

            try {
                $sql = "INSERT INTO product(name,description,price) VALUES(:name,:description,:price)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":name",$product_name);
                $stmt->bindParam(":description",$product_description);
                $stmt->bindParam(":price",$product_price);
                $stmt->execute();
            }
            catch(PDOException $e) {
                echo "Error while inserting: {$e->getMessage()}";
            }
            if($stmt){
                header("Location:read.php");

            }else {
                echo "Errors";
            }




        }


    }




?>


<?php require_once "header.inc.php"; ?>
<div class="container">
    <header class="col-md-12">
        <h1> Create Product </h1>
    </header>

    <!-- Form where product information will be entered -->
    <form action="create.php" method="POST" class="col-md-6 col-md-offset-2">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name"><span class="error"><?php if($_POST){if($errors){echo $errors['name'];}}?></span>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea><span class="error"><?php if($_POST){if($errors){echo $errors['description'];}}?></span>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01"class="form-control" id="price" name="price"><span class="error"><?php if($_POST){if($errors){echo $errors['price'];}}?></span>
        </div>

        <button type="submit" class="btn btn-primary">Enter Product</button>
        <a href='read.php' class='btn btn-danger'>Back to read products</a>
    </form>


    <



</div>




<?php require_once "footer.inc.php"; ?>

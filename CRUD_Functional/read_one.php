<?php

    require_once "header.inc.php ";
    if (isset($_GET['id'])&& !empty($_GET['id'])){
        $id = $_GET['id'];
    }else {
        die("ERROR: Record with id=$id not fount");
    }

    include "config/db_params.php";

    try {
        $sql = "SELECT * FROM product WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();

    }
    catch(PDOException $e) {
        echo "Error:\t{$e->getMessage()}";
    }
    echo "<div class='container'>";
    echo "<div class='row'><header class='col-md-12 col-md-offset-4'><h2>Data Form One Table </h2></header></div>";
    echo " <table class='table table-hover table-responsive table-bordered'><tr><th>ID</th><th>Product Name</th><th>Product Price</th><th>Product Description</th>
            <th>Price</th><th>Date Modified</th><th>Date Created</th><th>Back</th></tr>";
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<td><td> {$row['id']}</td><td> {$row['name']}</td><td> {$row['description']}</td><td> {$row['price']}</td>
                    <td> {$row['created']}</td><td>{$row['modified']}</td><td><a href='read.php' class='btn btn-danger'>Back to read products</a></td></tr>";
        echo "</table>";
    }else {
        echo "No matching rows";
    }
    echo "<a href='delete.php?id={$row['id']}' class='btn btn-danger col-md-offset-5'>Delete</a>";
    echo "<a href='update.php?id={$row['id']}' class='btn btn-info'>Update</a>";
    echo "";
    echo "</div>";
require_once "footer.inc.php ";
?>



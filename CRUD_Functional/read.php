<?php require_once "header.inc.php ";?>

    <?php
        require_once "config/db_params.php";

        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if($action=='deleted'){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }


        $sql = "SELECT * FROM product ORDER BY id DESC ";
        echo "<div class='row'><header class='col-md-12 col-md-offset-4'><h2>Simple CRUD Table - Functional Style</h2></header></div>";
        echo "<main class='container-fluid'>";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $e) {
            echo "Error while retriving data: {$e->getMessage()}";
        }
        if($stmt->rowCount() > 0) {

            echo "
            <table class='table table-hover table-responsive table-bordered'><tr><th>ID</th><th>Product Name</th><th>Product Price</th><th>Product Description</th>
            <th>Date Created</th><th>Date Modified</th><th colspan='3'>Action</th></tr>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "
                    <tr><td> {$row['id']}</td><td> {$row['name']}</td><td> {$row['price']}</td><td> {$row['description']}</td>
                    <td> {$row['created']}</td><td> {$row['modified']}</td>
                    <td><a href='read_one.php?id={$row['id']}' class='btn btn-info m-r-1em'>Read</a></td>
                     <td><a href='update.php?id={$row['id']}' class='btn btn-info m-r-1em'>Edit</a></td>
                     <td><a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                    </tr>";
            }
            echo "</table>";
        }else {
            echo "There was an error";
            exit();
        }


    ?>



<?php echo "<a href='create.php' class='btn btn-primary m-b-1em col-md-offset-5'>Create New Product</a>";?>
<?php echo "</main>"; ?>
<script type='text/javascript'>
    function delete_user( id ){

        var answer = confirm('Are you sure?');
        if (answer){
            // if user clicked ok,
            // pass the id to delete.php and execute the delete query
            window.location = 'delete.php?id=' + id;
        }
    }
</script>
<?php require_once "footer.inc.php ";?>

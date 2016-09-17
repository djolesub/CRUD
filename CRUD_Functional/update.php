<?php

    $id = $_REQUEST['id'];
    include "config/db_params.php";
    if($_GET){
        $id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id =:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $res['name'];
        $price = $res['price'];
        $description = $res['description'];
    }
    try {
        if ($_POST) {
            $sql = "UPDATE product SET name=:name,description=:description,price=:price WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Record was updated.</div>";
            } else {
                echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
            }
        }
    }
    catch(PDOException $e){
        echo "Error:{$e->getMessage()}";
    }

?>
<?php require_once "header.inc.php"; ?>
<div class="container">
    <header>
        <h1 class="col-md-offset-5"> Updating Table</h1>
    </header>
    <form action='update.php?id=<?php echo $id; ?>' method='post' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save Changes' class='btn btn-primary' />
                    <a href='read.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>
    </form>

</div>
<?php require_once "footer.inc.php"; ?>
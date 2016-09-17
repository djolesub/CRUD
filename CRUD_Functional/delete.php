<?php
include 'config/db_params.php';
    if($_GET) {
        $id = $_GET['id'];
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            try {
                // delete query
                $query = "DELETE FROM product WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    // redirect to read records page and
                    // tell the user record was deleted
                    header('Location: read.php');
                } else {
                    die('Unable to delete record.');
                }
            } // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
    }

?>


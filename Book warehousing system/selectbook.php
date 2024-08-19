
<?php
    if (isset($_POST['submit'])) {

        $connection_string = new mysqli("localhost", "root", "02Deidara", "bookstore");
        
        $searchString = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));

        if ($connection_string->connect_error) {
            echo "Failed to connect to Database";
            exit();
        }

        if ($searchString === "" || !ctype_alnum($searchString)) {
            echo "Invalid search string";
            exit();
        }

        $searchString = "%$searchString%";

        $sql = "SELECT * FROM book WHERE Book_Title LIKE ?";

        $prepared_stmt = $connection_string->prepare($sql);
        $prepared_stmt->bind_param('s', $searchString);
        $prepared_stmt->execute();

        $result = $prepared_stmt->get_result();

        if ($result->num_rows === 0) {

            echo "No match found";

            exit();

        } else {
            while ($row = $result->fetch_assoc()) {
                echo "<b>Book_Title</b>: ". $row['Book_Title'] . "<br />";
                echo "<b>Book_Author</b>: ". $row['Book_Author'] . "<br />";
                echo "<b>Book_Price</b>: ". $row['Book_Price'] . "<br />";
            } 
        } 

    } else { 
        echo "That is not allowed!";
        exit();
    }
    ?>


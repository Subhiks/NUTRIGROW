<?php
    $message = "";
    $sqlQuery = "";
    $modalState = "display:none";
    $stockInfo = "";
    $stockallinfo="";
        
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ims_db";
 
    $conn = new mysqli($servername,$username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    
    if(isset($_POST['createItem'])){
        $lapName  = $_POST['lapName'];
        $lapModel = $_POST['lapModel'];
        $stockCount = $_POST['stockCount'];
        $sqlQuery = "INSERT INTO inventory (lapName, lapModel, availability) VALUES ('$lapName', '$lapModel', $stockCount)";
        
        if ($conn->query($sqlQuery) === TRUE) {
            $message = "New item inserted successfully!!!";
        } else {
            $message = "Error: " . $conn->error;
        }
        $modalState = "display:flex";
    }
    elseif(isset($_POST['updateItem'])){
        $lapName  = $_POST['lapName'];
        $lapModel = $_POST['lapModel'];
        $stockCount = $_POST['stockCount'];
        $sqlQuery = "UPDATE inventory SET availability=$stockCount WHERE lapName='$lapName' AND lapModel='$lapModel'";

        if ($conn->query($sqlQuery) === TRUE) {
            $message = "Item updated successfully!!!";
        } else {
            $message = "Error: " . $conn->error;
        }
        $modalState = "display:flex";
    }
    elseif(isset($_POST['deleteItem'])){
        $lapName  = $_POST['lapName'];
        $lapModel = $_POST['lapModel'];
        $sqlQuery = "DELETE FROM inventory WHERE lapName='$lapName' AND lapModel='$lapModel'";

        if ($conn->query($sqlQuery) === TRUE) {
            $message = "Item deleted successfully!!!";
        } else {
            $message = "Error: " . $conn->error;
        }
        $modalState = "display:flex";
    }
    elseif(isset($_POST['searchItem'])){
        $lapName  = $_POST['lapName'];
        $lapModel = $_POST['lapModel'];
        $sqlQuery = "SELECT * FROM inventory WHERE lapName='$lapName' AND lapModel='$lapModel'";
        $result = $conn->query($sqlQuery);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $stockInfo = $stockInfo . "<tr><td>".$row["lapName"]."</td><td>".$row["lapModel"]."</td><td>".$row["availability"]."</td><tr>";
            }
        } else {
            $stockInfo = "<tr><td>Data not found!!!</td></tr>";
        }
    }

    elseif(isset($_POST['summary'])){
    
        $sqlQuery = "SELECT * FROM inventory";
        $result = $conn->query($sqlQuery);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $stockallinfo = $stockallinfo . "<tr><td>".$row["lapName"]."</td><td>".$row["lapModel"]."</td><td>".$row["availability"]."</td><tr>";
            }
        } else {
            $stockallinfo = "<tr><td>Data not found!!!</td></tr>";
        }
    }
    elseif(isset($_POST['closeModal'])){
        $modalState = "display:none";
    }



    $conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <nav>
            <h1>
                IMS
            </h1>
            <ul>
                <li>
                    <a href="#createItem">
                    Create
                    </a>
                </li>
                <li>
                    <a href="#updateItem">
                    Update
                    </a>
                </li>
                <li>
                    <a href="#deleteItem">
                    Delete
                    </a>
                </li>
                <li>
                    <a href="#searchItem">
                    Search
                    </a>
                </li>
                <li>
                    <a href="#aboutUs">
                    About Us
                    </a>
                </li>
                <li>
                    <a href="#summary">
                    summary
                    </a>
                </li>
            </ul>
            <div>
            </div>
        </nav>
        <div id="divider"></div>
        <div id="msgModal" class="msgModal" style=<?php echo $modalState; ?>>
            <div class="msgModalContent">
                <?php echo $message; ?>
                <form action="" method="post">
                    <button type="submit" name="closeModal">Close</button>
                </form>
            </div>
        </div>
        <div id="createItem">
            <h1>Create Item</h1>
            <form action="" method="post">
                <label> Laptop Name </label>
                <input name="lapName" required/>
                <br/>
                <label> Laptop Model </label>
                <input name="lapModel" required/>
                <br/>
                <label> Stock Count </label>
                <input name="stockCount" required/>
                <br/>
                <button type="submit" name="createItem">create</button>
            </form>
        </div>
        <div id="divider"></div>
        <div id="updateItem">
            <h1>Update Item</h1>
            <form action="" method="post">
                <label> Laptop Name </label>
                <input name="lapName" required/>
                <br/>
                <label> Laptop Model </label>
                <input name="lapModel" required/>
                <br/>
                <label> Stock Count </label>
                <input name="stockCount" required/>
                <br/>
                <button type="submit" name="updateItem">update</button>
            </form> 
        </div>
        <div id="divider"></div>
        <div id="deleteItem">
            <h1>Delete Item</h1>
            <form action="" method="post">
                <label> Laptop Name </label>
                <input name="lapName" required/>
                <br/>
                <label> Laptop Model </label>
                <input name="lapModel"/>
                <br/>
                <button type="submit" name="deleteItem">delete</button> 
            </form>
        </div>
        <div id="divider"></div>
        <div id="searchItem">
            <h1>Search Item</h1>
            <form action="" method="post">
                <label> Laptop Name </label>
                <input name="lapName" required/>
                <br/>
                <label> Laptop Model </label>
                <input name="lapModel" required/>
                <br/>
                <button type="submit" name="searchItem">search</button> 
            </form>
            <table>
                <tr class="tableHead">
                    <td> Laptop Name </td>
                    <td> Laptop Model </td>
                    <td> Stock Count </td>                    
                </tr>
                <?php echo $stockInfo; ?>
            </table>
        </div>
        <div id="divider"></div>
        <div id="aboutUs">
            <h1>Our Team</h1> 
                <h2>Naveen Balaji </h2>
                <h2>Naveen Kumar</h2>
                <h2>Santhosh Kumar</h2>        
        </div>
        <div id="divider"></div>
        <div id="summary">
            <h1>summary</h1>
            <form action="" method="post">
            <button type="submit" name="summary">summary</button>
            </form>
            <table>
                <tr class="tableHead">
                    <td> Laptop Name </td>
                    <td> Laptop Model </td>
                    <td> Stock Count </td>                    
                </tr>
                <?php echo $stockallinfo; ?>
            </table>
        </div>

    </body>
</html>
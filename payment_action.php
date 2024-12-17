<?php
session_start();
include('admin/config.php');

?>
<?php

if(isset($_POST['submit'])){
    $name = $_POST['oname'];
    $phone = $_POST['ophone'];
    $email = $_POST['oemail'];
    $address = $_POST['oaddress'];

    if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
        $username = $_SESSION['username'];
    } else {
        echo "User not logged in.";
        exit();
    }

// reciving the data on adding a cart
if(!empty($_SESSION['cart'])){
    $outputTable = '';
    $total = 0;
    $outputTable .= "<table hidden='hidden' class='table table-bordered'><thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>Action</td> </tr></thead>";
    foreach($_SESSION['cart'] as $key => $value){
        $outputTable .= "<tr><td>".$value['p_name']."</td><td>".($value['p_price'] * 1) ."</td><td>".'1'."</td><td><button id=".$value['p_id']." class='btn btn-danger delete'>Delete</button></td></tr>";  
        $total = $total + ($value['p_price'] * 1);
    }
    $outputTable .= "</table>";
    
    echo $outputTable;
}

// end of fetching user data
$total = $total + ($value['p_price']);
$pname = $value['p_name'];

    $sql = "INSERT INTO P_order(name,	phone,email,address,pname,totalam,username) 
    VALUES ('$name',' $phone','$email','$address','$pname','$total','$username')";


    if(mysqli_query($conn, $sql)){
    // Order successfully inserted, display a success message using JavaScript
    echo "<script>alert('Order placed successfully!'); window.location='index.php';</script>";
    exit(); // Stop further execution of the script
    } else {
        // Display an error message if insertion fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
?>






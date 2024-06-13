<?php
session_start();


if(isset($_POST['cart_id'])){
            if($_POST['action'] == 'add'){
                $outputTable = '';
                if(isset($_SESSION['cart'])){
                    $isalreadyExist = 0;
                    foreach($_SESSION['cart'] as $key => $value){
                        
                        if($_SESSION['cart'][$key]['p_id'] == $_POST['cart_id']){
                            $isalreadyExist++;
                           // $_SESSION['cart'][$key]['p_quantity'] =  $_SESSION['cart'][$key]['p_quantity'] + $_POST['cart_quantity'];
                        }
                    }
                    if($isalreadyExist < 1){
                        $itemArray = array(
                            'p_id' => $_POST['cart_id'],
                            'p_name' => $_POST['cart_name'], 
                            'p_price' => $_POST['cart_price'],
                            //'p_quantity' => $_POST['cart_quantity'] 
                        );
                        $_SESSION['cart'][]  = $itemArray;
                    }



                }else{
                    $itemArray = array(
                        'p_id' => $_POST['cart_id'],
                        'p_name' => $_POST['cart_name'], 
                        'p_price' => $_POST['cart_price'],
                        //'p_quantity' => $_POST['cart_quantity'] 
                    );
                    $_SESSION['cart'][]  = $itemArray;
                }
           



           }

}



if($_POST['action'] == 'remove'){
    foreach($_SESSION['cart'] as $key => $val){
        if( $val['p_id'] == $_POST['id_to_remove']){
            unset($_SESSION['cart'][$key]);
        }
    }

}


if(!empty($_SESSION['cart'])){
    $outputTable = '';
    $total = 0;
    $outputTable .= "<table class='table table-bordered'><thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>Action</td> </tr></thead>";
    foreach($_SESSION['cart'] as $key => $value){
        $outputTable .= "<tr><td>".$value['p_name']." </td><td>".($value['p_price'] * 1) ."</td><td>"."1"."</td><td><button id=".$value['p_id']." class='btn btn-danger delete'>Delete</button></td></tr>";  
        $total = $total + ($value['p_price'] * 1);
    }
    $outputTable .= "</table>";
    $outputTable .= "<div class='text-center'><b>Total:".$total."</b></div>";
    $_SESSION['cart_table'] = $outputTable;
}

echo json_encode($outputTable);

?>
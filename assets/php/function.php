<?php

require('conn.php');

function add_product()
{
    global $conn;

    if (isset($_POST['prod_name'])) {

        $targetDir = "uploads/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg  = $errorUpload = $errorUploadType = '';
        $insertValuesSQL = array();
        $fileNames = array_filter($_FILES['prod_img']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['prod_img']['name'] as $key => $val) {
                $fileName = basename($_FILES['prod_img']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["prod_img"]["tmp_name"][$key], $targetFilePath)) {
                        array_push($insertValuesSQL, $fileName);
                    } else {
                        $errorUpload .= $_FILES['prod_img']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['prod_img']['name'][$key] . ' | ';
                }
            }
        }

        $insertValuesSQL = json_encode($insertValuesSQL);
        $prod_name = $_POST['prod_name'];
        $prod_qun = $_POST['prod_qun'];
        $prod_price = $_POST['prod_price'];
        $prod_detail = $_POST['prod_detail'];

        $sql = "INSERT INTO  product_tbl (prod_name,prod_img,prod_quantity,prod_price,prod_detail) values ('$prod_name','$insertValuesSQL','$prod_qun','$prod_price','$prod_detail')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "User added successfully"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    }
}
function view_product()
{
    global $conn;
    $select = mysqli_query($conn, "SELECT * FROM product_tbl");
    $users = [];

    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

function add_customer()
{
    global $conn;
    if (isset($_POST['customer_name'])) {
        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_phone = $_POST['customer_phone'];
        $customer_gender = $_POST['customer_gender'];
        $customer_address = $_POST['customer_address'];

        $query = "SELECT * FROM `customer_tbl`";
        $a = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($a)) {
            $cn = $row['customer_phone'];
            $em = $row['customer_email'];

            if ($customer_phone == $cn) {
                $x = false;
                break;
            } else {
                $x = true;
            }
            if ($customer_email == $em) {
                $y = false;
                break;
            } else {
                $y = true;
            }
        }

        if ($x == true) {
            if ($y == true) {
                $sql = "INSERT INTO  customer_tbl (customer_name,customer_email,customer_phone,customer_gender,customer_address) values ('$customer_name','$customer_email','$customer_phone','$customer_gender[0]','$customer_address')";
                if (mysqli_query($conn, $sql)) {
                    echo json_encode(["status" => "success", "message" => "User added successfully"]);
                } else {
                    echo json_encode(["status" => "error"]);
                }
            } else {
                echo json_encode(['status' => 'emailerror', 'message' => 'Email Already Exists']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'contacterror', 'message' => 'Contact Already Exists']);
            exit();
        }
    }
}

function product_delete()
{
    global $conn;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM product_tbl WHERE prod_id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting user: " . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request"]);
    }
}

function customer_delete()
{
    global $conn;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM customer_tbl WHERE customer_id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error deleting user: " . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request"]);
    }
}


function view_customer()
{
    global $conn;
    $select = mysqli_query($conn, "SELECT * FROM customer_tbl");
    $users = [];

    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

function fetchData()
{
    global $conn;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM product_tbl WHERE prod_id='$id'";
        $result = mysqli_query($conn, $query);
        $ajax_data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $ajax_data[] = $row['prod_name'];
            $ajax_data[] = $row['prod_img'];
            $ajax_data[] = $row['prod_quantity'];
            $ajax_data[] = $row['prod_price'];
            $ajax_data[] = $row['prod_detail'];
        }
        echo json_encode($ajax_data);
    } else {
        echo json_encode(["error" => "UserID is not set in POST data"]);
    }
}
function fetchDatacustomer()
{
    global $conn;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM customer_tbl WHERE customer_id='$id'";
        $result = mysqli_query($conn, $query);
        $ajax_data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $ajax_data[] = $row['customer_name'];
            $ajax_data[] = $row['customer_email'];
            $ajax_data[] = $row['customer_phone'];
            $ajax_data[] = $row['customer_gender'];
            $ajax_data[] = $row['customer_address'];
        }
        echo json_encode($ajax_data);
    } else {
        echo json_encode(["error" => "UserID is not set in POST data"]);
    }
}

function updateData()
{
    global $conn;
    if (true) {
        // $targetDir = "uploads/";
        // $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        // $statusMsg = $errorMsg = $errorUpload = $errorUploadType = '';
        // $insertValuesSQL = array();
        // $fileNames = array_filter($_FILES['prod_img1']['name']);

        // if (!empty($fileNames)) {
        //     foreach ($_FILES['prod_img1']['name'] as $key => $val) {
        //         $fileName = basename($_FILES['prod_img1']['name'][$key]);
        //         $targetFilePath = $targetDir . $fileName;
        //         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        //         $checkQuery = "SELECT * FROM `product_tbl` WHERE JSON_CONTAINS(prod_img, '\"$fileName\"')";
        //         $checkResult = mysqli_query($conn, $checkQuery);

        //         if (mysqli_num_rows($checkResult) > 0) {
        //             continue; 
        //         }

        //         if (in_array($fileType, $allowTypes)) {
        //             if (move_uploaded_file($_FILES["prod_img1"]["tmp_name"][$key], $targetFilePath)) {
        //                 array_push($insertValuesSQL, $fileName);
        //             } else {
        //                 $errorUpload .= $_FILES['prod_img1']['name'][$key] . ' | ';
        //             }
        //         } else {
        //             $errorUploadType .= $_FILES['prod_img1']['name'][$key] . ' | ';
        //         }
        //     }
        // }

        // $insertValuesSQL = json_encode($insertValuesSQL);
        $id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name1'];
        $prod_qun = $_POST['prod_qun1'];
        $prod_price = $_POST['prod_price1'];
        $prod_detail = $_POST['prod_detail1'];

        // $existingImagesQuery = "SELECT prod_img FROM `product_tbl` WHERE prod_id = '$id'";
        // $existingImagesResult = mysqli_query($conn, $existingImagesQuery);
        // $existingImages = mysqli_fetch_assoc($existingImagesResult)['prod_img'];
        // $existingImages = json_decode($existingImages, true);

        // $allImages = array_merge($existingImages, $insertValuesSQL);
        // $allImagesJSON = json_encode($allImages);

        $sql = "UPDATE product_tbl SET prod_name='$prod_name', prod_quantity='$prod_qun', prod_price='$prod_price', prod_detail='$prod_detail' WHERE prod_id = '$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "User updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "User update failed"]);
        }
    }
}

function order()
{
    global $conn;
    $customer_id = $_POST['customer'];
    $product_id = $_POST['product'];

    $query = "SELECT prod_name, prod_img, prod_quantity, prod_price FROM product_tbl WHERE prod_id IN ($product_id)";
    $result = mysqli_query($conn, $query);
    
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = [
            'name' => $row['prod_name'],
            'image' => json_decode($row['prod_img'], true),
            'quantity' => $row['prod_quantity'],
            'price' => $row['prod_price']
        ];
    }
    
    echo json_encode($products);
}

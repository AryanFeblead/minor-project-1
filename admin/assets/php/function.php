<?php

require ('conn.php');

function add_product()
{
    global $conn;

    if (isset($_POST['prod_name'])) {

        $targetDir = "uploads/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $errorUpload = $errorUploadType = '';
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
        $x = true;
        $y = true;
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

    // Assuming $_POST['customer'] is sanitized
    $customer_id = $_POST['customer'];
    // Assuming $_POST['product'] is comma-separated list of product IDs
    $product_ids = $_POST['productId'];

    // Constructing the SQL query with IN clause
    $query = "SELECT prod_name, prod_img, prod_quantity, prod_price FROM product_tbl WHERE prod_id IN ($product_ids)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            // Decode JSON string to array for images
            $images = json_decode($row['prod_img'], true);

            // Prepare product data
            $product = [
                'name' => $row['prod_name'],
                'image' => $images, // Assuming prod_img is a JSON array of image paths
                'quantity' => $row['prod_quantity'],
                'price' => $row['prod_price']
            ];

            $products[] = $product;
        }

        // Return products as JSON
        echo json_encode($products);
    } else {
        // Handle query error
        echo json_encode(['error' => 'Failed to fetch products']);
    }
}

function checkout()
{
    global $conn;

    // Assuming $_POST['products'] is the array of products sent from frontend
    $customer_id = $_POST['customer'];
    $products = $_POST['productsArray']; // Array of products

    // Initialize arrays to store product details
    $prod_names = [];
    $prod_quantities = [];
    $prod_prices = [];
    $prod_subtotals = [];

    foreach ($products as $product) {
        // Escape values for safety (prevent SQL injection)
        $prod_name = mysqli_real_escape_string($conn, $product['name']);
        $prod_quantity = mysqli_real_escape_string($conn, $product['quantity']);
        $prod_price = mysqli_real_escape_string($conn, $product['price']);
        $prod_subtotal = mysqli_real_escape_string($conn, $product['subtotal']);

        // Store product details in arrays
        $prod_names[] = $prod_name;
        $prod_quantities[] = $prod_quantity;
        $prod_prices[] = $prod_price;
        $prod_subtotals[] = $prod_subtotal;
    }

    // Retrieve customer name from database
    $select_customer = mysqli_query($conn, "SELECT customer_name FROM customer_tbl WHERE customer_id = '$customer_id'");
    $customer_name = mysqli_fetch_assoc($select_customer)['customer_name'];

    // Insert each product into the database
    $success = true;
    for ($i = 0; $i < count($products); $i++) {
        $prod_name = $prod_names[$i];
        $prod_quantity = $prod_quantities[$i];
        $prod_price = $prod_prices[$i];
        $prod_subtotal = $prod_subtotals[$i];

        // Insert each product into customer_product_tbl
        $sql = "INSERT INTO customer_product_tbl (customer_name, prod_name, prod_quantity, prod_price, prod_subtotal)
                VALUES ('$customer_name', '$prod_name', '$prod_quantity', '$prod_price', '$prod_subtotal')";

        if (!mysqli_query($conn, $sql)) {
            $success = false;
            break; // Exit loop on failure
        }
    }

    if ($success) {
        echo json_encode(["status" => "success", "message" => "Products added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add products"]);
    }
}
function view_order()
{
    global $conn;
    $select = mysqli_query($conn, "SELECT * FROM customer_product_tbl");
    $users = [];
    if (mysqli_num_rows($select) > 0) {
        while ($rows = mysqli_fetch_assoc($select)) {
            $users[] = $rows;
        }
    }
    echo json_encode($users);
}

function report()
{
    global $conn;
    $results = mysqli_query($conn, "SELECT * FROM customer_product_tbl");
    $productData = [];

    foreach ($results as $row) {
        $productData[] = $row;
    }

    echo json_encode($productData);
}

function customer_report(){
    global $conn;
    $customer_report = $_POST['customer_report'];
    $results = mysqli_query($conn, "SELECT * FROM customer_product_tbl WHERE customer_name IN (SELECT customer_name FROM customer_tbl where customer_id = $customer_report)");
    $productData = [];
    
    foreach ($results as $row) {
        $productData[] = $row;
    }

    echo json_encode($productData);
}

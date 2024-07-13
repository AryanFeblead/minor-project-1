<?php

require('function.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'add_product') {
        add_product();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'view_product') {
        view_product();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'add_customer') {
        add_customer();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'prod_delete') {
        product_delete();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'customer_delete') {
        customer_delete();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'view_customer') {
        view_customer();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'fetch') {
        fetchData();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'customerfetch') {
        fetchDatacustomer();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'update') {
        updateData();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'order') {
        order();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'checkout') {
        checkout();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'view_order') {
        view_order();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'report') {
        report();
    }
    if (isset($_POST['actionName']) && $_POST['actionName'] == 'customer_report') {
        customer_report();
    }
}
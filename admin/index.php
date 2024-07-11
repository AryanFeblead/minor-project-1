<?php

require ('assets/php/conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
    integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/custome.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Components</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Product</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                  <li>
                    <a>
                      <span id="add_product" class="sub-item">Add
                        Products</span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span id="view_product" class="sub-item">View
                        Product</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Customer</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li>
                    <a>
                      <span id="add_customer" class="sub-item">Add
                        Customer</span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span id="view_customer" class="sub-item">View
                        Customer</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>Order</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <a>
                      <span id="add_order" class="sub-item">Add
                        Orders</span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span id="view_order" class="sub-item">View
                        Orders</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#tables">
                <i class="fas fa-table"></i>
                <p id="report">Report</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">Aryan</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4>Aryan</h4>
                          <p class="text-muted">ap@gmail.com</p>
                          <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                            Profile</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">My Profile</a>
                      <a class="dropdown-item" href="#">My Balance</a>
                      <a class="dropdown-item" href="#">Inbox</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Account Setting</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Logout</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="alert alert-success" role="alert" id="success">
          A simple success alert—check it out!
        </div>
        <div class="alert alert-danger" role="alert" id="notsuccess">
          A simple danger alert—check it out!
        </div>
        <h1 class="text-center">Welcome to Admin Panel</h1>
        <div class="container">
          <div id="add_product1" class="container" style="width: 70%;">
            <form id="prod_form" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name" aria-describedby="emailHelp">
                <div id="prod_nameval">
                  Please choose a product name.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="prod_img" name="prod_img[]" multiple>
                <div id="prod_imgval">
                  Please choose a product image.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
                <input type="number" class="form-control" id="prod_qun" aria-describedby="emailHelp" name="prod_qun">
                <div id="prod_qunval">
                  Please choose a product quantity.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="prod_price" name="prod_price"
                  aria-describedby="emailHelp">
                <div id="prod_priceval">
                  Please choose a product price.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Details</label>
                <textarea name="prod_detail" class="form-control" id="prod_detail"></textarea>
                <div id="prod_detailval">
                  Please choose a product detail.
                </div>
              </div>
              <button class="btn btn-primary">Add Product</button>
            </form>
          </div>
          <div id="view_product1" class="container" style="width: 90%;">
            <table id="prod_tbl" class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Product Quantity</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Product Detail</th>
                  <th scope="col">Product Edit</th>
                  <th scope="col">Product Delete</th>
                </tr>
              </thead>
              <tbody id="result">

              </tbody>
            </table>
          </div>
          <div id="add_customer1" class="container" style="width: 70%;">
            <form id="customer_form" method="post">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name">
                <div id="customer_nameval">
                  Please choose a customer name.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Customer Email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email">
                <div id="customer_emailval">
                  Please choose a customer email.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer Phone</label>
                <input type="number" class="form-control" id="customer_phone" name="customer_phone"
                  aria-describedby="emailHelp">
                <div id="customer_phoneval">
                  Please choose a customer phone.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer Gender - </label>
                <label for="exampleInputEmail1" class="form-label">Male</label>
                <input type="radio" name="customer_gender[]" class="customer_gender" value="male" id="customer_gender1"
                  aria-describedby="emailHelp">
                <label for="exampleInputEmail1" class="form-label">Female</label>
                <input type="radio" id="customer_gender2" name="customer_gender[]" class="customer_gender"
                  value="female" id="customer_gender2" aria-describedby="emailHelp">
                <div id="customer_genderval">
                  Please choose a customer gender.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Customer City</label>
                <input type="text" name="customer_address" class="form-control" id="customer_address">
                <div id="customer_addressval">
                  Please choose a customer city.
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
          </div>
          <div id="view_customer1" class="container" style="width: 100%;">
            <table id="customer_tbl" class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Customer Email</th>
                  <th scope="col">Customer Phone</th>
                  <th scope="col">Customer Gender</th>
                  <th scope="col">Customer City</th>
                  <th scope="col">Product Edit</th>
                  <th scope="col">Product Delete</th>
                </tr>
              </thead>
              <tbody id="result1">

              </tbody>
            </table>
          </div>
          <div id="add_order1" class="container" style="width: 70%;">
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="customer" class="form-select mb-3" aria-label="Default select example">
                <option selected>Select Customer</option>
                <?php
                $query = "SELECT * FROM `customer_tbl`";
                $a = mysqli_query($conn, $query);
                $b = mysqli_num_rows($a);

                while ($row = mysqli_fetch_assoc($a)) {
                  echo '<option value=' . $row["customer_id"] . '> ' . $row["customer_name"] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="mb-3 d-flex flex-column mx-5" style="width: 70%;">
              <select id="product" class="form-select" aria-label="Default select example">
                <option selected>Select Product</option>
                <?php
                $query1 = "SELECT * FROM `product_tbl`";
                $a1 = mysqli_query($conn, $query1);
                $b1 = mysqli_num_rows($a1);

                while ($row1 = mysqli_fetch_assoc($a1)) {
                  echo '<option value="' . $row1["prod_id"] . '"> ' . $row1["prod_name"] . '</option>';
                }
                ?>
              </select>
            </div>
            <button id="order_btn" class="btn btn-primary mx-5">Add Product</button>
            <div id="all_order">
              <h1 class="text-center">Cart Items</h1>
              <div class="d-flex justify-content-between">
                <p>Item</p>
                <p>Price</p>
                <p>Quantity</p>
                <p>Subtotal</p>
              </div>
            </div>
            <div>
              <h4 id="all_prod_total" style="display: none;"></h4>
              <button class="btn btn-success float-end mt-2" id="checkout" style="display: none;">Submit Order</button>
            </div>
          </div>
          <div id="view_order1">
            <table id="order_tbl" class="table">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Product Quantity</th>
                  <th scope="col">Product Subtotal</th>
                  <th scope="col">Product Edit</th>
                  <th scope="col">Product Delete</th>
                </tr>
              </thead>
              <tbody id="result3">

              </tbody>
            </table>
          </div>
          <div id="report1">
            <div style="width:600px; margin:50px auto; border:1px solid #ddd;">
              <canvas id="productChart"></canvas>
            </div>
          </div>
        </div>
        <div class="modal fade" id="Update">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateLabel">Update Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p id="up-messages-error"></p>
                <form class action method="post" enctype="multipart/form-data">
                  <div class="row g-3">
                    <div class="col-md-12">
                      <label for="contact">Product Name</label>
                      <input type="text" class="form-control mt-2" name="prod_name1" id="prod_name1"
                        Placeholder="Enter Name *" required>
                      <div id="prod_nameval1">
                        Please choose a product name.
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="contact">Product Image</label>
                      <input type="file" class="form-control mt-2" name="prod_img1" id="prod_img1"
                        Placeholder="User Email *" required>
                      <div id="prod_imgval1">
                        Please choose a product image.
                      </div>
                      <div id="add_img">

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Quantity</label>
                      <input type="number" class="form-control" name="prod_qun1" id="prod_qun1">
                      <div id="prod_qunval1">
                        Please choose a product quantity.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Price</label>
                      <input type="number" class="form-control" name="prod_price1" id="prod_price1">
                      <div id="prod_priceval1">
                        Please choose a product price.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Product Detail</label>
                      <textarea class="form-control" id="prod_address1" rows="3" name="prod_address1"></textarea>
                      <div id="prod_detailval1">
                        Please choose a product detail.
                      </div>
                    </div>
                  </div>
                  </from>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_update">Update Now</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_close">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="Update1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateLabel">Update Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p id="up-messages-error"></p>
                <form class action method="post" enctype="multipart/form-data">
                  <div class="row g-3">
                    <div class="col-md-12">
                      <label for="contact">Customer Name</label>
                      <input type="text" class="form-control mt-2" name="customer_name1" id="customer_name1"
                        Placeholder="Enter Name *" required>
                      <div id="prod_nameval1">
                        Please choose a customer name.
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="contact">Customer Email</label>
                      <input type="email" class="form-control mt-2" name="customer_email1" id="customer_email1"
                        Placeholder="User Email *" required>
                      <div id="prod_imgval1">
                        Please choose a Customer Email.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Customer Phone</label>
                      <input type="number" class="form-control" name="customer_phone1" id="customer_phone1">
                      <div id="prod_qunval1">
                        Please choose a Customer Phone.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Customer Gender</label><br>
                      <label for="contact">Male</label>
                      <input type="radio" name="customer_gender1" class="customer_gender1" id="male" value="male">
                      <label for="contact">Female</label>
                      <input type="radio" name="customer_gender1" class="customer_gender1" id="female" value="female">
                      <div id="prod_priceval1">
                        Please choose a customer gender.
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contact">Customer City</label>
                      <input type="text" name="customer_address1" class="form-control" id="customer_address1">
                      <div id="prod_detailval1">
                        Please choose a Customer City.
                      </div>
                    </div>
                  </div>
                  </from>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_update1">Update Now</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_close">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>
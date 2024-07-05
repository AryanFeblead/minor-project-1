$(document).ready(function () {
    $('#view_product1,#add_product1,#add_customer1,#view_customer1,#view_order1,#add_order1,#prod_nameval,#prod_imgval,#prod_qunval,#prod_priceval,#prod_detailval,#notsuccess,#success,#customer_nameval,#customer_emailval,#customer_phoneval,#customer_addressval,#customer_genderval,#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide();
    $('#product,#customer').select2();
    var product;

    $('#order_btn').click(function (e) {
        e.preventDefault();
        var customer = $('#customer').val();
        product = $('#product').val();
        $('#product option:selected').remove();
        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                customer: customer,
                product: product,
                actionName: 'order'
            },
            success: function (data) {
                var products = JSON.parse(data);
                var rows = '';
                var totalAmount = 0;
                products.forEach(function (product, index) {
                    var price = product.price;
                    var qun = product.quantity;
                    var image = product.image;
                    rows += '<div class="product-item">';
                    rows += '<div class="d-flex justify-content-between">';
                    rows += '<div>';
                    rows += '<img src="assets/php/uploads/' + image[0] + '" height="75px" width="75px">';
                    rows += '<h4>' + product.name + '</h4>';
                    rows += '</div>';
                    rows += '<div>';
                    rows += '<p id="price_' + index + '">' + price + '</p>';
                    rows += '</div>';
                    rows += '<div>';
                    rows += '<select class="form-select quantity" data-index="' + index + '" aria-label="Default select example">';
                    rows += '<option selected value="' + 1 + '">' + 1 + '</option>';
                    for (var i = 2; i <= qun; i++) {
                        rows += '<option value="' + i + '">' + i + '</option>';
                    }
                    rows += '</select>';
                    rows += '</div>';
                    rows += '<div>';
                    rows += '<p id="subtotal_' + index + '">' + price + '</p>';
                    rows += '</div>';
                    rows += '</div>';
                    rows += '<div class="del text-end">';
                    rows += '<button class="btn btn-danger">Remove</button>';
                    rows += '</div>';
                    rows += '</div>';
                    totalAmount += Number(price); 
                    
                });

                $('.btn-success').css('display', 'block');
                    $('.product-item').each(function () {
                        var price = parseFloat($(this).find('p[id^="price_"]').text());
                        var quantity = parseInt($(this).find('.quantity').val());
                        totalAmount += price * quantity;
                    });
                    $('#all_prod_total').css('display', 'block');
                    $('#all_prod_total').text('Total Amount: ' + totalAmount.toFixed(2));

                $('#customer').attr('disabled', 'disabled');
                $('#all_order').append(rows);


                $('.del').click(function () {
                    var removedProduct = $(this).closest('.product-item');
                    var productName = removedProduct.find('h4').text();
                    var productId = removedProduct.find('.quantity').data('index');
                    $('#checkout').hide();

                    $('#product').append('<option value="' + productId + '">' + productName + '</option>');

                    removedProduct.remove(); // Remove the product item
                });
            },
            error: function () {
                $('#notsuccess').show().html('Product Added Failed');
            }
        });
    });
    $(document).on('change', '.quantity', function () {
        var parent = $(this).closest('.product-item');
        var index = $(this).data('index');
        var qunid = $(this).val();
        var price = parseFloat(parent.find('#price_' + index).text());
        var total = price * qunid;
        parent.find('#subtotal_' + index).text(total.toFixed(2));
    });


    $('#checkout').click(function (e) {
        e.preventDefault();
        product = product
        var customer = $('#customer').val();
        var prod_qun = $('.quantity').val();
        var prod_price = $('#price_0').text();
        var prod_subtotal = $('#subtotal_0').text();
        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                customer: customer,
                product: product,
                prod_qun: prod_qun,
                prod_price: prod_price,
                prod_subtotal: prod_subtotal,
                actionName: 'checkout'
            },
            success: function (data) {
                var data1 = JSON.parse(data);
                if (data1.status == 'success') {
                    $('.product-item').hide();
                    $('.btn-success').hide();
                    $('#all_prod_total').hide();
                    $('#success').show().delay(2000).fadeOut().html("Product Checkout Successfully");
                }
            },
            error: function () {
                $("#prod_form")[0].reset();
                $('#notsuccess').show().html('Product Added Failed')
            }
        });
    });

    $('#add_product').click(function (e) {
        e.preventDefault();
        $('#add_product1').show();
        $('#add_customer1').hide();
        $('#view_product1').hide();
        $('#view_customer1').hide();
        $('#view_order1').hide();
        $('#add_order1').hide();

        $('#prod_form').on('submit', function (e) {
            e.preventDefault()
            if ($('#prod_name').val() == '') {
                $('#prod_nameval').show().css('color', 'red');
            }
            if ($('#prod_qun').val() == '') {
                $('#prod_qunval').show().css('color', 'red');
            }
            if ($('#prod_price').val() == '') {
                $('#prod_priceval').show().css('color', 'red');
            }
            if ($('#prod_detail').val() == '') {
                $('#prod_detailval').show().css('color', 'red');
            }
            if ($('#prod_img').val() == '') {
                $('#prod_imgval').show().css('color', 'red');
            } else {
                var formData = new FormData(this);
                formData.append('actionName', 'add_product');
                $.ajax({
                    type: "POST",
                    url: "assets/php/ajx.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log('done');
                        var data1 = JSON.parse(data);
                        if (data1.status == 'success') {
                            $('#prod_nameval,#prod_imgval,#prod_qunval,#prod_priceval,#prod_detailval').hide()
                            $("#prod_form")[0].reset();
                            $('#success').show().delay(2000).fadeOut().html("Product Added Successfully");
                        }
                    },
                    error: function () {
                        $("#prod_form")[0].reset();
                        $('#notsuccess').show().html('Product Added Failed')
                    }
                });
            }
        })
    });

    $('#view_product').click(function (e) {
        e.preventDefault();
        $('#add_product1').hide();
        $('#add_customer1').hide();
        $('#view_product1').show();
        $('#view_customer1').hide()
        $('#view_order1').hide()
        $('#add_order1').hide()
        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                actionName: 'view_product'
            },
            success: function (data) {
                data1 = $.parseJSON(data);
                var rows = '';
                $.each(data1, function (index, user) {
                    var img = JSON.parse(user.prod_img)
                    rows += '<tr>';
                    rows += '<td>' + user.prod_id + '</td>';
                    rows += '<td>' + user.prod_name + '</td>';
                    rows += '<td><img src="assets/php/uploads/' + img[0] + '" height="50px" width="50px"></td>';
                    rows += '<td>' + user.prod_quantity + '</td>';
                    rows += '<td>' + user.prod_price + '</td>';
                    rows += '<td>' + user.prod_detail + '</td>';
                    rows += '<td><a data-id="' + user.prod_id + '" class="btn btn-primary edit">Edit</a></td>';
                    rows += '<td><a data-id="' + user.prod_id + '" class="btn btn-danger delete">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result').html(rows);
                $('#prod_tbl').DataTable();

                $('.edit').on('click', function () {
                    var id = $(this).data('id');
                    fetchData(id);
                    $(document).on('click', '#btn_update', function () {
                        updateData(id);
                    })
                });

                $('.delete').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: "assets/php/ajx.php",
                            data: {
                                id: id,
                                actionName: 'prod_delete'
                            },
                            success: function (response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Product Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function (status, error) {
                                console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function (status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    });

    $('#customer_phone').on('input', function () {
        if ($(this).val().length > 10) {
            $(this).val($(this).val().substring(0, 10));
        }
    });

    $('#add_customer').click(function (e) {
        e.preventDefault();
        $('#add_product1').hide();
        $('#add_customer1').show();
        $('#view_product1').hide();
        $('#view_customer1').hide();
        $('#add_order1').hide();
        $('#view_order1').hide();

        $('#customer_form').on('submit', function (e) {
            e.preventDefault();

            var isValid = true;

            $('.validation-message').hide();

            if ($('#customer_name').val() == '') {
                $('#customer_nameval').show().css('color', 'red');
                isValid = false;
            }

            var email = $('#customer_email').val();
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email == '') {
                $('#customer_emailval').show().css('color', 'red');
                isValid = false;
            } else if (!emailPattern.test(email)) {
                $('#customer_emailval').show().css('color', 'red').html('Invalid email format');
                isValid = false;
            }

            var phone = $('#customer_phone').val();
            if (phone == '') {
                $('#customer_phoneval').show().css('color', 'red');
                isValid = false;
            } else if (phone.length < 10) {
                $('#customer_phoneval').show().html("Mobile no. should be 10 digits").css('color', 'red');
                isValid = false;
            }

            if ($('.customer_gender:checked').val() == undefined) {
                $('#customer_genderval').show().css('color', 'red');
                isValid = false;
            }

            if ($('#customer_address').val() == '') {
                $('#customer_addressval').show().css('color', 'red');
                isValid = false;
            }


            if (isValid) {
                var formData = new FormData(this);
                formData.append('actionName', 'add_customer');
                $.ajax({
                    type: "POST",
                    url: "assets/php/ajx.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var data1 = JSON.parse(data);
                        if (data1.status == 'contacterror') {
                            $('#customer_phoneval').html('Contact Already exist');
                            $('#customer_phoneval').show();
                            $('#customer_phoneval').css('color', 'red');
                        }
                        if (data1.status == 'emailerror') {
                            $('#customer_emailval').html('Email Already exist');
                            $('#customer_emailval').show();
                            $('#customer_emailval').css('color', 'red');
                        }
                        if (data1.status == 'success') {
                            $('#customer_nameval,#customer_emailval,#customer_phoneval,#customer_addressval,#customer_genderval').hide();
                            $("#customer_form")[0].reset();
                            $('#success').show().delay(2000).fadeOut().html("Customer Added Successfully");
                        }
                    },
                    error: function () {
                        $("#prod_form")[0].reset();
                        $('#notsuccess').show().html('Product Added Failed');
                    }
                });
            }
        });
    });


    $('#view_customer').click(function (e) {
        e.preventDefault();
        $('#add_product1').hide();
        $('#add_customer1').hide();
        $('#view_product1').hide();
        $('#view_customer1').show()
        $('#add_order1').hide()
        $('#view_order1').hide()

        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                actionName: 'view_customer'
            },
            success: function (data) {
                data1 = $.parseJSON(data);
                console.log(data1)
                var rows = '';
                $.each(data1, function (index, user1) {
                    rows += '<tr>';
                    rows += '<td>' + user1.customer_id + '</td>';
                    rows += '<td>' + user1.customer_name + '</td>';
                    rows += '<td>' + user1.customer_email + '</td>';
                    rows += '<td>' + user1.customer_phone + '</td>';
                    rows += '<td>' + user1.customer_gender + '</td>';
                    rows += '<td>' + user1.customer_address + '</td>';
                    rows += '<td><a data-id="' + user1.customer_id + '" class="btn btn-primary edit1">Edit</a></td>';
                    rows += '<td><a data-id="' + user1.customer_id + '" class="btn btn-danger delete1">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result1').html(rows);
                $('#customer_tbl').DataTable();

                $('.edit1').on('click', function () {
                    var id = $(this).data('id');
                    fetchDatacustomer(id);
                    $(document).on('click', '#btn_update1', function () {
                        if ($('#customer_name').val() == '') {
                            $('#customer_nameval1').show().css('color', 'red');
                        }
                        if ($('#prod_qun1').val() == '') {
                            $('#prod_qunval1').show().css('color', 'red');
                        }
                        if ($('#prod_price1').val() == '') {
                            $('#prod_priceval1').show().css('color', 'red');
                        }
                        if ($('#prod_detail1').val() == '') {
                            $('#prod_detailval1').show().css('color', 'red');
                        }
                        if ($('#prod_img1').val() == '') {
                            $('#prod_imgval1').show().css('color', 'red');
                        } else {
                            var formData = new FormData();
                            formData.append('customer_id', id);
                            formData.append('actionName', 'update');
                            $.ajax({
                                url: 'assets/php/ajx.php',
                                method: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                                    $('#Update').modal('hide');
                                    $('.alert-success').show().fadeOut(function () {
                                        // window.location.reload()
                                    });
                                    $('.alert-success').html("Data Updated Successfully");
                                    $('.alert-success').hide();
                                },
                                error: function () {
                                    $('.alert-danger').show().delay(2000).fadeOut();
                                    $('.alert-danger').html("Data not Updated!!!");
                                    $('.alert-danger').hide();
                                }
                            });
                        }
                    })
                });
                $('.delete1').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id)
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: "assets/php/ajx.php",
                            data: {
                                id: id,
                                actionName: 'customer_delete'
                            },
                            success: function (response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Customer Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function (status, error) {
                                +                                console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function (status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    });

    $('#add_order').click(function (e) {
        e.preventDefault();
        $('#add_product1').hide();
        $('#add_customer1').hide();
        $('#view_product1').hide();
        $('#view_customer1').hide()
        $('#add_order1').show()
        $('#view_order1').hide()
    });
    $('#view_order').click(function (e) {
        e.preventDefault();
        $('#add_product1').hide();
        $('#add_customer1').hide();
        $('#view_product1').hide();
        $('#view_customer1').hide()
        $('#add_order1').hide()
        $('#view_order1').show()

        $.ajax({
            type: "POST",
            url: "assets/php/ajx.php",
            data: {
                actionName: 'view_order'
            },
            success: function (data) {
                console.log(data);
                data1 = $.parseJSON(data);
                var rows = '';
                $.each(data1, function (index, data1) {
                    rows += '<tr>';
                    rows += '<td>' + data1.customer_product_id + '</td>';
                    rows += '<td>' + data1.customer_name + '</td>';
                    rows += '<td>' + data1.prod_name + '</td>';
                    rows += '<td>' + data1.prod_price + '</td>';
                    rows += '<td>' + data1.prod_quantity + '</td>';
                    rows += '<td>' + data1.prod_subtotal + '</td>';
                    rows += '<td><a data-id="' + data1.customer_product_id + '" class="btn btn-primary edit1">Edit</a></td>';
                    rows += '<td><a data-id="' + data1.customer_product_id + '" class="btn btn-danger delete1">Delete</a></td>';
                    rows += '</tr>';
                });

                $('#result3').html(rows);
                $('#order_tbl').DataTable();

                $('.edit1').on('click', function () {
                    var id = $(this).data('id');
                    fetchDatacustomer(id);
                    $(document).on('click', '#btn_update1', function () {
                        if ($('#customer_name').val() == '') {
                            $('#customer_nameval1').show().css('color', 'red');
                        }
                        if ($('#prod_qun1').val() == '') {
                            $('#prod_qunval1').show().css('color', 'red');
                        }
                        if ($('#prod_price1').val() == '') {
                            $('#prod_priceval1').show().css('color', 'red');
                        }
                        if ($('#prod_detail1').val() == '') {
                            $('#prod_detailval1').show().css('color', 'red');
                        }
                        if ($('#prod_img1').val() == '') {
                            $('#prod_imgval1').show().css('color', 'red');
                        } else {
                            var formData = new FormData();
                            formData.append('customer_id', id);
                            formData.append('actionName', 'update');
                            $.ajax({
                                url: 'assets/php/ajx.php',
                                method: 'post',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                                    $('#Update').modal('hide');
                                    $('.alert-success').show().fadeOut(function () {
                                        // window.location.reload()
                                    });
                                    $('.alert-success').html("Data Updated Successfully");
                                    $('.alert-success').hide();
                                },
                                error: function () {
                                    $('.alert-danger').show().delay(2000).fadeOut();
                                    $('.alert-danger').html("Data not Updated!!!");
                                    $('.alert-danger').hide();
                                }
                            });
                        }
                    })
                });
                $('.delete1').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id)
                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "POST",
                            url: "assets/php/ajx.php",
                            data: {
                                id: id,
                                actionName: 'customer_delete'
                            },
                            success: function (response) {
                                var data = $.parseJSON(response);
                                if (data.status === "success") {
                                    $('#success').show().delay(2000).fadeOut();
                                    $('#success').html("Customer Deleted Successfully");
                                    window.location.reload();
                                }
                            },
                            error: function (status, error) {
                                +                                console.error("AJAX Error: " + status + error);
                            }
                        });
                    } else {
                        return false;
                    }
                })
            },
            error: function (status, error) {
                console.error("Fetch Error: " + status + error);
            }
        });
    });

    function fetchData(id) {

        console.log(id);
        $('#Update').modal('show');
        $.ajax({
            url: 'assets/php/ajx.php',
            method: 'post',
            data: {
                id: id,
                actionName: 'fetch'
            },
            dataType: 'JSON',
            success: function (data) {

                $('#prod_name1').val(data[0]);
                var img = JSON.parse(data[1]);
                var add_img = '';
                $.each(img, function (index, user1) {
                    add_img += ' <img src="assets/php/uploads/' + img[index] + '" height="50px" width="50px"> ';
                });
                $('#add_img').html(add_img);
                $('#prod_qun1').val(data[2]);
                $('#prod_price1').val(data[3]);
                $('#prod_address1').val(data[4]);

                $('#Update').modal('show');
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }
    function fetchDatacustomer(id) {

        console.log(id);
        $('#Update1').modal('show');
        $.ajax({
            url: 'assets/php/ajx.php',
            method: 'post',
            data: {
                id: id,
                actionName: 'customerfetch'
            },
            dataType: 'JSON',
            success: function (data) {

                $('#customer_name1').val(data[0]);
                $('#customer_email1').val(data[1]);
                $('#customer_phone1').val(data[2]);
                if (data[3] == 'male') {
                    $('#male').prop('checked', true);
                } else {
                    $('#female').prop('checked', true);
                }
                $('#customer_address1').val(data[4]);

                $('#Update1').modal('show');
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }
    function updateData(id) {

        if ($('#prod_name1').val() == '') {
            $('#prod_nameval1').show().css('color', 'red');
        }
        if ($('#prod_qun1').val() == '') {
            $('#prod_qunval1').show().css('color', 'red');
        }
        if ($('#prod_price1').val() == '') {
            $('#prod_priceval1').show().css('color', 'red');
        }
        if ($('#prod_detail1').val() == '') {
            $('#prod_detailval1').show().css('color', 'red');
        }
        if ($('#prod_img1').val() == '') {
            $('#prod_imgval1').show().css('color', 'red');
        } else {
            var prod_name1 = $('#prod_name1').val();
            var prod_qun1 = $('#prod_qun1').val();
            var prod_price1 = $('#prod_price1').val();
            var prod_detail1 = $('#prod_address1').val();
            var prod_img1 = $('#prod_img1').val();
            console.log($('#prod_img1').val());
            var formData = new FormData();
            formData.append('prod_id', id);
            formData.append('prod_name1', prod_name1);
            formData.append('prod_img1', prod_img1);
            formData.append('prod_qun1', prod_qun1);
            formData.append('prod_price1', prod_price1);
            formData.append('prod_detail1', prod_detail1);
            formData.append('actionName', 'update');
            $.ajax({
                url: 'assets/php/ajx.php',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#prod_nameval1,#prod_imgval1,#prod_qunval1,#prod_priceval1,#prod_detailval1').hide()
                    $('#Update').modal('hide');
                    $('.alert-success').show().fadeOut(function () {
                        // window.location.reload()
                    });
                    $('.alert-success').html("Data Updated Successfully");
                    $('.alert-success').hide();
                },
                error: function () {
                    $('.alert-danger').show().delay(2000).fadeOut();
                    $('.alert-danger').html("Data not Updated!!!");
                    $('.alert-danger').hide();
                }
            });
        }
    }
});
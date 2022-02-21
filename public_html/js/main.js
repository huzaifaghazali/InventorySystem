$(document).ready(function () {
    var DOMAIN = "http://localhost/inv_project/public_html";
    // =============== REGISTER FORM  validation ===============
    $("#register_form").on("submit", function () {
        var status = false;
        var name = $("#username");
        var email = $("#email");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type = $("#usertype");

        // ^ is the first part of the string (combination of a to z both captial and small) 
        // $ is the last part of the string
        // for name pattern
        var n_patt = new RegExp(/^[A-Za-z ]{6,}$/);
        var name_pattern = new RegExp(/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*[a-zA-Z]{6,}$/);

        // for email pattern
        // huzaifa@gmail.com
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        // User name validation          name.val() == "" || name.val().length < 6
        if (!n_patt.test(name.val())) {
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please Enter the Name and Name should be more than 6 characters</span>");
            status = false;
        } else {
            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }

        // Email validation
        if (!e_patt.test(email.val())) {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }

        // Password validation
        if (pass1.val() == "" || pass1.val().length < 9) {
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please Enter the Password of more than 9 characters</span>");
            status = false;
        } else {
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }

        // Confirm Password validation
        if (pass2.val() == "" || pass2.val().length < 9) {
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please Enter the Password of more than 9 characters</span>");
            status = false;
        } else {
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }

        // Type validation
        if (type.val() == "") {
            type.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please Select the type</span>");
            status = false;
        } else {
            type.removeClass("border-danger");
            $("#t_error").html("");
            status = true;
        }

        // Same password validation
        if (pass1.val() == pass2.val() && status == true) {
            $(".overlay").show();
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#register_form").serialize(),
                success: function (data) {
                    if (data == "EMAIL_ALREADY_EXISTS") {
                        $(".overlay").hide();
                        //   alert("It seems like your email is already used");
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>Email already exists</span>");
                        status = false;
                    } else if (data == "SOME_ERROR") {
                        $(".overlay").hide();
                        alert("Something is wrong");
                    } else {
                        $(".overlay").hide();
                        window.location.href = encodeURI(DOMAIN + "/index.php?msg=You are now registered Now you can login");
                    }
                }
            })

        } else {
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
            status = true;
        }
    })

    // =============== FOR LOGIN FORM validation ===============
    $('#login_form').on("submit", function () {

        var email = $("#log_email");
        var pass = $("#log_password");
        var status = false;

        // Email validation
        if (email.val() == "") {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }

        // Password validation
        if (pass.val() == "") {
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please Enter the correct Password</span>");
            status = false;
        } else {
            pass.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }

        if (status) {
            $(".overlay").show();
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#login_form").serialize(),
                success: function (data) {
                    if (data == "NOT_REGISTERD") {
                        $(".overlay").hide();
                        //   alert("It seems like your email is already used");
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>You are not registered.</span>");
                        // status = false;
                    } else if (data == "PASSWORD_NOT_MATCHED") {
                        $(".overlay").hide();
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Password is incorrect</span>");
                        status = false;
                    } else {
                        $(".overlay").hide();
                        console.log(data);
                        window.location.href = DOMAIN + "/dashboard.php";
                    }
                }
            })
        }

    })

    // =============== Feteching the category ===============
    fetch_category();
    function fetch_category() {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: { getCategory: 1 },
            success: function (data) {
                var root = "<option value='0'>Root</option>"
                var choose = "<option value=''>Choose Category</option>";
                $("#parent_category").html(root + data);
                $("#select_category").html(choose + data);
            }
        })
    }

    // =============== Feteching the brand ===============
    fetch_brand();
    function fetch_brand() {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: { getBrand: 1 },
            success: function (data) {
                var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose + data);
            }
        })
    }

    // =============== Add a new Category ===============
    $("#category_form").on("submit", function () {
        if ($("#category_name").val() == "") {
            $("#category_name").addClass("border-danger");
            $("#category_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        } else {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function (data) {
                    if (data == "CATEGORY_ADDED") {
                        $("#category_name").removeClass("border-danger");
                        $("#category_error").html("<span class='text-success'>New Category Added Successfully</span>");
                        $("#category_name").val("");
                        fetch_category();
                    } else {
                        alert(data);
                    }
                }
            })
        }
    })

    // =============== Add a new Brand ===============
    $("#brand_form").on("submit", function () {

        if ($("#brand_name").val() == "") {
            $("#brand_name").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        } else {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#brand_form").serialize(),
                success: function (data) {
                    if (data == "BRAND_ADDED") {
                        $("#brand_name").removeClass("border-danger");
                        $("#brand_error").html("<span class='text-success'>New Brand Added Successfully..!</span>");
                        $("#brand_name").val("");
                        fetch_brand();
                    } else {
                        alert(data);
                    }

                }
            })
        }
    })


    // =============== Add a new Product ===============
    $("#product_form").on("submit", function () {

        var product_name = $("#product_name");
        var prduct_price = $("#product_price");
        var product_qty = $("#product_qty");
        var product_category = $("#select_category");
        var product_brand = $("#select_brand");
        var status = 0;

        // Product Name validation
        if (product_name.val() == "") {
            product_name.addClass("border-danger");
            $("#product_name_error").html("<span class='text-danger'>Please Enter Product Name</span>");
            status--
        } else {
            product_name.removeClass("border-danger");
            $("#product_name_error").html("");
            status++
        }

        // Product category validation
        if (product_category.val() == "") {
            product_category.addClass("border-danger");
            $("#category_select_error").html("<span class='text-danger'>Please Select Product Category</span>");
            status--;
        } else {
            product_category.removeClass("border-danger");
            $("#category_select_error").html("");
            status++;
        }

        // Product Brand validation
        if (product_brand.val() == "") {
            product_brand.addClass("border-danger");
            $("#brand_select_error").html("<span class='text-danger'>Please Select Product Brand</span>");
            status--;
        } else {
            product_brand.removeClass("border-danger");
            $("#brand_select_error").html("");
            status++;
        }

        // Product Price validation
        if (prduct_price.val() == "") {
            prduct_price.addClass("border-danger");
            $("#product_price_error").html("<span class='text-danger'>Please Enter Product Price</span>");
            status--;
        } else {
            prduct_price.removeClass("border-danger");
            $("#product_price_error").html("");
            status++;
        }

        // Product Quantity validation
        if (product_qty.val() == "") {
            product_qty.addClass("border-danger");
            $("#product_qty_error").html("<span class='text-danger'>Please Enter Product quantity</span>");
            status--;
        } else {
            product_qty.removeClass("border-danger");
            $("#product_qty_error").html("");
            status++;
        }

        if (status == 5) {

            $("#form_error").removeClass("alert alert-danger");
            $("#form_error").html("")
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#product_form").serialize(),
                success: function (data) {
                    if (data == "NEW_Product_ADDED") {
                        $("#product_name").val("");
                        $("#product_qty").val("");
                        $("#product_price").val("");
                        $("#select_category").val("")
                        $("#select_brand").val("")
                        alert("New Product Added Successfully");
                    } else {
                        console.log(data);
                        alert(data);
                    }
                }
            })
        } else {

            $("#form_error").addClass("alert alert-danger");
            $("#form_error").html("<span class='text-dark'> Please Fill all the fields</span>")
        }





        // $.ajax({
        //     url: DOMAIN + "/includes/process.php",
        //     method: "POST",
        //     data: $("#product_form").serialize(),
        //     success: function (data) {
        //         if (data == "NEW_Product_ADDED") {
        //             $("#product_name").val("");
        //             $("#product_qty").val("");
        //             $("#product_price").val("");
        //             alert(data);
        //         } else {
        //             console.log(data);
        //             alert(data);
        //         }
        //     }
        // })
    })

})
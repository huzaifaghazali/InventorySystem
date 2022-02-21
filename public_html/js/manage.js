$(document).ready(function () {

    var DOMAIN = "http://localhost/inv_project/public_html";
    // =============== Manage Category ===============
    manageCategory(1);
    function manageCategory(pn) {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: { manageCategory: 1, pageno: pn },
            success: function (data) {
                $("#get_category").html(data);
                // alert(data);
            }
        })
    }

    // =============== Paginaging of the categories
    $("body").delegate(".page-link", "click", function () {
        var pn = $(this).attr("pn");
        manageCategory(pn);
    })

    // =============== Deleting the Category ===============
    $("body").delegate(".del_cat", "click", function () {
        var did = $(this).attr('did');
        var $ele = $(this).parent().parent();
        if (confirm("Are you sure? You want to delete...!")) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: { deleteCategory: 1, id: did },
                success: function (data) {
                    if (data == "DEPENDENT_CATEGORY") {
                        alert("Sorry! this category is Parent of other categories");
                    } else if (data == "CATEGORY_DELETED") {
                        $ele.fadeOut().remove();
                        alert("Category Deleted Successfully");
                        // manageCategory(1);

                    } else if (data == "DELETED") {
                        alert("Deleted Successfully")
                    } else {
                        alert(data);
                    }


                }
            })
        } else {

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
                var root = "<option value='0'>Root</option>";
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

    // =============== Update Category ===============
    $("body").delegate(".edit_cat", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: { updateCategory: 1, id: eid },
            success: function (data) {
                console.log(data);
                $("#c_id").val(data["c_id"]);
                $("#update_category").val(data["category_name"]);
                $("#parent_category").val(data["parent_category"]);
            }

        })
    })

    $("#update_category_form").on("submit", function () {

        if ($("#update_category").val() == "") {
            $("#update_category").addClass("border-danger");
            $("#category_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        } else {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                success: function (data) {
                    alert(data)
                    window.location.href = "";
                }
            })
        }
    })

    // ================================= Brands =============================================
    // =============== Manage Brand ===============
    manageBrand(1);
    function manageBrand(pn) {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: { manageBrand: 1, pageno: pn },
            success: function (data) {
                $("#get_brand").html(data);
                // alert(data);
            }
        })
    }

    // =============== Paginaging of the brands ===============
    $("body").delegate(".page-link", "click", function () {
        var pn = $(this).attr("pn");
        manageBrand(pn);
    })

    // =============== Deleting the Brand ===============
    $("body").delegate(".del_brand", "click", function () {
        var did = $(this).attr('did');
        var $ele = $(this).parent().parent();
        if (confirm("Are you sure? You want to delete...!")) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: { deleteBrand: 1, id: did },
                success: function (data) {
                    if (data == "DELETED") {
                        $ele.fadeOut().remove();
                        alert("Brand Deleted Successfully");
                        // manageBrand(1);
                    } else {
                        alert(data);
                    }


                }
            })
        }
    })

    // =============== Update Brand ===============

    $("body").delegate(".edit_brand", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: { updateBrand: 1, id: eid },
            success: function (data) {
                console.log(data);
                $("#brand_id").val(data["brand_id"]);
                $("#update_brand").val(data["brand_name"]);

            }

        })
    })


    $("#update_brand_form").on("submit", function () {

        if ($("#update_brand").val() == "") {
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        } else {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_brand_form").serialize(),
                success: function (data) {
                    alert(data)
                    window.location.href = "";
                }
            })
        }
    })

    // ================================= Products =============================================

    // =============== Manage Product ===============
    manageProduct(1);
    function manageProduct(pn) {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: { manageProduct: 1, pageno: pn },
            success: function (data) {
                $("#get_product").html(data);
                // alert(data);
            }
        })
    }

    // =============== Paginaging of the Products ===============
    $("body").delegate(".page-link", "click", function () {
        var pn = $(this).attr("pn");
        manageProduct(pn);
    })

    // =============== Deleting the Products ===============
    $("body").delegate(".del_product", "click", function () {
        var did = $(this).attr('did');
        var $ele = $(this).parent().parent();
        if (confirm("Are you sure? You want to delete...!")) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: { deleteProduct: 1, id: did },
                success: function (data) {
                    if (data == "DELETED") {
                        $ele.fadeOut().remove();
                        alert("Product Deleted Successfully");
                        // manageBrand(1);
                    } else {
                        alert(data);
                    }


                }
            })
        }
    })

    // =============== Update Product ===============

    $("body").delegate(".edit_product", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: { updateProduct: 1, id: eid },
            success: function (data) {
                console.log(data);
                $("#product_id").val(data["product_id"]);
                $("#update_product").val(data["product_name"]);
                $("#select_category").val(data["category_id"]);
                $("#select_brand").val(data["brand_id"]);
                $("#product_price").val(data["product_price"]);
                $("#product_qty").val(data["product_stock"]);
            }

        })
    })


    $("#update_product_form").on("submit", function () {

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
                data: $("#update_product_form").serialize(),
                success: function (data) {

                    if (data == "UPDATED") {
                        alert("Product Updated Successfully..!");
                        window.location.href = "";
                    } else {
                        alert(data);
                    }
                }
            })
        } else {

            $("#form_error").addClass("alert alert-danger");
            $("#form_error").html("<span class='text-dark'> Please Fill all the fields</span>")
        }

    })

})
<!-- Modal -->
<div class="modal fade" id="form_products" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="product_form" onsubmit="return false">
          <div id="form_error" class="form-text"></div>
        <div class="col-md-6">
            <label class="form-label">Date</label>
            <input type="text" class="form-control" id="added_date" name="added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product Name" required>
            <div id="product_name_error" class="form-text"></div>
          </div>

          <div class="form-gorup">
            <label class="form-label">Category</label>
            <select name="select_category" id="select_category" class="form-control" required>

            </select>
            <div id="category_select_error" class="form-text"></div>
          </div>
          <div class="form-group">
            <label class="form-label">Brand</label>
            <select name="select_brand" id="select_brand" class="form-control" required>

            </select>
            <div id="brand_select_error" class="form-text"></div>
          </div>

          <div class="form-group">
            <label class="form-label">Product Price</label>
            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price">
            <div id="product_price_error" class="form-text"></div>
          </div>
          
          <div class="form-group">
            <label class="form-label">Quantity</label>
            <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Product Quantity">
            <div id="product_qty_error" class="form-text"></div>
          </div>

        
          <div class="col-12 d-flex justify-content-center mb-2">
            <button type="submit" class="btn btn-success">Add Product</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
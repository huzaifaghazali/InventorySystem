<!-- Modal -->
<div class="modal fade" id="form_brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="brand_form" onsubmit="return false">
          <div class="mb-3">
            <label class="form-label">Brand Name</label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand Name">
            <div id="brand_error" class="form-text"></div>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
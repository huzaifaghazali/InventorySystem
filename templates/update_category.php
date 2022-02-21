<!-- Modal -->

<div class="modal fade" id="form_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="update_category_form" onsubmit="return false">
          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="hidden" name="c_id" id="c_id" value="">
            <input type="text" class="form-control" name="update_category" id="update_category" placeholder="Enter Category Name">
            <div id="category_error" class="form-text"></div>
          </div>

          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Parent Category</label>
            <select class="form-control" id="parent_category" name="parent_category">
             
            </select>
           
          </div>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
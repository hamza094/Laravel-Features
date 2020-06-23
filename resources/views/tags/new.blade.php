      <div class="modal " id="addtags" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        
      </div>
      <form action="" method="post" id="frmaddtag" accept-charset="utf-8">
         {{csrf_field()}}
          <div class="modal-body">
          <ul id="errors" class="list-unstyled">
              
          </ul>
          <div class="form-group">
          <label for="tag">Tag Name:</label>
          <input type="text" name="name" class="form-control" placeholder="Enter New tag" >
              </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Tag</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
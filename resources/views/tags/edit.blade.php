      <div class="modal " id="edittag">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        
      </div>
      <form action="" method="post" id="frmaedittag" accept-charset="utf-8">
         {{csrf_field()}}
          {{method_field('PUT')}}
          <div class="modal-body">
           <ul id="errors" class="list-unstyled">
              
          </ul>
          <div class="form-group">
          <label for="channel">Update tag - {{$tag->id}}</label>
          <input type="text" name="name" class="form-control" placeholder="Update Category" value="{{$tag->name}}" required>
             <input type="hidden" name="id" value="{{$tag->id}}"/>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" data-task="{{$tag->id}}" class="btn btn-danger" id="tagdelete"  data-dismiss="modal" aria-label="Close"> Delete Category</button>
        <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
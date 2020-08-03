<div class="modal bs-modal called-modal" id="addCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-alt-large" role="document">
        <div class="modal-content">
            <div class="modal__header">
                <h3>Add Category</h3>		
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>				
            </div>
            <div class="modal-body">
                <form method="POST" id="addCategory">
                    <div class="form-control">
                        <label for="label" class="form-label">Category Label</label>
                        <input id="label" type="text" name="label" value="{{ old('label') }}" required autocomplete="name">
                        <span class="invalid-feedback" role="alert" id="alert-label"></span>                      
                    </div> 
                    <div class="fwfe mtm">                    
                        <button type="submit" class="btn blue">Create</button>
                        <button class="btn grey" data-dismiss="modal">Cancel</button>
                    </div>   
                </form>                       
            </div>
        </div>
    </div>      
</div>

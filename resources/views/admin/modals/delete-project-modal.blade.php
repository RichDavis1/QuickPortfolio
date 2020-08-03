<div class="modal bs-modal called-modal" id="deleteProjectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-alt-large" role="document">
        <div class="modal-content">
            <div class="modal__header">
                <h3>Are you sure you want to delete this project?</h3>		
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>				
            </div>
            <div class="modal-body">
                <div class="form-control">
                    <label for="label" class="form-label">This action is permanent and cannot be undone.</label>
                </div>
                <div class="fwfe mtm">                    
                    <div type="submit" class="btn blue" id="confirm-deletion" data-id="{{$project->id}}">Delete</div>
                    <button class="btn grey" data-dismiss="modal">Cancel</button>
                </div>                        
            </div>
        </div>
    </div>      
</div>

<div class="table-container">
    <div class="fwfe ps">
        <div class="prm">Create New</div>
        <i class="fa fa-plus" id="create-post" aria-hidden="true"></i>
    </div>
    <div class="table-wrap">  
        @if(!count($projects))
            <h3 class="no-results">You have not created any projects.</h3>
        @else
            <div class="fwsbnc">
                <div class="header tbl-head-45">Title</div>
                <div class="header tbl-head-20">Status</div>
                <div class="header tbl-head-25">Edit</div>
            </div>
            <div class="table-body">            
                @foreach($projects as $project)
                    <div class="table-row fwsbnc">
                        <div class="trow tbl-head-45">{{ $project->title }}</div>
                        <div class="trow tbl-head-20">{{ ucfirst($project->status) }}</div>
                        <div class="trow tbl-head-25">
                            <i class="fa fa-pencil edit-post-trigger" aria-hidden="true" data-postid="{{ $project->id }}"></i>
                        </div>                    
                    </div>                
                @endforeach            
            </div>       
        @endif     
    </div>
</div>
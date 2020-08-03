<div class="fwsbnc" id="post-settings">
    <div class="tbl-head-45">
        <div class="fw mbmm">
            <i class="fa fa-eye prmm" aria-hidden="true"></i>
            <div class="prs"><strong>Post Status: </strong><span id="post-status">{{ $project->status }}</span></div>
            <i class="fa fa-pencil" id="edit-status" data-status="closed" aria-hidden="true" data-postid="{{ $project->id }}"></i>                  
        </div>
        <div class="hidden" id="status-wrapper">
            <select id="status">
                <option @if($project->status == 'draft')selected @endif value="draft">Draft</option>
                <option @if($project->status == 'published')selected @endif value="published">Published</option>
            </select>
        </div>
        <div class="fw mbmm">
            <span class="mrmm" id="github-link"></span>
            <input class="" id="github_link" type="url" placeholder="Github Link" value="{{ $project->github_link }}"/>
        </div>     
        <div class="fw mbmm">
            <i class="fa fa-clock-o prs" aria-hidden="true"></i>
            <input class="" id="read_time" type="number" placeholder="Read time in minutes" value="{{ $project->read_time }}"/>
        </div>             
    </div>
    <div class="tbl-head-55 ar">
        <div class="fwfe mbs">
            <div class="btn red" id="delete-post" data-postid="{{ $project->id }}">Delete</div>
            <div class="btn blue" id="update-post" data-postid="{{ $project->id }}">Save</div>
        </div>        
        @if(is_array($categories))
            @include('core.dropdowns.multibox-dropdown', ['items' => $categories, 'label'=>'Categories', 'selector'=>'select-category-trigger'])
        @endif                                
    </div>        
</div>
<div class="mtm">
    <input class="" id="title" type="text" placeholder="Post Title" value="{{ $project->title }}"/>
</div> 
<div class="editor-wrap mtm">
    <textarea class="editor-box" id="post-content">{{ $project->content }}</textarea>
</div>
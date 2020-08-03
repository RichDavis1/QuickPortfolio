<div class="fwsbnc" id="post-settings">
    <div class="tbl-head-45">
        <div class="fw mbmm">
            <i class="fa fa-eye prs" aria-hidden="true"></i>
            <div class="prs"><strong>Post Status: </strong><span id="post-status">Draft</span></div>
            <i class="fa fa-pencil" id="edit-status" data-status="closed" aria-hidden="true"></i>               
        </div>
        <div class="hidden" id="status-wrapper">
            <select id="status">
                <option selected value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>        
        <div class="fw mbmm">
            <span class="mrmm" id="github-link"></span>
            <input class="" id="github_link" type="url" placeholder="Github Link" value=""/>
        </div>  
        <div class="fw mbmm">
            <i class="fa fa-clock-o prs" aria-hidden="true"></i>
            <input class="" id="read_time" type="number" placeholder="Read time in minutes" value=""/>
        </div>                
    </div>
    <div class="tbl-head-55 ar">
        <div>
        <div class="btn blue mbs" id="save-post">Save</div>
        </div>        
        @if(is_array($categories))
            @include('core.dropdowns.multibox-dropdown', ['items' => $categories, 'label'=>'Categories', 'selector'=>'select-category-trigger'])
        @endif                                
    </div>        
</div>

<div class="mtm">
    <input class="" id="title" type="text" placeholder="Post Title" value=""/>
</div> 
<div class="editor-wrap mtm">
    <textarea class="editor-box" id="post-content"></textarea>
</div>

<div class="table-container">
    <div class="settings-container">
        <h3>Settings</h3>        
        <div class="settings-wrap">
            <div class="mts">
                <label for="website_name" class="sub-label">Website Name</label>
                <span class="invalid-feedback" role="alert" id="alert-name"></span>    
                <div class="fw">
                    <input id="website_name" class="admin-setting" type="text" name="website_name" value="{{ $settings->getWebsiteName() }}">                    
                    <div class="setting-actions fw plm hidden">
                        <i class="fa fa-check mrmm save-field" aria-hidden="true" data-field="website_name"></i>
                        <i class="fa fa-times close-prompt" aria-hidden="true" data-field="website_name"></i>                    
                    </div>
                </div>
            </div>                   
            <div class="mts">
                <label for="github_link" class="sub-label">Github Link</label>
                <span class="invalid-feedback" role="alert" id="alert-name"></span>    
                <div class="fw">
                    <input id="github_link" class="admin-setting" type="url" name="github_link" value="{{ $settings->getGithubLink() }}">                    
                    <div class="setting-actions fw plm hidden">
                        <i class="fa fa-check mrmm save-field" aria-hidden="true" data-field="github_link"></i>
                        <i class="fa fa-times close-prompt" aria-hidden="true" data-field="github_link"></i>                    
                    </div>
                </div>
            </div>
            <div class="mts">
                <label for="linkedin_link" class="sub-label">LinkedIn Link</label>
                <span class="invalid-feedback" role="alert" id="alert-name"></span>    
                <div class="fw">
                    <input id="linkedin_link" class="admin-setting" type="url" name="linkedin_link" value="{{ $settings->getLinkedinLink() }}">                    
                    <div class="setting-actions fw plm hidden">
                        <i class="fa fa-check mrmm save-field" aria-hidden="true" data-field="linkedin_link"></i>
                        <i class="fa fa-times close-prompt" aria-hidden="true" data-field="linkedin_link"></i>                    
                    </div>
                </div>
            </div>                        
        </div>
    </div>
    <div class="fwsb">
        <h3>Categories</h3>
        <div class="fwfe ps">
            <div class="prm">Add Category</div>
            <i class="fa fa-plus fan" id="add-category" aria-hidden="true"></i>
        </div>
    </div>
    <div class="table-wrap">      
        @if(count($categories))  
            <div class="fwsbnc">
                <div class="header tbl-head-45">Name</div>
                <div class="header tbl-head-30 tc">Slug</div>
                <div class="header tbl-head-20">Remove</div>
            </div>        
            <div class="table-body">
                @foreach($categories as $category)
                    <div class="table-row fwsbnc">
                        <div class="trow tbl-head-45">{{ $category->label }}</div>
                        <div class="trow tbl-head-30 tc">{{ $category->slug }}</div>
                        <div class="trow tbl-head-20 tc">
                            <i class="fa fa-minus remove-category" aria-hidden="true" data-categoryId="{{ $category->id }}"></i>
                        </div>                    
                    </div>                
                @endforeach
            </div>      
        @else 
            <h3 class="no-results">You have not created any categories yet.</h3>
        @endif                   
    </div>    
</div>

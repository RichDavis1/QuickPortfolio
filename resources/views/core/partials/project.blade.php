<div class="blog-item-container">
    <div class="blog-item-wrapper" style="background-color: {{$project->getBackgroundColor()}}">                
        <a href="{{url('/project/' . $project->slug)}}">
            <div class="categories-wrapper" style="color: {{$project->getTextColor()}}">
                @if(is_array($categories))                    
                    @foreach($categories as $category)
                        <div class="category">{{ $category->label }}</div>
                    @endforeach                
                @endif    
            </div>
            <div class="blog-item" style="color: {{$project->getTextColor()}}">
                <h3>{{ $project->title }}</h3>
                <div class="blog-text">
                    {{ html_entity_decode(strip_tags($project->content)) }}
                </div>   
                <div class="fwsb blog-item-footer">
                    <div class="read-time">
                        @if($project->read_time)
                            {{$project->read_time . ' MIN READ'}}
                        @endif
                    </div> 
                    <div class="fw">
                        @if($project->github_link)
                            <div class="link-wrap ttip">
                                <div id="github-link"></div>
                                <div class="tttext">
                                    Check Code on Github
                                </div>
                            </div>
                        @endif 
                    </div>
                </div>                               
            </div>  
        </a>        
    </div>
</div>


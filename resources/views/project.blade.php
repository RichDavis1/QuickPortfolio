@extends('layouts.website')

@section('content')
<div class="container" id="single-post">
    <div class="categories-wrapper">     
        @if(is_array($categories))            
            @foreach($categories as $category)   
                <div class="category-tab" style="border-color: {{ $project->getRandomColor() }};">
                    <div class="category-item" style="color: {{ $project->getRandomColor() }};">{{ $category->label }}</div>
                </div>                                   
            @endforeach
        @endif                          
    </div>      
    <div class="blog-header">
        <h2>{{ $project->title }}</h2> 
    </div>   
    <div class="blog-additional fw">
        @if($project->github_link)
            <div class="link-wrap ttip">
                <a href="{{ $project->github_link }}" target="_blank"><div id="github-link"></div></a>
                <div class="tttext">
                    Check Code on Github
                </div>
            </div>
        @endif       
    </div>
    <div class="blog-body"><?php echo $project->content; ?></div>
</div>
@stop
@extends('layouts.website')

@section('content')
<div class="blog-container">
    <div>
        <div class="blog-list">
            @foreach($projects as $project)
                @include('core.partials.project', ['project'=>$project, 'categories'=>$project->categories()])
            @endforeach 
        </div>  
    </div>  
</div>
@stop
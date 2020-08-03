@extends('layouts.website')

@push('scripts')
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="{{ asset('js/admin.js')}}"></script>
@endpush

@section('content')
<div class="admin-container">
    <div class="admin-portal" id="admin-portal">
        <div class="admin-bar fwsb">
            <div class="bar-item abt active" data-container="admin-posts" data-r="projects">Posts</div>
            <div class="bar-item abt" data-container="admin-create" data-r="create">Create</div>
            <div class="bar-item abt" data-container="admin-contacts" data-r="contacts">Contacts</div>
            <div class="bar-item abt" data-container="admin-settings" data-r="settings">Settings</div>                       
        </div>
        <div id="admin-container" class="mtl">
            <div class="ac" id="admin-posts">
                @include('admin.partials.admin-posts', ['projects' => $projects])
            </div>
            <div class="hidden ac" id="admin-create">
            </div>
            <div class="hidden ac" id="admin-settings"></div>    
            <div class="hidden ac" id="admin-contacts"></div>                        
        </div>        
    </div>
</div>
@stop

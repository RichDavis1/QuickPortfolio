<div class="table-container">
    <div class="table-wrap">        
        @if(!count($contacts))
            <h3 class="no-results">You have not received any contacts.</h3>
        @else        
            <div class="fwsbnc">
                <div class="header tbl-head-25">Name</div>
                <div class="header tbl-head-60">Subject</div>
                <div class="header tbl-head-10">View</div>
            </div>
            <div class="table-body">
                @foreach($contacts as $contact)
                    <div class="table-row fwsbnc">
                        <div class="trow tbl-head-25">{{ $contact->getName() }}</div>
                        <div class="trow tbl-head-60"><?php echo $contact->getSubject(); ?></div>
                        <div class="trow tbl-head-10">
                            <i class="fa fa-chevron-down expand-message" aria-hidden="true" data-status="closed" data-id="{{ $contact->id }}"></i>
                        </div>                    
                    </div>  
                    <div class="hidden message-content" id="{{ $contact->id . '-expanded' }}">                        
                        <div><strong>Email: </strong>{{ $contact->getEmail() }}</div>
                        <div><strong>Subject: </strong><?php echo $contact->getSubject(); ?></div>
                        <div class="message"><?php echo $contact->getMessage(); ?></div>
                    </div>              
                @endforeach                          
            </div>   
        @endif      
    </div>
</div>
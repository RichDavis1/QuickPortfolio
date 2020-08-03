$(document).ready(function(){

    $(document).on('submit', '#adminRegistration', function(e){
        e.preventDefault();
        
        clearErrors();
        var registerForm = $("#adminRegistration");
        var formData = registerForm.serialize();

        $.ajax({            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },                        
            type: 'post',
            dataType: "json",
            url : 'admin-register',
            data: formData,    		
            success: function (data) { 
                if(data.errors){
                    $.each(data.errors, function(name, error){
                        errorLabel(name, error[0]);                        
                    });

                    return false;
                }  
                window.location.href='/admin';
            }
        });
    });  

    $(document).on('click', '#contact-trigger', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },            
            type: 'get',
            dataType: "json",
            url : '/api/contact/create',
            data: {},
            success: function (data) { 
                Core.clear_modals();

                $('html').append(data.modal);
                $("#contactModal").modal('show').css('display', 'block');	    
                $("#rn").focus();     
            }    
        });
    });

    $(document).on('submit', '#contact', function(e){        
        e.preventDefault();
        clearErrors();

        var loginForm = $("#contact");
        var formData = loginForm.serialize();        
        
        $.ajax({            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },                        
            type: 'post',
            dataType: "json",
            url : '/api/contact/store',
            data: formData,    		
            success: function (data) { 
                if(data.errors){
                    $.each(data.errors, function(name, error){
                        errorLabel(name, error[0]);
                        
                    });
                }else{
                    $("#contact").css('display', 'none');
                    $("#thank-you").css('display', 'block');
                }  
            }
        });
    }); 

    $(document).on('click', '#hamburger', function(){
        selection = $(this);
        selection.removeClass('is-active');
        var status = selection.attr('data-status');

        if(status == 'closed'){
            selection.addClass('is-active');
            selection.attr('data-status', 'open');
            $("#mobile-nav").css('display', 'block');
        }else{
            selection.attr('data-status', 'closed');
            $("#mobile-nav").css('display', 'none');
        }
    });    

    function errorLabel(id, msg){
        $("#alert-" + id).empty().append('<strong>'+msg+'</strong>').css('display', 'block');
    }

    function clearErrors() {
        $('.invalid-feedback').each(function(){
            $(this).css('display', 'none');
        });
    }         

    $(document).on('click', '#logOutTrigger', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },            
            type: 'post',
            dataType: "JSON",
            url : '/logout',
            data: {},
            success: function () { 
                window.location.href='/';
            }    
        });
    });


});     


$(function(){

    $('#btnNameEdit').on('click',function(e){
        e.preventDefault();
        $('#newUserName').removeAttr('hidden');        
        $('#editNameDiv').attr('hidden' , true);        
    }); 
    
    $('#dismissNameEdit').on('click',function(e){
        e.preventDefault();
        $('#newUserName').attr('hidden' , true);        
        $('#editNameDiv').removeAttr('hidden');        
    });


    $('#btnEmailEdit').on('click',function(e){
        e.preventDefault();
        $('#newUserEmail').removeAttr('hidden');        
        $('#editEmailDiv').attr('hidden' , true);        
    }); 
    
    $('#dismissEmailEdit').on('click',function(e){
        e.preventDefault();
        $('#newUserEmail').attr('hidden' , true);        
        $('#editEmailDiv').removeAttr('hidden');        
    });
    
    $('#nameSubmit').on('click', function(e){
        e.preventDefault();
        console.log($('#username').val());
        if($('#username').val() != ""){
            $.ajax({
                type:'POST',
                url:'/profile/name',
                data:{
                    'name':$('#username').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $('#userNameEdit').text(data.name);
                    $('#newUserName').attr('hidden' , true);        
                    $('#editNameDiv').removeAttr('hidden');
                    Materialize.toast(data.msg,1000);
                }
            });
        }
    });
    
    
    $('#emailSubmit').on('click', function(e){
        e.preventDefault();
        let re = new RegExp('@');
        var test = re.test($('#useremail').val());
        console.log(test);
        if(test){
            $.ajax({
                type:'POST',
                url:'/profile/email',
                data:{
                    'email':$('#useremail').val(),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $('#userEmailEdit').text(data.email);
                    $('#newUserEmail').attr('hidden' , true);        
                    $('#editEmailDiv').removeAttr('hidden');
                    Materialize.toast(data.msg,1000);
                }
            });
        } else {
            Materialize.toast("Should be an email",1000, 'red darken-4');
        }
    });


});
$(function(){

    $('body').css({'background-image' : 'none'});

    var _id = 0;

    $('#user-collection-table').on('click','.item-visibility',function(e) {
        id = $(this).data('id');

        setId(id);

        if ($('#'+getId()+'').is(':checked')){
            $('#'+getId()+'').removeAttr('checked');
            changeVisibility(getId(),'public');
        }else{
            $('#'+getId()+'').attr('checked', 'checked');
            changeVisibility(getId(),'private')
        }


    });

    function setId(id){
        return _id = id;
    }

    function getId(){
        return _id;
    }

    function changeVisibility(id,visibility){
        $.ajax({
            type:'post',
            url: '/core/visible/'+id,
            data:{
                status: visibility,
                id: id
            },  
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                Materialize.toast('Changed to '+visibility+'',700);
                console.log('data from ', data);
            },  
        })
    }

});
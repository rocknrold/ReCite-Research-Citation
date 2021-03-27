$(function(){
    $('body').css({'background-image' : 'none'});

    $('.row').on('click', '.articleLike', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('[data-id="'+id+'"]').find('i').css('color','black');
        $('[data-id="'+id+'"]').find('span').html(parseInt( $('[data-id="'+id+'"]').find('span').text()) + 1);

        const dataid = id.split('');
        if(id == "dislike_"+dataid.slice(8,).join("")+"") {
            $.ajax({
                type:'GET',
                url:'core/like/',
                data: {
                    dislikes:dataid.slice(8,).join(""),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    Materialize.toast('Disliked',500);
                    $('[data-id="'+id+'"]').find('i').css('color','green');
                    $('[data-id="'+id+'"]').addClass('btn-flat disabled');
                }
            });
        } 
        else {
            $.ajax({
                type:'GET',
                url:'core/like/',
                data: {
                    likes:dataid.slice(5,).join(""),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    Materialize.toast('Liked',500);
                    $('[data-id="'+id+'"]').find('i').css('color','green');
                    $('[data-id="'+id+'"]').addClass('btn-flat disabled');
                }
            });
        }

    });
});
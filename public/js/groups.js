$(function(){

    $('.row').on('click', '.articleLike', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('[data-id="'+id+'"]').find('i').css('color','black');
        $('[data-id="'+id+'"]').find('span').html(parseInt( $('[data-id="'+id+'"]').find('span').text()) + 1);

        const dataid = id.split('');
        if(id == "dislike_"+dataid[8]+"") {
            $.ajax({
                type:'GET',
                url:'core/like/',
                data: {
                    dislikes:dataid[8],
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    Materialize.toast('Disliked',500);
                    $('[data-id="'+id+'"]').find('i').css('color','green');
                }
            });
        } 
        else {
            $.ajax({
                type:'GET',
                url:'core/like/',
                data: {
                    likes:dataid[5],
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    Materialize.toast('Liked',500);
                    $('[data-id="'+id+'"]').find('i').css('color','green');
                }
            });
        }

    });
});
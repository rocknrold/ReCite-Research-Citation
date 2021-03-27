$(function(){

    $('body').css({'background-image':'none'});

    $.get({
        url:'https://api.github.com/users/rocknrold',
        success:function(data){
            $('#dev1').attr('src', data.avatar_url);
            $('#dev1_url').attr('href', data.html_url).html(" " +data.login);
        },
    });
    $.get({
        url:'https://api.github.com/users/adrn6899',
        success:function(data){
            $('#dev2').attr('src', data.avatar_url);
            $('#dev2_url').attr('href', data.html_url).html(" " +data.login);
        },
    });
    $('#runGetRL').on('click', function(e){
        console.log($('#queryGetRL').val());
        e.preventDefault();
        $.ajax({
            type:'GET',
            url:$('#queryGetRL').val(),
            dataType:'json',
            success:function(data){
                console.log(data);
                $('#runGetContent').html(JSON.stringify(data,null,'  '));
            }
        })
    })

});
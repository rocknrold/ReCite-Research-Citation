$(function(){

    var globalSearchKeyword = $('#keyword').text();
    var currentPageIdentifier = $('#currentPage').text();

    if($('#keyword').text() != ""){ 
        $.ajax({
                type: 'POST',
                url: '/search/library',
                dataType: 'json',
                data: { query: $('#keyword').text()} ,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    console.log(response);
                    console.log(response[0].data);
                    $('#totalResults').html(response[0].totalHits);

                    resultTemplate(response);                   
                }
        });
    };


    // next page 

    $('#searchLibrary-next').on('click', function(e){
        var page = parseInt($('#currentPage').text()) + 1;
        console.log(page);
        console.log('next');
        $.ajax({
            type:'GET',
            url: '/search/'+globalSearchKeyword+'/'+page,
            dataType: 'json',
            data: {query: globalSearchKeyword, currentPage:page},
            success:function(response){
                console.log('next');
                resultTemplate(response);
                $('#currentPage').html(page);
            }
        });
    });


    // back page 

    $('#searchLibrary-back').on('click', function(e){
        var page = parseInt($('#currentPage').text()) - 1;
        if(page >= 1){
            console.log(page);
            console.log('back');

            $.ajax({
                type:'GET',
                url: '/search/'+globalSearchKeyword+'/'+page,
                dataType: 'json',
                data: {query: globalSearchKeyword, currentPage:page},
                success:function(response){
                    console.log('next');
                    resultTemplate(response);
                    $('#currentPage').html(page);
                }
            });
        }
    });


    function resultTemplate(response)
    {
        $.each(response[0].data,function(key, value){
            var authors = ""
            $.each(value['_source']['authors'], function(key, value){
                authors += value + ',';
            });

            $('#result-list').append('<div class="divider"></div><div class="section"><div class="row">'+
                '<div class="col s12"><h6><strong>Title : '+ value['_source']['title'] +'</strong></h6></div>'+
                '<div class="col s12"><h6><strong>Author : '+ authors +'</strong></h6></div>'+
                '<div class="col s6"><p>Year Published : '+ value['_source']['year'] +'</p><i> oia : '+ value['_source']['oai'] +'</i></div>'+
                '<div class="col s12 m6 l3"><button class="bg-white bg-transparent">'+
                '<i class="material-icons">add</i></button><br><small>Add to library</small></div>'+
                '<div class="col s12 m6 l3"><a class="bg-white" href="'+ value['_source']['urls'][0] +'">'+
                '<i class="material-icons">picture_as_pdf</i></a><br><small>View PDF</small></div>'+            
                '</div><blockquote>'+ value['_source']['description'] +'</blockquote></div>');
       });
    }
});

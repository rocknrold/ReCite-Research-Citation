$(function(){
    if($('#keyword').text() != ""){
        $.ajax({
                type: 'POST',
                url: '/search/library',
                dataType: 'json',
                data: { query: $('#keyword').text()} ,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    console.log(data);
                    // $('#description').html(data['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['definitions'][0]);
                    // $('#synonym').html(data['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['synonyms'][0]['text']);
                    for (let i = 0; i < 9; i++) {
            
                    $('#result-list').append('<div class="divider"></div><div class="section"><div class="row">'+
                                            '<div class="col s12"><h6><strong>'+ data +'<strong></h6></div>'+
                                            '<div class="col s6"><p>Year Published : <i>oia</i><button></button></p></div>'+
                                            '<div class="col s12 m6 l3"><button class="bg-white bg-transparent">'+
                                            '<i class="material-icons">add</i></button><br><small>Add to library</small></div>'+
                                            '<div class="col s12 m6 l3"><button class="bg-white">'+
                                            '<i class="material-icons">picture_as_pdf</i></button><br><small>View PDF</small></div>'+            
                                            '</div><blockquote>This is an where research description is placed.</blockquote></div>');
                    }
                }
        });
    }
});

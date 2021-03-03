$(function(){
    $('body').css({'background-image' : 'none'});

    var globalSearchKeyword = $('#keyword').text();
    var currentPageIdentifier = $('#currentPage').text();
    var titleChecked = $("#titleRequired").checked;
    var documentChecked = $('#documentRequired').checked;
    // var yearFrom  = $('input[id="yearFrom"]').val();
    // var yearTo = $('input[id="yearTo"]').val();

    console.log(titleChecked,documentChecked);
     
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

                    filteredResult(response,titleChecked,documentChecked);                
                }
        });
    };


    // next page 

    $('#searchLibrary-next').on('click', function(e){
        e.preventDefault();

        var page = parseInt($('#currentPage').text()) + 1;
        if(globalSearchKeyword != ""){
            console.log(page);
            console.log('next');
            $.ajax({
                type:'GET',
                url: '/search/'+globalSearchKeyword+'/'+page,
                dataType: 'json',
                data: {query: globalSearchKeyword, 
                    currentPage:page,
                    yearFrom:$('input[id="yearFrom"]').val(),
                    yearTo:$('input[id="yearTo"]').val()
                },
                success:function(response){
                    console.log('next');
                    filteredResult(response,titleChecked,documentChecked);
                    $('#currentPage').html(page);
                }
            });
        } else {
            Materialize.toast('Search first!', 1000);
        }
    });


    // back page 

    $('#searchLibrary-back').on('click', function(e){
        e.preventDefault();

        var page = parseInt($('#currentPage').text()) - 1;

        if(page >= 1 && globalSearchKeyword != ""){
            console.log(page);
            console.log('back');

            $.ajax({
                type:'GET',
                url: '/search/'+globalSearchKeyword+'/'+page,
                dataType: 'json',
                data: {query: globalSearchKeyword, 
                    currentPage:page,
                    yearFrom:$('input[id="yearFrom"]').val(),
                    yearTo:$('input[id="yearTo"]').val()
                },
                success:function(response){
                    console.log('next');
                    filteredResult(response,titleChecked,documentChecked);
                    $('#currentPage').html(page);
                }
            });
        } else {
            Materialize.toast('Either end of result or Search first!', 3000);
        }
    });

    // Chips for filter css

    $('.chip').material_chip();
    
    //Apply search filter for Year

    $('#searchFilter').on('click',function(e){
        e.preventDefault();
        var yearTo = $('input[id="yearTo"]').val();
        var yearFrom = $('input[id="yearFrom"]').val();

        if(yearFrom != "" & yearTo != ""){
            filterByYear(yearFrom,yearTo);
            $('#filters').html("<div class=\"chip\">"+yearFrom +" - "+ yearTo+"</div>");
        }else{ 
            Materialize.toast('Requires a custom year range!', 3000);
        }
    });

    //Apply search filter Title Required

    $('#titleRequired').on('change', function(e) {
        if(this.checked){
            $('#filterstitle').empty();
            $('#filters').empty();
            titleChecked = true;
        }else {
            titleChecked = false;
            $('#filterstitle').html("<div class=\"chip\">Repeated Title</div>");
        }
    });

    //Apply search filter Document URL Required

    $('#documentRequired').on('change', function(e) {
        if(this.checked){
            $('#filtersurl').empty();
            $('#filters').empty();
            documentChecked = true;
        }else {
            documentChecked = false;
            $('#filtersurl').html("<div class=\"chip\">No document</div>");
        }
    });

    //Apply required search filters 
    $('#requiredFilter').on('click',function(e){
        e.preventDefault();
        
        $.ajax({
            type:'GET',
            url: '/search/'+globalSearchKeyword+'/'+currentPageIdentifier,
            dataType:'json',
            data:{
                query:globalSearchKeyword,
                currentPage:currentPageIdentifier,
                yearFrom:$('input[id="yearFrom"]').val(),
                yearTo:$('input[id="yearTo"]').val(),
            },
            success:function(response)
            {
                console.log(response);
                filteredResult(response,titleChecked,documentChecked);
            }
        });
    })

    function filteredResult(response,titleChecked=true,documentChecked=true)
    {
            if(titleChecked == 1 && documentChecked == 1)
            {
                resultTemplate(response);
                console.log('1 true true');
            } else if(titleChecked == 1 && documentChecked == 0)
            {
                titleOnlyChecked(response);
                console.log('2 true false');
            } else if(titleChecked == false && documentChecked == true)
            {
                documentOnlyChecked(response);
                console.log('3 false true')
            } else if(titleChecked == false && documentChecked == false)
            {
                noChecked(response);
                console.log('4 false false');
            }
    }

    function titleOnlyChecked(response)
    {
        $('#result-list').empty();
        var titles = [];

        $.each(response[0].data,function(key, value){
            var authors = "";
            var title = value['_source']['title'];
            
            $.each(value['_source']['authors'], function(key, value){
                authors += value + ',';
            });
            
            if(titles.includes(title.toLowerCase()) === false){
                titles.push(title.toLowerCase());
                layoutResults(authors,title,
                            value['_source']['year'],
                            value['_source']['oai'],
                            value['_source']['urls'][0],
                            value['_source']['description']);
            }
        });
        console.log(titles);
    }

    function documentOnlyChecked(response)
    {
        $('#result-list').empty();

        $.each(response[0].data,function(key, value){
            var authors = "";
            var documentURL = value['_source']['urls'][0];
            
            $.each(value['_source']['authors'], function(key, value){
                authors += value + ',';
            });
            
            if(documentURL != null){
                layoutResults(authors,
                            value['_source']['title'],
                            value['_source']['year'],
                            value['_source']['oai'],
                            documentURL,
                            value['_source']['description']);
            }
        });
    }

    function noChecked(response)
    {
        $('#result-list').empty();

        $.each(response[0].data,function(key, value){
            var authors = "";
            
            $.each(value['_source']['authors'], function(key, value){
                authors += value + ',';
            });
            
                layoutResults(authors,
                            value['_source']['title'],
                            value['_source']['year'],
                            value['_source']['oai'],
                            value['_source']['urls'][0],
                            value['_source']['description']);
        });
    }

    function resultTemplate(response)
    {
        $('#result-list').empty();
        var titles = [];

        $.each(response[0].data,function(key, value){
            var authors = "";
            var documentURL = value['_source']['urls'][0];
            var title = value['_source']['title'];
            
            $.each(value['_source']['authors'], function(key, value){
                authors += value + ',';
            });
            
            if(titles.includes(title.toLowerCase()) === false && documentURL != null){
                titles.push(title.toLowerCase());
                layoutResults(authors,title,
                            value['_source']['year'],
                            value['_source']['oai'],
                            documentURL,
                            value['_source']['description']);
            }
        });
        console.log(titles);
    }

    function layoutResults(authors,title,year,oai,url,description)
    {
        $('#result-list').append('<div class="divider"></div><div class="section"><div class="row">'+
        '<div class="col s12"><h6><strong>Title : '+ title +'</strong></h6></div>'+
        '<div class="col s12"><h6><strong>Author : '+ authors +'</strong></h6></div>'+
        '<div class="col s6"><p>Year Published : '+ year +'</p>'+
        '<i> oai : '+ oai +'</i></div>'+
        '<div class="col s12 m6 l3"><a class="btn bg-transparent" href="/add/library?title='+title+'&year='+year+'&'+
        'oai='+oai+'&url='+url+'&description='+description+'&query='+globalSearchKeyword+'">'+
        '<i class="material-icons">add</i></a><br><small>Add to Library</small></div>'+
            '<div class="col s12 m6 l3"><a class="btn bg-transparent" href="'+ url +'">'+
            '<i class="material-icons">article</i></a><br><small>View Document</small></div>'+            
            '</div><blockquote>'+ description +'</blockquote></div>');  
    }

    $('a').on('click',function(){
        al('im clicked');
    });

    function filterByYear(yearFrom,yearTo)
    {

        if($('#keyword').text() != ""){ 
            $.ajax({
                    type: 'POST',
                    url: '/search/library-year',
                    dataType: 'json',
                    data: { query: globalSearchKeyword, 
                            yearFrom: yearFrom,
                            yearTo: yearTo,
                            currentPage:currentPageIdentifier,
                    } ,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(response){
                        console.log(response);
                        console.log(response[0].data);
                        $('#totalResults').html(response[0].totalHits);
                 
                        filteredResult(response,titleChecked,documentChecked);
                    }
            });
        };
    }
});

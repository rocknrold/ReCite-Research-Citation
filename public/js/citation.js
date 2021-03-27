$(function(){
    $('select').material_select();
    $('body').css({'background-image':'none'});

    // var titles = {};
    var lastkey = 0;

    $.ajax({
      type:'GET',
      url: '/citation/list',
      dataType: 'json',
      success:function(data){
        
        $.each(data, function(key, value){

                // titles[value['title']] = value['doi'];

                var pattern = /^[A-Za-z]+,?\s.?[A-Z]/g;
                var authors = value['author'].split(';');
                var authorMatches = [];

                for (let i = 0; i < authors.length; i++) {
                    if(i == authors.length-1 && authors.length > 1){
                      authorMatches.push(" & " + authors[i].toString().trim().match(pattern));
                    } else {
                      authorMatches.push(authors[i].toString().trim().match(pattern));
                    }
                }

                if(value['year'] == ""){
                  value['year'] = 'n.d';
                }

                if(value['doi'] != ""){
                  value['doi'] = "https://doi.org/"+value['doi']+"";
                }

                var citation =  authorMatches.join('.,')+".("+value['year']+")."+value['title']+".<i>"+value['source_title']+"</i>,"+value['page']+"."+value['doi'];

                $('.citations').append('<div class="row" style="padding:0px;margin:auto;">'+
                '<div class="col s12" ></div><div class="card-panel light-blue lighten-5" style="border-radius:6px;box-shadow:none;border:1px solid #bbdefb">'+
                '<a class="secondary-content copy" style="padding:1px;"  data-id="citation_'+key+'"><i class="material-icons">content_copy</i></a>'+
                '<span class="black-text cite" id="citation_'+key+'">'+ citation +'</span></div></div>');
                
                lastkey = key;
            });
          }
        });
        
      // $('#autocomplete-input').autocomplete({
      //   data: titles,
      //   limit: 20, 
      //   onAutocomplete: function(val) {
      //     console.log(val);
      //   },
      //   minLength: 2,
      // });
      
    $('#citeNow').on('click',function(e){
      e.preventDefault();
      console.log($('#citationSearchCreateBar').val());
      if ( $('#citationSearchCreateBar').val() != "" ){
        $.ajax({
          type:'GET',
          url: 'https://data.crosscite.org/text/x-bibliography/'+$('#citationSearchCreateBar').val()+'?style='+$('#citationStyleLanguage').val()+'',
          success:function(data){
            $('#for04Error').empty();  
            var userLastKey = parseInt(lastkey+ 1);
            $('.userCreatedCitations').prepend('<div class="row" style="padding:0px;margin:auto;">'+
            '<div class="col s12" ></div><div class="card-panel light-blue lighten-5" style="border-radius:6px;box-shadow:none;border:2px solid #3b5998">'+
            '<a class="secondary-content copy" style="padding:1px;"  data-id="citation_'+ userLastKey +'"><i class="material-icons">content_copy</i></a>'+
            '<span class="black-text cite" id="citation_'+ userLastKey +'">'+ data +'</span></div></div>');
          
            $('#clearCreatedCitations').html('<button class="btn red lighten-1" id="clearCitationbtn">clear cited</button>');
            
            lastkey = userLastKey;
          },
          statusCode: {
            404: function() {
              $('#for04Error').html('<div class="col s12"><div class="card-panel red lighten-4" style="border-radius:6px;box-shadow:none;margin:auto;">The resource you are looking for doesn\'t exist</div></div>');
            }
          },
          complete:function(){
            $('#clearCitationbtn').on('click',function(){
              console.log('clicked');
                $('.userCreatedCitations').empty();
                $('#clearCreatedCitations').empty();
            });
          }
        });
      }else {
        Materialize.toast('No search found', 1000);
      }
    });
     
    $('.row').on('click', '.copy', function(e){
        e.preventDefault();
        var copy_id = $(this).data('id');
        copy_input( $('#'+copy_id) );
        Materialize.toast('Copied',800);
    });

    function copy_input(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
  
  });
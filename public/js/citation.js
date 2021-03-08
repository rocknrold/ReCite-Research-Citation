$(function(){
    $('body').css({'background-image':'none'});

    var titles = [];

    $.ajax({
        type:'GET',
        url: '/citation/list',
        dataType: 'json',
        success:function(data){
            $.each(data, function(key, value){

                titles.push({key:key, value: value['title'] });
                console.log(titles);
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
            });
        }
    });

    $('#autocomplete-input').autocomplete({
      data: {titles},
      limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
      onAutocomplete: function(val) {
        console.log(val);
      },
      minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
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
$('h1,h2,h3').each(function(){
    //console.log($(this));

    var text = $(this).html();
    var position = parseInt($(this).position().top)
    
    var html_to_insert = '<div class="decoholder" style="top:'+position+'px">\
         <div class="deco st1">'+text+'</div>\
         <div class="deco st2">'+text+'</div>\
         <div class="deco st3">'+text+'</div>'
    var rightimg = '<img src="'+images.pop()+'">'
    var leftimg = '<img src="'+images.pop()+'">'
    var closingdiv = '</div>'

    $('.left-holder').append(html_to_insert+leftimg+closingdiv);
    $('.right-holder').append(html_to_insert+rightimg+closingdiv);

    $('.left-holder').height(position);
    $('.right-holder').height(position);
    });

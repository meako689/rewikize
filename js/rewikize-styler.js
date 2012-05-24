
$('.search-content').hover(function(){
        $('#search_descr').fadeIn('slow');
    })

$('.footer-container').hover(function(){
        $('#footer-text').fadeIn('slow');
    })

$('.header').mouseenter(function(){
    $('.header form').fadeIn('fast');
    });

$('.header').mouseleave(function(){
    $('.header form').fadeOut('fast');
    });



$('h1,h2,h3').each(function(){

    var text = $(this).html();
    var position = parseInt($(this).position().top)
    
    var html_to_insert = '<div class="decoholder" style="display:none; top:'+position+'px">\
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

var timeout = 0;
function showtimed(el){
    timeout = parseInt(timeout + 900);
    setTimeout(function(){el.fadeIn("slow");}, timeout);
};

$('.left-holder>.decoholder').each(function(index, elem){
    // loop through two simmetrical selectors
    showtimed($(elem));
    showtimed($($('.right-holder>.decoholder')[index])); //crazy

    });

function shuffle(array) {
    var tmp, current, top = array.length;

    if(top) while(--top) {
        current = Math.floor(Math.random() * (top + 1));
        tmp = array[current];
        array[current] = array[top];
        array[top] = tmp;
    }

    return array;
}


function generate_inserts(images, videos){
    images = images.map(function(item) {return '<img src="'+item+'">'});
    videos = videos.map(function(item) {return '<iframe width="99%" height="315px" src="http://www.youtube.com/embed/'+item+'" frameborder="0" allowfullscreen></iframe>'});

    return shuffle(images.concat(videos));
};
//
// to not display "undefined"
function pop_or_none(array){
    item = array.pop();
    if (item) {return item}
    else return "";
    };

var inserts = generate_inserts(images, videos);

function pick_rand_color(){
    if (colors && colors.info){
    return colors.info.colors[ Math.floor ( Math.random() * colors.info.colors.length )]
    }
    else return "000000"
};


$('h1,h2,h3').each(function(){

    var text = $(this).html();
    var position = parseInt($(this).position().top);
    
    var html_to_insert = '<div class="decoholder" style="display:none; color:#'+pick_rand_color()+'; top:'+position+'px">\
         <div class="deco st1">'+text+'</div>\
         <div class="deco st2">'+text+'</div>\
         <div class="deco st3">'+text+'</div>'
    var closingdiv = '</div>'

    $('.left-holder').append(html_to_insert + pop_or_none(inserts) + closingdiv);
    $('.right-holder').append(html_to_insert + pop_or_none(inserts) + closingdiv);

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

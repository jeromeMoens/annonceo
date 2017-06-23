//-------------------------------------
//---- SYSTEME DE NOTATION ETOILE ----

var starrating = new StarRating( document.getElementById( 'star-rating' ));


// Initialisation de la classe javascript

/*$('#note').each(function() {
    $(this).append(objRate.initRate(objRate.maxRate));
});
 
$('.fa-star-o, .fa-star').on('mouseenter mouseleave', objRate.hoverHandler);
$('.fa-star-o, .fa-star').on('click', objRate.clickHandler);


// Classe Javascript rate.class.js

function classRate() {
this.counter = 0;
this.maxRate = 4;
}
 
classRate.prototype.initRate = function(intMax) {
this.counter++;
var str = '<span id="grade-'+this.counter+' class="rate" data-maxgrade="'+intMax+'">';
for (var i=1; i<=intMax; i++) {
        str += '<i class="fa fa-star-o" data-clicked="false" data-id="grade-'+this.counter+'" data-grade="'+i+'"></i>';
}
str += '</span>';
return str;
}
 
classRate.prototype.hoverHandler = function(eventObject) {
        var data_id     = eventObject.target.dataset.id;
        var data_grade  = eventObject.target.dataset.grade;
        var className   = eventObject.target.className;
 
        if (className == 'fa fa-star-o') {
                for (var i=1; i<=data_grade; i++) {
                        $('[data-id="'+data_id+'"][data-grade="'+i+'"]').removeClass('fa-star-o');
                        $('[data-id="'+data_id+'"][data-grade="'+i+'"]').addClass('fa-star');
                }
        } else if (className == 'fa fa-star') {
                for (var i=1; i<=data_grade; i++) {
                        $('[data-id="'+data_id+'"][data-grade="'+i+'"]').removeClass('fa-star');
                        $('[data-id="'+data_id+'"][data-grade="'+i+'"]').addClass('fa-star-o');
                }
        }
 
        return false;
}
classRate.prototype.clickHandler = function(eventObject) {
        var data_id     = eventObject.target.dataset.id;
        var data_grade  = eventObject.target.dataset.grade;
        console.log(data_grade);
 
        $('[data-id="'+data_id+'"]').off('mouseenter mouseleave');
 
        // De 1 à coché : est coché
        for (var i=1; i<=data_grade; i++) {
                console.log('a'+i);
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').removeClass('fa-star-o');
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').addClass('fa-star');
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').attr('data-clicked', "true");
        }
 
        // De coché+1 à maxRate : n'est est coché
        next = parseInt(data_grade)+1;
        for (var i=next; i<=objRate.maxRate; i++) {
                console.log('b'+i);
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').removeClass('fa-star');
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').addClass('fa-star-o');
                $('[data-id="'+data_id+'"][data-grade="'+i+'"]').attr('data-clicked', "false");
        }
 
 
        return false;
}
 
objRate = new classRate();
*/
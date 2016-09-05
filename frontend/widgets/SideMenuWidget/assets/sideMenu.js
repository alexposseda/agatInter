$('.inner-nav').each(function(index){
    var m = $(this).clone();
    m.attr('id', 'inner-nav'+index);
    $(this).prev().attr('data-target', '#inner-nav'+index);
    $(this).remove();
    m.insertAfter('#outer-nav');
    if(m.find('a').hasClass('active')){
        m.addClass('active').parents('#general-nav').addClass('general-nav-offset');
    }
})



$('#general-nav a').click(function(e){
    if(this.hasAttribute('data-target')){
        var self = this;
        e.preventDefault();
        var menu = $($(this).data('target'));
        if(menu.data('isShow')){
            menu.css('left', 0);
            menu.data('isShow', false);
        }else{
            $('.inner-nav').css('left', 0).data('isShow', false);
            menu.css('left', $('#outer-nav').width()+$('#outer-nav').position().left);
            menu.data('isShow', true);
        }

        if(!menu.data('wasShow')){
            setTimeout(function(){
                Materialize.showStaggeredList(menu.find('ul'));
                menu.data('wasShow', true);
            }, 150);
        }
    }
});

$('#menu-but').on('click', function(){
    var menu = $('#outer-nav');
    if(menu.data('isShow')){
        menu.data('isShow', false);
        $('#general-nav').css('left', -menu.width()+$(this).width());
        $('.inner-nav').data('isShow', false).css('left', 0);
        setTimeout(function(){
            $('.inner-nav.active').data('isShow', true).css('left', $('#outer-nav').width()+$('#outer-nav').position().left);
        }, 500);

    }else{
        menu.data('isShow', true);
        $('#general-nav').css('left', 0 + $(this).width());
        if(!menu.data('wasShow')){
            setTimeout(function(){
                Materialize.showStaggeredList(menu.find('ul'));
                menu.data('wasShow', true);
            }, 150);
        }
    }
});
$('.inner-nav.active').data('wasShow', true).data('isShow', true);
$('html').on('click', function(e){
    $('.inner-nav').each(function(){
        if(!$(e.target).parents('#general-nav').length && !$(this).hasClass('active')){
            $(this).css('left', 0);
            $(this).data('isShow', false);
        }
    });

    if($('#general-nav').hasClass('general-nav-offset') && $('#outer-nav').data('isShow') && !$(e.target).parents('#general-nav').length){

        $('#outer-nav').data('isShow', false);
        $('#general-nav').css('left', -$('#outer-nav').width()+$('#menu-but').width());
        $('.inner-nav').data('isShow', false).css('left', 0);
        setTimeout(function(){
            $('.inner-nav.active').data('isShow', true).css('left', $('#outer-nav').width()+$('#outer-nav').position().left);
        }, 500);
    }
});
$(document).ready(function(){
    setTimeout(function(){
        $('#general-nav').css('transition', 'left 0.5s ease');
    }, 500);
});
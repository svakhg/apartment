var opts = {
    lines: 9, 
    length: 3, 
    width: 5, 
    radius: 13, 
    corners: 1, 
    rotate: 34, 
    color: '#000', 
    speed: 1.1, 
    trail: 41, 
    shadow: false, 
    hwaccel: true, 
    className: 'spinner', 
    zIndex: 2e9, 
    top: 'auto', 
    left: 'auto' 
};
$(function(){
    $('#add-srv').live('click', function(){
        $('#fieldset-services').toggleClass('hidden');
        return false;
    })
    $('#rooms-count').val('');
    var filter = $('#left_column_block_filter');
    $('.notice button').live('click', function(){
        $(this).parent().remove();
    });
    filter.find('.rooms-count a').live('click', function(){
        filter.find('.rooms-count').removeClass('active');
        var item = $(this).parent();
        item.addClass('active');
        $('#rooms-count').val(item.attr('data-count'));
        return false;
    });
    $('#filter_button').live('click', function(){
        var rooms = $('#rooms-count').val();
        if (!rooms){
            filter.append('<div class="notice alert" style="position: absolute; left: 221px; display: none;z-index:20">Выберите количество комнат!<button class="note_bt"></button></div>')
            filter.find('.notice').fadeIn();
            return;
        }else{
            filter.find('.notice').remove();
        }
        var from = $('#price-from').val();
        var to = $('#price-to').val();
        $('#left_column_block_filter').spin(opts);
        $.post(
            '/apartments',
            {
                'rooms': rooms,
                'price_from': from,
                'price_to': to
            }, function(data){
                $('#left_column_block_filter').data().spinner.stop();
                $('#center_column').html(data.content);
            }, 'json'
        )
    });
    $('#send-order').click(function(){
        return false;
    });
    viewier.init();
    $('.ajax-form').live('submit', function(){
        var form = $(this);
        var post = form.serialize();
        $('.ajax-form ul.errors').remove();
        $('.ajax-form .error').removeClass('error');
        $('.ajax-form').spin(opts);
        $.post(
            form.attr('action'),
            post,
            function(data){
                $('.ajax-form').data().spinner.stop();
                if (data.status == 'fail'){
                    for (field in data.errors){
                        for (error in data.errors[field]){
                            addError(field,data.errors[field][error] );
                        }
                    }
                }else{
                    $('.ajax-form').parent().html(data.message);
                    $('.ajax-form').remove();
                    setTimeout(function(){$.fancybox.close()}, 3000);
                }
            }, 'json'
        )
        return false;
    })
})
function addError(field, error){
    if ($('#' + field + '-element errors').length == 0){
        $('#' + field + '-element').append('<ul class="errors"></ul>');
        $('#' + field + '-element').addClass('error');
    }
    $('#' + field + '-element ul').html('<li>' + error +  '</li>');
}
var viewier = {
    init: function(){
        bigImg = $('#big_pic img');
        $('.list_pic1:first').addClass('selected');
        $('#g2>div').width($('.list_pic1').length * ($('.list_pic1').width() + 5));
        $('.list_pic1 a').live('click', function(){
            var item = $(this).parent();
            var bigUrl = $(this).attr('data-href');
            viewier.showSelected(bigUrl, item);
            return false;
        })
        $('#left_arrow').live('click', function(){
            viewier.prev();
        })
        $('#right_arrow').live('click', function(){
            viewier.next();
        })
        $('.fancybox').fancybox();
    },
    showSelected: function(url, item){
        $('.list_pic1').removeClass('selected');
        item.addClass('selected');
        bigImg.attr('src', url);
        bigImg.parent().attr('href', item.find('a').attr('href'));
        var items = $('.list_pic1');
        items.each(function(index){
            if ($(this).hasClass('selected')){
                var offset = index - 2;
                if (offset < 0 )
                    offset = 0;
                $('#g2').scrollLeft(offset * 100);
            }
        })
    },
    next: function(){
        var items = $('.list_pic1');
        var current = false;
        var next = null;
        items.each(function(index){
            if (current){
                next = $(this);
                current = false;
            }
            if ($(this).hasClass('selected')){
                current = true;
            }
        })
        if (!next){
            next = $('.list_pic1:first');
        }
        var url = next.find('a').attr('data-href');
        viewier.showSelected(url, next);
    }, 
    prev: function(){
        var items = $('.list_pic1');
        var current = false;
        var prev = null;
        items.each(function(index){
            if ($(this).hasClass('selected')){
                current = true;
            }
            if (current){
                prev = $(this).prev();
                if (index ==0){
                    prev = $('.list_pic1:last');
                } 
                current = false;
            }
        })
        if (!prev){
            prev = $('.list_pic1:last');
        }
        var url = prev.find('a').attr('data-href');
        viewier.showSelected(url, prev);
    },
    bigImg: null
}



function validate ()  {

if ($('#name').val().lenght == 0){
alert('Enter an Name in the field, please');
return false;
}

if ($('#mail').val().lenght == 0){
alert('Error: Your e-mail does not look correct !');
return false;
}

if ($('#arrival').val().lenght == 0){
alert('Enter an arrical date in the field, please');
return false;
}
if ($('#departure').val().lenght == 0){
alert('Enter a departure date in the field, please');
return false;
}
if ($('#keystring').val().lenght == 0){
alert('Enter a Capcha in the field, please');
return false;
}
return true;
}
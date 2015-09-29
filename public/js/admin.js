$(function(){
    $('table#services tbody').sortable({
        update: function(){
            var rows = $('#services tbody tr');
            var array = new Array();
            rows.each(function(index){
                array.push({
                    'id': $(this).attr('data-id'),
                    'position': index
                });
                
            });
            $.post(
                '/admin/services/sort',
                {order: array},
                function(data){
                    
                }, 'json'
            )
        },
        helper: "clone",
        axis: "y"
    });
    
    $('table#apartments tbody').sortable({
        update: function(){
            var rows = $('#apartments tbody tr');
            var array = new Array();
            rows.each(function(index){
                array.push({
                    'id': $(this).attr('data-id'),
                    'position': index
                });
                
            });
            $.post(
                '/admin/apartments/sort',
                {order: array},
                function(data){
                    
                }, 'json'
            )
        },
        helper: "clone",
        axis: "y"
    });
    
    $('#photo-list .image a').click(function(){
        var o = $(this);
        $.get(
            o.attr('href'),
            {}, function(data){
                o.parents('.thumbnail').remove();
            }
        )
        return false;
    })
    $('.remove-apart').click(function(){
        if (confirm('Удалить объявление?')){
            var o = $(this);
            $.get(
                o.attr('href'),
                {}, function(data){
                    o.parents('tr').remove();
                }
            )
        }
        return false;
    })
    $('.remove-srv').click(function(){
        if (confirm('Удалить услугу?')){
            var o = $(this);
            $.get(
                o.attr('href'),
                {}, function(data){
                    o.parents('tr').remove();
                }
            )
        }
        return false;
    })
    $('.remove-rayon').click(function(){
        if (confirm('Удалить район?')){
            var o = $(this);
            $.get(
                o.attr('href'),
                {}, function(data){
                    o.parents('tr').remove();
                }
            )
        }
        return false;
    })
    $('.toggle-apart').click(function(){
        var o = $(this);
        var tr = o.parents('tr');
        $.get(
            o.attr('href'),
            {}, function(data){
                if (data.status == 1){
                    $(tr).removeClass('error').addClass('success');
                    $(o).find('i').removeClass('icon-eye-close').addClass('icon-eye-open');
                    $(o).attr('title', 'Скрыть');
                }else{
                    $(tr).removeClass('success').addClass('error');
                    $(o).find('i').removeClass('icon-eye-open').addClass('icon-eye-close');
                    $(o).attr('title', 'Показать');
                }
            }, 'json'
        )
        return false;
    })
})
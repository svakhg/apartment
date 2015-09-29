$(function() {
    $("a.user_click").fancybox({
        'type': 'ajax',
        "padding" : 20, 
        "imageScale" : false, 
        "zoomOpacity" : false,
        "zoomSpeedIn" : 1000,	
        "zoomSpeedOut" : 1000,	
        "zoomSpeedChange" : 1000, 
        "frameWidth" : 700,	 
        "frameHeight" : 600, 
        "overlayShow" : true,  
        "overlayOpacity" : 0.8,	 
        "hideOnContentClick" :false, 		
        "centerOnScroll" : false, 	
        afterShow: function(){
            $('.calendar').datepicker({dateFormat: 'dd.mm.yy' });
			$('#add_serv').click(function(){ $('#ico_form').show(); return false; });
			$('#add_order').click(function(){ $('#ico_form').hide(); return false; });
            var arr = new Array();
            $('.check input:checked').each(function(index){
                $(this).attr('title');
                arr.push($(this).val());
            })
            $('#service').val(arr);
        }
    });
});
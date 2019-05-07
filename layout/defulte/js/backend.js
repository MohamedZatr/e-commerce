$(function () {
	'use strict';
	//Hode Plaseholder on Form Foucs
	$('[placeholder]').focus(function () {

		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');
	}).blur(function () {
			$(this).attr('placeholder',$(this).attr('data-text')); 
	});
    
    //Add Asterisk on Required Field
    
    
    $('input').each(function (){
        
        if($(this).attr('required') === 'required'){
            
            $(this).after('<span class = "asterisk">*</span>')
        }
        
    });
    
    
    //convert Password Field To Text field
    var passFrild = $('.password');
    $('.show-pass').hover(function(){
        passFrild.attr('type','text');
    },function(){
                passFrild.attr('type','password');
    });
    
    
    // Confirmation Message On Button
    $('.confirm').click(function(){
       
        return confirm('Are You Sure Delete This User?')
    });
    
    // Confirmation Message On Button
    $('.confirm_admin').click(function(){
       
        return confirm('Are You Sure Make This User As Admin?')
    });
    
    // Confirmation Message On Button
    $('.confirm_category').click(function(){
       
        return confirm('Are You Sure Delete This Category')
    });
    //Category View Option
    $('.cat h3').click(function(){
       $(this).next('.full_view').fadeToggle(100); 
    });
    
    $('.option span').click(function(){
       $(this).addClass('active').siblings('span').removeClass('active'); 
        if($(this).data('view') === 'full')
            {
                $('.cat .full_view').fadeIn(100);
            }else{
                $('.cat .full_view').fadeToggle(100);
            }
        
        
    });
    
    // Trigger SelectBoxit 
    $("select").selectBoxIt({
        autoWidth:false
        });
$('.comforim_comment').click(function(){
   return confirm("Are You Sure Delete This Comment ?") ;
});
    //DashBoard
    $('.toggle-info').click(function(){
       $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100); 
        if($(this).hasClass('selected')){
            $(this).html("<i class = 'fa fa-minus fa-lg'></i>");
        }else{
                        $(this).html("<i class = 'fa fa-plus fa-lg'></i>");
        }
    });
});



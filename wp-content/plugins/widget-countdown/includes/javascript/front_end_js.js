function countdown_wpdevart_timer(main_div_id){
	var days_left=parseInt(jQuery('#'+main_div_id+' .days').text());
	var hours_left=parseInt(jQuery('#'+main_div_id+' .hourse').text());;
	var minutes_left=parseInt(jQuery('#'+main_div_id+' .minutes').text());;
	var secondes_left=parseInt(jQuery('#'+main_div_id+' .secondes').text());	
	var all_time=days_left*24*3600+hours_left*3600+minutes_left*60+secondes_left;	
	all_time--;
	days_left=parseInt(all_time/(3600*24));
	hours_left=parseInt((all_time-days_left*3600*24)/(3600));
	minutes_left=parseInt((all_time-days_left*3600*24-hours_left*3600)/(60));
	secondes_left=parseInt((all_time-days_left*3600*24-hours_left*3600-minutes_left*60));
	if((""+days_left+"").length>1)
		jQuery('#'+main_div_id+' .days').html(days_left);
	else
		jQuery('#'+main_div_id+' .days').html('0'+days_left);
	if((""+hours_left+"").length>1)
		jQuery('#'+main_div_id+' .hourse').html(hours_left);
	else
		jQuery('#'+main_div_id+' .hourse').html('0'+hours_left);
	if((""+minutes_left+"").length>1)
		jQuery('#'+main_div_id+' .minutes').html(minutes_left);
	else
		jQuery('#'+main_div_id+' .minutes').html('0'+minutes_left);
	if((""+secondes_left+"").length>1)
		jQuery('#'+main_div_id+' .secondes').html(secondes_left);
	else
		jQuery('#'+main_div_id+' .secondes').html('0'+secondes_left);
	if(days_left<=0 && hours_left<=0 && minutes_left<=0 && secondes_left<=0){
		window.location=document.URL;
	}
}
function wpdevart_countdown_animated_element(animation,element_id){	
		jQuery('#'+element_id).ready(function(e) {	
			if(!jQuery(jQuery('#'+element_id)).hasClass('animated') && wpdevart_countdown_isScrolledIntoView(jQuery('#'+element_id)))	{	
				jQuery(jQuery('#'+element_id)).css('visibility','visible');
				jQuery(jQuery('#'+element_id)).addClass('animated');
				jQuery(jQuery('#'+element_id)).addClass(animation);	
			}
		});		
}
function wpdevart_countdown_isScrolledIntoView(elem)
{
    var $elem = jQuery(elem);
	if($elem.length=0)
		return true;
    var $window = jQuery(window);
    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();
    var elemTop = jQuery(elem).offset().top;
    var elemBottom = elemTop + parseInt(jQuery(elem).css('height'));	
    return ( ( (docViewTop<=elemTop) && (elemTop<=docViewBottom) )  || ( (docViewTop<=elemBottom) && (elemBottom<=docViewBottom) ));
}
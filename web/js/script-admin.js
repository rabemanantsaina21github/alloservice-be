jQuery(document).ready(function($){
	$('#nav-menu>ul>li').mouseover(function(){
		$(this).stop().addClass('is-hover');
	}).mouseout(function(){
		$(this).stop().removeClass('is-hover');
	})
	$('.social').mouseover(function(){
		$(this).stop().addClass('active');
	}).mouseout(function(){
		$(this).stop().removeClass('active');
	})
})
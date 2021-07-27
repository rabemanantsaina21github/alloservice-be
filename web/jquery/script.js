jQuery(function($){'use strict',
    $('[data-close-cookie-alert]').on('click', function()
    {
      $('.alert-cookies').alert('close');
      var date = new Date();
      date.setTime(date.getTime()+(13*30*24*60*60*1000));
      document.cookie = 'cookies_accepted=true;expires='+date.toGMTString()+'; path=/';
    })
    
    $('.searchInput').focus(function()
    {
      var o = $("#form_1");
      o.addClass('css-16x1hcp-container').removeClass('css-gv2r47-container');
      o.find('.css-1vxbu18-control').addClass('css-1ge55od-control').removeClass('css-1vxbu18-control');
      $('.css-1de0cuo-menu').show();
    });
    
    $(document).click(function(){
      var o = $("#form_1");
      o.removeClass('css-16x1hcp-container').addClass('css-gv2r47-container');
      o.find('.css-1ge55od-control').removeClass('css-1ge55od-control').addClass('css-1vxbu18-control');
      $('.css-1de0cuo-menu').hide();
    })
    
    $("#form_1").click(function(e){
      e.stopPropagation();
    }).focus(function(e){
      e.stopPropagation();
    });
    
    $('.researchInput').focus(function()
    {
      var o = $("#form_2");
      o.addClass('css-16x1hcp-container').removeClass('css-gv2r47-container');
      o.find('.css-dw80pb-control').addClass('css-1geijx3-control').removeClass('css-dw80pb-control');
      $('.css-1de0cuo-menu-other').show();
    });
    
    $(document).click(function(){
      var o = $("#form_2");
      o.removeClass('css-16x1hcp-container').addClass('css-gv2r47-container');
      o.find('.css-1geijx3-control').removeClass('css-1geijx3-control').addClass('css-dw80pb-control');
      $('.css-1de0cuo-menu-other').hide();
    })
    
    $("#form_2").click(function(e){
      e.stopPropagation();
    }).focus(function(e){
      e.stopPropagation();
    });
    
    $('#dropdown').click(function(){
      if ($('#dropdown-menu').css('display')=='block') {
        $('#dropdown-menu').hide();
      }else{
        $('#dropdown-menu').show();
      }
    });
    
    $(".footer-city-menu").click(function(){
      if ($('.footer-city-menu-dropdown').css('display')=='block') {
        $('.footer-city-menu-dropdown').hide();
      }else{
        $('.footer-city-menu-dropdown').show();
      }
    });
    
    // dodson 20190712
    $('.btn-show-more').click(function(e){
      e.preventDefault();
      var o = $(this).parent();
      o.addClass('show-more-intro-wrapper--full');
    })
    
    
});
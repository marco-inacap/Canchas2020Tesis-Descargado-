$(document).ready(function() {
    $('.main_banner').owlCarousel({
         loop:true,
         autoplay: true,
         margin:0,
         nav:false,
         center: true,
         lazyLoad:true,
         autoWidth:false,
         responsiveClass:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:1
             },
             1000:{
                 items:1
             }
         }
     });
     $('#city').niceSelect();
 });
 $(document).ready(function() {
     $('.places').owlCarousel({
         loop:true,
         autoplay: true,
         margin:0,
         nav:true,
         center: true,
         lazyLoad:true,
         autoWidth:false,
         responsiveClass:true,
         responsive:{
             0:{
                 items:1
             },
             600:{
                 items:2
             },
             1000:{
                 items:5	
             }
         }
     });
 });
 
 /********** Panel_Dropdown ***********/
 function close_panel_dropdown() {
     $(".panel-dropdown").removeClass("active")
 }
 $(".panel-dropdown a").on("click", function (event) {
     if ($(this).parent().is(".active")) {
         close_panel_dropdown()
     } else {
         close_panel_dropdown();
         $(this).parent().addClass("active")
     };
     event.preventDefault()
 });
 var mouse_is_inside = false;
 $(".panel-dropdown").hover(function () {
     mouse_is_inside = true
 }, function () {
     mouse_is_inside = false
 });
 $("body").mouseup(function () {
     if (!mouse_is_inside) {
         close_panel_dropdown()
     }
 });
 
 
 /********** Quality ***********/

 

 

 
 /********** Side_Menu ***********/
 $(function(){var e=$("body"),i=$(".navbar-collapse");e.append('<div class="side-menu-overlay"></div>');var s=$(".side-menu-overlay");e.append('<div id="side-menu"></div>');var n=$("#side-menu");n.append('Logo <button class="close"><span aria-hidden="true">x</span></button>');var o=n.find(".close");n.append('<div class="contents"></div>');var a=n.find(".contents");function d(){e.removeClass("side-menu-visible"),s.fadeOut(),setTimeout(function(){n.hide(),e.removeClass("overflow-hidden")},400)}i.on("show.bs.collapse",function(i){i.preventDefault();var o=$(this).html();a.html(o),e.addClass("overflow-hidden"),n.show(),setTimeout(function(){e.addClass("side-menu-visible"),s.fadeIn()},50)}),o.on("click",function(e){e.preventDefault(),d()}),s.on("click",function(e){d()}),$(window).resize(function(){!i.is(":visible")&&e.hasClass("side-menu-visible")?(n.show(),s.show()):(n.hide(),s.hide())})});
$(document).ready(function() {
    $(".thumbnail").hover(function(){
        $(this).find(".meta").stop().animate({
            bottom:0
        }, 100);
        }, function(){
        $(this).find(".meta").stop().animate({
            bottom:-30
        }, 100);
    });

    var  img =  $(".thumbnail img,.Related_Posts img");
    img.height(img.width()*0.5);
    $("body").niceScroll();

$(".link-back2top ").hide();
$(window).scroll(function() {
  if ($(this).scrollTop() > 300) {
    $(".link-back2top").fadeIn();
  } else {
    $(".link-back2top").fadeOut();
  }
});
$(".link-back2top a").click(function() {
  $("body,html").animate({
    scrollTop: 0
  },
  800);
  return false;
});


$(".sub-menu").css({
		display: "none"
	});
	$(".nav li").hover(function() {
		$(this).find('ul:first').css({
			display: "none"
		}).filter(":not(:animated)").animate({
			opacity: "show",
			height: "show"
		}, "0")
	}, function() {
		$(this).find('ul:first').animate({
			opacity: "hide",
			height: "hide"
		}, "0")
	});

      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        speed: 1200,
        maxwidth: 940
      });



});

jQuery(document).ready(function($){    
                //链接高光，其实就是一个半透明加一个延时不透明
                $(".line a,.posts h2 a,.postmeta a,.sidebar a").hover(function(){ 
                        if(!$(this).is(":animated")){
                        $(this).animate({opacity:".6" },210).animate({opacity:"1"},180);
                        }
                });
});

$(document).ready(function() { 
$('.posts h2 a').click(function(e){
     e.preventDefault();
    var htm='努力打开中',i=9,
      t=$(this).html(htm).unbind('click');
    (function ct(){
      i<0?(i=9,t.html(htm),ct()):(t[0].innerHTML+='.',i--,setTimeout(ct,200));
    })();
    window.location=this.href;//opera fixed
  });
});
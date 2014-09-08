/*    ________________________________________________ 
     _____/\/\____________/\/\______/\/\/\/\/\_______ 
    _____/\/\__________/\/\/\/\____/\/\____/\/\_____ 
   _____/\/\________/\/\____/\/\__/\/\/\/\/\_______ 
  _____/\/\________/\/\/\/\/\/\__/\/\____/\/\_____
 _____/\/\/\/\/\__/\/\____/\/\__/\/\/\/\/\_______
________________________________________________
          ________________________________________________________________ 
         _____/\/\/\/\/\____/\/\/\/\/\/\__/\/\____/\/\__/\/\/\/\/\/\_____ 
        _____/\/\____/\/\______/\/\______/\/\____/\/\__/\_______________ 
       _____/\/\/\/\/\________/\/\______/\/\____/\/\__/\/\/\/\/\_______ 
      _____/\/\__/\/\________/\/\________/\/\/\/\____/\/\_____________ 
     _____/\/\____/\/\______/\/\__________/\/\______/\/\/\/\/\/\_____ 
    ________________________________________________________________ 
____________ Diseño: Ismael Recio, Redacción: Alberto Fernández / Miriam Hernanz, Realización: César Vallejo / Miguel Campos 
Desarrollo: David Ruiz / Francisco Quintero / Carlos Jiménez Delgado __________________________ */

/*___-_ basic lab toolkit _-________________*/
var labTools = {
  resizeWin: function(){ labTools.resizeFullsizes($('.canvas'), [105, 0, 94, 0]); },
  resizeFullsizes : function($elms, padding){
      //calculate the size for the full size elements
    if (!padding) { verticalPadding = horizontalPadding = 50; padLeft = 0; padTop = 25 } //default padding = 50
    else if (!isNaN(padding)) { 
      verticalPadding = horizontalPadding = padding * 2; padLeft = padTop = padding;
    } else { // supose padding is an array... I know
      verticalPadding = padding[0] + padding[2]; 
      horizontalPadding = padding[1] + padding[3];
      padLeft = padding[3];
      padTop = padding[0];
    }
    var $thewindow = $(window),
      winRealH = $thewindow.height() - verticalPadding/*lab bars */, winRealW =  $thewindow.width() - horizontalPadding,
      winProp = winRealW / winRealH;
    $elms.each(function(){
      var $this = $(this), contentH = 2720, contentW = 4835, contentProp = contentW / contentH;
      if(contentProp > winProp) {
        var canvH = winRealW / contentProp;
        $this.css({'height': canvH, 'width': '100%', 'margin-top': ((winRealH - canvH) / 2) + padTop, 'margin-left': padding[3]});
      } else {
        var canvW = winRealH * contentProp, canvH = canvW / contentProp;
        $this.css({'height': canvH, 'width': canvW, 'margin-left': ((winRealW - canvW) / 2) + padLeft, 'margin-top': padding[0]});
      }
    });
    winProp < 1 ? $('body').addClass('body-vertical') : $('body').removeClass('body-vertical')
  },
  preload: function(){
    var elms = [], callback;
    function _setElm(selector, thiscallback){
      callback = thiscallback;
      $(selector).each(function() {
        if(this.complete == 'undefined' || this.complete) { callback(); return; }
        $(this).bind('load error', function(){ _checkElms() })
        elms.push(this);
      });
      if(!elms.length) callback();
    };
    function _checkElms(){
      for (var i = 0; i < elms.length; i++) {
        if(elms[i].complete) {
          elms[i].splice;
        } else { return };
      };
      callback();
    }
    return {
      addElm: _setElm
    }
  }(),
  toggleFull: function(){
    var $elem = $('body');
    var elem = $elem[0];
    if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement) {

      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
      }
      $('body').addClass('fullscreen-on');
      $('#togglefull').html('');
      labTools.resizeWin();
    } else {
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      }
      $('body').removeClass('fullscreen-on');
      $('#togglefull').html('');
      labTools.resizeWin();

    }

    return false;
  },
  slider1: null
};

  //launch preload for big imaes elements
labTools.preload.addElm('#bg1, #bg2', function(){ 
  $('#preload').hide(); 
});
  // bind reseize events and launch for the 1st time
$(window).bind('orientationchange resize', labTools.resizeWin).trigger("resize");
  // close the popup 
$('#pop-close').click(function(){ $(this).parents('#pop-orientation').fadeOut(400); return false; })

  //if fullscreen available, show button & bind automatic events
if(Modernizr.fullscreen) { 
  $('#togglefull').show().click( labTools.toggleFull );
  $('.panzoom-links').css('right', 80)
  $(document).bind("fullscreenchange webkitfullscreenchange mozfullscreenchange", function(){ 
    if(document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement) return;
    $('body').removeClass('fullscreen-on');
    $('#togglefull').html('');
    labTools.resizeWin();
  });
}

if(Modernizr.touch) { // touch events
  $('svg .butt').bind('touchstart',function(){
    if($('.artifact').hasClass('zooming')) return;
    if($('.artifact').hasClass('ttact')){
      $('.artifact').removeClass('ttact');
      var $this = $(this), 
        $tts = $('#tooltips'), 
        $svg = $this.parents('svg'), 
        id = $(this).attr('id');

      $svg.find('#bgs *').stop(true,true).animate({'opacity': 0}, 200); 
      $tts.find('.tooltips, .tooltip').stop(true,true).fadeOut(400);
      return;
    }
    $('.artifact').addClass('ttact');
    var $this = $(this), 
      $tts = $('#tooltips'), 
      $svg = $this.parents('svg'), 
      id = $(this).attr('id');

    $svg.find('#bgs #' + id + 'bg').stop(true,true).animate({'opacity': 0.6}, 200); 
    $tts.find('.tt-' + id).fadeIn(400);
  });

  $('.tooltip').mousedown(function(){
    $('.artifact').removeClass('ttact');
    if($('.artifact').hasClass('zooming')) return;
    var $this = $tt = $(this), 
      id = $tt.attr('id').substring(3),
      $svg = $('svg'),
      $pups = $('#popups'), 
      $thisPop = $pups.find('.pop-' + id).addClass('act').stop(true,true).css({'display': 'table-cell'}).animate({'opacity': '1'},400); 
    $pups.stop(true,true).css({'display': 'table'}).animate({'opacity': '1'},400);
    $svg.find('#bgs *').stop(true,true).animate({'opacity': 0}, 200); 
    $this.hide();
    if($thisPop.find('.bxslider').length) {
      if(!$thisPop.find('.bx-wrapper').length) {
        $thisPop.find('.bxslider').bxSlider({'pager': false});
      } else {
        //$thisPop.find('.bxslider').bxSlider().destroySlider();
       // $thisPop.find('.bxslider').bxSlider({'pager': false});
      }
    }
  })
} else { //no touch events
    //launch hover & tooltips
  $('svg .butt').hover(
    function(){
      if($('.artifact').hasClass('zooming')) return;

      var $this = $(this), 
        $tts = $('#tooltips'), 
        $svg = $this.parents('svg'), 
        id = $(this).attr('id');

      $svg.find('#bgs #' + id + 'bg').stop(true,true).animate({'opacity': 0.6}, 200); 
      $tts.find('.tt-' + id).fadeIn(400);
    },
    function(){ 
      var $this = $(this), 
        $tts = $('#tooltips'), 
        $svg = $this.parents('svg'), 
        id = $(this).attr('id');

      $svg.find('#bgs #' + id + 'bg').stop(true,true).animate({'opacity': 0}, 200); 
      $tts.find('.tt-' + id).stop(true,true).fadeOut(400);
    }
  );

    //launch popup
  $('svg .butt').click(
    function(){
      if($('.artifact').hasClass('zooming')) return;
      var $this = $(this), 
        $pups = $('#popups'), 
        id = $this.attr('id'),
        $thisPop = $pups.find('.pop-' + id).addClass('act').stop(true,true).css({'display': 'table-cell'}).animate({'opacity': '1'},400); 
      if($thisPop.find('.bxslider').length) {
        if(!$thisPop.find('.bx-wrapper').length) {
          $thisPop.find('.bxslider').bxSlider({'pager': false});
        } else {
          //$thisPop.find('.bxslider').bxSlider().destroySlider();
          //$thisPop.find('.bxslider').bxSlider({'pager': false});
        }
      }
      $pups.stop(true,true).css({'display': 'table'}).animate({'opacity': '1'},400);
    }
  );
}

  //close popup
$('.pop-close').click(function(){
  var $this = $(this);
  $this.parents('.popup.act').removeClass('act').stop(true,true).animate({'opacity': '0'},400, function(){ $(this).css('display', 'none'); });
  $this.parents('#popups').stop(true,true).animate({'opacity': '0'},400, function(){ $(this).css('display', 'none'); });
  var vid = $this.parents('.popup').find('video')[0];
  if(vid) vid.pause();
  return false;
});
$('.popup').click(function(e){
  var $this = $(this);
  if(e.target != this) return;
  var vid = $this.find('video')[0];
  if(vid) vid.pause();
  $this.removeClass('act').stop(true,true).animate({'opacity': '0'},400, function(){ $(this).css('display', 'none'); });
  $this.parents('#popups').stop(true,true).animate({'opacity': '0'},400, function(){ $(this).css('display', 'none'); });
}); 
  //close popup with keyboard
$(document).keyup(function(e) {
  if (e.keyCode == 27) { // escape key
    $('.popup.act').click();
  }
});

  //show help regions
$('a.help').hover(function(){
  if($('.artifact').hasClass('zooming')) return;
  $('svg .butt, svg .butt path').stop(true,true).css({ stroke: 'white', 'stroke-width': '5px', 'fill': 'rgba(0,0,0,0.8)'}, 400);
}, function(){
  $('svg .butt, svg .butt path').stop(true,true).css({ stroke: 'white', 'stroke-width': '0', 'fill': 'none'}, 400);
})
  //switch between the tv image and the other
$('#toggle-cuadro').click(function() { 
  var $this = $(this);
  $('#bg1, #bg2, .panzoom-links').fadeToggle(800);
  $('.panzoom-links, .panzoom-links .act').removeClass('act');
  $('.artifact').removeClass('zooming');
  $this.toggleClass('dcha');
  $('.artifact').panzoom('reset');
  if($this.hasClass('dcha')) {
    $this.find('span.act').removeClass('act');
    $this.find('span:eq(1)').addClass('act');

  } else {
    $this.find('span.act').removeClass('act');
    $this.find('span:eq(0)').addClass('act');
    
  }
  return false;
})

  //switch between zoom and no zoom
$('#panzoom').click(function() { 
  var $this = $(this);
  if ($this.parent().hasClass('act')) {
    $this.html('');
    $('.artifact').removeClass('zooming').css('cursor', 'initial').panzoom('reset');
    $this.parent().removeClass('act');
    $('a.help').show();
  } else {
    $this.html('');
    $('.artifact').addClass('zooming').panzoom({contain: 'invert'});
    $('.artifact').panzoom("zoom", 2, { animate: true, increment: 0.5, minScale: 0.1, maxScale: 1 });
    $('#panzoom2').addClass('act');
    $this.parent().addClass('act');
    $('a.help').hide();
  }
  return false;
});

  //go to a zoom point
$('.panzoom-more a').click(function(){

  var $this = $(this), 
    zoom = $this.attr('id').substring(7);

  $('.panzoom-more a.act').removeClass('act');
  $('.artifact').panzoom("zoom", parseInt(zoom), { animate: true, noSetRange: true });

  $this.addClass('act');
  return false;
})

  //especial popup
$('#pop-intro').click(function(){

  var $this = $(this), 
    $pups = $('#popups'),
    $thisPop = $pups.find('.pop-intro').addClass('act').stop(true,true).css({'display': 'table-cell'}).animate({'opacity': '1'},400); 

  $pups.stop(true,true).css({'display': 'table'}).animate({'opacity': '1'},400);
})

$('#introVideo').bind('ended', function(){
  $('#videowrap').hide();
  $('#videowrap video')[0].pause();
  $('#cuadrowrap').fadeIn(400);
})

$('#closevideo').bind('click', function(){
  $('#videowrap').hide();
  $('#videowrap video')[0].pause();
  $('#cuadrowrap').fadeIn(400);
  return false;
})
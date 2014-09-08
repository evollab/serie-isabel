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
Desarrollo: David Ruiz / Francisco Quintero / Carlos Jiménez Delgado @2013__________________________ */

// Variables
// -----------------------------------------------------------------------------------





var labTools = {};

/* 
  Estructura del objeto labTools
  
  data:                               // Almacenamiento general
  fns:                                // Funciones
    callbacks:                        // Callbacks para los saltos entre slides
    console:                          // Funciones relacionadas con la consola (trazas)
    keyboard:                         // Funciones relacionadas con la navegación a través del teclado
    menu:                             // Funciones relacionadas con la navegación a través del menu
    mmedia:                           // Control de archivos multimedia (audio/video)
    mouse:                            // Funciones relacionadas con la navegación a través del raton
    preload:                          // Funciones relacionadas carga de videos
    slide:                            // Todo lo relacionado con la navegación entre slides => pasos => multipasos
    slidetool:                        // Extras
    url:                              // Funciones relacionadas con el tratamiento de las url
    utils:                            // Otras funciones
    svg:                              // pues eso, svgs
*/

// Datos de la aplicacion
labTools.data = { // general page data
  baseUlr: '/serie-isabel/conquista-de-granada',      // url base del proyecto
  SCROLLMOV: 5,                                       // numero de scrolls para que haga efecto
  mousewheel: 0,                                      // numero de scrolls que llevamos
  slideActiveID: '',                                  // ID del Slide Activo
  pasoSlideActiveID: '',                              // ID del paso del Slide Activo
  activeBando: 0,                                     // 0-> cristiano, 1-> nazari 
  bandosArray: ['isabel','boabdil'],                  // urls que usaremos en función de quién esté activado
  log: false,                                          // Activa / Desactiva las trazas
  initialPopstate: 0,
  mySwiper: [],                                       // Extras
  slidetimeoutUp: '',                                 // timeout para quitar el efecto del scroll
  slidetimeoutDown: '',                               // timeout para quitar el efecto del scroll
  slidetimeoutBlock: false,                           // bloquea 1 segundo el movimiento del slide para no irte hasta el final de golpe
  stylesheet: '',                                     // hoja de estilo generada dinámicamente
  multiPasoTime: 500                                  // tiempo de activación entre multipasos
};

// Funciones
labTools.fns = {
  // Funcion relacionadas con la consola
  console: {
    // Funcion que muestra por la consola el log de errores/traza
    log: function(texto){
        if (console && console.log && labTools.data.log) console.log.apply(console, arguments);
    }
  },
  // Funciones de callbacks, es decir, funciones que son llamadas al finalizar la ejecucion de otra funcion
  callbacks: { // funciones que se llamarán al aparecer o desaparecer un PASO
    paso0vidIn: function($paso){  // callback IN para el primer paso del inicio
      
      labTools.fns.console.log('start paso0vidIn');

      var $videoWrap = $paso.find('.video-wrap');
      var $video = $videoWrap.find('video');
      var video = $video[0];
      var $article = $paso.parents('article').first();

      if(!$article.hasClass('article-ready')) {

        $article.addClass('article-ready');

        var $newVideo = labTools.fns.mmedia.generavideo($videoWrap, function(){ // callback previo

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeIn(400);
          } else {
            $('#preload3').stop(true,true).fadeIn(400);
          }

        }, function(){ // callback videook

          labTools.fns.console.log('video cargado');

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeOut(400);
          } else {
            $('#preload3').stop(true,true).fadeOut(400);
          }

          $(this).unbind('canplaythrough canplay stalled error abort');

          labTools.fns.callbacks.paso0vidIn($paso);

        }, function(e){  // callback error
          labTools.fns.console.log('error video: ', e);

          $(this).unbind('canplaythrough canplay stalled error abort');

          setTimeout(function(){
            var $vid = $(this).parents('.video-wrap');
            $vid.removeClass('video-ready'); // elimina el video
            $vid.delete();
            $article.removeClass('article-ready');
            labTools.fns.callbacks.paso0vidIn($paso); // reinicia el proceso 
          },300)

        });
      } else {

        labTools.fns.mmedia.stopMediaReproduction();

        $video.fadeIn(400);

        $video.data('timeo', setTimeout(function(){

          labTools.fns.mmedia.play(video);
          $video.data('timeo', '');
        }, 500));

        $video.delay(36000).fadeOut(2200, function(){
          labTools.fns.slide.slideGoNext();
        });

      }


    },
    paso0vidOut: function($paso){   // callback OUT para el primer paso del inicio
      
      labTools.fns.console.log('start paso11Out');
      
      var $video = $paso.find('video');
      var video = $video[0];

      labTools.fns.mmedia.stopMediaReproduction();

      $video.stop(true, true);
      
      if($video.data('timeo')) clearTimeout($video.data('timeo'));
      
      $video.hide();
      $video.data('timeo', '');
    },
    paso11In: function($paso){  // callback IN para todos las batallas
      
      labTools.fns.console.log('start paso11In');

      var $videoWrap = $paso.find('.paso-video .video-wrap');
      var $video = $videoWrap.find('video');
      var $article = $paso.parents('article');
      
      if(!$article.hasClass('article-ready')) {

        //procesa los audios
        $article.find('.paso-audio:not(.audio-ready)').each(function(){
          labTools.fns.mmedia.generaaudio($(this));
        });

        $article.addClass('article-ready');

        var $newVideo = labTools.fns.mmedia.generavideo($videoWrap, function(){ // callback previo

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeIn(400);
          } else {
            $('#preload3').stop(true,true).fadeIn(400);
          }

          $(this).unbind('canplaythrough canplay stalled error abort');

        }, function(){ // callback videook

          labTools.fns.console.log('video cargado');

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeOut(400);
          } else {
            $('#preload3').stop(true,true).fadeOut(400);
          }

          labTools.fns.callbacks.paso11In($paso); // reinicia el proceso

        }, function(e){  // callback error

          labTools.fns.console.log('error video: ', e);

          $(this).unbind('canplaythrough canplay stalled error abort');

          var $vid = $(this).parents('.video-wrap');
          $vid.removeClass('video-ready').html(''); // elimina el video
          $article.removeClass('article-ready');

          setTimeout(function(){
            labTools.fns.callbacks.paso11In($paso); // reinicia el proceso

          }, 300)
        });

      } else {

        labTools.fns.mmedia.stopMediaReproduction();

        var $audio = $paso.find('.paso-audio audio:eq('+labTools.data.activeBando+')');
        var audio = $audio[0]; // selecciona el audio apropiado

        var video = $video[0];

        //tiempo de duracion del video
        var duracion = $paso.data('duracion');
        if(!duracion) duracion = 18200;

        $paso.find('.paso-title').delay(400).fadeIn(800);
        $audio.data('timeo', setTimeout(function(){
          labTools.fns.mmedia.fadeIn(audio, 1200);
          $audio.data('timeo', '');
        }, 3200));
        
        $paso.find('.paso-video').delay(800).fadeIn(3200);

        $paso.find('.paso-title').data('timeo', setTimeout(function(){
          $paso.find('.paso-title').fadeOut(800);
          $paso.find('.paso-title').data('timeo', '');
        }, 3200));
        
        $video.data('timeo', setTimeout(function(){
          labTools.fns.mmedia.play(video);
          $video.data('timeo', '');
        }, 3200));
        
        $paso.find('.paso-video').delay(duracion).fadeOut(2200, function(){
          labTools.fns.slide.slideGoNext();
        });

      }

    },
    paso11Out: function($paso){ 
      
      labTools.fns.console.log('start paso11Out');
      
      var $audio = $paso.find('.paso-audio audio:eq('+labTools.data.activeBando+')');
      var audio = $audio[0]; // selecciona el audio apropiado
      var $videoWrap = $paso.find('.paso-video .video-wrap');
      var $video = $videoWrap.find('video');
      var video = $video[0];
      
      labTools.fns.mmedia.stopMediaReproduction();
      
      if($video.data('timeo')) clearTimeout($video.data('timeo'));
      if($audio.data('timeo')) clearTimeout($audio.data('timeo'));
      if($paso.find('.paso-title').data('timeo')) clearTimeout($paso.find('.paso-title').data('timeo'));
      
      $paso.find('.paso-video').stop(true, true).hide();
      $video.data('timeo', '');
      $audio.data('timeo', '');
      $paso.find('.paso-title').data('timeo', '');
      $paso.find('.paso-title').hide();
      
    },
    videoIntroExtraIN: function ($paso) { // callback para los extras

      labTools.fns.console.log('start videoIntroExtraIN: ',$paso);
      
      // Ocultamos la X
      var $slide = $(labTools.data.slideActiveID);
      var $close = $('.arrow-close', $slide);

      $close.addClass('hidden');
      
      var $videoWrap = $paso.find('.video-wrap');
      var $video = $videoWrap.find('video');
      var video = $video[0];
      var $article = $paso.parents('article').first();

      if(!$article.hasClass('article-ready')) {

        $article.addClass('article-ready');

        var $newVideo = labTools.fns.mmedia.generavideo($videoWrap, function(){ // callback previo

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeIn(400);
          } else {
            $('#preload3').stop(true,true).fadeIn(400);
          }

        }, function(){ // callback videook
          
          labTools.fns.console.log('video cargado');

          if(!Modernizr.touch) {
            $('#preload2').stop(true,true).fadeOut(400);
          } else {
            $('#preload3').stop(true,true).fadeOut(400);
          }

          $(this).unbind('canplaythrough canplay stalled error abort');

          labTools.fns.callbacks.videoIntroExtraIN($paso);
        }, function(e){  // callback error

          labTools.fns.console.log('error video: ', e);

          $(this).unbind('canplaythrough canplay stalled error abort');
          
          setTimeout(function(){
            var $vid = $(this).parents('.video-wrap');
            $vid.removeClass('video-ready').html(''); // elimina el video
            $article.removeClass('article-ready');
            labTools.fns.callbacks.videoIntroExtraIN($paso); // reinicia el proceso
          }, 300);
        });

 		/*
        setTimeout(function(){
            // buscamos otros videos en la seccion
          $article.find('.video-wrap:not(.video-ready)').each(function(){
            labTools.fns.mmedia.generavideo($(this));
          });
        },300);
		*/

      } else { // el paso ya existe, solo le damos al play

        labTools.fns.mmedia.stopMediaReproduction();

        $video.bind('ended', function () {

          $video.fadeOut(2200, function() {
            labTools.fns.slide.slideGoNext();
          });

          $video.unbind('ended');
        });

        $video.fadeIn(400);

          // tras el fade, comienza a reproducir
        $video.data('timeo', setTimeout(function(){
          labTools.fns.mmedia.play(video);
          $video.data('timeo', '');

        }, 500));

      }

    },
    videoIntroExtraOUT: function ($paso) {
      
      labTools.fns.console.log('start videoIntroExtraOUT');

      // Mostramos la X
      var $slide = $(labTools.data.slideActiveID);
      var $close = $('.arrow-close', $slide);

      $close.removeClass('hidden');

      var $video = $paso.find('video');
      var video = $video[0];
      
      $video.unbind('canplaythrough canplay error');

      labTools.fns.mmedia.stopMediaReproduction();

      $video.stop(true, true);
      
      if($video.data('timeo')) clearTimeout($video.data('timeo'));
      
      $video.hide();
      $video.data('timeo', '');
    }
  },
  // Funciones relacionadas con la pulsacion de una tecla
  keyboard: {
    // Funcion que captura el evento de pulsacion de una tecla y gestiona el comportamiento de la aplicacion
    
    // + Si se pulsan las teclas:
    //        33      Page Up
    //        37      Left arrow
    //        38      Up arrow    
    // Iremos al Slide previo

    // + Si se pulsan las teclas:
    //        32      Space
    //        34      Page Down
    //        39      Right arrow
    //        40      Down arrow    
    // Iremos al Slide siguiente

    // + Si se pulsa la tecla:
    //        35      End
    // Iremos al último Slide

    // + Si se pulsa la tecla:
    //        36      Home       
    // Iremos al primer Slide    
    keyboardEvent: function(tecla) {

      //labTools.fns.console.log("tecla.keyCode: " + tecla.keyCode)

      // Space: 32    
      // Re Pag: 33
      // Av Pag: 34
      // Fin: 35
      // Inicio: 36    
      // Tecla <-: 37
      // Tecla |: 38    
      // Tecla ->: 39
      // Escape: 27

      if ( tecla.keyCode == 37 || tecla.keyCode == 33 || tecla.keyCode == 38 ) {
        
        labTools.fns.slide.slideGoPrevius();

      } else if ( tecla.keyCode == 39 || tecla.keyCode == 34 || tecla.keyCode == 32 || tecla.keyCode == 40 ) {
        
        labTools.fns.slide.slideGoNext();

      } else if ( tecla.keyCode == 35 ) {

        labTools.fns.menu.clickMenu($('.batalla').last().attr('id'));

      } else if ( tecla.keyCode == 36 ) {

        labTools.fns.menu.clickMenu($('.batalla:eq(0)').attr('id'));

      } else if ( tecla.keyCode == 27 ) {

        if($('#help2').css('display') == 'block') {
          $('#help2').fadeToggle(400);
          return;
        }

        if($(labTools.data.slideActiveID).hasClass('extra')) {
          labTools.fns.slide.slideGoPrevius();
        }
      }

    }
  },
  // Funciones relacionadas con el movimiento del raton  
  mouse: {
    // Funcion que reconoce el movimiento de la rueda del raton y lanza la ejecucion de las funciones para ir al Slide previo o siguiente
    mousewheel: function(event, delta, deltaX, deltaY) { // mousewheel library function

        // Comprobamos la variable deltaY (unicamente el movimiendo en el eje Y) 
        // para saber si hay un movimiento hacia arriba o abajo de la rueda dle ratón
        
        if (deltaY > 0) {
          
            // UP
            if(labTools.data.mousewheel< 0) labTools.data.mousewheel = 0;

            labTools.data.mousewheel = labTools.data.mousewheel + 1;

            if ( labTools.data.mousewheel >= labTools.data.SCROLLMOV ) {
              
                // comprobamos si está bloqueado el slide
              if(labTools.data.slidetimeoutBlock){
                labTools.data.mousewheel = labTools.data.SCROLLMOV - 1;
                return;
              }
                // bloque el slide y programa el desbloqueo
              labTools.data.slidetimeoutBlock = true;
              setTimeout(function(){ labTools.data.slidetimeoutBlock = false; }, 1500);

              // Reiniciamos el contador
              labTools.data.mousewheel = 0;

              // Vamos al Slide Previo
              labTools.fns.slide.slideGoPrevius();
            } else {

              // Desplazamos la capa hacia arriba
              labTools.fns.mouse.upSlide();
            }

        } else if (deltaY < 0) {

            // DOWN
            if(labTools.data.mousewheel> 0) labTools.data.mousewheel = 0;

            labTools.data.mousewheel = labTools.data.mousewheel - 1;

            if ( labTools.data.mousewheel <= -labTools.data.SCROLLMOV ) {
              
                // comprobamos si está bloqueado el slide
              if(labTools.data.slidetimeoutBlock){
                labTools.data.mousewheel = - labTools.data.SCROLLMOV + 1;
                return;
              }
                // bloque el slide y programa el desbloqueo
              labTools.data.slidetimeoutBlock = true;
              setTimeout(function(){ labTools.data.slidetimeoutBlock = false; }, 1500);

              // Reiniciamos el contador
              labTools.data.mousewheel = 0;

              // Vamos al Slide Siguiente
              labTools.fns.slide.slideGoNext();

            } else {

              // Desplazamos la capa hacia abajo
              labTools.fns.mouse.downSlide();
            }
        }

        event.stopPropagation();
        event.preventDefault();
    },
    // Funcion que crea el efecto visual de movimiento hacia arriba con el raton
    upSlide: function() { // hace el efecto de que se intenta escrolear arriba

    },
    // Funcion que crea el efecto visual de movimiento hacia abajo con el raton  
    downSlide: function() { // hace el efecto de que se intenta escrolear abajo
    },
  },
  // Funciones relacionadas con la reproduccion de archivos multimedia
  mmedia: {
    videosDestroy: function(){
      $('.video-ready').each(function(){
        labTools.fns.console.log('delete video')
        $(this).find('video').remove();
        $(this).removeClass('video-ready');
      })
    },
    stopMediaReproduction: function(){

      $videos = $('video');
      $audio = $('audio');

      for (index = 0; index < $videos.length; ++index) {
        
        var video = $videos[index];

        try  {
          if(video){
            $(video).unbind('canplaythrough canplay stalled error abort ended');
            video.currentTime = 0;
            video.pause();
          }
        } catch(err) {

          labTools.fns.console.log('error pausando');

        }

      }

      for (index = 0; index < $audio.length; ++index) {
        var audio = $audio[index];
        
        try  {
          if(audio){
            audio.currentTime = 0;
            audio.pause();
          }

        } catch(err) {

          labTools.fns.console.log('error pausando');

        }

      }

    },
    play: function(media) {
      // Para la reproduccion de cualquier medio

      try  {

        media.currentTime = 0;
        media.play();

      } catch(err) {

        labTools.fns.console.log('error reproducciendo');

      }

    },
    generavideo: function($videoWrap, callbackPrevio, callbackOk, callbackKo){

      labTools.fns.console.log('generaVid: ',$videoWrap);

      if(callbackPrevio) callbackPrevio();

      if($videoWrap.hasClass('video-ready') || $videoWrap.find('video').length) return false;

      var videosPath = 'http://video.lab.rtve.es/resources/TE_NGVA/mp4/2013/granada/';
      var ext = Modernizr.video.webm ? '.webm' : Modernizr.video.ogg ? '.ogv' : '.mp4';
      var $newVideo = $('<video autobuffer class="introVideo" webkit-playsinline=""/>');

      if(callbackKo) $newVideo.bind('stalled error', callbackKo);
      if(callbackOk) $newVideo.bind('canplaythrough loadeddata canplay', callbackOk);

      $videoWrap.append($newVideo);

      var $newVideo = $videoWrap.find('video');

      $newVideo.attr('src',videosPath + $videoWrap.data('filename') + ext)

      var $vid = $videoWrap.find('video');

      var hasControl = false;
      var hasAutoPlay = false;

      if ( $videoWrap.attr('data-controls') === "true" )
      	hasControl = true;

      if ( $videoWrap.attr('data-autoplay') === "true" )
      	hasAutoPlay = true;


      if(Modernizr.touch || hasControl) $vid.attr('controls', 'controls');
      if(hasAutoPlay) $vid.attr('autoplay', 'autoplay');



      $videoWrap.addClass('video-ready');

      //$videoWrap.find('video').load();

      return $videoWrap;
    },
    generaaudio: function($audioWrap){

      labTools.fns.console.log('generaAud: ',$audioWrap);

      if($audioWrap.hasClass('audio-ready') || $audioWrap.find('audio').length) return false;

      var audiosPath = 'http://video.lab.rtve.es/resources/TE_NGVA/mp3/2013/granada/';
      var ext = Modernizr.audio.ogg ? '.ogg' : '.mp3';
      var audioBando = ['-isabel', '-boabdil'];
      
      for (var j = 0; j < audioBando.length; j++) {
        var $newaudio = $('<audio class="audio'+audioBando[j]+'"></audio>');

        $newaudio.attr('src', audiosPath + $audioWrap.data('filename') + audioBando[j] + ext);

        $audioWrap.append($newaudio);
      };

      $audioWrap.addClass('audio-ready');

      return($audioWrap);
    },
    fadeIn: function(media, time) { // comienza a reproducir un media con volumen 0 y aumenta 
        labTools.fns.console.log('fadeIn');
      if(!media || !media.paused) return; // evita cambiar el sonido si ya esta en play
      media.volume = 0; 
      labTools.fns.mmedia.play(media);
      var pasos = 20;
      var salto = 1 / pasos;
      var fadeInLoop = function(){
        if(media.volume > (1-salto)) {
          media.volume = 1;
        } else {
          media.volume += salto;
          setTimeout(fadeInLoop, time / pasos);
        }
      };
      fadeInLoop(media, salto);
    },
  },
  // Funciones relacionadas con el tratamiento de la URL que aparece en el navegador
  url: { // tool relater to url management
    initiate: function() { // bind the browser url changes and check initial url
      $(window).bind("popstate", labTools.fns.url.changePopstate);
      setTimeout(function(){ if(!labTools.data.initialPopstate) labTools.fns.url.changePopstate(); }, 100);
    },
    changePopstate: function() { // act when the url changes manually
      // don't use the callback data
      labTools.data.initialPopstate = true;
      var finalUrl = location.pathname.substr(labTools.data.baseUlr.length); 

      labTools.fns.console.log('popstate: ', finalUrl);

      // remove end line /
      if(finalUrl[finalUrl.length-1] == '/') finalUrl = finalUrl.substr(0,finalUrl.length-1);

      var finalId = labTools.fns.url.getSlideIDFromPath(finalUrl); // search the seo file
      
      labTools.fns.menu.clickMenu('#'+finalId);

      setTimeout(function(){$('body').addClass('animation-ready');},0);
        // once the page is initiated allow the slides to be animated

      labTools.fns.url.updateSocials();
    },
    updateSocials: function(){
      var finalUrl = location.pathname.substr(labTools.data.baseUlr.length); 
      // remove end line /
      if(finalUrl[finalUrl.length-1] == '/') finalUrl = finalUrl.substr(0,finalUrl.length-1);
      var slide = labTools.fns.url.getSlideDataFromPath(finalUrl);
      var fullUrl = location.host + location.pathname;
      var twHref = "https://twitter.com/intent/tweet?button_hashtag=lab_rtvees&via=lab_rtvees&text="+slide.title+', '+ fullUrl;
      var fbHref = "http://www.facebook.com/sharer.php?u=http://" + fullUrl;
      $('#menu-tw').data('url', fullUrl).attr('href', twHref);
      $('#menu-fb').data('url', finalUrl).attr('href', fbHref);
    },
    setUrl: function(url) { // changes manually the url
      labTools.fns.console.log('push ', url);
      if(url != '/'){
        if(history.pushState) history.pushState(null, null, labTools.data.baseUlr + url);
      }
      try{_gaq.push(['_trackPageview', labTools.data.baseUlr + url]);}
      catch(e){}
      labTools.fns.console.log('_trackPageview: ', labTools.data.baseUlr + url)
      labTools.fns.url.changePopstate();
    },
    getPathFromSlideId: function(id) {  // find in the seo data (conqData) a slide with the given path
      if(!id || !conqData) return '';
      if(id[0] == '#') id = id.substr(1); // remove # in the id if there is one
      for (var i = conqData.data.slides.length - 1; i >= 0; i--) {
        if(conqData.data.slides[i].id == id) return conqData.data.slides[i].url;
      }
      return '';
    },
    getSlideIDFromPath: function(path) { // find in the seo data (conqData) a slide with the given ID
      if(!conqData) return;
      for (var i = conqData.data.slides.length - 1; i >= 0; i--) {
        if(conqData.data.slides[i].url == path) return conqData.data.slides[i].id;
      }
      return false;
    },
    getSlideDataFromPath: function(path) { // find in the seo data (conqData) a slide with the given ID
  
      if(!conqData) return;
      
      for (var i = conqData.data.slides.length - 1; i >= 0; i--) {
        if(conqData.data.slides[i].url == path) return conqData.data.slides[i];
      }

      return false;
    }    
  },
  // Funciones relacionadas con el funcionamiento de las acciones del menu
  menu: {
    setMenu: function(id){ // activa el menu correspondiente al slide con el id pasado
      $('.menu-anyos a.act, .menu-batallas a.act').removeClass('act');
      $('.menu-main [data-nav="'+id.substr(1)+'"]').addClass('act');
    },
    setActiveBando: function(bando){ // change de bando
      labTools.fns.console.log('bandoactivo: ',labTools.data.activeBando,'bando: ', bando, $('.container'));

      if (labTools.data.activeBando == bando) return;

      labTools.data.activeBando = bando;
      if(labTools.data.activeBando){
        $('.container').addClass('cont-arab');
        if ( !$('.container').hasClass('extra') ){
          $paso = $('#'+labTools.data.pasoSlideActiveID);
          if($paso.data('callbackin')) {
            labTools.fns.callbacks[$paso.data('callbackout')]($paso);
            labTools.fns.callbacks[$paso.data('callbackin')]($paso);
          }
        }
      } else {
        $('.container').removeClass('cont-arab');
        if ( !$('.container').hasClass('extra') ){
          $paso = $('#'+labTools.data.pasoSlideActiveID);
          if($paso.data('callbackin')) {
            labTools.fns.callbacks[$paso.data('callbackout')]($paso);
            labTools.fns.callbacks[$paso.data('callbackin')]($paso);
          }
        }
      }

      $('.menu-bando a').removeClass('act').eq(labTools.data.activeBando).addClass('act');
    },
    // Funcion que muestra un Slide que nos pasan por parametro
    // Se usa para la navegacion a traves de los menus
    clickMenu: function(slideID) { //va directamente a un slide
      
      labTools.fns.console.log('clickMenu',slideID);

      // Obtenemos el slideID previo
      var previusSlideID  = labTools.data.slideActiveID;

      // Actualizamos el ID
      labTools.data.slideActiveID = slideID;

      // Obtenemos el elemento
      var $slide = $(slideID);
      var $previusSlide = $(previusSlideID);

      // Comprobamos que el elemento sobre el que debemos actuar sea distinto al que estamos
      if ( slideID === previusSlideID )
        return false;

      // Comprobamos que la capa no este vacia
      if ( typeof $previusSlide != 'undefined' && previusSlideID !== "") {

        // Ocultamos el Slide previo
        labTools.fns.slide.hideSlide(previusSlideID);

        // Efecto de fundido
        labTools.fns.slide.showSlide(slideID);

      } else {

        // Efecto de fundido
        labTools.fns.slide.showSlide(slideID);
            
      }
    }   
  },
  slide: { // slide functionailit
    hideSlide: function(slideID) { // oculta un slide
        labTools.fns.console.log('hideSlide',slideID);
      var $slide = $(slideID);
      $slide.addClass('hidden');
      
      var actPaso = labTools.fns.slide.hasPasoActivo(slideID);
      if ( actPaso !== false ) {
          //oculta el paso
        labTools.fns.slide.hidePaso(slideID, actPaso);
      }
    },
    showSlide: function(slideID) { // muestra un slide
      
      labTools.fns.console.log('showSlide',slideID);
      
      var $slide = $(slideID);
      
      labTools.fns.slide.applyEfectCSS(slideID);
      labTools.data.slideActiveID = slideID;


      // Comprobamos si el Slide es un extra y en ese caso añadimos una clase al body

      if ( $slide.hasClass('extra') )
        $('body').addClass('es-extra');
      else 
        $('body').removeClass('es-extra');

      
      if ( labTools.fns.slide.hasPasosSlide(slideID) ) {
        // si no hay paso activo, activa el primero, sino, nos aseguramos que está guardado

        if( labTools.fns.slide.hasPasoActivo(slideID) === false ) {
          labTools.fns.slide.showPaso(slideID, 0);
        }
      } else {

        // Comprobamos si el Slide tiene un video en el paso 1
        var $pasoVideo = $slide.find('.video-wrap');

        if ( $pasoVideo.parents('.wraperVideo').data('callbackin') ) 
          labTools.fns.callbacks[$pasoVideo.parents('.wraperVideo').data('callbackin')]($pasoVideo.parents('.wraperVideo'));
      } 

      // Cambiamos la url
      labTools.fns.url.setUrl(labTools.fns.url.getPathFromSlideId(slideID));
      labTools.fns.menu.setMenu(slideID);
      
    },
    gotoNextPaso: function(slideID) {
      labTools.fns.console.log('gotoNextPaso',slideID);
      var activePaso = null;
      $(slideID + ' .paso').each(function(){
        if(!$(this).hasClass('hidden')) { activePaso = $(this).index(); }
      });
    
      labTools.fns.slide.hidePaso(slideID, activePaso);
      labTools.fns.slide.showPaso(slideID, activePaso+1);
    },
    gotoPrevPaso: function(slideID) {
      labTools.fns.console.log('gotoPrevPaso',slideID);
      var activePaso = null;
      $(slideID + ' .paso').each(function(){
        if(!$(this).hasClass('hidden')) { activePaso = $(this).index(); }
      });
      labTools.fns.slide.hidePaso(slideID, activePaso);
      labTools.fns.slide.showPaso(slideID, activePaso-1);
    },
    slideclosePasoActivo: function(slideID) {
      labTools.fns.console.log('slideclosePasoActivo',slideID);
      $(slideID+' .paso').each(function(){
        if(!$(this).hasClass('hidden')) labTools.fns.slide.hidePaso(slideID, $(this).index());
      });
    },
    showPaso: function(slideID, pasoNum){ //muestra el paso correspondiente dentro de un slide

      var $paso = $(slideID+' .paso:eq('+pasoNum+')');
      
      labTools.fns.console.log('showPaso',slideID, pasoNum, $paso);
      
      if($paso.hasClass('multipaso')) labTools.fns.slide.playMultiPasos($paso);

      $paso.removeClass('hidden').fadeIn(400);
      labTools.data.pasoSlideActiveID = $paso.attr('id');
      if($paso.data('callbackin')) labTools.fns.callbacks[$paso.data('callbackin')]($paso);
    },
    hidePaso: function(slideID, pasoNum){ //oculta el paso correspondiente dentro de un slide
      
      labTools.fns.console.log('hidePaso',slideID, pasoNum);
      labTools.fns.mmedia.videosDestroy();

      var $paso = $(slideID+' .paso:eq('+pasoNum+')');
      $paso.addClass('hidden').fadeOut(400);
      
        // guarda variable global
      labTools.data.pasoSlideActiveID = '';

        //ejecuta el callback de salida si existe
      if($paso.data('callbackout')) labTools.fns.callbacks[$paso.data('callbackout')]($paso);
    },
    applyEfectCSS: function(id) { // Funcion que aplica los efectos de CSS sobre una capa cuyo id nos pasan por parametro
      $(id).removeClass("hidden");
    },
    slideGoPrevius: function() { // Funcion que ejecuta toda la logica para ir al Slide previo     
      
      labTools.fns.console.log('slideGoPrevius');

      // Guardamos el slide actual y el id del paso actual
      var slideA = labTools.data.slideActiveID;
      var pasoA  = labTools.data.pasoSlideActiveID;

      var previusID = '';

        // busca el siguiente multipasos
      var $multiPaso = labTools.fns.slide.getActiveMultiPasos(slideA);

      // Comprobamos si hemos cargado algun Slide
      if ( slideA ) {


        // Comprobamos si estamos en un extra
        if ( labTools.fns.slide.isExtra(slideA) ) {
          
          labTools.fns.extras.swiper.goPrevius();

        } else {

          // Comprobamos si hay pasos dentro del Slide Activo
          if ( labTools.fns.slide.hasPasosSlide(slideA) ) {

              // el slide actual está en el primer paso?
            if (labTools.fns.slide.hasPrevPaso(slideA)) {

              labTools.fns.slide.gotoPrevPaso(slideA);
            } else if( $(slideA).index() === 0) { // primer slide, primer paso
              return;
            } else {
              labTools.fns.slide.slideclosePasoActivo(slideA);
              labTools.fns.slide.slideGoPreviusSlide(slideA);
            }

          } else {

              // Establecemos el siguiente Slide
            labTools.fns.slide.slideGoPreviusSlide(slideA);
          }
        }

      } else {
          labTools.fns.slide.slideGoPreviusSlide(slideA);
      }
    },
    slideGoNext: function() { // Funcion que ejecuta toda la logica para ir al Slide siguiente         
      
      labTools.fns.console.log('slideGoNext', labTools.data.slideActiveID, labTools.data.pasoSlideActiveID);

      // Guardamos el slide actual y el id del paso actual
      var slideA = labTools.data.slideActiveID;
      var pasoA  = labTools.data.pasoSlideActiveID;

      var previusID = '';

        // busca el siguiente multipasos
      var $multiPaso = labTools.fns.slide.getActiveMultiPasos(slideA);

      // Comprobamos si hemos cargado algun Slide
      if (slideA) {
        
        // Comprobamos si estamos en un extra
        if ( labTools.fns.slide.isExtra(slideA) ) {
          
          labTools.fns.extras.swiper.goNext();

        } else {

          // Comprobamos si hay pasos dentro del Slide Activo
          if ( labTools.fns.slide.hasPasosSlide(slideA) ) {

              //si estamos en multipasos
            if($multiPaso.length) {

              if($multiPaso.hasClass('multipaso-played')) { // si es el ultimo multipaso ya se reprodujo va al siguiente paso

                  // el slide actual está en el primer paso?
                if (labTools.fns.slide.hasNextPaso(slideA)) {

                  labTools.fns.slide.gotoNextPaso(slideA);
                } else {

                  labTools.fns.slide.slideclosePasoActivo(slideA);
                  labTools.fns.slide.slideGoNextSlide(slideA);
                }

              } else { 
                labTools.fns.slide.playMultiPasos($multiPaso);
              }

            } else {

                // el slide actual está en el primer paso?
              if (labTools.fns.slide.hasNextPaso(slideA)) {

                labTools.fns.slide.gotoNextPaso(slideA);
              } else {

                labTools.fns.slide.slideclosePasoActivo(slideA);
                labTools.fns.slide.slideGoNextSlide(slideA);
              }
            }

          } else {
              // Establecemos el siguiente Slide
            labTools.fns.slide.slideGoNextSlide(slideA);
          }

        }
      } else {
        labTools.fns.slide.slideGoNextSlide();
      }
    },
    playMultiPasos: function($multipaso){ 
      $multipaso.addClass('multipaso-played');
      var pasos = $multipaso.data('pasos');
      var time;
      for (var i = 0; i < pasos; i++) {
        setTimeout(function(){ labTools.fns.slide.goNextMultiPasos($multipaso); }, i * 2300);
      };
    },
    goNextMultiPasos: function($multipaso){ 
        labTools.fns.console.log('siguiente multipasos:', $multipaso)
      var paso = $multipaso.data('paso');
      if(paso >= $multipaso.data('pasos')) return;
      if($multipaso.data('timeo')) {
        clearTimeout($multipaso.data('timeo'));
        $multipaso.data('timeo', '');
      }
      $multipaso.removeClass('multipaso-'+paso+' multipaso-'+paso+'-tempIN');
      $multipaso.addClass('multipaso-'+(paso+1)+'-tempIN');
      $multipaso.data('timeo', setTimeout(function(){
        $multipaso.addClass('multipaso-'+(paso+1)).removeClass('multipaso-'+(paso+1)+'-tempIN');
      }, labTools.data.multiPasoTime));
      $multipaso.data('paso', paso+1);
        // draw arrows
      var $mapwrap = $multipaso.find('.map-wrap');
      var $arrow = $multipaso.find('.paso-rapharrow-'+(paso+1));
      if($arrow.length){
        $arrow.each(labTools.fns.svg.drawPath)
      }
    },
    goPrevMultiPasos: function($multipaso){
        labTools.fns.console.log('anterior multipasos:', $multipaso)
      var paso = $multipaso.data('paso');
      if(paso <= 0) return;
        // if timout
      if($multipaso.data('timeo')) {
        clearTimeout($multipaso.data('timeo'));
        $multipaso.data('timeo', '');
      }
      $multipaso.removeClass('hidden');
      $multipaso.removeClass('multipaso-'+paso+' multipaso-'+paso+'-tempIN');
      $multipaso.addClass('multipaso-'+(paso-1)+'-tempIN');
      $multipaso.data('timeo', setTimeout(function(){
        $multipaso.addClass('multipaso-'+(paso-1)).removeClass('multipaso-'+(paso-1)+'-tempIN');
      }, labTools.data.multiPasoTime));
      $multipaso.data('paso', paso-1);
    },
    isfirstMultiPasos: function($multipaso){
      return $multipaso.data('paso') === 0;
    },
    isLastMultiPasos: function($multipaso){
      return $multipaso.data('paso') == $multipaso.data('pasos');
    },
    resetMultiPasos: function($multipaso){
          labTools.fns.console.log('resetMultiPasos');
      $multipaso.removeClass('multipaso-'+$multipaso.data('paso'));
      $multipaso.data('paso', 0);
      $multipaso.addClass('multipaso-0');
      $multipaso.addClass('hidden');
    },
    getActiveMultiPasos: function(slideID){
      return $(slideID + ' .multipaso:not(.hidden):first');
    },
    isExtra: function(slideActiveID) {  // Funcion que determina si el Slide activo es un extra

      return $(slideActiveID).hasClass("extra");
    },
    hasPasosSlide: function(slideActiveID) {  // Funcion que determina si el Slide activo tiene pasos intermedios    

      var $pasos = $( '.paso', $(slideActiveID) );

      if ( $pasos && $pasos.length > 0 ) {
        return true;
      } else {
        return false;
      }
    },
    hasPasoActivo: function(slideID){
      var hayPasos = false;
      $(slideID + ' .paso').each(function(){
        if(!$(this).hasClass('hidden')) { hayPasos = $(this).index();}
      });
      return hayPasos;
    },
    hasNextPaso: function(slideId) { // comprueba que no estamos en el último paso del slide
      var $slide = $(slideId);
      var hayPasos = false;
      $slide.find('.paso').each(function(){
        if($(this).hasClass('hidden')) return; // buscamos solo el que no tiene clase hidden
        if($(this).next().length) hayPasos = true;
      });
      return hayPasos;
    },
    hasPrevPaso: function(slideId) { // comprueba que no estamos en el primer paso del slide
      var $slide = $(slideId);
      var hayPasos = false;
      $slide.find('.paso').each(function() {
        if($(this).hasClass('hidden')) return; // buscamos solo el que no tiene clase hidden
        if($(this).prev().length) hayPasos = true;
      });
      return hayPasos;
    },
    slideGoPreviusSlide: function(slideId) { // find the previous slide and show it
        labTools.fns.console.log('slideGoPreviusSlide',slideId);
      var $slide = $(slideId),
        $prevSlide = $slide.prev();
      if($prevSlide.hasClass('extra')) $prevSlide = $prevSlide.prev();
      if(!slideId) { labTools.fns.slide.showSlide('#'+$('.element:eq(0)').attr('id')); return; }
      if(!$prevSlide.length) return;
      var prevId = '#' + $prevSlide.attr('id');
      labTools.fns.slide.hideSlide(slideId);
      labTools.fns.slide.showSlide(prevId);
    },
    slideGoNextSlide: function(slideId) { // find the next slide and show it
        labTools.fns.console.log('slideGoNextSlide',slideId);
      var $slide = $(slideId),
        $nextSlide = $slide.next();
      if($nextSlide.hasClass('extra')) $nextSlide = $nextSlide.next();
      if(!slideId) { labTools.fns.slide.showSlide('#'+$('.element:eq(0)').attr('id')); return; }
      if(!$nextSlide.length) return;
      var nextId = '#' + $nextSlide.attr('id');
      labTools.fns.slide.hideSlide(slideId);
      labTools.fns.slide.showSlide(nextId);

    }
  },
  svg: {
    drawPath: function(){
      var $this = $(this);
      if(!$this.hasClass('raph-drawn')){
        var pasos = 20;
        var time = 1800;
        var counter = 1;
        var RArrow = Raphael(this, 1644, 1280, function(){
          var paper = this;
          paper.canvas.setAttribute('preserveAspectRatio', 'xMinYMin meet');
          paper.setViewBox(0, 0, 1644, 1280, true);
          var pathData = $this.data('path');
          var length = paper.path(pathData).hide().getTotalLength();
          var path = paper.path(Raphael.getSubpath(pathData,0,0.001)).attr({'stroke': '#630100','stroke-width': 2, 'stroke-dasharray': "- "});
          var animation = window.setInterval(function(){ 
            if(counter == pasos) window.clearInterval(animation);
            path.animate({'path' :Raphael.getSubpath(pathData,0,length*counter/pasos)});
            counter ++;
          }, time/pasos);
        });
        $this.addClass('raph-drawn');
      }
    }
  },
  extras: { // Funciones relacionadas con los tooltip del extra "la inquisicion" y su navegacion
    initiateCuadro: function() {

      labTools.data.stylesheet = (function() {
        // Create the <style> tag
        var style = document.createElement("style");

        // Add a media (and/or media query) here if you'd like!
        // style.setAttribute("media", "screen")
        // style.setAttribute("media", "@media only screen and (max-width : 1024px)")

        // WebKit hack :(
        style.appendChild(document.createTextNode(""));

        // Add the <style> element to the page
        document.head.appendChild(style);

        return style;
      })();
    },
    swiper: {

      initialization: function() {

        direccion = ''; // izquierda o derecha..para saber donde situar al tooltip
        var borrado = false;    //booleano para saber si se ha borrado el tooltip del dom tras cerrar el extra
        
        var tooltipNP = $('body').append('<div id="anchorTitle"></div>');

        $swiper = $('.swiper-container');

        // Inicializacion del plugin de Swiper para cada uno de los Extras que haya
        $swiper.each(function(index){
                        
          swiper = $(this).swiper({
            mode: 'horizontal',
            speed: 1000,
            loop:false,
            grabCursor: false,
            paginationClickable: false,
            simulateTouch: false,
            calculateHeight: true,
            resizeReInit: true,
            onSlideChangeStart: function(){


        function updateNavPosition(){
           $('.swiper-nav .active-nav').removeClass('active-nav');
           if(mySwiper) var activeNav = $('.swiper-nav .swiper-slide').eq(mySwiper.activeIndex-1).addClass('active-nav');
           
           var maskIni = $('.swiper-nav .swiper-slide').find('span').each(function(index){
              $(this).addClass('mask');
           });

          if(!mySwiper) return;

          var mascara = $('.swiper-nav .swiper-slide').eq(mySwiper.activeIndex-1).children().removeClass('mask');
          if (!activeNav.hasClass('swiper-slide-visible')) {
            if (activeNav.index()>navSwiper.activeIndex) {
              var thumbsPerNav = Math.floor(navSwiper.width/activeNav.width())-1;
              navSwiper.swipeTo(activeNav.index()-1-thumbsPerNav);
            }
            else {
              navSwiper.swipeTo(activeNav.index()-1);
            }
          }
        }

        mySwiper = labTools.fns.extras.swiper.getSwiper();

        click = false; //se inicializa con false
        windowHeight = $(window).height();
        lineHeight = $('.swiper-nav').height();
        desiredBottom = $(window).height()-125;
        desiredTop = 0;
        newPosition = windowHeight - (lineHeight + desiredBottom);

        if(click == false || mySwiper.activeIndex == 0){
          updateNavPosition() 
          newPosition = windowHeight - (lineHeight + desiredBottom);
          $('.swiper-nav').css({top:''});
          $('.swiper-nav').hide();
          click = true;  
        }
        if(click == false || mySwiper.activeIndex == 1){
          newPosition = windowHeight - (lineHeight + desiredBottom);
          $('.swiper-nav').show();
          $('.swiper-nav').css({top:''});
          $('.swiper-nav').css({bottom:newPosition},300);
          click = true;
        }
        if(mySwiper.activeIndex >= 2){

          var newPosition = desiredTop;        
          updateNavPosition() 
          $('.swiper-nav').show();
          $('.swiper-nav').css({top:newPosition},300, function(){
            setTimeout(function(){$contentSwiper.swipeTo( $contentSwiper.activeIndex)}, 100 )} );
            click = false;        

        }
        else{
          updateNavPosition()
        }  

     }

    });

          // se crea el menu de navegacion en el extra

            navSwiper = $('.swiper-nav').swiper({
              grabCursor:false,
              visibilityFullFit: true,
              slidesPerView:'auto',
              noSwiping:true,
              noSwipingClass : 'swiper-no-swiping',
              shortSwipes : false,
              moveStartThreshold:2000,    
              onSlideClick: function(){
                mySwiper.swipeTo( navSwiper.clickedSlideIndex+1 )  
              }
            })

            if ($( window ).width() < 1221) {
              navSwiper.params.moveStartThreshold = 1
            }
            else{
              navSwiper.params.moveStartThreshold = 2000
            }     

          labTools.data.mySwiper[index] = {
            id: $(this).parent().parent().attr("id"),
            swiper: swiper
          };
        });

         


        // Inicializacion de los eventos relativos a los elementos:
        //      >         Avance hacia el siguiente paso del extra (pasamos al siguiente Slide si es el ultimo)              
        //      <         Retrocedemos al paso previo del extra (pasamos al anterior Slide si es el primero) 
        //      X         Cerramos el extra y pasamos al anterior Slide


        //cuando se hace click sobre la flecha izquierda comprueba si el primer slide para cerrar el extra o pasar al previo.
        //ademas lo reinicia para empezar siempre desde el primer slide por si el extra no se cierra en el ultimo.

        $('.arrow-left', $swiper.parent()).on('click', function (e) {
          labTools.fns.extras.swiper.goPrevius(e);
        });

        //cuando se hace click sobre la flecha derecha comprueba si el ultimo slide para cerrar el extra o pasar al siguiente.
        //ademas lo reinicia para empezar siempre desde el primer slide por si el extra no se cierra en el ultimo.

        $('.arrow-right', $swiper.parent()).on('click',  function (e) {
          labTools.fns.extras.swiper.goNext(e);
        });

        //cierra el extra y vuelve a la batalla previa al hacer click sobre la x        
        $('.arrow-close', $swiper.parent()).on('click', function (e) {

            e.preventDefault();

            var mySwiper = labTools.fns.extras.swiper.getSwiper();

            if (typeof mySwiper != 'undefined');
              mySwiper.swipeTo(0);

 
            // Comprobamos si el Slide tiene un video
            var $slide = $(labTools.data.slideActiveID);
            var $pasoVideo = $('.introVideo', $slide);
            
            if ( $pasoVideo.parents('.wraperVideo').data('callbackout') ) 
              labTools.fns.callbacks[$pasoVideo.parents('.wraperVideo').data('callbackout')]($pasoVideo.parents('.wraperVideo'));


            labTools.fns.slide.slideGoPreviusSlide(labTools.data.slideActiveID);
        
        });

        borrado = false;
        //muestra el tooltip del slide previo o de la batalla previa, en caso de que sea el primero,
        //al mover el raton sobre la flecha izquierda y lo oculta cuando sale de su area

        $('.arrow-left', $swiper.parent()).each(function(index){

          var mySwiper = labTools.fns.extras.swiper.getSwiper(index);

          $(this).on('mousemove', function(){

            direccion = 'left';

            if ( typeof mySwiper != 'undefined' ) {

              if (mySwiper.activeSlide().data('slide') == '1'){
                    if(borrado == true){
                    $('body').append('<div id="anchorTitle"></div>');//crea el div base para el title
                    borrado = false;
                  }
              }  
              var titIndex = parseInt(mySwiper.activeSlide().data('slide'))-1;
              var mySwiperPrev = mySwiper.getSlide(titIndex-1)
              var titulo = $(mySwiperPrev).data('titulo');     

              if (titIndex <= 0){
                labTools.fns.extras.swiper.showAnchorTitle($(this), 'Ir a la batalla anterior');
                    $(this).click(function(){
                      $('div#anchorTitle').remove()});

              } else {
                labTools.fns.extras.swiper.showAnchorTitle($(this), titulo);
              }

              $(this).on('mouseout', function(){
                $('div#anchorTitle').hide();
              });
            }

          });

        });


        $('.arrow-right', $swiper.parent()).each(function(index){
          click = false;
          var mySwiper = labTools.fns.extras.swiper.getSwiper(index);
          $(this).on('mousemove', function(){

            direccion = 'right';

            if ( typeof mySwiper != 'undefined' ) {     
              if ( mySwiper.activeSlide().data('slide') == '1' ) { //si estamos en el slide del video oculta el menu de navegacion
                $('.swiper-nav').hide();
                if(borrado == true){
                  labTools.fns.console.log('entro en borrado y creo un div')
                if(!tooltipNP){  
                  $('body').append('<div id="anchorTitle"></div>');//crea el dib base para el title
                  borrado = false;}
                }
              };
              var titIndex = (mySwiper.activeSlide().data('slide'));
              var mySwiperNext = mySwiper.getSlide(titIndex)
              var titulo = $(mySwiperNext).data('titulo');   
              if ( titIndex == labTools.fns.extras.swiper.getNumSlides(index) ) {
                labTools.fns.extras.swiper.showAnchorTitle($(this), 'Siguiente batalla')
                    $(this).click(function(){
                      $('div#anchorTitle').remove();
                       borrado = true;
                    });
             } else {
                labTools.fns.extras.swiper.showAnchorTitle($(this), titulo)

              }

              $(this).on('mouseout', function(){
                $('div#anchorTitle').hide();
              });
            }
          });
        });

        // Muestra las imagenes de los mapas y los textos asociados de las ordenes en el extra: Reestructuración de la nobleza

        $('.orden-militar')
          .mouseenter(function() {

            var id = $(this).attr("id");

            $('#mapa-' + id).removeClass("hidden");
          })
          .mouseleave(function() {
                        
            var id = $(this).attr("id");

            $('#mapa-' + id).addClass("hidden");
          });



        // Muestra los textos de Los nobles guerreros: Reestructuración de la nobleza

        $('.noble')
          .mouseenter(function() {

            var id = $(this).attr("id");

            id = id.replace("img-", "");

            $('#' + id).removeClass("hidden");
          })
          .mouseleave(function() {
            var id = $(this).attr("id");

            id = id.replace("img-", "");

            $('#' + id).addClass("hidden");
          });
          
      },
      getSwiper: function(index) { // Funcion que obtiene el elemento Swiper 

        // Comprobamos que el valor pasado por parametro sea un numero valido
        if ( !isNaN(index) && index >= 0 && index < labTools.data.mySwiper.length ) {

          // Retorna el objeto Swiper asociado al indice que nos pasan como parametro
          return labTools.data.mySwiper[index].swiper;

        } else {

          // Retorna el objeto Swiper asociado al Extra activo

          // Obtenemos el Slide activo
          $slide = $(labTools.data.slideActiveID);

          // Comprobamos que este definido y sea un extra
          if ( typeof $slide != 'undefined' && $slide.hasClass("extra") ) {

            // Obtenemos la id del Slide
            var enc = false;
            for (var i = labTools.data.mySwiper.length - 1; i >= 0 && !enc; i--) {

              if ( $slide.attr("id") === labTools.data.mySwiper[i].id) {
                enc = true;
                return labTools.data.mySwiper[i].swiper;
              }
            }
          }
        }
      },
      getIdSwiper: function(index) { // Funcion que obtiene el elemento Swiper 

        // Comprobamos que el valor pasado por parametro sea un numero valido
        if ( !isNaN(index) && index >= 0 && index < labTools.data.mySwiper.length ) {

          // Retorna el objeto Swiper asociado al indice que nos pasan como parametro
          return labTools.data.mySwiper[index].id;

        } else {

          // Retorna el objeto Swiper asociado al Extra activo

          // Obtenemos el Slide activo
          $slide = $(labTools.data.slideActiveID);

          // Comprobamos que este definido y sea un extra
          if ( typeof $slide != 'undefined' && $slide.hasClass("extra") ) {

            // Obtenemos la id del Slide
            var enc = false;
            for (var i = labTools.data.mySwiper.length - 1; i >= 0 && !enc; i--) {

              if ( $slide.attr("id") === labTools.data.mySwiper[i].id) {
                enc = true;
                return labTools.data.mySwiper[i].id;
              }
            }
          }
        }
      },
      getNumSlides: function(index){


        var numSlides = -1;

        // Comprobamos que el valor pasado por parametro sea un numero valido
        if ( !isNaN(index) && index >= 0 && index < labTools.data.mySwiper.length ) {

          var id = labTools.fns.extras.swiper.getIdSwiper();

          if (typeof id != 'undefined' && id !== '' && id != 'undefined'){

            $slide = $("#" + id);

            if ( typeof $slide != 'undefined' ) {
            
              numSlides = $(".swiper-slide", $slide ).last().data("slide");
            }
          }

        } else {
        
          $slide = $(labTools.data.slideActiveID);

          if ( typeof $slide != 'undefined' ) {
          
            numSlides = $(".swiper-slide", $slide ).last().data("slide");
          }
        }


        return numSlides;
      },
      goPrevius: function(e){

        if (typeof e != 'undefined' && e !== null)
          e.preventDefault();

        var mySwiper = labTools.fns.extras.swiper.getSwiper();

        if ( typeof mySwiper != 'undefined' && typeof mySwiper.activeSlide()  != 'undefined' ){

          // Comprobamos si el Slide tiene un video
          var $slide = $(labTools.data.slideActiveID);
          var $pasoVideo = $('.introVideo', $slide);

          if ( mySwiper.activeSlide().data('slide') == '1' ) { //comprueba si es el primer slide y si lo es cierra el extra
            
            if ( $pasoVideo.parents('.wraperVideo').data('callbackout') ) 
              labTools.fns.callbacks[$pasoVideo.parents('.wraperVideo').data('callbackout')]($pasoVideo.parents('.wraperVideo'));

            labTools.fns.slide.slideGoPreviusSlide(labTools.data.slideActiveID);
            mySwiper.reInit();

            $(this).on('mousemove', function(){
              $('div#anchorTitle').remove(); //borra el div del nodo para que no se quede fijo mientras no se mueva al cerrar el extra
              borrado = true;
            });
          } else if ( mySwiper.activeSlide().data('slide') == '2' ) { //comprueba si es el segundo slide y si lo es activa el video del extra

            if ( $pasoVideo.parents('.wraperVideo').data('callbackin') ) 
              labTools.fns.callbacks[$pasoVideo.parents('.wraperVideo').data('callbackin')]($pasoVideo.parents('.wraperVideo'));

            mySwiper.swipePrev();
          }
          else {
            mySwiper.swipePrev();
          }
        } else {
          labTools.fns.slide.slideGoPreviusSlide(labTools.data.slideActiveID);
        }
      },
      goNext: function(e) {

        if (typeof e != 'undefined' && e !== null)
          e.preventDefault();
        

        var mySwiper = labTools.fns.extras.swiper.getSwiper();

        if ( typeof mySwiper != 'undefined' && typeof mySwiper.activeSlide()  != 'undefined' ){

          // Comprobamos si el Slide tiene un video
          var $slide = $(labTools.data.slideActiveID);
          var $pasoVideo = $('.introVideo', $slide);

          if ( $pasoVideo.parents('.wraperVideo').data('callbackout') ) labTools.fns.callbacks[$pasoVideo.parents('.wraperVideo').data('callbackout')]($pasoVideo.parents('.wraperVideo'));


          if ( mySwiper.activeSlide().data('slide') == labTools.fns.extras.swiper.getNumSlides() ) {
            
            labTools.fns.slide.slideGoNextSlide(labTools.data.slideActiveID);
            $(this).on('mousemove', function(){
              $('div#anchorTitle').remove();
              borrado = true;
            });

            borrado = true;
            mySwiper.swipeTo(0);
          } else {
            //si el slide es el ultimo cargo la batalla siguiente y oculto este extra
            mySwiper.swipeNext();
          }

        } else {
           labTools.fns.slide.slideGoNextSlide(labTools.data.slideActiveID);
        }
      },
      // la funcion que posiciona el tooltip sobre las flechas
      showAnchorTitle: function (element, text) {

        var offset = element.offset();

        if ( direccion === 'right') {

          $('#anchorTitle')
            .css({
              'left': '',
              'position' : 'fixed',
              'top'  : (offset.top + element.outerHeight() - 44) +'px',
              'right' : ($(window).width() - offset.left + 20) +'px',
              'text-transform' : 'nowrap'
            })
            .addClass('anchor-right')
            .html(text)
            .show();

        } else if ( direccion === 'left' ) {

          $('#anchorTitle')
            .css({
              'position' : 'fixed',
              'top'  : (offset.top + element.outerHeight() - 44) +'px',
              'left' : (offset.left + 50) +'px'
            })
            .removeClass('anchor-right')
            .html(text)
            .show();

        }

      },
      hideAnchorTitle: function () {

        $('#anchorTitle').hide();
      }

    },
    others: {

      initialization: function() {

        $extraEstatico  = $('.static');
        $paginacion     = $('.papas-controls', $extraEstatico);


        // Paginacion        
        $('li a', $paginacion ).each(function (index) {

          var indice = index;

          var $this = $(this);

          $this.attr("title", "Ir a " + labTools.fns.extras.others.getTituloPapa(index));
          $this.attr("alt", "Ir a " + labTools.fns.extras.others.getTituloPapa(index));

          $this.on('click', function (element) {

            labTools.fns.console.log("indice: " + indice);

            // Mostramos el elemento correspondiente
            labTools.fns.extras.others.goPaso(indice);
          });

        });


        labTools.fns.extras.others.goPaso(0);
      },
      goPaso: function (index) {
          labTools.fns.console.log("go paso", index);

        var numSlides = labTools.fns.extras.others.getNumSlides();

        if ( !isNaN(index) && index < numSlides) {

          // Contenedor del extra estatico
          var $estatico   = $('.static');

          // Mostramos el elemento activo dentro de la paginacion
          var $paginacion = $("#pagination", $estatico);

          $('li a', $paginacion).each(function (indice) {

            var $this = $(this);

            if ( indice == index ) {
              $this.addClass("active");
            } else {
              $this.removeClass("active");
            }

          });

          // Mostramos el elemento activo dentro de las imagenes
          var $imagenesPapas = $(".fotoPapa", $estatico);

          $('.img-papa-wrap').css('left', index * -100 + '%');

          // Mostramos el elemento activo dentro de los textos
          var $textoPapas = $(".papa", $estatico);

          $textoPapas.each(function (indice) {

            var $this = $(this);

            if ( indice == index ) {
              $this.stop(true, true).fadeIn(400);
            } else {
              $this.stop(true, true).fadeOut(40);
            }

          });


        } else {
          labTools.fns.console.log("Nos hemos pasado");
        }
      },
      getNumSlides: function() {

        // Devuelve el numero de pasos del extra -1 sino tiene

        var numSlides = -1;
        
        // Contenedor del extra estatico
        var $estatico   = $('.static');

        // Mostramos el elemento activo dentro de la paginacion
        var $paginacion = $("#pagination", $estatico);

        if ( typeof $paginacion != 'undefined' ) {

          numSlides = $('li', $paginacion).children().length;
        }

        return numSlides;
      },
      getIndiceActivo: function() {

        // Devuelve el indice del elemento activo
        var indiceSlide = 0;

        var $estatico = $('.static');
        var $paginacion = $("#pagination", $estatico);

        $('li a', $paginacion).each(function (index) {

          var $this = $(this);

          if ( $this.hasClass("active") ) {
            indiceSlide = index;
          }

        });

        return indiceSlide;
      },
      getTituloPapa: function(indice) {

        var titulo = "";

        var $estatico = $('.static');
        var $papas = $(".papa", $estatico);

        $papas.each(function (index) {

          var $this = $(this);

          if ( indice == index ) {
            titulo = $this.data("titulo");
          }

        });

        return titulo;
      }
    },


  },
  utils: {

    //muestra u oculta los div que le pasamos como parametros, id es el handler, y mostrar es el div a mostrar
    showHide: function(id,mostrar,ocultar){
          $('#'+id).on('click', function(){ //muestra la informacion de los requisitos
          $('div#'+ocultar).fadeOut(300);
          $('div#'+mostrar).fadeIn(300);
        });
    },

    resizeWin: function() {
      var barsHeight = 130;
      var $theWindow = $(window);
      var winWidth = $(window).width();
      var winHeight = $(window).height();
      var winRealHeight = winHeight - barsHeight;
      var $fullHeightElms = $('#main, .container, .element, .menu-main, #batalla-loja-extra-papel-isabel .bl-papel-cuadro-wrap');
      $fullHeightElms.css('height', winRealHeight);
        // redimensiono papel de la reina
      var $papelIsabel = $('#batalla-loja-extra-papel-isabel .bl-papel-cuadro-wrap');
      var cuadroProp = 1.5020;
      var cuadroHeight = winWidth / cuadroProp;
      var cuadroTop = (winRealHeight - cuadroHeight) / 2;
      $papelIsabel.css({'width': winWidth, 'height': cuadroHeight,'margin-left': (-(winWidth - 220)/2), 'margin-top': (-(cuadroHeight - 220)/2)});
      if(labTools.data.stylesheet.sheet && labTools.data.stylesheet.sheet.insertRule) {
        labTools.data.stylesheet.sheet.insertRule(".bl-papel-cuadro-act .bl-papel-cuadro-wrap {margin-top: "+cuadroTop+'px!important}', 0);
      } else {
        if(labTools.data.stylesheet.sheet) {
          labTools.data.stylesheet.sheet.addRule(".bl-papel-cuadro-act .bl-papel-cuadro-wrap", "margin-top: "+cuadroTop+'px!important');
        }
      }
        // redimensiono mapas
      var map = $('.map-wrap');
      var mapProps = 1.285;
      var mapWidth = winWidth * 1.3;
      var mapHeight = mapWidth / mapProps;
      var mapTop = 3.06 * mapHeight / 4;
      var winTop = winHeight / 2;
      map.css({ width: mapWidth, 'margin-left': -0.07 * mapWidth, 'margin-top': winTop - mapTop })
    },
    hammer: {
      // Funcion de inicializacion de Hammer (Plugin para el movimiento en dispositivos tactiles)
      init: function () {
        if(Modernizr.touch){
          var hammer = new labTools.fns.utils.hammer.Hammer($("body")[0]);
        }
      },
      Hammer: function(element) {

        var self = this;

        element = $(element);

        this.next = labTools.fns.slide.slideGoNext;
        this.prev = labTools.fns.slide.slideGoPrevius;

        function handleHammer(ev) {
            labTools.fns.console.log(ev);
            // disable browser scrolling
            ev.gesture.preventDefault();

            switch(ev.type) {
                case 'dragup':
                case 'swipeup':
                    self.next();
                    ev.gesture.stopDetect();
                    break;

                case 'dragdown':
                case 'swipedown':
                    self.prev();
                    ev.gesture.stopDetect();
                    break;
            }
        }

        element.hammer({ drag_lock_to_axis: true })
            .on("dragup dragdown swipeup swipedown", handleHammer);

      }
    }
  }
};


// DOCUMENT READY
// ----------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------

  // lanzamos preload

$( document ).ready(function() {

      $('#preload').fadeOut(400);

        $(function(){
          function setContentSize() {
            $('#sitio').css({
              height: $(window).height()-$('.swiper-nav').height()
            })
          }
          setContentSize()
          $(window).resize(function(){
            setContentSize()
              if ($( window ).width() < 1221) {
                //console.log('menor')                
                navSwiper.params.noSwiping = false;
                navSwiper.params.noSwipingClass = '';
                navSwiper.params.moveStartThreshold = false;
                navSwiper.params.shortSwipes = true;
              }
              else{
                //console.log('mayor')
                navSwiper.params.noSwiping = true;
                navSwiper.params.noSwipingClass = 'swiper-no-swiping';
                navSwiper.params.moveStartThreshold = 2000;
                navSwiper.params.shortSwipes = false;
              }
          })
        })




  // Traza
  labTools.fns.console.log('Ready.... go');
  

  // Inicializacion
  // -----------------------------------------------------------------------------------

  $( window ).bind('orientationchange resize', labTools.fns.utils.resizeWin );
  labTools.fns.utils.resizeWin();

  // Inicializamos Hammer
  labTools.fns.utils.hammer.init();

  // Establecemos el control del movimiento de la rueda de ratón
  $('body').mousewheel( labTools.fns.mouse.mousewheel );


  labTools.fns.extras.initiateCuadro();

  // Extras
  // -----------------------------------------------------------------------------------

  labTools.fns.extras.swiper.initialization();
  labTools.fns.extras.others.initialization();


  // Control de la navegacion
  // -----------------------------------------------------------------------------------

  $(".menu-anyos a").click(function(e) { labTools.fns.menu.clickMenu('#' + $(this).data("nav")); return false; });

  $(".menu-batallas a").click(function(e) { labTools.fns.menu.clickMenu('#' + $(this).data("nav")); return false; });


    //link para moverse como el menu, necesitan un atributo data-id="" con el id del elemento destino
  $('.go-link').click(function(){
    var idLink = $(this).data('id');
    console.log('go-linkl',idLink)
    if(!idLink) return;
    labTools.fns.menu.clickMenu('#' + idLink);
    return false;
  });

  // selector de bandos
  $('.menu-bando a').click(function(){ labTools.fns.menu.setActiveBando($(this).index()); return false; });

  $('.stats-controls a, .stats-controls-main a').click(function(){
    var percents = [0.062, 0.4305, 0.695, 1];
    var $this = $(this);
    var $stats = $this.parents('#bl--sociedad-stats');
    var totalWidth = parseFloat($stats.find('.stats-main').css('width'))
    var $bars = $stats.find('.stats-bar');
    var actIdx = $stats.data('act');
    actIdx = actIdx || 0;
    var idx = $this.index();
    $stats.find('.stats-controls-main a').hide(); 
    $stats.find('.stats-controls-main a:eq('+(idx == 3 ? 0 : idx + 1) +')').show();
    $bars.each(function(){
      var $bar = $(this);
      var $barWrap = $bar.find('.stats-bar-wrap');
      var barIdx = $bar.data('bar');
      var barPadding = parseFloat($bar.css('padding-left'));
      if(barIdx <= idx) { 
        $barWrap.fadeIn(400);
        var newWidt = (totalWidth * percents[idx]) - barPadding;
        var totalWidt = totalWidth - barPadding;
        newWidt = newWidt * 100 / totalWidt;
        $barWrap.css('width', newWidt + '%');
      } else { 
        $barWrap.fadeOut(400);
        $barWrap.css('width', 0);
      }
    })
    $stats.data('act', idx);
  })
  $('.stats-controls a:eq(0)').click();

  // selector de bandos del inicio
  $('.click-bando-arabe').click(function(){ labTools.fns.menu.setActiveBando(1); labTools.fns.slide.slideGoNext(); return false; });
  $('.click-bando-cristiano').click(function(){ labTools.fns.menu.setActiveBando(0); labTools.fns.slide.slideGoNext(); return false; });
 
  $('.tooltip').hover(function(){
    $(this).addClass('tooltip-act').find('.ttip').stop(true, true).fadeIn(800);
  }, function(){
    $(this).removeClass('tooltip-act').find('.ttip').stop(true, true).fadeOut(800);
  });

   //minireproductor edicto judios
  $('#player-judios, #player-alhama').click(function(){
    var $this = $(this);
    var audio = $(this).find('audio:eq(0)');
    audio.unbind('ended');
    audio.bind('ended', function(){
      this.currentTime = 0;
      $this.removeClass('player-playing');
    });
    if($this.hasClass('player-playing')) {
      $this.removeClass('player-playing');
      $this.find('audio')[0].pause();
    } else {
      $this.addClass('player-playing');
      labTools.fns.mmedia.play($this.find('audio')[0]);
    }
  });

   //ayuda
  $('#click-help, .click-close').click(function(){
    $('#help2').fadeToggle(400);
  });
 
  $('.paso-popup').hover(function(){
    $(this).addClass('paso-pop-act').find('.paso-pop-cont').stop(true, true).fadeIn(800);
  }, function(){
    $(this).removeClass('.paso-pop-act').find('.paso-pop-cont').stop(true, true).fadeOut(800);
  });



  //el principe mkoderno

  //muestra u oculta los objetos al hacer click en el boton correspondiente. Extra el principe moderno
  $('ul#requisitos li').on('click', function() {
    var $this = $(this);
    objetoSel = $this.data('objeto');
    $('img#'+objetoSel).fadeIn(500);  //muestra u oculta el objeto
    var contenidos = $('div#contenido div'); //oculta el div actual 
    contenidos.each(function(i) {
      $(this).fadeOut(300)    
    });
    $('div#exp'+objetoSel).fadeIn(300) // muestra el div activo
  })  

  $('.touch #menu-expand').click(function(){
    $(this).parents('.menu-main').toggleClass('menu-main-expanded')
  })

  $('#saltavideo').click(function(){
    if($('body').hasClass('es-extra')){
      labTools.fns.slide.slideGoNext()
    } else {
      labTools.fns.slide.gotoNextPaso(labTools.data.slideActiveID)
    }
  })

    //papel reina
  $('#batalla-loja-extra-papel-isabel').click(function(){ $('.bl-papel-cuadro').toggleClass('bl-papel-cuadro-act'); });

  $('.pop').hover(
    //comprobamos si el pop-pup tiene video. Si es asi lo incia al hacer hover y lo para y lo reinicializa al hacer out-----------------------------------------
    function() {
      $('.pop.pop-act').removeClass('pop-act')
      var $this = $(this);

      var $videoWrap =  $('.video-wrap', $this);

      labTools.fns.mmedia.generavideo( $videoWrap, null, function(){
        console.log('video load')
      } );

      videoSioNo = $this.find('video').length;

      miVideo = $this.find('video');
      $this.addClass('pop-act');

      /*
      if(videoSioNo){      	
        labTools.fns.mmedia.play($this.find('div.pop-inn').find('video')[0]);        
        $this.toggleClass('pop-act');
      } else {
        $this.toggleClass('pop-act');
      }*/
    }, 
    
    function (){
      var $this = $(this);
      if(videoSioNo>0){
        $this.find('div.pop-inn').find('video')[0].pause()
        $this.find('div.pop-inn').find('video')[0].currentTime = 0;
        $this.removeClass('pop-act');
      }
      else{
        $this.removeClass('pop-act');
      }
  })

  //oculta o muestra la informacion en el principe moderno

  labTools.fns.utils.showHide('saber','contenido','intro');
  labTools.fns.utils.showHide('volver','intro','contenido');

  //evento al presionar una tecla
  $(document).keydown( labTools.fns.keyboard.keyboardEvent );
  
/* ___-_ mapa expulsión judíos _-________________ */

    //bind menu links
  $('p.link_map_jude').on('mouseover', function(e) {
    
    var $this = $(this);
    var paisSel = $this.data('pais');
    var pais = $('svg g#aux');
    var paises = pais.siblings();
    paises.each(function(i) {
        $(this).hide()   
    });

    //al hacer hover en el menu destaca su frontera en el mapa con su informacion 
    $('g#exp'+paisSel).fadeIn(100);
    var hermanos = $('svg path[id='+paisSel+']').siblings();
    hermanos.each(function(i){
      $(this).attr({'fill':'none'})
    })

    $('#fronteras2 path[data-border=bord'+paisSel+']').attr({
      'fill':'#000',
      'opacity':'0.3'
    })
    //enciende el pais seleccionado en el menu al acer hover sobre el mismo en el mapa
    $('p[data-pais='+paisSel+']').css(
      { 'color':'#400808',
        'background':'white'
      }
    )
    $('p[data-pais='+paisSel+']').next().css('border-left','16px solid #FFFFFF')
    var restomenu = $('p[data-pais='+paisSel+']').siblings()
        restomenu.each(function(i){
      $(this).css(
        {'color':'white',
          'background':'#400808'
        })
    })
    
  })

  $('p.link_map_jude').on('mouseout', function(e) {

    var paisSel = $(this).data('pais');
    var pais = $('svg g#aux');
    $('g#exp'+paisSel).fadeOut(100);
    $('#fronteras2 path[data-border=bord'+paisSel+']').attr({'fill':'none' })
    //apaga el pais seleccionado en el menu al salirse del mismo en el mapa
    $('p[data-pais='+paisSel+']').css(
      { 'color':'#fff',
        'background':'#400808'
      }
    )
        $('p[data-pais='+paisSel+']').next().css('border-left','16px solid #400808')
  })


  //apaga el pais al salirse de el
  $("path[data-border]").on('mouseout', function(e){
    var $this = $(this);
    var paisSel = $this.attr('id');
    var border = $this.attr('data-border');
    $('p[data-pais='+paisSel+']').css(
      { 'color':'#fff',
        'background':'#400808'
      }
    )
    $('#fronteras2 path[data-border=' + border + ']').attr('fill','none') 
    $('p[data-pais='+paisSel+']').next().css('border-left','16px solid #480008')
    var pais = $('svg g#exp'+paisSel);
    $(pais).fadeOut(10);
    $(this).attr({
       'opacity':'0'
    });
  })

 $("path[data-border]").on('mouseover', function(e){ 
    var $this = $(this);
    var paisSel = $this.attr('id');
    var border = $this.attr('data-border');


    //enciende el pais seleccionado en el menu al acer hover sobre el mismo en el mapa
    $('p[data-pais='+paisSel+']').css(
      { 'color':'#400808',
        'background':'white'
      }
    )

    $('p[data-pais='+paisSel+']').next().css('border-left','16px solid #FFFFFF')
    var restomenu = $('p[data-pais='+paisSel+']').siblings()
        restomenu.each(function(i){
      $(this).css(
        {'color':'white',
          'background':'#400808',
        })
    })
    var fronteras = $('#fronteras2 path[data-border=' + border + ']').siblings();

    fronteras.each(function(i) {
      $('#fronteras2 path[data-border=' + border + ']').attr('fill','none')     
      //$(this).delay(i*200).fadeOut(1500);       
    });

    var pais = $('svg g#exp'+paisSel);
    var hermanos = pais.siblings();
    hermanos.each(function(i) {
      $(this).hide()     
      //$(this).delay(i*200).fadeOut(1500);       
    });

    $(pais).fadeIn(10);
    $('#fronteras2 path[data-border=' + border + ']').attr({
      'fill':'#000',
      'opacity':'0.3'
    });
  });

    //especial behaviour for france link
  $('g tspan#mas').on('click', function(){
    $('svg g path[id=francia]').attr({'fill':'none'})
    $('g#expfrancia').fadeOut(300);     
    $('svg g path[id=francia2]').attr({'fill':'#000'})
    $('g#expfrancia2').fadeIn(300);
  })

});

document.addEventListener("DOMContentLoaded", function(event) {
  labTools.fns.url.initiate();
});


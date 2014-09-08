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

/*___-_ basic lab toolkit _-________________*/
var labTools = {
    resizeFullsizes: function($elms, padding) { //tool for setting full size elements
        //calculate the size for the full size elements
        if (!padding) {
            verticalPadding = horizontalPadding = 50;
            padLeft = 0;
            padTop = 25;  //default padding = 50
        } else if (!isNaN(padding)) {
            verticalPadding = horizontalPadding = padding * 2;
            padLeft = padTop = padding;
        } else { // supose padding is an array... I know
            verticalPadding = padding[0] + padding[2];
            horizontalPadding = padding[1] + padding[3];
            padLeft = padding[3];
            padTop = padding[0];
        }
        var $thewindow = $(window),
                winRealH = $thewindow.height() - verticalPadding/*lab bars */, winRealW = $thewindow.width() - horizontalPadding,
                winProp = winRealW / winRealH;
        $elms.each(function() {
            var $this = $(this), contentH = 2720, contentW = 4835, contentProp = contentW / contentH; //change contentH & contentW to your content size
            if (contentProp > winProp) {
                var canvH = winRealW / contentProp;
                $this.css({'height': canvH, 'width': '100%', 'margin-top': ((winRealH - canvH) / 2) + padTop, 'margin-left': padding[3]});
            } else {
                var canvW = winRealH * contentProp, canvH = canvW / contentProp;
                $this.css({'height': canvH, 'width': canvW, 'margin-left': ((winRealW - canvW) / 2) + padLeft, 'margin-top': padding[0]});
            }
        });
        winProp < 1 ? $('body').addClass('body-vertical') : $('body').removeClass('body-vertical');
    },
    preload: function() { // basic preload function
        var elms = [], callback;
        function _setElm(selector, thiscallback) {
            callback = thiscallback;
            $(selector).each(function() {
                if (this.complete === 'undefined' || this.complete) {
                    callback();
                    return;
                }
                $(this).bind('load error', function() {
                    _checkElms();
                });
                elms.push(this);
            });
            if (!elms.length)
                callback();
        }
        ;
        function _checkElms() {
            for (var i = 0; i < elms.length; i++) {
                if (elms[i].complete) {
                    elms[i].splice;
                } else {
                    return;
                }
                ;
            }
            ;
            callback();
        }
        ;
        return _setElm; //real interface;
    }(),
    toggleFull: function() { //basic full screen toggle function
        var $elem = $('body'); //change the element in case you don't want the full window into the fullsize
        var elem = $elem[0];
        if (!document.fullscreenElement && // alternative standard method
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

        }

        return false;
    },
    slider1: null
},
labIsabel = {
    basicPreload: function() { //bind preload to #loader imgs
        labTools.preload('#nojschar img', function() { //callback function when preload completes
            $('#nojschar, #preload').detach();
        });
    },
    urlPrefix: ''
};

//if fullscreen available, show button & bind automatic events
if (Modernizr.fullscreen) {
    //display and bind fullscren buttons
    $('#togglefull').show().click(labTools.toggleFull);
    $(document).bind("fullscreenchange webkitfullscreenchange mozfullscreenchange", function() {
        if (document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement)
            return;
        $('body').removeClass('fullscreen-on');
        $('#togglefull').html('');
    });
}

/* angular code */
'use strinct';
//declare ng app
isb = angular.module('isb', ['paragraphFix', 'ngSanitize', 'hmTouchEvents']); // define isabel module

isb.config(function($locationProvider) {
    if (Modernizr.history) {
        $locationProvider.html5Mode(true);
    } else {
        $locationProvider.html5Mode(false);
    }
});

function isbController($scope, $http, $timeout, $location) {

    //initial data load
    $http.get('/serie-isabel/personajes/data/isb.csv')
            .success(function(data, status, headers, config) {

                $scope.fns.preP.processData($.csv.toObjects(data));
                $timeout(function() {
                    labIsabel.basicPreload(); //launch iamges preload function
                    if ($location.path())
                        $scope.fns.interact.goToPage($location.path());  //search url and process it
                    $scope.fns.interact.drawStaticsChap();
                    $scope.fns.interact.drawStatics(); //draws the svgs
                    var winWidth = $(window).width(), winHeight = $(window).height() - 130, objWidth = 1400, objHeight = 1070,
                            scaleW = winWidth / objWidth, scaleH = winHeight / objHeight,
                            scale = scaleW < scaleH ? scaleW : scaleH;
                    if (Modernizr.touch) {
                        $('.main-wrap').panzoom();
                        $('#main-main').css('overflow', 'hidden');
                    }
                    //fix panzoom preventdefault behaviours
                    $('select').on('mousedown click touchend', function(e) {
                        e.stopPropagation();
                    });
                    /*if(scale < 1) {
                     $('#panzoom').addClass('act').html('');
                     $('.main-wrap').panzoom("zoom", scale, { animate: true, middle: {pageX: 0, pageY: 100} });
                     }*/
                }, 0);
                console.log($scope);
            })
            .error(function(data, status, headers, config) {
                $('#preload').html('<div id="pre-wrap"><h2>Lo sentimos<br/>Se produjo un error en la carga de la web<br/><br/>Inténtelo más tarde</h2></div>');
            });

    /*___-_ some initial data _-________________*/
    $scope.status = {//general status information
        loading: true, // show splash scrren until false
        list: '', // control search list display: falsy to not display, 'list' for list view or 'grid' for big display  
        lastSeason: true   // select last season: true, false: previous seasons
    };

    $scope.personajes = []; // characters data

    $scope.datum = {
        colores: {'castilla': '#DD1442', 'portugal': '#01A7C1', 'nazari': '#CC9600', 'inglaterra': '#F07FCC', 'vaticano': '#AB79B8', 'francia': '#6D9965', 'flandes': '#FCC82B'}, //kingdoms colors
        capitulos: {//the links for the chapters, to be updated as we have them
            1: 'http://www.rtve.es/television/isabel-la-catolica/primer-capitulo/',
            2: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-2/',
            3: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-3/',
            4: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-4/',
            5: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-5/',
            6: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-6/',
            7: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-7/',
            8: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-8/',
            9: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-9/',
            10: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-10/',
            11: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-11/',
            12: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-12/',
            13: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-13/',
            14: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-14/',
            15: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-15/',
            16: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-16/',
            17: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-17/',
            18: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-18/',
            19: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-19/',
            20: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-20/',
            21: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-21/',
            22: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-22/',
            23: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-23/',
            24: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-24/',
            25: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-25/',
            26: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-26/',
            /*27: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-27/',
            28: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-28/',
             29: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-29/',
             30: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-30/',
             31: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-31/',
             32: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-32/',
             33: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-33/',
             34: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-34/',
             35: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-35/',
             36: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-36/',
             37: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-37/',
             38: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-38/',
             39: 'http://www.rtve.es/television/isabel-la-catolica/capitulo-39/'*/
        }
    };
    if (!$('body').hasClass('nojschar')) {
        $scope.raphael = Raphael('sferas-raphael', 1350, 1020); // rapahel canvas for the relations lines
        $scope.raphaelS3 = Raphael('sferas-raphael-season-3', 1350, 1020); // rapahel canvas for the relations lines
        $scope.raphaelstatics = Raphael('sferas-raphaelstatics', 1350, 1020); // .. for the characters statics
        $scope.raphaelstaticsChaps = Raphael('sferas-raphaelstatics-chaps', 1350, 1020); // .. for the episodes statics-
        $scope.raphaelstaticsChaps3 = Raphael('sferas-raphaelstatics-chaps3', 1350, 1120); // .. for the episodes statics-
    }
    $scope.fns = {}; // functiontions container

    /*___-_ global interaction methods _-________________*/
    $scope.fns.interact = {
        basicCharFiltro: function(e) {
            if ($scope.status.lastSeason) {
                $('.char-' + e.id).removeClass('bl-char-circ-lev' + e.esferalevels).addClass('bl-char-circ-lev' + e.esferalevels3);
                return e.initialChar3;
            } else {
                $('.char-' + e.id).removeClass('bl-char-circ-lev' + e.esferalevels3).addClass('bl-char-circ-lev' + e.esferalevels);
                return e.initialChar;
            }
            //return e.initialChar;
        }, //filter the character list when displayed in the main ng-repeat (if no esferaid, return false and is not displayed)
        activateSfera: function(personaje) { //activate a character and his related characters and draw the raphael lines
            var esferaId = personaje.esferaid;

            if (!esferaId || $scope.status.activeSfera || $scope.status.statics || $scope.status.staticsChapt)
                return; // only display it if the main view is active
            $scope.fns.interact.clearActiveSfera();
            $scope.status.charTreeHover = personaje;

            var $mainchar = $('.pastSeason .char-' + personaje.id),
                    mainchartWidth = parseInt($mainchar.css('width')),
                    mainCentX = parseInt($mainchar.css('left')) + mainchartWidth / 2,
                    mainCentY = parseInt($mainchar.css('top')) + mainchartWidth / 2;  // get the main chapter and save his size

            // draws the four types of lines (enemies, friends, enemies family and friends family) => needs refactor
            for (var i = 0; i < personaje.sferasRel.F.length; i++) {
                var target = personaje.sferasRel.F[i], targetId = target.id, $target = $('.pastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBar('#555', '.', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            for (var i = 0; i < personaje.sferasRel.a.length; i++) {
                var target = personaje.sferasRel.a[i], targetId = target.id, $target = $('.pastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBar($scope.datum.colores[target.esferacoronas], '1', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            for (var i = 0; i < personaje.sferasRel.e.length; i++) {
                var target = personaje.sferasRel.e[i], targetId = target.id, $target = $('.pastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBar('#555', '1', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            for (var i = 0; i < personaje.sferasRel.f.length; i++) {
                var target = personaje.sferasRel.f[i], targetId = target.id, $target = $('.pastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBar($scope.datum.colores[target.esferacoronas], '.', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            $('#sferas-raphaelstatics').css('opacity', 0.2);
        },
        activateSferaSeason3: function(personaje) { //activate a character and his related characters and draw the raphael lines
            var esferaId = personaje.esferaid;

            if (!esferaId || $scope.status.activeSfera || $scope.status.statics || $scope.status.staticsChapt3)
                return; // only display it if the main view is active

            $('#season-3-wrapper').addClass('char-tree-hover');
            $scope.fns.interact.clearActiveSfera();
            $scope.status.charTreeHover = personaje;

            var $mainchar = $('.lastSeason .char-' + personaje.id),
                    mainchartWidth = parseInt($mainchar.css('width')),
                    mainCentX = parseInt($mainchar.css('left')) + mainchartWidth / 2,
                    mainCentY = parseInt($mainchar.css('top')) + mainchartWidth / 2;  // get the main chapter and save his size

            // draws the four types of lines (enemies, friends, enemies family and friends family) => needs refactor            
            for (var i = 0; i < personaje.sferasRel3.a.length; i++) {
                var target = personaje.sferasRel3.a[i], targetId = target.id, $target = $('.lastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBarS3('#555', '-', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            for (var i = 0; i < personaje.sferasRel3.e.length; i++) {
                var target = personaje.sferasRel3.e[i], targetId = target.id, $target = $('.lastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBarS3('#555', '.', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
            for (var i = 0; i < personaje.sferasRel3.f.length; i++) {
                var target = personaje.sferasRel3.f[i], targetId = target.id, $target = $('.lastSeason .char-' + targetId),
                        targetWidth = parseInt($target.css('width')),
                        charCentX = parseInt($target.css('left')) + targetWidth / 2,
                        charCentY = parseInt($target.css('top')) + targetWidth / 2;
                target.actSfera = true;
                if ($target.length && charCentX && charCentY) {
                    $scope.fns.interact.drawBarS3('#555', '1', mainCentX, charCentX, mainCentY, charCentY, targetWidth / 2, mainchartWidth / 2);
                }
            }
            ;
        },
        drawBar: function(color, stroke, X1, X2, Y1, Y2, r2, r1) { // draw the line between two character circles
            var difX = X1 - X2, difY = Y1 - Y2, diagBig = Math.sqrt(Math.pow(difX, 2) + Math.pow(difY, 2)),
                    prop1 = r1 / diagBig, prop2 = r2 / diagBig;
            X1 -= prop1 * difX;
            X2 += prop2 * difX;
            Y1 -= prop1 * difY;
            Y2 += prop2 * difY;
            $scope.raphael.path('M ' + X1 + ' ' + Y1 + ' L ' + X2 + ' ' + Y2).attr({
                stroke: color, 'stroke-width': 4, 'stroke-dasharray': stroke
            });
        },
        drawBarS3: function(color, stroke, X1, X2, Y1, Y2, r2, r1) { // draw the line between two character circles
            var difX = X1 - X2, difY = Y1 - Y2, diagBig = Math.sqrt(Math.pow(difX, 2) + Math.pow(difY, 2)),
                    prop1 = r1 / diagBig, prop2 = r2 / diagBig;
            X1 -= prop1 * difX;
            X2 += prop2 * difX;
            Y1 -= prop1 * difY;
            Y2 += prop2 * difY;
            $scope.raphaelS3.path('M ' + X1 + ' ' + Y1 + ' L ' + X2 + ' ' + Y2).attr({
                stroke: color, 'stroke-width': 4, 'stroke-dasharray': stroke
            });
        },
        clearActiveSfera: function() { //clears the active relations for the character
            //process relaciones names and get the id's
            for (var i = 0; i < $scope.personajes.length; i++) {
                $scope.personajes[i].actSfera = false;
            }
            ;
            $scope.raphael.clear();
            $scope.status.charTreeHover = false;
            $('#sferas-raphaelstatics').css('opacity', 1);
        },
        clearActiveSferaSeason3: function() { //clears the active relations for the character
            $('#season-3-wrapper').removeClass('char-tree-hover');
            //process relaciones names and get the id's
            for (var i = 0; i < $scope.personajes.length; i++) {
                $scope.personajes[i].actSfera = false;
            }
            ;
            $scope.raphaelS3.clear();
            $scope.status.charTreeHover = false;
        },
        clickSfera: function(personaje) { //set character as active when clicking over it and display ficha
            $scope.status.list = null;
            if ($scope.status.activeSfera === personaje) {
                return;
            }
            if ($scope.status.activeSfera) {
                $location.path('/');
                var $olElm = $('.pastSeason .char-' + $scope.status.activeSfera.id);
                $olElm.css({'left': parseInt($olElm.data('map-left')), 'top': parseInt($olElm.data('map-top'))}); //use the previous prosition saved
                $scope.status.activeSfera = ''; //remove active sfera
            }
            ;
            //$scope.fns.interact.clickClearSfera();
            $scope.status.statics = $scope.status.staticsChapt = false;
            $location.path(labIsabel.urlPrefix + '/personaje/' + $scope.fns.getUrl(personaje.PERSONAJE));
            //calculate vertical position of the main sfera based on number of friend (the row over the main)
            var friendsRow = Math.ceil(personaje.realSferasGroup.a.length / 4),
                    fixTop = (90 * friendsRow);// - ($('.char-tree-wrap').offset().top - 190),
            fixLeft = 230;//$('.char-tree-wrap').offset().left > 0 ? 230 : 230 - $('.char-tree-wrap').offset().left;
            var $elm = $('.pastSeason .char-' + personaje.id);
            $elm.data({'map-left': $elm.css('left'), 'map-top': $elm.css('top')}); // save the initial position
            $elm.css({'left': fixLeft, 'top': 60 + fixTop}); //the final position
            $scope.status.activeSfera = personaje;
            $('#main').scrollTop(0);
            _gaq.push(['_trackPageview', '/serie-isabel/personajes/personaje/' + $scope.fns.getUrl(personaje.PERSONAJE)]);
        },
        clickSferaSeason3: function(personaje) { //set character as active when clicking over it and display ficha
            $scope.status.list = null;
            if ($scope.status.activeSfera === personaje) {
                return;
            }
            if ($scope.status.activeSfera) {
                $location.path('/');
                var $olElm = $('.lastSeason .char-' + $scope.status.activeSfera.id);
                $olElm.css({'left': parseInt($olElm.data('map-left3')), 'top': parseInt($olElm.data('map-top3'))}); //use the previous prosition saved
                $scope.status.activeSfera = ''; //remove active sfera
            }
            ;
            //$scope.fns.interact.clickClearSfera();
            $scope.status.statics = $scope.status.staticsChapt3 = false;
            $location.path(labIsabel.urlPrefix + '/personaje/' + $scope.fns.getUrl(personaje.PERSONAJE3) + '/t3');
            //calculate vertical position of the main sfera based on number of friend (the row over the main)
            /*var friendsRow = Math.ceil(personaje.realSferasGroup.a.length / 4),
             fixTop = (90 * friendsRow);// - ($('.char-tree-wrap').offset().top - 190),
             fixLeft = 230;//$('.char-tree-wrap').offset().left > 0 ? 230 : 230 - $('.char-tree-wrap').offset().left;
             if (personaje.realSferasGroup.a.length) {
             fixTop += 44;
             } // count the allies title            
             */
            var $elm = $('.lastSeason .char-' + personaje.id);
            $elm.data({'map-left3': $elm.css('left'), 'map-top3': $elm.css('top')}); // save the initial position
            $elm.css({'left': 220, 'top': 10}); //the final position
            $scope.status.activeSfera = personaje;
            $('#main').scrollTop(0);
            _gaq.push(['_trackPageview', '/serie-isabel/personajes/personaje/' + $scope.fns.getUrl(personaje.PERSONAJE3)]) + '/t3';
        },
        //disable character as active and hide ficha
        clickClearSfera: function() {
            $location.path(labIsabel.urlPrefix + '/');
            if ($scope.status.lastSeason) {
                var $olElm = $('.lastSeason .char-' + $scope.status.activeSfera.id);
                $olElm.css({'left': parseInt($olElm.data('map-left3')), 'top': parseInt($olElm.data('map-top3'))}); //use the previous prosition saved
            } else {
                var $olElm = $('.pastSeason .char-' + $scope.status.activeSfera.id);
                $olElm.css({'left': parseInt($olElm.data('map-left')), 'top': parseInt($olElm.data('map-top'))}); //use the previous prosition saved
            }
            $scope.status.activeSfera = ''; //remove active sfera
            _gaq.push(['_trackPageview', '/serie-isabel/personajes/']);
        },
        //Set active sfera when loading hash from url
        initialSfera: function(personaje) {
            $scope.fns.interact.clickSfera(personaje);
        },
        toggleSrchList: function() {
            if ($scope.status.list === 'list') {
                $scope.status.list = 'grid';
                $('#toggle-search').addClass('dcha');
            } else {
                $scope.status.list = 'list';
                $('#toggle-search').removeClass('dcha');
            }
        },
        toggleSeason: function() {
            if ($scope.status.lastSeason) {
                // Show past seasons
                $scope.status.lastSeason = false;
                $(".lastSeasonSlide").hide();
                $(".pastSeasonSlide").show();
            } else {
                // Show last season
                $scope.status.lastSeason = true;
                $(".pastSeasonSlide").hide();
                $(".lastSeasonSlide").show();
            }
            setTimeout(function() {
                $scope.fns.interact.drawStaticsChap();
            }, 1000);
        },
        activateChar: function(charData) {
            $location.path(labIsabel.urlPrefix + '/personaje/' + $scope.fns.getUrl(charData.PERSONAJE));
            $scope.status.activeChapt = null;
            $scope.status.activeChar = charData;
        },
        activeImage: function(personaje) {
            var imgPath = '/serie-isabel/personajes/img/fotos/';
            var imgPathT3 = '/serie-isabel/personajes/img/fotos/t3/';
            if ($scope.status.lastSeason) {
                if (personaje.IMAGENES3 !== '' && imageExists(imgPathT3 + personaje.IMAGENES3)) {
                    return imgPathT3 + personaje.IMAGENES3;
                }
            }

            return imgPath + personaje.IMAGENES;
        },
        /*___-_ url changes _-_______________________________________________________*/
        goToPage: function(url) {
            var urlArray = url.split('/');
            switch (urlArray[1]) {
                case 'personaje':
                    $scope.fns.interact.initialSfera($scope.fns.getCharByUrl(urlArray[2]));
                    break;
            }
        },
        /*___-_ statics graph display (click the legenday allie name to display them) _-________________*/
        drawStatics: function() {
            for (var i = 0; i < $scope.personajes.length; i++) {
                var $target = $('.char-' + $scope.personajes[i].id + ':not(:hidden)');
                if ($scope.personajes[i].initialChar && $target.length) {
                    if ($target.hasClass('bl-char-circ-lev1')) {
                        var targetRad = 86;
                    }
                    else if ($target.hasClass('bl-char-circ-lev2')) {
                        var targetRad = 57.5;
                    }
                    else if ($target.hasClass('bl-char-circ-lev3')) {
                        var targetRad = 38;
                    }
                    var enemLength = $scope.personajes[i].realSferasGroup.e.length,
                            amigLength = $scope.personajes[i].realSferasGroup.a.length,
                            totalLength = enemLength + amigLength,
                            enemRads = (enemLength / totalLength) * Math.PI * 2,
                            amigRads = (amigLength / totalLength) * Math.PI * 2,
                            //targetRad = parseInt($target.find('.bl-char-img').css('width'))/2,
                            cX = parseInt($target.css('left')) + targetRad + 5, //adds the border of the circles 
                            cY = parseInt($target.css('top')) + targetRad + 5, initialRad = -Math.PI / 2, endRad;
                    if (!enemLength || !amigLength) {
                        var realLength = enemLength || amigLength,
                                realColor = enemLength ? '#940b0b' : '#2E31E4',
                                endRad = Math.PI / 2;
                        $scope.raphaelstatics.path(rphArc(initialRad, endRad, cX, cY, targetRad - 2, realLength * 2))
                                .attr({'stroke-width': 0, 'fill': realColor});
                        initialRad += 2 * Math.PI;
                        $scope.raphaelstatics.path(rphArc(endRad, initialRad, cX, cY, targetRad - 2, realLength * 2))
                                .attr({'stroke-width': 0, 'fill': realColor});
                    } else {
                        if (amigLength) {
                            endRad = initialRad + amigRads;
                            if (initialRad === endRad) {
                                endRad += 0.0001;
                            }
                            $scope.raphaelstatics.path(rphArc(initialRad, endRad, cX, cY, targetRad - 2, amigLength * 2))
                                    .attr({'stroke-width': 0, 'fill': '#2E31E4'});
                        } else {
                            endRad = -Math.PI / 2;
                        }
                        if (enemLength) {
                            initialRad = endRad;
                            endRad = initialRad + enemRads;
                            if (initialRad === endRad) {
                                endRad += 0.0001;
                            }
                            $scope.raphaelstatics.path(rphArc(initialRad, endRad, cX, cY, targetRad - 1, enemLength * 2))
                                    .attr({'stroke-width': 0, 'fill': '#940b0b'});
                        }
                    }
                }
                ;
            }
            ;

        },
        clearStatics: function() {
            $scope.raphaelstatics.clear();
        },
        toggleStatics: function() {
            $scope.status.statics = !$scope.status.statics;
        },
        drawStaticsChap: function() {
            for (var i = 0; i < $scope.personajes.length; i++) {
                var drawCharacter = false;
                if ($scope.status.lastSeason) {
                    if ($scope.personajes[i].initialChar3) {
                        drawCharacter = true;
                    }
                } else {
                    if ($scope.personajes[i].initialChar) {
                        drawCharacter = true;
                    }
                }
                if (drawCharacter) {
                    $target = null;
                    if ($scope.status.lastSeason) {
                        $target = $('section.lastSeason .char-' + $scope.personajes[i].id + ':not(:hidden)');
                    } else {
                        $target = $('section.pastSeason .char-' + $scope.personajes[i].id);
                    }
                    //console.log('section.pastSeason .char-' + $scope.personajes[i].id + " OBJ: " + $('section.pastSeason .char-' + $scope.personajes[i].id).attr('class'));

                    //var $target = $('section.char-tree .char-' + $scope.personajes[i].id + ':not(:hidden)');
                    if ($target.length && $scope.personajes[i].realSferas.length) { //filter the characters from the main infography 
                        if ($target.hasClass('bl-char-circ-lev1')) {
                            var targetRad = 86;
                        }  //save manually the sizes of the circles(IEfix)
                        else if ($target.hasClass('bl-char-circ-lev2')) {
                            var targetRad = 57.5;
                        }
                        else if ($target.hasClass('bl-char-circ-lev3')) {
                            var targetRad = 38;
                        }

                        var minChapter = 1;
                        var maxChapter = 26;
                        if ($scope.status.lastSeason) {
                            minChapter = 27;
                            maxChapter = 34;
                        }
                        var numChapters = maxChapter - minChapter + 1;
                        var changAng = 2 * Math.PI / numChapters, //the size of 1 chapter 
                                iniAng = -Math.PI / 2, //the initial angle
                                cX = parseInt($target.css('left')) + targetRad + 5, //adds the border of the circles 
                                cY = parseInt($target.css('top')) + targetRad + 5;

                        var k = 1;
                        for (var j = minChapter; j < (maxChapter + 1); j++) { // process every chapter
                            var isInChap = $scope.fns.preP.isInChapChar($scope.personajes[i], j),
                                    fillGraph = isInChap ? 'red' : '#eee',
                                    angIni = iniAng + ((k - 1) * changAng),
                                    angEnd = iniAng + (k * changAng);
                            //set differrent colors 
                            var fillGraph = '#eee';
                            if (isInChap) {
                                if ($scope.datum.capitulos[j]) {
                                    if ($scope.status.lastSeason) {
                                        fillGraph = '#717171';
                                    } else {
                                        if (j > 13) {
                                            fillGraph = '#717171';
                                        } else {
                                            fillGraph = '#aaa';
                                        }
                                    }
                                }
                            }
                            // DRAW!!!
                            var path = null;
                            if ($scope.status.lastSeason) {
                                path = $scope.raphaelstaticsChaps3.path(rphArc(angIni, angEnd, cX, cY, targetRad - 2, 10))
                                        .attr({'stroke-width': 1, 'stroke': 'white', 'fill': fillGraph});
                            } else {
                                path = $scope.raphaelstaticsChaps.path(rphArc(angIni, angEnd, cX, cY, targetRad - 2, 10))
                                        .attr({'stroke-width': 1, 'stroke': 'white', 'fill': fillGraph});
                            }

                            if (isInChap && $scope.datum.capitulos[j]) {
                                path.node.setAttribute('class', 'in-chapter'); // only when the character is in the chapter, the path will be binded with this class
                            }
                            $(path.node).data({cX: cX, cY: cY, chapt: j}); //cache object info to use when hovering

                            k++;
                        }
                        ;
                    }
                    ;
                }
                ;
            }
            ;
            //bind hover over chapters element
            $('.in-chapter').hover(function(e) {
                var $this = $(this), // the object
                        data = $this.data(), // the data cached in the object
                        ang = (data.chapt + 0.5) * 2 * Math.PI / (numChapters - 1), // calculates the direction of the translation
                        tX = 3 * Math.sin(ang),
                        tY = 3 * Math.cos(ang), // .. and the coordinates
                        transform = 'translate(' + tX + ' ' + -tY + ')', // set the transformation
                        $ttip = $('#tooltip');

                var temporada = 3, posL = e.pageX - 180;
                if (!$scope.status.lastSeason) {
                    if (data.chapt > 13) { // differentiate between first and second season
                        temporada = 2, posL = e.pageX - 180;
                    } else {
                        temporada = 1, posL = e.pageX - 20;
                    }
                }

                $ttip.css({left: posL, top: e.pageY - 40}).show().delay(3000).fadeOut(400).find('.ttip-season').html(temporada);
                $ttip.find('.ttip-chap').html(data.chapt);
                $ttip.find('a').attr('href', $scope.datum.capitulos[data.chapt]);
                $(this).attr('transform', transform); // draw, update and show tootltip
            }, function() {
                $(this).attr('transform', ''); // clear css transformation
            });
        },
        toggleChaptStats: function() {
            if ($scope.status.lastSeason) {
                $scope.status.staticsChapt3 = !$scope.status.staticsChapt3;
            } else {
                $scope.status.staticsChapt = !$scope.status.staticsChapt;
            }
        } //show / hide statats

    };

    /*___-_ characterlist search methods _-________________*/
    $scope.fns.search = {//everything related to the 
        filterCorona: ['todos', 'castilla', 'portugal', 'nazari', 'flandes', 'inglaterra', 'vaticano', 'francia'],
        filterCoronaAct: 'todos',
        filterTemp: ['todas', 'primera', 'segunda', 'tercera'], //set defaults
        filterTempAct: 'todas',
        filters: function(element) { // combine the different filters
            if (element.deleted)
                return false;
            if ($scope.fns.search.filterCoronaAct === 'todos' && $scope.fns.search.filterTempAct === 'todas')
                return true;
            if ($scope.fns.search.filterTempAct === 'primera' && !element.TEMPORADA1)
                return false;
            if ($scope.fns.search.filterTempAct === 'segunda' && !element.TEMPORADA2)
                return false;
            if ($scope.fns.search.filterTempAct === 'tercera' && !element.TEMPORADA3)
                return false;
            if ('todos' === $scope.fns.search.filterCoronaAct)
                return true;
            if (element.esferacoronas !== $scope.fns.search.filterCoronaAct)
                return false;
            return true;
        },
        filtersClean: function() {
            $scope.fns.search.filterCoronaAct = 'todos';
            $scope.fns.search.filterTempAct = 'todas';
        },
        togglecharlist: function() {
            if ($scope.status.list) {
                $scope.status.list = '';
            } else {
                $scope.status.list = 'list';
                $scope.status.staticsChapt = null;
                $scope.status.staticsChapt3 = null;
                $scope.status.statics = null;
            }
            ;
            return false;
        }
    };

    /*___-_ Data preprocessing _-________________*/
    $scope.fns.preP = {
        processData: function(data) {
            //process each character, and generate a chapters list
            for (var i = 0; i < data.length; i++) {
                if (i === 82)
                    console.log(data[i]);
                var capsArray = $scope.fns.preP.processCapitulos(data[i]['TEMPORADA1']);
                capsArray = capsArray.concat($scope.fns.preP.processCapitulos(data[i]['TEMPORADA2']));
                var caps3Array = $scope.fns.preP.processCapitulos(data[i]['TEMPORADA3']);
                data[i].id = i;
                data[i].caps = capsArray;
                data[i].caps3 = caps3Array;
                data[i].sferasRel = {'a': [], 'e': [], 'f': [], 'F': []};
                data[i].sferasRel3 = {'a': [], 'e': [], 'f': []};
                data[i].realSferasGroup = {'a': [], 'e': []};
                data[i].realSferas = data[i]['esferas'].split(',');
                data[i].realSferasType = data[i]['esferastype'].split(',');
                data[i].realSferas3 = data[i]['esferas3'].split(',');
                data[i].realSferasType3 = data[i]['esferastype3'].split(',');
                $scope.personajes.push(data[i]);
            }
            ;
            //process relaciones names and get the id's
            for (var i = 0; i < $scope.personajes.length; i++) {
                //$scope.personajes[i].relaciones = $scope.fns.preP.processRelaciones($scope.personajes[i]['RELACIONES']);
                //$scope.personajes[i].circles = $scope.personajes[i]['circulo'].split(',');
                $scope.personajes[i].realSferas = $scope.personajes[i]['esferas'].split(',');
                $scope.personajes[i].realSferasType = $scope.personajes[i]['esferastype'].split(',');
                $scope.personajes[i].realSferas3 = $scope.personajes[i]['esferas3'].split(',');
                $scope.personajes[i].realSferasType3 = $scope.personajes[i]['esferastype3'].split(',');
                $scope.fns.preP.processRelacionesFix($scope.personajes[i]);
                $scope.personajes[i].safeUrl = $scope.fns.getUrl($scope.personajes[i]['PERSONAJE']);
                $scope.personajes[i].circsAct = false;
                $scope.fns.preP.processEsferasRel($scope.personajes[i]);
            }
            ;
        },
        //adds relations when other character are relater to him
        processRelacionesFix: function(character) {
            if (character.esferaid) { //if the character don't have an id exit
                for (var j = 0; j < $scope.personajes.length; j++) { //loop the characters ( again )
                    if ($scope.personajes[j] !== character) {
                        for (var k = 0; k < $scope.personajes[j].realSferas.length; k++) { //loop the realSferas array
                            if ($scope.personajes[j].realSferas[k] === character.esferaid && $scope.personajes[j].esferaid > 0) {
                                if (!$scope.fns.preP.isCharInSfera(character, $scope.personajes[j].esferaid)) {
                                    character.realSferas.push($scope.personajes[j].esferaid);
                                    character.realSferasType.push($scope.personajes[j].realSferasType[k]);
                                }
                            }
                        }
                        ;
                    }
                }
            }
        },
        //process a character and save him into the sferas array 
        processEsferasRel: function(character) {
            for (var i = 0; i < character.realSferas.length; i++) {
                if (character.realSferasType[i] === 'f' || character.realSferasType[i] === 'e' || character.realSferasType[i] === 'a' || character.realSferasType[i] === 'F') {
                    var relChar = $scope.fns.preP.getCharbySferaId(character.realSferas[i]);
                    character.sferasRel[character.realSferasType[i]].push(relChar);
                    switch (character.realSferasType[i]) {
                        case 'a':
                        case 'f':
                            character.realSferasGroup.a.push(relChar);
                            break;
                        case 'e':
                        case 'F':
                            character.realSferasGroup.e.push(relChar);
                            break;
                    }
                }
            }
            ;
            for (var i = 0; i < character.realSferas3.length; i++) {
                if (character.realSferasType3[i] === 'f' || character.realSferasType3[i] === 'e' || character.realSferasType3[i] === 'a') {
                    var relChar = $scope.fns.preP.getCharbySferaId(character.realSferas3[i]);
                    character.sferasRel3[character.realSferasType3[i]].push(relChar);
                    /*switch (character.realSferasType3[i]) {
                     case 'a':
                     case 'f':
                     character.realSferasGroup.a.push(relChar);
                     break;
                     case 'e':                        
                     character.realSferasGroup.e.push(relChar);
                     break;
                     }*/
                }
            }
            ;
            return;
        },
        //return true if the character has the sferanum in his relations arrays
        isCharInSfera: function(character, sferaNum) {
            if (character.esferaid === sferaNum)
                return true;
            for (var i = 0; i < character.realSferas.length; i++) {
                if (character.realSferas[i] === sferaNum) {
                    return true;
                }
            }
            ;
            return false;
        },
        // find a character by his name
        getCharIdName: function(charName) {
            for (var i = 0; i < $scope.personajes.length; i++) {
                if ($scope.personajes[i].PERSONAJE === charName)
                    return $scope.personajes[i].id;
            }
            ;
        },
        // find a character with the given sferaId 
        getCharbySferaId: function(sferaId) {
            for (var i = 0; i < $scope.personajes.length; i++) {
                if ($scope.personajes[i].esferaid === sferaId)
                    return $scope.personajes[i];
            }
            ;
        },
        // return an array of chapters given a chapter string in the form of (num - num - ...)
        processCapitulos: function(capsString) {
            var capsArray = [];
            while (capsString.length) {
                var newChapter = parseInt(capsString);
                capsArray.push(newChapter);
                capsString = capsString.substring(newChapter.toString().length + 3);
            }
            return capsArray;
        },
        //return true if the character appears in the chapter
        isInChapChar: function(character, chapter) {
            var caps = [];
            if ($scope.status.lastSeason) {
                caps = character.caps3;
            } else {
                caps = character.caps;
            }
            for (var i = 0; i < caps.length; i++) {
                if (caps[i] === chapter)
                    return true;
            }
            ;
            return false;
        }
    };

    /*___-_ other helper functions _-________________*/
    //search for the personaje associated with the url
    $scope.fns.getCharByUrl = function(charUrl) {
        for (var i = 0; i < $scope.personajes.length; i++) {
            if ($scope.personajes[i].safeUrl === charUrl)
                return $scope.personajes[i];
        }
    };

    //process urls characters
    $scope.fns.getUrl = function(str) {
        str = str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
        str = str.replace(new RegExp("[áÁ]", "g"), 'a');
        str = str.replace(new RegExp("[éÉ]", "g"), 'e');
        str = str.replace(new RegExp("[Íí]", "g"), 'i');
        str = str.replace(new RegExp("[Óó]", "g"), 'o');
        str = str.replace(new RegExp("[Úú]", "g"), 'u');

        str = str.replace(new RegExp("[ñÑ]", "g"), 'n');
        return encodeURIComponent(str.replace(new RegExp(" ", "g"), "-")).toLowerCase();
    };

}
/*-________- other angular elements -___________________-*/
//directuve to fix strings displayed in <p>'s
angular.module('paragraphFix', []).
        filter('paragraphFix', function() {
            return function(text) {
                if (!text || !text.length)
                    return;
                return  '<p>' + text.replace(/\\n\\r\\n\\r/g, '</p><p>').replace(/\\n\\r/g, '<br />') + '</p>';
            };
        });
//add prevent default behaviour to inner links
isb.directive('preventDef', function() {
    return function(scope, element, attrs) {
        $(element).click(function(event) {
            event.preventDefault();
            return false;
        });
    };
}); //- See more at: http://cloverink.net/how-to-preventdefault-on-anchor-tags-in-angularjs/#sthash.t3qplO8I.dpuf

/*-________- basic jquery onload work -___________________-*/
$('.menu-main').bind('click', function() {
    return false;
}); //prevent default for menu links
$('.legend-block tr:eq(2) td:eq(0)').click(function() {
    $('#toggle-statics').addClass('act');
}); // mistery
$('#tooltip').mouseleave(function() { //tooltips basic behaviour
    $(this).fadeOut(400);
});

//switch between zoom and no zoom
$('#panzoom').click(function() {
    var $this = $(this);
    if ($this.parent().hasClass('act')) {        
        $this.html('');        
        $('.main-wrap').removeClass('zooming').panzoom('resetPan').panzoom('reset').panzoom('disable');
        $this.parent().removeClass('act');
    } else {        
        $this.html('');
        var winWidth = $(window).width(), winHeight = $(window).height() - 130, objWidth = 1400, objHeight = 1220,
                scaleW = winWidth / objWidth, scaleH = winHeight / objHeight,
                scale = scaleW < scaleH ? scaleW : scaleH;
        $('.main-wrap').addClass('zooming').panzoom();
        $('.main-wrap').panzoom('enable').panzoom('resetPan').panzoom("zoom", scale, {animate: true, middle: {pageX: 0, pageY: 100}});        
        $('#panzoom2').addClass('act');
        $this.parent().addClass('act');
    }
    return false;
});

var imageExists = function(imgUrl) {
    var http = new XMLHttpRequest();

    http.open('HEAD', imgUrl, false);
    http.send();

    return http.status !== 404;
};

/* Microlibería para generación de tramos de arcos https://github.com/drlz/vGCal */
//simplifica angulos (elimina vueltas extras) 
var aSimpli = function(ang) {
    if (ang > 2 * Math.PI) {
        ang = ang % (Math.floor(ang / (2 * Math.PI)) * 2 * Math.PI);
        return ang;
    }
    ;
    if (ang < -(2 * Math.PI)) {
        ang = ang % (Math.ceil(ang / (2 * Math.PI)) * 2 * Math.PI);
        return ang;
    }
    ;
    return ang;
};

/*generador de arcos -> devuelve trazado! 
 (angulo de inicio del arco (rad),
 angulo final del arco,
 centro_x en pixeles,
 centro_y en pixeles,
 radio interior en pixeles,
 grosor del arco en pixeles
 ) */
var rphArc = function(a_start, a_end, centro_x, centro_y, radio, grosor) {

    //si uno de los dos arcos es > que un círculo quitamos las vueltas extras
    var a_start = aSimpli(a_start),
            a_end = aSimpli(a_end);

    //generamos desde el angulo menor al mayor
    if (a_start > a_end) {
        var tmp = a_end;
        a_end = a_start;
        a_start = tmp;
    }

    //valor de svg large-arc-flag
    a_end - a_start > Math.PI ? large = 1 : large = 0;

    var radio2 = radio + grosor,
            path = 'M' + (centro_x + Math.cos(a_start) * radio) + ',' + (centro_y + Math.sin(a_start) * radio) +
            ' A' + radio + ',' + radio + ' 0 ' + large + ',1 ' + (centro_x + Math.cos(a_end) * radio) + ',' + (centro_y + Math.sin(a_end) * radio) +
            ' L' + (centro_x + Math.cos(a_end) * radio2) + ',' + (centro_y + Math.sin(a_end) * radio2) +
            ' A' + radio2 + ',' + radio2 + ' 0 ' + large + ',0 ' + (centro_x + Math.cos(a_start) * radio2) + ',' + (centro_y + Math.sin(a_start) * radio2) + 'Z';
    return path;
};
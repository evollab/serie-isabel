<?php
setlocale(LC_ALL, "es_ES");

function parse_csv($csv_string, $delimiter = ",", $skip_empty_lines = true, $trim_fields = false) {
    $enc = preg_replace('/(?<!")""/', '!!Q!!', $csv_string);
    $enc = preg_replace_callback(
            '/"(.*?)"/s', function ($field) {
        return urlencode(utf8_encode($field[1]));
    }, $enc
    );
    $lines = preg_split($skip_empty_lines ? ($trim_fields ? '/( *\R)+/s' : '/\R+/s') : '/\R/s', $enc);
    return array_map(
            function ($line) use ($delimiter, $trim_fields) {
        $fields = $trim_fields ? array_map('trim', explode($delimiter, $line)) : explode($delimiter, $line);
        return array_map(
                function ($field) {
            return str_replace('!!Q!!', '"', utf8_decode(urldecode($field)));
        }, $fields
        );
    }, $lines
    );
}

;

function getUrl($s) {
    $s = str_replace("Ñ", "n", $s);
    $s = str_replace("Á", "a", $s);
    $s = str_replace("É", "e", $s);
    $s = str_replace("Í", "i", $s);
    $s = str_replace("Ó", "o", $s);
    $s = str_replace("Ú", "u", $s);
    $s = str_replace("ñ", "n", $s);
    $s = str_replace("á", "a", $s);
    $s = str_replace("é", "e", $s);
    $s = str_replace("í", "i", $s);
    $s = str_replace("ó", "o", $s);
    $s = str_replace("ú", "u", $s);
    $s = str_replace(" ", "-", $s);
    $s = strtolower($s);
    return $s;
}

;

$fila = 1;

//find a character pattern in the url
$urlArray = explode('/', $_SERVER['REQUEST_URI']);
$isCharacter = false;
foreach ($urlArray as $key => $value) {
    if ($isCharacter) {
        $characterUrl = $value;
        break;
    } else {
        if ($value == 'personaje')
            $isCharacter = true;
    };
    $characterUrl = false;
}

//check if the url correspongs to a character and save it
$charfinal = array();
$file = fopen('data/isb.csv', "r");
//$charactersCSV = parse_csv(file_get_contents('data/isb.csv'));
$firstLine = true;
$initialOne = 0;
while (($arr = fgetcsv($file, 1000, ",")) !== FALSE) {
    if ($firstLine) {
        $firstLine = false;
    } else {
        $arr = str_replace("'", "\'", $arr);
        if (strlen($arr[13])) {
            $charfinal[$arr[13]] = $arr;
        } else {
            $charfinal[(10000 + $initialOne)] = $arr;
        }
        if (getUrl($arr[1]) == $characterUrl) {
            $char = $arr;
        }
    }
    $initialOne = $initialOne + 1;
}
ksort($charfinal);
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!--[if lt IE 9]>
        <script src="/serie-isabel/personajes/js/html5shiv.js"></script>
        <![endif]-->
        <meta charset="utf-8">
        <meta name="robots" content="index,follow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Content-Language" content="es-es">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="lab.rtve.es">

        <meta name="Keywords" content="serie isabel, personajes serie isabel, actores serie isabel, imágenes personajes serie isabel">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@rtve">
        <meta name="twitter:creator" content="@lab_rtvees">
        <meta property="og:site_name" content="Mapa de personajes de la serie Isabel - Lab RTVE.es"/>
        <?php
        if (isset($char)) { //print the url character
            ?>
            <title>Personaje <?php print $char[1]; ?> en la serie Isabel, interpretado por <?php print $char[2]; ?> - Lab RTVE.es</title>
            <meta name="description" content="<?php print $char[2]; ?> interpreta a <?php print $char[1]; ?> en la serie Isabel. <?php print substr($char[20], 0, 100); ?>...">
            <meta name="twitter:title" content="Personaje <?php print $char[1]; ?> en la serie Isabel, interpretado por <?php print $char[2]; ?>">
            <meta name="twitter:description" content="<?php print $char[2]; ?> interpreta a <?php print $char[1]; ?> en la serie Isabel. <?php print substr($char[20], 0, 100); ?>...">
            <meta name="twitter:image" content="http://lab.rtve.es/serie-isabel/personajes/img/fotos/<?php print $char[17]; ?>">
            <meta property="og:title" content="Personaje <?php print $char[1]; ?> en la serie Isabel, interpretado por <?php print $char[2]; ?>"/>
            <meta property="og:image" content="http://lab.rtve.es/serie-isabel/personajes/img/fotos/<?php print $char[17]; ?>"/>
            <meta property="og:description" content="<?php print $char[2]; ?> interpreta a <?php print $char[1]; ?> en la serie Isabel. <?php print substr($char[20], 0, 100); ?>..."/> 
            <meta property="og:url" content="http://lab.rtve.es/serie-isabel/personajes/personaje/<?php print getUrl($char[1]); ?>"/>
            <?php
        } else { //print all characters
            ?>
            <title>Mapa de personajes de la serie Isabel - Lab RTVE.es</title>
            <meta name="description" content="Conoce a los personajes de la serie Isabel con toda la información clasificada en los distintos bandos y de forma interactiva donde podrás conocer la relación entre los personajes">
            <meta name="twitter:title" content="Mapa de personajes de la serie Isabel - Lab RTVE.es">
            <meta name="twitter:description" content="Todas las relaciones entre los personajes de la serie y sus apariciones en los distintos capítulos de la serie">
            <meta name="twitter:image" content="http://lab.rtve.es/serie-isabel/personajes/img/thumbnail.jpg">
            <meta property="og:title" content="Mapa de personajes de la serie Isabel - Lab RTVE.es"/>
            <meta property="og:image" content="http://lab.rtve.es/serie-isabel/personajes/img/thumbnail.jpg"/>
            <meta property="og:description" content="Todas las relaciones entre los personajes de la serie y sus apariciones en los distintos capítulos de la serie"/>
            <?php
        }; //end if
        ?>
        <base href="/serie-isabel/personajes/"/>
        <link rel="stylesheet" href="/serie-isabel/personajes/css/styles.css">
        <link rel="stylesheet" href="/serie-isabel/personajes/css/styles-t3.css">
        <link rel="stylesheet" href="http://www.rtve.es/css/tipografias.css">
        <script src="/serie-isabel/personajes/js/modernizr-custom.js"></script>
        <script type="text/javascript" src="//www.rtve.es/js/mushrooms/rtve_mushroom.js" ></script>
    </head>
    <body ng-app="isb" ng-controller="isbController">

    <main id="nojschar">
        <?php
        if (isset($char)) { //print the url character
            ?>
            <article style="clear: both; float: left; ">
                <?php if (strlen($char[17])): ?>
                    <img src="/serie-isabel/personajes/img/fotos/<?php print $char[17]; ?>" alt="<?php print $char[1]; ?>" title="Fotografía de <?php print $char[1]; ?> en la serie Isabel">
                <?php endif; ?>
                <h1>
                    <?php if (strlen($char[5])): ?>
                        <a href="<?php print $char[5]; ?>"><?php print $char[1]; ?></a>
                    <?php
                    else: print $char[1];
                    endif;
                    ?>
                </h1>
                <?php if (strlen($char[2])): ?>
                    <p>Interpretado por <?php print $char[2]; ?></p>
    <?php endif; ?>
                <p><?php print $char[20]; ?></p>
            </article>
            <nav><a href="/serie-isabel/personajes/" title="Muestra listado completo de personajes">ver todos</a> </nav>
            <?php
        } else { //print all characters
            ?>
            <article>
                <h1>Mapa de personajes de la serie Isabel, segunda temporada</h1>
                <p>Presentación del arbol de personajes de Isabel</p>
            </article>
            <?php
            foreach ($charfinal as $key => $value):
                if (!strlen($value[10])):
                    ?>
                    <article>
                        <?php if (strlen($value[17])): ?>
                            <img src="/serie-isabel/personajes/img/fotos/<?php print $value[17]; ?>" alt="<?php print $value[1]; ?>" title="Fotografía de <?php print $value[1]; ?> en la serie Isabel">
            <?php endif; ?>
                        <h2>
                            <a href="/serie-isabel/personajes/personaje/<?php print getUrl($value[1]); ?>" Title="Más información del personaje de la serie"><?php print $value[1]; ?></a>
                        </h2>
                        <?php if (strlen($value[2])): ?>
                            <p>Interpretado por <?php print $value[2]; ?>. <?php print substr($value[20], 0, 120); ?>...</p>
                    <?php endif; ?>
                    </article>
                    <?php
                endif;
            endforeach;
        }; //end if
        ?>

    </main>
    <script>
                var preLoad = document.createElement('div'),
                        nojs = document.getElementById('nojschar');
                if (nojs) {
                    nojs.style.width = 1;
                    nojs.style.height = 1;
                    nojs.style.overflow = 'hidden';
                }
                preLoad.setAttribute('id', 'preload');
                /*if (!Modernizr.svg || !Modernizr.svgclippaths) {
                 preLoad.innerHTML = '<div id="pre-wrap"><h2>Lo sentimos,<br/> pero su navegador no soporta las<br/>  tecnologías necesarias para visualizar <br/> corréctamente la página.</h2></div>';
                 preLoad.setAttribute('id','no-preload');
                 } else {*/
                preLoad.innerHTML = '<div id="pre-wrap"><div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div><h2>Cargando</h2></div>';
                // }
                document.body.appendChild(preLoad)
    </script>
    <header id="lab-header" class="clearfix">
        <div class="logo"><a target="_self" href="http://lab.rtve.es/" title="Visita la web del laboratorio de innovación audiovisual de RTVE.es">RTVE.es</a></div>
        <div class="social-lockup">
            <a class="social-fbook" style="display: block;" href="http://www.facebook.com/sharer.php?u=http://lab.rtve.es/serie-isabel/personajes/" target="_blank"></a>
            <a class="social-twitter"  target="_blank" style="display: block;" href="https://twitter.com/intent/tweet?button_hashtag=lab_rtvees&amp;via=lab_rtvees&amp;text=Mapa de personajes de la serie Isabel, segunda temporada http://lab.rtve.es/serie-isabel/personajes/" data-lang="es" data-related="lab_rtvees" data-url="http://lab.rtve.es/serie-isabel/personajes/" via="lab_rtvees"></a>
        </div>
    </header>
    <nav id="isabel-menu">
        <a href="http://www.rtve.es/television/isabel-la-catolica/" target="_blank" class="logo wk-col-l" title="visita el especial de Isabel en RTVE">Isabel, la serie</a>
        <ul class="wk-col-l isb-links">
            <!--<li><a href="/isappcuadro">La rendición de granada</a></li>-->
            <li><a href="http://www.rtve.es/television/isabel-la-catolica/" title="Todos los capítulos e información en RTVE.es">Web oficial</a></li>
            <li><a target="_self" href="http://lab.rtve.es/serie-isabel/rendicion-de-granada" title="Comienza la segunda temporada de Isabel">La rendición de granada</a></li>
            <li><a href="#"  hm-tap="fns.interact.clickClearSfera()" ng-click="fns.interact.clickClearSfera()"  class="active">Mapa de personajes</a></li>
            <li><a target="_self" href="http://lab.rtve.es/serie-isabel/conquista-de-granada" title="Documental interactivo de las batallas de la guerra">La conquista de Granada</a></li>
        </ul>
    </nav>

    <div id="tooltip" style="display: none">
        <p>Temporada <span class="ttip-season"></span><br>Capítulo <span class="ttip-chap"></span></p>
        <a href="" target="_blank">Ver en rtve.es</a>
    </div>

    <div class="artifact-controls">
        <a href="#" id="togglefull" class="wk-col-r ft-awesome" style="display: none;" title="Ver en pantalla completa"></a>
        <div class="panzoom-links">
            <a href="#" id="panzoom" class="ft-awesome" title="Pulsa para alternar entre la vista completa y el zoom"></a>
        </div>
    </div>

    <div id="main-main">
        <main id="main">
            <div class="main-wrap">
                <nav id="legend-season3-topleft">
                    <a prevent-def href="#" hm-tap="fns.search.togglecharlist()" ng-click="fns.search.togglecharlist()" class="wk-col-l display-search">Ver listado completo de personajes</a>
                    <div class="wk-col-l" style="padding: 20px 10px 20px 0; clear: left">Mostrar</div>
                    <a prevent-def href="#" hm-tap="fns.interact.toggleSeason()" ng-click="fns.interact.toggleSeason()" id="toggle-season-stats" class="bl-toggler wk-col-l {{status.lastSeason && 'izqda'|| 'dcha'}}"
                       title="Alterna entre la visualización de temporadas">
                        <span class="wk-col-l {{status.lastSeason && 'act'|| ''}}">Temporada 3</span>
                        <span class="wk-col-r {{!status.lastSeason && 'act'|| ''}}">Temporadas Anteriores</span>
                    </a>
                </nav>
                <section ng-show="!status.lastSeason" class="char-tree {{status.charTreeHover && 'char-tree-hover'|| ''}}
                         {{(status.statics|| status.staticsChapt) && 'char-tree-noborder' || ''}}">
                    <!-- infografía inicial -->
                    <div class="main-title">Personajes de Isabel en Temporadas Anteriores</div>
                    <div class="char-tree-wrap">
                        <!-- fondo de circulos y títulos -->
                        <div class="sferas-circs">
                            <span id="title-castilla">CASTILLA <br>ISABELINA</span>
                            <span id="title-portugal">CASTILLA <br>PRO JUANA</span>
                            <span id="title-nazari">REINO<br>NAZARÍ</span>
                        </div>
                        <!-- dibujo svg de relaciones -->
                        <div id="sferas-raphael"></div>
                        <!-- dibujo svg de estadísticas relaciones -->
                        <div id="sferas-raphaelstatics" ng-show="status.statics"></div>
                        <!-- dibujo svg de estadísticas capitulos-->
                        <div id="sferas-raphaelstatics-chaps" ng-show="status.staticsChapt"></div>
                        <!-- la infografía en si -->
                        <div id="sferas-main">
                            <div ng-repeat="personaje in personajes| filter: fns.interact.basicCharFiltro" 
                                 class="bl-char-circ char-{{personaje.id}} bl-char-circ-lev{{personaje.esferalevels}} bl-char-circ-cor-{{personaje.esferacoronas}}
                                 {{(personaje.actSfera|| status.activeSfera.id == personaje.id) && 'act-sfera' || ''}}
                                 {{(status.activeSfera.id == personaje.id) && 'main-sfera act-sfera' || ''}}
                                 {{(status.charTreeHover.id == personaje.id) && 'act-sfera' || ''}}"
                                 ng-mouseenter="fns.interact.activateSfera(personaje)" ng-mouseout="fns.interact.clearActiveSfera()"
                                 hm-tap="fns.interact.activateSfera(personaje)" hm-doubletap="fns.interact.clickSfera(personaje)" ng-click="fns.interact.clickSfera(personaje)">
                                <div class="bl-char-img">
                                    <img ng-src="/serie-isabel/personajes/img/fotos/{{personaje.IMAGENES}}" height="100" width="100" alt="Imagen de {{personaje.PERSONAJE}}">
                                </div>
                                <h2>{{personaje.PERSONAJE}}</h2>
                            </div>
                        </div>

                        <!-- leyenda -->
                        <!--<div id="legend-topleft">
                          <a prevent-def href="#" hm-tap="fns.search.togglecharlist()" ng-click="fns.search.togglecharlist()" class="wk-col-l display-search">Ver listado completo de personajes</a>
                          <div class="wk-col-l" style="padding: 20px 10px 20px 0; clear: left">Mostrar por</div>
                          <a prevent-def href="#" hm-tap="fns.interact.toggleChaptStats()" ng-click="fns.interact.toggleChaptStats()" id="toggle-chapter-stats" class="bl-toggler wk-col-l {{status.staticsChapt && 'dcha' || ''}}"
                            title="Alterna entre la visualización de reinos y capítulos">
                            <span class="wk-col-l {{!status.staticsChapt && 'act' || ''}}">Alianzas</span>
                            <span class="wk-col-r {{status.staticsChapt && 'act' || ''}}">Apariciones</span>
                          </a>
                        </div>-->
                        <div id="legend-topright">
                            <!-- hidden statics -->
                            <a prevent-def href="#" hm-tap="fns.interact.toggleStatics()" ng-click="fns.interact.toggleStatics()" id="toggle-statics" class="bl-toggler {{status.statics && 'dcha'|| ''}}"
                               title="Alterna entre la visualización del cuadro y el fotograma de la serie">
                                <span class="wk-col-l">reinos</span>
                                <span class="wk-col-r act">sociabilidad</span>
                            </a>
                            <div class="legend-block">
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Isabelinos</th>
                                        <th>Pro Juana</th>
                                        <th>Nazaríes</th>
                                    </tr>
                                    <tr>
                                        <td><strong>Aliados</strong></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#dd1442" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#01a7c1" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#cc9600" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                    </tr>
                                    <tr>
                                        <td>familia</td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#dd1442" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#01a7c1" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="#cc9600" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Enemigo</strong></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            </svg></td>
                                    </tr>
                                    <tr>
                                        <td>familia</td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                        <td><svg width="60" height="15">
                                            <path fill="none" stroke="black" d="M0,7L60,7" stroke-width="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);stroke-dasharray: 4px, 4px;"></path>
                                            </svg></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="legend">
                        </div>
                    </div>
                </section>

                <!-- ficha de persoinajes -->
                <section ng-cloak id="char-data" class="{{status.activeSfera && 'act'|| ''}}">
                    <div class="char-data-wrap">
                        <!-- bloque izquierdo de relaciones -->
                        <div class="sferas-info">
                            <!-- relaciones: aliados -->
                            <div class="sfera-friends clearfix">
                                <h3 ng-show="status.activeSfera.realSferasGroup.a.length">Aliados:</h3>
                                <a href="#" prevent-def ng-repeat="rel in status.activeSfera.realSferasGroup.a" title="{{rel.PERSONAJE}}"
                                   class="wk-col-l bl-char bl-char-rel bl-char-circ-lev3 bl-char-circ-cor-{{rel.esferacoronas}}" hm-tap="fns.interact.clickSfera(rel)" ng-click="fns.interact.clickSfera(rel)">
                                    <div class="bl-char-img">
                                        <img ng-src="/serie-isabel/personajes/img/fotos/{{rel.IMAGENES}}" height="160" width="130" alt="Imagen de {{rel.PERSONAJE}}">
                                    </div>
                                </a>
                            </div>
                            <!-- relaciones: familia -->
                            <div class="sfera-famili clearfix sfera-famili-no-famili">
                                <!-- foto personaje activo (si no esta en los personajes de la grafica inicial) -->
                                <div ng-hide="status.activeSfera.initialChar" class="bl-char-circ bl-char-circ-lev3 bl-char-circ-cor-{{status.activeSfera.esferacoronas}}
                                     act-sfera main-sfera">
                                    <div class="bl-char-img">
                                        <img ng-src="/serie-isabel/personajes/img/fotos/{{status.activeSfera.IMAGENES}}" height="100" width="100" alt="Imagen de {{status.activeSfera.PERSONAJE}}">
                                    </div>
                                </div>
                            </div>
                            <!-- relaciones: enemigos -->
                            <div class="sfera-enemis clearfix">
                                <h3 ng-show="status.activeSfera.realSferasGroup.e.length">Enemigos:</h3>
                                <a href="#" prevent-def ng-repeat="rel in status.activeSfera.realSferasGroup.e" title="{{rel.PERSONAJE}}"
                                   class="wk-col-l bl-char bl-char-rel bl-char-circ-lev3 bl-char-circ-cor-{{rel.esferacoronas}}" hm-tap="fns.interact.clickSfera(rel)" ng-click="fns.interact.clickSfera(rel)">
                                    <div class="bl-char-img">
                                        <img ng-src="/serie-isabel/personajes/img/fotos/{{rel.IMAGENES}}" height="160" width="130" alt="Imagen de {{rel.PERSONAJE}}">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- textos de la ficha -->
                        <div class="char-info">
                            <a prevent-def href="#" hm-tap="fns.interact.clickClearSfera()" ng-click="fns.interact.clickClearSfera()" class="wk-col-r sferas-info-close">Cerrar</a>
                            <h2>{{status.activeSfera.PERSONAJE}}</h2>
                            <div class="wk-col-r social-links">
                                <a class="social-fbook wk-col-r" href="http://www.facebook.com/sharer.php?u=http://lab.rtve.es/serie-isabel/personajes/personaje/{{status.activeSfera.safeUrl}}" target="_blank">Hacer like al personaje en Facebook</a>
                                <a class="social-twitter wk-col-r" href="https://twitter.com/intent/tweet?button_hashtag=lab_rtvees&amp;via=lab_rtvees&amp;text={{status.activeSfera.PERSONAJE}} en Isabel, la serie http://lab.rtve.es/serie-isabel/personajes/personaje/{{status.activeSfera.safeUrl}}" data-lang="es" data-related="lab_rtvees" data-url="/serie-isabel/personajes/personajes/{{status.activeSfera.safeUrl}}" via="lab_rtvees" target="_blank">Twittear al personaje</a>
                            </div>
                            <h3>{{status.activeSfera.SubTitle}}</h3>
                            <a ng-hide="!status.activeSfera.LINKS" ng-href="{{status.activeSfera.LINKS}}" target="_blank" class="wk-col-r sferas-info-link">Ver ficha completa</a>
                            <p ng-hide="!status.activeSfera.ACTORES" style="color: #bd1b42">Interpretado por {{status.activeSfera.ACTORES}}</p>
                            <div ng-bind-html-unsafe="status.activeSfera.Body | paragraphFix"></div>
                        </div>
                    </div>
                </section>

                <!-- Buscador de personajes -->
                <section ng-show="status.list" id="characters-search" class="char-srch char-srch-{{status.list}}">
                    <div class="char-srch-wrap">
                        <a href="#" prevent-def hm-tap="fns.search.togglecharlist()" ng-click="fns.search.togglecharlist()" class="wk-col-r sferas-info-close">Cerrar</a>
                        <h2>Listado completo de personajes</h2>
                        <!-- filtros -->
                        Filtro Corona <select ng-model="fns.search.filterCoronaAct" ng-options="c for c in fns.search.filterCorona"></select>
                        Filtro temporada <select ng-model="fns.search.filterTempAct" ng-options="c for c in fns.search.filterTemp"></select>
                        <a href="#" prevent-def hm-tap="fns.search.filtersClean()" ng-click="fns.search.filtersClean()">Limpiar filtros</a>
                        <a href="#" prevent-def id="toggle-search" hm-tap="fns.interact.toggleSrchList()" ng-click="fns.interact.toggleSrchList()" class="wk-col-r bl-toggler" title="Alterna entre la visualización del cuadro y el fotograma de la serie">
                            <span class="wk-col-l">lista</span>
                            <span class="wk-col-r act">fotos</span>
                        </a>
                        <!-- listado -->
                        <div class="bl-characters">
                            <div ng-repeat="personaje in personajes| orderBy: 'PERSONAJE' | filter: fns.search.filters" 
                                 class="wk-col-l bl-char" hm-tap="fns.interact.clickSfera(personaje)" ng-click="fns.interact.clickSfera(personaje)">
                                <img ng-src="/serie-isabel/personajes/img/fotos/{{personaje.IMAGENES}}" height="160" width="130" alt="Imagen de {{personaje.PERSONAJE}}">
                                <div class="char-srch-text">
                                    <p>{{personaje.PERSONAJE}}</p>
                                    <p style="font-size: 0.8em">{{personaje.ACTORES}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section ng-show="status.lastSeason" class="char-tree {{status.lastSeason && 'last-season' || ''}}">
                    <div class="main-title">Personajes de Isabel en la Tercera Temporada</div>
                    <div id="third-season-charter-wrapper">
                        <div ng-repeat="personaje in personajes| filter: fns.interact.basicCharFiltro"  
                             class="bl-char-circ char-{{personaje.id}} bl-char-circ-lev{{personaje.esferalevels}} bl-char-circ-cor-{{personaje.esferacoronas}}
                             {{(personaje.actSfera|| status.activeSfera.id == personaje.id) && 'act-sfera' || ''}}
                             {{(status.activeSfera.id == personaje.id) && 'main-sfera act-sfera' || ''}}
                             {{(status.charTreeHover.id == personaje.id) && 'act-sfera' || ''}}"
                             ng-mouseenter="fns.interact.activateSfera(personaje)" ng-mouseout="fns.interact.clearActiveSfera()"
                             hm-tap="fns.interact.activateSfera(personaje)" hm-doubletap="fns.interact.clickSfera(personaje)" ng-click="fns.interact.clickSfera(personaje)">
                            <div class="bl-char-img">
                                <img ng-src="/serie-isabel/personajes/img/fotos/{{personaje.IMAGENES}}" height="100" width="100" alt="Imagen de {{personaje.PERSONAJE}}">
                            </div>
                            <h2>{{personaje.PERSONAJE}}</h2>
                        </div>
                    </div>                                           
                </section>
            </div>
        </main>
    </div>

    <footer id="lab-footer" class="lab-footer-fixed">
        <ul>
            <li>Copyright 2013 RTVE.es</li>
            <li>· <a href="https://twitter.com/lab_rtvees">SÍGUENOS EN TWITTER</a></li>
        </ul>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular-sanitize.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
    <script src="/serie-isabel/personajes/js/raphael-min.js" charset="utf-8"></script>
    <script src="/serie-isabel/personajes/js/jquery.panzoom.js" charset="utf-8"></script>
    <script src="/serie-isabel/personajes/js/hammer.min.js" charset="utf-8"></script>
    <script src="/serie-isabel/personajes/js/angular-hammer.js" charset="utf-8"></script>
    <script src="/serie-isabel/personajes/js/lib.js"></script>
    <script src="/serie-isabel/personajes/js/base.js"></script>
</body>
</html>
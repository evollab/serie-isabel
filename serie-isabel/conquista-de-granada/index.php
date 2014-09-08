<?php
setlocale(LC_ALL,"es_ES");

ini_set('display_errors', 0);

$url = $_SERVER['REQUEST_URI']; // get the current page url
$baseUrl = '/serie-isabel/conquista-de-granada'; // the folder of the page
$realUrl = substr($url, strlen($baseUrl)); // save the url without the folders 
if(substr($realUrl, -1) == '/') $realUrl = substr($realUrl, 0, strlen($realUrl)-1); // remove / bar at the end of the url
  
// look if last part of the url is Boabdil or Isabel and Save it
$urlExplode = explode('/',$realUrl);
$lastPartUrl = end($urlExplode);

  // load the SEO data and get the validc
$filecont = file_get_contents('js/seo.json'); // load the seo data
$seoInfo = json_decode($filecont); 
$slideActive = -1;

if(!isset($seoInfo)){ // si falla la carga del archivo
  $seoData = array(
    'title'=> "La conquista de granada | lab RTVE.es",
    'description'=> 'descrips fallo archivo',
    'body'=> 'Body error arhivo'
  );
} else {  // carga del archivo ok
  foreach ($seoInfo->slides as $key => $urlInfo) { // buscamos el patrón de la url
    if($urlInfo->url == $realUrl) {
      $seoData = $urlInfo; // si lo encuentra, guardamos los datos
      $slideActive = $key;
    }
  }
  if(!isset($seoData)) { // si no lo encuentra, guardamos los genéricos
    $seoData = $seoInfo->slides[0];
  }
}

//print_r($seoData);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie ie6 oldie" lang="es-es"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie ie7 oldie" lang="es-es"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie ie8 oldie" lang="es-es"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js ie" lang="es-es"> <![endif]-->
<!--[if !IE ]><!--><html class="no-js" lang="es-es"><!--<![endif]-->
<!--[if !IE]><!--><script>  
if (/*@cc_on!@*/false) {  
    document.documentElement.className+=' ie';  
}  
</script><!--<![endif]--> 
<head>
  <!--[if lt IE 9]>
    <script src="/serie-isabel/conquista-de-granada/js/html5shiv.js"></script>
  <![endif]-->
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Content-Language" content="es-es">

  <title><?php echo $seoData->title ?> | lab.RTVE.es</title>
  <meta name="description" content="<?php echo $seoData->description ?>">
  <meta name="Keywords" content="Reconquista, historia, españa, serie-isabel, lab, webdoc">
  <meta name="author" content="lab.rtve.es">
  <meta property="og:title" content="<?php echo $seoData->title ?>">
  <meta property="og:description" content="<?php echo $seoData->description ?>">
  <meta property="og:image" content="http://lab.rtve.es/serie-isabel/conquista-de-granada/screenshoot.jpg">
  <meta property="og:url" content='http://lab.rtve.es/serie-isabel/conquista-de-granada<?php echo $realUrl;?>'>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@rtve">
  <meta name="twitter:creator" content="@lab_rtvees">
  <meta name="twitter:title" content="<?php echo $seoData->title ?> | lab.RTVE.es">
  <meta name="twitter:description" content="<?php echo $seoData->description ?>">
  <meta name="twitter:image" content="http://lab.rtve.es/serie-isabel/conquista-de-granada/screenshoot.jpg">

  <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" href="http://www.rtve.es/css/tipografias.css">
  <link rel="stylesheet" href="/serie-isabel/conquista-de-granada/css/styles.css">
  <script type="text/javascript" src="//www.rtve.es/js/mushrooms/rtve_mushroom.js" ></script>

  <script src="/serie-isabel/conquista-de-granada/js/modernizr.js"></script>
</head>
<body>
  <main role="main" id="nojschar" class="clearfix">

    <?php if(isset($seoData)): //print the seo content  ?>
      <article style="clear: both; float: left; ">
        <h1><?php print $seoData->title;?></h1>
        <?php print $seoData->body;?>
      </article>
    <?php endif;?>

  </main>

  <noscript>
    <aside id="pre-wrap">Lo sentimos,<br/> necesita tener activados los scripts<br/> visualizar corréctamente la página.</aside>
  </noscript>
  <script>
  /* simula touch en browser
  document.getElementsByTagName("body")[0].className += ' touch';
  Modernizr.touch = true;*/
    var preLoad = document.createElement('div');
    var responsif = false;
    preLoad.setAttribute('id','preload');
    if (!Modernizr.svg || window.innerWidth < 800 || window.innerHeight < 500) {
      responsif = true;
      var d = document.getElementById('nojschar');
      d.style.display = "block";
      d.className += ' shown';
      document.getElementsByTagName("body")[0].className += ' fallback';
      document.write('<!--');
    } else {
      preLoad.innerHTML = '<div id="pre-wrap"><div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div><h2>Cargando</h2></div>';
      document.body.appendChild(preLoad);
      document.getElementById('nojschar').innerHTML = "";
    }
  </script>

  <header id="lab-header" class="">
    <div class="logo">
      <a href="http://lab.rtve.es/" title="Visita la web del laboriatorio de innovación audiovisual de RTVE.es">lab RTVE.es</a>
    </div>
    <div class="social-lockup">
      <a class="social-fbook" style="display: block;" href="http://www.facebook.com/sharer.php?u=http://lab.rtve.es/"  title="comparte el proyecto en Facebook" target="_blank"></a>
      <a class="social-twitter" title="comparte el proyecto en twitter" target="_blank" style="display: block;" href="https://twitter.com/intent/tweet?button_hashtag=lab_rtvees&amp;via=lab_rtvees&amp;text=Repasa los últimos proyectos del Laboratorio de RTVE.es http://lab.rtve.es/" data-lang="es" data-related="lab_rtvees" data-url="http://lab.rtve.es/" via="lab_rtvees"></a>
    </div>
  </header>

  <nav id="isabel-menu">
    <a href="http://www.rtve.es/television/isabel-la-catolica/" target="_blank" class="logo wk-col-l" title="visita el especial de Isabel en RTVE">Isabel, la serie</a>
    <ul class="wk-col-l isb-links">
      <li><a href="http://www.rtve.es/television/isabel-la-catolica/" title="Todos los capítulos e información en RTVE.es">Web oficial</a></li>
      <li><a target="_self" href="http://lab.rtve.es/serie-isabel/rendicion-de-granada" title="Comienza la segunda temporada de Isabel">La rendición de granada</a></li>
      <li><a target="_self" href="http://lab.rtve.es/serie-isabel/personajes">Mapa de personajes</a></li>
      <li>
        <a href="#" class="active go-link" href="/serie-isabel/conquista-de-granada/" data-id="initial" title="Vuelve al inicio del especial">La conquista de Granada</a>
      </li>
    </ul>
  </nav>

  <aside id="main">

    <section class="container">

      <div id="preload2" style="display: none;"><div id="pre-wrap"><div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div><h2>Cargando</h2></div></div>
      <div id="preload3" style="display: none;"><div id="pre-wrap"><span></span><br>Haz click para cargar el video</div></div>

      <article id="initial" class="element batalla opacity hidden">

        <div id="initial-paso-0" class="paso hidden" data="paso-0" 
          data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
            <div class="wrap-table" style="width: 100%">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="00-intro"></div>
              </div>
            </div>
          </div>
        </div>

        <div id="initial-paso-1" class="paso hidden" data="paso-1">
          <div class="paso-title paso-title-shown help">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1>La conquista de Granada</h1>
                <div class="main">Durante más de siete siglos, los reinos cristianos avanzan poco a poco hasta hacerse con el control de la península. Solo queda un último reducto del antiguo poder musulmán: el reino nazarí de Granada.</div>
                <p class="subtitle">Revive las batallas de la mano de sus protagonistas</p>
                <div class="character-select">
                  <a href="#" class="click-bando click-bando-cristiano" title="Selecciona a Isabel para que te cuente la Conquista de Granada">Isabel I,<br>reina de Castilla</a>
                  <div class="char-sel-mid">Elige entre el bando cristiano o<br>musulmán para adentrarte en el final<br>de la Reconquista.</div>
                  <a href="#" class="click-bando click-bando-arabe" title="Selecciona a Boabdil para que te cuente la Conquista de Granada">Boabdil, <br>rey de Granada</a>
                  <span class="otros">Para una mejor experiencia de usuario, te aconsejamos que navegues con google Chrome</span>
                </div>
              </div>
            </div>
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="help-right">Para profundizar en la historia y conocer los<br>hechos puedes consultar los monográficos que <br>encontrarás en el menú lateral</div>
          </div>
        </div>

      </article>
     
      <article id="extra-reconquista" class="element extra hidden">
        <div class="device">

          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

          <div class="swiper-container">
              <div class="swiper-wrapper">

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e0-intro-reconquista"></div>
                    </div>
                  </div>
                </div>

                <div id="extra-reconquista-paso-1" class="swiper-slide" data-slide="2" data-titulo="La Reconquista">
                  <div class="content-slide">

                      <div class="titGrad">
                        <h2>La Reconquista</h2>
                        <p>Los dispersos reinos del norte peninsular tardaron más de siete siglos en expulsar al ‘enemigo’ infiel, un proceso durante el cual se sentaron las bases de la España moderna: del reino de Asturias nació el de León y de éste el de Castilla, que acabaría convirtiéndose en el más importante de la zona. Sin embargo, el camino que lleva a la derrota del último reino musulmán en 1492 avanzó a duras penas, mermado por las luchas internas entre reinos y linajes cristianos. En el otro lado, la decadencia del Califato de Córdoba primero y de los imperios almorávide y almohade después, se debió en buena parte a guerras civiles entre los diversos grupos que componían Al-Andalus.
                        </p>
                      </div>

<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'La Batalla de Guadalete'" src="/serie-isabel/conquista-de-granada/img/reconquista/batalla_guadalete.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        La Batalla de Guadalete <br>
                        <span><strong>Salvador Martínez Cubells</strong></span>
                      </div> 
                    </div>
                  </div>
                </div>

<?php      //   <!-- Slide3 intro ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="2" data-titulo=" Los musulmanes acaban con la España visigoda" >
                  <div class="content-slide">
                      <img alt="cuadro 'Don Pelayo después de la derrota de Guadalete'" style="height:100%;width:auto;display:inline;margin-left:15%;float:left;" src="/serie-isabel/conquista-de-granada/img/reconquista/pelayo.jpg">         
                      <div style="float:left;width:30%;margin-top:6%;margin-left:10%;margin-bottom:auto;vertical-align:middle">
                        <h2 style="font-size:3em">  Los musulmanes acaban con la España visigoda</h2>
                        <p style="font-size:1.1em;margin-top:50px">La batalla de Guadalete (711) marca el fin de la España visigoda y el comienzo de la musulmana, con el ascenso fulgurante desde el norte de África de las tropas procedentes del Califato omeya de Damasco. Uno de los derrotados en esa contienda es el noble astur Pelayo, que se refugia en sus tierras como último foco de resistencia ante el vendaval musulmán.
                        <br/><br/>Su victoria once años después en la batalla de Covadonga le encumbrará como la figura mítica que marcó el inicio de la Reconquista. La realidad era, sin embargo, más simple: los bereberes en la vanguardia musulmana estaban más interesados en seguir su camino hasta Francia que en reprimir los pequeños focos que quedaban en los escarpados montes del norte de la península.
                        </p>
                      </div>
<?php      //   <!-- img ------------------------------------------------------> ?>
     
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt" style="left:18%">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Don Pelayo después de la derrota de Guadalete (S. XIX)<br>
                        <span><strong>Federico de Madrazo y Kuntz</strong>, Museo Nacional del Prado</span>
                      </div> 
                    </div>
                  </div>
                </div>  

<?php      //   <!-- Slide4 intro ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="3" data-titulo="Abderramán III, primer califa de Córdoba (Medina Azahara, 930)" >
                  <div class="content-slide">
                      <div class="titGrad">
                        <h2>
                          Abderramán III, primer califa de Córdoba (Medina Azahara, 930)</h2>
                        <p>
                          La caída del Califato de Damasco frente a los abasíes de Bagdad deja a Al Andalus como el único centro de poder de los omeyas, que forman un emirato independiente de la mano de Abderramán I en el año 750. Durante casi 300 años, Córdoba se convierte en el centro de la España musulmana, con hegemonía política frente a una España cristiana que hace tímidos intentos de recomposición.
                          <br/><br/>
                          El máximo esplendor de la España musulmana se produce en el siglo X, durante los 50 años de reinado de Abderramán III, primer califa –líder político y espiritual- de Córdoba. Con él, será ampliada la mezquita, se abrirán bibliotecas y universidades y se construirá la ciudad palatina de Medina Azahara.
                        </p>
                      </div>
<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'Hasday Ibn Shaprut en la Corte de Abderramán III'" src="/serie-isabel/conquista-de-granada/img/reconquista/abd.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Hasday Ibn Shaprut en la Corte de Abderramán III (1885)<br>
                        <span><strong>Dionís Baixeras</strong>, Universidad de Barcelona</span>
                      </div> 
                    </div>
                  </div>
                </div>  
<?php      //   <!-- Slide5 intro ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="4" data-titulo="La jura de Santa Gadea (Burgos, 1072)" >
                  <div class="content-slide">
                      <div class="titGrad">
                        <h2>La jura de Santa Gadea (Burgos, 1072)</h2>
                        <p>
                          Los reyes de la Edad Media eran los primeros señores feudales y, a su muerte, repartían sus reinos entre sus hijos frustrando cualquier intento de unificación peninsular. Uno de esos monarcas fue Fernando I, que dividió los reinos de Castilla y León en su testamento entre sus hijos Sancho y Alfonso. La muerte del primero en el cerco de Zamora hizo albergar sospechas de que el segundo estaba detrás de su fallecimiento.
                          <br/><br/>
                          La leyenda dice que en 1072 Rodrigo Díaz de Vivar, El Cid, se negó a jurar fidelidad a Alfonso como nuevo rey de Castilla y León si no juraba ante la Biblia que no había participado en la muerte de su hermano. Más allá de la ficción, tanto Alfonso como El Cid consiguieron años después las primeras grandes victorias cristianas de la Reconquista; el primero recuperó Toledo y el segundo, Valencia.
                        </p>
                      </div>

<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'La jura de Santa Gadea'" src="/serie-isabel/conquista-de-granada/img/reconquista/jura_del_rey_alfonso_vi.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Jura del rey Alfonso VI en Santa Gadea (1864)<br>
                        <span><strong>Marcos Hiráldez Acosta</strong>, Senado de España</span>
                      </div> 
                    </div>
                  </div>
                </div>    
<?php      //   <!-- Slide6  ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="5" data-titulo="La batalla de Navas de Tolosa ( Navas de Tolosa, 1212)" >
                  <div class="content-slide">
                      <div class="titGrad">
                        <h2>La batalla de Navas de Tolosa ( Navas de Tolosa, 1212)</h2>
                        <p>
                          La fragmentación del poder musulmán hizo que la hegemonía en la península cayese del bando cristiano poco a poco. Los almohades, procedentes del norte de África, imponen un mayor fervor religioso influidos por la tradición bereber, lo que provocó rechazo en la población andalusí.
                          <br/><br/>
                          Mientras, tras la derrota de Alarcos, el rey Alfonso VII de Castilla, junto a los monarcas de Aragón, Navarra y Portugal, las órdenes militares y los voluntarios de cruzada forma el mayor ejército de la Reconquista. El resultado fue la victoria cristiana en Navas de Tolosa en 1212, a las puertas de Andalucía, que llevará en unos años a la desintegración del poder almohade.                    
                        </p>
                      </div>

<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'Las Navas de Tolosa'" src="/serie-isabel/conquista-de-granada/img/reconquista/las_navas_de_tolosa.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Las Navas de Tolosa<br>
                        <span><strong>Francisco de Paula Van-Halen y Maffei</strong>, Senado de España</span>
                      </div> 
                    </div>
                  </div>
                </div>      
<?php      //   <!-- Slide7  ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="6" data-titulo="Fernando III negocia la rendición de musulmanes (Baeza, 1224)" >
                  <div class="content-slide">
                      <div class="titGrad">
                        <h2>
                          Fernando III negocia la rendición de musulmanes (Baeza, 1224)
                        </h2>
                        <p>
                          La descomposición del imperio almohade provoca que los señores de los pequeños reinos musulmanes busquen acuerdos con los dos monarcas cristianos de la primera mitad del siglo XIII: Jaime I de Aragón y Fernando III de Castilla.
                          <br/><br/>
                          El primero conquistará Valencia, Mallorca y Murcia y el segundo hará historia al cristianizar el centro de poder almohade (Sevilla) y la antigua capital califal (Córdoba). La imagen de su negociación con Mohamed, señor de Baeza, en 1224, se repetirá en varias ocasiones, pero solo un estado musulmán sobrevivirá en una débil paz con Castilla: el reino nazarí de Granada.
                        </p>
                      </div>
<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'Fernando III, el Santo'" src="/serie-isabel/conquista-de-granada/img/reconquista/miranda-fernando_iii.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Fernando III, el Santo (1760)<br>
                        <span><strong>Juan de Miranda</strong>, Real Academia de Bellas Artes de San Fernando </span>
                      </div> 
                    </div>
                  </div>
                </div>   
<?php      //   <!-- Slide8  ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="7" data-titulo="El entierro de Álvaro de Luna (Valladolid, 1453)" >
                  <div class="content-slide">
                      <div class="titGrad">
                        <h2>
                        El entierro de Álvaro de Luna (Valladolid, 1453)</h2>
                        <p>
                          Castilla vive un convulso periodo de luchas de poder entre la nobleza y los reyes durante los siglos XIV y XV que la alejan de la meta de culminar la Reconquista. Detrás de las guerras civiles de Pedro I el Cruel contra Enrique de Trastámara y la de Enrique IV contra su hermanastro Alfonso está el inevitable choque entre una autoridad real que quiere reafirmarse y una nobleza que quiere mantener sus privilegios.
                          <br/><br/>
                          El personaje que mejor encarna esta tensión es Álvaro de Luna, un hombre que lo fue todo en la corte del rey Juan II de Castilla y que defendió sus intereses frente a los nobles, aliados con los infantes de Aragón. Sin embargo, fue ejecutado en 1453 al caer en desgracia por las maniobras de esos mismos nobles y la segunda esposa del rey, madre de Isabel la Católica.
                        </p>
                      </div>
<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'Colecta para sepultar el cadáver de don Álvaro de Luna'" src="/serie-isabel/conquista-de-granada/img/reconquista/entierro_alvaro_de_luna.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Colecta para sepultar el cadáver de don Álvaro de Luna (1866)<br>
                        <span><strong>José María Rodríguez de Losada</strong>, Senado de España</span>
                      </div> 
                    </div>
                  </div>
                </div>   

<?php      //   <!-- Slide9 ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="8" data-titulo="Isabel y Fernando, reyes de Castilla y Aragón  ( Alcaçovas, 1479)" >
                  <div class="content-slide">

                      <div class="titGrad">
                        <h2>Isabel y Fernando, reyes de Castilla y Aragón  ( Alcaçovas, 1479)</h2>
                        <p>
                          Los vaivenes políticos castellanos llevan a la unión en 1469 de Isabel de Castilla con Fernando de Aragón, ambos de la dinastía Trastámara, en una asociación política que marcará el fin de la Reconquista y el germen del imperio español.
                          <br/><br/>
                          Tras ganar la guerra de sucesión contra el bando de la infanta Juana en 1479, Isabel es ya reconocida por todos como reina de Castilla. Ese mismo año su marido Fernando será proclamado rey de Aragón. De esta forma y por la vía dinástica por primera vez la mayoría de los reinos cristianos peninsulares están bajo una sola autoridad. En ese escenario, los monarcas emprenden en 1482 la batalla definitiva contra el Reino de Granada, retrasada durante más de 200 años.
                        </p>
                      </div>

<?php      //   <!-- img ------------------------------------------------------> ?>
                   <img alt="cuadro 'Los ReyesCatólicos en el acto de administrar justicia'" src="/serie-isabel/conquista-de-granada/img/reconquista/isabel_y_fernando.jpg">              
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Los ReyesCatólicos en el acto de administrar justicia (1860)<br>
                        <span><strong>Víctor Manzano y Mejorada</strong>, Patrimonio Nacional</span>
                      </div> 
                    </div>
                  </div>
                </div>                   

              </div> 
            </div> 
        </div>
      </article>  

      <article id="toma-zahara" class="element batalla opacity hidden">

        <div id="toma-zahara-paso-1" class="paso hidden" data="paso-1" data-duracion="15000"
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1481</span>La toma de Zahara</h1>
                <p class="cita">"Desde el comienzo de su reinado, Don Fernando y Doña Isabel tenían puesto el pensamiento en esta guerra" 
                  <span class="cita-author">Alonso de Palencia</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="01-toma-zahara"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="01-toma-zahara"></div>
              </div>
            </div>
          </div>

        </div>

<?php      //   <!-- Paso2 MAPA ------------------------------------------------------> ?>
        <div id="toma-zahara-paso-2"  class="paso hidden" data="paso-2">
<?php // mapa wrap ?>
          <div id="bat-zahara" class="paso-map">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <h1>La península Ibérica, 1481</h1>
            <div class="map-wrap-steps-end clearfix">
              <p>La Guerra de Granada es la culminación del lento proceso de Reconquista cristiana tras la fulgurante invasión musulmana. Durante más de siete siglos, los reinos del norte peninsular, mermados por sus divisiones internas, avanzan poco a poco hasta reducir la presencia musulmana al reino nazarí de Granada.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/reconquista" class="go-link" data-id="extra-reconquista"
                 title="Haz click para visitar el especial">La Reconquista</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
            <div class="map-wrap">
             <div class="map-main">

<?php // mapa en si ?>
              <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1482.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
          
<?php // divisiones de la península ?>
              <div id="map-ttip-portugal" class="pop pop-left pop-zahara tooltip-map1">
                <div class="pop-num ft-gothic"><span>Reino de Portugal</span></div>
                <div class="pop-inn">
                  <h4>Reino de Portugal</h4>
                  <p>La Reconquista deja de ser un problema para Portugal en 1250, cuando arrebata el Algarve a los musulmanes. Entonces el principal enemigo pasa a ser Castilla, con la que mantendrá disputas fronterizas y también en sus expediciones marítimas en el Atlántico.  El enfrentamiento entre ambas partes llega a su zenit en la guerra de sucesión castellana, cuando Portugal, junto a Francia, toma partido por Juana la Beltraneja y pierde ante el bando isabelino.</p>
                </div>
              </div>
              <div id="map-ttip-aragon" class="pop pop-right pop-zahara tooltip-map1">
                <div class="pop-num ft-gothic"><span>Corona de Aragón</span></div>
                <div class="pop-inn">
                  <h4>Corona de Aragón</h4>
                  <p>Con las conquistas de Jaime I (que se hace con Mallorca, Valencia y parte de Murcia en la primera mitad del siglo XIII), Aragón pasa página de la Reconquista. En los siglos XIV y XV trata de expandirse por el Mediterráneo, de ampliar sus fronteras en el Rosellón y Cerdaña, en manos de Francia, y de calmar los levantamientos internos en Cataluña.Desde 1479 Fernando se convierte en rey de Castilla y Aragón pero ambos reinos conservan su autonomía, lo que hace que en principio la conquista de Granada se vea como una empresa castellana a la que eventualmente Aragón presta un apoyo secundario.</p>
                </div>
              </div>
              <div id="map-ttip-castilla" class="pop pop-zahara tooltip-map1">
                <div class="pop-num ft-gothic"><span>Corona de Castilla</span></div>
                <div class="pop-inn">
                  <h4>Corona de Castilla</h4>
                  <p>Constituida primero como condado, luego como reino y finalmente como corona tras su unión con León, Castilla se convierte en la principal potencia peninsular. La victoria en la batalla de Navas de Tolosa (1212) hace que se desinfle el imperio almohade y Castilla se hace con Córdoba y Sevilla, antiguos centros del poder musulmán. A partir de entonces, la Reconquista se convierte en un problema menor frente a las frecuentes disputas entre los reyes y la nobleza. Cuando la guerra de sucesión llega a su fin Isabel se da cuenta de la importancia histórica de acabar con el último reducto musulmán de la península, el reino de Granada, para garantizarse el apoyo de la nobleza y unificar la corona.</p>
                </div>
              </div>
              <div id="map-ttip-granada" class="pop pop-top pop-zahara tooltip-map1">
                <div class="pop-num ft-gothic"><span>Reino de Granada</span></div>
                <div class="pop-inn">
                  <h4>Reino de Granada</h4>
                  <p>El fin del imperio almohade tras la batalla de Navas de Tolosa precipita la descomposición de la España musulmana, que encuentra un último refugio en el sudeste de la península. Allí en 1238 Mohamed I, de la semidesconocida dinastía nazarí, funda el Reino de Granada, que vive casi dos siglos de insólito esplendor, con un fuerte componente comercial en el Mediterráneo. Aunque varios reyes castellanos trataron de conquistar el reino nazarí, siempre fracasaron.  Entonces, Granada volvía a ser estado tributario de Castilla y se renovaban las treguas entre ambos bandos. La última tregua entre Castilla y Granada expira en 1481.</p>
                </div>
              </div>
              <div id="map-ttip-navarra" class="pop pop-zahara tooltip-map1">
                <div class="pop-num ft-gothic"><span>Reino de Navarra</span></div>
                <div class="pop-inn">
                  <h4>Reino de Navarra</h4>
                  <p>Tras ser uno de los reinos más prósperos de la Reconquista, Navarra había iniciado una lenta decadencia que la había convertido en moneda de cambio en las luchas territoriales entre Francia, Castilla y Aragón. El padre de Fernando el Católico, Juan II, ejerció de rey consorte de Navarra hasta su muerte, en 1479, aunque el reino estaba en plena guerra civil entre beaumonteses (partidarios de Castilla) y agramonteses (de Aragón primero y Francia después).</p>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div id="toma-zahara-paso-3"  class="paso paso-0 multipaso multipaso-0 hidden" data="paso-3" data-paso="0" data-pasos="7">
          <div id="bat-zahara" class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-merlo paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/diego-de-merlo.jpg" alt="Diego de merlo">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">Diego de Merlo</div>
                <div class="paso-pop-cont">Asistente mayor de Sevilla. Recibe el encargo de poner en marcha la respuesta cristiana como representante de la semiautónoma nobleza andaluza. Merlo, un personaje polémico en la época, fue el responsable de la represión de los judíos conversos de Sevilla, germen de lo que será la Inquisición. </div>
              </div>

              <div class="paso-popup paso-pop-mulai paso-popup-left paso-auto paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/muley-hacen.jpg" alt="Muley Hacén">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">Muley Hacén</div>
                <div class="paso-pop-cont">Tras los constantes cambios de emires que vive Granada durante 40 años, Muley Hacén logra una cierta estabilidad para su reino cuando accede al poder en 1464. Durante más de quince años lleva una política de eliminación de los opositores, que provoca la expulsión de los abencerrajes, una de las familias nobles más poderosas. La división de la Castilla cristiana impulsa su ambición de ampliar las fronteras del reino, pero su aventura en Zahara supone la excusa perfecta para un conflicto militar abierto que es visto con pánico dentro de las murallas de Granada. Además, su historia de amor con una cristiana conversa provoca el choque directo con su esposa, la sultana Aixa, y su hijo, Boabdil, poniendo los cimientos para una nueva guerra civil.</div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1481 La toma de Zahara</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1</span> El responsable de la fortaleza de Zahara, <span class="negrita">Gonzalo de Arias</span>, se encuentra en Sevilla y deja desprotegida la ciudad, fronteriza con el Reino de Granada. </div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> La noche del <span class="negrita">27 de diciembre de 1481</span> un grupo de nazaríes asalta Zahara cogiendo por sorpresa a los soldados. </div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Los moradores, desprevenidos, no oponen resistencia y son llevados cautivos a Granada.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M437.443,931c0,0,35.983-23.146,50,33.5c2.59,10.467,5.057,27,4.557,36"></div>

              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M692,965.5c-76.5-27-153.557,3.5-192.557,44.5"></div>

              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M508.5,1030c12.5,23,37.5,33,68.5,23c36.5-9,60.5-84,102.943-72.5"></div>

              <div class="paso-text tit-zahara paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Zahara</div>
              <div class="paso-ico go-zahara paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>

              <div class="paso-text tit-sevilla paso-auto paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Sevilla</div>
              <div class="paso-ico ico-sevilla paso-ico-battles paso-auto paso-2 paso-2P paso-3P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>

              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-0P paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">

<?php // mapa en si ?>
              <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1482.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">

             </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
              <p style="clear: both;">Los Reyes Católicos implantaron en 1478 la Inquisición Española, tras la unión de Aragón y Castilla. Bajo bula papal, los monarcas velaron por la pureza de la fe castigando cruelmente a todo aquel acusado de herejía. Isabel y Fernando dieron plenos poderes a Tomás de Torquemada, quien como inquisidor general ‘encendió’ las hogueras para ajusticiar a los judaizantes.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/inquisicion" class="go-link" data-id="toma-zahara-extra-inquisicion"
                 title="Haz click para visitar el especial">La inquisición</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
          </div>
          </div>
       </div>

      </article> 

      <article id="toma-zahara-extra-inquisicion" class="element extra hidden">


        <div class="device">
<?php    //       <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php      //   <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
              <div class="swiper-wrapper" >

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e1-intro-inquisicion"></div>
                    </div>
                  </div>
                </div>

<?php      //   <!-- Slide1 intro ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="2" data-titulo="La Inquisición" >
                  <div class="content-slide">

<?php      //   <!-- img ------------------------------------------------------> ?>
                    <div class="imagen">
                      <img height="90%" title="ESCRIBIR TÍTULO CUADRO" class="ml10 mt5" src="/serie-isabel/conquista-de-granada/img/cuadro.jpg">
                    </div>

<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                    <div class="cuadro-info-butt">
                      <div class="cuadro-info">
                        <div class="cuadro-info-wrap">
                          Auto de Fe presidido por Santo Domingo de Guzmán (1493 - 1499)<br>
                          <span><strong>Pedro Berruguete</strong> Museo Nacional del Prado</span>
                        </div> 
                      </div>
                    </div>

<?php      //   <!-- main ------------------------------------------------------> ?>
                    <div class="intro dcha">
                      <h1 class="tituloInqBig">La Inquisición</h1>
                      <p class="detalleInq">
Los Reyes Católicos impulsaron la creación de la Santa Inquisición Española en Sevilla, al ser esta una ciudad con notable presencia judía y mudéjar y abierta al comercio de mercancías en la difusión de credos no católicos.  La sede de la Inquisición estuvo en el castillo de San Jorge del actual barrio de Triana, tras una breve etapa inicial en el convento dominico de San Pablo, hoy parroquia de la Magdalena.
<br/><br/>
No era una institución totalmente novedosa en Europa, pues ya había sido creada en el siglo XIII para luchar contra la herejía cátara en el sur de Francia, pero bajo bula papal Isabel y Fernando la reinstauraron nombrando ellos mismos a sus propios  inquisidores para luchar contra los falsos conversos. La Santa Inquisición, no obstante, no fue más dura, más arbitraria o más cruel que cualquiera de los tribunales civiles que actuaban en Europa por aquel entonces.  A pesar de ello, cientos de personas fueron ajusticiadas en la hoguera -quemadas vivas o ejecutadas previamente si se arrepentían- ante la sospecha más o menos fundada de ser  falsos conversos, a los que se llamaba judaizantes.
                      </p>
                    </div>

                  </div>
                </div>

<?php      //   <!-- Slide2 Torquemada ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="3" data-titulo="Fray Tomás de Torquemada"> 
                  <div class="content-slide">
                    <div class="imagen">
                      <img class="ml10" width="90%" src="/serie-isabel/conquista-de-granada/img/torquemada.jpg" alt="Fray Tomás de Torquemada">
                    </div>
                    <div class="info dcha">
                      <h2 class="tituloInq ml10">Fray Tomás de Torquemada</h2>
                      <p class="detalleInq ml10">
                        Primer Inquisidor General de Castilla y Aragón en el siglo XV.<br/>
                        El papa Sixto IV le propone para el cargo en 1483 a instancias de la reina Isabel y suyo es el reglamento común que debía guiar las acciones de los inquisidores. Bajo su mandato hubo una contaminación entre Iglesia y Monarquía: mientras los Reyes cayeron en un fanatismo religioso, la Inquisición adoptó tintes políticos y llegó a enjuiciar que los Reyes aceptasen dinero de los judíos para financiar la Guerra de Granada.
                      </p>
                    </div>
                  </div>
                </div>  
<?php      //   <!-- Slide3 ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="4" data-titulo="¿Por qué nace la inquisición?" >
                  <div class="content-slide">
                    <div class="info izda">
                      <h2 class="tituloInq ml15">¿Por qué nace la inquisición?</h2>
                      <p class="detalleInq ml15">                                              
                        Los cristianos, pese a ‘coexistir’ con los judíos durante siglos, sentían un antisemitismo casi popular, que ya originó estallidos de violencia previos como el acaecido en 1391. Detestaban la forma de vivir de los judíos, envidiaban su riqueza y no lidiaban bien con el peso preponderante que alguno de ellos había llegado a tener en la Corte. Por odiar, odiaban hasta la dieta judía, que no respetaban las normas alimenticias de la Iglesia. 
                        <br/><br/>
                        Los mudéjares y los judíos cocinaban en esa época usando el aceite de oliva, no el tocino o la manteca de cerdo. Cronistas como Alonso de Palencia o Bernaldez recalcan cómo el olor de fritanga del aceite cocinándose los delataba como conversos o judaizantes o islamizantes y las protestas de la gente ante un olor que consideraban insoportable.
                        <br/><br/>
                        Víctima de este odio fue María González, conocida como la Pampana por estar casada con Juan Pampán, que fue quemada viva por comer carne durante la cuaresma. Murió en Ciudad Real en 1484 juntos a 33 personas más, tras un auto de fe donde fue condenada como judaizante.
                      </p>
                    </div>
                    <div class="imagen bg-white" >
                      <img width="90%" height="auto" class="ml5" src="/serie-isabel/conquista-de-granada/img/porquenace.jpg">
                    </div>
                    <div class="cuadro-info-butt cuadro-info-butt-right">
                      <div class="cuadro-info">
                        <div class="cuadro-info-wrap">
                           Condenado por la Inquisición (1860)<br>
                          <span><strong>Eugenio Lucas Velázquez</strong> Museo Nacional del Prado</span>
                        </div> 
                      </div>
                    </div>                    
                  </div>
                </div>
<?php      //   <!-- Slide4 Cuadro ------------------------------------------------------> ?>
                <div class="swiper-slide" data-slide="5" data-titulo="¿Cómo se acusaba a un hereje?"> 
                  <div class="content-slide cuadroHereje" >
                      <img src="/serie-isabel/conquista-de-granada/img/auto-de-fe-plaza-mayor-madrid.jpg" alt="Auto de fe, pintado por Francisco Rizi en 1683" >

                    <div id="cuestion1" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>¿CÓMO SE ACUSABA A UN HEREJE?</h2>
                        <p>El clima de pavor ante la posibilidad de ser denunciado era asfixiante. Quienes eran acusados no eran informados del motivo de su detención y el inquisidor les preguntaba si conocían el delito que se le atribuía. En función de cuántos pecados reconociese, más indulgente era la pena. También se fomentó la denuncia entre parientes. Hubo hasta casos de hijos que entregaron a sus padres. Nadie sabía quién denunciaba a quien ya que prevalecía el secreto.</p>
                      </div>
                    </div>
                    <div id="cuestion2" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>LA PESTE, ¿ANTÍDOTO CONTRA LA INQUISICIÓN?</h2>
                        <p>Cuenta Alonso de Palencia en sus crónicas que más de 16.000 judíos y falsos conversos murieron por el brote de peste que asoló Sevilla desde principios de 1481. Solo la peste salvó a muchos de ser ejecutados dado que los 'trabajos' de la Santa Inquisición fueron suspendidos durante 8 años, teniendo muchos perseguidos la oportunidad de huir de los dominios de los Reyes Católicos.</p>
                      </div>
                    </div>
                    <div id="cuestion3" class="pop pop-top "><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>LA CRUELDAD DE LA INQUISICIÓN</h2>
                         <p>Los condenados a muerte eran llevados al campo de Tablada, en donde estaba dispuesto el “quemadero” con los fardos de leña y los postes a los que se ataba a los condenados por herejía judaizante, los cuales podían ser agarrotados o degollados por el verdugo si manifestaban su arrepentimiento antes de prender las hogueras y quemarlos vivos.</p>
                      </div>
                    </div>
                    <div id="cuestion4" class="pop pop-top  pop-left"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>¿CUÁNTA GENTE AJUSTICIÓ LA INQUISICIÓN?</h2>
                        <p>No existe una cifra oficial del número de ejecutados por la Inquisición, pero según los escritos de Andrés Bernaldez el número de ajusticiados en Sevilla estaría en torno a 700 relajados -quemados vivos en la hoguera- entre 1481 a 1488. Según los historiadores, es una cifra con sentido si tenemos en cuenta que la “pestilencia” obligó a parar toda actividad inquisitorial.</p>
                        <p>Los condenados que habían huido o habían muerto antes de la sentencia, eran “quemados en efigie”. Es decir, se quemaba simbólicamente una estatua de madera porque el Santo Oficio consideraba que la herejía se debía combatir hasta más allá de la muerte.</p>
                      </div>
                    </div>
                  </div>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                          Auto de Fe en la plaza Mayor de Madrid (1683)<br>
                          <span><strong>Francisco Rizi</strong> Museo Nacional del Prado</span>                        
                      </div> 
                    </div>
                  </div>
                </div>    

              </div> 
            </div> 

        </div>

      </article>  

      <article id="batalla-alhama" class="element batalla opacity hidden">

        <div id="batalla-alhama-paso-1" class="paso hidden" data="paso-1"  data-duracion="15000"
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1482</span>La batalla de Alhama </h1>
                <p class="cita">"Paseábase el rey moro / por la ciudad de Granada / desde la puerta de Elvira / hasta la de Vivarrambla / Cartas le fueron venidas / cómo Alhama era ganada/ ¡Ay de mi Alhama! "  
                  <span class="cita-author">Romance fronterizo</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="02-batalla-alhama"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="02-batalla-alhama"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="toma-alhama-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-paco paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--cuadro-rodrigo-ponce-de-leon.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">Rodrigo Ponce de León</div>
                <div class="paso-pop-cont">Marqués de Cádiz. Aliado de Juana la Beltraneja, Ponce es un ejemplo de cómo Isabel logra poner a su favor a la nobleza tras la guerra de sucesión. Señor de Sevilla, se disputa el dominio de Andalucía Occidental con el duque de Medina Sidonia. Lidera el ejército que toma Alhama y su rival será el que comande las tropas que le liberarán del cerco musulmán. El abrazo de ambos al acabar la batalla simboliza la unión de la dividida nobleza frente al enemigo común, del que el marqués de Cádiz se coronará como una de sus bestias negras.<br/><span class="pequenin">“Rodrigo Ponce de León”, Luis Serrano. Catedral de Sevilla.<br>Biblioteca Capitular Colombina</span></div>
              </div>

              <div class="paso-popup paso-pop-zegries paso-popup-left paso-popup-top paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/abencerraje.jpg" alt="Zegríes y abencerrajes">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">Zegríes y abencerrajes</div>
                <div class="paso-pop-cont">Las guerras intestinas en el Reino de Granada están movidas por los hilos de estos dos linajes enemigos durante todo el siglo XV. Los zegríes se consideran más 'halcones' o partidarios del enfrentamiento con los cristianos y por eso, desde el primer momento, son partidarios de Muley Hacén y de su hermano El Zagal, con el que combatirán hasta el final en el sitio de Málaga. Por su parte, los abencerrajes se consideran pactistas y apoyan a Boabdil frente a su padre, acompañándole en su reinado primero, en su exilio posterior y en su último mandato. Las circunstancias harán que cambien los papeles: los zegríes se convertirán en partidarios de Castilla al caer Málaga mientras que los abencerrajes resistirán hasta el final en Granada.<br/><span class="pequenin">© MNAC – Museu Nacional d’Art de Catalunya. Barcelona. <br>Fotógrafos: Calveras/Mérida/Sagrist</span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1482 La batalla de Alhama</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> El <span class="negrita">marqués de Cádiz</span> se interna en secreto en territorio granadino, se apodera por sorpresa de la fortaleza y luego inician una batalla calle a calle con los locales.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> Las tropas musulmanas acuden a su liberación lideradas por <span class="negrita">Muley Hacén</span> y cercan la ciudad. </div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Un ejército improvisado por otros nobles andaluces, liderado por el antiguo enemigo del marqués, el duque de Medina-Sidonia, asegura la ciudad para los cristianos.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M534.166,978.5c7.333,10.667,41.333,38,91.333,26"></div>
              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M554.166,886.5c15.333,2,82,47.333,86.667,86"></div>

              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M711.499,970.5c-8-10.666-31.334-3.334-39.334,4"></div>

              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M424.833,1058.166c-2.667-11.334,15.333-33.334,81.333-29.334  s97.333,2.668,112.667-8.666"></div>

              <div class="paso-ico go-alhama paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>
              <div class="paso-text tit-alhama paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Alhama</div>
              
              <div class="paso-text tit-cordoba paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Córdoba</div>
              <div class="paso-ico ico-cordoba paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-ecija paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Écija</div>
              <div class="paso-ico ico-ecija paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

              <div class="paso-text tit-medina paso-auto paso-6P paso-6 paso-7P paso-7">Medina-Sidonia</div>
              <div class="paso-ico ico-medina paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1482.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>7.500</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>44.000</span></div>
                <div class="cont-title2">Ejército Cristiano</div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>3.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>50.000</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end map-wrap-steps-end-full clearfix">

              <a href="#" id="player-alhama" class="fragmento-audio" title="Mantenga el pulsor sobre el punto para escuchar el audio">
                <div class="fragmento-audio-texto">Escucha este romance nazarí sobre la batalla de Alhama</div>
                <div class="fragmento-audio-img"></div>

                <audio class="audio-judios">
                  <source type="audio/ogg" src="http://video.lab.rtve.es/resources/TE_NGVA/mp3/2013/granada/e2-poema-alhama.ogg">
                  <source type="audio/mp3" src="http://video.lab.rtve.es/resources/TE_NGVA/mp3/2013/granada/e2-poema-alhama.mp3">
                </audio>
              </a>
              <div style="clear: both">
                <h2 class="label">
                  <a href="/serie-isabel/conquista-de-granada/extra/nobleza" class="go-link" data-id="batalla-alhama-extra-reestructuracion-nobleza"
                   title="Haz click para visitar el especial">CÓMO ERA LA NOBLEZA</a>
                  <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
                </h2>
                <p class="texto-nobleza">Una de las claves de la Guerra de Granada fue el logro de los Reyes Católicos de unir a la nobleza andaluza y castellana para la causa contra el reino nazarí. Hacía tan solo dos años, Castilla había vivido una guerra civil en la que buena parte de los nobles se enfrentaron a Isabel en favor de Juana.</p>
              </div>
            </div>
          </div>
          </div>
        </div>

      
      </article>

<?php      //   <!-- LA NOBLEZA ------------------------------------------------------> ?>
      <article id="batalla-alhama-extra-reestructuracion-nobleza" class="element extra hidden">

        <div class="device">

<?php //          <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php //         <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
            <div class="swiper-wrapper">

              <div id="reestructuracion-nobleza-paso-1" class="swiper-slide  wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                <div class="content-slide">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e2-intro-nobleza"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="reestructuracion-nobleza-paso-2" class="swiper-slide" data-slide="2" data-titulo="La rebelión de los nobles">               
                <div class="content-slide">
                  <h1 class="titulo">Reestructuración de la nobleza</h1>                   
                  <div class="cuadro-info-butt cuadro-info-butt-right">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Isabel, la Católica
                        Condenado por la Inquisición (Hacia 1490)<br>
                        <span><strong>Anónimo</strong> Museo Nacional del Prado</span>
                      </div> 
                    </div>
                  </div>
                  <div class="nobles">
                    <div class="nobles-rebeldes">
                      <div class="row clearfix">
                        <div id="ducado-bejar" class="pop pop-left escudo-noble">
                          <div class="pop-num ft-gothic">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/ducado-bejar.png">
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Álvaro de Zúñiga, duque de Arévalo</h2>
                            <p>Zúñiga vive en carne propia las consecuencias de rebelarse contra Isabel. Termina rindiendo el castillo de Burgos y la reina le quita el ducado de Arévalo, que era de su madre.</p>
                          </div>
                        </div>
                        <div id="marques-villena" class="pop pop-left escudo-noble">
                          <div class="pop-num ft-gothic">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marques-villena.png">
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Diego López Pacheco, marqués de Villena</h2>
                            <p>El hijo de Juan Pacheco se alía pronto con su familiar Carrillo frente a Isabel y Fernando. Tras el fiasco de la guerra con Portugal, jura lealtad a los reyes y luchará por ellos en la Guerra de Granada.</p>
                          </div>
                        </div>
                        <div id="escudo-alcantara" class="pop escudo-noble">
                          <div class="pop-num ft-gothic">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/escudo-alcantara.png">
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Juan de Zúñiga, Maestre de Alcántara</h2>
                            <p>El hijo de Álvaro de Zúñiga pondrá las armas de la orden de Alcántara al servicio de Portugal, aunque posteriormente participa en las negociaciones de paz. En la Guerra de Granada destacará por su valor en las tomas de Loja y Málaga y estará presente en la firma de las Capitulaciones de Santa Fe.</p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="rollo"><span>NOBLES REBELDES</span></div>
                      </div>

                      <div class="row clearfix">
                        <div id="escudo-carrillo" class="pop pop-top pop-left escudo-noble">
                          <div class="pop-num ft-gothic">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/escudo-carrillo.png">
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Alfonso Carrillo, arzobispo de Toledo.</h2>
                            <p>Antiguo aliado de Isabel, su enemistad con los reyes católicos lo convierte en uno de los principales aliados de Juana la Beltraneja. Nunca llegará a reconciliarse con los monarcas.</p>
                          </div>
                        </div>
                        <div id="marques-cadiz" class="pop pop-top pop-left escudo-noble">
                          <div class="pop-num ft-gothic">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                            <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marques-cadiz.png">
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Rodrigo Ponce de León, marqués de Cádiz</h2>
                            <p>Ponce de León se alinea con Juana la Beltraneja frente a su rival por el dominio de Andalucía, el duque de Medina Sidonia, aliado de Isabel. Tras la guerra jura lealtad a la reina y se convertirá en uno de sus más valerosos guerreros, hasta el punto de protagonizar la toma de Alhama.</p>
                          </div>
                        </div>
                          <div id="cruz-calatrava" class="pop pop-top escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/cruz-calatrava.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Rodrigo Téllez Girón, maestre de Calatrava</h2>
                              <p>Hermano gemelo de Juan Téllez Girón, estuvo bajo la protección de Juan Pacheco, que le impulsó al maestrazgo de Calatrava. Aunque luchó por el bando beltranejo, el resto de la orden apoyó a Isabel. Tras la guerra juró lealtad a los reyes y murió en combate en la guerra de Granada.</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="nobles-fieles">

                        <div class="row clearfix">
                          <div id="escudo-mendoza" class="pop escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/escudo-mendoza.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Pedro González de Mendoza, cardenal y cabeza de la casa de Mendoza.</h2>
                              <p>El cardenal lidera el giro de la poderosa Casa de Mendoza, que había apoyado a Enrique IV primero y a Juana después, y que en la guerra de sucesión apuesta por Isabel frente a su rival Alfonso Carrillo. Tras la batalla se convierte en el personaje más influyente de la corte castellana.</p>
                            </div>
                          </div>
                          <div id="orden-santiago" class="pop pop-right escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/orden-santiago.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Alonso de Cárdenas, maestre de la Orden de Santiago</h2>
                              <p>Hombre de estrecha confianza de los reyes católicos, gracias a ellos consigue hacerse con la codiciada Orden de Santiago en reconocimiento a su apoyo en la guerra. En la conquista de Granada tendrá un papel protagonista (será el encargado de custodiar la frontera oeste, con base en Écija) aunque tras la victoria se verá obligado a ceder su maestrazgo a los monarcas.</p>
                            </div>
                          </div>
                          <div id="medina-sidonia" class="pop pop-right escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/medina-sidonia.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Enrique Guzmán, duque de Medina Sidonia</h2>
                              <p>Eligió el bando isabelino y se convirtió en uno de sus principales apoyos en la Guerra de Granada, donde dejó atrás su antigua enemistad con el marqués de Cádiz.</p>
                            </div>
                          </div> 
                        </div>

                        <div class="row">
                          <div class="rollo"><span>NOBLES FIELES</span></div>
                        </div>
                        <div class="row clearfix">
                          <div id="manrique-lara" class="pop pop-top escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/manrique-lara.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Pedro Manrique de Lara, conde de Treviño</h2>
                              <p>La Casa de los Manrique de Lara logró gracias a su apoyo a Isabel en la guerra que se le concediera el Ducado de Nájera en 1482. Durante la guerra de Granada fue el encargado de custodiar la frontera norte del reino, con base en Jaén.</p>
                            </div>
                          </div>
                          <div id="escudo-beltran" class="pop pop-top pop-right escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/escudo-beltran.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>Beltrán de la Cueva, duque de Alburquerque</h2>
                              <p>Valido con Enrique IV y enemigo de los Pacheco y el arzobispo Carrillo, Beltrán de la Cueva apoya a Isabel frente a Juana, pese a que ésta tenía el apodo de “La Beltraneja” por ser supuesta hija ilegítima suya. También luchará con el bando isabelino en la Guerra de Granada.</p>
                            </div>
                          </div>
                          <div id="ducado-alba-tormes" class="pop pop-top pop-right escudo-noble">
                            <div class="pop-num ft-gothic">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco-escudos.png">
                              <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/ducado-alba-tormes.png">
                            </div>
                            <div class="pop-inn pop-top">
                              <h2>García Álvarez de Toledo, duque de Alba</h2>
                              <p>Otro de los beneficiados por el apoyo a Isabel fue el Ducado de Alba, creado apenas unos años antes de la guerra por Enrique IV. Gracias al respaldo de García Álvarez de Toledo al bando isabelino, al que se le añadiría el liderazgo militar de su hijo Fadrique en Granada, los Alba serán los nobles más importantes de la España de los Austrias. </p>
                            </div>
                          </div> 
                        </div>

                      </div>
                    </div>

                    <div class="texto">
                      <h1>La rebelión de los nobles</h1>
                      <p>Isabel y Fernando contaron en la guerra de Granada con el apoyo incondicional de los nobles andaluces y castellanos, muchos de los cueales se habían rebelado ante la Reina en la Guerra con Portugal. Los nobles vencidos no tardaron en acudir a la Corte para acogerse al perdón de la Reina. Ella obró con inteligencia sabiendo que les necesitaría para la guerra en Granada y les otorgó el perdón sin venganzas. Los nobles conservaron sus bienes, aunque alguno de ellos, como Álvaro de Stúñiga no pudo conservar el título de duque de Arévalo, villa donde residía la madre de Isabel. De este modo, le mantuvo el título de duque, pero de otro dominio: Béjar.</p>
                    </div>

                  </div>

                </div>


                <div id="reestructuracion-nobleza-paso-3" class="swiper-slide" data-slide="3" data-titulo="La reforma de las órdenes militares"> 
                  <div class="content-slide">

                    <div class="mapa">
                      <div class="mapa-ordenes">
                        <img class="hidden" id="mapa-orden-alcantara" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/mapa-ordenes-militares-alcantara.jpg">
                        <img class="hidden" id="mapa-orden-calatrava" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/mapa-ordenes-militares-calatrava.jpg">
                        <img class="hidden" id="mapa-orden-santiago" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/mapa-ordenes-militares-santiago.jpg">
                        <img class="hidden" id="mapa-orden-montesa" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/mapa-ordenes-militares-montesa.jpg">
                      </div>
                      <div class="ordenes">
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/mapa-ordenes-militares.jpg">

                        <div id="orden-alcantara" class="pop pop-left pop-top orden-militar">
                          <div class="pop-num">
                            <span>Alcántara</span>
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Orden Alcantara</h2>
                            <p>Creada en la frontera con Portugal, esta orden tenía sus principales tierras en Cáceres y en la zona este del país, cerca de Murcia. Juan de Zúñiga, su gran maestre, participa activamente en las principales batallas de la Guerra de Granada: desde la toma de Loja y Vélez-Málaga hasta el sitio de la capital malagueña y el de Baza, en Granada. Está presente en la firma de las Capitulaciones de Santa Fe y en 1492, ante el deseo del rey Fernando de hacerse con el control de todas las órdenes militares, deja el cargo.</p>
                          </div>
                        </div> 
                        <div id="orden-santiago" class="pop pop-top orden-militar">
                          <div class="pop-num">
                            <span>Santiago</span>
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Orden de Santiago</h2>
                            <p>Fue objeto de disputa política entre nobles y monarca durante el reinado de Enrique IV, que pone al frente a un hombre de su confianza, Beltrán de la Cueva. Luego, como resultado de la revuelta de los nobles, va a parar primero a Alfonso de Castilla, su hermanastro, y luego a su principal enemigo, Juan Pacheco, marqués de Villena. Pacheco lega el título a su hijo Diego.</p>    
                            <p>Como resultado del descontento provocado por este movimiento, se hace con el maestrazgo Alonso de Cárdenas, que lucha a favor de Isabel en la guerra de sucesión. Alonso de Cárdenas acompaña a los reyes en la Guerra de Granada. A la muerte de Cárdenas, el maestre pasa a ser el rey Fernando.</p>
                          </div>
                        </div> 
                        <div id="orden-montesa" class="pop pop-top pop-right orden-militar">
                          <div class="pop-num">
                            <span>Montesa</span>
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Orden de Montesa</h2>
                            <p>La orden militar de la Corona de Aragón también participa en la guerra y está igualmente sometida a las tensiones entre la nobleza y la monarquía. Fernando impone a su sobrino, Felipe de Aragón y Navarra, como gran maestre, aunque éste muere en 1488 en la toma de Baza.</p>
                          </div>
                        </div> 
                        <div id="orden-calatrava" class="pop pop-top orden-militar">
                          <div class="pop-num">
                            <span>Calatrava</span>
                          </div>
                          <div class="pop-inn pop-top">
                            <h2>Orden de Calatrava</h2>
                            <p>Esta orden tiene su base en la ciudad de Calatrava, en Ciudad Real, y consigue muchos territorios durante la Reconquista andaluza. Esta orden también tiene un papel clave en las luchas entre nobles y reyes. Pedro Girón, hermano de Juan Pacheco, llega a ser su gran maestre, cargo que deja a su hijo, Rodrigo Téllez de Girón, con tan solo ocho años. Téllez de Girón lucha en el bando de Juana la Beltraneja pero posteriormente se une a la causa de la guerra de Granada por las posesiones que tiene la orden en Jaén. Muere en la frustrada toma de Loja de 1482, Cinco años después, el rey Fernando logra hacerse con su dominio por bula papal en 1487 al morir su sucesor, García López de Padilla.</p>
                          </div>
                        </div> 
                        
                      </div>
                    </div>                    
                  
                    <div class="texto">
                      <h2>La reforma de las órdenes militares</h2>
                      <p>Fundadas durante la Edad Media como instrumento para la guerra contra los musulmanes, estas instituciones político-religiosas servían al rey a cambio de prebendas, fundamentalmente territorios. Así, durante la Reconquista los grandes maestres de estas órdenes se van haciendo con el control de buena parte de las tierras recuperadas, donde ejercían como auténtico señor feudal.</p>
                      <p>Tras la rebelión nobiliaria, los reyes fueron conscientes del enorme poder de las órdenes y el peligro que suponía tenerlas en contra, así que decidieron hacerse con su control con el  permiso de Sixto IV, que les concedió una bula papal que les otorgaba los maestrazgos. En poco tiempo, Isabel y Fernando se hicieron con el mando de todas las órdenes a  perpetuidad y, con sus descendientes, este maestrazgo se convirtió en hereditario. La incorporación de las órdenes militares a la Corona tuvo importantes consecuencias, tanto económicas como sociales a lo largo de la Edad Moderna. Desde entonces, nadie podría invocar el nombre de ninguna orden para tomarse la justicia por su mano.</p>
                    </div>
                  </div>
                </div>


                <div id="reestructuracion-nobleza-paso-4" class="swiper-slide" data-slide="4" data-titulo="La santa hermandad" >
                  <div class="content-slide">
                  
                    <div class="titulo">La santa hermandad</div>

                    <div class="wrapper-santa-hermanadad">
                      <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/santa-hermandad.jpg">
                    </div>  
                    <div class="texto">
                      <p>En las Cortes de Madrigal, los Reyes Católicos además de acuñar moneda establecieron las bases de la Santa Hermandad en Castilla, creada para combatir el desorden provocado por los nobles rebeldes y desleales. Se considera como un precedente de la Policía y la Guardia Civil y fue en todo momento un elemento de control y autoridad de los reyes sobre los nobles.</p>
                      <p>Cuando empezó la Guerra de Granada este cuerpo pasó a convertirse en milicia y, por tanto, en germen del ejército español desviándose de su misión original, por lo que se volvieron a vivir episodios de inseguridad en los campos.</p>
                       <p>La Santa Hermandad no era un cuerpo permanente y se iba renovando en cada una de las cortes que se celebraban. A partir de 1498 vuelve a ser una fuerza de orden local y abandona su papel militar y empieza un declive constante hasta su desaparición en el siglo XIX. En 1844, para sustituirla, el II Duque de Ahumada fundará la llamada Guardia Civil.</p>
                      <p>En la época de las Reyes Católicos la Santa Hermandad era presidida por el obispo de Cartagena, Lope de Ribas y su capitán general era Alfonso de Aragón, hermanastro del rey Fernando. Sus finanzas acabaron estando en manos de Abraham Senior, destacado financiero judío vinculado a los monarcas. Se financiaba a través de un impuesto que grababa todas las ventas excepto la carne.</p>
                    </div>                  
                  </div>
                </div>


                <div id="reestructuracion-nobleza-paso-5" class="swiper-slide" data-slide="5" data-titulo="Los nobles guerreros"> 
                  <div class="content-slide">

                    <div class="titulo">Los nobles guerreros</div>

                    <div class="texto-intro">
                      <p>La Reina no tardó en cobrarse mediante tributos y apoyo militar el perdón sin venganzas, siendo clave el apoyo de los nobles en algunas batallas del final de la Reconquista.</p>
                    </div>

                    <div class="wrapper-nobles-cuadros">
                      <div id="img-rodrigo-ponce-leon" class="noble">
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/rodrigo-ponce-leon.jpg">
                        <span class="titulo">Rodrigo Ponce de León</span><br><span>el héroe de Alhama</span>
                      </div>
                      <div id="img-hernan-perez-pulgar" class="noble">                      
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/hernan-perez-pulgar.jpg">
                        <span class="titulo">Hernán Pérez del Pulgar</span><br><span>el de las hazañas</span>
                      </div>             
                      <div id="img-gonzalo-fernandez-cordova" class="noble">
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/gonzalo-fernandez-cordova.jpg">
                        <span class="titulo">Gonzalo Fernández de Córdoba</span><br><span>el Gran Capitán</span>
                      </div>                         
                      <div id="img-martin-vazquez-arce" class="noble">
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/martin-vazquez-arce.jpg">
                        <span class="titulo">Martín Vázquez de Arce</span><br><span>el doncel de Sigüenza</span>
                      </div>                         
                      <div id="img-fabrique-alvarez-toledo" class="noble">
                        <img src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/fabrique-alvarez-toledo.jpg">
                        <span class="titulo">Fabrique Álvarez de Toledo</span><br><span>II duque de Alba</span>
                      </div>                         
                    </div>

                    <div class="wrapper-nobles-textos">                      
                      <div id="rodrigo-ponce-leon" class="texto hidden">
                        <h1>Rodrigo Ponce de León, el héroe de Alhama</h1>
                        <p>Ponce de León lideró el inicio de la guerra al internarse con sus hombres en la vega de Granada para tomar la ciudad de Alhama. Aguantó las acometidas del sultán Muley Hacén hasta que llegaron los refuerzos de su antiguo enemigo, el duque de Medina Sidonia. Posteriormente, Ponce perdió a tres hermanos y dos sobrinos en la fallida toma de la Axarquía malagueña.</p>
                        <p>El marqués de Cádiz fue también un apreciado consejero del rey Fernando, al que recomendó liberar a Boabdil tras ser capturado en Lucena para fomentar las disensiones entre los musulmanes y fue protagonista del cerco de Granada, en cuyas capitulaciones estuvo presente.</p>
                      </div>
                      <div id="hernan-perez-pulgar" class="texto hidden">
                        <h1>Hernán Pérez del Pulgar, el de las hazañas</h1>
                        <p>El noble más elogiado por sus hazañas en la guerra fue Hernán Pérez del Pulgar, capitán del ejército castellano que se ganó el favor de Isabel la Católica. Él fue el encargado de huir hacia Antequera en la batalla de Alhama para conseguir refuerzos para el marqués de Cádiz. Luego conquistó el castillo de El Salar camino de Loja, lideró la toma de Málaga matando al comandante musulmán Aben-Zaid y resistió en Salobreña el sitio de Boabdil en el tramo final de la contienda.</p>
                      </div>
                      <div id="gonzalo-fernandez-cordova" class="texto hidden">
                        <h1>Gonzalo Fernández de Córdoba, el Gran Capitán</h1>
                        <p>El mejor ejemplo de cómo el respaldo a los reyes católicos le granjeó glorias insospechadas a nobles de segunda fila es Gonzalo Fernández de Córdoba. Luchó por Isabel en la guerra de sucesión y gracias a sus contactos con los musulmanes -especialmente su amistad con Boabdil- logra convertirse en uno de los héroes de la contienda.</p>
                        <p>Fernández de Córdoba ayudará a Boabdil a recuperar el poder frente a su tío El Zagal y ejercerá de espía y negociador en el tramo final de la guerra, cuando el rey granadino accede en secreto a rendirse. Pero además ya da sobradas muestras de su liderazgo en el campo de batalla con las conquistas de Íllora, Montefrío y Loja, donde apresa al propio Boabdil, que comanda la resistencia.</p>
                      </div>
                      <div id="martin-vazquez-arce" class="texto hidden">
                        <h1>Martín Vázquez de Arce, el doncel de Sigüenza</h1>                       
                        <p>Hijo de un consejero del influyente cardenal Mendoza, Vázquez de Arce falleció en un ataque en la Vega de Granada en 1486 tras participar con éxito junto a sus compañeros de la Orden de Santiago en la toma de Loja.</p>
                        <p>Su corta edad -apenas 25 años- lo convirtió en una figura que se ajustaba al ideal renacentista de morir joven en batalla. Su sepulcro, encargado por su hermano Fernando Vázquez de Arce en la catedral de Sigüenza, es una de las joyas del gótico tardío castellano.</p>
                      </div> 
                      <div id="fabrique-alvarez-toledo" class="texto hidden">
                        <h1>Fabrique Álvarez de Toledo, II duque de Alba</h1>
                        <p>Tras los vaivenes políticos de su padre, I duque de Alba, su hijo Fadrique se convierte en hombre de estrecha confianza del rey Fernando, que lo nombra generalísimo de los ejércitos de Andalucía por encima de figuras como el marqués de Cádiz. Como tal liderará buena parte de las operaciones de la segunda mitad de la guerra y estará presente en las Capitulaciones de Granada. Posteriormente, fue el encargado de liderar las tropas de Fernando en la batalla del Rosellón, en 1503, y en la conquista de Navarra, en 1512.</p>
                      </div>
                    </div>
                    
                  </div>
                </div>

            </div>
          </div>
        </div>           
      </article>

      <article id="batalla-lucena" class="element batalla opacity hidden">

       <div id="batalla-lucena-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out" data-duracion="17000">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1483</span>La batalla de Lucena</h1>
                <p class="cita">"¿Dónde vaís soldados? ¿Qué furor ha cegado vuestro entendimiento?" 
                  <span class="cita-author">Boabdil a sus soldados en Lucena</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="03-batalla-lucena"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="03-batalla-lucena"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="batalla-lucena-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-captor paso-popup-left paso-auto paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--escudo-diego_fernandez_cordoba.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">El captor de Boabdil</div>
                <div class="paso-pop-cont">Diego Fernández de Córdoba, alcaide de los Donceles, sobrino del conde de Cabra y esposo de Juana Pacheco -una de las hijas del marqués de Villena don Juan Pacheco-, forma parte del cuerpo de caballería ligera responsable de guardar las fronteras de Castilla en ausencia de los reyes. Durante la batalla de Lucena se encarga de defender la débil fortaleza de Lucena, fronteriza con Loja, donde Aliatar hace incursiones constantes. Tras saber de los planes de éste para atacar Lucena, prepara la defensa y da aviso a su tío, el conde de Cabra, para que envíe un regimiento en su ayuda. Su labor de distracción de los abencerrajes hasta que llegasen refuerzos fue clave para la huida y posterior captura de Boabdil.  Fernández de Córdoba inicia así una exitosa carrera militar que le llevará a participar en las conquistas del rey Fernando en el norte de África y a ser nombrado primer marqués de Comares ya entrado el siglo XVI.<br/><span class="pequenin">Erlenmeyer / Creative Commons </span></div>
              </div>
              <div class="paso-popup paso-pop-alia paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--loja-aliatar.jpg" alt="Ibrahim Aliatar, alcaide de Loja">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">Ibrahim Aliatar</div>
                <div class="paso-pop-cont">El alcaide de Loja defiende con 3000 hombres la ciudad y se convierte en un héroe para los nazaríes, pero su papel va más allá: es el padre de Morayma, la esposa de Boabdil, y se convierte en su consejero cuando decide tomar el poder en Granada. Fallecerá en la fallida toma de Lucena, en 1483.<br/><span class="pequenin">Menesteo / Creative Commons</span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1483 La batalla de Lucena</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Tras hacerse con el poder en Granada, Boabdil busca una victoria sobre los cristianos que le reivindique frente al pueblo. Su suegro, <span class="negrita">Aliatar</span>, el aconseja que ataque Lucena, cerca de Loja, al considerar que está desguarnecida.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="negrita"><span class="ft-gothic">2.</span> Alcaide de los Donceles</span>, responsable de la ciudad, prepara la defensa de la misma y pide refuerzos al conde de Cabra.</div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> En la huida, Boabdil decide esconderse del enemigo pero es descubierto y capturado.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M637.709,961.751c13.453-16.939-8.589-37.25-24.388-22.099"></div>

              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M609.513,906.44c-13.394-16.985-38.227-0.204-27.113,18.655"></div>

              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M581.5,935.134c-54.333-21.999-48.334-81.333,5.333-85.666"></div>

              <div class="paso-ico go-lucena paso-ico-battles paso-ico-arabe paso-auto paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>
              <div class="paso-text tit-lucena paso-auto paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Lucena</div>
              
              <div class="paso-text tit-loja paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Loja</div>
              <div class="paso-ico ico-loja paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-cabra paso-auto paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Cabra</div>
              <div class="paso-ico ico-cabra paso-ico-battles paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-cordoba paso-auto paso-6P paso-6 paso-7P paso-7">Córdoba</div>
              <div class="paso-ico ico-cordoba paso-ico-battles paso-ico-arabe paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

              <div class="paso-text tit-porcuna paso-auto paso-6P paso-6 paso-7P paso-7">Porcuna</div>
              <div class="paso-ico ico-porcuna paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1482.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Lanzas<span>200</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantes<span>800</span></div>
                <div class="cont-title2">Ejército Cristiano</div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Jinetes<span>300</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantes<span>1.200</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
              <p>La decisión de dejar libre a Boabdil para que las divisiones internas en Granada consumiesen por sí mismo al reino es una muestra más de la habilidad política, de "príncipe" renacentista en palabras de maquiavelo, de Fernando el Católico.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/principa" class="go-link" data-id="batalla-lucena-extra-principe-moderno"
                 title="Haz click para visitar el especial">El príncipe moderno</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
          </div>
          </div>
        </div>
      
      </article>

      <article id="batalla-lucena-extra-principe-moderno" class="element extra hidden" >


        <div class="device">

<?php //          <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php //         <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
              <div class="swiper-wrapper">

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e3-intro-principe-moderno"></div>
                    </div>
                  </div>
                </div>

                <div id="batalla-lucena-extra-principe-moderno-paso-1" class="swiper-slide" data-slide="2" data-titulo="Extra principe moderno">

                  <div class="cuadro-info-butt cuadro-info-butt-right">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap"> 
                          Extracto de La rendición de Granada (1882)<br>
                          <span><strong>Francisco Pradilla</strong> Museo Nacional del Prado</span>                            
                      </div> 
                    </div>
                  </div>

                  <div id="intro" class="info izda" >
                    <h1 class="tituloBig minor">El príncipe moderno</h1>
                    <p class="pIntro">
                      "El príncipe", de Nicolás de Maquiavelo, refleja la nueva forma de líder político 1que se perfila en el Renacimiento frente a los elementos feudales de la Edad Media. Uno de los modelos que sigue el filósofo italiano para definir cómo tiene que ser ese nuevo "príncipe"  es el de Fernando el Católico, del que dice que "se ha convertido por su propio mérito y gloria, de rey de un pequeño Estado en primer soberano de la Cristiandad. 
                    <br/><br/>Pero, ¿por qué Fernando pudo ser un rey 'maquiavélico?
                    </p>
                    <a href="#" title="explora las características de un 'príncipe moderno'" id="saber"><span>[ Saber mas ]</span></a>
                  </div>

                  <div id="contenido" class="info izda">

                    <h2>REQUISITOS:</h2>
                    <p id="volver"><span>[ volver ]</span></p>
                    <ul id="requisitos" class="clearfix">
                      <li id="territorios" data-objeto="corona"><img src="/serie-isabel/conquista-de-granada/img/principe/territorios.png"><p>TERRITORIOS</p></li>
                      <li id="guerra" data-objeto="espada"><img src="/serie-isabel/conquista-de-granada/img/principe/guerra.png"><p>GUERRA</p></li>
                      <li id="religion" data-objeto="cruz"><img src="/serie-isabel/conquista-de-granada/img/principe/religion.png"><p>RELIGIÓN</p></li>   
                      <li id="poder" data-objeto="bandera"><img src="/serie-isabel/conquista-de-granada/img/principe/poder.png"><p>PODER</p></li>
                      <li id="diplomacia" data-objeto="escudos"><img src="/serie-isabel/conquista-de-granada/img/principe/diplomacia.png"><p>DIPLOMACIA</p></li>
                    </ul> 
                    <div id="expcorona">
                      <h2 class="subtitulo">LOS TERRITORIOS:</h2>
                      <p class="expContenido">Maquiavelo destaca que, pese a que heredera un reino, Fernando debe casi todos sus dominios a su propia habilidad diplomática. De hecho, Fernando ni siquiera estuvo destinado a ser monarca de Aragón hasta la muerte de su hermanastro, Carlos. Luego, se casa con Isabel, que se proclama reina de una Castilla dividida, pero que finalmente triunfa en la guerra de sucesión y recupera Granada. Como monarca de Castilla, tendrá el dominio del Nuevo Mundo. Como responsable de Aragón, recupera el Rosellón, conquista Navarra, se hace con parte de el Magreb y domina el reino de Nápoles y parte de Italia.</p>
                    </div>
                    <div id="expespada">
                      <h2 class="subtitulo">LA GUERRA:</h2>
                      <p class="expContenido">Maquiavelo aconseja a todo príncipe que tenga presente siempre la próxima batalla y eso será especialmente cierto en el caso de Fernando, que siempre tuvo alguna guerra en el horizonte. Comandará las tropas de Isabel en la guerra de sucesión (1475-79) y la de Granada (82-92). Luego estuvo presente en la primera (1494-1498) y la segunda guerra italiana (1501-1504). También tomó Melilla (1497), Mers-el-Kebir (1505) y Orán (1509) en el norte de África, el Rosellón francés (1503) y Navarra (1513)</p>
                    </div>    
                    <div id="expcruz">
                      <h2 class="subtitulo">LA RELIGION:</h2>
                      <p class="expContenido">Maquiavelo sostiene que Fernando fue un maestro en el empleo de la defensa de la Iglesia Católica en función de sus intereses expansionistas. Primero, para pedir dinero para la invasión de Granada, luego para expulsar a los judíos y cimentar la unidad del estado en torno a una sola confesión. También utilizará la religión para expandirse por el norte de África a costa de los turcos y por la península itálica con el pretexto de defender Roma frente a los franceses.</p>
                    </div>    
                    <div id="expbandera">
                      <h2 class="subtitulo">EL PODER:</h2>
                      <p class="expContenido">Todo príncipe tiene a acumular poder, lo que en la Europa del siglo XVI y XVI supone quitárselo a los nobles. Hasta entonces, el rey era el primero entre los nobles; ahora se trata de lograr de esos nobles una sumisión absoluta al príncipe, de forma que no quede hueco de poder. Fernando embarca a los nobles castellanos en la empresa de Granada mientras l  es va quitando poco a poco su mayor poder, las órdenes militares, que pasará a dirigir a finales de siglo.</p>
                      <p class="expContenido">A cambio, potencia una nueva nobleza sometida a sus deseos y encargada fundamentalmente de los asuntos militares, dejándole a él los políticos. Los máximos representantes son Fabrique, duque de Alba, y el propio Gonzalo Fernández de Córdoba, el Gran Capitán.</p>
                    </div>  
                    <div id="expescudos">
                      <h2 class="subtitulo">LA DIPLOMACIA:</h2>
                      <p class="expContenido">La liberación de Boabdil para que emprendiese una guerra civil contra su padre es la primera de las jugadas maestras de Fernando, capaz de cambiar alianzas para salvaguardar sus intereses.</p>
                      <p class="expContenido">Durante su reinado con Isabel lleva a cabo una política matrimonial orientada a aislar a Francia con lazos con Portugal, Austria e Inglaterra. Compromete a su hija mayor, Isabel, con el heredero de la corona de Portugal Alfonso y luego con su hermano Manuel cuando éste fallece. Similar es el caso de Catalina, comprometida primero con Arturo y luego con Enrique de Inglaterra. El heredero castellano, el infante Juan, se compromete con Margarita de Austria.</p>
                      <p class="expContenido">La muerte de los infantes Juan e Isabel rompe quiebra estas alianzas pero los reyes no dudan en renovarlas: María se casa con el rey de Portugal y Juana con el heredero austríaco, Felipe el Hermoso.</p>
                      <p class="expContenido">Sin embargo, la muerte de Isabel y el posterior enfrentamiento con su yerno, Felipe el Hermoso, provoca un giro de 180 grados en su política: se alía con el enemigo francés al casarse con la sobrina del monarca galo, lo que amenazó con volver a separar Castilla y Aragón si lograba descendencia masculina. Solo su muerte hizo que esta idea quedase enterrada.</p>
                      <p class="expContenido">A cambio, potencia una nueva nobleza sometida a sus deseos y encargada fundamentalmente de los asuntos militares, dejándole a él los políticos. Los máximos representantes son Fabrique, duque de Alba, y el propio Gonzalo Fernández de Córdoba, el Gran Capitán.</p>
                    </div>  

                  </div>
<?php //    <!-- fernando y los objetos ---------------------------------------------------> ?>

                  <div class="imagen">
                    <img id="fernando" src="/serie-isabel/conquista-de-granada/img/principe/fernando.png">
                    <img id="bandera" src="/serie-isabel/conquista-de-granada/img/principe/bandera.png">            
                    <img id="corona" src="/serie-isabel/conquista-de-granada/img/principe/corona.png">           
                    <img id="cruz" src="/serie-isabel/conquista-de-granada/img/principe/cruz.png">
                    <img id="espada" src="/serie-isabel/conquista-de-granada/img/principe/espada.png">
                    <img id="escudos" src="/serie-isabel/conquista-de-granada/img/principe/escudos.png">            
                  </div>
                </div>    
              </div>
            </div>
          </div>
        </div>          
      </article>

      <article id="batalla-alora" class="element batalla opacity hidden">

       <div id="batalla-alora-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1484</span>La batalla de Álora</h1>
                <p class="cita">"Tomaré uno a uno los granos de Granada"
                  <span class="cita-author">Fernando el Católico</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="04-batalla-alora"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="04-batalla-alora"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="batalla-alora-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-popup-top paso-pop-tarazona paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--cuadro-tarazona.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">La crisis de Tarazona</div>
                <div class="paso-pop-cont">La muerte de Luis XI de Francia y su deseo de que los condados de Cerdaña y el Rosellón volviesen a la Corona de Aragón (que se los había cedido a cambio de su apoyo en la guerra civil catalana) desvía a Fernando de la campaña de Granada y provoca tensiones con Isabel. El rey convoca a las Cortes de Aragón en Tarazona para reclamar ambos condados -que terminará recuperando a principios del siglo XVI- pese al rechazo de Isabel de la aventura militar en el norte. Finalmente, la indiferencia de los nobles aragoneses aparca la guerra del Rosellón.<br/><span class="pequenin">Retrato de los Reyes Católicos. Autor desconocido<br>Convento de las Augustinas, Madrigal de las Altas Torres (Ávila)</span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1484 La batalla de Álora</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Las tropas del rey Fernando salen en la primavera de 1484 sin desvelar cuál será el objetivo final de su ofensiva.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> Pensando que va a atacar Loja, Muley Hacén, que tiene de nuevo el poder en Granada, traslada sus efectivos hacia allí.</div>
                <div class="paso-auto paso-fernando paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Fernando sigue el consejo del marqués de Cádiz y cambia de rumbo sobre la marcha hacia Álora, en la serranía de Ronda. Allí las tropas cristianas atacan con artillería a la población civil. </div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M523.521,935.669  c4.506,20.632,22.476,25.82,54.961,31.494"></div>

              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M682.608,972.093c0,0-23.521-21.782-38.977-9.964"></div>

              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M584.907,968.377  c26.249,10.777,14.971,31.862,1.317,47"></div>

              <div class="paso-text tit-alora paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Álora</div>
              <div class="paso-ico go-alora paso-ico-battles paso-ico-arabe paso-auto paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>

              <div class="paso-text tit-ecija2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Écija</div>
              <div class="paso-ico ico-ecija2 paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-loja2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Loja</div>
              <div class="paso-ico ico-loja2 paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1483.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato"></div>
                <div class="wk-col-l wk-col-50 cont-dato"></div>
                <div class="cont-title2"></div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>50.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>3.000</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
              <p>La campaña de 1484 permitió sacar a relucir otra virtud del rey más allá del príncipe renacentista: el estratega militar. Dispone de un nuevo instrumento, la artillería, que le permite forzar las rendiciones de la población civil harta de los bombardeos sin apenas bajas en el frente.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/artilleria" class="go-link" data-id="batalla-alora-extra-artilleria"
                 title="Haz click para visitar el especial">La artillería</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
          </div>
          </div>
        </div>
      </article>

      <article id="batalla-alora-extra-artilleria" class="element extra hidden">

        <div class="device">
<?php    //       <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php      //   <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
              <div class="swiper-wrapper" >

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e4-intro-artilleria"></div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide" data-slide="2" data-titulo="Artillería" >
                  <div class="content-slide" >
                    <h1 class="titArtilleria">Artillería</h1>
                    <p class="intro">Antes de los Reyes Católicos, Castilla carecía de un cuerpo militar estructurado, dejando el peso de la guerra en mano de los nobles.
                      El principal instrumento bélico era el choque de caballería a campo abierto y las luchas intestinas entre los reinos peninsulares dependían
                      en muchos casos de la ayuda de potencias externas. Un elemento clave va a cambiar ese panorama: el uso de la artillería.
                    </p>
                    <div class="leftArti">
                      <img style="display:inline" class="lombarda" src="/serie-isabel/conquista-de-granada/img/artilleria/lombarda.png">
                    </div>
                    <div class="rightArti">
                    <p class="infoArt">El rey Fernando empleará este arma hasta la extenuación en la Guerra de Granada, donde incorporará novedades precursoras de la artillería de campaña. Paradójicamente, fue usada por primera vez en la península por el Reino de Granada en su ataque contra las fronteras cristianas de Alicante y Orihuela, en 1331 y en la defensa de Algeciras en 1342. Poco después, en 1375,  funcionaba ya en Zaragoza una fábrica de piezas de artillería que producía “truenos” o cañones. 
                    Las tropas cristianas usan la artillería con tres objetivos: derribar sus murallas, destruir sus defensas y atemorizar a la población civil.
                    </p>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide" data-slide="3" data-titulo="Derribar murallas: la lombarda o bombarda">
                  <div class="content-slide" >
                    <h1 class="subtitArtilleria">DERRIBAR MURALLAS: LA LOMBARDA O BOMBARDA</h1>
                    <p class="intro">Los Reyes Católicos usan la bombarda como herramienta principal de su cuerpo de artillería, que estaba en la ciudad de Écija, cerca de la frontera. Su ventaja era que la mayoría de las fortalezas medievales no estaban protegidas contra estas armas sino que solo estaban concebidas para repeler el ataque de infantería. Por eso, dado que el Reino de Granada estaba formado por ciudades fuertemente fortificadas, Fernando usa este método para evitar los asaltos.
                    Las bombardas durante los siglos XIV y XV eran de hierro forjado, aunque a finales del XV empiezan a fabricarse de bronce. Es la precursora del cañón y está formada por dos partes separadas: la caña o tomba, que es la que recorría el proyectil, y la recámara, servidor o mascle, que es la que contenía la pólvora. Cada bombarda iba dotada de dos o más disparos, que le permitían realizar unos ocho disparos como máximo. 
                    </p>
                    <div class="infoCaract">                                        
                    <h3 class="subtitDestruir">CARACTERISTICAS</h3>
                    <p class="infoPasa">
                      <span class="caracteristicas">Dimensiones:</span><br/>Las bombardas podrían llegar a pesar hasta seis toneladas (la mayor
                      conocida, empleada en 1410 en el sitio de Antequera, necesitó 40 bueyes y
                    200 hombres para su transporte). 
                    </p> 
                    <p class="calibre">
                      <span class="caracteristicas">Calibre:</span>  De 20 a 30 cm.<br/>
                      <span class="caracteristicas">Longitud:</span> 12 calibres </span>
                    </p>   
                    </div>                    
                    <div class="infodoble">
                      <img class="lombardas" src="/serie-isabel/conquista-de-granada/img/artilleria/lombardas.png">
                    </div>
                    <div class="infoCaract">                                        
                    <p class="infoPasa">
                      <span class="caracteristicas">Alcance:</span> </br>
                        El máximo era de 1.300 metros pero era eficaz solo
                        de 100 a 200 metros porque se tenía que apuntar a ojo.
                    </p> 
                    <p class="municion">
                      <span class="caracteristicas">Munición:</span><br/>  En principio se utilizaban enormes bolaños de piedra, de
                      unos 150 kilos de peso, que luego fueron sustituidos por
                      enormes bolas de hierro forjado llamados pellas (250 kilos). 
                    </p>   
                  </div>
                  </div>
                </div> 
                <div class="swiper-slide" data-slide="4" data-titulo="Destruir defensas: La artillería ligera">
                  <div class="content-slide" >
                    <h1 class="subtitArtilleria">Destruir defensas: La artillería ligera</h1>
                    <p class="intro">Para sus campañas bélicas, Fernando se da cuenta que el principal problema que tiene es la escasa movilidad de la artillería, sobre todo en el terreno escarpado del Reino de Granada. De ahí que se generalicen durante esta guerra las armas de artillería ligera, que tienen como principal misión reducir los posibles ataques de la infantería desde las murallas o de la caballería a campo abierto contra las bombardas.
                    </p>
                    <div class="infodoble">
                      <img class="bombardeta" src="/serie-isabel/conquista-de-granada/img/artilleria/bombardeta.png">
                    </div>                    
                    <div class="infomortero">
                      <img class="ribadoquin" src="/serie-isabel/conquista-de-granada/img/artilleria/ribadoquin.png">
                    </div>  
                    <div class="mortero">                                        
                    <h3 class="subtitDestruir">Bombardetas o pasavolantes</h3>
                    <p class="infoPasa">De menos calibre que la bombarda (7 u 8 cm) y más longitud (29 calibres). 
                          Esta arma de artillería ligera se usa sobre todo para derribar a la infantería 
                          enemiga que ejercía la defensa de la ciudad desde las almenas de las 
                          murallas debido a que tenía mucho más puntería que la bombarda.
                    </p> 
                    <h3 class="subtitDestruir">Ribadoquines</h3>
                    <p class="infoPasa">De forma parecida a la bombardeta pero de menor calibre. 
                    Su longitud es intermedia entre la cerbatana y la bombardeta.
                    </p>   
                    </div>


                  </div>
                </div>                 
                <div class="swiper-slide" data-slide="5" data-titulo="Sembrar el pánico: Los morteros o pedreros">
                  <div class="content-slide" >
                    <h1 class="subtitArtilleria">Sembrar el pánico: Los morteros o pedreros</h1>
                    <p class="intro">Para la estrategia de acoso a ciudades  sitiadas, los Reyes Católicos no solo usaron armas de tiro rasante para derribar las murallas, 
                      sino que también emplearon por primera vez las de tiro curvo, capaces de superarlas y caer sobre la población civil,  como los modernos obuses.
                      Los morteros son más cortos que las bombardas y su boca es más ancha, con el objetivo de conseguir que los bolaños hagan una trayectoria elíptica, superen las murallas y caigan directamente sobre los núcleos de población.
                      <span style="margin-top:40px">En el sitio de Ronda (1484) se informa del uso  de balas de fuego, huecas, con carga explosiva interior, precursoras de las modernas bombas. La técnica llega a su máxima expresión en el sitio de Málaga, tal y como narra el cronista Alonso de Palencia.</span>
                    </p>
                    <div class="infomortero">
                    <p class="infoPedrero">“En el interior de la ciudad ya no quedaba edificio a que no hubiesen alcanzado los terribles efectos de las balas de piedra disparadas por los morteros desde las primeras horas de la noche hasta el amanecer, con muerte de muchos habitantes. Nadie creía que pudiera diferirse mucho tiempo la rendición de la ciudad”.
                    </p>                      
                    </div>
                    <div class="mortero">
                      <img class="pedrero" src="/serie-isabel/conquista-de-granada/img/artilleria/pedrero.png">
                    </div>
                  </div>
                </div>     
 

              </div> 
            </div> 

        </div>
      
      </article>

      <article id="sitio-ronda" class="element batalla opacity hidden">

       <div id="sitio-ronda-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1485</span>El sitio de Ronda</h1>
                <p class="cita">"Enviaré todo lo necesario para abastecer a la hueste" 
                  <span class="cita-author">Isabel a Fernando, según Fernando del Pulgar</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="05-sitio-ronda"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="05-sitio-ronda"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="sitio-ronda-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-popup-top paso-pop-zagal paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--cuadro-zagal.jpg">paso-pop-
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">El Zagal</div>
                <div class="paso-pop-cont">Abū `Abd Allāh Muhammad az-Zaghall, El Zagal, gobernador de Málaga, hermano de Muley Hacén, afirma sus aspiraciones políticas al derrotar a los cristianos en su expedición por la Axarquía,  el mayor éxito militar del bando musulmán. Desde entonces se convierte en el principal sostén militar de su hermano, pero cuando éste cae enfermo y se marcha de la ciudad, prepara el terreno para erigirse en emir de Granada. <br/><br/>Parte desde Málaga para hacerse cargo de la Alhambra ante el vacío de poder. En el camino, derrota a los castellanos en la batalla de Moclín y mata a 90 cristianos procedentes de Alhama que estaban saqueando la zona de Sierra Nevada. Su entrada triunfal en la ciudad con las cabezas de los saqueadores le asegura el fervor popular necesario para hacerse con el control del reino.</div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1485 El sitio de Ronda</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Los ejércitos de Fernando amagan con ir a Málaga, el mayor puerto del reino de Granada, gobernado por el hermano de Muley Hacén, El Zagal.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> Allí consigue evitar que los refuerzos de los granadinos lleguen a Ronda, que queda sitiada durante quince días y dividida en cinco partes.  La estrategia de la artillería termina por menguar las débiles fuerzas de la ciudad, que acaba rindiéndose. </div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Tras la caída de Ronda, la campaña cristiana se centra en el llamado Algarve malagueño, donde caen ciudades como Marbella, Fuengirola o Cárcama.</div>
              </div>
                  
              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M533.5,936.002  c43.5,17.167,52.833,31.834,54.25,92.354"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M693,996.503  c-7.333,19.333-70.667,6.666-93.333,18.666"></div>
              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M421.667,1066.503  c23.333,35.333,64,11.333,85.333-13.001"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M520.333,1054.503c-11.333,8-4,26,9.333,20"></div>
              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M535.021,1034.571  c14.646-7.401,31.979,3.933,32.707,16.384"></div>

              <div class="paso-text tit-ronda paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Ronda</div>
              <div class="paso-ico go-ronda paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>

              <div class="paso-text tit-ecija2 paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Écija</div>
              <div class="paso-ico ico-ecija2 paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-malaga paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Málaga</div>
              <div class="paso-ico ico-malaga paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>
              <div class="paso-text tit-cadiz paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Cádiz</div>
              <div class="paso-ico ico-cadiz paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

              <div class="paso-text tit-fuengi paso-auto paso-6P paso-6 paso-7P paso-7">Fuengirola</div>
              <div class="paso-ico ico-fuengi paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>
              <div class="paso-text tit-marbella paso-auto paso-6P paso-6 paso-7P paso-7">Marbella</div>
              <div class="paso-ico ico-marbella paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1483.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="cont-dato">carros de artillería<span>1.110</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Lanzas<span>11.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Peones<span>25.000</span></div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>1.500</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>20.000</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
              <p>La victoria de Ronda tiene por primera vez eco en Europa, donde se comenta la posibilidad cierta de que los musulmanes sean expulsados del último reino de Europa occidental justo en plena ofensiva de los turcos en el Mediterráneo. Fernando no pierde oportunidad de subrayar esta circunstancia en un mensaje que remite al Papa en 1485: "Que sepa su santidad en lo que en España gastamos tiempo y dinero".  Después de la conquista de Granada, Fernando e Isabel fueron nombrados por Alejandro VI “católicas majestades”.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/inquisicion" class="go-link" data-id="sitio-ronda-extra-relaciones-iglesia"
                 title="Haz click para visitar el especial">Las relaciones con la iglesia</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
          </div>
          </div>
        </div>

      </article>

      <article id="sitio-ronda-extra-relaciones-iglesia" class="element extra hidden">


        <div class="device">
<?php    //       <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php      //   <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
            <div class="swiper-wrapper" >

              <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                <div class="wrap-table" style="width: 100%">
                  <div class="wrap-table-cell">
                    <div class="video-wrap" data-filename="e5-intro-iglesia"></div>
                  </div>
                </div>
              </div>

<?php      //   <!-- Slide1 intro ------------------------------------------------------> ?>
              <div class="swiper-slide" data-slide="2" data-titulo="Las relaciones con la Iglesia" >

                <h1 class="titRelaciones">LAS RELACIONES CON LA IGLESIA</h1>
                <p class="pintroRelig">
                  Isabel y Fernando utilizaron desde el inicio de su reinado el catolicismo como elemento de unidad de sus reinos. Fue así como pasó a tener una relación privilegiada con la iglesia de Roma, quien llegó a otorgarles el título de 'católicas majestades' tras la Reconquista de Granada en 1492 y depositó en ellos la responsabilidad de evangelizar el Nuevo Mundo.
                </p>

                <div class="static-slide papa-wrap clearfix" data-titulo="marco">

                  <div class="imagenPapa">

                    <img id="fondomarco" class="fondomarco" width="369px" height="393px" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/fondomarco.jpg">

                    <div id="imagenesPapa">
                      <div class="img-papa-wrap">
                      </div>
                    </div> 

                    <img id="marco" class="marco" width="369px" height="393px" src="/serie-isabel/conquista-de-granada/img/relaciones-iglesia/marco.png">           
                    
                  </div>

                  <div class="detallePapa static">

                    <div id="pagination">
                      <ul class="papas-controls">
                        <li><a href="#" title="Más información del papa Sixto IV">Sixto IV</a></li>
                        <li><a href="#" title="Más información del papa Inocencio VII">Inocencio VII</a></li>
                        <li><a href="#" title="Más información del papa Alejandro VI">Alejandro VI</a></li>
                        <li><a href="#" title="Más información del papa Julio II">Julio II</a></li>
                      </ul>              
                    </div>

                    <div id="detallePapa-sixto-iv" class="detalle-papa papa hidden" data-titulo="Sixto IV">
                      <h1 class="titPapa">Sixto IV</h1>
                      <p class="infoPapa">
                       Fue el Papa Sixto IV quien autorizó la inquisición en España en 1478, a petición de los monarcas, dándoles plenos derechos de organizar una estructura que erradicara la herejía. Una decisión de la que se arrepintió años después ante las innumerables tropelías que se llegaron a cometer en nombre de Dios. La Reina aceptó entonces tener un enviado de Roma para supervisar los actos de la Inquisición, pese a lo que continuaron los autos de fe.
                       Sixto IV fue también el papa que sello la bula del matrimonio entre Alfonso V con su sobrina la princesa Juana, lo que dio alas a Portugal para renovar su aventura castellana e importunó sumamente a los Reyes Católicos. 
                      </p>
                    </div> 

                    <div id="detallePapa-inocencio-vii" class="detalle-papa papa hidden" data-titulo="Inocencio VII">
                      <h1 class="titPapa">Inocencio VII</h1>
                      <p class="infoPapa">
                       Continuó con las buenas relaciones con Castilla de su precedesor y amplió su apoyo a la Inquisición, llegando a nombrar como gran inquisidor de España a Tomás de Torquemada.
                       Bajo su mandato, se amplió la bula de la Cruzada, como ayuda económica a la guerra contra el reino nazarí que se estaba librando en Granada y única buena nueva ante los avances expansionistas del imperio otomano.
                      </p>
                    </div>

                    <div id="detallePapa-alejandro-vi" class="detalle-papa papa hidden" data-titulo="Alejandro VI">
                      <h1 class="titPapa">Alejandro VI</h1>
                      <p class="infoPapa">
                      Rodrigo de Borgia, quien intercediera por la bula papal para el matrimonio de Isabel y Fernando, fue elegido papa en el Annus mirabilis de 1492. Tras la victoria en Granada, el papa otorgó en 1496 el título de 'católica majestad' a los monarcas, que pasaron a conocerse como Reyes Católicos.
                      Además, el papa aprobó las Bulas Alejandrinas, un conjunto de cinco documentos pontificios que otorgaban a Castilla el derecho a conquistar América y la obligación de evangelizarla. La dinastía de Trastamara se convirtió así en defensora del catolicismo en Europa frente al avence del Imperio Otomano y los evangelizadores en el Nuevo Mundo. 
                      </p>
                    </div>

                    <div id="detallePapa-julio-ii" class="detalle-papa papa hidden" data-titulo="Julio II">
                      <h1 class="titPapa">Julio II</h1>
                      <p class="infoPapa">
                        Después del brevísimo Pontificado de Pío III, asumió la vacante Julio II, a quien se conoció como el "Papa guerrero" por la intensa actividad política y militar de su pontificado. Este papa, para agradecer a Fernando su apoyo en la guerra contra los franceses, aprobó una bula papal por la cual excomulgaba a todos quienes hubieran apoyado a Francia en la guerra, entre los que se encontraba la entonces poseedora de la Corona de Navarra Catalina de Foix. Según el mandato del Papa, quedaba desposeída de ese reino, que pasaría a manos del que se diera más prisa en conquistar las tierras. Fue Fernando quien se apresuró a invadir Navarra con un ejército castellano al mando de Fadrique Álvarez de Toledo, II duque de Alba. 
                      </p>
                    </div>

                  </div>

                </div>

              </div>

            </div>
          </div>  

        </div>
      </article>

      <article id="batalla-loja" class="element batalla opacity hidden">

       <div id="batalla-loja-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1486</span>La batalla de Loja</h1>
                <p class="cita">"Todas las banderas bajaban cuando la reina pasaba" 
                  <span class="cita-author">Andrés Bernáldez, Memoria de los Reyes Católicos</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="06-batalla-loja"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="06-batalla-loja"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="batalla-loja-paso-2"  class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-zegries paso-popup-left paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--castillo-moclin.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">La fortuna de Moclín</div>
                <div class="paso-pop-cont">La victoria sobre Loja animó a las tropas cristianas frente a unos musulmanes más divididos que nunca. Pronto cayeron otras localidades cercanas a Granada como Montefrío e Íllora, pero lo más extraordinario iba a ocurrir en Moclín.En un golpe de fortuna que algunos atribuyeron a la dividinidad, la fortaleza casi inexpugnable cayó cuando la artillería impactó en el depósito de explosivos de la localidad, que acabó en llamas. <br><span class="pequenin">Castillo de Moclín (Granada)<br>Pepepitos / Creative Commons </span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1486 La batalla de Loja</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Fernando quiere desquitarse de la derrota de Loja y prepara toda su artillería en Écija para conquistar la ciudad.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> El Zagal envía a Boabdil a defender Loja tras alcanzar la paz después de una nueva guerra civil.</div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body paso-loja-txt-3"><span class="ft-gothic">3.</span> Fernando establece un riguroso cerco sobre la localidad granadina, que se rinde a la fuerza de la artillería en un solo día. Luego, Castilla toma varias ciudades vecinas, como Montefrío, Íllora y Moclín.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M536.167,914.166c11.333-4.666,36.951-3.411,48,9.334"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M676.834,986.833c-16.667,19.333-72.667,10.667-79.333-20"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M610.917,935.999c3.675-0.841,9.016,3.667,30-7.75"></div>
              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M605.89,928.982c1.026-5.982,3.276-13.482,11.276-18.232"></div>

              <div class="paso-text tit-loja3 paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Loja</div>
              <div class="paso-ico go-loja2 paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>
              
              <div class="paso-text tit-ecija2 paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Écija</div>
              <div class="paso-ico ico-ecija2 paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>

              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

              <div class="paso-text tit-ilora paso-auto paso-6P paso-6 paso-7P paso-7">Ílora</div>
              <div class="paso-ico ico-ilora paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-montef paso-auto paso-6P paso-6 paso-7P paso-7">Montefrío</div>
              <div class="paso-ico ico-montef paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1483.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Bajas<span>400</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Heridos<span>500</span></div>
                <div class="cont-title2">Bajas Cristianas</div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>4.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>500</span></div>
                <div class="cont-title2">Resistencia Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end map-wrap-steps-end-full clearfix">
              <p>
                <h2 class="label">
                  <a href="/serie-isabel/conquista-de-granada/extra/isabel" class="go-link" data-id="batalla-loja-extra-papel-isabel"
                   title="Haz click para visitar el especial">El papel de Isabel en la batalla</a>
                  <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
                </h2>
                1486 fue el año en el que Isabel por primera vez pisó un campo de batalla y ya no dejó de hacerlo hasta la capitulación de Granada. Isabel había creado el hospital de campaña,para atender a los heridos en retaguardia, que posteriormente dará lugar al Hospital de la Reina de Granada. Además, no dudará en pedir a todos los nobles que aporten las armas y los hombres necesarios.
              </p>
            </div>
          </div>
          </div>
        </div>

      
      </article>

      <article id="batalla-loja-extra-papel-isabel" class="element extra hidden">


        <div class="device">
<?php    //       <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php      //   <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
            <div class="swiper-wrapper" >

              <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                <div class="wrap-table" style="width: 100%">
                  <div class="wrap-table-cell">
                    <div class="video-wrap" data-filename="e6-intro-papel-isabel"></div>
                  </div>
                </div>
              </div>

              <div  class="swiper-slide" data-slide="2" data-titulo="El papel de Isabel en la guerra"> 

                <div class="bl-papel-main">
                  <div class="wrap-table">
                    <div class="wrap-table-cell">
                      <h1 class="tituloBig">El papel de Isabel<br>en la guerra</h1>
                      <p>Si Fernando fue el rey-soldado, Isabel tuvo durante toda la guerra un papel fundamental como impartidora de Justicia y como recaudadora de fondos para la contienda. </p>
                      <p>Ella sola se bastó, por ejemplo, para restablecer el orden en Segovia cuando la ciudad se amotinó y supo pedir aportaciones a unos y otros para llevar a cabo la gran empresa de su reinado: la Reconquista.</p>
                    </div>
                  </div>
                </div>
                <div class="bl-papel-cuadro bl-papel-cuadro-act">
                  <div class="bl-papel-cuadro-wrap">
                    <div class="pop pop-1 pop-left pop-top"><div class="pop-num">?</div>
                      <div class="pop-inn">
                        <h2>Impone justicia</h2>
                        <p>Antes de que diese comienzo la Guerra, Isabel ya había demostrado su capacidad y voluntad de impartir justicia. La Reina justiciera y rigurosa asumía su papel de reprimir con mano dura cualquier exceso, como cuando en su viaje a Sevilla en 1477 impuso sentencias duras ante robos y atropellos. Ella prefería ser temida a ser amada, según relatan los historiadores. </p>
                      </div>
                    </div>
                    <div class="pop pop-2 pop-left"><div class="pop-num">?</div>
                      <div class="pop-inn">
                        <h2>Pide dinero al Papa</h2>
                        <p>Roma estaba sensibilizada con el avance del Imperio turco y vieron en la empresa de los Reyes Católicos uno de los pocos recursos para luchar contra el Islam. Los Reyes obtuvieron así los beneficios de la predicación de la Bula de Cruzada, además de importantes aportaciones del clero castellano, que además de oraciones ofrecía oro.</p>
                      </div>
                    </div>
                    <div class="pop pop-3 pop-right pop-top"><div class="pop-num">?</div>
                      <div class="pop-inn">
                        <h2>Acude al 'tesoro' judío</h2>
                        <p>Tantos miles de caballeros, soldados y artilleros implicaban un gasto enorme, que superaba en mucho las posibilidades económicas de la Corona. La Reina decidió entonces acudir a los hombres de negocio de la época, los judíos, que representaban una minoría de gran influencia en la Corte. Abraham Seneor llegó a ser uno de los principales mecenas en la guerra contra el reino nazarí. El hecho de que la Reina persiguiera el dinero judío despertó el malestar del Inquisidor General, Tomás de Torquemada.</p>
                      </div>
                    </div>
                    <div class="pop pop-4"><div class="pop-num">?</div>
                      <div class="pop-inn">
                        <h2>Empréstitos a los nobles</h2>
                        <p>Los nobles, que luchaban en el frente junto al Rey, también vieron cómo la Reina sacudía sus bolsillos en busca de dinero con el que continuar la guerra. Isabel puso en marcha el sistema de empréstitos a la nobleza y al alto clero para dividir en participaciones las acciones de la guerra. También recaudó fondos en la Santa Hermandad, institución que ellos mismos habían creado para perseguir a los herejes, y que hicieron varias donaciones en distintas fases de la guerra.</p>
                      </div>
                    </div>
                    <img src="/serie-isabel/conquista-de-granada/img/img--cuadro-papel-isabel.jpg" alt="">
                  </div>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                          Cortejo del bautizo del príncipe don Juan, hijo de los Reyes Católicos, por las calles de Sevilla (1910)<br>
                          <span><strong>Francos Pradilla y Ortiz</strong> Museo Nacional del Prado</span>                          
                      </div> 
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>  
      </article>

      <article id="sitio-malaga" class="element batalla opacity hidden">

       <div id="sitio-malaga-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1487</span>El sitio de Málaga</h1>
                <p class="cita">“Cosa maravillosa resultó a los que vieron la destrucción de Málaga. En pocas horas no quedó de ella alma viva. Los muertos, comidos por los perros, y los vivos llevados cautivos a tierra de los cristianos” 
                  <span class="cita-author">Hernando de Pulgar</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="07-sitio-malaga"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="07-sitio-malaga"></div> 
              </div>
            </div>
          </div>

        </div>

        <div id="sitio-malaga-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-zegries paso-popup-left paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--muralla-malaga.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">El mayor castigo de la guerra</div>
                <div class="paso-pop-cont">La estrategia de Castilla desde la batalla de Álora se basa en el estado de sitio de las ciudades que, sometidas a la artillería, deciden rendirse por el alto número de bajas civiles.  En el caso del sitio de Málaga esta técnica llega a su mayor desarrollo por la extensión del estado de sitio y la magnitud del enfrentamiento: desde la política de tierra quemada hasta el aislamiento marítimo, la ciudad andaluza sufrió el mayor castigo de la guerra.<br><span class="pequenin">Muralla del Castillo de Gibralfaro<br>Fabio Alessandro Locati / Creative Commons</span>
                </div>
              </div>
            <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end map-wrap-steps-end-full map-wrap-steps-end-full2 clearfix">
              <p>
                <h2 class="label">
                  <a href="/serie-isabel/conquista-de-granada/extra/sitio" class="go-link" data-id="sitio-malaga-extra-estado-sitio"
                   title="Haz click para visitar el especial">Estado de sitio</a>
                  <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
                </h2>
                <p>El cerco de Málaga es el más duro de la Guerra de Granada. Su larga duración y la resistencia a rendirse de los zegríes hicieron llevar a su máxima expresión la técnica del estado de sitio, usada por las tropas cristianas durante toda la contienda.</p>
              </p>
            </div>
              <div class="paso-popup paso-popup-top paso-pop-atenta paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/img--atentado-malaga.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">El atentado fallido</div>
                <div class="paso-pop-cont">Un suceso durante la toma de Málaga impactó especialmente a los cronistas. Un musulmán malagueño, haciéndose pasar por negociador, entró en el campamento cristiano dispuesto a matar a los Reyes. Tras burlar la vigilancia de los guardas se metió en una de las tiendas pensando que era la de la reina al ver a dos personajes de la corte. En realidad quien se encontraba allí fue la dama de confianza de Isabel, Beatriz de Bobadilla, que resultó herida tras ser atacado con un cuchillo. El suceso provocó un fuerte impacto en los monarcas, que se vería luego en las duras condiciones impuestas a la rendición de la ciudad.<br><span class="pequenin">Escena de la batalla de Málaga<br>Sillería de la Catedral de Toledo, de Rodrigo Alemán<br>Casiano Alguacil (Ayuntamiento de Toledo)</span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1487 El sitio de Málaga</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Fernando inicia la decisiva campaña de conquista de Málaga atacando Velez-Málaga.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> El Zagal envía una refuerzo a Vélez Málaga para salvar la ciudad pero es derrotado por los refuerzos cristianos.</div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> El alcalde de Málaga ofrece una rendición pacífica pero los norteafricanos acantonados en Gibralfaro se hacen con la ciudad. Tras varios meses de cerco y ante la carestía de alimentos la población local precipita la rendición.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M539.079,922.349  c60.462,0.443,71.341,106.16,97.795,106.442"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-4 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                data-path="M692.208,994.124c0,0,4,30.668-32,32.668"></div>
                  
              <div class="paso-rapharrow paso-rapharrow-6 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M642.208,1050.125c0,0-2,24-31.486,1.42"></div>
                  
              <div class="paso-ico ico-malaga2 paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>
              <div class="paso-text tit-malaga2 paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Málaga</div>
              
              <div class="paso-text tit-velez paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Vélez-Málaga</div>
              <div class="paso-ico ico-velez paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-ecija2 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Écija</div>
              <div class="paso-ico ico-ecija2 paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-grana paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Granada</div>
              <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1485.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>12.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>50.000</span></div>
                <div class="cont-title2">Ejército Cristiano</div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l cont-dato" style="width: 100%">Infantería<span>5.000</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

          </div>
          </div>
        </div>
      
      </article>

      <article id="sitio-malaga-extra-estado-sitio" class="element extra hidden">

        <div class="device">
<?php //          <!-- flechas de navegacion ----------------------------------------------> ?>

            <a class="arrow-left" href="#"></a> 
            <a class="arrow-right" href="#"></a>
            <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>



<?php //        <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container swiper-content" >
              <div class="swiper-wrapper">

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e7-intro-sitio"></div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide" data-slide="2" data-titulo="Estado de Sitio">
                  <div class="content-slide">
                      <h1 class="titEstado">Estado de Sitio</h1>
                      <p class="introEstado">
                        La guerra de Granada supone el inicio de un tipo de asedio total alejado de las gestas caballerescas que coronaron las historias de la Reconquista. Así, los Reyes Católicos no buscan tanto heroicidaades personales como las de El Cid como un minucioso plan de acoso y derribo que lleve a la población civil a rendirse. En el caso del asedio a Málaga esta técnica llega a su máxima expresión.
                      </p>          
                  </div>
                </div>

                <div class="swiper-slide" data-slide="3" data-titulo="Tierra Quemada"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria" src="/serie-isabel/conquista-de-granada/img/sitio/sitio.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto">
                        Paso 1: Granada. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Primera fase</h2>
                      <h1 class="titulofase" >Tierra Quemada</h1>
                      <p class="detallefase">Antes de comenzar el sitio, las tropas de Fernando ponen en marcha la quema de cultivos y la tala de árboles para dejar sin recursos a la ciudad sitiada. En el caso de las ciudades menos guarnecidas y más dependientes de la agricultura local, esta técnica es suficiente para la rendición, como ocurrió con algunas localidades de Almería.</p>
                    </div>            
                  </div>
                </div>

                <div class="swiper-slide"  data-slide="4" data-titulo="Primeras negociaciones"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/negociacion.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto">
                        Paso 2: Almería. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Segunda fase</h2>
                      <h1 class="titulofase" >Primeras negociaciones</h1>
                      <p class="detallefase">
                        Buena parte de las victorias cristianas en la guerra se producen por el propio temor de los civiles a sufrir el mismo castigo que ciudades vecinas. Eso ocurrió tras la batalla de Álora o el sitio de Ronda, cuando en los alrededores se avinieron a negociar una rendición para evitar la destrucción de sus ciudades y salvar alguna de sus propiedades.
                      </p>
                    </div>            
                  </div>
                </div>     

                <div class="swiper-slide"  data-slide="5" data-titulo="Campamento"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/campamento.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 3: Málaga. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Tercera fase</h2>
                      <h1 class="titulofase">El campamento</h1>
                      <p class="detallefase">
                        Fernando establece campamentos permanentes a las afueras de las ciudades para dejar claro que no se van a marchar hasta que se rindan. A medida que la guerra avanza estos campamentos se vuelven más sofisticados e incluso parecen ciudades, como ocurrió con el de Santa Fe en las afueras de Granada.
                      </p>
                    </div>            
                  </div>
                </div>

                <div class="swiper-slide"  data-slide="6" data-titulo="Primer Ataque de Artilleria"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/primer-ataque.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 4: Lucena. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Cuarta fase</h1>
                      <h1 class="titulofase" >Primer Ataque de Artillería</h1>
                      <p class="detallefase">
                        Las tropas castellanas emprenden el bombardeo contra las murallas de las ciudades para abrir un hueco y entrar con las tropas para tomar la ciudad.
                      </p>
                    </div>            
                  </div>
                </div>                

                <div class="swiper-slide"  data-slide="7" data-titulo="Segundo Ataque de Artillería"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/segundo-ataque.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 5: Alhama. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Quinta fase</h1>
                      <h1 class="titulofase">Segundo Ataque de Artillería</h1>
                      <p class="detallefase">
                        Si la muralla no cae, el ejército usa una técnica mucho más sangrienta: lanzar ataques de artillería curva (precedente de los obuses) en los que se lanzan bolas de fuego o con pólvora dentro de la ciudad para atacar a la población civil. El objetivo: fomentar la rendición de la ciudad por la presión de los ciudadanos.
                      </p>
                    </div>            
                  </div>
                </div>        

                <div class="swiper-slide"  data-slide="8" data-titulo="Segundas Negociaciones"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/negociacion6.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 6: Moclín. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Sexta fase</h1>
                      <h1 class="titulofase">Segundas Negociaciones</h1>
                      <p class="detallefase">
                        En condiciones normales las ciudades suelen rendirse tras varios ataques contra su población, pero en el caso de Málaga el férreo dominio de la ciudad de los zegríes y bereberes provocan una cascada de falsas negociaciones que tenían como objetivo atacar a las tropas castellanas. En un caso incluso un presunto negociador se quiso meter en la tienda de la reina para matar a los monarcas.
                      </p>
                    </div>            
                  </div>
                </div>   

                <div class="swiper-slide"  data-slide="9" data-titulo="Bloqueo Marítimo"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria" src="/serie-isabel/conquista-de-granada/img/sitio/bloqueo.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 7: Zurgena. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Séptima fase</h1>
                      <h1 class="titulofase">Bloqueo Marítimo</h1>
                      <p class="detallefase">
                        Las ciudades con salida al mar tenían una dificultad adicional para su bloqueo: la llegada de barcos con víveres que permitían resistir sine die. En el caso de Málaga era el principal puerto comercial de Granada, la ciudad más rica y por la que llegaban víveres desde África en época de conflicto bélico. De esta forma, por primera vez barcos de Aragón,  País Vasco e incluso el imperio austríaco participan en la contienda  bélica para estrechar el cerco sobre una ciudad acostumbrada a vivir en la abundancia del comercio.
                      </p>
                    </div>            
                  </div>
                </div>  

                <div class="swiper-slide" data-slide="10" data-titulo="La llegada de la Reina"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria" src="/serie-isabel/conquista-de-granada/img/sitio/la_reina.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 8: Gor. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Octava fase</h1>
                      <h1 class="titulofase">La llegada de la Reina</h1>
                      <p class="detallefase">
                        En situaciones de estancamiento, la llegada de Isabel se convierte en un elemento básico de guerra psicológica: reafirmar que los reyes no se van a marchar y que son capaces de llevar su corte hasta la puerta de la ciudad hasta que se rinda. La presencia de Isabel fue clave en Málaga, pero sobre todo en otros sitios posteriores como los de Baza o Cambil.
                      </p>
                    </div>            
                  </div>
                </div>   

                <div class="swiper-slide" data-slide="11" data-titulo="La revuelta interior"> 
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/revuelta.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 9: Loja. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Novena fase</h1>
                      <h1 class="titulofase">La revuelta interior</h1>
                      <p class="detallefase">
                        La falta de víveres por tierra y mar, los bombardeos continuos y la presencia imponente de toda la corte castellana lleva a buena parte de la burguesía comercial de Málaga a rebelarse contra el dominio militar y religioso de los alfaquíes. Por eso designan a Alí Dordux, comerciante local, para negociar en secreto con los reyes y liderar la revuelta contra los zegríes, que pierden la Alcazaba y se amotinan en el castillo de Gibralfaro.
                      </p>
                    </div>            
                  </div>
                </div> 

                <div class="swiper-slide" data-slide="12" data-titulo="La Rendicion">  
                  <div class="content-slide">
                    <div class="infoSitio izda">
                      <img class="silleria"  src="/serie-isabel/conquista-de-granada/img/sitio/rendicion.jpg" alt="Sillería baja del coro de la Catedral de Toledo">
                      <br/>
                      <p class="ml25 piefoto" >
                        Paso 10: Purchena. Sillería baja del coro de la Catedral de Toledo.<br/>Autor: Rodrigo Alemán.<br/>Foto: Casiano Alguacil (Ayuntamiento de Toledo)
                      </p>
                    </div>
                    <div class="infoSitio dcha">
                      <h2 class="fases">Decima fase</h1>
                      <h1 class="titulofase">La Rendicion</h1>
                      <p class="detallefase">
                        Las condiciones de la rendición varían de manera sustancial en proporción a la cantidad de esfuerzo y dinero invertido. Dados los intentos fallidos de negociación y la resistencia ofrecida, Málaga sufre las peores condiciones de la guerra:
                      </p>
                      <ol>
                      <li >  Ejecución de los cristianos renegados y los judíos que apostataron de su conversión.</li>
                      <li >  Cárcel a los bereberes que exaltaron el fanatismo anticastellano.</li>
                      <li >  Esclavitud para todo ciudadano de Málaga, sin distinción de sexo y edad si no  pagan 36 ducados por su libertad.</li>        
                    </div>            
                  </div>
                </div>                 
              </div> 

            <div class="swiper-nav">
              <div class="swiper-wrapper" >
                <div class="swiper-slide">
                  <div></div>
                </div>
                <div class="swiper-slide active-nav">
                  <span class="mask"></span>
                  <span class="nro">1</span>
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb1.jpg" alt="thumb fase 1">
                  <div class="title">El Sitio</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">2</span>
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb2.jpg" alt="thumb fase 2">
                  <div class="title">Negociacion</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">3</span>
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb3.jpg" alt="thumb fase 3">
                  <div class="title">Campamento</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">4</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb4.jpg" alt="thumb fase 4">
                  <div class="title">1er Ataque</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">5</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb5.jpg" alt="thumb fase 5">
                  <div class="title">2º Ataque</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">6</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb6.jpg" alt="thumb fase 6">
                  <div class="title">Negociacion</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">7</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb7.jpg" alt="thumb fase 7">
                  <div class="title">Bloqueo</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">8</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb8.jpg" alt="thumb fase 8">
                  <div class="title">La Reina</div>
                </div>
                <div class="swiper-slide">
                  <span class="mask"></span>
                  <span class="nro">9</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb9.jpg" alt="thumb fase 9">
                  <div class="title">Revueltas</div>
                </div>
                <div class="swiper-slide last" data-slide="12">
                  <span class="mask"></span>
                  <span class="nro">10</span>        
                  <img src="/serie-isabel/conquista-de-granada/img/sitio/thumb10.jpg" alt="thumb fase 10">
                  <div class="title">Rendicion</div>
                </div>  
              </div>
            </div>
      
        </div>              
      </div> 

        </div>
      </article>


      <article id="toma-baza" class="element batalla opacity hidden">

       <div id="toma-baza-paso-1" class="paso hidden" data="paso-1" 
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1488 - 1489</span>La toma de Baza</h1>
                <p class="cita">"Nadie en ella se puede ver tranquilo,/ por los enemigos que quemaron nuestros campos, / por el número inesperado de cautivos; / y por la sangre de los musulmanes derramada. / Porque lo que hoy ocurre en Baza de Granada, no tiene parangón." 
                  <span class="cita-author">Ibn al Qaysi al Basti</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="08-toma-de-baza"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="08-toma-de-baza"></div>
              </div>
            </div>
          </div>

        </div>

        <div id="toma-baza-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">
          <div class="paso-map">
<?php // mapa ?>
            <div class="map-wrap">
<?php  // elementos flotantes fijos a la pantall ?>
              <div class="paso-popup paso-pop-frente paso-popup-left paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/frenteoriental.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">El frente oriental</div>
                <div class="paso-pop-cont">Por primera vez en lo que va de guerra. en 1488 los reyes deciden atacar la parte oriental del Reino de Granada, la más empobrecida y despoblada. Los reyes instalan su campamento en Murcia y atacan desde Lorca localidades como Vera, Mojácar, Huéscar y Cuevas de Almanzora, que se rinden sin mostrar apenas resistencia. Este terreno es, además, el que está destinado a ser el que acoja a Boabdil una vez que rinda Granada cuando derroten a su tío El Zagal.<br><span class="pequenin">Cerro del Espiritu Santo, vestigio de la Vera musulmana</span></div>
              </div>

              <div class="paso-popup paso-popup-top paso-pop-viveres paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <div class="paso-pop-img">
                  <img src="/serie-isabel/conquista-de-granada/img/viveres.jpg">
                  <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                </div>
                <div class="paso-pop-tit">La importancia de los víveres</div>
                <div class="paso-pop-cont">La quema de cultivos y la tala de árboles se convierten en una práctica habitual en esta guerra, hasta el punto de que Fernando consigue que las localidades del levante almeriense se rindan solo al verse sin víveres. Sin embargo, los habitantes de Baza se aprendieron bien la lección y pagaron a las tropas cristianas con su misma moneda: acumularon provisiones para aguantar durante meses mientras que en el campamento de Fernando los soldados se las veían y deseaban para conseguir comida. El resultado fue el cerco más problemático para Fernando durante la guerra, en el que la llegada del invierno y lo escarpado del terreno incluso hizo que sus lugartenientes, como el marqués de Cádiz, aconsejasen la retirada.<br><span class="pequenin">La Alcazaba de Baza, en pleno invierno</span></div>
              </div>

<?php // elementos flotantes relativos al mapa ?>
              <div class="map-wrap-steps">
                <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1489 La toma de Baza</strong></div>
                <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Fernando prepara un gran ejército para tomar Baza, en manos de El Zagal e instala un gran campamento con todos los grandes de España a las afueras.</div>
                <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> Los musulmanes han acumulado víveres para quince meses. La presencia de la reina Isabel y el buen tiempo ayuda a la rendición de la ciudad.</div>
                <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Tras la rendición de Baza, El Zagal se rinde también a los Reyes Católicos y entrega los enclaves deGuadix y Almería.</div>
              </div>

              <div class="paso-rapharrow paso-rapharrow-1 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M697.947,901.724c18.29-1.117,44.373-8.36,61.418-0.12"></div>
              <div class="paso-rapharrow paso-rapharrow-1 paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7"
                data-path="M673.168,943.666c22.604,27.644,46.107-3.504,89.407-6.491"></div>
              
              <div class="paso-rapharrow paso-rapharrow-5 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M783.5,946c0,0-7.646,30.58-26.348,24.354"></div>
              <div class="paso-rapharrow paso-rapharrow-5 paso-auto paso-6P paso-6 paso-7P paso-7"
                data-path="M790.5,948.5c0,0-3.043,29.973,9.5,33c11.002,2.654,12.218,16.535,12.163,23.079"></div>
                  
              <div class="paso-ico ico-baza paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
              </div>
              <div class="paso-text tit-baza paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Baza</div>
              
              <div class="paso-text tit-jaen paso-auto paso-2P paso-2 paso-2P paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Jaen</div>
              <div class="paso-ico ico-jaen paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle4.png">
              </div>
              <div class="paso-text tit-alca paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Alcalá la Real</div>
              <div class="paso-ico ico-alca paso-ico-battles paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-guadix paso-auto paso-6P paso-6 paso-7P paso-7">Guadiz</div>
              <div class="paso-ico ico-guadix paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

              <div class="paso-text tit-almeria paso-auto paso-6P paso-6 paso-7P paso-7">Almería</div>
              <div class="paso-ico ico-almeria paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
              </div>

<?php // mapa wrap ?>
             <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1489.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
             </div>

<?php      //   <!-- Último paso: contador ------------------------------------------------------> ?>
            <div class="paso-auto paso-7 paso-8P paso-8 batalla-contador clearfix">
              <h2 class="cont-title">La batalla en cifras</h2>
              <div class="wk-col-l batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>12.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>50.000</span></div>
                <div class="cont-title2">Ejército Cristiano</div>
              </div>
              <div class="wk-col-r batalla-contador-bot">
                <div class="wk-col-l wk-col-50 cont-dato">Caballería<span>1.000</span></div>
                <div class="wk-col-l wk-col-50 cont-dato">Infantería<span>15.000</span></div>
                <div class="cont-title2">Ejército Nazarí</div>
              </div>
            </div>

  <?php      //   <!-- extra ------------------------------------------------------> ?>
            <div class="paso-auto paso-rendicion paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
              <p>La rendición de Baza, realizada por su propio cuñado, Cidi Yahya, convence a El Zagal de la imposibilidad de ganar a los Reyes Católicos y preparar un último movimiento: rendir Almería y Guadix sin esperar al cerco.. Con la conquista de Almería el reino Nazarí se quedaba sin accesos al mar, quedándose imposibilitada Granada de recibir socorros o avituallamientos del norte de África.</p>
              <h2 class="label">
                <a href="/serie-isabel/conquista-de-granada/extra/perdedores" class="go-link" data-id="toma-baza-perdedores"
                 title="Haz click para visitar el especial">EL OCASO DE LA ESPAÑA MUSULMANA</a>
                <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
              </h2>
            </div>
          </div>
          </div>
        </div>
      
      </article>

      <article id="toma-baza-perdedores" class="element extra hidden">        
        <div class="device">
<?php    //       <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

<?php      //   <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
              <div class="swiper-wrapper" >

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e8-intro-perdedores"></div>
                    </div>
                  </div>
                </div>

<?php      //   <!-- Slide1 intro ------------------------------------------------------> ?>
                <div id="extra-perdedores" class="swiper-slide" data-slide="2" data-titulo="El destino de los perdedores" >
                  <div class="content-slide">
                    <div class="main">
                      <div class="main-wrap">
                        <h1>EL DESTINO DE LOS PERDEDORES</h1>
                        <p>Las luchas intestinas entre las diferentes familias nazaríes terminarán provocando no solo la caída del Reino de Granada, sino la progresiva desaparición de esa dinastía, que acaba en el norte de África reproduciendo sus viejas pendencias. La derrota es también un mazazo en el mundo islámico</p>
                      </div>
                    </div>

<?php      //   <!-- img ------------------------------------------------------> ?>

                    <img title="Mueve el ratón sobre los puntos para mayor información" 
                      alt="cuadro 'El adios del rey Boabdil a Granada'" src="/serie-isabel/conquista-de-granada/img/destino-perdedores/img--cuadro-perdedores.jpg">

                    <div id="loser-q1" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>BOABDIL</h2>
                        <p>En cumplimiento de lo acordado con los reyes, Boabdil se exilia en 1492 a la Alpujarra granadina, donde por unos escasos meses podrá reunir a su familia: recupera a sus hijos (retenidos por los reyes católicos) y vive con su esposa Morayma y su madre Aixa. La alegría dura poco: uno de los menores muere, al igual que su madre Morayma. Tras la tragedia, recoge los restos de sus antepasados de Granada y los entierra junto a los de Morayma en Mondújar.</p>
                        <p>Los Reyes Católicos temen una sublevación y negocian su marcha a África. Tras vender sus posesiones, Boabdil y su familia embarcaron en 1493 junto a 6.320 personas de Granada y de las Alpujarras en doce embarcaciones fletadas por Castilla, que salieron de los puertos de Adra y Almuñécar.</p>
                        <p>Boabdil llega con su familia a Melilla, y pide al sultán de Marruecos autorización para instalarse en Fez bajo su protección. Allí vivirá 40 años más, los más oscuros de su vida, donde será un fiel aliado militar del emir, su amigo, aunque no se volverá a casar ni a tener hijos.</p>
                      </div>
                    </div>
                    <div id="loser-q2" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>AIXA</h2>
                        <p>Aunque las crónicas cristianas la llaman Aixa, también es conocida como Fátima al-Horra, Fatima la Honrada en árabe. Era hija del emir Muhammad IX el Izquierdo, al-Aysar, tío de Abûl-Hasan (Muley Hacén).  Se casó primero con Muhammad XI  y después con Muley Hacén. Acompaña a Boabdil en su primer exilio a las Alpujarras. La leyenda dice que de camino su hijo volvió la vista atrás llorando para contemplar Granada por última vez y Aixa le dijo: "llora como una mujer lo que no supiste defender como un hombre". Debido a esto el puerto de montaña recibe el nombre del Suspiro del Moro. Sea o no cierto, Aixa también siguió a Boabdil en su segundo exilio en Fez, donde moriría al poco tiempo.</p>
                      </div>
                    </div>
                    <div id="loser-q3" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>EL ZAGAL</h2>
                        <p>Tras rendir la plaza de Almería, El Zagal pasa a ser vasallo de los reyes católicos y se convierte en señor de Andarax, Orjivas, Lecrín y Lanjarón. Hasta 1492 ayudará a los reyes a derrotar a su sobrino Boabdil pero tras la caída definitiva de Granada y por tanto también del reino nazarí, comenzó a encontrarse a disgusto por la presión a que era sometido por los monarcas cristianos. Vendió sus territorios a los Reyes  Católicos por cinco millones de maravedíes y se dirigió a Fez  (Marruecos). Allí el emir le despojó de todas sus riquezas, le encerró en un calabozo y le quemó los ojos en nombre de su buena amistad con Boabdil. El Zagal anduvo mendigando errante de aldea en aldea por el norte de África hasta que murió en el año 1500, se cree que en la actual Orán.</p>
                      </div>
                    </div>
                    <div id="loser-q4" class="pop pop-left pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>ZORAYDA</h2>
                        <p>Fue capturada con otros niños a la edad de 10 ó 12 años y llevada a Granada. La pasión senil de Muley Hacén hacia ella hizo que descuidara sus deberes y obligaciones porque estaba seguro de que los cristianos, sumidos en luchas intestinas, no representaban ninguna amenaza para él. Según el cronista Al Maqqarí, Fátima-Aixa temía por la vida de sus hijos Muhammad (Boabdil) y Yúsuf debido a su rivalidad con la favorita cristiana, y por ese motivo se suscitaron entre los servidores del estado la mutua antipatía y el partidismo por la inclinación de los unos hacia los hijos de "La Horra" y de los otros hacia los vástagos de la cristiana. La enfermedad de su esposo la deja sola en Granada y luego le acompañará en su lecho de muerte en Mondújar. El entierro solemne de Mulay Hassán en el Mulhacén -monte al que daríanombre- es una leyenda sin confirmación documental alguna. Tras lo sucedido abjura de la religión musulmana, vuelve a llamarse Isabel de Solís y sus hijos adoptan los nombres cristianos de Fernando y Juan de Granada. A partir de ese momento se pierde su rastro en la historia, ya que, como renegada, su familia la repudió. Se dice que acabó sus días en Asturias,olvidada de todos, pero no hay constancia documental.</p>
                      </div>
                    </div>
                    <div id="loser-q5" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>MORAYMA</h2>
                        <p>Hija de Aliatar, señor de Loja, contrajo matrimonio con Boabdil con tan solo 15 años. Un poeta musulmán la describe así: “Ojos grandes y expresivos en un rostro admirable, a través de las tupidas ropas adivinábanse unos hombros, unos brazos, unas caderas y un talle de clásicos y opulentos contornos”.</p>
                        <p>Su vida estará determinada por la guerra de Granada: primero al ser capturado su marido por los cristianos en Lucena, lo que hace que recupere el trono Muley Hacén, que la somete a arresto domiciliario pocos días después de su boda. Luego, al ser liberado su marido, ya que tiene que dejar a sus hijos pequeños como rehenes en manos de los monarcas. Tras la guerra emprende con su marido y sus hijos recuperados su exilio a Las Alpujarras pero su felicidad dura poco: fallece a los pocos meses, poco antes de que el resto de su familia parta hacia el norte de África. Es enterrada en la mezquita de Mondújar, a la que ya habían trasladado, desde la Alhambra, los restos de los sultanes Mohammad II, Yusef I, Yusef III y Abu Saad.</p>
                      </div>
                    </div>
                    <div id="loser-q6" class="pop pop-left pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>ARISTOCRACIA NAZARÍ</h2>
                        <p>Buena parte de la aristocracia nazarí se pasa al bando castellano y se convierte al cristianismo tras la caída de Granada. Los zegríes, aliados de El Zagal, se castellanizan y fueron uno de los 32 linajes musulmanes que son reconocidos por los Reyes Católicos en las Capitulaciones de Granada. En 1500 se convirtió al cristianismo el sobrino de Hamet el Zegrí, cabeza de linaje. Otro de los reconocidos fueron los de Granada Venegas, cuando su cabeza de linaje, Cid Hiaya, alcalde de Baza, rindió la ciudad a Fernando. Hiaya pasa a llamarse Pedro de Granada y ocupará importantes puestos en el reino castellano.</p>
                      </div>
                    </div>
                    <div id="loser-q7" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>POBLACIÓN MUSULMANA</h2>
                        <p>Tras la Conquista de Granada todos los musulmanes sometidos a la Corona de Castilla pasan a ser mudéjares dentro de una política de tolerancia religiosa impulsada por el primer arzobispo de Granada, Hernando de Talavera. Estos nuevos mudéjares granadinos se unen a los ya existentes (los llamados “mudéjares viejos” o “moros de paz”) que aún vivían en Castilla en núcleos llamados aljamas y que configuran una comunidad de unas 50.000 personas en todo el reino a las que se añadió la granadina.</p>
                        <p>Esta presencia mudéjar seguirá hasta 1502, cuando tras las revueltas granadinas de 1499-1501, el cardenal Cisneros impone en una pragmática la conversión forzosa al catolicismo de todas las comunidades mudéjares castellanas, tanto de Granada como fuera de ellas. Finalmente, ante la imposibilidad de asimilarlos a la población cristiana vieja, Felipe III en 1609 ordena la expulsión de todos los moriscos de España: ya fueran aragoneses, navarros, valencianos, castellanos o catalanes.</p>
                      </div>
                    </div>
                  </div>
<?php      //   <!-- bloque título cuadro ------------------------------------------------------> ?>
                  <div class="cuadro-info-butt">
                    <div class="cuadro-info">
                      <div class="cuadro-info-wrap">
                        Salida de la familia de Boabdil de la Alhambra (1880)<br>
                        <span><strong>Moreno González</strong> Colección Diputación de Granada</span>
                      </div> 
                    </div>
                  </div>

                </div>

<?php      //   <!-- Slide2 Torquemada ------------------------------------------------------> ?>
                <div id="extra-sociedad-stats" class="swiper-slide" data-slide="3" data-titulo="La sociedad granadina"> 
                  <div class="content-slide">
                    <div class="main">
                      <h2>La sociedad Granadina</h2>
                      <p>La población de la Granada nazarí estaba dividida en multitud de grupos sociales, que iban desde árabes descendientes del profeta Mahoma hasta cristianos conversos.  Al contrario que la Castilla isabelina, todos los musulmanes del reino -fuesen “nuevos” o “viejos”- podían progresar entre clases sociales.  Mientras, judíos y cristianos extranjeros dedicados al comercio podían practicar su religión bajo control y pago de tributos. En lo más bajo de la escala social estaban los cristianos cautivos en las múltiples escaramuzas fronterizas, que eran utilizados como constante moneda de cambio con sus oponentes castellanos.</p>
                      <p>Descubre qué grupos conformaron la sociedad de Granada</p>
                    </div>
                    <div id="bl--sociedad-stats">
                      <div class="stats-controls-main clearfix">
                        <a href="#" title="Mustra los grupos de este periodo">España Visigoda</a>
                        <a href="#" title="Mustra los grupos de este periodo">Emirato de Córdoba</a>
                        <a href="#" title="Mustra los grupos de este periodo">Taifa de Granada</a>
                        <a href="#" title="Mustra los grupos de este periodo">Reino de Granada</a>
                      </div>
                      <div class="stats-main">
                        <div class="stats-bar stats-bar-1" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Cautivos +</div>
                              <div class="pop-inn">
                                <p>Los cautivos de origen cristiano que eran capturados en batallas, tras correrías o algaras por tierra y mar o incluso en emboscadas y ataques por sorpresa.  Estaban sometidos a esclavitud, haciendo trabajos forzados, mal alimentados y con frecuencia azotados. De noche dormían encadenados, en la casa de su señor o en las mazmorras de un castillo o torre. </p>
                                <p>La única manera de liberarse de sus condiciones era convirtiéndose al Islam pero en la mayoría de las veces los cautivos persistían en seguir en su religión por lo que su cautiverio podría durar años hasta la espera de un rescate pagado por familiares o amigos. Durante la Guerra de Granada los cautivos se convierten en frecuentes “monedas de cambio”, permitiendo la salida de los musulmanes de las ciudades los cristianos a cambio de la liberación de cristianos. </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-2" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Judíos nuevos +</div>
                              <div class="pop-inn">
                                <p>Una segunda oleada de judíos llega a Granada a finales del siglo XIV refugiados de los pogromos de 1391, que se inician en ciudades vecinas como Sevilla, huyendo de los primeros intentos de conversión forzosa.</p>
                                <p>Sin embargo, el antisemitismo de la época también se deja sentir en Granada.  Desde el siglo XIV, se les imponen ciertas limitaciones sociales como llevar un turbante amarillo y la prohibición de montar a caballo y vestir seda. Tenían el estatuto “dhimmí” dentro del Estado nazarí y pagaban un impuesto de capitación por poder practicar libremente su religión y costumbres.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-3" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Negros +</div>
                              <div class="pop-inn">
                                <p>Los negros, de origen subsahariano, eran esclavos o libertos convertidos al Islam dedicados a tareas de servidumbre o al ejército. Hernando de Baeza habla de la figura del  Mizwar, ocupada por un negro, que sería como el pregonero real y el jefe de una guardia real que custodiaba al emir en su residencia de la Alhambra.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-4" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Bereberes nuevos +</div>
                              <div class="pop-inn">
                                <p>Una segunda oleada de bereberes llega en el siglo XIV con las tropas de los Banu Marín (Benimerines). Formaban parte de las tropas llamadas “voluntarios de la fe”, que venían al reino nazarí a hacer la Guerra Santa pero tras la derrota en la batalla del Salado (1340), se quedan formando unidades asentadas en fortalezas de la frontera. Una de las tribus que llegan en esta oleada es la de los zegríes. Originarios de Fez, desarrollan sus actividades en la frontera militar de Ronda (el zagr, en árabe), de donde deriva su apelativo, zagrî , que significa “fronterizos”.</p>
                                <p>Por la misma época llega otra familia que se convertirá en su principal enemigo político, la de los abencerrajes, que a diferencia de los zegríes y otros bereberes tribales, están arabizados culturalmente. Se establecen en las principales ciudades del reino nazarí formando parte también de una aristocracia de servicios prestados al Estado y funcionaria más que señorial.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-5" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Mudéjares +</div>
                              <div class="pop-inn">
                                <p>Tras el fracaso de la revuelta mudéjar de 1264 en Andalucía Occidental, el flujo de inmigrantes musulmanes huyendo de la España cristiana es una constante que se incrementará en la Guerra de Granada. Provenían de la antigua población musulmana andalusí que quedó en los territorios reconquistados por los cristianos en su avance del Norte al Sur. Dedicados a profesiones artesanas (seda), agricultura, comercio. Solían vivir en ciudades o alquerías.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-6" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-right">
                              <div class="pop-num">Extranjeros +</div>
                              <div class="pop-inn">
                                <p>Durante los siglos XIII y XIV Granada vive una época de esplendor económico y comercial, lo que hace que numerosos extranjeros, tanto de origen cristiano como musulmán. se instalen en la ciudad.</p>
                                <p>En cuanto a los de origen cristiano, vivían libremente en el reino nazarí con el estatus de dhimmíes o protegidos por ser “Pueblo del Libro” (Ahl al-Kitab) a cambio también, como en el caso de los judíos, del pago de una capitación.  La mayoría de ellos eran genoveses, florentinos y venecianos , aunque también había castellanos y aragoneses.</p>
                                <p>También se sabe de la presencia de una población flotante de viajeros y habitantes de origen magrebí, árabe-oriental, turcos y egipcios en Granada llegados por motivos comerciales, de viaje o por estudios con estancias que iban de meses a años.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-7" data-bar="3">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-top pop-right">
                              <div class="pop-num">Cristianos conversos +</div>
                              <div class="pop-inn">
                                <p>Los elches, musulmanes “nuevos” de origen cristiano, de reciente conversión o descendientes de conversos, llegan o bien por voluntad propia o tras ser capturados en las frecuentes razzias fronterizas que realizan los granadinos entre tregua y tregua con Castilla.</p>
                                <p>Se constituyen en un grupo social propio en el siglo XIII. Por su condición bilingüe fueron muy apreciados en la sociedad nazarí, donde  empiezan a tener gran influencia en los siglos XIV y XV. Se dedicaban a la administración, la cancillería y la organización de Palacio pero, sobre todo, al servicio militar donde formaron una guardia palatina que no sólo estuvo al servicio de los sultanes nazaríes. Algunos “elches” como la propia Zoraya (Zoraida) o Reduán ben Abdallah alcanzaron altas cotas de poder dentro del Estado nazarí. </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-8" data-bar="2">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-top pop-left">
                              <div class="pop-num">Bereberes viejos +</div>
                              <div class="pop-inn">
                                <p>Los primeros bereberes que llegan desde el norte de África a Granada están vinculados sobre todo a las invasiones almorávide y almohade en los siglos XII y XIII. Los bereberes se convierten en un grupo social clave en los vaivenes políticos del Reino de Granada por su carácter tribal y sus frecuentes alzamientos.</p>
                                <p>Según el historiador Ibn Jaldún, los bereberes son “un pueblo organizado en tribus las cuales cada una es animada por un fuerte espíritu  de "Asabiyya" (sentimiento de solidaridad  tribal o clánica), pero sin resultado alguno, optando  por repetidas insurrecciones y de apostasía. Las principales familias bereberes viejas son los Nafza, Masmûda, Zanáta, Madyuna,  Miknasa, Hawwara, Nafza, y Gumara (subtribu de Origen Masmuda)</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-9" data-bar="1">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-top pop-left">
                              <div class="pop-num">Árabes +</div>
                              <div class="pop-inn">
                                <p>La vieja aristocracia nazarí estaba formada por familias y linajes árabes de origen  antiguo yemení, sirio o de la Península árabiga, llegadas a España con la conquista de Al-Ándalus. Vinculados al antiguo esplendor de la Córdoba califal, constituían una buena parte de la élite cultural, política y militar del Reino nazarí. Tienen un alto componente tribal, más honorífico que social.</p>
                                <p>Solían vivir en ciudades pero también en el campo siendo dueños  y terratenientes de amplias parcelas de  terreno (almunias) que explotaban a nivel comercial. Destacaban entre ellos los llamados Xerifes o Chorfas, descendientes de la familia del profeta Mahoma.  </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-10" data-bar="0">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-top pop-left">
                              <div class="pop-num">Judíos viejos +</div>
                              <div class="pop-inn">
                                <p>Un grupo de judíos vive en Granada  incluso desde antes de la llegada de los árabes a España, siendo su principal núcleo la llamada “Garnata al-Yahúd” (Granada de los Judíos).</p>
                                <p>Además, está documentada su presencia en Almería, Guadix, Baza y  en la costa del Reino de Granada. Las mayores densidades estaban principalmente entre las Alpujarras y la capital almeriense. Se dedicaban al comercio, las artes liberales y científicas, la artesanía de la seda y tejidos nobles, y participaron como traductores en intercambios comerciales y negociaciones de rescates dada su condición de políglotas.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="stats-bar stats-bar-11" data-bar="0">
                          <div class="stats-bar-wrap">
                            <div class="stats-title pop pop-top pop-left">
                              <div class="pop-num">Andalusies +</div>
                              <div class="pop-inn">
                                <p>Los pobladores originarios de la Granada visigoda se convierten al Islam y las generaciones que les siguen son el exponente del mestizaje cultural y étnico entre pueblos de distinta procedencia (hispanovisigodo, romano, árabe y bereber).</p>
                                <p>Estos musulmanes “viejos” de origen cristiano conforman el islam 100% andalusí. Son el núcleo más numeroso de población en Granada y se mezclan con los  otros colectivos sociales que llegan con posterioridad como conversos de reciente cuño (mawlas) o de otras razas.. Solían estar formados por miembros de todas las capas sociales, habitando en ciudades y pequeñas aldeas.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="stats-controls clearfix">
                        <a href="#" class="stats-ctrl-1" title="Mustra los grupos de este periodo">España Visigoda</a>
                        <a href="#" class="stats-ctrl-2" title="Mustra los grupos de este periodo">Emirato de Córdoba</a>
                        <a href="#" class="stats-ctrl-3" title="Mustra los grupos de este periodo">Taifa de Granada</a>
                        <a href="#" class="stats-ctrl-4" title="Mustra los grupos de este periodo">Reino de Granada</a>
                        <div href="#" class="stats-ctrl-5" ></div>
                      </div>
                      <div class="stats-years clearfix">
                        <div class="stats-yr-1">700</div>
                        <div class="stats-yr-2">750</div>
                        <div class="stats-yr-3">1040</div>
                        <div class="stats-yr-4">1250</div>
                        <div class="stats-yr-5">1264</div>
                        <div class="stats-yr-6">1340</div>
                        <div class="stats-yr-7">1391</div>
                        <div class="stats-yr-8">1482</div>
                        <div class="stats-yr-9">1492</div>
                      </div>
                    </div>
                  </div>
                </div>  
              </div> 
            </div> 

        </div>
      
      </article>

      <article id="toma-granada" class="element batalla opacity hidden">

        <div id="toma-granada-paso-1" class="paso hidden" data="paso-1"  data-duracion="31000"
          data-callbackin="paso11In" data-callbackout="paso11Out">

          <div class="paso-title">
            <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <h1><span>1491 - 1492</span>La toma de Granada</h1>
                <p class="cita">"Estas llaves es lo último que quedó a los árabes de España. Tomad pues nuestro Reino, nuestros bienes y nuestras personas.  Son vuestras pues (así) lo ha decretado Dios." 
                  <span class="cita-author">Boabdil a Fernando</span>
                </p>
              </div>
            </div>
          </div>

          <div class="paso-audio" data-filename="09-toma-de-granada"></div>

          <div class="paso-video">
            <div class="wrap-table">
              <div class="wrap-table-cell">
                <div class="video-wrap" data-filename="09-toma-de-granada"></div>
              </div>
            </div>
          </div>
        </div>

        <div id="toma-granada-paso-2" class="paso paso-0 multipaso multipaso-0 hidden" data="paso-1" data-paso="0" data-pasos="7">

          <div id="avanza-granada-isabel" class="clearfix">
            <div class="help-bottom">La Granada de Isabel</div>  
          </div>

            <div class="paso-map">
  <?php // mapa ?>
              <div class="map-wrap">
  <?php  // elementos flotantes fijos a la pantall ?>
                <div class="paso-popup paso-popup-top paso-pop-capito paso-auto paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                  <div class="paso-pop-img">
                    <img src="/serie-isabel/conquista-de-granada/img/mapas/img--capitulaciones-granada.jpg">
                    <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                  </div>
                  <div class="paso-pop-tit">Las capitulaciones de Granada</div>
                  <div class="paso-pop-cont">El 25 de noviembre de 1491 Boabdil firma en secreto las capitulaciones de Granada a firma de las siguientes condiciones: <br>-Será liberado el hijo mayor de Boabdil y todo su séquito, retenido como señal para cumplir los pactos de Lucena <br>-Los musulmanes serán juzgados por sus leyes <br>-Podrán seguir ejerciendo la religión musulmana y las mezquitas estarán bajo el control de los alfaquíes. <br>-Son libres de vender o arrendar sus propiedades y marchase al norte de África. <br>-No están obligados a llevar ningún signo distintivo, al contrario que los judíos. <br>-No serán obligados a enrolarse en el ejército <br>-Estarán exentos de pagar impuestos durante los primeros tres años y luego lo harán en función de la ley nazarí- <br>-Todos los prisioneros refugiados en Granada serán indultados. <br>-Podrán llevar armas, excepto pólvora.<br/><span class="pequenin">“Rodrigo Ponce de León”.<br> Catedral de Sevilla. Biblioteca Capitular Colombina. Fotografía de Luis Serrano.</span></div>
                </div>

                <div class="paso-popup paso-popup-left paso-pop-santafe paso-auto paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                  <div class="paso-pop-img">
                    <img src="/serie-isabel/conquista-de-granada/img/mapas/img--cuadro-campamento-santafe.jpg" alt="">
                    <img src="/serie-isabel/conquista-de-granada/img/bg--marco-retrato.png" >
                  </div>
                  <div class="paso-pop-tit">El campamento de Santa Fe</div>
                  <div class="paso-pop-cont">Para mostrar que los granadinos que estaban allí para quedarse los reyes Católicos levantaron en apenas 80 días un campamento de piedra y ladrillo donde instalaron su corte. Allí no solo esperaron la rendición de Boabdil y se firmó la rendición de Granada; también se firmaron las condiciones por las cuales se financiaría el viaje a las Indias de Cristóbal Colón, que acabaría llevando al descubrimiento del Nuevo Mundo. <br/><span class="pequenin">‘Isabel la Católica‘, de Juan de Flandes<br>Patrimonio Nacional</span></div>
                </div>

  <?php // elementos flotantes relativos al mapa ?>
                <div class="map-wrap-steps">
                  <div class="paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><strong>1491 - 1492 La toma de Granada</strong></div>
                  <div class="paso-auto paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">1.</span> Los Reyes Católicos convocan a los nobles para la última ofensiva sobre la ciudad de Granada.</div>
                  <div class="paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7 paso-body"><span class="ft-gothic">2.</span> Los reyes montan una ciudad nueva junto a Granada con el campamento de Santa Fe.</div>
                  <div class="paso-auto paso-6 paso-7P paso-7 paso-body"><span class="ft-gothic">3.</span> Se inician negociaciones secretas para la rendición. Tras la caída de Granada, Boabdil se refugia en un primer momento en la Alpujarra antes de marcharse a África en 1493. </div>
                </div>

                <div class="paso-rapharrow paso-rapharrow-3 paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7"
                  data-path="M668.834,929c11.188,4.923,21.174,16.653,23.146,26.591"></div>

                <div class="paso-rapharrow paso-rapharrow-5 paso-auto paso-6P paso-6 paso-7P paso-7"
                  data-path="M675.334,979.5c-79.002-41.971-167.755,41.371-230.628-22.024"></div>
                <div class="paso-rapharrow paso-rapharrow-5 paso-auto paso-6P paso-6 paso-7P paso-7"
                  data-path="M711.334,991.5c15.474,6.018,37.599,24.968,45.409,31.757"></div>
                  
                <div class="paso-text tit-grana paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">Granada</div>
                <div class="paso-ico ico-grana paso-ico-battles paso-ico-arabe paso-auto paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6  paso-7P paso-7">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle1.png">
                </div>
              
                <div class="paso-text tit-alcala paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">Alcalá<br>la Real</div>
                <div class="paso-ico ico-alcala paso-ico-battles paso-ico-arabe paso-auto paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle3.png">
                </div>

                <div class="paso-text tit-sevilla paso-auto paso-6P paso-6 paso-7P paso-7">Sevilla</div>
                <div class="paso-ico ico-sevilla paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
                </div>

                <div class="paso-text tit-alpujarra paso-auto paso-6P paso-6 paso-7P paso-7">Alpujarra<br>granadina</div>
                <div class="paso-ico ico-alpujarra paso-ico-battles paso-auto paso-6P paso-6 paso-7P paso-7">
                  <img src="/serie-isabel/conquista-de-granada/img/mapas/ico--battle2.png">
                </div>

  <?php // mapa wrap ?>
               <div class="map-main paso-1P paso-1 paso-2P paso-2 paso-3P paso-3 paso-4P paso-4 paso-5P paso-5 paso-6P paso-6 paso-7P paso-7 paso-8P paso-8">
                  <img class="svg" src="/serie-isabel/conquista-de-granada/img/mapas/reinos-1492.svg" alt="Mapa de los reinos de España antes de la conquista de Granada">
               </div>

    <?php      //   <!-- extra ------------------------------------------------------> ?>
              <div class="paso-auto paso-7 paso-8P paso-8 map-wrap-steps-end clearfix">
                  <p>Tras la victoria en Granada, la Reina decide acometer la expulsión de los judíos y falsos conversos al no haber podido acabar con ellos con los métodos de la Inquisición. El 31 de marzo de 1492, Isabel y Fernando firma el edicto de expulsión, de la que solo se salvarán los que se conviertan al cristianismo. La orden de expulsión se ejecutó primero en todas las ciudades, villas y lugares de Andalucía porque a juicio de los Reyes era “donde parece que habían hecho más daño”. </p>
                  <h2 class="label">
                    <a href="/serie-isabel/conquista-de-granada/extra/expulsion-de-los-judios" class="go-link" data-id="toma-granada-extra-judios"
                     title="Haz click para visitar el especial">EXPULSIÓN DE LOS JUDÍOS</a>
                    <img src="/serie-isabel/conquista-de-granada/img/bg--title.png" >
                  </h2>
              </div>
              
            </div>
          </div>
        </div>

       </div>
      </article>

      <article id="toma-granada-extra-judios" class="element extra hidden">

        <div class="device">

<?php //          <!-- flechas de navegacion ----------------------------------------------> ?>
          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Cierra el especial"></a>

<?php //         <!-- contenedor principal ------------------------------------------------------> ?>
          <div class="swiper-container">
              <div class="swiper-wrapper">

                <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                  <div class="wrap-table" style="width: 100%">
                    <div class="wrap-table-cell">
                      <div class="video-wrap" data-filename="e9-intro-expulsion"></div>
                    </div>
                  </div>
                </div>

                <div id="toma-granada-extra-judios-paso-1" class="swiper-slide" data-slide="2" data-titulo="La expulsión de los judíos">
                  
                  <div class="content-slide">
                    <div class="cuadro-info-butt cuadro-info-butt-right">
                      <div class="cuadro-info">
                        <div class="cuadro-info-wrap">
                        Expulsión de los judíos de España (1889)<br>
                        <span><strong>Emilio Sala y Francés</strong> Museo Nacional del Prado</span>
                        </div> 
                      </div>
                    </div>
                    <div class="intro-extra-judios">
                      <h1 class="titulo">La expulsión de los judíos</h1>
                      <div class="texto">
                        <p>Tras la victoria en Granada, la Reina decide acometer la expulsión de los judíos y falsos conversos al no haber podido acabar con ellos con los métodos de la Inquisición. El 31 de marzo de 1492, Isabel y Fernando firma el edicto de expulsión, de la que solo se salvarán los que se conviertan al cristianismo. La orden de expulsión se ejecutó primero en todas las ciudades, villas y lugares de Andalucía porque a juicio de los Reyes era “donde parece que habían hecho más daño”.</p>  
                      </div>
                      <a href="#" id="player-judios" class="fragmento-audio" title="Mantenga el pulsor sobre el punto para escuchar el audio">
                        <div class="fragmento-audio-img"></div>
                        <div class="fragmento-audio-texto">Escucha un fragmento del edicto de expulsión de los judíos</div>

                        <audio class="audio-judios">
                          <source type="audio/mp3" src="http://video.lab.rtve.es/resources/TE_NGVA/mp3/2013/granada/e1-expulsion-judios.mp3">
                          <source type="audio/ogg" src="http://video.lab.rtve.es/resources/TE_NGVA/mp3/2013/granada/e1-expulsion-judios.ogg">
                        </audio>
                      </a>                      
                    </div>
                  </div>
                  <div class="img-intro-extra-judios">
                    <img src="/serie-isabel/conquista-de-granada/img/expulsion-judios/tanto-monta.jpg" alt="La expulsión de los judíos">
                  </div>
                </div>

                <div id="toma-granada-extra-judios-paso-2" class="swiper-slide" data-slide="3" data-titulo="¿Eran los mulsulmanes antisemitas?">
                  
                  <div class="content-slide">
                    <div class="titulo">
                      <h2>¿Eran los mulsulmanes antisemitas?</h2>
                      <p >La Andalucía cristiana no fue la única en ver una animadversión hacia el judío. También en la Granada nazarí de Muley Hacen hacia 1480 hubo disturbios contra los judíos. Una crónica sefardí escrita por Aben Vergas cuenta la anécdota siguiente:</p>                      
                    
                    <div class="pergaminos">
                    
                      <div class="texto pergamino left" >
                        <p>Vivía en Granada un medico del rey llamado Isaac Amon, de bendita memoria. Todos los días iba al palacio  real a tratar a sus pacientes y a aconsejar a su rey Muley Hacén y un día vio en la plaza a unos musulmanes  que se estaban peleando. Isaac era prudente y quiso volverse atrás pero no pudo. Al pasar él por allí dijo uno de los musulmanes a uno de los que peleaban:</p>
                        <p class="italico">-¡Por la vida de nuestro Profeta, deja a tu compañero y no le persigas!</p>
                        <p>El que estaba peleando no le hizo ni caso. Entonces volvio a exclamar:</p>
                        <p class="italico">-¡Por vida del medico del rey, dejalo en paz!</p>
                        <p>Entonces lo dejo. Inmediatamente se reunieron todos los musulmanes y comentaron:</p>  
         
                      </div>

                      <div class="texto pergamino right">
                        <p class="italico">-¡Que pena! ¡Fijaos hasta dónde ha caido nuestra religión! Le han jurado por la vida de nuestro Profeta y no ha hecho ni caso y cuando le han recriminado por la vida de un judío, entonces le ha dejado. Los judíos han levantado la cabeza hasta colocarla más alta que la de nuestro Profeta. ¡Levantemos nuestras espadas hasta exterminarlos!</p>
                        <p>Entonces los musulmanes de Granada tomaron sus espadas y atacaron a los judíos que tanto habían conseguido medrar en su ciudad y en su reino. Los principales huyeron a refugiarse al palacio real, donde el rey les protegió. Los pobres, muchos de ellos, murieron y otros huyeron de Granada.</p>
                        <p>A partir de aquél día los judíos principales de Granada, especialmente los médicos, cuando caminaban por la ciudad, trataban de pasar desapercibidos para no concitar las iras del pueblo que les odiaba por haberse hecho tan ricos en el reino nazarí.</p>                      
                      </div>
                    </div>                     
                    </div>
                                        
                  </div>
                </div>

                <div id="toma-granada-extra-judios-paso-3" class="swiper-slide" data-slide="4" data-titulo="Abrahan Seneor, banquero de la reina, se salvó">
                  
                  <div class="content-slide cuadroAbrahanSeneor" >
                    
                    <img src="/serie-isabel/conquista-de-granada/img/expulsion-judios/fondo-abrahan-seneor.jpg" alt="TÍTULO DEL CUADRO">

                    <div id="text"></div>  

                    <div class="cuadro-info-butt">
                      <div class="cuadro-info">
                        <div class="cuadro-info-wrap">
                        La expulsión de los judíos de Sevilla (1889)<br>
                        <span><strong>Joaquin Turina y Areal</strong> Centro de Interpretación de la Judería de Sevilla</span>
                        </div> 
                      </div>
                    </div>

                    <div id="tooltipAbrahanSeneor1" class="pop pop-left"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Abraham Seneor, banquero de la Reina, se salvó</h2>
                        <p>Abraham Seneor fue uno de los tres notables judíos  que se acogieron a la conversión que recogía el edicto de expulsión. Formaba parte de una rica familia, principal financiadora la guerra de Granada. Como agradecimiento, los Reyes Católicos apadrinaron su conversión en el cacereño Monasterio de Guadalupe, en donde asumió el nombre de Fernando Núñez Coronel. Desde ese momento y tras formar parte durante años de la Corte, se convirtió en miembro del Consejo Real, el organismo más alto de la Monarquía. </p>
                        <p>Otro judío cercano a la Corte, Isaac Ben Yudah Abravanel,  conservó su antigua fe y eligió el camino del exilio, después de suplicar sin éxito clemencia a los Reyes.</p>
                      </div>
                    </div>
                    <div id="tooltipAbrahanSeneor2" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Las claves del edicto</h2>
                        <p>1. Expulsión definitiva y sin excepciones de todos los reinos bajo su corona, ya sean peninsulares o ultramarinos</p>
                        <p>2. Plazo máximo de 4 meses, hasta el 31 de julio de 1492</p>
                        <p>3. El incumplimiento supondría la pena de muerte y la confiscación de bienes</p>
                        <p>4. Se les prohibió sacar su fortuna en oro, plata, monedas, armas y caballos</p>
                        <p>5. Durante esos 4 meses, si pudieron convertir sus bienes en letras de cambio 6. Cuenta Alonso de Palencia que Andalucía "quedó exhausta de oro y plata" porque "los hombres, que erróneamente creyeron encontrar su salvación en la fuga, se llevaron cuantas riquezas pudieron, escondiendo otras muchas con la esperanza de regresar algún día"</p>
                        <p></p>
                      </div>
                    </div>
                    <div id="tooltipAbrahanSeneor3" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn pop-top">
                        <h2>CIFRAS</h2>
                        <p>El número de judíos que fueron expulsados de España ha sido es desde hace décadas la cifra de la discordia, que oscila desde 70.000 hasta los 170.000 de algunos historiadores judíos. Autores del siglo XIX, como Joaquín Del Castillo y Mayone cifra en 2 millones el descenso de la población en España en ese siglo, entre los judíos expulsados y los cristianos establecidos en América.</p>
                      </div>
                    </div>        
                  </div>
                </div>  

                <div id="toma-granada-extra-judios-paso-4" class="swiper-slide"  data-slide="5" data-titulo="Mapa europeo de la expulsión de los judíos durante los siglos XII y XV">
                  <div id="map-judios" class="content-slide">  
                  <svg id="expulsion" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="1310px" height="876px" viewBox="0 0 1310 876" enable-background="new 0 0 1310 876" xml:space="preserve" xmlns:xml="http://www.w3.org/XML/1998/namespace">
                    <image overflow="visible" width="1310" height="876" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/mapajudios1310.jpg">
                    </image>


                    <g id="fronteras2">
                      <path data-border="bordsicilia"  fill="none" stroke="#A27A40" stroke-width="0" d="M881,792.4c-1.6,0.6-1.4,2.5-2.7,4c-3.4,3.8-3.5,4.9-5.2,9.3c-0.3,0.8-1.5,1.2-1.8,1.9c-0.2,0.5-0.2,3,0.1,3.4  c0.4,0.8,1.9,0.1,2.4,1.2c0.1,0.2,0.5,0.6,0.2,0.7c-0.3,0.1-0.5-0.4-0.8-0.4c-0.8-0.1-0.4,0.7,0.1,2.8c0,0,1.1,0.4,1.1,0.4  c1.6,2.8-1.6,0.2,0.2,1c1.1,0.5-2.6,2.1-2.9,2.6c-1,1.3-0.4,5.6-1.5,5.4c-1.1-0.2-2.2-1.8-3.5-1.9c-0.6,0-0.8,0.6-1.4,0.6  c-0.5,0-4.4-1.6-4.6-2c-1.4-1.9-1.8-4.5-3.8-6.1c-2.1-1.7-4-0.3-6.1-1.1c-0.1,0-3.4-1.9-3.5-2c-0.6-0.5-0.8-1.8-1.5-2.2  c-0.2-0.1-0.5,0-0.7-0.1c-0.2,0-0.5,0-0.7-0.1c-1.4-0.5-3.2-2.6-4.1-3.8c-0.4-0.4-5-2.8-5.7-2.9c-0.9-0.1-1.8-0.2-2.7-0.1  c-0.3,0-0.6,0.1-0.8,0.1c-0.7-1.8-0.6-1.9-2-2.3c-0.7-0.2-0.6-1.4-0.7-1.8c0-0.1-0.7-1.4-0.7-1.4c1.9-0.9,0.5-3,1.8-4.3  c1-1,2.6-1.2,3.7-1.7c1.1-0.6-0.5-1,0.4-1.3c0.8-0.3,0.8,3.3,2.4,3.7c2.7,0.6,2.6-2.8,3.6-3.1c1.2-0.4,0.9,0.8,2.2,0.2  c0.1,0,1.2-0.9,1.4-0.6c0.4,0.7,0.5,2.1,0.9,2.5c0.7,0.7,2-0.9,2.5,0.2c2.2,5.1,4.4,1.4,7.9,1.6c0.6,0,0.9,0.8,1.8,0.8  c2.4,0.2,6.4,0.5,8.7-0.8c0.4-0.2,1-1.6,1.5-1.6c1.6-0.2,3.4,0.1,4.9,0.7l0.8,0.7c2.8-0.1,1.9-3.9,2.9-1.9c0.6,1.3,4.7-1.5,5.7-1.1  C881.8,792.2,881.9,791.9,881,792.4"/>
                      <path data-border="bordportugal" fill="none" stroke="#A27A40" stroke-width="0"  d="M508,728c1.3-1,2.9-1,3.9-2.6c0.2-0.3,0.1-0.8,0.3-1c1.7-1.1,5.1,1.5,5.9-2.2c0.1-0.3-0.1-0.6-0.3-0.7c0,0-1.9-0.2-1.9-0.2  c-0.7-0.6-0.8-3.9-0.9-4.9c-0.2-0.9-1-1.2-0.6-2c0.1-0.1,2.9-4.5,3-4.6c0.8-0.6,4-0.5,4.5-1.3c0.1-0.3-0.3-0.5-0.3-0.8  c0.2-1,2.3-1.5,2.4-2.8c0.1-1.5-1.9-1.1-2.5-2c-0.2-0.3,0.5-0.6,0.3-1c-0.2-0.5-0.9-0.6-1-1.1c-0.8-2.2,0.8-5.4,0.8-5.5  c-0.1-0.9-2.5-4.8-2-5.5c0.1-0.2,0.5,0.2,0.8,0.3c1.1,0.4,6.9,2.8,7.6,2.7c1.2-0.3,4.2-4.5,4.3-5.8c0.1-1.4-1.3-2.3-1.3-3.4  c-0.1-2.8,4.7-1.3,5.1-3.3c0.1-0.6-1-1.2-0.4-2c0,0,1.1-0.7,1.1-0.7c0.8-1.3,2.2-5.5,2.4-6.8c0.1-0.9-0.8-2-0.6-3  c0.3-1.7,1-0.3,1.9-0.6c1.5-0.5,2.4-2.5,3.8-3.1c0.9-0.4,2.3,0.2,3.4-0.3c1-0.5,4.7-2.7,5.1-3.7c1.2-3-4.1-3.4-4-4.3  c0-0.7,1.8-2.9,1.5-3.5c-0.2-0.3-0.8,0-1-0.3c-0.2-0.4,0.7-0.8,0.5-1.1c-0.6-1.2-1.4-0.4-2.3-1c-0.5-0.3-0.4-1.2-0.9-1.4  c-0.2-0.1-0.2,0.3-0.3,0.4c-0.5,0.8-1.2,0-1.9-0.3c-0.5-0.2-2.9-2.1-3.5-1.8l-0.2,1.4c-0.3,0.3-3.8,0.5-4.2,0.3  c-0.5-0.2-0.4-1.2-0.9-1.4c0,0-1.9,0-1.9,0c-0.3-0.2,1-0.4,0.8-0.8c-0.2-0.6-1-0.7-1.6-0.9c-0.6-0.2-2.5,0.1-2.9-0.3  c-0.2-0.2,0.4-0.5,0.2-0.7c-0.8-1.2-3,1.3-4.2,0.3c-3.2-2.7,3.6-3.3,2.4-5c-1.7-2.3-7.2-2-10.1-0.8l-0.9,0.5  c-0.6,0.5-2.6,2.1-2.8,2.9c-0.5,2.1,1.7,1.4,2.7,1.7c0.2,0.1-0.4,0.1-0.6,0.1c-1.3,0.2-1.6-0.4-1.8,0.9c-0.5,3.5-2,6.8-0.9,10.2  c0.4,1.5-3,4.5-2.9,5.8c0,0.1,1,0.3,0.7,0.7c-0.2,0.3-2,0.5-1.1,1.4c0.4,0.4,2.1,0.1,1.6,0.2c-0.7,0.2-3.5,1-3.9,1.5  c-1.4,1.4-2.2,3.8-3.5,5.4c-0.4,0.5-1.7,1.6-1.8,2.2c-0.3,1.4,2,0.7,1.5,2c-0.2,0.4-0.7-0.8-1.1-0.8c-0.3,0-0.4,0.5-0.6,0.7  c-2.4,2.9-4.8,6.5-7.7,9c-0.4,0.4-2.1,0.9-2.2,1.4c-0.1,0.3,0.4,0.6,0.3,0.8c-0.1,0.3-0.4-0.5-0.6-0.6c-0.5-0.3-1.1,0.4-1.6,0.5  c-0.2,0-0.5-0.1-0.7-0.1c-0.2,0-0.6-0.3-0.7-0.1c-0.1,0.1,0.6,2.1,0,2.9c-0.6,0.9-1.8,1.5-2.4,2.4c-1.3,2.1-2.1,4.9-3.7,6.7  c-0.2,0.2,1.4,3.4,1.6,3.8c0.3,0.7,1.2,2.1,1.2,2.8c0,0.9-2.1,0.6,0.1,0.9c0.3,0,0.6,0.1,0.9,0.1c1.1,0.1,2.9-0.5,3.7-0.3  c0.5,0.1,0.9,1.6,1.5,1.3c0.2-0.1,0.5-0.3,0.5-0.5c0-0.2-0.6,0-0.5-0.2c0.2-0.4,0.8-0.4,1.1-0.7c0.1-0.1,0.1,0.4,0.1,0.6  c-0.1,0.6-0.5,1.2-0.4,1.9c0.2,0.9,1.9,1.3,1.8,1.4c-1.7,1-3.6-2.8-4.9-3.3c-0.3-0.1,0.3,0.5,0.4,0.8c0.3,0.5,0.7,1,0.8,1.5  c0.7,4.2-3.7,6.2-4.3,8.3l0.8,1c0.4,1.2-0.9,2.5-1.1,3.6c-0.2,1,1.2,0.1,1.3,0.5c0,0.1-2.2,1-2.5,2c-0.8,3-2.5,5.6-4.6,8.2  c-0.5,0.6-1.9,1.1-2.1,1.8c-0.1,0.2,0.2,0.3,0.3,0.5c0.6,1,6-0.5,7.6,0.7c0.8,0.6,10,6.6,10,6.6c1.7,0.3,4.3-1.6,6-1.8  c0.3,0,1,0.1,2,0.2C505.1,735.1,504.5,730.6,508,728"/>
                      <path data-border="bordaustria"  fill="none" stroke="#A27A40" stroke-width="0"  d="M904,609.5c0.2-0.4-1.1-0.1-1.2-1.1c-0.1-1.5,0.6-1.1,0.9-2c0.1-0.5-0.9-2-0.6-2.4c0.9-1.3,3.5-0.1,3.9-2.6c0.3-2.1-4.2-3-3.6-3.6  c2.4-2.4,2.9-0.1,4.4,0.5c0.3,0.1,4.3-0.3,4.4-0.5c0.1-0.2-0.3-2.5-0.4-2.8c-0.1-0.2-0.6-0.2-0.5-0.4c0.2-0.3,0.7-0.1,0.9-0.3  c0.5-0.5,0.3-2.2,1.2-2.8c-0.6-0.9-0.7-2-1.2-2.7c0,0-1.1-0.4-1.1-0.4c-0.4-0.6-0.1-1.8-0.4-2.4c-0.3-0.7-1.3-1.1-1.5-1.8  c-0.4-1.2,1.5-3.4,1.9-5.3c0,0.1,0,0.1-0.1,0.2l0.1-0.8c0-0.7-0.3-1.2-1-1.7c-0.5-0.3-1.1,0.4-1.6,0.3c-1.1-0.3-1.7-2.3-3.1-2.2  c-2.3,0.2-0.9,1.9-4.8,1.1c-2.8-0.6-6.7-3.5-9.7-4.7c-1.5-0.6-1.9-0.2-3.3-0.3c-0.9-0.1-1.2-0.9-2.3-1.2c-0.2-0.1-0.5-0.3-0.7-0.2  c-1,0.9,0.2,4.3-0.8,5.1c-0.3,0.3-1.7-0.7-2-0.5c-0.9,0.6-0.9,3.7-1.9,4c-0.8,0.3-2.3-1.7-3.1-1.6c-0.6,0.1-0.7,1.1-1.2,1.3  c-0.5,0.1-4.4-0.7-4.8-1c-0.3-0.4,0.5-0.9,0.3-1.4c-0.3-0.7-2.2-1.5-2.8-1.9l-0.2,0c0,1.6-0.5,4.6-1.6,5c-0.9,0.4-2.8-2.6-3.8-1.3  c-1,1.2,0.2,3.2-1.5,4.4c-1.3,0.9-8.7,2.6-8.9,4.1c-0.3,1.7,3.4,4.1,3.2,5.8c-0.1,0.6-2.2,1.6-1.6,2.6c0.1,0.2,4.2,0.3,1.5,4.6  c-0.8,1.2-2.5-0.5-3.2-1.3c-0.7-0.9,1.2-1.9-0.5-2.5c-1-0.4-2.8,0.8-3.8,0.3c0,0-0.8-1.5-0.8-1.5c-0.2-0.2-0.6-0.1-0.8-0.1  c-0.3,0-0.6,0-0.8-0.1c-0.4-0.2-0.3-1.1-0.8-1.1c-1.5-0.1-0.6,2.6-1,2.7c0,0-1.8,0-1.8,0c-1.5,0-2.9-0.1-4.4-0.2  c-0.3,0-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.2-0.9-0.1c-0.6,0.3-0.5,1.3-1.1,1.6l-1.4-0.1c-0.2,0-0.5-0.2-0.7-0.1c-0.4,0.3,0,1-0.4,1.3  c-0.4,0.4-5.6,0.8-6.2,0.4l-0.1-1.4l-1.1-0.8c0.1-0.3,0.8,0,0.7-0.3c-0.5-2.2-5.5-0.1-6.1-1.8c-0.6-1.7-0.1,2.2-0.3,2.7  c-0.8,1.7-4.6,2.7-4.6,2.6c0.1-0.7,1.6-1.6,1-2c-1.3-0.7-0.7,1.3-1.9-0.2c-0.2-0.3,0.3-0.6,0.4-1c0,0-1.5-2.6-1.6-2.6  c-0.6-0.4-1.1,0.5-1.7,0.1c-0.4-0.3,0.1-1.2-0.3-1.4c-0.2-0.1-1.5,1.7-3.2,1l-0.4,0.2c0.3,0.8,1.6,2.4,0.9,3c-3.4,3.3-2,1.4-2.9,5.6  c-0.1,0.4-0.8,0.7-0.6,1c1,1.2,4.4,0.3,5.5,1.4l-0.4,1c0.2,0.6,2,2.2,2.6,2.4c2.3,1.1,3.5-2.6,5-2.2c1.5,0.4,0.4,2.2,0.6,2.7  c0-0.1,0.1-0.2,0.1-0.2l0,0.3c0.9,0.8,1.9,0.1,2.8,0.3c1.6,0.4,0.6,1.1,0.8,1.5c0.1,0.2,3.6,1.2,3.9,1.1c1.1-0.4,1.6-3.2,2.6-3.9  c0.7-0.5,9,0.4,11.2-0.1c0.8-0.2,3.1-1.1,3.7-0.3c0.3,0.4-0.8,0.4-1.1,0.7c-0.1,0.1,0,2,0,2.1c0.3,0.5,1.8,0.7,2,1.2  c0.2,0.5-0.8,1.2-0.4,1.7c0.2,0.2,0.7-0.1,0.9,0.1c0.5,0.3,0.5,1.5,1,1.8c4.2,3.1,12,3.3,18.1,4.7c1.9,0.4,3.6,1,4.9,1.8  c0,0,1.1,1.1,1.1,1.1c1.1,0.4,2.7-0.4,3.8-0.1c0.8,0.3,1,1.5,2.1,1c0.6-0.3,2.9-1.5,3.5-2c0.4-0.4,0.3-1.7,0.8-2  c2.7-1.9,6.4,1.3,9,0.5c0.9-0.2,1.4-1.7,2.3-2c1.3-0.3,3.1,1.3,4.5,1.1c0.9-0.2-0.3-3.2,2.3-3.8l0-0.1  C900.4,612.6,903.3,611.3,904,609.5"/>
                      <path data-border="bordinglaterra" fill="none" stroke="#A27A40" stroke-width="0" d="M677.9,500.8c-1,0.3-1.1,1.1-1.7,1.3c-1.1,0.5-4.7-1.4-4.1-2.8c1.1-2.5,4.3-0.1,5.3,0.9C677.5,500.4,677.9,500.8,677.9,500.8 M656.7,386.9c0.9,0.9,1.8,6.3-0.5,5.9C653.2,392.3,654.2,387.7,656.7,386.9 M644.6,365.4c0.3,0,0.6-0.3,0.8-0.1c0,0-2.1,1.7-2.3,1.7C642.2,367.2,641.9,365.4,644.6,365.4 M644.1,347c-0.9,0.1,1.4,1.4,1.4,2.3l-1.2,1c-0.3,0.5-0.3,2-0.6,2.3l-1.2-0.1C641.9,352.1,644.3,347,644.1,347 M645.1,345.2c0.8,0.4,2.4,1.7,0.3,1.9C644.4,347.2,643.7,345.5,645.1,345.2 M663.9,332.2c-0.6,0.7-0.1,1-0.3,1.3c-0.3,0.6-2.9,0.9-3.4,1.7c-0.1,0.2,0,0.5,0,0.7c0,0.2,0.1,0.5,0,0.7c-0.4,0.4-1.9-0.2-2.3,0.3   c-0.4,0.5,1.8,0.3,1.7,0.9c-0.4,2.1-1.4,0.2-2.3,0.3c-0.4,0,0.7,0.6,0.7,0.9c-0.2,1.5-0.5,0.7-1.2,0.6c-0.2,0-0.3,0.3-0.5,0.2   c-0.5-0.4-0.9-0.5-1.1-1.3c-0.1-0.5,1.1-1.4,0.6-1.4c-1.8,0.2-0.1,2.4-0.8,2.9c-0.6,0.4-1.6-1.4-1.3,0.1c0.1,0.5-2.3,2.1-3.2,1.3   c-0.1-0.1-1.1-2.2-1-2.2c0.2-0.3,0.3,0.8,0.7,0.9l1.3-1c0.2,0-0.1-0.4,0.8-0.4c0,0-1.5-1.9-1.4-2.3c0.2-0.9,1.1-0.3,1.6-0.5   c0.2-0.1-0.4,0-0.5-0.2c-0.3-0.5-0.4-1.3-0.2-1.8c0.4-1.2,1-0.3,1.7-0.8c0.1-0.1-1.4-1.1,0.2-1c0.4,0,1.5,2,2.9,2.4   c0.1,0-0.9-2.5,0-2.8c0.9-0.4,2.4,0.3,3.2,0c1-0.3,2.7-1.6,3.6-1.9C664,329.7,663.9,332.2,663.9,332.2 M648.3,342.1c-0.6,1.6,0.8,0.1,0.9,1c0.1,2.2-1.1,0-1.4-0.1c-1.2-0.4,2.1,1.7-0.2,2.4c-1,0.3-3.5-2.2-3.5-2.7   c0.1-2,2.7-0.5,3.4-0.6C647.7,342.1,648.3,342.1,648.3,342.1 M651.5,433.6c1.1,1,0.9,2.6,1.8,3.4c0.4,0.4,1.4,0.1,1.8,0.6c0.5,0.6-2.4,1.3-2.5,1.3c-0.5,0.1-2.2,0.8-2.7,0.7   c-0.2-0.1,0.2-0.3,0.3-0.5C650.4,438.6,646.2,434.6,651.5,433.6 M647.5,379.9c-0.3,1.1-0.1,4-0.6,4.8c0,0-1.5,0.6-1.5,0.6c-0.3,0.1-1.7,0.9-1.9,0.8c-1.7-0.7,0.6-1,0.7-1.5c0,0-0.5-1.6-0.5-1.6   c0-0.1,1.2-0.5,1.3-0.6c0.8-2.2-3.3,1.6-3.5,1c-0.1-0.4,1.5-3.1,1.8-3.3c1.5-1.1,1.3,0.4,1.4,0.8c0.1,0.4,0.5-0.7,0.9-0.8   C646.2,379.8,646.9,379.9,647.5,379.9 M704.3,333.4c-0.7,1.2,0.1,0.2-1.1,0.4c-0.6,0.1-1.1,1-1.8,0.2c-0.4-0.5,0.4-1.3-0.1-1.8c-0.6-0.6-1.9,1-2.8,0.2   c-0.8-0.7,1.1-1.7,0.5-2.3c-0.2-0.2-1.6,2-1.8,0.9c-0.2-1.1,1-3.7,2.5-3.1c1.1,0.4,2.7,2.6,1,2.4c-0.4,0-1,0.3-1,0.7   c0.1,0.7,1.4,0.1,2,0.3c0.5,0.1,0.3,1,0.8,1.3c0.2,0.1,0.7-0.4,0.8-0.1C703.5,332.8,703,332.2,704.3,333.4 M646.7,405.8c-1.6-1.6-3.2,0.7-4.4,0.3c-0.2-0.1-0.1-0.5,0-0.7c0.8-2,3.2,0,3.8-2.3c0.1-0.4,0-1.6-0.8-1.4   c-0.3,0.1-0.5,0.7-0.6,0.5c-0.2-0.3,0.3-0.6,0.3-1c0.1-1.3-1.1-2-1.4-3c0,0,1-4.1,0.4-4.9c-0.4-0.5-1.2,0-1.6-0.2   c-5.2-2.6-0.3-0.9-6.1-1.4c-0.4,0-2.2-1.2-2.4-1.2c-0.7,0.3-3.4,5.5-3.5,1.8c0-0.1,0-0.2,0-0.4l-0.6,0c-3.2-0.3-3.1,3.7-5.6,4.9   c-1.5,0.7-2.4-1-3.2-1.2c-2.2-0.4,0.6,2.5-0.3,3.2c-0.8,0.7-5-0.1-5.5,0.8c-0.4,0.7,3.1,6.5,3.9,7.2c1.2,1.2,5.1,3.6,6.5,1.2   c0.3-0.5-0.6-1.1-0.3-1.6c0.1-0.2,2.7-1.6,2.9-1.5c0.3,0.1,0.3,0.5,0.4,0.7c0.8,1.3,0.1,3.2,0.8,4.4c0.4,0.7,1.8,0.4,1.6,1.6   c0,0-0.8,1.2-0.8,1.2c0,0,0.1,1.1,0.1,1.1c1.9,1.4,3.4-0.7,4.5,0.1l0.3,0.5c1.5,0.6,1.9,2.5,4,1c0.7-0.5,0.6-1.7,1.1-2.1   c1.4-1.3,3.3,1.8,4.5-0.7c0.1-0.2,0-1.4-0.2-1.5c0,0-1.8,0.1-1.8,0.1c-0.2-0.5,1.1-0.5,1.4-1c1-1.4-0.8-2.3,0.6-3   c0.2-0.1,0.3,0.4,0.4,0.7c0.5,0.9-0.8,5.5,0.5,4.3C646.6,411.9,647.8,406.9,646.7,405.8 M722.7,468.5c-0.2-1.1-1.2-1.9-1.9-2.7c-4.6-5.5-8-2.6-10.9-5.3c-0.6-0.5-3,3.5-3,3.5c-0.5-0.5-2.6-3.1-2.7-3.1   c-0.1-0.1-1.4-0.3-1.4-0.4c0.1-0.8,4.6-2.4,5.1-3c1.6-1.5,0.8-6.7-0.3-8.2c-0.5-0.6-4.2-6-4.3-6c-0.9-0.4-2.1,0.2-3-0.1   c-0.8-0.2-0.4-0.9-1.4-0.9c-0.2,0-0.8-0.2-0.7-0.3c0.7-0.6,2.9,0.9,3.6,0.9c0.6,0,1.2-0.4,1.8-0.2c1,0.3,0.9,2.7,2,3   c1.4,0.4,0.4-0.6,1.5,0c0.4,0.2,0.4,1.6,0.8,1.3c1-1-2.5-7.7-2-9.7c0.2-0.8,2.1-0.7,2.1-1.6c0-0.1-2.3-2.7-2.7-3.5   c-0.6-1.2-0.5-3.2-0.8-4.4c-0.4-2.4-5.4-4.6-7.1-5.1c-0.7-0.2,0.8-1.2,0.7-1.9c-0.1-0.5-1.2-1.2-1.2-3.3c0-0.8,0.5-1.9,0.5-2.5   c-0.2-2.2-1.3-4.5-0.8-6.9c0.4-1.9,1.2-4,0.9-6.1c0-0.3-1.3-1.2-1.8-1.6c-1.6-1-1.3-5-2.2-6.2c-1-1.3-3.5-2-4.4-3.4   c-0.2-0.3-0.1-1.2-0.6-1.6c-0.2-0.2-0.6-0.2-0.8-0.2c-1.9-0.6-1.2,1-2.6,1.4c-2,0.5-5.1-2-6.8-2.7c-0.5-0.2-1.7-0.2-1.8-0.9   c-0.1-1.7,2.8,0.9,3.2,1c3.3,0.7,3.2-1.7,6-2.1c1.5-0.2,1.6,1.4,4,0.3c0.1,0,0.1,0,0.2-0.1c1.4-2.2-2.2-1.5-1.7-3   c0.2-0.6,1.1-1.4,0.3-1.7c0,0-0.1,0-0.1,0c-0.1,0-0.2-0.1-0.4-0.1c-0.6-0.1-1.2,0.2-1.8,0.3c-0.2,0-1,0-1.7,0   c-0.2,0.1-0.4,0.2-0.7,0.2c-0.2,0-0.4-0.1-0.6-0.2c-0.2,0-0.4,0-0.3,0c0.1-0.1,0.2,0,0.3,0c0.3,0,0.8,0,1.3,0.1   c0.6-0.3,1.3-0.8,1.9-0.8c0.7,0,1.4,0.3,2.1,0.6c0,0,0.1,0,0.1,0c0.5,0.2,1,0.2,1.4,0.1c1.6-0.5,4-2.2,4.8-3.2   c0.2-0.2,0.2-1.2,0.7-1.6c0.3-0.2,1.3-0.2,1.8-0.5c0.6-0.5,3.8-4.5,4.1-5.1c0.4-0.9,0.4-2,1.2-2.8c1.1-1.2,3.8-2.2,4-3.8   c0.1-0.8-0.1-3.1-0.8-3.7c-0.9-0.8-1.8-0.7-2.9-0.8c-2.3-0.3-5.1-2.1-7.1-2.7c-0.6-0.2-1.4,0.3-2,0.1c-1.2-0.3-2.1-1.6-3.2-2   c-1.2-0.4-3,0-4.2,0.1c-1.7,0.2-6.9,1.3-7.1,1c-0.1-0.2,0.5-0.3,0.6-0.5c0-0.2-0.7-0.4-0.4-0.5c0.8-0.4,3,0.5,3.6-1.3   c0.4-1.2-4.3,0-4.4,0c-0.4,0,0.9-1.2,1.2-1.4c0.3-0.1,1.8,0.2,2.4,0c1.9-0.6,0,1.4,1.1,1c0.8-0.2,3-1.8,3.3-2.5   c0.4-0.8-2,1-2.3,0.4c-0.1-0.2,0.4-0.4,0.4-0.6c0-0.1-0.2-0.1-0.4-0.1c-0.3,0-0.7,0.1-1,0c-0.1,0-1.7-1.1-1.4-1.1   c0.3,0,0.6,0.3,0.9,0.3c0.4,0,0.8,0.2,1.2,0c0,0,0.9-1.5,0.9-1.5c0.6-0.4,1.6-0.6,2.3-1c1.8-1.1,10.4-3.6,10.6-5.2   c0.1-0.7-0.8-0.8-0.5-1.5c0.1-0.3,2.5-2.3,1.9-2.6c-0.7-0.4-2.8-1.2-3.5-1.4c-0.2-0.1-0.6-0.1-0.6,0.2c0,0.4,0.6,1.1,0.3,1.1   c-1.3-0.1-1.9-1.4-3.1-1.3c-0.8,0.1-3.4,1-4-0.2c-0.1-0.2,0.3-0.5,0.2-0.6c-0.3-0.3-0.5,0.8-0.8,0.8c-0.3,0-3.1-0.7-3.3-0.7   c0,0-1.2,0.8-1.2,0.8c-0.3-0.4,0.8-0.9,0.6-1.3c-0.9-1.8-1.9-0.6-2.7-0.1c-0.4,0.2-1.3,1.2-1.1,0.8c0.4-0.7,0.6-0.5,1.2-1.1   c0.6-0.6-2.2-1.8-2.9-3c0,0-0.1,0.2-0.2,0.4c-0.5,0.8-1.4,0.9-1.7,1.5c-0.4,0.7,1.4,1.8,0.9,2c-0.8,0.4-0.2-0.7-1,0   c-0.2,0.2,0.4,0.7,0.2,0.8c-0.4,0-0.6-0.8-1-0.7c-0.9,0.3-0.8,1.8-0.4,2.7c1.1,0.2,2.4,1.9,0.3,0.5c-0.1-0.1-0.2-0.3-0.3-0.5   c0,0-0.1,0-0.1,0c-0.7-0.1-1.6,0.5-2.3,0.3c-0.5-0.2-0.3-0.8-0.9-1c-0.6-0.2,0.9,2.7,0.9,2.7c-0.1,0.2-0.4-0.2-0.5-0.2   c-1.3,0.6,1.7,1.6-1,0.7c-0.1,0-0.5-0.5-0.8-0.6c-0.3-0.1-0.4,0.6-0.3,1c0.2,1.2,1.4,2.2,1.5,3.3c0,0,1,2.2,0.9,2.1   c-1.1-1.3-1.2-2-2.4-2.9c-0.6-0.5-0.1,0.6-0.7,0.5c-0.5-0.1-1.1,2-1.7,0.2c-0.1-0.3,1-1.5-0.4-1.2c-0.9,0.2,0.2,3.2-0.9,2.9   c-0.3-0.1-0.4-4.4-1.9-1.5c-0.3,0.7-0.6,1.3,0.1,2c0.2,0.2,0.9,0.4,0.6,0.6c-0.4,0.2-0.7-0.5-1.1-0.4c-2.4,1,1.2,3.6,1.8,4.1   c0.4,0.3-1.4,0.1-1.7,0.2c-0.4,0-0.8-3.9-2.5-0.5c-0.6,1.2,0,0.1,0.4,1.2c0.1,0.2-0.9,1.2-0.7,1.5c0.6,1,2.1-0.7,2.5-0.2   c0.2,0.2-0.3,0.7-0.1,1c0,0,0,0,0,0c0.1,0,0.2,0,0.4,0c0.4-0.2,1-0.5,1.1-0.5c0,0,0,0.1,0,0.1c-0.3,0.2-0.7,0.3-1.2,0.4   c-0.2,0.1-0.3,0.1-0.4,0c-0.8,0-1.7,0.1-1.9,0.8c0,0,2.5,1.1,3.5,2.2c0.1,0.1-0.3,0.3-0.5,0.2c-1.3-0.4-0.4-1.8-2.2-1.4   c-0.6,0.1,0,0.6-0.3,1c-0.2,0.2-1.1,0.3-0.7,0.8c0.5,0.6,2.2,1.5,1.8,1.6c-1.4,0.4-1.9-2.2-3.5-0.8c-0.3,0.3,0.9,2.4,1.2,2.5   c0.2,0.1,0.4,0,0.6,0c0.2,0,0.8-0.1,0.6,0c-2,0.9-2.2-1.9-3.5-1.2c-0.6,0.3-0.2,1.5-0.8,1.9c-0.3,0.2-0.8-0.2-1,0   c-0.1,0.1,0.5,0.5,2,1.4c0.2,0.1,0.9-0.3,0.8-0.1c-0.1,0.3-0.6,0.4-0.9,0.4c-0.2,0-0.1-0.4-0.3-0.4c-2-1.1-0.5,1.1-0.6,1.2   c-0.2,0.3-7.1-1.8-5.3,0.4c0.7,0.8,1.9,1.2,3.1,1.5c0.8-0.1,1.6-0.2,2-0.1c0.1,0,0.4,0.3,0.6,0.6c0.3,0.1,0.5,0.1,0.7,0.2   c0.2,0.1,0.8,0,0.6,0.2c-0.4,0.6-0.9,0.1-1.3-0.4c-0.7-0.2-1.6-0.3-2.6-0.5c-0.6,0.1-1.1,0.2-1.4,0.2c-0.2,0,0.6,1.9,0.8,2   c1.1,1,1.6,2.7,3.6,1.5c1.5-0.9,2.7-1.5,4.2-2.2c0.7-0.3,1.2-0.9,2-1.3c0.2-0.1,0.7-0.5,0.6-0.3c-0.6,1.4-4,1.2-0.2,2.4   c0.2,0.1-0.4,0.1-0.7,0.1c-0.7,0-1.7-0.7-2.4-0.1c-3,2.7-2,1.5,0.1,2.2c0.3,0.1-0.6,0.3-1,0.4c-0.7,0.2-1.6-0.9-1.9,0.1   c0,0,1.3,0.8,1.6,1.2c0.2,0.2,0.6,0.4,0.5,0.5c-0.3,0.2-1.7-1.1-2.1-1c-0.9,0.1-3.1,2.8-3,3.6c0,0.2,0.5,0.3,0.5,0.5   c-0.1,0.7-1.9,1.8-1.2,1.7c0.6-0.1-2.6,2.6-2.5,3.1c0.1,0.6-0.7,0,0.1,1.1c0,0,1.6-0.5,1.6-0.5c0.2,0.2-0.4,0.3-0.6,0.5   c-2.4,2.1-1.5,2.1,0.6,2.1c0.1,0-2.3,1.2-3,2.1c-0.9,1.3-0.8,3.2-1.9,4.4c-0.5,0.5-2.3,0.9-2,2.2c0.3,1.6,3.2,0.3,3.8-0.2   c0-0.2,0-0.4,0-0.5c0-0.3,0-0.6,0.1-0.9c0.3-0.9,1.9-1.8,2.1-2.5c0.2-0.7-0.1-1.8,0.8-2.6c0.5-0.5,1.4-0.3,1.9-0.8   c0.1-0.1-1.1-4.9,0-5c0.3,0,0.4,0.6,0.6,0.6c0.3,0,3.6-2,4-2.2c1-0.5,0.4-0.9,1.5-0.9c0.2,0,0.9-0.4,0.7-0.2   c-1.5,1.1-8.1,3.5-6.5,6.5c1.1,2,1.6-1,2-1.8c0-0.1,1,1.3,1,1c0.3-1.8-0.4,2,0.8,1.7c0.1,0,2.3-3.3,2.4-3.5   c0.1-0.6-0.1-2.1,0.3-1.7c1.3,1.5-0.2,1.7,0.2,1.9c0.6,0.2,0.3,1.2,0.6,1.7c0.5,0.8,1.4,1.3,1.9,2c0.2,0.3-0.8-0.2-1.1-0.4   c-1.3-0.6-2.3-2.2-3.2-0.1c-0.7,1.6,0.2,2.5-1.3,3.5c-0.4,0.3,0.7,0.8,0.8,1.3c0.5,1.5,1.7,2.4,1.2,4c-0.3,1.1-1.2,0.4-1.9,0.8   c-1.2,0.7-1.6,2.6-2.6,3.5c-0.6,0.5-1.6,0.6-2.2,1.1c-1.1,0.9-1.3,2.1-1.1,3.4c0.1,0.4,0.2,1.3-0.2,1.2c-1.3-0.4,0.7-3-1.3-2.6   c-2.1,0.5,0.7,5.6,0.7,6.3l-0.4,1.3c0,0.2,0.3,0.2,0.4,0.3c1.1,0.8-0.9-4,2.3-4.1c0.8,0,2.7,5,4.1,5.2c1.8,0.3,0-4.1,1.2-4.6   c0,0,0.6,2,1,2.1c0.3,0.1,0.9-0.8,1-0.4c0.1,0.5-0.6,1.4,0.2,2.2c0.9,1,0.9-1.1,1.4-1c0.7,0.2-1.8,1.4,0.6,1.6c0.2,0,2-0.3,2-0.4   c0-0.1-0.6-1.3,0.3-1c0,0,1.5,0.8,2.5,0.8c1.1,0,0.5-1.7,1.1-2.2c0.1-0.1,2.4,0.8,2.9,1.1c1,0.5,2.7,0.3,3.5,0.8   c0.5,0.3-1.1,0.1-1,0.4c0.1,0.2,0.6,0.3,0.5,0.5c-0.2,0.2-0.6,0.2-0.9,0.1c-0.3-0.1-1.8-1.9-2.1-0.6c-0.1,0.3,0.2,1.1-0.1,1   c-0.3-0.1-0.1-0.6-0.4-0.8c-0.8-0.6-2,2-2.1,2.2c-0.8,1-3.7,2.5-3.8,4.2c-0.1,1.3,1.4,2.7,1.6,4c0.1,1-0.7,2.4,0.3,3.3   c0.7,0.6,0.9,0.1,1.3-0.3c0.2-0.2,0.4-0.8,0.5-0.6c0.5,1.8-2.8,2.2-0.4,4.2c0.3,0.2,0.9-2.1,2-2.3c0.3-0.1,0.1,1.6,0.9,1.3   c0.4-0.2,1-1.6,1.7-0.6c0.1,0.1-0.1,0.7-0.3,1.7c-0.1,0.6-1.6,0.8-1.9,1.2c-0.3,0.5,0.7,1.4,0.6,1.6c-0.2,0.3-0.5,0.5-0.8,0.5   c-0.3,0-1.3-0.8-2.1-0.3c-0.5,0.3-1.3,3.1-0.9,3.7c0.4,0.4,1.4-0.1,1.6,0.5c0.1,0.3-0.4,0.4-0.6,0.5c-1.6,0.9-3.1,2.9-2.9,4.9   c0.2,0.2,0.3,0.7,0.4,1.3c0.2,0.4,0.5,0.8,1,1.2c0.2,0.2,1.7,0.3,1.8,0.5c0.4,1.3-2.2,0.2-2.5-0.4c-0.1-0.2-0.2-0.8-0.3-1.4   c-0.2-0.4-0.3-0.8-0.4-1.3c0,0,0-0.1-0.1-0.1c-0.4-0.3-1.1,0.1-1.6,0.2c-1.1,0.3,1.1,3.7,0,3.6c-1.2-0.1-1.2-3.3-2.9-3.4   c-1.3,0-3.5,1.1-4.6,0c0,0-0.9-1.7-1.3-1.5l0.1,1.1c-0.5,0.4-3.2-0.1-3.9-0.1c-1-0.1-2.4,2.1-3,1.9c-0.2-0.1-0.1-0.5-0.3-0.5   c-0.5,0.3-0.3,1.2-0.7,1.6c-1.6,1.6-4.4,0.8-5.7,2.7c-0.6,0.9,0,0.9,1,0.9c1.1,0,0.4,1,1.2,1.1c0.3,0.1,2.3-3.2,5-1.3   c1.3,0.9-2.2,2.9,1.2,4c0,0-2.4,0.9-2.6,2.1c-0.2,1.3,1.9,1.4,1.9,1.7l-1.4,0.3c-1.6,1.2-1.7,3.7-3.9,4.5c-0.7,0.3-1.4,0-2,0.1   c-0.7,0.1-1.3,1.1-1.9,1.2c-0.6,0.1-1.9-1-2.5-0.8c-0.5,0.2-1.8,1.5-2.4,1.8c0,0-2.8-1.1-3.1-1c-0.3,0.1-0.2,0.7-0.5,0.9   c-0.4,0.2-3.5,0.3-3.1,0.8c0.5,0.7,1.9,0.7,2.2,1.5c0.8,2.2-2.6,1.5-2.3,2.1c0.4,0.9,2.1,1.4,1.2,1.1c-0.4-0.1,0.5,0.6,0.6,0.9   c0.2,0.6-0.1,1.2,1.1,1.4c0.3,0.1,2.9,0,3.2-0.1c0.4-0.2,0.4-1,0.8-1.2c0.6-0.2,1.3,0.3,2,0.4c0.3,0.1,0.7,0.4,1,0.2   c0.2-0.1,0.3-0.2,0.5-0.2c0.3,0,0.4-0.1,0.4,0.1c0,0.4-0.4,1.6,0.3,1.9c0.5,0.2,2.9,0.8,2.9,0.9c0.2,0.8-3,0.1-3,0.2   c-0.2,0.1-0.1,0.5-0.2,0.7c-1.2,2.4,5.4,1,5.8,1.1c0.6,0.1,0.3,3.1,0.5,3.4c1.2,1.5,2.9,2.9,5.1,3.3c1.3,0.2,1.7-0.8,2.5-1.4   c2-1.6,3.1,0.4,5.6-0.5c1.3-0.5,2.4-1.7,3.8-2.1l1.1,0c0.2-0.2,0-0.7,0.2-0.7c1.2,0.3-1.1,1-4.1,3.3c-1.6,1.2-3.7,1.4-5.3,2.5   c-0.7,0.5-1,3-1.4,3.2c-3.1,1.3-8-3.1-11.5-3.5c-0.4,0-3.8-0.7-3.9-0.5c-0.9,1.3-0.2,3.1-2.5,3.6c-0.8,0.1-1.5-1.9-2.3-1.4   c-1.3,0.7-1,3.5-1.9,4.5c-0.7,0.7-2.4,0.8-3.2,1.5c0,0-0.8,1.2-0.8,1.2c-1.5,0.5-2.2-0.2-3.4,0.4c-0.7,0.4-0.2,0.7-0.4,1.3   c-0.4,1.3-1.4,0.4-2.1,0.8c-0.3,0.2-0.1,0.7-0.3,1c-2.1,2.1-9.2,0.5-9,3.2c0.2,2.7,2.9-0.5,3.4-0.3c1.5,0.5,2.3,4.7,2.4,4.8   l0.7-0.8c1.6-0.2,1.7-0.2,1.3-1.8c-0.1-0.4,0.8-0.4,1.2-0.7c0.3-0.2,0.3,0.5,0.3,0.5c0.7,0.2,0.8-0.9,1.3-1c0.6-0.1,1.4,0.3,2.1,0   c0.5-0.2,0.7-1.6,1.3-1.8c0.2,0,2.3,0.9,2.8,1c0.9,0.2,2.7-0.2,3.4,0.6c0.2,0.2,0.1,0.8,0.4,0.9c0.7,0.2,1.1,0.3,1.2,0.2   c-0.1-0.3,0.3,0,0,0c0,0,0,0.1,0,0.2c0,0.1,4.6,3.8,5.3,3.8c0,0,0.5-1.5,0.7-1.6c0.4-0.2,2.3-0.3,2.4-1.1c0.1-1.1-1.3,0.1-0.5-1.2   c0.2-0.3,0.8-0.1,1-0.4c0.7-0.9,1.4-2.7,1.4-3.9c0-0.6,0.2,1.6,0.9,1.7c0.7,0.1,1.7-1,2.4-1.1c1-0.1,2.2,0.7,3.3,0.6   c1.9-0.2,3.4,1.3,4.7,3c0.4,0.5,0.9,0.9,1.1,1.5c0.1,0.3-0.5,0.9-0.2,0.8c0.9-0.4-0.1-2.1,1.3-2c1.5,0.2,4,3.2,5.4,2.6   c2.5-1-1.4-1.7-0.5-3c0.1-0.2,0.4,0.1,0.6,0.2c0.2,0.1,0.5,0,0.6,0.2c0.1,0.2-0.1,0.6,0,0.7l1-0.4c0.7,0,0.8,0.2,1.6,0.1   c0.9-0.2,1.6,1,2.5,1c0.3,0,3.7-1,3.7-1.1c0.3-1-1.8-1.8-1.6-2.6c0.1-0.5,0.8,0.6,1.1,1c0.4,0.6,1.3,2.8,2.2,2.7   c1.1,0-0.5-2,1.2-1.1c0.7,0.4-0.1,0.9,0.5,0.5c1-0.6,1.2,0,1.7,0.5c0,0-0.8,4,1.6,1.8c0.1-0.1,0,0.4,0.1,0.4c2,0.5,5.1-0.6,7.2,0.1   c1.7,0.6,3.2,3.1,5,3.4c0.6,0.1,1.5-1.1,2.1-1.2c1.3-0.4,2.8,0.3,4.1,0c0.9-0.2,0.9-1,2-0.9c0,0,1.5,0.6,1.5,0.6   c0.9-0.1,1.1-1.4,2-1.9c1.8-1.1,5,0,5.8-2.5c0.1-0.2,0-0.5,0-0.7c0-0.2,0-0.5,0-0.7c0-0.2-0.1-0.5,0-0.7c0.4-0.7,0.9-0.7,1.2-1.5   c0,0-0.7-0.1-1-0.1c-0.3,0-0.7-0.1-1-0.1c-1.4-0.2-5.8,0.8-6.4-1.1c-0.2-0.6,1.8,0.1,1.7-0.1c-0.9-2.7-2.8,0-3.9-0.8   c-0.3-0.2-0.9-0.6-0.7-0.9c0.2-0.2,2.5,0.5,2.5-0.1c-0.1-1.9-4.3-0.8-4.4-1.1c-0.2-0.5,7-0.7,7.1-1c0.2-0.5-0.5-0.9-0.8-1.4   c-0.2-0.4,1,0.4,1.5,0.4c0.6-0.1,0.8-1.5,0.7-2c-0.4-1.2-2,0.5-2.6-0.3c-0.1-0.1-0.5-0.3-0.3-0.4c2-1.5,4.7,1.5,7.7-0.6   c0.1-0.1,0.3-0.2,0.3-0.3c-0.1-1-1.3,0.4-1.3-0.3c0,0,1.4-1.4,1.4-1.4c0-0.5-0.1-0.5,0.2-0.3c0.2,0.2,0.1,0.8,0.4,0.8   c0.4,0.1,1.8-1.7,2.2-1.9c0.5-0.3,1.1-0.2,1.6-0.3c0.9-0.2,1.2-2.9,1.5-3.5C721.8,474.1,723.7,473.2,722.7,468.5 M630.3,414.3c0,0-0.1-1.1-0.1-1.1c0,0,0.8-1.2,0.8-1.2c0.2-1.3-1.2-0.9-1.6-1.6c-0.7-1.2,0-3.1-0.8-4.4c-0.1-0.2-0.2-0.6-0.4-0.7   c-0.2-0.1-2.8,1.3-2.9,1.5c-0.2,0.5,0.6,1.1,0.3,1.6c-1.4,2.3-5.3-0.1-6.5-1.2c-0.8-0.7-4.3-6.5-3.9-7.2c0.5-0.9,4.6-0.1,5.5-0.8   c0.9-0.8-1.8-3.6,0.3-3.2c0.8,0.1,1.7,1.9,3.2,1.2c2.5-1.1,2.4-5.2,5.6-4.9l0.6,0c0.3-1.9,3-1.2,4.2-2.2c1.1-0.9-0.6,0.3-1.9-1.8   c-0.6-1-0.8-2.5-2.5-2.7c0,0,0.8,2.4,0.8,2.5l-0.8-0.7c0-0.2-1.6-0.6-2.2-0.4c-1.1,0.4,0,3.6-0.7,4.4l-1.4,0.2l-1.3,0.6   c-0.2-0.2,0.2-0.4,0.4-0.6c1.4-1.2,0,0.5,1.7-1.2c0.4-0.4,0.2-4.3,0.1-4.3c0,0-1.2,0.7-1,1.1c0.1,0.3-0.6,2.6-0.8,2.2   c-0.2-0.3,0.4-0.6,0.3-1c-0.1-1.3-0.1-1.9-0.4-2.3c-0.2-0.2-0.4,0.4-0.6,0.5c-0.5,0.1-1,0.9-1.2,1.2c0,0.1-0.1,0.1-0.1,0.1   s0-0.1,0.1-0.1c0,0,0.1-0.1,0-0.2c-0.2-0.4,0.1-1.1-0.5-1.6c-0.3-0.2-0.4,0.6-0.7,0.8c-0.4,0.3-1,0.1-1.5,0.2   c-0.2,0-0.6,0.3-0.6,0.1c0-0.4,0.6-1.2-1.1-1.1c-0.5,0-0.5,1.1-0.7,1.2c-0.6,0.8-1.6,0.4-2.3,1c-0.4,0.3,1,1,0.6,1.3   c-0.3,0.2-1.7-0.5-1.3,0.6c0.2,0.7,1.3,1.6,1,1.8c-0.4,0.3-2.2-1.5-2.8-0.7c-0.3,0.4,1.1,0.9,0.8,1.3c0,0.1-5.3-1.3-4.9,0.9   c0.2,1.2,3.3,2.4,4,2.4c0.2,0,0.5-0.2,0.5,0c0.1,0.5,0.6-0.5,1.1,0c0.5,0.5-0.9,0.7,0.1,0.8c0.7,0.1,2.6-0.1,2,0.4   c-0.5,0.4-2,0.8-2.8,1.7c-0.1,0.1-0.2,0.4-0.4,0.4c-0.9,0.2-1.6-0.6-2.1-0.8c-0.1,0-0.5,0.7-0.7,0.8c-0.5,0.2-2,0.1-2.4,0.6   c-1.2,1.3,2.1,0.3,1.7,1.3c-0.1,0.3-0.6-0.5-0.8-0.3c0,0,0.8,1.4,0.8,1.4c-0.3,0.4-0.6,0.8-1.1,1.1c-0.2,0.1-0.6-0.1-0.8-0.3   c0,0-0.7-1.7-0.7-1.7c-0.4-0.5-1.4-0.2-1.8-0.3c-0.7-0.3-1.2-1.9-2.3-1.6c-0.6,0.2-0.7,1.1-1.2,1.2c-1.3,0.4-1-2.1-1.2-2.5   c-0.6-1.4-0.6-0.1-1.5-0.2c-0.2,0-3.6-2.6-4.4-2.8c-1.9-0.4,0.1,1.2-0.2,1.7l-0.8-0.7c0,0-0.6,0.4-0.7,0.1   c-0.2-1.1-2.5-1.8-2.6-0.7c0,0.2,0.5,0.3,0.4,0.5c0,0.1-1.4,1.4-1.4,2c0,0.2,0.2,0.6,0.5,0.5c0.3-0.1,0.9-2.2,1.6-2.3   c0.4-0.1,0.8,0.6,0.7,1c-0.1,0.6-1.6,1.6-0.9,2.2c0,0,1.7-1.1,1.5-0.5c-0.2,0.5-1.7,0.7-1.5,1.6c0.2,1.2,1.2,1.5,0.6,2.4   c0,0-1.2-2-2.1,0.3c-0.2,0.4,4,0.2,4.5,1c0.3,0.6-1,1-1.1,1c-0.3,0.2,0.6,0.7,0.5,0.9c-0.1,0.9-3.5-1.1-4.4-0.6   c-0.9,0.5-0.3,2.3-0.8,2.6c-0.1,0.1-2.5,0.2-3,0.3c-0.4,0.1-1-0.8-1.2-0.5c-0.1,0.2,1.4,2.2,1,2.6c-0.3,0.3-0.9-0.7-1.5-0.1   c-0.1,0.1-0.5,0.2-0.4,0.4c0.2,0.4,0.1,0.8,2.3,1.6c1,0.4,1.3-1.1,2.3-0.2c1.1,0.9-2.3,0.4-1.9,1.5c0.2,0.5,0.9,0.8,1.4,0.9   c0.2,0,2.2-1.1,2.2-0.6c0.1,0.3,0.7,0.6,0.3,0.9c-0.7,0.5-3.2,1.7-1.3,1.7c0.4,0,0.7,0,0.8,0.3c0.3,1.7,6.6,1.2,7.5,2.1   c0.2,0.2,0,0.9,0,1.1c0,0.3-0.7,1.6-1,1.5c-0.2-0.1-0.1-0.7-0.2-0.8c-0.7-0.8-1.6,1.1-3.6-1c0,0-3,2.5-3.3,2.8   c-0.8,0.6-0.9,0.4,0,0.7c0.3,0.1,1,0.1,0.8,0.3c-0.9,0.7-2.2,2.5-3.1,2.8c-0.1,0-4.7,1.4-4.9,1.4c-0.5,0.1-1.4-0.4-1.6,0.1   c-0.2,0.4,0.8,0.6,1.3,0.6c0.8,0.1,2.8,0.1,3.6-0.2c0.2-0.1,0.2-0.6,0.4-0.6c0.2,0.1-0.1,0.5,0,0.7c0,0,1.3,1.2,1.3,1.2   c0.3,0.1,1,0.8,1.3,0.8c1.6,0.1,4.8-2.3,5.1-2.1c0.5,0.3-0.4,1.6-0.4,1.7c0,0.2,2.8,0.2,2.5,1.3c-0.1,0.3-2.2-0.7-2.7-0.6   c-0.9,0.2-3.4,0.4-4.6,0.1c-0.6-0.1-1-1-1.7-1c-0.3,0-0.4,0.5-0.6,0.5c-0.8,0.1-1.5-1.6-2.4-0.9c-0.2,0.1-0.7,0.9-0.7,1.2   c0,0.2,0.7,0.6,0.5,0.5c-0.7-0.3-4.3-0.4-4.3-0.2c0.9,1.9,2.5,0.4,0,2.2c-0.2,0.1-0.4,0.4-0.2,0.6c0.4,0.7,1.5,0,1.7,1   c0.1,0.3-0.6-0.3-1-0.4c-0.7-0.1-2.2,0-2.3-1.3c0-1.5,0.1,0.1-1.5,0c-0.2,0-0.5,0.1-0.6,0c-0.1-0.3,0.5-0.6,0.4-1   c-0.2-0.6-2.1,0.2-2.2,0.3c-0.2,0-0.4-0.4-0.6-0.2c-0.3,0.2-0.1,0.8-0.4,1c-0.2,0.1-1.7-1-1.7,0.8c0,0.5,0.4,0.5,0.8,0.7   c1.2,0.5,5.6,1.1,5.9,1.2c0.3,0.1,1.8,0.8,1.8,1.1c0,0.6-1.1-0.8-1.6-0.6c0,0-0.9,0.7-1.2,0.6c-0.3-0.1-0.4,0.4-0.7,0.5   c-0.9,0.3-3.9-0.7-4.3,0.5c-0.1,0.2,0.2,0.3,0.3,0.5c0,0.2,0.1,0.5-0.1,0.7c-0.1,0.1-1.7-0.5-1.9-0.4c-0.9,0.7,0.5,0.8,0.5,1   l-0.5,1.3c0.3,0.3,1.6-1.1,2.1-0.6c0.8,0.7-1.6,2.1-0.1,2.6c2,0.6,4.6-0.5,6.8-0.1c0.3,0.1,1-0.1,0.9,0.2c-0.1,0.3-3-0.3-3.4,0.5   c-0.1,0.2,0.5,0.4,0.3,0.5c-1.5,0.5-2.2-1.2-4.4,1.2c-0.3,0.4-1.6-0.8-1.4,0.6c0,0.1,0.2-0.3,0.3-0.2c0.3,0,0.5,0.2,0.8,0.3   c1.1,0.4,1.3-0.1,2.2-0.3c1.2-0.3,2.8,1,4.1,0.8c0.5-0.1,0.6-1.2,1.1-1c0.5,0.2,0.9,0.6,1,1.1c0.2,1-5,0.6-6.1,1.3   c-0.4,0.3-1,0.9-0.3,2.1c0.8,1.4,1.9-1,2.5-0.5c0.2,0.2,0.4,1.3,1.1,0.8c0.2-0.1,0-0.6,0.2-0.6c0.2-0.1,0.9,0.6,1.2,0.5   c0.2-0.1,0-0.6,0.2-0.6c0.8-0.1-0.2,1.8,0.1,2.2c0.4,0.6,1.1-0.2,1.3-0.3c0.6-0.2,0,0.7,0.9,0.7c1.5,0.1,1.3-0.4,1.6-0.5   c0.2-0.1-0.2-0.7,0-0.7c0.8-0.1,1.6,1.4,2.2,1.6c0.1,0.1,0.9-0.6,1.2-0.7c0.8-0.3,1.3,1.3,1.9,1.1c1-0.4,1.3-2.2,2.3,0.1   c0.3,0.6,0-1.8,0.7-1.9c0.2,0,4.4,1.5,3.7-1.7c0-0.2-0.7-0.7-0.9-0.9c-0.2-0.2,0.6-0.1,0.8,0.1c0.4,0.3,2,0.4,2.2,0.6   c0.4,0.6-1.6,0.7-1.7,0.8c-0.5,0.5,2.8,1.2,3,1.1c0.3-0.1,0.2-0.8,0.6-0.9l1.5,0.2c0.7-0.8-0.4-0.2,0.4-1.1   c0.1-0.1,0.2-0.4,0.4-0.4c1,0.1,2.2,1.3,3.7,0.6c1.9-0.9-0.9-1.8,0.5-2c0.2,0,0.3,0.5,0.5,0.5c0.6,0.2,1.2-0.5,1.8-0.5   c1.4,0.2,2.8,1.3,4.1,1.1c0.7-0.1-0.6,1,1.1,0.7c0.9-0.1,1-1.4,1-2.2c0-0.2-0.2-0.8,0-0.7c1.2,0.4,1.3,1.8,1.7,1.7   c0.3-0.1,0.7-0.2,0.9,0c0.3,0.2-0.9,0.5-0.7,0.8c0.1,0.1,4.2,1.8,5.1,2.1c0.1,0,0.2-0.2,0.3-0.3c1.2-1.2-0.2-0.7,0.3-2.1   c0.1-0.2,0.3-0.8,0.5-0.9l0.6-1.2c0.7-0.8,2.1-1.1,2.7-2c1-1.5,1.2-4,2.9-5.2c0.6-0.4,2.2-1.1,2.3-2.1c0.1-1,0.3-1.6,0.5-2.7   c0.2-1,0.3-2.6,0.3-3.5c0-0.6-1.2-1.4-0.8-2.1c0.5-1.1,1.7,0.3,2.1,0.3c0.1,0-0.9-1.5-0.6-2c0.5-0.9,1.2-0.8,1.6-2   c0.1-0.3-1-1.5-1.1-1.8c-0.5-1.7,1.6-3.2,1.1-4.7c-0.2-0.5-1-0.5-1.2-1.5c-0.9-4,4.9,1.4,3.1-1.5c-0.1-0.2,0-0.4,0-0.6l-0.2-0.4   c-0.1-0.1-0.2-0.1-0.3-0.2c0.1,0,0.1,0.1,0.2,0.1l-0.3-0.5C633.7,413.5,632.1,415.7,630.3,414.3"/>
                      <path data-border="bordfrancia"  fill="none" stroke="#A27A40" stroke-width="0" d="M765.6,617.4c-0.3-0.1-0.7,0.4-1,0.2c-0.4-0.4,0.7-1.1,0.5-1.7c-0.2-0.5-1.2-0.1-1.4-0.6c-0.4-0.9,1.3-1.7,1.3-2.2  c0.1-0.6-1-1.3-0.9-1.9c0.2-1.3,2.1-2.2-1.5-2.7c-6.8-1-5.2,3.4-6.3,4.2c-0.5,0.3-3.8,2.2-4.3,1c-0.1-0.3,0.5-0.3,0.6-0.6  c0.4-2.4,0.9-0.6,2-1.4c0.8-0.6,0.1-5.6,1.5-7.1c1.1-1.2,4.2-1.3,5-2.6c0.5-0.8-0.3-2.7,0.3-3.4c0.7-0.9,3.2-0.5,4.1-1.4  c0.7-0.7,1.4-1.9,2.3-2.8c1.2-1.1,3-1.9,3.5-2.4c0.1-0.2,0.5-0.3,0.4-0.5c-0.1-0.3-0.4-0.4-0.6-0.5c-0.2-0.1-1.5,0.3-1.3-0.6  c0.1-0.3,1.4-1.2,1.4-1.2l-0.1-1.1c3-1.2,2.5,2.8,5.6,2.3c0.9-0.2,2.3-2,3-2.7c-0.2-0.1-0.6-1.9-0.6-2.2c0.2-1.9,2.7-4.4,2.4-6.3  c-0.2-1.2-0.5-1.7,0.2-3.1c0.7-1.2,2-2.2,2.6-3.4c0.8-1.7,0.7-3.8,1.5-5.4c0.6-1.2,7.1-5.8,6.5-6.7c-2-3.1-6.6-1.1-8.6-3.8  c-0.4-0.5,0-1.3-0.4-1.8c-0.9-1-5.2,0.8-6.2,0.1l0.2-1.4c-1.4-2.1-2.9,0.4-3.4-0.2c-1.6-1.8-2-5.8-2.8-6.4c0,0-1.7-0.6-1.7-0.6  c-0.7-0.3-1.8-1.1-2.5-1.1c-0.6-0.1-2.1,0.9-2.6,0.6c-0.6-0.3-1.9-2-3.5-2.4c-0.6-0.1-2.8,0.5-3.2,0.1c-0.5-0.4,0.1-2-0.2-2.5  c0,0-1.5-0.6-1.5-0.6c-0.1-0.6,1.8-0.7,0-1.4c-0.3-0.1-0.6,0.3-0.9,0.2c-0.5-0.2-1.4-2.1-2.8-2.6c0,0-1.6-0.7-1.6-0.7  c-0.2-0.5,0.9-1.8,0.9-2.3c-0.1-1.6-1-1.2-0.1-2.8c0.1-0.1,1.1-1.8,1-1.9c-1.4-1.6-2.9,2-3.4,2.5c-0.6,0.5-7.6,0.8-6.9-1  c0.2-0.4,1.5-1.3,1.5-1.8c0,0-1.1-1.3-1.1-1.3c0-0.8,1.7-1.7,1.6-2.5c-0.1-1-4.6-3.1-5.5-2.9c-0.3,0.1-0.3,0.5-0.6,0.6  c-1.1,0.2,0-3.5-1-4.1c-1-0.6-3.5,0-4-1.5c-0.4-1.3,0.8-4.8-1-5.8c-0.7-0.4-2.5,1.6-3.2,1.4c-3.5-0.9-2.9-6.1-3-8.7  c-3.3,0.9-7.6-1.2-10.8,0.3c-3.6,1.7-3.2,6.2-4.6,9.6c-0.4,1-0.5,0.6,0,1.3c0.1,0.1,0.5,0.4,0.4,0.4c-0.6,0.3-1.6-0.1-1.5,1.4  c0.1,0.9,1.1,1.9,1.3,2.4c0.1,0.3-1.3-1.3-1.9-0.8c-8.1,6.5-10.6,2.6-19.3,5.6c-4,1.4-2.6,6,1.1,5.7c0.2,0,0.6-0.3,0.7-0.1  c0.2,0.4-3.1,0-3.3,0c-1.8,0-3.5,1.6-5.5,1.6c-1.6,0-7.4-3.7-9.5-4.8c-1.8-1-3.2,0.6-3.2,0.6c-0.1,0-1-3.6-1-4.9  c0-0.9,1.2-0.8,1.3-2c0-0.3,0.3-0.6,0.1-0.9c-0.9-1.2-6.6,0.8-8.7-3.1c-0.1-0.2-0.2,0.3-0.2,0.5c0,1,1.3,1.8,0.7,2.9  c-0.2,0.4-0.9,0.4-0.9,0.8c-0.2,1.1,0.2,4.1,1.1,4.6c0.5,0.3,0,1.3,0.4,2.6c0,0.1,0.4,1.9,0.4,1.9c-0.2,0.3-0.7,0.2-0.8,0.5  c-0.1,0.1-0.4,2.2,0.2,1.8c0.3-0.2,0.4,0,0.2,0.1c-0.1,0-1.7,3.4-1.7,3.5c0,0.4,0,2.6,0.5,3.4c0.1,0.1,2.3,1,1.7,1.5  c-0.4,0.3-0.9-0.6-1.4-0.6c-1.1,0-3.3,0.1-4.3-0.3c-1.7-0.7,0.2-3.5-1.6-2.6c-0.1,0.1,0,0.3-0.1,0.3c-0.2,0-0.4-0.2-0.7-0.2  c-1.9,0.2,0.7,3.8-0.9,3.3c-0.1,0,0.3-0.1,0.3-0.3c0.1-0.4-0.2-2.3-0.4-2.6c-0.6-0.8-1.3,0.5-2.6,0.7c-0.5,0.1,0.4-1.3-0.1-1.5  c0,0-1.3,0.4-1.3,0.4c0-0.1,2-1.2,0.7-1.6c-0.2-0.1-0.2,0.5-0.4,0.6c-1.3,0.8-1.3-0.7-2.1-0.2c-0.2,0.1,0.2,0.5,0,0.7  c-0.2,0.2-2.8,0.7-3.1,0.9c-0.2,0.1-0.2,0.7-0.4,0.6c-0.1,0-1.6-5.1-2-6.3c-0.4-1.4-1.2-1.5-2.3-0.3c-0.2,0.2,1.2-1.3,1.1-2.2  c0-0.1-0.1-0.1-0.2-0.1c-0.7-0.1-1.1-0.1-1.6,0.4c-0.1,0.1-0.4,0.6-0.4,0.4c0.8-2.7-0.9-0.3-2.8-0.8c-0.6-0.2,0.6-1.7-1.1-1.1  c-1.2,0.4-0.7,2.5-1.6,2.8c-0.7,0.3-1.9-2-2.8-1.9c-0.6,0.1-1,0.8-1,1.3c0,0.2,0.1,0.5,0,0.5c-1.1,0-0.7-4-2.3-1.8  c-0.1,0.2-0.3-0.4-0.6-0.5c-1.2-0.6-1.9,1.4-3,0.5c-0.7-0.5,1.1-0.7-0.1-1.1c-0.6-0.2-1.2,0.6-1.4,0.6c-0.3,0.1-1.9-0.9-2.1-0.3  c-0.3,1.1-3-0.4-4.4,4c-0.5,1.7,3.4,0.7,4.1,0.9c1.7,0.5-0.4,0.5,0.1,1.1c0.5,0.7,2.8-0.4,2.5,0.4c-0.1,0.3-0.7,0.2-0.9,0.5  c-0.4,0.5,2.1,0.5,1.7,0.9c-0.3,0.2-3.8-0.7-4.3-1c-1.1-0.5,0.4-1.4-0.6-1.3c-0.5,0.1-0.6,0.6-1,0.8c-0.4,0.1,0.5,0.6,0.7,0.9  c0.3,0.5-1.1,1.5-0.5,1.6c0.5,0.2,0.8-1,1.1-1.1c1-0.2,2.4,1.8,2.3,2.5c0,0.2-0.1,0.5-0.2,0.7c-0.3,0.5-4.6-1.7-6.5-0.2  c-0.2,0.2,0.5,0.2,0.8,0.3c1,0.3,2.3,1.4,2.7,2.3c0.8,1.8-1.2,4.9,2.3,4.3c0.8-0.1,1.1-2.3,1.4-2.1c1,0.7,0.7,2.4,1.7,1.6  c1.4-1.1,0.4,0.7,1.4,1.9c0.4,0.5,1.5,0,1.9,0.2c1.1,0.7,1.9,2.5,2.9,3.4c0.6,0.5,1.3-0.2,1.5-0.3c0.5-0.1,1.3-1.2,1.2-0.7  c-0.3,1-0.5,1.7-0.5,2c0,0,0,0.1,0,0.2c0.2,0.3,0.6,0.7,0.6,0.7c0.1,0,0.2,0,0.2-0.1c0-0.1,0.1-0.2,0.2-0.3c0.4-0.7,0.8-2.1,1.3-1.3  c0.1,0.2-0.3,0.4-0.2,0.7c0,0.1-0.5,0.3-0.9,0.5c-0.1,0-0.2,0.1-0.2,0.1c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.4,0.4,0.8,0.5,1  c0.4,0.9-1.3,2.3-0.7,3c1,1.2,0.2-1.6,0.8-1.9c0.5-0.2,1.6,0.1,2,0.6c0.1,0.1,0.4-1.1,0.4-1.3c0-0.1-0.3-0.4-0.1-0.4  c1.1,0.3,0.2,1.2,0.5,1.6c0.5,0.6,1.6-1.3,2.2-0.8c0.7,0.6-0.4,1.4,0.8,1.3c0.2,0,0-0.7,0.2-0.7c0.2,0.1,0.1,0.5,0,0.7  c-0.7,1.5-0.9,0.8,1.3,1.5c0.4,0.1-1.4,0.1-1.1,0.4c0,0,1.7,0.1,1.7,0.1c0.8,0.4,0.8,1,1.8,1.2c0.3,0.1-0.5-0.2-0.8-0.2  c-0.4-0.1-1.5-0.1-1.1,0.8c0.3,0.5,0.4,0.8,0.6,0.9c0.1,0,0.1,0.1,0.1,0.1c0,0,0,0-0.1-0.1c-0.2-0.1-0.5-0.1-1.2,0  c-0.2,0.1-0.6-0.1-0.7,0.2c-0.3,1.5,2.4,2.5-0.3,1.7c-0.5-0.1,0.7,0.9,1.2,1.1c1.2,0.3,1.6,1.2,1.8,1.2c1.4,0.4,1.7-1.9,4.1-0.6  c0.4,0.2,3.4,2.7,3.3,3.1c-0.2,0.5-1.1-0.4-1.5-0.8c-0.6-0.5-2.2-3.3-4.1-1.9c-0.4,0.3-0.3,0.9-0.4,1.3c-0.2,0.5-1.5,0.5-1.3,1.1  c0.3,0.8,3.6,1.3,2.8,3c-0.7,1.6-2.6,1.5-3.2,3.4c-0.1,0.3,2.2,3.4,2.2,3.5c0.9,1,0.4,2.9,0.5,4c0.2,1.1,1.6,1.5,2,2.1  c0.1,0.2-0.3,0.5-0.2,0.7c0,0,1.8,0.5,1.8,0.5c0.9,0.5-0.2,1.4,0.2,1.9c0,0,1.5,0,1.5,0c0.7,0.5,0.4,1.7,1.4,2.2  c0.2,0.1,0.3-1.8,1.7-0.6c1.3,1.1-2.6,1.8-2.2,2.6c0.6,1.4,0.7,1.4,1.2,2.8c0.1,0.3,0.6,0.8,0.3,0.8c-0.3,0-0.6-0.4-0.9-0.3  c-0.4,0.2,0.3,1,0.1,1.5c-0.1,0.2,0,0.4,0,0.5c0,0.2,0.1,0.5,0,0.5c-0.2,0.1-1.3,0.2-1.3,0.4c-0.5,1.2,0.9,2.1,1.1,3  c0,0-2.1-2.3-2.6-2c-1.3,0.7-0.4,1.9,0.2,2.2c1,0.6,1.8,2.2,2.2,3.1c0.8,2.2,2.5,3,2.5,5.7c0,1.2-0.2,2.4-0.4,3.6  c-0.1,1.1-0.1,0.6-0.1,1.4c0,0.1,0,0.2,0,0.3c0.1,0.2,0.2,0.5,0.2,0.8c0.2,0.5,0.3,0.7,0.2,0.9c0.1,0.2,0.1,0.5,0.2,0.8  c0.6,0.9,1.6,2.4-0.2,1.9l0.2-1.7c0-0.1,0-0.1,0-0.2c-0.2-0.3-0.3-0.6-0.3-0.6c0.1,0,0.1-0.1,0.1-0.1c-0.1-0.3-0.2-0.6-0.2-0.9  c-0.1-0.2-0.1-0.3-0.2-0.5c0-0.1,0-0.2,0-0.2c-0.2-0.7-0.3-1.4-0.4-3.1c0-2.8-1.9-5.2-2.8-7.5c-0.1-0.4-0.8,0.2-1.1,0.4  c-1.2,1-1.5,3.1-2,4.7c-1.2,3.9-4,7.7-4.8,11.8c-0.3,1.6,4.9-5.1,3.3,0.9c-0.1,0.5-2.4-0.6-2.4-0.6c-1.6,0.7-2.1,4.4-2.7,5.9  c-1.3,3.3-6.8,16.2-9.8,17.2c-1,0.3-2-0.2-2.7-0.4l0.1,0.4c0.5,0.6,1.5,2.3,2.2,2.6c0.8,0.3,2.5,0.3,3,1.3c0.8,1.5-1.8,2.6-2.1,3.7  c-0.4,1.7,2.6-0.4,2.7-0.3c0.2,0.1,0,0.5-0.1,0.7c0,0.2-0.2,0.5-0.1,0.7c1.3,2.3,5.7,2.1,7.4,3.8c0.8,0.8,0.4,3.2,1.3,3.9  c1.7,1.4,4.6-0.5,6.2,1.3c0.9,1,0.2,2.9,2,3.4c0.7,0.2,1.7-0.6,2.5-0.4c0.8,0.2,1.4,1.5,2.2,1.6c0,0,1-0.8,1-0.8  c1.1,0,3.5,2.3,4.6,1.5c0.7-0.5-0.5-3.2,1.5-2.8c1.1,0.2,4.1,2.1,4.8,2.9c0,0,0.7,1.6,0.7,1.6c0.7,0.5,2.5,0.3,3.1,1.1  c0.4,0.5,0.5,1.8,0.7,2.5c0.3-0.5,0.8-1,1.1-1c0.9-0.2,5.2,1.2,2.4,4.1c0.8,0.5,2.4,1,3,1.8c0.5,0.6,0,1.8,1.1,2  c1.2,0.3,2.6-0.8,3.8-0.6c0.8,0.2,5.1,3.5,5.5,3.3l0.6-1.6c1.8-1.5,5.8,0.6,7.6,1.3c-0.1-1.1-0.9-1.8-1.2-2.7  c-0.7-2,1.2-3.6,0.8-5.1c0-0.2-1.4-0.6-1.1-0.9c0.8-1,1.1-0.7,1.8-1c0.2-0.1,0.2-0.5,0.1-0.7c-0.6-2,1.6-1.3,1.1-2.6  c-0.2-0.4-0.9-0.5-0.3-1.1c0.7-0.6-0.2,0.9,0.6,0.8c0.7-0.1,1.7-1.9,2.3-2.3c1.5-1,2.6-0.2,4-0.6c1.3-0.3,2.4-1.8,3.8-2.5  c-0.4,0.1-0.6,0.2-0.5,0c0.8-0.7,2.8-2,4.1-2c3.1,0,2.1,1.9,4.1,2.8c0.6,0.3,5,1.2,5.1,1.8c0,0-0.7,0.9-0.7,0.9  c0,0.5,2.9,1.4,3.3,1.3c0.7-0.2,0.5-0.5,0.1-0.9c-0.1,0-0.1-0.1-0.2-0.1c-0.3-0.2-0.6-0.5-0.7-0.5c-0.2-0.5,0.5-1.5,0.4-2  c0-0.3-0.6-0.8-0.4-0.8c1.3,0.2-0.1,2.5,0.6,3.3c0,0,0.1,0.1,0.2,0.1c0.1,0.1,0.3,0.1,0.5,0.2c0.5,0,0.9-0.7,1.5-0.7  c0.4,0,1.7,1.1,2.2,0.4c0.5-0.7-0.8-1-0.7-1.5c0.2-1,1.3-1,1.9-0.4c0.2,0.2-0.2,0.5-0.1,0.7c0.7,1.4,0.7-0.2,1.5,0.3  c1.3,0.7-3.4,1.8-3.4,1.8c0,0.2,0.1,0.5,0.1,0.7c0.2,1.2,3.9,0.3,4.3,0.4c1.3,0.6-0.2,2.4,0.2,3.2c0.2,0.4,3.8,0.9,4.6,1.5  c1.5,1.2,1.4,3.3,2.2,3.2c1.9-0.3-0.3-1.8,1.3-1.5c0.5,0.1,0.9,0.6,1.4,0.9c0.4,0.2,1-0.1,1.2,0.2c0.9,1.4-0.8,0.2-0.7,0.9  c0,0.2,0.4,0.1,0.6,0.1c1.8,0.3-0.3-0.7,1.2-1.5c1.1-0.6,1.8,1.4,2.6,1.5c0.6,0.1,0.2-1.4,0.8-1.6c0.5-0.2,1,0.3,1.5,0.3  c2.1-0.2,1.8,0.3,3.1-1.4c0.1-0.2,0.5-0.3,0.3-0.5c0,0-1.7-0.3-1.7-0.3c-0.2-0.4,1-0.1,1.4-0.5c0.5-0.6,1.1-1.2,1.6-2.2  c0.3-0.6,1.4,0.7,2,0.3c0.8-0.6,1-1.7,1.6-2.2c0.8-0.6,2.3,0.2,2.5,0.1c0.4-0.2-0.1-1.7,0.6-2c2.3-0.8,3.4,0.3,5.3-1.6  c0.1-0.1,0.4-0.1,0.7,0c-0.1-0.4-0.2-1.6-0.2-1.6c0.4-1.2,5.7-4.2,3.5-6.1c-0.9-0.8-6.9,1.3-10.3-4.4c-0.8-1.4,0.2-1.9,0.4-2.7  c0.2-0.7-1.6-0.8-0.9-1.9c1.3-2,5.1-3.1,3.5-6.1c-0.6-1.2-3-1.5-3.5-2.7c-0.2-0.4,0.4-0.9,0.2-1.4c-0.1-0.5-1.7-1.9-1.6-2.4  c0.1-0.3,0.5-0.1,0.8-0.2c2.1-0.6,1.6,0.5,2.6,0.4c0.9,0,5.8-3.9,5.7-5c-0.1-0.9-2-1.7-2.3-2.5c0,0,0.1-1.6,0.1-1.6  c0-0.3,0.2-0.6,0-0.8c-1.5-3.5-5.2-2.9,1.7-6l0.1,0.3C766.3,619.6,766.4,617.7,765.6,617.4"/>
                      <path data-border="bordfrancia2"  fill="none" stroke="#A27A40" stroke-width="0" d="M765.6,617.4c-0.3-0.1-0.7,0.4-1,0.2c-0.4-0.4,0.7-1.1,0.5-1.7c-0.2-0.5-1.2-0.1-1.4-0.6c-0.4-0.9,1.3-1.7,1.3-2.2  c0.1-0.6-1-1.3-0.9-1.9c0.2-1.3,2.1-2.2-1.5-2.7c-6.8-1-5.2,3.4-6.3,4.2c-0.5,0.3-3.8,2.2-4.3,1c-0.1-0.3,0.5-0.3,0.6-0.6  c0.4-2.4,0.9-0.6,2-1.4c0.8-0.6,0.1-5.6,1.5-7.1c1.1-1.2,4.2-1.3,5-2.6c0.5-0.8-0.3-2.7,0.3-3.4c0.7-0.9,3.2-0.5,4.1-1.4  c0.7-0.7,1.4-1.9,2.3-2.8c1.2-1.1,3-1.9,3.5-2.4c0.1-0.2,0.5-0.3,0.4-0.5c-0.1-0.3-0.4-0.4-0.6-0.5c-0.2-0.1-1.5,0.3-1.3-0.6  c0.1-0.3,1.4-1.2,1.4-1.2l-0.1-1.1c3-1.2,2.5,2.8,5.6,2.3c0.9-0.2,2.3-2,3-2.7c-0.2-0.1-0.6-1.9-0.6-2.2c0.2-1.9,2.7-4.4,2.4-6.3  c-0.2-1.2-0.5-1.7,0.2-3.1c0.7-1.2,2-2.2,2.6-3.4c0.8-1.7,0.7-3.8,1.5-5.4c0.6-1.2,7.1-5.8,6.5-6.7c-2-3.1-6.6-1.1-8.6-3.8  c-0.4-0.5,0-1.3-0.4-1.8c-0.9-1-5.2,0.8-6.2,0.1l0.2-1.4c-1.4-2.1-2.9,0.4-3.4-0.2c-1.6-1.8-2-5.8-2.8-6.4c0,0-1.7-0.6-1.7-0.6  c-0.7-0.3-1.8-1.1-2.5-1.1c-0.6-0.1-2.1,0.9-2.6,0.6c-0.6-0.3-1.9-2-3.5-2.4c-0.6-0.1-2.8,0.5-3.2,0.1c-0.5-0.4,0.1-2-0.2-2.5  c0,0-1.5-0.6-1.5-0.6c-0.1-0.6,1.8-0.7,0-1.4c-0.3-0.1-0.6,0.3-0.9,0.2c-0.5-0.2-1.4-2.1-2.8-2.6c0,0-1.6-0.7-1.6-0.7  c-0.2-0.5,0.9-1.8,0.9-2.3c-0.1-1.6-1-1.2-0.1-2.8c0.1-0.1,1.1-1.8,1-1.9c-1.4-1.6-2.9,2-3.4,2.5c-0.6,0.5-7.6,0.8-6.9-1  c0.2-0.4,1.5-1.3,1.5-1.8c0,0-1.1-1.3-1.1-1.3c0-0.8,1.7-1.7,1.6-2.5c-0.1-1-4.6-3.1-5.5-2.9c-0.3,0.1-0.3,0.5-0.6,0.6  c-1.1,0.2,0-3.5-1-4.1c-1-0.6-3.5,0-4-1.5c-0.4-1.3,0.8-4.8-1-5.8c-0.7-0.4-2.5,1.6-3.2,1.4c-3.5-0.9-2.9-6.1-3-8.7  c-3.3,0.9-7.6-1.2-10.8,0.3c-3.6,1.7-3.2,6.2-4.6,9.6c-0.4,1-0.5,0.6,0,1.3c0.1,0.1,0.5,0.4,0.4,0.4c-0.6,0.3-1.6-0.1-1.5,1.4  c0.1,0.9,1.1,1.9,1.3,2.4c0.1,0.3-1.3-1.3-1.9-0.8c-8.1,6.5-10.6,2.6-19.3,5.6c-4,1.4-2.6,6,1.1,5.7c0.2,0,0.6-0.3,0.7-0.1  c0.2,0.4-3.1,0-3.3,0c-1.8,0-3.5,1.6-5.5,1.6c-1.6,0-7.4-3.7-9.5-4.8c-1.8-1-3.2,0.6-3.2,0.6c-0.1,0-1-3.6-1-4.9  c0-0.9,1.2-0.8,1.3-2c0-0.3,0.3-0.6,0.1-0.9c-0.9-1.2-6.6,0.8-8.7-3.1c-0.1-0.2-0.2,0.3-0.2,0.5c0,1,1.3,1.8,0.7,2.9  c-0.2,0.4-0.9,0.4-0.9,0.8c-0.2,1.1,0.2,4.1,1.1,4.6c0.5,0.3,0,1.3,0.4,2.6c0,0.1,0.4,1.9,0.4,1.9c-0.2,0.3-0.7,0.2-0.8,0.5  c-0.1,0.1-0.4,2.2,0.2,1.8c0.3-0.2,0.4,0,0.2,0.1c-0.1,0-1.7,3.4-1.7,3.5c0,0.4,0,2.6,0.5,3.4c0.1,0.1,2.3,1,1.7,1.5  c-0.4,0.3-0.9-0.6-1.4-0.6c-1.1,0-3.3,0.1-4.3-0.3c-1.7-0.7,0.2-3.5-1.6-2.6c-0.1,0.1,0,0.3-0.1,0.3c-0.2,0-0.4-0.2-0.7-0.2  c-1.9,0.2,0.7,3.8-0.9,3.3c-0.1,0,0.3-0.1,0.3-0.3c0.1-0.4-0.2-2.3-0.4-2.6c-0.6-0.8-1.3,0.5-2.6,0.7c-0.5,0.1,0.4-1.3-0.1-1.5  c0,0-1.3,0.4-1.3,0.4c0-0.1,2-1.2,0.7-1.6c-0.2-0.1-0.2,0.5-0.4,0.6c-1.3,0.8-1.3-0.7-2.1-0.2c-0.2,0.1,0.2,0.5,0,0.7  c-0.2,0.2-2.8,0.7-3.1,0.9c-0.2,0.1-0.2,0.7-0.4,0.6c-0.1,0-1.6-5.1-2-6.3c-0.4-1.4-1.2-1.5-2.3-0.3c-0.2,0.2,1.2-1.3,1.1-2.2  c0-0.1-0.1-0.1-0.2-0.1c-0.7-0.1-1.1-0.1-1.6,0.4c-0.1,0.1-0.4,0.6-0.4,0.4c0.8-2.7-0.9-0.3-2.8-0.8c-0.6-0.2,0.6-1.7-1.1-1.1  c-1.2,0.4-0.7,2.5-1.6,2.8c-0.7,0.3-1.9-2-2.8-1.9c-0.6,0.1-1,0.8-1,1.3c0,0.2,0.1,0.5,0,0.5c-1.1,0-0.7-4-2.3-1.8  c-0.1,0.2-0.3-0.4-0.6-0.5c-1.2-0.6-1.9,1.4-3,0.5c-0.7-0.5,1.1-0.7-0.1-1.1c-0.6-0.2-1.2,0.6-1.4,0.6c-0.3,0.1-1.9-0.9-2.1-0.3  c-0.3,1.1-3-0.4-4.4,4c-0.5,1.7,3.4,0.7,4.1,0.9c1.7,0.5-0.4,0.5,0.1,1.1c0.5,0.7,2.8-0.4,2.5,0.4c-0.1,0.3-0.7,0.2-0.9,0.5  c-0.4,0.5,2.1,0.5,1.7,0.9c-0.3,0.2-3.8-0.7-4.3-1c-1.1-0.5,0.4-1.4-0.6-1.3c-0.5,0.1-0.6,0.6-1,0.8c-0.4,0.1,0.5,0.6,0.7,0.9  c0.3,0.5-1.1,1.5-0.5,1.6c0.5,0.2,0.8-1,1.1-1.1c1-0.2,2.4,1.8,2.3,2.5c0,0.2-0.1,0.5-0.2,0.7c-0.3,0.5-4.6-1.7-6.5-0.2  c-0.2,0.2,0.5,0.2,0.8,0.3c1,0.3,2.3,1.4,2.7,2.3c0.8,1.8-1.2,4.9,2.3,4.3c0.8-0.1,1.1-2.3,1.4-2.1c1,0.7,0.7,2.4,1.7,1.6  c1.4-1.1,0.4,0.7,1.4,1.9c0.4,0.5,1.5,0,1.9,0.2c1.1,0.7,1.9,2.5,2.9,3.4c0.6,0.5,1.3-0.2,1.5-0.3c0.5-0.1,1.3-1.2,1.2-0.7  c-0.3,1-0.5,1.7-0.5,2c0,0,0,0.1,0,0.2c0.2,0.3,0.6,0.7,0.6,0.7c0.1,0,0.2,0,0.2-0.1c0-0.1,0.1-0.2,0.2-0.3c0.4-0.7,0.8-2.1,1.3-1.3  c0.1,0.2-0.3,0.4-0.2,0.7c0,0.1-0.5,0.3-0.9,0.5c-0.1,0-0.2,0.1-0.2,0.1c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.4,0.4,0.8,0.5,1  c0.4,0.9-1.3,2.3-0.7,3c1,1.2,0.2-1.6,0.8-1.9c0.5-0.2,1.6,0.1,2,0.6c0.1,0.1,0.4-1.1,0.4-1.3c0-0.1-0.3-0.4-0.1-0.4  c1.1,0.3,0.2,1.2,0.5,1.6c0.5,0.6,1.6-1.3,2.2-0.8c0.7,0.6-0.4,1.4,0.8,1.3c0.2,0,0-0.7,0.2-0.7c0.2,0.1,0.1,0.5,0,0.7  c-0.7,1.5-0.9,0.8,1.3,1.5c0.4,0.1-1.4,0.1-1.1,0.4c0,0,1.7,0.1,1.7,0.1c0.8,0.4,0.8,1,1.8,1.2c0.3,0.1-0.5-0.2-0.8-0.2  c-0.4-0.1-1.5-0.1-1.1,0.8c0.3,0.5,0.4,0.8,0.6,0.9c0.1,0,0.1,0.1,0.1,0.1c0,0,0,0-0.1-0.1c-0.2-0.1-0.5-0.1-1.2,0  c-0.2,0.1-0.6-0.1-0.7,0.2c-0.3,1.5,2.4,2.5-0.3,1.7c-0.5-0.1,0.7,0.9,1.2,1.1c1.2,0.3,1.6,1.2,1.8,1.2c1.4,0.4,1.7-1.9,4.1-0.6  c0.4,0.2,3.4,2.7,3.3,3.1c-0.2,0.5-1.1-0.4-1.5-0.8c-0.6-0.5-2.2-3.3-4.1-1.9c-0.4,0.3-0.3,0.9-0.4,1.3c-0.2,0.5-1.5,0.5-1.3,1.1  c0.3,0.8,3.6,1.3,2.8,3c-0.7,1.6-2.6,1.5-3.2,3.4c-0.1,0.3,2.2,3.4,2.2,3.5c0.9,1,0.4,2.9,0.5,4c0.2,1.1,1.6,1.5,2,2.1  c0.1,0.2-0.3,0.5-0.2,0.7c0,0,1.8,0.5,1.8,0.5c0.9,0.5-0.2,1.4,0.2,1.9c0,0,1.5,0,1.5,0c0.7,0.5,0.4,1.7,1.4,2.2  c0.2,0.1,0.3-1.8,1.7-0.6c1.3,1.1-2.6,1.8-2.2,2.6c0.6,1.4,0.7,1.4,1.2,2.8c0.1,0.3,0.6,0.8,0.3,0.8c-0.3,0-0.6-0.4-0.9-0.3  c-0.4,0.2,0.3,1,0.1,1.5c-0.1,0.2,0,0.4,0,0.5c0,0.2,0.1,0.5,0,0.5c-0.2,0.1-1.3,0.2-1.3,0.4c-0.5,1.2,0.9,2.1,1.1,3  c0,0-2.1-2.3-2.6-2c-1.3,0.7-0.4,1.9,0.2,2.2c1,0.6,1.8,2.2,2.2,3.1c0.8,2.2,2.5,3,2.5,5.7c0,1.2-0.2,2.4-0.4,3.6  c-0.1,1.1-0.1,0.6-0.1,1.4c0,0.1,0,0.2,0,0.3c0.1,0.2,0.2,0.5,0.2,0.8c0.2,0.5,0.3,0.7,0.2,0.9c0.1,0.2,0.1,0.5,0.2,0.8  c0.6,0.9,1.6,2.4-0.2,1.9l0.2-1.7c0-0.1,0-0.1,0-0.2c-0.2-0.3-0.3-0.6-0.3-0.6c0.1,0,0.1-0.1,0.1-0.1c-0.1-0.3-0.2-0.6-0.2-0.9  c-0.1-0.2-0.1-0.3-0.2-0.5c0-0.1,0-0.2,0-0.2c-0.2-0.7-0.3-1.4-0.4-3.1c0-2.8-1.9-5.2-2.8-7.5c-0.1-0.4-0.8,0.2-1.1,0.4  c-1.2,1-1.5,3.1-2,4.7c-1.2,3.9-4,7.7-4.8,11.8c-0.3,1.6,4.9-5.1,3.3,0.9c-0.1,0.5-2.4-0.6-2.4-0.6c-1.6,0.7-2.1,4.4-2.7,5.9  c-1.3,3.3-6.8,16.2-9.8,17.2c-1,0.3-2-0.2-2.7-0.4l0.1,0.4c0.5,0.6,1.5,2.3,2.2,2.6c0.8,0.3,2.5,0.3,3,1.3c0.8,1.5-1.8,2.6-2.1,3.7  c-0.4,1.7,2.6-0.4,2.7-0.3c0.2,0.1,0,0.5-0.1,0.7c0,0.2-0.2,0.5-0.1,0.7c1.3,2.3,5.7,2.1,7.4,3.8c0.8,0.8,0.4,3.2,1.3,3.9  c1.7,1.4,4.6-0.5,6.2,1.3c0.9,1,0.2,2.9,2,3.4c0.7,0.2,1.7-0.6,2.5-0.4c0.8,0.2,1.4,1.5,2.2,1.6c0,0,1-0.8,1-0.8  c1.1,0,3.5,2.3,4.6,1.5c0.7-0.5-0.5-3.2,1.5-2.8c1.1,0.2,4.1,2.1,4.8,2.9c0,0,0.7,1.6,0.7,1.6c0.7,0.5,2.5,0.3,3.1,1.1  c0.4,0.5,0.5,1.8,0.7,2.5c0.3-0.5,0.8-1,1.1-1c0.9-0.2,5.2,1.2,2.4,4.1c0.8,0.5,2.4,1,3,1.8c0.5,0.6,0,1.8,1.1,2  c1.2,0.3,2.6-0.8,3.8-0.6c0.8,0.2,5.1,3.5,5.5,3.3l0.6-1.6c1.8-1.5,5.8,0.6,7.6,1.3c-0.1-1.1-0.9-1.8-1.2-2.7  c-0.7-2,1.2-3.6,0.8-5.1c0-0.2-1.4-0.6-1.1-0.9c0.8-1,1.1-0.7,1.8-1c0.2-0.1,0.2-0.5,0.1-0.7c-0.6-2,1.6-1.3,1.1-2.6  c-0.2-0.4-0.9-0.5-0.3-1.1c0.7-0.6-0.2,0.9,0.6,0.8c0.7-0.1,1.7-1.9,2.3-2.3c1.5-1,2.6-0.2,4-0.6c1.3-0.3,2.4-1.8,3.8-2.5  c-0.4,0.1-0.6,0.2-0.5,0c0.8-0.7,2.8-2,4.1-2c3.1,0,2.1,1.9,4.1,2.8c0.6,0.3,5,1.2,5.1,1.8c0,0-0.7,0.9-0.7,0.9  c0,0.5,2.9,1.4,3.3,1.3c0.7-0.2,0.5-0.5,0.1-0.9c-0.1,0-0.1-0.1-0.2-0.1c-0.3-0.2-0.6-0.5-0.7-0.5c-0.2-0.5,0.5-1.5,0.4-2  c0-0.3-0.6-0.8-0.4-0.8c1.3,0.2-0.1,2.5,0.6,3.3c0,0,0.1,0.1,0.2,0.1c0.1,0.1,0.3,0.1,0.5,0.2c0.5,0,0.9-0.7,1.5-0.7  c0.4,0,1.7,1.1,2.2,0.4c0.5-0.7-0.8-1-0.7-1.5c0.2-1,1.3-1,1.9-0.4c0.2,0.2-0.2,0.5-0.1,0.7c0.7,1.4,0.7-0.2,1.5,0.3  c1.3,0.7-3.4,1.8-3.4,1.8c0,0.2,0.1,0.5,0.1,0.7c0.2,1.2,3.9,0.3,4.3,0.4c1.3,0.6-0.2,2.4,0.2,3.2c0.2,0.4,3.8,0.9,4.6,1.5  c1.5,1.2,1.4,3.3,2.2,3.2c1.9-0.3-0.3-1.8,1.3-1.5c0.5,0.1,0.9,0.6,1.4,0.9c0.4,0.2,1-0.1,1.2,0.2c0.9,1.4-0.8,0.2-0.7,0.9  c0,0.2,0.4,0.1,0.6,0.1c1.8,0.3-0.3-0.7,1.2-1.5c1.1-0.6,1.8,1.4,2.6,1.5c0.6,0.1,0.2-1.4,0.8-1.6c0.5-0.2,1,0.3,1.5,0.3  c2.1-0.2,1.8,0.3,3.1-1.4c0.1-0.2,0.5-0.3,0.3-0.5c0,0-1.7-0.3-1.7-0.3c-0.2-0.4,1-0.1,1.4-0.5c0.5-0.6,1.1-1.2,1.6-2.2  c0.3-0.6,1.4,0.7,2,0.3c0.8-0.6,1-1.7,1.6-2.2c0.8-0.6,2.3,0.2,2.5,0.1c0.4-0.2-0.1-1.7,0.6-2c2.3-0.8,3.4,0.3,5.3-1.6  c0.1-0.1,0.4-0.1,0.7,0c-0.1-0.4-0.2-1.6-0.2-1.6c0.4-1.2,5.7-4.2,3.5-6.1c-0.9-0.8-6.9,1.3-10.3-4.4c-0.8-1.4,0.2-1.9,0.4-2.7  c0.2-0.7-1.6-0.8-0.9-1.9c1.3-2,5.1-3.1,3.5-6.1c-0.6-1.2-3-1.5-3.5-2.7c-0.2-0.4,0.4-0.9,0.2-1.4c-0.1-0.5-1.7-1.9-1.6-2.4  c0.1-0.3,0.5-0.1,0.8-0.2c2.1-0.6,1.6,0.5,2.6,0.4c0.9,0,5.8-3.9,5.7-5c-0.1-0.9-2-1.7-2.3-2.5c0,0,0.1-1.6,0.1-1.6  c0-0.3,0.2-0.6,0-0.8c-1.5-3.5-5.2-2.9,1.7-6l0.1,0.3C766.3,619.6,766.4,617.7,765.6,617.4"/>
                      <path data-border="bordespaña"  fill="none" stroke="#A27A40" stroke-width="0" d="M689.9,679.9l-0.6,1.6c-0.5,0.2-4.7-3.2-5.5-3.3c-1.2-0.3-2.6,0.8-3.8,0.6c-1.1-0.3-0.6-1.4-1.1-2c-0.6-0.7-2.2-1.3-3-1.8  c-4.4,0.7-4.4-1.4-3.6-2.9l0.1,0c-0.2-0.6-0.3-2.2-0.7-2.6c-0.6-0.8-2.4-0.6-3.1-1.1c0,0-0.7-1.6-0.7-1.6c-0.7-0.8-3.7-2.7-4.8-2.9  c-2-0.4-0.8,2.3-1.5,2.8c-1.1,0.8-3.5-1.5-4.6-1.5c0,0-1,0.8-1,0.8c-0.8-0.1-1.4-1.4-2.2-1.6c-0.7-0.2-1.7,0.6-2.5,0.4  c-1.8-0.5-1.1-2.4-2-3.4c-1.7-1.8-4.6,0.1-6.2-1.3c-0.9-0.8-0.5-3.1-1.3-3.9c-1.7-1.7-6.1-1.5-7.4-3.8c-0.1-0.2,0-0.5,0.1-0.7  c0-0.2,0.2-0.6,0.1-0.7c-0.1-0.1-3.1,2.1-2.7,0.3c0.2-1.1,2.9-2.2,2.1-3.7c-0.5-1-2.2-1-3-1.3c-0.7-0.3-1.7-2-2.2-2.6l-0.1-0.4  c-0.1,0-0.2,0-0.3-0.1c-0.9-0.1-1.4,1.1-1.9,1.3l-0.9-0.6c-0.8-0.1-1.9,0.5-2.7,0.3c-1.5-0.4-6.6-4.7-7.1-4.5  c-0.2,0.1-0.2,0.6-0.4,0.6c-0.7,0.1-0.1-1.4-0.5-1.9c-0.3-0.4-4-0.4-4.5,0.1c-0.2,0.2,0,0.5-0.1,0.7c0,0.2,0.2,0.8-0.1,0.7  c-1.7-0.5-3.3-4.3-5.6-4.2c-0.2,0-0.2,0.7-0.4,0.6c-1.5-0.5,1-1,0.9-1.2c-0.1-0.2-1.6-1.6-1.9-1.6c-2.4-0.5-2.6,1.4-4,1  c-1.2-0.4,2.4-0.8,0.5-1.7c-0.3-0.1-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.2-0.9-0.1c-0.4,0.1-0.4,1-0.8,0.8c-1.3-0.4-4,0.1-5.3-0.6  c-3.1-1.5-8.7-3.6-12.1-6c-0.5-0.4-0.6-1.1-1.1-1.5c-0.3-0.2-0.6-0.3-1-0.3c-0.3,0-0.6,0.5-0.9,0.4c-0.3-0.1,0.5-0.3,0.7-0.5  c0.4-0.6-3.6-1.4-3.9-1.7c-0.2-0.1-1.1-3.1-1.9-3.2c-1.4-0.1-0.7,1.1-1.5,1.3c-1.7,0.4-3.4-1.2-4.4-1.8c-0.5-0.3-2.2,0.5-2.9,0.1  c-2.1-1-5-2.2-7.5-2.9c-0.9-0.3-1,0.2-1.6,0.7c-0.1,0.1-0.3,0.6-0.4,0.4c-0.3-0.4,1-1.4,0.8-1.5c-0.7-0.5-2.9-0.2-3.4-0.8  c-0.5-0.7-0.9-3.2-1.9-4.3c-0.7-0.8-1.6,0.2-2.1,0c-0.2-0.1,0.2-0.4,0.2-0.6c0-1.6-0.4-0.4-1.2-0.4c-0.5,0,1.2-1.2,0.7-1.2  c-0.6,0-2.1,0.9-2.5,0.9c-0.3,0-0.5-0.4-0.7-0.3c-0.3,0.2,0,1.1-0.4,1c-0.8-0.3,1.9-2.2,0.4-2.4c-1.9-0.3-9.4,2.7-11.7,3.4  c-2,0.6-4.8,1.9-6.9,1.9c-3.4,0,1.5-0.3-1.1-0.8c-0.4-0.1-0.7,0.6-1.1,0.7c-0.9,0.1-1.8-0.9-2.5,0.2c-0.5,0.7,1.7,0.5,1.7,0.6  c-0.1,0.4-0.8,0.1-1.2,0.3c-0.2,0.1-2,0.3-2,0.3c-0.6-0.2-0.1,1.4-0.4,1.9c-0.2,0.3-0.9,0.9-0.6,1.4c0.5,0.7,0.9-0.8,1.6-0.5  c0.9,0.3-0.2,3.2-0.2,3.4c0,0.3-0.2,1,0.2,1c0.3,0,0.5-0.3,0.7-0.5c0.1-0.1,0-0.3,0.1-0.3c0.9-0.1,1.4,0.3,2.1,0.1  c0.2,0,0.5,0,0.5,0.2c0,0.4-5.5,2.3-4.3,5c0.3,0.7,2.2-1.4,2.6-1.2c1.4,0.5,0-0.7,1.1-0.7c0.6,0,0.1,2.4,1.7,0.6  c0.4-0.5-0.6,1.1-1.1,1.4c-0.3,0.2-0.9,0-1.2,0.3c-0.5,0.5,0.2,1.6-0.7,1.9c-0.8,0.3-0.3-0.9-0.5-0.9c-1.7-0.6-0.5,1.9,0,2.2  c0.2,0.2,2.9,0.2,2.9,0.3c-0.1,0.6-4.4,1.5-4.3,2.1c0.1,1.9,3.8-0.2,4.2-0.3c0.3-0.1-0.3,0.7-0.6,0.9c-0.7,0.4-1.7,0.2-2.4,0.6  c-0.2,0.1-0.4,0.3-0.6,0.5c-0.3,0.2-0.9,0-1.1,0.3c-0.1,0.4,0.5,1.3,0.1,1.2c-0.5-0.2-0.2-1.3-1.2-0.5c-0.3,0.2-1.4,4.5-1.2,4.7  l1.5-0.7c0,0,0,0.1-0.1,0.2l0.9-0.5c2.9-1.2,8.4-1.5,10.1,0.8c1.2,1.7-5.6,2.3-2.4,5c1.2,1,3.4-1.5,4.2-0.3c0.1,0.2-0.4,0.5-0.2,0.7  c0.4,0.4,2.3,0.1,2.9,0.3c0.6,0.2,1.3,0.4,1.6,0.9c0.2,0.4-1.2,0.6-0.8,0.8c0,0,1.9,0,1.9,0c0.5,0.2,0.4,1.2,0.9,1.4  c0.4,0.2,3.9-0.1,4.2-0.3l0.2-1.4c0.6-0.3,2.9,1.5,3.5,1.8c0.7,0.3,1.4,1.1,1.9,0.3c0.1-0.1,0.1-0.5,0.3-0.4  c0.5,0.2,0.4,1.1,0.9,1.4c0.8,0.6,1.6-0.2,2.3,1c0.2,0.4-0.7,0.7-0.5,1.1c0.2,0.3,0.8,0,1,0.3c0.3,0.6-1.4,2.8-1.5,3.5  c-0.1,0.9,5.2,1.3,4,4.3c-0.4,1-4.1,3.3-5.1,3.7c-1.1,0.5-2.5-0.1-3.4,0.3c-1.4,0.6-2.4,2.6-3.8,3.1c-0.9,0.3-1.6-1.1-1.9,0.6  c-0.1,0.9,0.8,2,0.6,3c-0.2,1.4-1.5,5.5-2.4,6.8c0,0-1.1,0.7-1.1,0.7c-0.5,0.8,0.5,1.4,0.4,2c-0.4,2.1-5.2,0.5-5.1,3.3  c0,1.1,1.5,2,1.3,3.4c-0.1,1.3-3.1,5.5-4.3,5.8c-0.7,0.2-6.5-2.3-7.6-2.7c-0.3-0.1-0.6-0.5-0.8-0.3c-0.5,0.7,1.9,4.5,2,5.5  c0,0.2-1.7,3.3-0.8,5.5c0.2,0.5,0.9,0.6,1,1.1c0.1,0.3-0.5,0.7-0.3,1c0.6,0.9,2.5,0.4,2.5,2c-0.1,1.3-2.2,1.8-2.4,2.8  c-0.1,0.3,0.4,0.6,0.3,0.8c-0.5,0.8-3.7,0.8-4.5,1.3c-0.1,0-2.9,4.4-3,4.6c-0.4,0.9,0.4,1.1,0.6,2c0.2,1,0.3,4.2,0.9,4.9  c0,0,1.9,0.2,1.9,0.2c0.2,0.1,0.4,0.5,0.3,0.7c-0.8,3.7-4.2,1-5.9,2.2c-0.3,0.2-0.2,0.7-0.3,1c-1,1.7-2.5,1.6-3.9,2.6  c-3.5,2.7-2.8,7.1-3.6,11c2,0.3,4.8,1,5.5,1.3c0,0,1.3,1.2,1.3,1.2c0.7,0.2,1.5-1.1,2.1-0.9c0.5,0.2-1,0.9-0.8,1.4  c1,2.3,3.5,4.1,4.7,6.3c0.4,0.7,0.4,3.8,1.2,4c0.3,0.1,0.5-0.3,0.7-0.7c0-0.4,0-0.8,0.5-1c0.3-0.1,0.6,0.1,0.8,0.1  c0.3,0,0.6,0.1,0.8,0.1c0.2,0,0.6-0.4,0.6-0.1c0.4,1.1-2.2-0.1-2.3-0.1c-0.2,0.1-0.3,0.6-0.5,1c0,0.4,0.1,0.7-0.2,0.9  c-0.6,0.5-1.7-0.2-2,0.8c-0.8,2.4,2,2.4,2.1,4.3c0,0.4,0.4,0.9,0.5,1.2c0,0-1.1-0.7-2-1c-0.2-0.1,0.2,0.5,0.3,0.7  c0.2,0.5,0.4,0.9,0.5,1.4c0.3,1.4,0.3,2.6,0.8,3.9c0.2,0.5,0.1,2,0.4,2.3c0,0,1.9,0.6,1.9,0.6c1,0.9,2.4,4.6,3.9,5.3  c2.9,1.4,2.7-1.2,3.4-2.1c0.5-0.7,1.2,0.4,1.6,0.5l1-1.3c0.6-0.8,2.6-2.6,3.6-2.9c1-0.3,4.7-0.7,5.7-0.3c1.2,0.4,1.8,1.9,3.4,1.4  c1.5-0.4,3.6-2.9,5.1-3.1c1.4-0.2,11.1,2.6,12.8,3.2c0.9,0.3,1.7,1.6,2.7,1.9c1.4,0.3,3.8-0.3,6,0.4c2.4,0.7,3.6,3,5.8,3.1  c1.9,0.1,2.8-2.6,6.4-1c1.7,0.8,1.3,2.5,3.2,3c1.2,0.3,2.9-2.8,4.1-3.1c1.3-0.3,2.3-3.3,3.6-4.7c1.4-1.4,7.5-4.6,9.4-4.9  c1.3-0.2,2.9,1.4,3.6,1.3c0.2,0,0-0.5,0.2-0.7c0.2-0.2,0.6-0.1,0.9-0.1c1.9,0.1,3.6,2.4,5.8,0.8c0.4-0.3-2-1.5-1.8-3  c0.1-0.7,2.1-0.8,2.2-0.8c0.6-0.4,0.1-1.5,0.5-2c0.4-0.5,1.8-0.8,2-1.2c0.5-0.9,0-2.4,0.6-3.4c0.5-0.8,1.9,0,2.4-0.4  c0.6-0.5,0.4-2.1,1-2.6c0.4-0.4,1.2,0.4,1.7,0.1c0.5-0.3,0.3-1.5,1-1.9c1.6-0.7,3.4-0.4,4.9-0.5c1.1-0.1,0.3-0.9,0.9-1.2  c1.5-0.8,3.6-0.4,5.2-1.5c1.4-1.1-3.7-4.2-4.2-5.3c-1.1-2.1-1.6-11.4,0-13.1c1.4-1.5,6.9-7.4,8.2-8.2c2-1.3,4.3-2.5,6.2-4.1  c1.6-1.4,3.5-5.1,5.5-5.7c0.3-0.1,0.6,0,0.9,0.1c0.3,0,0.7-0.2,0.9,0.1c0.1,0.1-0.3,0.3-0.4,0.4c-0.6,0.7-1.9-0.3-1.4,0.6  c0.7,1,1.5-0.9,2.3-1.2c0.4-0.1,1.2,0.2,1.6,0c2.2-0.8-1.7-2.9-1.7-2.9c0.3-1.2,4.1-3.2,5.2-3.7c1.5-0.7,1.9-0.1,3.2,0.1  c0,0,1-0.8,1-0.8c1.2-0.3,3.4-0.2,4.6-0.3c2.8-0.2,6,0.9,8.8,0.3c1.8-0.4,2.6-2.2,4.1-3c4.4-2.2,12.3-2.5,16.1-5.7  c2.6-2.2-0.5-4.7,0.4-7c0.7-1.6,3.2,0.9,3.4-1.4c0-0.6-1.4-0.8-1.6-1c-0.8-1.2,0.2-0.9,0.1-1.7C695.7,680.5,691.7,678.4,689.9,679.9  "/>
                      <path data-border="bordmilan" fill="none" stroke="#A27A40" stroke-width="0" d="M921.8,746.6c-0.3-0.5,0.7-1.5-0.2-2.1c-1.7-1.2-6-2.6-8.3-4c-2.5-1.5-3.8-4.1-6.6-5.4c-5.3-2.3-11.8-4.1-16.3-8  c-5.1-4.4,6-5.5,3.1-9.9c-1.2-1.8-5.4,0.1-7.2-0.4c-1.6-0.4-2.8,0.2-4.4,0.1c-2.9-0.2-7.9-2.5-10-4.4c-0.6-0.5,0.2-1.2-0.1-1.7  c-0.6-0.9-2.3-1-3-1.9c-3.6-4.8-6.3-7.1-8.1-13.3c-0.8-2.9-2-12.8-3.6-14.6c-2.1-2.4-2.3-1-4.5-2.8c-1.5-1.2-2.7-3-4.1-4.4  c-3.6-3.4-8.5-5.2-9.3-11c-0.4-3-0.9-7.2,0.5-10c0.3-0.7,0.8,1.3,1.9,0.9c0.5-0.2-0.5-1-0.4-1.4c0.1-0.2,0.8-0.4,0.7-0.1  c0,0.2,0.8-0.1,0.9-0.3c0.1-0.2,0.8-1.4,0.8-1.5c-0.6-0.5-2.2-2.3-2.2-2.3c-0.3,0.2,0.2-0.1-0.2-0.4c-0.2-0.1-0.6,0.1-0.7-0.1  c-0.3-0.5,0.5-0.4,0.6-0.8c0.1-0.7-0.3-1-0.3-1.6c0-0.2,0.3-0.7,0.1-0.7c-0.5-0.1-1.4,1.3-1.2-0.3c0.2-2.3-0.5,0.5-0.7-1.1  c0-0.2-0.2-0.4-0.1-0.5c1.2-0.9,2.4-2.5,2.5-2.9c-0.1,0-0.2,0.1-0.3,0.2c0.3-0.3,0.4-0.3,0.3-0.2c0.6-0.2,1.7,0.1,1.7-0.5  c0-0.3-0.7-0.6-0.4-0.7c0.3-0.2,0.6,0.4,0.9,0.4c0.7,0.1,0.1-1.7,1-0.6c0.2,0.2,1.2-0.2,1,0.1c-1.2,1.4-2,0.4-2.6,2.2  c0,0,1-0.4,2.5-1c1.8-0.7,4.1-2.3,6-2.4c0.3,0,3.2-0.1,2.5-1.2c-0.1-0.2-0.5,0.3-0.8,0.3c0,0-0.8-0.5-0.4-0.7c1-0.8,1.5-1.4,2.7-0.5  c0.5,0.4,1.6,0.1,2.1,0.5c0.2,0.2,0.4,0.4,0.4,0.7c0,0.3-0.7,0.4-0.5,0.6c0.2,0.2,0.5-0.3,0.8-0.4c1.1-0.6,1.3-2.6,2.8-1.4  c1.2,1,0.9,1.9,1.5,2.9c0.1,0.2,0.9,0.2,0.7,0.4c-0.2,0.3-0.6-0.1-1-0.1c-0.1,0-0.2,0.2-0.3,0.3c0.9,0.2,1.9,0.8,2.5,0  c1.5-1.9-3.1-3.6-3.9-4.6c-0.8-1.1,1.2-2.4,0.8-3.4c-0.3-0.6-2.4,0.7-2.1-0.9c0.1-0.8,3.4-2.3,2.9-3.2c-0.5-1-4.3-0.9-3.9-2.7  c0.5-2,4.4-1.2,5.1-4.4l0.2-0.3c-6.1-1.4-14-1.6-18.1-4.7c-0.5-0.4-0.5-1.6-1-1.8c-0.3-0.1-0.7,0.2-0.9-0.1  c-0.4-0.5,0.6-1.2,0.4-1.7c-0.2-0.6-1.7-0.7-2-1.2c-0.1-0.1-0.1-2,0-2.1c0.3-0.3,1.4-0.4,1.1-0.7c-0.6-0.8-2.9,0.1-3.7,0.3  c-2.2,0.5-10.5-0.4-11.2,0.1c-1,0.7-1.5,3.5-2.6,3.9c-0.3,0.1-3.8-0.9-3.9-1.1c-0.2-0.4,0.8-1.1-0.8-1.5c-0.9-0.2-1.9,0.5-2.8-0.3  l0-0.3c-0.3,1.5-1.3,2.6-1.7,4c-0.3,1.1,1.5,0.9,1.2,2.2l-0.6,1c-2.6,0.7-2.1-3.8-4.8-2.3c-2.5,1.4,0.4,3.7,0.4,4.2  c0,0-0.9,1.6-0.9,1.6c-0.1,1.3,1.7,1.4-0.3,2.1c-0.3,0.1-0.5,0.4-0.8,0.3c-0.8-0.4-0.4-3.1-1.2-3.6c-1.8-1.1-3.5,1.7-5,1.1  c-2.5-1-0.4-3.4-1.8-4.8c-0.3-0.3-0.4,1-0.8,0.9c-0.2,0-0.8-2.2-1.8-0.6c-0.2,0.2,0,0.6,0,0.9c0,0.7,0.3,2,0,2.6  c-0.9,2.1-5.4,3.9-5.3,6.6c0,0.6,2,2.7,0.1,3.1c-1.4,0.3-1.1-2.4-1.5-3l-1.6-0.9c-0.1-0.7,1.1-0.9,1.2-1.6c0-0.2-4.8-2.9-5.2-4.6  c-0.2-0.7,0.5-2.7,0.6-3.5c0-0.3,0.3-0.7,0.1-0.9c-0.4-0.4-4.4,2.5-5,2.8c-1.9,1.2,0.4,1,0.1,2.4c-0.2,0.8-5,4.7-5.3,4.8  c-1,0.1-2.4-2-3.6-2c-2.1,0-5,2-7.2,1c-0.3-0.1-0.5-0.5-0.7-0.8l-0.1-0.3c-6.9,3.1-3.2,2.5-1.7,6c0.1,0.3,0,0.5,0,0.8  c0,0-0.1,1.6-0.1,1.6c0.3,0.8,2.2,1.6,2.3,2.5c0.1,1.1-4.8,5-5.7,5c-1,0-0.6-1-2.6-0.4c-0.3,0.1-0.7,0-0.8,0.2  c-0.1,0.5,1.4,1.9,1.6,2.4c0.1,0.4-0.4,0.9-0.2,1.4c0.6,1.2,2.9,1.5,3.5,2.7c1.6,3-2.2,4.1-3.5,6.1c-0.7,1.1,1.1,1.2,0.9,1.9  c-0.2,0.9-1.3,1.3-0.4,2.7c3.4,5.7,9.4,3.7,10.3,4.4c2.2,1.9-3,4.9-3.5,6.1c0,0,0.2,1.2,0.2,1.6c0.8,0.1,1.8,0.5,2.2,0.5  c1.9-0.2,6.4-0.7,7.7-2.3c0.2-0.3-0.3-0.8-0.1-1.1c0.3-0.4,1-0.4,1.4-0.8c0.5-0.7-0.3-1,0.7-1.6c0.6-0.3,1.9-0.2,2.4-0.7  c0.5-0.5,0.4-1.6,0.5-2c0.3-0.7,4.6-2.3,5.3-2.4c0.2,0,5.1,2,5.2,2.1c0,0,0.3,2.1,1,1.5c0.3-0.2,0-1.1,0.4-1c1.2,0.4,6.7,6.5,8,7.7  c0.4,0.3-0.1-1.4,0.2-1.4c0.3,0.1,3.2,1.9,3.7,2.2c3.8,2.3,0.2,8.8,1.8,11.7c0.9,1.6,2.2,3.1,2.7,5.2c0.4,1.8-1.9,5-1.2,6.1  c0.3,0.5,2.7-0.4,3.7,0.8c1.1,1.3-0.7,1.8-0.5,2.4c0.2,0.7,2.4,1,2.9,1.4c0,0,3.3,5.1,3.3,5.2c0,2.1-2,0.4-1.5,2.3  c0.1,0.5,3.2,0.4,4.6,0.5c3.5,0.4,4.1,6.8,5.8,8.2c0,0,1.3,0.1,1.3,0.1c0.9,0.5,2.2,1.7,2.9,2.4c1.3,1.2,0.7,3,1.4,4.3  c0.6,1.1,2.6,1.7,3.4,2.8c0.5,0.7,1.2,3.4,2,3.6c0.3,0.1,0.5-0.3,0.8-0.3c0.5,0.1,0.9,1.3,1.4,1.5c1.8,0.7,2.1-0.4,3.4,2.4  c0,0,0.6,1.8,0.6,1.8c0.6,0.6,3-1.6,4-1.4c1.2,0.2,2,1.7,3.2,1.9c1.1,0.2,2-1,3.2-0.4c1.8,1,3.3,5.1,4,6.9c0.1,0.3,0.5,1.8,0.8,2.6  c0-0.1,0-0.1,0-0.1c0.1-0.2,0.3-0.3,0.5-0.3c0.5,0,0.7,0.7,1.3,0.8c0.5,0,0.9-0.6,1.4-0.6c0.7,0.1,3.4,2.2,3.2,3  c-0.2,1-3,1.1-2.8,2.2c0,0.2,0.3,0.4,0.5,0.4c0.7,0,1.5-1.3,2.2-1.2c1.8,0.1,3-0.5,4.8-0.4c1.2,0.1,2.9,4.7,3.1,5.7  c0.2,1.5-2,1.8-1.5,3.4c0.3,1,2.7,1.2,3.4,1.6c1.5,0.8,2.3,4.3,4.3,4c1.3-0.2,2.2-4.7,4.5,0.1c0.3,0.7,1.2,1.9,1.3,2.6  c0.1,1.9-0.2,4.7,1,6.6c0.9,1.4,2,2.4,2.5,4.3c0.5,2.2,0,4.7,0.7,6.9c0.7,2.1,2.2,1.3,1.7,3.9c-0.8,3.9-3.9,1-6.1,3.1  c-1.1,1,1.3,2.4,0.6,4c-2.5,6-2.1,2.3-4.6,4.7c-0.6,0.5-0.4,6.1,1.6,6.6c8,2.2,5.2-4.1,10-7.4c1.3-0.9,3.3-0.8,3.9-2.6  c0.9-2.6-1.2-5.3,0.9-7.5c3.5-3.7,9-0.2,9.9-4.1c0-0.1-1.3-1.3-1.3-1.8c0-0.7,0.6-1.4,0.6-2c0-0.8-0.8-1.5-0.4-2.4  c0,0,0.9-1.7,0.9-1.7c-0.3-0.6-1.3-0.3-1.9-0.8c-1.3-1-2.8-3.2-4.4-4c-1.3-0.6-2.6,0.3-3.7-1.2c0-0.2,0.1-0.9,0-1  c-1.5-3.7,1.2-2.4,1.8-5.1c0.1-0.6-0.4-1.1-0.5-1.7c0-0.2,4.7-7.4,5.4-8c1.9-1.9,2.6-0.6,4.5-0.5c0.5,0,1.4-0.5,1.9-0.3  c0.6,0.3-2.2,1.1-1.9,1.7c0.2,0.5,2.6,1.6,3.1,1.8c1.4,0.5,7.8,1,8.2,2c0.1,0.3,0.1,1.5,0.2,1.7c0.2,0.6,1.1,0.7,1.3,1.4  c0,0.1-0.2,0.2-0.3,0.3c-0.2,0.2-0.6,0.4-0.5,0.7c0.1,0.3,0.7,0.1,0.8,0.4c0.6,1.3,0.4,3,2.8,4.2c3.9,1.9,2.7-0.5,3.5-3.4  c0.4-1.3,1.6-1.1,1.6-2.7C929.4,750.9,922.8,748.3,921.8,746.6"/>
                      <path data-border="bordnavarra" fill="none" stroke="#A27A40" stroke-width="0" d="M641.574,657.049 641.522,656.535     641.464,656.372 641.409,656.229 641.263,656.069 641.216,656.053 641.135,656.022 641.016,656.022 640.625,656.125     640.385,656.122 640.384,656.121 640.38,656.121 639.688,655.979 639.368,655.89 639.058,655.758 638.981,655.722 638.98,655.723     638.949,655.722 638.712,655.729 638.659,655.732 638.383,655.692 638.375,655.685 637.817,655.257 637.7,655.018     637.278,654.495 637.032,654.427 636.563,654.299 636.557,654.294 636.35,654.113 636.217,654.003 636.054,653.756     635.797,653.351 635.615,653.294 635.615,653.294 635.476,653.458 635.281,653.586 635.272,653.577 635.188,653.483     635.127,653.081 635.016,652.939 635.002,652.936 634.797,652.853 634.757,652.835 634.565,652.698 634.416,652.591     634.339,652.535 634.29,652.446 634.246,652.201 634.161,652.107 634.135,652.1 634.081,652.083 633.751,652.121 633.75,652.122     633.666,652.089 633.495,652.019 633.491,652.016 633.26,651.753 632.86,651.435 632.752,651.268 632.928,650.97 633.151,650.708     633.125,650.651 633.141,650.607 633.18,650.488 633.345,650.399 633.376,650.312 633.3,650.254 633.294,650.254 632.707,650.355     632.542,650.437 632.364,650.744 631.999,651.696 631.827,651.87 631.746,651.953 631.646,652.007 631.167,651.789     631.038,651.717 630.973,651.679 630.655,651.502 630.399,651.229 630.094,650.806 629.995,650.38 630.01,650.057     630.363,649.971 630.808,649.757 630.951,649.678 631.183,649.445 631.444,648.991 631.48,648.741 631.59,648.468     631.637,648.428 631.998,648.141 632.04,648.063 632.167,647.834 632.248,647.363 632.343,647.196 632.381,646.943     632.359,646.691 632.347,646.667 632.29,646.537 632.148,646.326 632.01,646.263 632.002,646.262 631.623,646.19 631.307,646.205     631.275,646.19 631.167,646.139 631.063,646.037 630.714,645.471 630.705,645.457 630.621,645.425 630.561,645.399     630.542,645.393 629.936,645.283 629.82,645.306 629.624,645.618 629.425,645.821 629.107,645.912 628.768,645.836     628.766,645.835 628.677,645.78 628.54,645.694 628.448,645.585 628.461,645.216 628.56,644.794 628.614,644.693 628.626,644.54     628.623,644.44 628.52,644.343 628.514,644.341 627.951,644.187 627.577,644.137 627.45,644.118 627.443,644.117 627.148,644.187     627.111,644.191 627.107,644.192 626.953,644.227 626.94,644.231 626.706,644.347 626.675,644.362 626.509,644.266     626.344,644.332 625.992,644.242 625.898,644.307 625.821,644.357 625.697,644.505 625.566,644.632 625.482,644.797     625.454,645.001 625.454,645.001 625.453,645.002 625.343,645.16 625.184,645.236 625,645.328 624.876,645.455 624.802,645.473     624.694,645.496 624.55,645.423 624.534,645.415 624.409,645.507 624.372,645.538 624.265,645.551 624.19,645.561 624.19,645.561     624.189,645.561 624.212,645.395 624.201,645.218 624.023,645.191 623.95,645.24 623.855,645.303 623.826,645.476     623.848,645.573 623.875,645.671 623.726,645.643 623.641,645.627 623.573,645.587 623.536,645.564 623.497,645.524     623.448,645.474 623.405,645.221 623.342,645.207 623.295,645.446 623.234,645.632 623.232,645.632 623.232,645.632     623.112,645.766 623.016,645.904 623.007,645.918 622.96,646.098 622.941,646.314 622.916,646.421 622.864,646.646     622.946,646.979 623.025,647.138 622.959,647.313 622.943,647.343 622.876,647.462 622.759,647.484 622.707,647.495     622.427,647.788 622.403,647.817 622.309,647.937 622.308,647.937 622.307,647.937 622.134,647.927 622.069,647.942     621.974,647.969 621.878,647.971 621.773,647.978 621.715,647.951 621.616,647.904 621.571,647.925 621.464,647.974     621.237,648.168 621.185,648.213 621.016,648.252 620.839,648.199 620.78,648.246 620.703,648.309 620.611,648.369     620.53,648.421 620.489,648.584 620.381,648.723 620.344,648.883 620.305,648.913 620.029,649.107 619.956,649.199     619.925,649.243 619.909,649.289 619.87,649.41 619.942,649.578 619.908,649.74 619.909,649.741 619.909,649.741 619.907,649.745     619.852,649.906 619.801,649.997 619.766,650.063 619.436,650.218 619.273,650.164 618.749,650.125 618.489,650.406     618.395,650.562 618.33,650.616 618.261,650.674 618.154,650.729 618.106,650.756 617.994,650.723 617.945,650.709     617.859,650.702 617.729,650.69 617.553,650.593 617.197,650.633 617.179,650.621 617.05,650.533 616.945,650.402     616.943,650.402 616.943,650.402 616.941,650.381 616.904,650.222 616.764,650.081 616.734,650.093 616.576,650.148     616.548,650.32 616.547,650.32 616.546,650.321 616.464,650.361 616.232,650.472 616.115,650.594 616.002,651.094     615.874,651.177 615.853,651.19 615.853,651.19 615.851,651.192 615.613,651.262 615.614,651.277 615.663,651.635     615.599,651.807 615.639,652.021 615.62,652.122 615.61,652.191 615.638,652.398 615.641,652.419 615.641,652.419 615.641,652.42     615.561,652.612 615.46,652.691 615.43,652.716 615.331,652.854 615.185,652.968 615.155,652.975 614.851,653.049     614.727,653.355 614.426,653.808 614.447,654.018 614.423,654.191 614.466,654.287 614.494,654.345 614.491,654.346     614.493,654.346 614.297,654.656 614.22,654.72 614.165,654.767 614.163,654.768 614.163,654.769 614.066,654.752     613.996,654.739 613.916,654.745 613.815,654.753 613.677,654.648 613.513,654.607 613.402,654.758 613.339,654.914     613.382,655.072 613.409,655.129 613.462,655.229 613.376,655.406 613.323,655.77 613.34,655.934 613.341,655.954     613.268,656.111 613.256,656.134 613.34,656.155 613.367,656.164 613.43,656.161 613.494,656.156 613.607,656.113 613.61,656.493     613.6,656.58 613.588,656.677 613.586,656.678 613.419,656.712 613.295,656.705 613.234,656.703 613.071,656.73 612.993,656.754     612.879,656.792 612.799,656.892 612.767,656.933 612.598,656.964 612.483,656.908 612.448,656.892 612.279,656.867     612.099,656.898 612.099,656.898 612.004,656.736 612.014,656.659 612.025,656.551 611.998,656.448 611.98,656.382     611.872,656.251 611.552,656.073 611.365,656.127 611.263,656.183 611.202,656.216 610.854,656.318 610.712,656.425     610.619,656.612 610.619,656.612 610.619,656.612 610.518,656.626 610.446,656.638 610.297,656.724 610.276,656.736     610.276,656.736 610.251,656.74 610.113,656.764 610.082,656.78 609.947,656.855 609.841,656.869 609.779,656.876     609.719,657.055 609.704,657.099 609.694,657.175 609.682,657.266 609.843,657.581 610.011,657.55 610.135,657.669     610.194,657.779 610.306,657.985 610.488,657.945 610.645,657.862 610.654,657.84 610.715,657.683 610.837,657.563     610.909,657.46 610.954,657.396 611.103,657.522 611.257,657.59 611.311,657.754 611.264,657.935 611.258,657.997     611.247,658.104 611.312,658.313 611.313,658.376 611.313,658.485 611.278,658.573 611.249,658.645 611.247,658.644     611.247,658.644 611.228,658.661 611.12,658.749 611.061,658.924 610.983,659.041 610.944,659.099 610.944,659.145     610.946,659.276 610.87,659.427 610.811,659.602 610.778,659.649 610.706,659.754 610.628,659.83 610.58,659.88 610.424,659.963     609.916,659.892 609.664,659.645 609.537,659.696 609.228,659.823 609.344,659.833 609.411,659.902 609.444,659.935     609.534,660.17 609.603,660.269 609.651,660.301 609.712,660.341 610.061,660.421 610.073,660.423 610.074,660.424     610.208,660.536 610.274,660.59 610.388,660.618 610.524,660.601 610.728,660.641 610.758,660.646 610.878,660.641     610.969,660.678 610.99,660.685 611.19,660.859 611.343,661.068 611.411,661.16 611.457,661.188 611.514,661.224 611.564,661.222     611.635,661.218 611.718,661.114 611.689,660.989 611.719,660.873 611.72,660.873 611.72,660.873 611.821,660.955 612,661.142     612.071,661.215 612.16,661.23 612.423,661.271 612.497,661.372 612.509,661.473 612.512,661.508 612.513,661.51 612.546,661.63     612.653,661.672 612.656,661.671 612.77,661.627 612.982,661.748 612.982,661.75 612.982,661.75 613.029,661.813 613.058,661.853     613.122,661.947 613.122,661.947 613.123,661.95 613.142,662.07 613.131,662.188 613.145,662.224 613.176,662.303     613.396,662.408 613.428,662.46 613.532,662.625 613.559,662.636 613.646,662.667 613.715,662.67 613.778,662.667 613.86,662.752     613.865,662.758 614.006,662.959 614.109,663.04 614.243,663.028 614.457,662.934 614.457,662.934 614.519,662.989     614.555,663.024 614.669,663.073 614.699,663.068 614.789,663.052 614.937,663.076 615.021,663.089 615.109,663.088     615.148,663.09 615.148,663.09 615.196,663.258 615.101,663.323 615.047,663.362 614.973,663.515 615.004,663.686     615.155,663.764 615.253,663.912 615.289,664.01 615.317,664.075 615.395,664.191 615.418,664.227 615.399,664.401     615.303,664.514 615.269,664.554 615.19,664.706 615.241,664.812 615.268,664.869 615.454,664.869 615.527,664.882     615.617,664.896 615.784,664.872 615.967,664.589 616.183,664.57 616.215,664.567 616.237,664.571 616.364,664.593     616.468,664.66 616.505,664.673 616.691,664.73 616.817,664.817 616.983,664.992 616.984,664.995 617.109,665.239 617.15,665.352     617.124,665.466 617.167,665.492 617.238,665.538 617.421,665.585 617.523,665.68 617.583,665.776 617.612,665.882     617.619,665.908 617.793,665.902 617.809,665.9 617.894,666.126 617.894,666.126 617.895,666.128 617.916,666.257     617.887,666.371 617.88,666.385 617.823,666.47 617.821,666.484 617.809,666.587 617.965,666.798 617.995,666.817 618.073,666.86     618.12,666.925 618.15,666.961 618.262,666.99 618.263,666.989 618.276,666.997 618.375,667.053 618.415,667.125 618.444,667.172     618.405,667.413 618.39,667.453 618.366,667.519 618.258,667.646 618.195,667.723 618.174,667.838 618.206,667.988     618.311,668.027 618.44,668.02 618.554,667.961 618.677,667.937 619.051,668.341 619.067,668.379 619.094,668.447     619.082,668.566 619.128,668.68 619.142,668.685 619.234,668.722 619.471,668.659 619.518,668.766 619.519,668.767     619.595,668.875 619.625,668.962 619.637,668.992 619.771,669.001 619.879,669.027 619.937,669.067 619.961,669.084     619.962,669.089 620.087,669.4 620.224,669.433 620.365,669.466 620.544,669.473 620.609,669.56 620.649,669.613 620.781,669.722     620.782,669.722 620.784,669.729 620.845,669.887 620.821,670.06 620.964,670.176 620.967,670.258 620.97,670.354     620.969,670.354 620.966,670.358 620.825,670.452 620.774,670.629 620.729,670.793 620.756,670.901 620.773,670.956     620.874,671.075 620.878,671.082 620.879,671.083 620.767,671.201 620.763,671.206 620.597,671.258 620.254,671.305     620.108,671.19 620.108,671.191 620.096,671.147 620.064,671.026 619.944,670.905 619.795,670.798 619.717,670.78     619.615,670.757 619.281,670.863 619.194,670.877 619.097,670.891 618.954,670.822 618.947,670.817 618.945,670.816     618.844,670.672 618.763,670.515 618.416,670.458 618.277,670.564 618.254,670.692 618.246,670.733 618.228,670.766     618.158,670.893 617.998,670.986 617.978,670.995 617.822,671.047 617.765,671.079 617.666,671.14 617.276,671.471     617.153,671.532 617.114,671.553 617.061,671.586 616.772,671.77 616.683,671.89 616.672,671.907 616.62,672.075 616.569,672.245     616.54,672.462 616.506,672.504 616.435,672.598 616.497,672.966 616.578,673.007 616.655,673.046 616.654,673.046     616.731,673.214 616.91,673.327 616.963,673.391 617.016,673.456 617.098,673.688 617.098,673.688 617.1,673.689 617.314,673.701     617.501,674.021 617.702,673.965 617.881,674.018 618.026,674.114 618.18,674.167 618.351,674.169 618.608,674.392     618.702,674.572 618.769,674.743 618.803,674.924 619.028,675.196 619.202,675.264 619.484,675.519 619.664,675.545     619.829,675.444 620.211,675.365 620.323,675.519 620.727,675.825 620.834,675.952 620.943,676.102 620.963,676.276     621.001,676.435 621.318,676.847 621.469,676.925 621.597,677.047 621.75,677.105 622.251,677.189 622.597,677.04     622.768,677.033 623.074,677.188 623.197,677.321 623.342,677.406 623.516,677.426 623.655,677.537 623.831,677.597     623.929,677.74 624.085,677.662 624.24,677.306 624.379,677.202 624.544,677.195 624.737,677.138 624.81,676.966 624.788,676.758     624.977,676.735 625.109,676.593 625.171,676.384 625.268,676.22 625.802,675.754 625.95,675.648 626.068,675.503     626.405,675.385 626.499,675.218 626.604,675.077 626.703,674.87 626.714,674.688 626.62,674.528 626.471,674.451     626.291,674.466 626.138,674.386 626.004,674.273 625.894,673.897 625.938,673.736 625.864,673.394 625.741,673.275     625.642,673.136 625.561,672.96 625.587,672.79 625.684,672.645 625.73,672.488 625.72,672.306 625.748,672.125 625.868,671.996     625.881,671.793 625.916,671.611 625.821,671.279 625.722,671.139 625.681,670.922 625.723,670.761 625.736,670.588     625.833,670.441 625.993,670.314 626.209,670.004 626.35,669.687 626.439,669.541 626.485,669.362 626.573,669.205     626.561,669.033 626.665,668.906 626.805,668.799 626.933,668.667 627.255,668.474 627.331,668.308 627.679,668.158     628.014,667.982 628.092,667.789 628.087,667.625 628.008,667.45 627.841,667.419 627.829,667.253 627.84,667.08 627.962,666.948     628.004,666.767 628.29,666.274 628.424,666.134 628.494,665.959 628.627,665.852 628.946,665.694 629.109,665.633     629.272,665.586 629.442,665.61 629.613,665.498 629.75,665.37 629.793,665.189 629.871,665.038 629.74,664.507 629.73,664.333     630.041,663.911 630.175,663.795 630.408,663.536 630.575,663.511 630.696,663.629 630.908,663.903 631.24,663.809     631.409,663.831 631.504,663.685 631.453,663.521 631.521,663.363 631.649,663.224 632.149,662.997 632.32,663.029     632.66,663.014 632.678,662.145 632.769,661.979 632.955,661.922 633.109,661.974 633.244,662.093 633.404,662.134     633.573,662.16 633.952,662.169 634.076,662.307 634.25,662.33 634.38,662.443 634.55,662.387 634.736,662.362 634.801,662.033     634.932,661.932 635.021,661.764 634.992,661.597 635.017,661.418 635.114,661.265 635.287,661.24 635.63,661.273 635.79,661.335     635.981,661.287 636.152,661.332 636.51,661.289 636.675,661.234 636.836,661.152 637.072,660.887 637.221,660.785     637.434,660.77 637.567,660.787 637.704,660.679 637.745,660.518 637.861,660.377 638.023,660.33 638.146,660.478 638.32,660.542     638.447,660.439 638.796,660.022 638.792,659.85 638.711,659.689 638.78,659.533 638.953,659.474 638.981,659.3 638.955,659.112     638.952,658.929 639.035,658.779 639.072,658.599 639.235,658.5 639.531,658.278 639.691,658.2 639.961,657.969 639.912,657.786     639.912,657.786 639.954,657.625 640.031,657.466 640.211,657.449 640.365,657.375 640.533,657.368 640.698,657.308     640.838,657.199 641,657.248 641.181,657.255 641.309,657.356 641.464,657.43 641.537,657.45   "/>
                    </g>   
                    <g id="regiones">
                      <g id="aux" display="none"></g>
                      <g id="expmilan" display="none">
                        <g>
                          <image overflow="visible" width="296" height="299" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/F2883C30.png" transform="matrix(1 0 0 1 551.5002 602.5)">
                          </image>
                        </g>
                        <polygon fill="#FFFFFF" points="786.667,758.533 802.167,758.533 802.167,853.133 579.267,853.133 579.267,758.533     766.667,758.533 796.833,639.167   "/>
                        <text transform="matrix(1 0 0 1 592.0964 785.2324)" fill="#400808" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1490, Ducado de Milan</text>
                        <text transform="matrix(1 0 0 1 812.6213 708.8994)" enable-background="new    "><tspan x="0" y="0" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Estados </tspan><tspan x="-10.038" y="21.6" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Pontificios</tspan></text>
                        <text transform="matrix(1 0 0 1 593.5906 803.2324)" font-family="'ITCOfficinaRTVESerif'" font-size="15">Ordenada por Ludovico Sforza, </text>
                        <text transform="matrix(1 0 0 1 593.9714 821.2324)" font-family="'ITCOfficinaRTVESerif'" font-size="15">en 1490, no se llevó a la práctica</text>
                        <text transform="matrix(1 0 0 1 593.4011 839.2324)" font-family="'ITCOfficinaRTVESerif'" font-size="15">hasta agosto de 1492.</text>
                        <g>
                          <g>
                            <path fill="#400808" d="M802.167,631.167c0,0,0.939-1.838,2.736-4.974c1.809-3.128,4.45-7.573,8.072-12.629      c1.822-2.52,3.882-5.199,6.343-7.823c1.232-1.31,2.563-2.609,4.063-3.811c1.503-1.19,3.176-2.312,5.172-3.035      c1.008-0.323,2.092-0.603,3.251-0.537c1.136,0.049,2.344,0.323,3.346,0.941c0.271,0.128,0.505,0.297,0.734,0.474      c0.229,0.177,0.476,0.341,0.688,0.533c0.391,0.404,0.849,0.781,1.167,1.233c0.352,0.437,0.7,0.879,0.973,1.352      c0.303,0.463,0.583,0.936,0.813,1.424c0.979,1.936,1.703,3.964,2.232,6.016c0.302,1.023,0.493,2.058,0.742,3.092      c0.187,1.035,0.405,2.073,0.563,3.112c0.661,4.159,1.03,8.331,1.262,12.433c0.208,4.101,0.306,8.136,0.306,12.035      c0.007,3.899-0.074,7.664-0.18,11.231c-0.122,3.566-0.27,6.936-0.438,10.042c-0.34,6.213-0.716,11.382-0.998,14.998      c-0.293,3.614-0.46,5.68-0.46,5.68l-6.47-0.714c0,0,0.268-2.037,0.734-5.603c0.455-3.566,1.079-8.664,1.718-14.789      c0.318-3.063,0.628-6.382,0.922-9.896c0.277-3.513,0.541-7.22,0.723-11.054c0.189-3.834,0.288-7.795,0.283-11.813      c-0.028-4.015-0.189-8.089-0.626-12.109c-0.102-1.007-0.263-1.998-0.39-2.999c-0.188-0.979-0.321-1.982-0.556-2.943      c-0.399-1.95-0.979-3.83-1.747-5.558c-0.782-1.696-1.797-3.3-3.193-4.155c-1.361-0.907-3.09-0.969-4.765-0.467      c-1.678,0.513-3.271,1.443-4.729,2.492c-1.462,1.057-2.807,2.242-4.064,3.454c-2.517,2.431-4.683,4.975-6.607,7.378      c-3.833,4.828-6.688,9.131-8.644,12.16C803.197,629.377,802.167,631.167,802.167,631.167z"/>
                            <g>
                              <path fill="#400808" d="M839.319,681.465c3.214-2.606,9.113-3.393,13.117-3.091c-5.776,3.431-10.992,8.128-14.269,14.127       c-1.855-6.535-6.297-12.009-11.046-16.768C831.362,676.521,836.442,678.107,839.319,681.465z"/>
                            </g>
                          </g>
                        </g>
                      </g>
                      <g id="expnavarra" display="none">
                        <path fill="#FF6600" d="M746.128,701.703"/>
                        <text transform="matrix(1 0 0 1 677.9495 646.3164)" fill="#2A2A2A" font-family="'ITCOfficinaRTVESerifBold'" font-size="16.6673">Montpellier</text>
                       <image  overflow="visible" width="303" height="208" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/8400216F.png" transform="matrix(1 0 0 1 588.5 485.5)">
                      </image>
                        </image>
                        <polygon fill="#FFFFFF" points="632.066,508.786 632.066,602.306 648.501,602.306 625.318,657.374 657.992,601.382     843.098,601.382 843.098,508.786   "/>
                        <text transform="matrix(1 0 0 1 640.5017 531.9336)" fill="#480008" font-family="'ITCOfficinaRTVESerifBold'" font-size="16.6673">1498. Reino de Navarra</text>
                        <text transform="matrix(1 0 0 1 640.5017 548.6006)" font-family="'ITCOfficinaRTVESerif'" font-size="13.8894">Expulsión ordenada por Catalina</text>
                        <text transform="matrix(1 0 0 1 640.5017 565.2676)" font-family="'ITCOfficinaRTVESerif'" font-size="13.8894">de Foix y el rey Juan de Albret bajo</text>
                        <text transform="matrix(1 0 0 1 640.5017 581.9346)" font-family="'ITCOfficinaRTVESerif'" font-size="13.8894">presion de Fernando II de Aragón.</text>
                        <g>
                          <g>
                            <path fill="#400808" d="M625.318,665.834c0,0,1.237,2.24,3.565,6.062c2.331,3.818,5.745,9.227,10.165,15.483      c4.43,6.24,9.842,13.375,16.361,20.319c3.27,3.452,6.806,6.877,10.707,9.915c3.877,3.044,8.161,5.729,12.738,7.299      c2.288,0.755,4.646,1.189,6.95,1.145c2.304-0.038,4.537-0.572,6.561-1.553c2.029-0.975,3.844-2.369,5.464-3.962      c0.757-0.865,1.566-1.653,2.231-2.595c0.342-0.459,0.706-0.893,1.027-1.364c0.314-0.479,0.627-0.955,0.938-1.431      c2.453-3.835,4.254-7.978,5.713-11.99c1.449-4.025,2.609-7.929,3.498-11.592c0.477-1.82,0.87-3.586,1.226-5.271      c0.383-1.676,0.69-3.281,0.969-4.794c0.602-3.012,0.985-5.675,1.353-7.852c0.339-2.186,0.557-3.914,0.728-5.086      c0.164-1.174,0.252-1.8,0.252-1.8l6.525,0.977c0,0-0.115,0.637-0.331,1.83c-0.224,1.193-0.517,2.945-0.953,5.168      c-0.467,2.22-0.97,4.922-1.713,7.999c-0.349,1.541-0.732,3.18-1.197,4.896c-0.437,1.722-0.917,3.527-1.487,5.398      c-1.073,3.754-2.445,7.782-4.146,11.964c-1.714,4.173-3.8,8.519-6.688,12.662c-0.367,0.513-0.737,1.028-1.107,1.545      c-0.381,0.512-0.814,0.996-1.223,1.496c-0.789,1.019-1.769,1.921-2.685,2.869c-1.968,1.791-4.224,3.396-6.785,4.501      c-2.553,1.112-5.395,1.663-8.185,1.591c-2.796-0.061-5.515-0.695-8.044-1.645c-2.531-0.962-4.879-2.245-7.09-3.663      c-2.214-1.419-4.288-2.994-6.235-4.663c-3.919-3.315-7.38-6.955-10.56-10.595c-6.329-7.313-11.472-14.7-15.666-21.142      c-4.181-6.456-7.378-12.005-9.556-15.919C626.464,668.122,625.318,665.834,625.318,665.834z"/>
                            <g>
                              <path fill="#400808" d="M718.812,668.362c-3.304,2.491-9.228,3.068-13.218,2.624c5.895-3.224,11.273-7.732,14.76-13.612       c1.623,6.597,5.867,12.224,10.444,17.148C726.589,673.584,721.569,671.819,718.812,668.362z"/>
                            </g>
                          </g>
                        </g>
                      </g>                      

                      <g id="expaustria" display="none">
                        <image overflow="visible" width="390" height="261" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083A1.png" transform="matrix(1 0 0 1 853 560)">
                        </image>
                        <polygon display="inline" fill="#FFFFFF" points="916.5,777.4 916.5,696.4 930,696.4 889.5,596.6 943.5,696.4 1198,697     1198,777.4   "/>
                        <text transform="matrix(1 0 0 1 929.1211 714.8906)" display="inline" fill="#400808" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1421. Archiducado de Austria</text>
                        <text transform="matrix(1 0 0 1 929.1211 732.8906)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">Ordenada por Alberto V, la expulsión se</text>
                        <text transform="matrix(1 0 0 1 929.1211 750.8906)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">produjo tras la persecución, confiscación</text>
                        <text transform="matrix(1 0 0 1 929.1211 768.8906)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">de bienes y conversión forzosa de los niños.</text>
                        <g>
                          <g>
                            <path fill="#480008" d="M888.576,584.744c0,0-1.287-2.426-3.43-6.727c-2.141-4.303-5.141-10.48-8.524-17.999      c-3.379-7.52-7.148-16.38-10.696-26.084c-1.773-4.852-3.479-9.919-4.984-15.152c-1.515-5.229-2.813-10.634-3.65-16.172      c-0.389-2.776-0.661-5.585-0.689-8.432c-0.025-2.842,0.195-5.739,1.001-8.611c0.798-2.842,2.378-5.753,4.954-7.719      c2.559-1.994,5.754-2.744,8.599-2.794c5.761-0.04,10.808,1.602,15.34,3.359c4.554,1.777,8.595,3.889,12.288,5.88      c1.831,1.019,3.592,1.99,5.213,2.984c1.641,0.97,3.188,1.901,4.61,2.819c2.883,1.787,5.319,3.442,7.345,4.784      c2.017,1.353,3.564,2.46,4.637,3.194c1.067,0.741,1.637,1.136,1.637,1.136l-3.928,5.334c0,0-0.543-0.408-1.563-1.174      c-1.022-0.758-2.503-1.905-4.426-3.302c-1.929-1.385-4.256-3.098-6.994-4.94c-1.354-0.95-2.821-1.909-4.376-2.908      c-1.541-1.028-3.2-2.025-4.929-3.075c-3.476-2.047-7.285-4.22-11.464-6.033c-4.146-1.818-8.751-3.4-13.326-3.531      c-2.272-0.045-4.448,0.444-6.141,1.666c-1.708,1.198-2.965,3.15-3.717,5.461c-0.749,2.314-1.069,4.896-1.14,7.514      c-0.072,2.623,0.082,5.296,0.354,7.97c0.604,5.349,1.67,10.69,2.969,15.893c1.287,5.208,2.785,10.29,4.363,15.169      c3.157,9.763,6.58,18.733,9.666,26.358c3.091,7.624,5.854,13.905,7.83,18.283C887.382,582.271,888.576,584.744,888.576,584.744z      "/>
                            <g>
                              <path fill="#480008" d="M919.326,501.25c-0.594-4.095,1.752-9.564,4.063-12.85c-0.012,6.719,1.352,13.604,4.827,19.49       c-6.563-1.752-13.539-0.741-20.059,0.901C911.006,505.554,914.969,502.003,919.326,501.25z"/>
                            </g>
                          </g>
                        </g>
                        <text transform="matrix(1 0 0 1 903.5002 528.0234)" fill="#2A2A2A" font-family="'ITCOfficinaRTVESerifBold'" font-size="16.6673">Polonia</text>                        
                      </g>

                      <g id="expespaña" display="none">
                        <image overflow="visible" width="348" height="252" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083A2.png" transform="matrix(1 0 0 1 295 441)">
                        </image>
                        <path fill="#FFFFFF" d="M323.8,469.3 323.8,550.3 569.2,550.3 588,657 582.7,550.3 596.2,550.3 596.2,469.3   "/>
                        <text transform="matrix(1 0 0 1 337.1968 488.7119)" fill="#400808" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1492. Reino de Castilla y Aragon</text>
                        <text transform="matrix(1 0 0 1 337.1968 506.7119)" font-family="'ITCOfficinaRTVESerif'" font-size="15">La expulsión de los judíos de España</text>
                        <text transform="matrix(1 0 0 1 337.1968 524.7119)" font-family="'ITCOfficinaRTVESerif'" font-size="15">fue ordenada por los Reyes Católicos</text>
                        <text transform="matrix(1 0 0 1 337.1968 542.7119)" font-family="'ITCOfficinaRTVESerif'" font-size="15">en Granada el 31 de marzo de 1492.</text>
                        <g>
                          <g>
                            <path fill="#400808" d="M578.526,692.037c0,0-0.25-1.302-0.806-3.551c-0.556-2.248-1.417-5.445-2.683-9.196      c-1.27-3.744-2.932-8.064-5.223-12.39c-1.139-2.164-2.457-4.313-3.963-6.339c-1.518-2.012-3.249-3.888-5.214-5.362      c-1.969-1.45-4.157-2.509-6.405-2.813c-2.239-0.346-4.495-0.025-6.577,0.725c-2.088,0.734-4.014,1.841-5.739,3.069      c-1.727,1.232-3.263,2.575-4.637,3.87c-1.357,1.323-2.557,2.592-3.584,3.76c-1.029,1.165-1.893,2.218-2.593,3.096      c-0.711,0.865-1.228,1.591-1.6,2.063c-0.366,0.479-0.561,0.734-0.561,0.734l-4.884-3.921c0,0,0.227-0.256,0.651-0.734      c0.433-0.474,1.03-1.19,1.857-2.06c0.813-0.877,1.816-1.931,3.016-3.102c1.196-1.173,2.599-2.453,4.193-3.791      c1.619-1.315,3.437-2.684,5.52-3.948c2.08-1.257,4.447-2.41,7.112-3.132c2.642-0.736,5.653-0.951,8.539-0.276      c2.905,0.628,5.519,2.178,7.666,4.028c2.147,1.879,3.875,4.08,5.335,6.343c1.444,2.275,2.646,4.614,3.654,6.928      c2.026,4.625,3.375,9.109,4.376,12.974c0.993,3.868,1.618,7.131,2.007,9.419C578.372,690.721,578.526,692.037,578.526,692.037z"/>
                            <g>
                              <path fill="#400808" d="M527.241,666.895c4.098-0.574,9.557,1.795,12.832,4.12c-6.718-0.042-13.61,1.291-19.511,4.74       c1.781-6.556,0.801-13.535-0.812-20.063C522.974,658.555,526.509,662.534,527.241,666.895z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#400808" d="M581.08,712.14c0,0,0.828,1.5,2.46,4.007c0.815,1.253,1.836,2.754,3.072,4.425      c1.238,1.668,2.687,3.514,4.402,5.393c1.708,1.878,3.69,3.811,6.027,5.454c1.169,0.813,2.437,1.542,3.791,2.04      c1.349,0.486,2.793,0.778,4.182,0.562c1.387-0.193,2.701-0.811,3.834-1.759c1.133-0.952,2.102-2.184,2.921-3.542      c1.65-2.718,2.807-5.86,3.747-9.053c0.923-3.208,1.614-6.504,2.162-9.775c0.542-3.274,0.99-6.517,1.308-9.676      c0.343-3.153,0.577-6.218,0.78-9.125c0.185-2.909,0.33-5.663,0.426-8.209c0.201-5.09,0.266-9.34,0.297-12.315      c0.018-2.976,0.028-4.676,0.028-4.676l6.413,0.191c0,0-0.111,1.719-0.305,4.726c-0.208,3.007-0.526,7.302-1.032,12.449      c-0.25,2.574-0.561,5.361-0.922,8.306c-0.38,2.944-0.801,6.046-1.34,9.246c-0.513,3.201-1.166,6.499-1.921,9.832      c-0.762,3.333-1.674,6.701-2.84,10.01c-1.188,3.297-2.596,6.568-4.622,9.505c-1.008,1.464-2.207,2.838-3.673,3.931      c-1.46,1.091-3.25,1.82-5.057,1.954c-1.815,0.163-3.541-0.312-5.042-0.955c-1.509-0.661-2.83-1.536-4.021-2.471      c-2.372-1.887-4.274-3.985-5.902-5.996c-1.631-2.013-2.98-3.958-4.127-5.708c-1.144-1.753-2.078-3.317-2.821-4.619      C581.818,713.685,581.08,712.14,581.08,712.14z"/>
                            <g>
                              <path fill="#400808" d="M623.56,667.106c-3.022,2.825-8.852,4.024-12.868,4.004c5.521-3.827,10.395-8.879,13.241-15.094       c2.31,6.389,7.125,11.536,12.196,15.951C631.844,671.479,626.666,670.253,623.56,667.106z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#400808" d="M578.526,707.5c0,0,2.008,4.772,6.296,12.732c2.138,3.98,4.878,8.738,8.24,14.055      c3.383,5.3,7.391,11.166,12.188,17.229c4.783,6.068,10.353,12.348,16.833,18.351c6.5,5.96,13.918,11.693,22.399,16.157      c8.422,4.539,17.966,7.652,27.898,8.595c4.963,0.515,10.013,0.311,15.005-0.306c1.244-0.196,2.506-0.281,3.737-0.567      l3.711-0.764c1.229-0.294,2.441-0.663,3.663-0.989c0.608-0.174,1.223-0.323,1.825-0.517l1.796-0.623      c4.824-1.553,9.423-3.748,13.921-6.044c4.431-2.445,8.766-5.039,12.826-7.987c8.188-5.793,15.617-12.379,22.384-19.163      c3.418-3.361,6.565-6.883,9.687-10.285c2.987-3.53,5.995-6.903,8.699-10.387c1.367-1.728,2.755-3.397,4.05-5.103      c1.288-1.711,2.556-3.396,3.803-5.053c0.624-0.828,1.242-1.649,1.854-2.464c0.591-0.831,1.176-1.655,1.755-2.472      c1.159-1.633,2.296-3.235,3.409-4.805c4.382-6.331,8.279-12.221,11.601-17.53c0.839-1.32,1.651-2.599,2.436-3.833      c0.757-1.253,1.486-2.46,2.187-3.62c1.401-2.319,2.688-4.45,3.852-6.374c4.495-7.794,7.064-12.247,7.064-12.247l5.891,3.389      c0,0-2.688,4.445-7.392,12.226c-1.216,1.922-2.562,4.05-4.026,6.366c-0.732,1.158-1.495,2.363-2.286,3.613      c-0.819,1.232-1.668,2.51-2.545,3.829c-3.47,5.301-7.539,11.185-12.11,17.509c-1.162,1.568-2.349,3.169-3.558,4.801      c-0.604,0.815-1.215,1.639-1.83,2.469c-0.639,0.813-1.284,1.635-1.934,2.463c-1.301,1.655-2.623,3.34-3.966,5.049      c-1.35,1.704-2.797,3.376-4.223,5.102c-2.817,3.478-5.954,6.857-9.066,10.382c-3.253,3.406-6.531,6.924-10.095,10.289      c-7.054,6.785-14.799,13.377-23.35,19.166c-4.237,2.944-8.771,5.538-13.404,7.969c-4.709,2.286-9.52,4.458-14.577,5.975      l-1.879,0.608c-0.632,0.188-1.276,0.333-1.914,0.501c-1.28,0.315-2.549,0.671-3.836,0.95l-3.887,0.717      c-1.288,0.271-2.61,0.337-3.911,0.513c-5.223,0.538-10.494,0.637-15.649-0.003c-10.32-1.192-20.113-4.631-28.641-9.455      c-8.593-4.752-16.002-10.735-22.455-16.898c-6.431-6.207-11.908-12.648-16.593-18.85c-4.698-6.195-8.598-12.163-11.88-17.548      c-3.261-5.398-5.907-10.22-7.966-14.249C580.434,712.312,578.526,707.5,578.526,707.5z"/>
                            <g>
                              <path fill="#400808" d="M813.911,676.086c-4.001,1.054-9.702-0.655-13.228-2.578c6.677-0.751,13.362-2.887,18.816-7.008       c-0.996,6.72,0.801,13.535,3.172,19.827C819.132,683.864,815.154,680.33,813.911,676.086z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#400808" d="M578.526,707.5c0,0,0.895,2.135,2.842,6.008c1.936,3.878,4.94,9.485,9.138,16.4      c4.225,6.896,9.65,15.097,16.517,24.023c6.865,8.919,15.146,18.59,25.051,28.268c4.959,4.826,10.266,9.717,16.051,14.428      c5.771,4.72,11.89,9.425,18.489,13.81c13.125,8.863,27.9,16.852,43.974,23.145c8.04,3.121,16.357,5.956,24.962,8.143      l3.219,0.862c1.079,0.271,2.172,0.495,3.259,0.745c2.178,0.485,4.361,0.973,6.551,1.46c4.422,0.763,8.833,1.711,13.33,2.246      c8.949,1.378,18.068,1.979,27.212,2.379c2.289,0.032,4.581,0.064,6.874,0.098c1.146,0.01,2.293,0.048,3.44,0.034l3.443-0.092      l6.888-0.182l6.881-0.443c18.344-1.272,36.562-4.239,54.146-8.564c17.596-4.292,34.598-9.777,50.689-16.006      c16.097-6.225,31.337-13.051,45.535-20.04c14.13-7.13,27.338-14.183,39.229-21.226c2.981-1.744,5.901-3.452,8.755-5.121      c2.813-1.738,5.561-3.438,8.239-5.093c2.678-1.658,5.286-3.272,7.822-4.843c2.501-1.626,4.931-3.206,7.284-4.736      c2.352-1.535,4.627-3.021,6.823-4.454c1.099-0.718,2.177-1.421,3.234-2.112c1.043-0.715,2.065-1.416,3.067-2.104      c4.007-2.751,7.688-5.277,11.012-7.559c3.346-2.251,6.237-4.4,8.787-6.22c2.543-1.829,4.706-3.386,6.459-4.647      c3.508-2.522,5.378-3.868,5.378-3.868l4.048,5.567c0,0-1.899,1.334-5.46,3.833c-1.78,1.25-3.976,2.791-6.558,4.604      c-2.588,1.802-5.522,3.93-8.919,6.158c-3.374,2.259-7.11,4.76-11.178,7.482c-1.018,0.681-2.055,1.375-3.112,2.083      c-1.074,0.684-2.169,1.38-3.284,2.09c-2.229,1.419-4.539,2.889-6.925,4.407c-2.39,1.514-4.854,3.076-7.394,4.685      c-2.573,1.553-5.222,3.149-7.938,4.789c-2.719,1.637-5.507,3.315-8.361,5.034c-2.896,1.649-5.859,3.337-8.886,5.06      c-12.066,6.957-25.47,13.918-39.805,20.941c-14.406,6.886-29.868,13.597-46.195,19.692c-16.321,6.1-33.565,11.444-51.405,15.576      c-17.827,4.165-36.294,6.954-54.87,8.025l-6.968,0.368l-6.974,0.103l-3.484,0.052c-1.16,0-2.321-0.052-3.481-0.074      c-2.32-0.061-4.639-0.12-6.955-0.181c-9.25-0.511-18.467-1.229-27.507-2.727c-4.541-0.596-8.995-1.605-13.456-2.429      c-2.208-0.52-4.41-1.037-6.607-1.553c-1.097-0.267-2.197-0.506-3.285-0.792l-3.245-0.909      c-8.671-2.313-17.042-5.274-25.123-8.521c-16.155-6.542-30.956-14.772-44.064-23.849c-6.593-4.491-12.693-9.297-18.44-14.109      c-5.76-4.803-11.035-9.778-15.958-14.683c-9.833-9.832-18.024-19.628-24.8-28.647c-6.777-9.026-12.116-17.303-16.265-24.254      c-4.121-6.972-7.062-12.618-8.953-16.52C579.396,709.645,578.526,707.5,578.526,707.5z"/>
                            <g>
                              <path fill="#400808" d="M1084.185,735.636c-4.086-0.651-8.612-4.517-11.062-7.698c6.411,2.008,13.391,2.752,20.044,1.184       c-3.624,5.746-4.731,12.707-5.103,19.42C1085.821,744.859,1083.608,740.02,1084.185,735.636z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#400808" d="M578.526,707.5c0,0,0.662,1.529,2.047,4.328c1.396,2.792,3.494,6.865,6.433,11.896      c2.926,5.037,6.676,11.042,11.356,17.665c2.349,3.305,4.903,6.783,7.745,10.332c2.817,3.567,5.897,7.225,9.253,10.909      c3.331,3.708,6.97,7.415,10.871,11.103c3.882,3.708,8.105,7.316,12.584,10.837c4.465,3.542,9.281,6.882,14.353,10.037      c5.06,3.179,10.448,6.065,16.088,8.633c2.796,1.339,5.719,2.447,8.632,3.63c2.973,1.027,5.938,2.141,9.011,2.985      c3.034,0.972,6.169,1.647,9.292,2.413c3.16,0.604,6.322,1.279,9.547,1.665c3.203,0.53,6.461,0.709,9.709,1.029      c3.266,0.09,6.534,0.347,9.817,0.225c6.564,0.021,13.137-0.646,19.659-1.531c13.033-1.975,25.797-5.561,37.901-10.257      c12.115-4.693,23.575-10.479,34.255-16.754c10.686-6.277,20.599-13.039,29.773-19.754c2.257-1.73,4.482-3.438,6.676-5.119      c1.095-0.842,2.181-1.678,3.259-2.507c1.055-0.86,2.101-1.713,3.138-2.56c2.073-1.691,4.112-3.354,6.113-4.987      c1.98-1.659,3.88-3.341,5.764-4.958c1.872-1.632,3.731-3.198,5.502-4.785c1.755-1.604,3.47-3.17,5.142-4.697      c1.67-1.529,3.296-3.02,4.878-4.468c1.546-1.488,3.047-2.934,4.502-4.333c5.873-5.543,10.761-10.621,14.852-14.731      c4.061-4.141,7.134-7.513,9.285-9.755c2.133-2.26,3.271-3.465,3.271-3.465l4.989,4.681c0,0-1.169,1.198-3.359,3.445      c-2.209,2.23-5.363,5.58-9.531,9.697c-4.2,4.088-9.215,9.133-15.243,14.643c-1.493,1.391-3.033,2.826-4.62,4.305      c-1.622,1.439-3.292,2.92-5.005,4.439c-1.716,1.518-3.475,3.073-5.275,4.666c-1.816,1.576-3.725,3.134-5.646,4.754      c-1.933,1.606-3.881,3.275-5.912,4.922c-2.053,1.621-4.145,3.272-6.272,4.952c-1.063,0.84-2.137,1.687-3.218,2.54      c-1.105,0.822-2.221,1.652-3.344,2.488c-2.249,1.667-4.532,3.36-6.847,5.076c-9.412,6.661-19.581,13.36-30.542,19.566      c-10.955,6.202-22.713,11.904-35.143,16.491c-12.419,4.592-25.516,8.049-38.871,9.852c-6.685,0.799-13.413,1.371-20.128,1.243      c-3.356,0.069-6.698-0.243-10.031-0.392c-3.317-0.378-6.64-0.617-9.904-1.21c-3.285-0.447-6.505-1.187-9.718-1.856      c-3.175-0.83-6.357-1.573-9.434-2.611c-3.115-0.912-6.118-2.093-9.123-3.188c-2.945-1.249-5.896-2.424-8.716-3.828      c-5.684-2.7-11.1-5.715-16.169-9.015c-5.083-3.275-9.894-6.729-14.343-10.375c-4.463-3.626-8.661-7.331-12.51-11.127      c-3.868-3.775-7.467-7.563-10.755-11.343c-3.313-3.757-6.347-7.479-9.117-11.104c-2.794-3.608-5.3-7.138-7.602-10.488      c-4.585-6.715-8.245-12.789-11.093-17.88c-2.861-5.084-4.895-9.193-6.246-12.009C579.163,709.04,578.526,707.5,578.526,707.5z"/>
                            <g>
                              <path fill="#400808" d="M920.926,703.658c-4.135,0.142-9.315-2.789-12.327-5.444c6.677,0.747,13.67,0.146,19.901-2.665       c-2.46,6.332-2.219,13.376-1.301,20.037C924.293,712.4,921.198,708.071,920.926,703.658z"/>
                            </g>
                          </g>
                        </g>
                        
                      <g>
                        <path fill="#400808" d="M581.08,699.625c0,0,5.817-17.55,15.826-43.421c5.007-12.932,11.066-27.941,18.009-43.839    c6.946-15.895,14.773-32.682,23.398-49.094c4.315-8.203,8.826-16.313,13.56-24.139c4.735-7.824,9.671-15.379,14.89-22.414    c5.213-7.033,10.692-13.568,16.587-19.201c5.882-5.611,12.25-10.378,19.222-13.163c3.469-1.385,7.105-2.214,10.653-2.305    c3.55-0.128,6.955,0.537,9.929,1.616c2.978,1.1,5.514,2.619,7.662,4.194c2.143,1.589,3.941,3.226,5.42,4.799    c2.994,3.13,4.928,5.866,6.206,7.732c0.657,0.928,1.096,1.67,1.422,2.155c0.316,0.491,0.479,0.744,0.479,0.744l-5.787,3.516    c0,0-0.145-0.235-0.425-0.691c-0.288-0.449-0.678-1.149-1.255-2.002c-1.123-1.728-2.827-4.244-5.366-7.019    c-2.524-2.754-5.949-5.831-10.536-7.682c-2.294-0.885-4.861-1.459-7.638-1.423c-2.771,0.005-5.733,0.586-8.721,1.699    c-5.998,2.224-12.023,6.425-17.719,11.632c-5.716,5.215-11.19,11.432-16.446,18.195c-5.264,6.766-10.303,14.103-15.163,21.733    c-4.86,7.633-9.521,15.578-13.996,23.632c-8.945,16.113-17.132,32.668-24.423,48.364c-7.29,15.699-13.683,30.549-18.98,43.352    C587.299,682.211,581.08,699.625,581.08,699.625z"/>
                        <g>
                          <path fill="#400808" d="M740.842,504.1c1.163-3.972,5.57-7.972,9.036-9.999c-2.803,6.106-4.425,12.936-3.711,19.733     c-5.241-4.322-12.006-6.302-18.618-7.519C731.486,504.555,736.567,502.972,740.842,504.1z"/>
                        </g>
                      </g>
                      <g>
                        <path fill="#400808" d="M579.008,704.642c0,0-0.53,1.271-1.458,3.494c-0.951,2.245-2.332,5.444-4.051,9.258    c-3.438,7.627-8.241,17.711-13.644,27.526c-5.386,9.82-11.439,19.347-16.999,25.956c-2.76,3.313-5.397,5.89-7.451,7.56    c-1.021,0.838-1.888,1.454-2.493,1.862c-0.605,0.408-0.947,0.612-0.947,0.612l-3.12-5.444c0,0,0.268-0.134,0.767-0.422    c0.498-0.287,1.229-0.729,2.141-1.375c1.825-1.279,4.356-3.407,7.16-6.326c2.81-2.91,5.891-6.582,8.996-10.7    c3.109-4.116,6.245-8.676,9.251-13.331c6.018-9.312,11.503-19.003,15.459-26.353c1.979-3.675,3.58-6.766,4.686-8.938    c0.549-1.088,0.98-1.942,1.274-2.525C578.862,704.931,579.041,704.558,579.008,704.642z"/>
                        <g>
                          <path fill="#400808" d="M531.42,777.549c3.465,2.261,6.021,7.636,6.96,11.54c-5.035-4.448-11.104-7.974-17.819-9.255     c5.652-3.769,9.502-9.673,12.578-15.651C533.687,768.46,533.734,773.781,531.42,777.549z"/>
                        </g>
                      </g>                       
                      <text transform="matrix(1 0 0 1 463 785)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Tanger</text>
                      <text transform="matrix(1 0 0 1 515 803)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Tetuán</text>
                      <text transform="matrix(1 0 0 1 723 530)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Flandes</text>
                      <text transform="matrix(1 0 0 1 491 691)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Portugal</text>
                   
                      <text transform="matrix(1 0 0 1 610 652)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Navarra</text>
                    
                      <text transform="matrix(1 0 0 1 789 662)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Venecia</text>
                    
                      <text transform="matrix(1 0 0 1 933 699)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Grecia</text>
                    
                      <text transform="matrix(1 0 0 1 1083 723)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Estambul</text>                        
                      </g>


                      <g id="expportugal" display="none">
                        <image overflow="visible" width="341" height="237" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083A7.png" transform="matrix(1 0 0 1 207 654)">
                        </image>  
                        <path display="inline" fill="#FFFFFF" d="M476.6,763.6 237,763.6 237,841.5 502.1,842.2 502.1,762.1 492.6,762.1     502.1,690.2   "/>  
                          <text transform="matrix(1 0 0 1 245.9592 790.6475)" display="inline" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1496, Reino de Portugal</text>
                          <text transform="matrix(1 0 0 1 518.5002 830.6475)" display="inline" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Marruecos</text>
                          <text transform="matrix(1 0 0 1 674.5002 471.6475)" display="inline" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Inglaterra</text>
                          <text transform="matrix(1 0 0 1 700.5002 510.6475)" display="inline" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Holanda</text>
                          <text transform="matrix(1 0 0 1 205.5002 710.6475)" display="inline" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Brasil</text>
                        <text transform="matrix(1 0 0 1 245.9592 808.6475)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">Ordenada por el rey Manuel I de Portugal, </text>
                        <text transform="matrix(1 0 0 1 245.9592 826.6475)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">bajo presión de los Reyes Católicos.</text>
                            <path fill="#480008" d="M520.5,690.2c0,0-1.184,6.834-2.432,17.147c-1.259,10.308-2.571,24.105-2.914,37.898      c-0.097,3.447-0.109,6.892-0.08,10.277c0.038,1.691,0.075,3.369,0.112,5.026c0.078,1.652,0.155,3.285,0.231,4.892      c0.203,3.204,0.46,6.292,0.809,9.196c0.347,2.904,0.766,5.629,1.247,8.11c0.47,2.486,1.036,4.714,1.563,6.671      c0.3,0.961,0.581,1.86,0.841,2.691c0.257,0.832,0.58,1.549,0.823,2.221c0.475,1.354,0.997,2.317,1.307,3.001      c0.319,0.678,0.489,1.039,0.489,1.039l-5.711,2.779c0,0-0.176-0.433-0.506-1.244c-0.318-0.813-0.854-1.991-1.302-3.53      c-0.231-0.767-0.544-1.608-0.776-2.537c-0.232-0.928-0.483-1.932-0.752-3.004c-0.452-2.15-0.919-4.575-1.264-7.224      c-0.357-2.646-0.63-5.514-0.817-8.54c-0.188-3.026-0.27-6.211-0.29-9.499c0.017-1.642,0.033-3.311,0.05-5      c0.059-1.686,0.119-3.392,0.179-5.11c0.166-3.435,0.379-6.916,0.676-10.388c1.144-13.892,3.253-27.632,5.103-37.874      C518.927,696.954,520.5,690.2,520.5,690.2z"/>
                            <path fill="#480008" d="M519.122,798.578c0.71-4.601,5.033-9.713,8.6-12.486c-2.224,7.224-3.023,15.08-1.222,22.556       c-6.484-4.045-14.321-5.253-21.875-5.633C508.755,800.47,514.187,797.953,519.122,798.578z"/>
                        <g display="inline">
                          <g>
                            <path fill="#480008" d="M522.5,678.5c0,0,5.387,1.386,14.929,3.263c9.541,1.865,23.245,4.223,39.813,5.964      c16.557,1.716,36.011,2.831,56.76,1.714c10.361-0.609,21.045-1.733,31.714-3.812c5.341-1.012,10.653-2.33,15.932-3.817      c5.243-1.6,10.472-3.326,15.512-5.499c5.029-2.177,9.988-4.539,14.615-7.405l1.753-1.042l1.691-1.131      c1.117-0.765,2.272-1.476,3.355-2.281c1.076-0.813,2.15-1.626,3.224-2.437c1.096-0.783,2.059-1.723,3.092-2.572      c2.086-1.682,3.91-3.628,5.827-5.451c0.886-0.982,1.769-1.962,2.65-2.938c0.434-0.493,0.891-0.967,1.306-1.474l1.21-1.546      c3.335-4.031,6.003-8.476,8.465-12.899c4.687-9.009,7.636-18.482,9.288-27.663c1.662-9.193,2.073-18.082,1.958-26.264      c-0.069-2.048-0.137-4.053-0.202-6.012c-0.109-1.959-0.304-3.871-0.444-5.734c-0.23-3.731-0.796-7.25-1.189-10.563      c-0.959-6.611-2.002-12.351-3.052-17.042c-0.928-4.713-1.946-8.362-2.549-10.866c-0.624-2.499-0.958-3.832-0.958-3.832      l6.571-1.697c0,0,0.314,1.369,0.905,3.938c0.568,2.573,1.533,6.313,2.395,11.163c0.981,4.821,1.941,10.73,2.796,17.544      c0.342,3.42,0.85,7.039,1.018,10.901c0.109,1.927,0.27,3.898,0.345,5.925c0.029,2.028,0.06,4.104,0.09,6.225      c-0.041,8.478-0.641,17.709-2.563,27.294c-1.912,9.57-5.2,19.487-10.327,28.89c-2.681,4.622-5.591,9.247-9.18,13.427      l-1.305,1.601c-0.447,0.524-0.935,1.015-1.401,1.523c-0.945,1.008-1.893,2.019-2.843,3.031c-2.044,1.879-4,3.876-6.21,5.595      c-1.096,0.868-2.124,1.827-3.279,2.622c-1.134,0.824-2.27,1.648-3.407,2.475c-1.143,0.815-2.354,1.533-3.53,2.305l-1.778,1.139      l-1.835,1.045c-4.851,2.875-10.004,5.212-15.21,7.348c-5.217,2.13-10.593,3.793-15.969,5.32      c-5.406,1.414-10.832,2.649-16.266,3.571c-10.857,1.9-21.665,2.828-32.115,3.242c-20.922,0.727-40.416-0.77-56.978-2.806      c-16.571-2.062-30.241-4.683-39.751-6.73C527.859,679.988,522.5,678.5,522.5,678.5z"/>
                            <g>
                              <path fill="#480008" d="M750.784,527.543c-2.31,4.042-8.177,7.268-12.499,8.581c4.662-5.949,8.221-12.999,9.215-20.624       c4.606,6.099,11.491,10.031,18.409,13.09C761.142,529.488,755.169,529.894,750.784,527.543z"/>
                            </g>
                          </g>
                        </g>
                        <g display="inline">
                          <g>
                            <path fill="#480008" d="M518.5,662.5c0,0,0.1-4.053,0.748-11.118c0.651-7.062,1.848-17.139,4.089-29.106      c2.238-11.962,5.521-25.823,10.349-40.295c2.395-7.24,5.222-14.61,8.44-21.959c3.208-7.354,6.91-14.639,11.01-21.707      c4.09-7.075,8.687-13.871,13.647-20.238c4.961-6.366,10.31-12.294,15.947-17.566c5.624-5.285,11.492-9.951,17.368-13.932      c5.874-3.986,11.749-7.283,17.336-9.985c5.6-2.687,10.931-4.704,15.696-6.367c2.412-0.732,4.649-1.506,6.76-2.063      c2.113-0.545,4.038-1.128,5.808-1.506c1.768-0.396,3.347-0.749,4.72-1.056c1.383-0.255,2.56-0.471,3.514-0.646      c1.91-0.346,2.929-0.529,2.929-0.529l0.979,6.638c0,0-0.979,0.151-2.814,0.436c-0.918,0.144-2.05,0.321-3.38,0.53      c-1.321,0.26-2.84,0.559-4.541,0.894c-1.706,0.316-3.555,0.829-5.592,1.296c-2.035,0.48-4.187,1.166-6.517,1.806      c-4.595,1.474-9.748,3.27-15.176,5.703c-5.417,2.45-11.134,5.465-16.882,9.152c-5.75,3.682-11.526,8.033-17.104,13.01      c-5.591,4.962-10.939,10.588-15.941,16.675c-5,6.089-9.678,12.627-13.877,19.476c-4.208,6.842-8.046,13.929-11.403,21.112      c-3.368,7.179-6.358,14.406-8.919,21.525c-5.161,14.231-8.789,27.942-11.327,39.804c-2.542,11.868-3.997,21.896-4.83,28.931      C518.705,658.45,518.5,662.5,518.5,662.5z"/>
                            <g>
                              <path fill="#480008" d="M656.101,467.945c-3.65-2.889-5.962-9.172-6.613-13.643c5.185,5.5,11.622,10.073,19.013,12.197       c-6.719,3.642-11.639,9.86-15.698,16.243C652.628,477.895,653.121,471.929,656.101,467.945z"/>
                            </g>
                          </g>
                        </g>
                        <g display="inline">
                          <g>
                            <path fill="#480008" d="M516.5,670.524c0,0-14.305,8.552-36.761,19.54c-11.222,5.498-24.483,11.586-38.96,17.5      c-14.477,5.906-30.182,11.62-46.223,16.341c-16.041,4.697-32.42,8.441-48.072,10.374c-15.634,1.977-30.532,2.144-43.203,0.469      c-6.333-0.819-12.096-2.076-17.115-3.554c-2.523-0.689-4.825-1.557-6.966-2.312c-2.106-0.858-4.063-1.596-5.76-2.438      c-0.857-0.401-1.668-0.781-2.432-1.139c-0.745-0.398-1.442-0.772-2.091-1.12c-0.649-0.349-1.25-0.671-1.8-0.967      c-0.543-0.308-1.021-0.617-1.457-0.879c-1.736-1.064-2.663-1.633-2.663-1.633l3.743-5.577c0,0,0.835,0.54,2.401,1.554      c0.394,0.25,0.823,0.547,1.315,0.842c0.5,0.284,1.044,0.594,1.634,0.929c0.589,0.336,1.222,0.697,1.898,1.082      c0.697,0.348,1.438,0.717,2.221,1.106c1.546,0.822,3.35,1.547,5.287,2.398c1.979,0.751,4.104,1.619,6.459,2.325      c4.675,1.505,10.096,2.836,16.126,3.771c12.058,1.907,26.516,2.132,41.889,0.579c15.386-1.505,31.663-4.788,47.679-9.044      c16.02-4.278,31.786-9.566,46.353-15.086c14.567-5.525,27.95-11.265,39.288-16.47C501.981,678.714,516.5,670.524,516.5,670.524z      "/>
                            <g>
                              <path fill="#480008" d="M265.947,718.592c0.602,4.616-2.124,10.731-4.775,14.39c0.12-7.557-1.304-15.324-5.119-22.001       c7.355,2.076,15.218,1.05,22.578-0.693C275.375,713.884,270.86,717.815,265.947,718.592z"/>
                            </g>
                          </g>
                        </g>
                      </g>
                      <g id="expfrancia" display="none">
                        <image overflow="visible" width="374" height="188" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083AD.png" transform="matrix(1 0 0 1 682.0332 435.6514)">
                        </image>
                        <polygon fill="#FFFFFF" points="712,465.8 712,566.8 729.8,566.8 729.8,587.4 740,565.8 1012.4,565.1 1012.4,465.8   "/>
                        <text transform="matrix(1 0 0 1 722.8154 485.0703)" font-family="'ITCOfficinaRTVESerifBold'" fill="#400808" font-size="18">1182. Reino de Francia</text>
                        <text transform="matrix(1 0 0 1 722.8154 503.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">Expulsión y confiscación de los</text>
                        <text transform="matrix(1 0 0 1 722.8154 521.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">bienes ordenadas por el rey de</text>
                        <text transform="matrix(1 0 0 1 722.8154 539.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">Francia, Felipe Augusto.</text>
                        <g>
                            <g>
                              <path fill="#400808" d="M689.835,645.905c0,0-10.502-0.604-26.23-0.058c-7.86,0.281-17.022,0.851-26.766,2.004      c-9.733,1.174-20.072,2.881-30.106,5.609c-5.011,1.367-9.959,2.941-14.649,4.874c-4.684,1.933-9.169,4.116-13.144,6.721      c-3.981,2.584-7.52,5.495-10.27,8.715c-2.779,3.192-4.826,6.621-6.061,10.015c-1.267,3.383-1.808,6.677-1.97,9.615      c-0.019,0.738-0.037,1.452-0.055,2.142c0.014,0.691,0.063,1.36,0.088,2.001c0.015,0.32,0.03,0.634,0.044,0.941      c0.037,0.308,0.073,0.608,0.108,0.902c0.07,0.588,0.136,1.147,0.199,1.68c0.345,2.123,0.672,3.785,0.989,4.908      c0.283,1.126,0.433,1.727,0.433,1.727l-6.393,1.67c0,0-0.143-0.679-0.412-1.951c-0.297-1.262-0.602-3.157-0.893-5.582      c-0.048-0.611-0.1-1.256-0.153-1.931c-0.026-0.338-0.052-0.684-0.08-1.036c-0.003-0.356-0.007-0.721-0.011-1.092      c-0.002-0.743-0.024-1.515-0.007-2.317c0.052-0.804,0.105-1.636,0.161-2.496c0.323-3.432,1.12-7.315,2.777-11.254      c1.621-3.951,4.185-7.862,7.473-11.348c3.264-3.521,7.282-6.55,11.659-9.15c4.375-2.624,9.17-4.723,14.111-6.538      c4.947-1.813,10.087-3.226,15.257-4.421c10.348-2.379,20.853-3.688,30.7-4.484c9.854-0.774,19.068-0.983,26.955-0.955      C679.369,644.889,689.835,645.905,689.835,645.905z"/>
                              <g>
                                <path fill="#400808" d="M558.992,707.438c1.864-3.694,6.923-6.829,10.699-8.194c-3.864,5.496-6.697,11.919-7.228,18.733       c-4.37-5.2-10.664-8.374-16.946-10.771C549.708,706.189,554.992,705.555,558.992,707.438z"/>
                              </g>
                            </g>
                          </g>
                          <g>
                            <g>
                              <path fill="#400808" d="M702.234,647.273c0,0,11.086,0.907,27.742,1.177c8.325,0.131,18.042,0.099,28.427-0.335      c10.382-0.435,21.441-1.271,32.369-2.844c10.913-1.565,21.743-3.876,31.251-7.484c4.733-1.818,9.116-3.99,12.806-6.561      c1.824-1.306,3.489-2.687,4.902-4.167c1.374-1.502,2.61-3.023,3.454-4.646c1.84-3.18,2.409-6.512,2.398-9.47      c-0.003-0.742-0.004-1.46-0.116-2.162c-0.096-0.698-0.11-1.371-0.279-2.018c-0.133-0.646-0.261-1.267-0.383-1.859      c-0.175-0.588-0.341-1.149-0.499-1.682c-0.275-1.07-0.701-1.999-0.996-2.816c-0.287-0.821-0.626-1.499-0.882-2.052      c-0.513-1.105-0.786-1.694-0.786-1.694l5.976-2.867c0,0,0.287,0.682,0.825,1.959c0.267,0.64,0.614,1.417,0.922,2.391      c0.313,0.968,0.747,2.041,1.041,3.339c0.162,0.641,0.333,1.314,0.512,2.021c0.123,0.728,0.252,1.489,0.386,2.283      c0.164,0.784,0.174,1.646,0.254,2.518c0.096,0.871,0.073,1.792,0.041,2.743c-0.112,3.771-1.079,8.207-3.585,12.188      c-1.174,2.033-2.763,3.86-4.486,5.595c-1.758,1.708-3.742,3.227-5.854,4.62c-4.258,2.734-9.059,4.869-14.11,6.6      c-10.135,3.414-21.26,5.332-32.38,6.512c-11.129,1.179-22.287,1.603-32.73,1.65c-10.445,0.047-20.181-0.283-28.512-0.726      C713.276,648.594,702.234,647.273,702.234,647.273z"/>
                              <g>
                                <path fill="#400808" d="M845.09,598.255c-1.112,3.985-5.468,8.042-8.908,10.112c2.726-6.141,4.26-12.99,3.459-19.778       c5.296,4.255,12.085,6.148,18.713,7.28C854.44,597.68,849.379,599.327,845.09,598.255z"/>
                              </g>
                            </g>
                          </g>
                          <g>
                            <g>
                              <path fill="#400808" d="M696.234,654.5c0,0,1.927,2.643,5.428,7.166c3.502,4.522,8.576,10.929,14.89,18.424      c6.315,7.492,13.866,16.081,22.349,24.893c8.482,8.803,17.897,17.857,28.026,25.971c5.056,4.061,10.306,7.864,15.708,11.157      c5.384,3.313,10.973,6.062,16.563,7.838c2.799,0.871,5.6,1.427,8.322,1.675c2.729,0.258,5.361,0.011,7.796-0.557      c0.599-0.18,1.225-0.26,1.788-0.507c0.572-0.219,1.141-0.436,1.705-0.651c1.064-0.568,2.156-1.042,3.094-1.761      c1-0.608,1.852-1.412,2.719-2.149c0.443-0.355,0.796-0.824,1.193-1.221c0.375-0.425,0.794-0.792,1.126-1.248      c2.819-3.479,4.739-7.296,6.15-10.802c1.366-3.539,2.327-6.744,2.987-9.43c0.318-1.348,0.603-2.551,0.851-3.597      c0.2-1.063,0.371-1.967,0.51-2.699c0.277-1.464,0.426-2.245,0.426-2.245l6.57,1.212c0,0-0.182,0.82-0.523,2.357      c-0.172,0.769-0.383,1.716-0.631,2.829c-0.299,1.107-0.643,2.38-1.027,3.806c-0.799,2.844-1.94,6.273-3.571,10.117      c-1.687,3.816-3.963,8.076-7.461,12.121c-0.413,0.52-0.936,0.973-1.407,1.467c-0.499,0.473-0.942,1.002-1.504,1.436      c-1.098,0.89-2.186,1.826-3.469,2.568c-1.207,0.844-2.604,1.434-3.976,2.085c-0.719,0.25-1.443,0.501-2.174,0.755      c-0.723,0.275-1.497,0.372-2.252,0.563c-3.044,0.615-6.245,0.777-9.387,0.384c-3.141-0.384-6.257-1.121-9.281-2.169      c-6.035-2.133-11.795-5.226-17.256-8.827c-5.48-3.586-10.714-7.645-15.719-11.933c-10.023-8.571-19.203-17.988-27.443-27.104      c-8.238-9.123-15.528-17.971-21.611-25.675c-6.082-7.707-10.953-14.277-14.311-18.912      C698.074,657.202,696.234,654.5,696.234,654.5z"/>
                              <g>
                                <path fill="#400808" d="M840.928,716.466c-3.338,2.443-9.27,2.938-13.254,2.437c5.939-3.14,11.382-7.573,14.951-13.402       c1.529,6.618,5.693,12.306,10.201,17.295C848.631,721.797,843.636,719.961,840.928,716.466z"/>
                              </g>
                            </g>
                          </g>
                          
                            <text transform="matrix(1 0 0 1 781.0237 585.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Imperio Germano</text>
                          
                            <text transform="matrix(1 0 0 1 769.4299 697.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Estados Pontificios</text>
                          
                            <text transform="matrix(1 0 0 1 533.4299 733.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">España</text>
                                                             
                      </g>
                      <g id="expfrancia2" display="none">
                        <path fill="#400808" d="M675.1,588.1c0,0-0.1-0.3-0.2-0.9c-0.1-0.6-0.2-1.5-0.2-2.6c0-0.6,0.1-1.2,0.2-1.9      c0.1-0.7,0.4-1.4,1-2.1c0.6-0.7,1.6-1.1,2.5-1c0.2,0,0.5,0,0.7,0c0.2,0.1,0.5,0.1,0.7,0.2c0.5,0.1,0.9,0.3,1.4,0.5      c1.9,0.8,3.7,1.9,5.5,3.3c0.9,0.7,1.8,1.4,2.7,2.2c0.9,0.8,1.8,1.6,2.7,2.4s1.8,1.7,2.7,2.6c0.9,0.9,1.8,1.8,2.7,2.7      c1.8,1.8,3.6,3.7,5.3,5.6c1.8,1.9,3.5,3.8,5.2,5.8c1.7,1.9,3.3,3.8,4.9,5.7c1.6,1.8,3.1,3.7,4.5,5.4c1.4,1.7,2.7,3.4,4,4.9      c2.5,3,4.4,5.6,5.8,7.3c1.4,1.8,2.2,2.8,2.2,2.8l-6.4,4.5c0,0-0.7-1.1-1.9-3c-1.2-1.9-2.9-4.6-5.1-7.8c-1.1-1.6-2.2-3.4-3.4-5.2      s-2.5-3.8-3.9-5.7c-1.4-2-2.8-4-4.3-6s-3-4.1-4.5-6.1c-1.5-2.1-3.1-4-4.7-6c-0.8-1-1.6-1.9-2.4-2.9c-0.8-0.9-1.6-1.8-2.4-2.7      c-0.8-0.9-1.6-1.7-2.4-2.6c-0.8-0.8-1.6-1.6-2.4-2.3c-1.6-1.5-3.2-2.7-4.8-3.6c-0.4-0.2-0.8-0.4-1.2-0.5      c-0.2-0.1-0.4-0.1-0.6-0.2c-0.2,0-0.4-0.1-0.6-0.1c-0.8-0.1-1.5,0.1-2,0.6c-1,1-1.3,2.5-1.4,3.5c-0.1,1.1-0.1,2-0.1,2.6      C675,587.8,675.1,588.1,675.1,588.1z"/>
                        <path fill="#400808" d="M725.5,631.9c0.9-5.2,6-11,10.1-14.1c-2.7,8.2-3.8,17.2-1.9,25.7c-7.3-4.8-16.2-6.3-24.9-6.9       C713.6,633.8,719.9,631,725.5,631.9z"/>
                        <path fill="#400808" d="M674.9,599.5c0,0-1.9,8.6-5.6,21.2c-3.6,12.7-8.9,29.4-15.6,45.7c-1.6,4.1-3.4,8.1-5.2,12.1      c-0.9,2-1.8,3.9-2.8,5.9c-1,1.9-1.9,3.8-2.9,5.7c-1.9,3.7-3.9,7.2-5.9,10.5c-2,3.3-4,6.3-6,9.1c-1,1.3-2,2.7-3,3.9      c-1,1.2-1.9,2.3-2.9,3.4c-1,1-1.9,2-2.7,2.9c-0.8,0.9-1.7,1.6-2.5,2.3c-1.5,1.4-2.8,2.4-3.7,3.1c-0.9,0.7-1.4,1-1.4,1l-4.6-6.9      c0,0,0.4-0.3,1.2-0.8c0.8-0.5,1.9-1.2,3.3-2.4c0.7-0.6,1.5-1.2,2.3-1.9c0.8-0.8,1.7-1.6,2.6-2.4c0.9-0.9,1.8-1.9,2.8-3      c1-1,1.9-2.2,3-3.4c2-2.5,4.1-5.2,6.2-8.3c2.1-3,4.2-6.3,6.3-9.8c1-1.8,2.1-3.5,3.1-5.3c1-1.8,2-3.7,3-5.6c2-3.8,4-7.7,5.8-11.6      c7.5-15.7,13.8-32.1,18.1-44.5C672.4,607.9,674.9,599.5,674.9,599.5z"/>
                        <path fill="#400808" d="M600.8,727.7c6-6.3,9.2-14.8,11.4-23.2c1.9,5.3,3.5,11.9,1.6,17.3c5,1.9,9.7,7.9,12,12.5"/>  
                        <text transform="matrix(1 0 0 1 693.0264 657.249)" enable-background="new" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Provenza</text>
                        <text transform="matrix(1 0 0 1 540.4766 732.0537)" enable-background="new" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">España</text>
                        <image overflow="visible" width="374" height="188" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083AD.png" transform="matrix(1 0 0 1 682.0332 435.6514)">
                        </image>
                        <polygon fill="#FFFFFF" points="712,465.8 712,566.8 729.8,566.8 729.8,587.4 740,565.8 1012.4,565.1 1012.4,465.8   "/>
                        <text transform="matrix(1 0 0 1 722.8154 485.0703)" font-family="'ITCOfficinaRTVESerifBold'" fill="#400808" font-size="18">1306,1321-2,1394. Reino de Francia</text>
                        <text transform="matrix(1 0 0 1 722.8154 503.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">En 1306, Felipe IV, expulsa y confisca los</text>
                        <text transform="matrix(1 0 0 1 722.8154 521.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">bienes de, aprox., 100.000 judios que fueron a </text>
                        <text transform="matrix(1 0 0 1 722.8154 539.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">España y a provincias cercanas como Provenza.</text>
                        <text transform="matrix(1 0 0 1 722.8154 557.0703)" font-family="'ITCOfficinaRTVESerif'" font-size="15">En 1321-2 y 1394 siguieron las expulsiones.</text>
                      </g>                      
                      <g id="expsicilia" display="none">
                        <image overflow="visible" width="378" height="244" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083AE.png" transform="matrix(1 0 0 1 828 598)">
                        </image>
                        <polygon fill="#FFFFFF" points="1159.8,624.6 1160,705.6 918.7,705.6 864.7,805.4 905.2,705.6 891.7,705.6 891.7,624.6   "/>
                        <text transform="matrix(1 0 0 1 901.1133 644.8604)" fill="#400808" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1493. Reino de Sicilia</text>
                        <text transform="matrix(1 0 0 1 901.1133 662.8604)" font-family="'ITCOfficinaRTVESerif'" font-size="15">La expulsión de los judios (aprox. 37.000)</text>
                        <text transform="matrix(1 0 0 1 901.1133 680.8604)" font-family="'ITCOfficinaRTVESerif'" font-size="15">del Reino de Sicilia fue ordenada por</text>
                        <text transform="matrix(1 0 0 1 901.1133 698.8604)" font-family="'ITCOfficinaRTVESerif'" font-size="15">Fernando II de Aragón.</text>
                        <g>
                          <g>
                            <path fill="#480008" d="M858.788,809.246c0,0,3.852,3.029,10.967,7.796c7.11,4.76,17.492,11.27,30.553,17.934      c6.54,3.305,13.73,6.683,21.528,9.767c7.792,3.093,16.17,5.954,25.02,8.177c2.201,0.597,4.457,1.044,6.711,1.565      c2.274,0.425,4.552,0.924,6.87,1.257c4.619,0.781,9.336,1.271,14.092,1.546c9.511,0.541,19.229-0.089,28.613-2.179      c4.694-1.044,9.265-2.537,13.71-4.267c2.172-0.986,4.395-1.849,6.475-2.995c1.047-0.558,2.126-1.049,3.14-1.656      c1.016-0.604,2.03-1.206,3.042-1.808c8.028-4.932,14.984-11.207,20.919-17.93c5.932-6.749,10.791-14.027,14.813-21.245      c1.065-1.769,1.943-3.617,2.871-5.398c0.459-0.895,0.913-1.782,1.364-2.662c0.432-0.891,0.825-1.793,1.234-2.677      c0.796-1.779,1.634-3.501,2.357-5.238c0.709-1.744,1.404-3.455,2.085-5.132c0.711-1.663,1.273-3.349,1.869-4.977      c0.585-1.631,1.157-3.224,1.715-4.777c0.992-3.154,1.976-6.13,2.823-8.952c0.793-2.84,1.536-5.498,2.223-7.955      c0.608-2.48,1.168-4.759,1.673-6.816c0.251-1.029,0.488-2.003,0.712-2.92c0.195-0.924,0.379-1.79,0.549-2.596      c0.34-1.611,0.628-2.982,0.862-4.095c0.468-2.223,0.718-3.407,0.718-3.407l6.644,1.37c0,0-0.28,1.204-0.807,3.461      c-0.263,1.128-0.588,2.52-0.969,4.156c-0.192,0.817-0.398,1.696-0.618,2.634c-0.248,0.931-0.512,1.921-0.791,2.967      c-0.562,2.09-1.183,4.404-1.859,6.924c-0.757,2.498-1.575,5.201-2.45,8.088c-0.931,2.872-2.005,5.903-3.091,9.109      c-0.607,1.583-1.23,3.207-1.868,4.869c-0.647,1.658-1.262,3.372-2.03,5.07c-0.738,1.71-1.492,3.454-2.26,5.232      c-0.783,1.771-1.687,3.533-2.547,5.348c-0.441,0.902-0.868,1.821-1.333,2.731c-0.485,0.899-0.975,1.808-1.469,2.722      c-0.998,1.821-1.946,3.704-3.09,5.518c-4.324,7.378-9.535,14.834-15.878,21.743c-6.344,6.884-13.772,13.298-22.292,18.28      c-1.072,0.606-2.147,1.214-3.225,1.822c-1.074,0.611-2.215,1.104-3.321,1.663c-2.202,1.147-4.543,2.005-6.833,2.98      c-4.678,1.707-9.468,3.154-14.359,4.131c-9.78,1.958-19.793,2.379-29.502,1.616c-4.855-0.386-9.65-0.991-14.328-1.886      c-2.35-0.391-4.65-0.946-6.947-1.428c-2.274-0.578-4.55-1.081-6.766-1.733c-8.907-2.443-17.292-5.514-25.067-8.796      c-7.782-3.275-14.932-6.825-21.423-10.283c-12.961-6.972-23.213-13.715-30.227-18.633      C862.573,812.358,858.788,809.246,858.788,809.246z"/>
                            <g>
                              <path fill="#480008" d="M1091.386,739.393c-3.43,2.315-9.375,2.582-13.337,1.93c6.055-2.911,11.662-7.133,15.451-12.822       c1.276,6.672,5.22,12.514,9.534,17.671C1098.88,745.014,1093.958,742.989,1091.386,739.393z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#480008" d="M849.645,801.304c0,0-4.44-3.261-11.546-7.397c-3.555-2.058-7.777-4.331-12.442-6.404      c-4.659-2.06-9.786-3.952-15.01-4.92c-2.605-0.479-5.229-0.704-7.721-0.521c-1.24,0.106-2.446,0.293-3.579,0.61      c-1.128,0.329-2.182,0.766-3.142,1.302c-0.941,0.565-1.789,1.22-2.534,1.953c-0.713,0.769-1.381,1.549-1.89,2.438      c-1.069,1.729-1.757,3.618-2.213,5.431c-0.443,1.821-0.732,3.545-0.852,5.113c-0.146,1.558-0.196,2.938-0.196,4.081      c-0.025,1.137,0.02,2.042,0.037,2.656c0.019,0.614,0.028,0.941,0.028,0.941l-6.286,0.073c0,0,0.015-0.359,0.042-1.032      c0.029-0.673,0.052-1.656,0.169-2.919c0.092-1.257,0.255-2.791,0.55-4.55c0.265-1.757,0.735-3.746,1.425-5.882      c0.707-2.129,1.717-4.429,3.295-6.615c0.757-1.107,1.736-2.129,2.79-3.091c1.092-0.934,2.322-1.746,3.646-2.407      c1.338-0.629,2.755-1.093,4.199-1.4c1.448-0.294,2.916-0.41,4.374-0.429c2.92-0.002,5.784,0.468,8.537,1.179      c5.51,1.44,10.609,3.77,15.202,6.201c4.59,2.447,8.673,5.04,12.094,7.36C845.454,797.737,849.645,801.304,849.645,801.304z"/>
                            <g>
                              <path fill="#480008" d="M785.468,805.495c2.747-3.095,8.439-4.83,12.44-5.184c-5.143,4.324-9.524,9.808-11.781,16.26       c-2.894-6.146-8.166-10.824-13.626-14.748C776.813,801.912,782.083,802.65,785.468,805.495z"/>
                            </g>
                          </g>
                        </g>
                        <text transform="matrix(1 0 0 1 1063.5002 724.5)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Estambul</text>
                        <text transform="matrix(1 0 0 1 763.5002 830.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Túnez</text>
                      </g>                      
                      <g id="expinglaterra" display="none">
                        <image overflow="visible" width="369" height="260" xlink:href="/serie-isabel/conquista-de-granada/img/expulsion-judios/FD3083AF.png" transform="matrix(1 0 0 1 331 363)">
                        </image>
                        <polygon display="inline" fill="#FFFFFF" points="361,472.9 361.3,580.1 629.9,580.1 629.9,472.9 600.6,472.9 663.9,399.4    577.4,472.9  "/>
                        <text transform="matrix(1 0 0 1 374.6294 514.0205)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">Ordenada por Eduardo I de Inglaterra, </text>
                        <text transform="matrix(1 0 0 1 374.6294 532.0205)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">la expulsión de los judíos de Inglaterra</text>
                        <text transform="matrix(1 0 0 1 374.6294 550.0205)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">fue la primera gran expulsión de la </text>
                        <text transform="matrix(1 0 0 1 374.6294 568.0205)" display="inline" font-family="'ITCOfficinaRTVESerif'" font-size="15">Edad Media.</text>                           
                        <text transform="matrix(1 0 0 1 373.1309 495.8564)" display="inline" fill="#330000" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">1290, Reino de Inglaterra</text>
                        <g>
                          <g>
                            <path fill="#480008" d="M687.5,427.5c0,0,1.576-1.037,4.48-2.611c2.904-1.566,7.133-3.698,12.477-5.651      c2.669-0.98,5.623-1.895,8.821-2.615c3.197-0.709,6.65-1.219,10.276-1.24c3.615-0.028,7.426,0.469,11.088,1.811      c3.646,1.351,7.101,3.585,9.809,6.524c2.766,2.899,4.773,6.396,6.304,9.947c1.524,3.568,2.498,7.243,3.211,10.813      c0.701,3.577,1.074,7.064,1.323,10.369c0.114,1.653,0.203,3.262,0.231,4.815c0.066,1.557,0.048,3.055,0.051,4.496      c-0.021,2.879-0.112,5.515-0.252,7.843c-0.101,2.335-0.31,4.353-0.425,6.024c-0.329,3.328-0.518,5.229-0.518,5.229l-6.082-0.833      c0,0,0.276-1.838,0.761-5.054c0.193-1.611,0.498-3.566,0.709-5.814c0.25-2.247,0.468-4.785,0.629-7.555      c0.067-1.384,0.16-2.829,0.172-4.319c0.049-1.494,0.041-3.033,0.014-4.615c-0.077-3.16-0.263-6.492-0.75-9.884      c-0.499-3.383-1.233-6.85-2.462-10.178c-1.232-3.313-2.882-6.546-5.201-9.236c-2.27-2.73-5.207-4.855-8.444-6.252      c-3.25-1.383-6.769-2.042-10.205-2.189c-3.443-0.157-6.811,0.161-9.963,0.695c-3.154,0.543-6.107,1.293-8.79,2.126      c-5.375,1.659-9.692,3.565-12.663,4.977C689.128,426.545,687.5,427.5,687.5,427.5z"/>
                            <g>
                              <path fill="#480008" d="M748.5,499.5c-1.621-8.325-4.988-18.877-9.258-25.776l12.359,6.913l13.918-2.593       C759.267,483.214,752.698,492.132,748.5,499.5z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#480008" d="M682.5,457.92c0,0,0.817,7.975,3.19,19.727c0.593,2.937,1.28,6.108,2.079,9.444      c0.799,3.335,1.688,6.84,2.713,10.434c1.004,3.6,2.152,7.285,3.38,11.004c1.269,3.706,2.596,7.454,4.093,11.132l1.112,2.759      l1.185,2.72c0.765,1.82,1.628,3.585,2.456,5.348c0.811,1.771,1.751,3.458,2.603,5.16c0.888,1.685,1.839,3.305,2.732,4.921      c0.965,1.569,1.914,3.112,2.843,4.623c0.999,1.462,1.95,2.907,2.918,4.282c1.009,1.341,1.991,2.645,2.94,3.905      c1.008,1.208,1.982,2.374,2.917,3.494c0.992,1.063,1.942,2.08,2.847,3.048c0.89,0.981,1.854,1.781,2.693,2.604      c0.427,0.402,0.84,0.791,1.239,1.167c0.407,0.365,0.826,0.686,1.215,1.01c0.781,0.641,1.499,1.229,2.147,1.762      c1.32,1.028,2.429,1.732,3.147,2.262c0.729,0.515,1.118,0.789,1.118,0.789l-3.488,5.103c0,0-0.414-0.321-1.19-0.924      c-0.764-0.617-1.94-1.455-3.325-2.646c-0.678-0.611-1.427-1.288-2.242-2.025c-0.403-0.372-0.84-0.743-1.261-1.158      c-0.411-0.425-0.836-0.865-1.276-1.32c-0.859-0.925-1.852-1.842-2.751-2.932c-0.912-1.076-1.871-2.208-2.871-3.39      c-0.931-1.23-1.899-2.512-2.901-3.838c-0.951-1.359-1.896-2.788-2.885-4.242c-0.941-1.483-1.859-3.035-2.821-4.604      c-0.886-1.609-1.791-3.253-2.712-4.926c-0.841-1.709-1.738-3.426-2.566-5.198c-0.791-1.789-1.669-3.565-2.41-5.415      c-0.76-1.841-1.553-3.685-2.242-5.575l-1.071-2.826l-0.995-2.856c-1.338-3.806-2.499-7.665-3.599-11.47      c-1.06-3.817-2.037-7.587-2.872-11.26c-0.855-3.667-1.58-7.233-2.221-10.621c-0.64-3.388-1.176-6.602-1.628-9.574      C682.931,465.922,682.5,457.92,682.5,457.92z"/>
                            <g>
                              <path fill="#480008" d="M747.5,579.5c-8.424-0.983-19.5-0.98-27.37,0.992l10.34-9.676l1.757-14.049       C735.253,564.296,741.755,573.262,747.5,579.5z"/>
                            </g>
                          </g>
                        </g>
                        <g>
                          <g>
                            <path fill="#480008" d="M661.5,468.92c0,0,2.6,7.868,6.1,19.801c0.86,2.987,1.822,6.216,2.769,9.65      c0.973,3.428,1.969,7.051,2.965,10.81c1.029,3.75,2.001,7.649,3.02,11.604c1.014,3.957,1.951,8,2.939,12.032      c0.916,4.05,1.852,8.096,2.718,12.093c0.815,4.008,1.688,7.94,2.405,11.772c0.694,3.838,1.449,7.533,2.017,11.067      c0.562,3.535,1.133,6.873,1.589,9.967c0.41,3.104,0.786,5.95,1.12,8.473c0.362,2.519,0.493,4.745,0.696,6.564      c0.353,3.649,0.555,5.734,0.555,5.734l-6.199,0.331c0,0-0.102-2.045-0.28-5.625c-0.115-1.79-0.14-3.967-0.38-6.461      c-0.212-2.495-0.451-5.312-0.712-8.383c-0.307-3.07-0.716-6.392-1.106-9.911c-0.397-3.519-0.973-7.213-1.483-11.047      c-0.532-3.831-1.216-7.773-1.838-11.791c-0.674-4.01-1.415-8.075-2.138-12.146c-0.795-4.056-1.54-8.124-2.364-12.111      c-0.83-3.985-1.616-7.916-2.467-11.701c-0.816-3.792-1.641-7.451-2.45-10.915c-0.783-3.471-1.592-6.735-2.311-9.757      C663.729,476.902,661.5,468.92,661.5,468.92z"/>
                            <g>
                              <path fill="#480008" d="M687.5,615.5c-3.104-7.894-8.326-17.66-13.775-23.671l13.406,4.559l13.219-5.072       C695.137,597.532,690.294,607.493,687.5,615.5z"/>
                            </g>
                          </g>
                        </g>
                        <text transform="matrix(1 0 0 1 753.0579 587.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Metz</text>
                        <text transform="matrix(1 0 0 1 661.5002 631.8457)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Francia</text>
                        <text transform="matrix(1 0 0 1 724.5002 518.7109)" fill="#222" font-family="'ITCOfficinaRTVESerifBold'" font-size="18">Paises Bajos</text>
                      </g>
                    </g>
                    <g id="fronteras">
                      <path data-border="bordsicilia" id="sicilia"  fill="none" stroke="#A27A40" stroke-width="0" d="M881,792.4c-1.6,0.6-1.4,2.5-2.7,4c-3.4,3.8-3.5,4.9-5.2,9.3c-0.3,0.8-1.5,1.2-1.8,1.9c-0.2,0.5-0.2,3,0.1,3.4  c0.4,0.8,1.9,0.1,2.4,1.2c0.1,0.2,0.5,0.6,0.2,0.7c-0.3,0.1-0.5-0.4-0.8-0.4c-0.8-0.1-0.4,0.7,0.1,2.8c0,0,1.1,0.4,1.1,0.4  c1.6,2.8-1.6,0.2,0.2,1c1.1,0.5-2.6,2.1-2.9,2.6c-1,1.3-0.4,5.6-1.5,5.4c-1.1-0.2-2.2-1.8-3.5-1.9c-0.6,0-0.8,0.6-1.4,0.6  c-0.5,0-4.4-1.6-4.6-2c-1.4-1.9-1.8-4.5-3.8-6.1c-2.1-1.7-4-0.3-6.1-1.1c-0.1,0-3.4-1.9-3.5-2c-0.6-0.5-0.8-1.8-1.5-2.2  c-0.2-0.1-0.5,0-0.7-0.1c-0.2,0-0.5,0-0.7-0.1c-1.4-0.5-3.2-2.6-4.1-3.8c-0.4-0.4-5-2.8-5.7-2.9c-0.9-0.1-1.8-0.2-2.7-0.1  c-0.3,0-0.6,0.1-0.8,0.1c-0.7-1.8-0.6-1.9-2-2.3c-0.7-0.2-0.6-1.4-0.7-1.8c0-0.1-0.7-1.4-0.7-1.4c1.9-0.9,0.5-3,1.8-4.3  c1-1,2.6-1.2,3.7-1.7c1.1-0.6-0.5-1,0.4-1.3c0.8-0.3,0.8,3.3,2.4,3.7c2.7,0.6,2.6-2.8,3.6-3.1c1.2-0.4,0.9,0.8,2.2,0.2  c0.1,0,1.2-0.9,1.4-0.6c0.4,0.7,0.5,2.1,0.9,2.5c0.7,0.7,2-0.9,2.5,0.2c2.2,5.1,4.4,1.4,7.9,1.6c0.6,0,0.9,0.8,1.8,0.8  c2.4,0.2,6.4,0.5,8.7-0.8c0.4-0.2,1-1.6,1.5-1.6c1.6-0.2,3.4,0.1,4.9,0.7l0.8,0.7c2.8-0.1,1.9-3.9,2.9-1.9c0.6,1.3,4.7-1.5,5.7-1.1  C881.8,792.2,881.9,791.9,881,792.4"/>
                      <path data-border="bordportugal" id="portugal" fill="none" stroke="#A27A40" stroke-width="0"  d="M508,728c1.3-1,2.9-1,3.9-2.6c0.2-0.3,0.1-0.8,0.3-1c1.7-1.1,5.1,1.5,5.9-2.2c0.1-0.3-0.1-0.6-0.3-0.7c0,0-1.9-0.2-1.9-0.2  c-0.7-0.6-0.8-3.9-0.9-4.9c-0.2-0.9-1-1.2-0.6-2c0.1-0.1,2.9-4.5,3-4.6c0.8-0.6,4-0.5,4.5-1.3c0.1-0.3-0.3-0.5-0.3-0.8  c0.2-1,2.3-1.5,2.4-2.8c0.1-1.5-1.9-1.1-2.5-2c-0.2-0.3,0.5-0.6,0.3-1c-0.2-0.5-0.9-0.6-1-1.1c-0.8-2.2,0.8-5.4,0.8-5.5  c-0.1-0.9-2.5-4.8-2-5.5c0.1-0.2,0.5,0.2,0.8,0.3c1.1,0.4,6.9,2.8,7.6,2.7c1.2-0.3,4.2-4.5,4.3-5.8c0.1-1.4-1.3-2.3-1.3-3.4  c-0.1-2.8,4.7-1.3,5.1-3.3c0.1-0.6-1-1.2-0.4-2c0,0,1.1-0.7,1.1-0.7c0.8-1.3,2.2-5.5,2.4-6.8c0.1-0.9-0.8-2-0.6-3  c0.3-1.7,1-0.3,1.9-0.6c1.5-0.5,2.4-2.5,3.8-3.1c0.9-0.4,2.3,0.2,3.4-0.3c1-0.5,4.7-2.7,5.1-3.7c1.2-3-4.1-3.4-4-4.3  c0-0.7,1.8-2.9,1.5-3.5c-0.2-0.3-0.8,0-1-0.3c-0.2-0.4,0.7-0.8,0.5-1.1c-0.6-1.2-1.4-0.4-2.3-1c-0.5-0.3-0.4-1.2-0.9-1.4  c-0.2-0.1-0.2,0.3-0.3,0.4c-0.5,0.8-1.2,0-1.9-0.3c-0.5-0.2-2.9-2.1-3.5-1.8l-0.2,1.4c-0.3,0.3-3.8,0.5-4.2,0.3  c-0.5-0.2-0.4-1.2-0.9-1.4c0,0-1.9,0-1.9,0c-0.3-0.2,1-0.4,0.8-0.8c-0.2-0.6-1-0.7-1.6-0.9c-0.6-0.2-2.5,0.1-2.9-0.3  c-0.2-0.2,0.4-0.5,0.2-0.7c-0.8-1.2-3,1.3-4.2,0.3c-3.2-2.7,3.6-3.3,2.4-5c-1.7-2.3-7.2-2-10.1-0.8l-0.9,0.5  c-0.6,0.5-2.6,2.1-2.8,2.9c-0.5,2.1,1.7,1.4,2.7,1.7c0.2,0.1-0.4,0.1-0.6,0.1c-1.3,0.2-1.6-0.4-1.8,0.9c-0.5,3.5-2,6.8-0.9,10.2  c0.4,1.5-3,4.5-2.9,5.8c0,0.1,1,0.3,0.7,0.7c-0.2,0.3-2,0.5-1.1,1.4c0.4,0.4,2.1,0.1,1.6,0.2c-0.7,0.2-3.5,1-3.9,1.5  c-1.4,1.4-2.2,3.8-3.5,5.4c-0.4,0.5-1.7,1.6-1.8,2.2c-0.3,1.4,2,0.7,1.5,2c-0.2,0.4-0.7-0.8-1.1-0.8c-0.3,0-0.4,0.5-0.6,0.7  c-2.4,2.9-4.8,6.5-7.7,9c-0.4,0.4-2.1,0.9-2.2,1.4c-0.1,0.3,0.4,0.6,0.3,0.8c-0.1,0.3-0.4-0.5-0.6-0.6c-0.5-0.3-1.1,0.4-1.6,0.5  c-0.2,0-0.5-0.1-0.7-0.1c-0.2,0-0.6-0.3-0.7-0.1c-0.1,0.1,0.6,2.1,0,2.9c-0.6,0.9-1.8,1.5-2.4,2.4c-1.3,2.1-2.1,4.9-3.7,6.7  c-0.2,0.2,1.4,3.4,1.6,3.8c0.3,0.7,1.2,2.1,1.2,2.8c0,0.9-2.1,0.6,0.1,0.9c0.3,0,0.6,0.1,0.9,0.1c1.1,0.1,2.9-0.5,3.7-0.3  c0.5,0.1,0.9,1.6,1.5,1.3c0.2-0.1,0.5-0.3,0.5-0.5c0-0.2-0.6,0-0.5-0.2c0.2-0.4,0.8-0.4,1.1-0.7c0.1-0.1,0.1,0.4,0.1,0.6  c-0.1,0.6-0.5,1.2-0.4,1.9c0.2,0.9,1.9,1.3,1.8,1.4c-1.7,1-3.6-2.8-4.9-3.3c-0.3-0.1,0.3,0.5,0.4,0.8c0.3,0.5,0.7,1,0.8,1.5  c0.7,4.2-3.7,6.2-4.3,8.3l0.8,1c0.4,1.2-0.9,2.5-1.1,3.6c-0.2,1,1.2,0.1,1.3,0.5c0,0.1-2.2,1-2.5,2c-0.8,3-2.5,5.6-4.6,8.2  c-0.5,0.6-1.9,1.1-2.1,1.8c-0.1,0.2,0.2,0.3,0.3,0.5c0.6,1,6-0.5,7.6,0.7c0.8,0.6,10,6.6,10,6.6c1.7,0.3,4.3-1.6,6-1.8  c0.3,0,1,0.1,2,0.2C505.1,735.1,504.5,730.6,508,728"/>
                      <path data-border="bordaustria" id="austria"  fill="none" stroke="#A27A40" stroke-width="0"  d="M904,609.5c0.2-0.4-1.1-0.1-1.2-1.1c-0.1-1.5,0.6-1.1,0.9-2c0.1-0.5-0.9-2-0.6-2.4c0.9-1.3,3.5-0.1,3.9-2.6c0.3-2.1-4.2-3-3.6-3.6  c2.4-2.4,2.9-0.1,4.4,0.5c0.3,0.1,4.3-0.3,4.4-0.5c0.1-0.2-0.3-2.5-0.4-2.8c-0.1-0.2-0.6-0.2-0.5-0.4c0.2-0.3,0.7-0.1,0.9-0.3  c0.5-0.5,0.3-2.2,1.2-2.8c-0.6-0.9-0.7-2-1.2-2.7c0,0-1.1-0.4-1.1-0.4c-0.4-0.6-0.1-1.8-0.4-2.4c-0.3-0.7-1.3-1.1-1.5-1.8  c-0.4-1.2,1.5-3.4,1.9-5.3c0,0.1,0,0.1-0.1,0.2l0.1-0.8c0-0.7-0.3-1.2-1-1.7c-0.5-0.3-1.1,0.4-1.6,0.3c-1.1-0.3-1.7-2.3-3.1-2.2  c-2.3,0.2-0.9,1.9-4.8,1.1c-2.8-0.6-6.7-3.5-9.7-4.7c-1.5-0.6-1.9-0.2-3.3-0.3c-0.9-0.1-1.2-0.9-2.3-1.2c-0.2-0.1-0.5-0.3-0.7-0.2  c-1,0.9,0.2,4.3-0.8,5.1c-0.3,0.3-1.7-0.7-2-0.5c-0.9,0.6-0.9,3.7-1.9,4c-0.8,0.3-2.3-1.7-3.1-1.6c-0.6,0.1-0.7,1.1-1.2,1.3  c-0.5,0.1-4.4-0.7-4.8-1c-0.3-0.4,0.5-0.9,0.3-1.4c-0.3-0.7-2.2-1.5-2.8-1.9l-0.2,0c0,1.6-0.5,4.6-1.6,5c-0.9,0.4-2.8-2.6-3.8-1.3  c-1,1.2,0.2,3.2-1.5,4.4c-1.3,0.9-8.7,2.6-8.9,4.1c-0.3,1.7,3.4,4.1,3.2,5.8c-0.1,0.6-2.2,1.6-1.6,2.6c0.1,0.2,4.2,0.3,1.5,4.6  c-0.8,1.2-2.5-0.5-3.2-1.3c-0.7-0.9,1.2-1.9-0.5-2.5c-1-0.4-2.8,0.8-3.8,0.3c0,0-0.8-1.5-0.8-1.5c-0.2-0.2-0.6-0.1-0.8-0.1  c-0.3,0-0.6,0-0.8-0.1c-0.4-0.2-0.3-1.1-0.8-1.1c-1.5-0.1-0.6,2.6-1,2.7c0,0-1.8,0-1.8,0c-1.5,0-2.9-0.1-4.4-0.2  c-0.3,0-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.2-0.9-0.1c-0.6,0.3-0.5,1.3-1.1,1.6l-1.4-0.1c-0.2,0-0.5-0.2-0.7-0.1c-0.4,0.3,0,1-0.4,1.3  c-0.4,0.4-5.6,0.8-6.2,0.4l-0.1-1.4l-1.1-0.8c0.1-0.3,0.8,0,0.7-0.3c-0.5-2.2-5.5-0.1-6.1-1.8c-0.6-1.7-0.1,2.2-0.3,2.7  c-0.8,1.7-4.6,2.7-4.6,2.6c0.1-0.7,1.6-1.6,1-2c-1.3-0.7-0.7,1.3-1.9-0.2c-0.2-0.3,0.3-0.6,0.4-1c0,0-1.5-2.6-1.6-2.6  c-0.6-0.4-1.1,0.5-1.7,0.1c-0.4-0.3,0.1-1.2-0.3-1.4c-0.2-0.1-1.5,1.7-3.2,1l-0.4,0.2c0.3,0.8,1.6,2.4,0.9,3c-3.4,3.3-2,1.4-2.9,5.6  c-0.1,0.4-0.8,0.7-0.6,1c1,1.2,4.4,0.3,5.5,1.4l-0.4,1c0.2,0.6,2,2.2,2.6,2.4c2.3,1.1,3.5-2.6,5-2.2c1.5,0.4,0.4,2.2,0.6,2.7  c0-0.1,0.1-0.2,0.1-0.2l0,0.3c0.9,0.8,1.9,0.1,2.8,0.3c1.6,0.4,0.6,1.1,0.8,1.5c0.1,0.2,3.6,1.2,3.9,1.1c1.1-0.4,1.6-3.2,2.6-3.9  c0.7-0.5,9,0.4,11.2-0.1c0.8-0.2,3.1-1.1,3.7-0.3c0.3,0.4-0.8,0.4-1.1,0.7c-0.1,0.1,0,2,0,2.1c0.3,0.5,1.8,0.7,2,1.2  c0.2,0.5-0.8,1.2-0.4,1.7c0.2,0.2,0.7-0.1,0.9,0.1c0.5,0.3,0.5,1.5,1,1.8c4.2,3.1,12,3.3,18.1,4.7c1.9,0.4,3.6,1,4.9,1.8  c0,0,1.1,1.1,1.1,1.1c1.1,0.4,2.7-0.4,3.8-0.1c0.8,0.3,1,1.5,2.1,1c0.6-0.3,2.9-1.5,3.5-2c0.4-0.4,0.3-1.7,0.8-2  c2.7-1.9,6.4,1.3,9,0.5c0.9-0.2,1.4-1.7,2.3-2c1.3-0.3,3.1,1.3,4.5,1.1c0.9-0.2-0.3-3.2,2.3-3.8l0-0.1  C900.4,612.6,903.3,611.3,904,609.5"/>
                      <path fill="none" stroke="#A27A40" stroke-width="0" data-border="bordinglaterra" id="inglaterra" d="M677.9,500.8c-1,0.3-1.1,1.1-1.7,1.3c-1.1,0.5-4.7-1.4-4.1-2.8c1.1-2.5,4.3-0.1,5.3,0.9C677.5,500.4,677.9,500.8,677.9,500.8 M656.7,386.9c0.9,0.9,1.8,6.3-0.5,5.9C653.2,392.3,654.2,387.7,656.7,386.9 M644.6,365.4c0.3,0,0.6-0.3,0.8-0.1c0,0-2.1,1.7-2.3,1.7C642.2,367.2,641.9,365.4,644.6,365.4 M644.1,347c-0.9,0.1,1.4,1.4,1.4,2.3l-1.2,1c-0.3,0.5-0.3,2-0.6,2.3l-1.2-0.1C641.9,352.1,644.3,347,644.1,347 M645.1,345.2c0.8,0.4,2.4,1.7,0.3,1.9C644.4,347.2,643.7,345.5,645.1,345.2 M663.9,332.2c-0.6,0.7-0.1,1-0.3,1.3c-0.3,0.6-2.9,0.9-3.4,1.7c-0.1,0.2,0,0.5,0,0.7c0,0.2,0.1,0.5,0,0.7c-0.4,0.4-1.9-0.2-2.3,0.3   c-0.4,0.5,1.8,0.3,1.7,0.9c-0.4,2.1-1.4,0.2-2.3,0.3c-0.4,0,0.7,0.6,0.7,0.9c-0.2,1.5-0.5,0.7-1.2,0.6c-0.2,0-0.3,0.3-0.5,0.2   c-0.5-0.4-0.9-0.5-1.1-1.3c-0.1-0.5,1.1-1.4,0.6-1.4c-1.8,0.2-0.1,2.4-0.8,2.9c-0.6,0.4-1.6-1.4-1.3,0.1c0.1,0.5-2.3,2.1-3.2,1.3   c-0.1-0.1-1.1-2.2-1-2.2c0.2-0.3,0.3,0.8,0.7,0.9l1.3-1c0.2,0-0.1-0.4,0.8-0.4c0,0-1.5-1.9-1.4-2.3c0.2-0.9,1.1-0.3,1.6-0.5   c0.2-0.1-0.4,0-0.5-0.2c-0.3-0.5-0.4-1.3-0.2-1.8c0.4-1.2,1-0.3,1.7-0.8c0.1-0.1-1.4-1.1,0.2-1c0.4,0,1.5,2,2.9,2.4   c0.1,0-0.9-2.5,0-2.8c0.9-0.4,2.4,0.3,3.2,0c1-0.3,2.7-1.6,3.6-1.9C664,329.7,663.9,332.2,663.9,332.2 M648.3,342.1c-0.6,1.6,0.8,0.1,0.9,1c0.1,2.2-1.1,0-1.4-0.1c-1.2-0.4,2.1,1.7-0.2,2.4c-1,0.3-3.5-2.2-3.5-2.7   c0.1-2,2.7-0.5,3.4-0.6C647.7,342.1,648.3,342.1,648.3,342.1 M651.5,433.6c1.1,1,0.9,2.6,1.8,3.4c0.4,0.4,1.4,0.1,1.8,0.6c0.5,0.6-2.4,1.3-2.5,1.3c-0.5,0.1-2.2,0.8-2.7,0.7   c-0.2-0.1,0.2-0.3,0.3-0.5C650.4,438.6,646.2,434.6,651.5,433.6 M647.5,379.9c-0.3,1.1-0.1,4-0.6,4.8c0,0-1.5,0.6-1.5,0.6c-0.3,0.1-1.7,0.9-1.9,0.8c-1.7-0.7,0.6-1,0.7-1.5c0,0-0.5-1.6-0.5-1.6   c0-0.1,1.2-0.5,1.3-0.6c0.8-2.2-3.3,1.6-3.5,1c-0.1-0.4,1.5-3.1,1.8-3.3c1.5-1.1,1.3,0.4,1.4,0.8c0.1,0.4,0.5-0.7,0.9-0.8   C646.2,379.8,646.9,379.9,647.5,379.9 M704.3,333.4c-0.7,1.2,0.1,0.2-1.1,0.4c-0.6,0.1-1.1,1-1.8,0.2c-0.4-0.5,0.4-1.3-0.1-1.8c-0.6-0.6-1.9,1-2.8,0.2   c-0.8-0.7,1.1-1.7,0.5-2.3c-0.2-0.2-1.6,2-1.8,0.9c-0.2-1.1,1-3.7,2.5-3.1c1.1,0.4,2.7,2.6,1,2.4c-0.4,0-1,0.3-1,0.7   c0.1,0.7,1.4,0.1,2,0.3c0.5,0.1,0.3,1,0.8,1.3c0.2,0.1,0.7-0.4,0.8-0.1C703.5,332.8,703,332.2,704.3,333.4 M646.7,405.8c-1.6-1.6-3.2,0.7-4.4,0.3c-0.2-0.1-0.1-0.5,0-0.7c0.8-2,3.2,0,3.8-2.3c0.1-0.4,0-1.6-0.8-1.4   c-0.3,0.1-0.5,0.7-0.6,0.5c-0.2-0.3,0.3-0.6,0.3-1c0.1-1.3-1.1-2-1.4-3c0,0,1-4.1,0.4-4.9c-0.4-0.5-1.2,0-1.6-0.2   c-5.2-2.6-0.3-0.9-6.1-1.4c-0.4,0-2.2-1.2-2.4-1.2c-0.7,0.3-3.4,5.5-3.5,1.8c0-0.1,0-0.2,0-0.4l-0.6,0c-3.2-0.3-3.1,3.7-5.6,4.9   c-1.5,0.7-2.4-1-3.2-1.2c-2.2-0.4,0.6,2.5-0.3,3.2c-0.8,0.7-5-0.1-5.5,0.8c-0.4,0.7,3.1,6.5,3.9,7.2c1.2,1.2,5.1,3.6,6.5,1.2   c0.3-0.5-0.6-1.1-0.3-1.6c0.1-0.2,2.7-1.6,2.9-1.5c0.3,0.1,0.3,0.5,0.4,0.7c0.8,1.3,0.1,3.2,0.8,4.4c0.4,0.7,1.8,0.4,1.6,1.6   c0,0-0.8,1.2-0.8,1.2c0,0,0.1,1.1,0.1,1.1c1.9,1.4,3.4-0.7,4.5,0.1l0.3,0.5c1.5,0.6,1.9,2.5,4,1c0.7-0.5,0.6-1.7,1.1-2.1   c1.4-1.3,3.3,1.8,4.5-0.7c0.1-0.2,0-1.4-0.2-1.5c0,0-1.8,0.1-1.8,0.1c-0.2-0.5,1.1-0.5,1.4-1c1-1.4-0.8-2.3,0.6-3   c0.2-0.1,0.3,0.4,0.4,0.7c0.5,0.9-0.8,5.5,0.5,4.3C646.6,411.9,647.8,406.9,646.7,405.8 M722.7,468.5c-0.2-1.1-1.2-1.9-1.9-2.7c-4.6-5.5-8-2.6-10.9-5.3c-0.6-0.5-3,3.5-3,3.5c-0.5-0.5-2.6-3.1-2.7-3.1   c-0.1-0.1-1.4-0.3-1.4-0.4c0.1-0.8,4.6-2.4,5.1-3c1.6-1.5,0.8-6.7-0.3-8.2c-0.5-0.6-4.2-6-4.3-6c-0.9-0.4-2.1,0.2-3-0.1   c-0.8-0.2-0.4-0.9-1.4-0.9c-0.2,0-0.8-0.2-0.7-0.3c0.7-0.6,2.9,0.9,3.6,0.9c0.6,0,1.2-0.4,1.8-0.2c1,0.3,0.9,2.7,2,3   c1.4,0.4,0.4-0.6,1.5,0c0.4,0.2,0.4,1.6,0.8,1.3c1-1-2.5-7.7-2-9.7c0.2-0.8,2.1-0.7,2.1-1.6c0-0.1-2.3-2.7-2.7-3.5   c-0.6-1.2-0.5-3.2-0.8-4.4c-0.4-2.4-5.4-4.6-7.1-5.1c-0.7-0.2,0.8-1.2,0.7-1.9c-0.1-0.5-1.2-1.2-1.2-3.3c0-0.8,0.5-1.9,0.5-2.5   c-0.2-2.2-1.3-4.5-0.8-6.9c0.4-1.9,1.2-4,0.9-6.1c0-0.3-1.3-1.2-1.8-1.6c-1.6-1-1.3-5-2.2-6.2c-1-1.3-3.5-2-4.4-3.4   c-0.2-0.3-0.1-1.2-0.6-1.6c-0.2-0.2-0.6-0.2-0.8-0.2c-1.9-0.6-1.2,1-2.6,1.4c-2,0.5-5.1-2-6.8-2.7c-0.5-0.2-1.7-0.2-1.8-0.9   c-0.1-1.7,2.8,0.9,3.2,1c3.3,0.7,3.2-1.7,6-2.1c1.5-0.2,1.6,1.4,4,0.3c0.1,0,0.1,0,0.2-0.1c1.4-2.2-2.2-1.5-1.7-3   c0.2-0.6,1.1-1.4,0.3-1.7c0,0-0.1,0-0.1,0c-0.1,0-0.2-0.1-0.4-0.1c-0.6-0.1-1.2,0.2-1.8,0.3c-0.2,0-1,0-1.7,0   c-0.2,0.1-0.4,0.2-0.7,0.2c-0.2,0-0.4-0.1-0.6-0.2c-0.2,0-0.4,0-0.3,0c0.1-0.1,0.2,0,0.3,0c0.3,0,0.8,0,1.3,0.1   c0.6-0.3,1.3-0.8,1.9-0.8c0.7,0,1.4,0.3,2.1,0.6c0,0,0.1,0,0.1,0c0.5,0.2,1,0.2,1.4,0.1c1.6-0.5,4-2.2,4.8-3.2   c0.2-0.2,0.2-1.2,0.7-1.6c0.3-0.2,1.3-0.2,1.8-0.5c0.6-0.5,3.8-4.5,4.1-5.1c0.4-0.9,0.4-2,1.2-2.8c1.1-1.2,3.8-2.2,4-3.8   c0.1-0.8-0.1-3.1-0.8-3.7c-0.9-0.8-1.8-0.7-2.9-0.8c-2.3-0.3-5.1-2.1-7.1-2.7c-0.6-0.2-1.4,0.3-2,0.1c-1.2-0.3-2.1-1.6-3.2-2   c-1.2-0.4-3,0-4.2,0.1c-1.7,0.2-6.9,1.3-7.1,1c-0.1-0.2,0.5-0.3,0.6-0.5c0-0.2-0.7-0.4-0.4-0.5c0.8-0.4,3,0.5,3.6-1.3   c0.4-1.2-4.3,0-4.4,0c-0.4,0,0.9-1.2,1.2-1.4c0.3-0.1,1.8,0.2,2.4,0c1.9-0.6,0,1.4,1.1,1c0.8-0.2,3-1.8,3.3-2.5   c0.4-0.8-2,1-2.3,0.4c-0.1-0.2,0.4-0.4,0.4-0.6c0-0.1-0.2-0.1-0.4-0.1c-0.3,0-0.7,0.1-1,0c-0.1,0-1.7-1.1-1.4-1.1   c0.3,0,0.6,0.3,0.9,0.3c0.4,0,0.8,0.2,1.2,0c0,0,0.9-1.5,0.9-1.5c0.6-0.4,1.6-0.6,2.3-1c1.8-1.1,10.4-3.6,10.6-5.2   c0.1-0.7-0.8-0.8-0.5-1.5c0.1-0.3,2.5-2.3,1.9-2.6c-0.7-0.4-2.8-1.2-3.5-1.4c-0.2-0.1-0.6-0.1-0.6,0.2c0,0.4,0.6,1.1,0.3,1.1   c-1.3-0.1-1.9-1.4-3.1-1.3c-0.8,0.1-3.4,1-4-0.2c-0.1-0.2,0.3-0.5,0.2-0.6c-0.3-0.3-0.5,0.8-0.8,0.8c-0.3,0-3.1-0.7-3.3-0.7   c0,0-1.2,0.8-1.2,0.8c-0.3-0.4,0.8-0.9,0.6-1.3c-0.9-1.8-1.9-0.6-2.7-0.1c-0.4,0.2-1.3,1.2-1.1,0.8c0.4-0.7,0.6-0.5,1.2-1.1   c0.6-0.6-2.2-1.8-2.9-3c0,0-0.1,0.2-0.2,0.4c-0.5,0.8-1.4,0.9-1.7,1.5c-0.4,0.7,1.4,1.8,0.9,2c-0.8,0.4-0.2-0.7-1,0   c-0.2,0.2,0.4,0.7,0.2,0.8c-0.4,0-0.6-0.8-1-0.7c-0.9,0.3-0.8,1.8-0.4,2.7c1.1,0.2,2.4,1.9,0.3,0.5c-0.1-0.1-0.2-0.3-0.3-0.5   c0,0-0.1,0-0.1,0c-0.7-0.1-1.6,0.5-2.3,0.3c-0.5-0.2-0.3-0.8-0.9-1c-0.6-0.2,0.9,2.7,0.9,2.7c-0.1,0.2-0.4-0.2-0.5-0.2   c-1.3,0.6,1.7,1.6-1,0.7c-0.1,0-0.5-0.5-0.8-0.6c-0.3-0.1-0.4,0.6-0.3,1c0.2,1.2,1.4,2.2,1.5,3.3c0,0,1,2.2,0.9,2.1   c-1.1-1.3-1.2-2-2.4-2.9c-0.6-0.5-0.1,0.6-0.7,0.5c-0.5-0.1-1.1,2-1.7,0.2c-0.1-0.3,1-1.5-0.4-1.2c-0.9,0.2,0.2,3.2-0.9,2.9   c-0.3-0.1-0.4-4.4-1.9-1.5c-0.3,0.7-0.6,1.3,0.1,2c0.2,0.2,0.9,0.4,0.6,0.6c-0.4,0.2-0.7-0.5-1.1-0.4c-2.4,1,1.2,3.6,1.8,4.1   c0.4,0.3-1.4,0.1-1.7,0.2c-0.4,0-0.8-3.9-2.5-0.5c-0.6,1.2,0,0.1,0.4,1.2c0.1,0.2-0.9,1.2-0.7,1.5c0.6,1,2.1-0.7,2.5-0.2   c0.2,0.2-0.3,0.7-0.1,1c0,0,0,0,0,0c0.1,0,0.2,0,0.4,0c0.4-0.2,1-0.5,1.1-0.5c0,0,0,0.1,0,0.1c-0.3,0.2-0.7,0.3-1.2,0.4   c-0.2,0.1-0.3,0.1-0.4,0c-0.8,0-1.7,0.1-1.9,0.8c0,0,2.5,1.1,3.5,2.2c0.1,0.1-0.3,0.3-0.5,0.2c-1.3-0.4-0.4-1.8-2.2-1.4   c-0.6,0.1,0,0.6-0.3,1c-0.2,0.2-1.1,0.3-0.7,0.8c0.5,0.6,2.2,1.5,1.8,1.6c-1.4,0.4-1.9-2.2-3.5-0.8c-0.3,0.3,0.9,2.4,1.2,2.5   c0.2,0.1,0.4,0,0.6,0c0.2,0,0.8-0.1,0.6,0c-2,0.9-2.2-1.9-3.5-1.2c-0.6,0.3-0.2,1.5-0.8,1.9c-0.3,0.2-0.8-0.2-1,0   c-0.1,0.1,0.5,0.5,2,1.4c0.2,0.1,0.9-0.3,0.8-0.1c-0.1,0.3-0.6,0.4-0.9,0.4c-0.2,0-0.1-0.4-0.3-0.4c-2-1.1-0.5,1.1-0.6,1.2   c-0.2,0.3-7.1-1.8-5.3,0.4c0.7,0.8,1.9,1.2,3.1,1.5c0.8-0.1,1.6-0.2,2-0.1c0.1,0,0.4,0.3,0.6,0.6c0.3,0.1,0.5,0.1,0.7,0.2   c0.2,0.1,0.8,0,0.6,0.2c-0.4,0.6-0.9,0.1-1.3-0.4c-0.7-0.2-1.6-0.3-2.6-0.5c-0.6,0.1-1.1,0.2-1.4,0.2c-0.2,0,0.6,1.9,0.8,2   c1.1,1,1.6,2.7,3.6,1.5c1.5-0.9,2.7-1.5,4.2-2.2c0.7-0.3,1.2-0.9,2-1.3c0.2-0.1,0.7-0.5,0.6-0.3c-0.6,1.4-4,1.2-0.2,2.4   c0.2,0.1-0.4,0.1-0.7,0.1c-0.7,0-1.7-0.7-2.4-0.1c-3,2.7-2,1.5,0.1,2.2c0.3,0.1-0.6,0.3-1,0.4c-0.7,0.2-1.6-0.9-1.9,0.1   c0,0,1.3,0.8,1.6,1.2c0.2,0.2,0.6,0.4,0.5,0.5c-0.3,0.2-1.7-1.1-2.1-1c-0.9,0.1-3.1,2.8-3,3.6c0,0.2,0.5,0.3,0.5,0.5   c-0.1,0.7-1.9,1.8-1.2,1.7c0.6-0.1-2.6,2.6-2.5,3.1c0.1,0.6-0.7,0,0.1,1.1c0,0,1.6-0.5,1.6-0.5c0.2,0.2-0.4,0.3-0.6,0.5   c-2.4,2.1-1.5,2.1,0.6,2.1c0.1,0-2.3,1.2-3,2.1c-0.9,1.3-0.8,3.2-1.9,4.4c-0.5,0.5-2.3,0.9-2,2.2c0.3,1.6,3.2,0.3,3.8-0.2   c0-0.2,0-0.4,0-0.5c0-0.3,0-0.6,0.1-0.9c0.3-0.9,1.9-1.8,2.1-2.5c0.2-0.7-0.1-1.8,0.8-2.6c0.5-0.5,1.4-0.3,1.9-0.8   c0.1-0.1-1.1-4.9,0-5c0.3,0,0.4,0.6,0.6,0.6c0.3,0,3.6-2,4-2.2c1-0.5,0.4-0.9,1.5-0.9c0.2,0,0.9-0.4,0.7-0.2   c-1.5,1.1-8.1,3.5-6.5,6.5c1.1,2,1.6-1,2-1.8c0-0.1,1,1.3,1,1c0.3-1.8-0.4,2,0.8,1.7c0.1,0,2.3-3.3,2.4-3.5   c0.1-0.6-0.1-2.1,0.3-1.7c1.3,1.5-0.2,1.7,0.2,1.9c0.6,0.2,0.3,1.2,0.6,1.7c0.5,0.8,1.4,1.3,1.9,2c0.2,0.3-0.8-0.2-1.1-0.4   c-1.3-0.6-2.3-2.2-3.2-0.1c-0.7,1.6,0.2,2.5-1.3,3.5c-0.4,0.3,0.7,0.8,0.8,1.3c0.5,1.5,1.7,2.4,1.2,4c-0.3,1.1-1.2,0.4-1.9,0.8   c-1.2,0.7-1.6,2.6-2.6,3.5c-0.6,0.5-1.6,0.6-2.2,1.1c-1.1,0.9-1.3,2.1-1.1,3.4c0.1,0.4,0.2,1.3-0.2,1.2c-1.3-0.4,0.7-3-1.3-2.6   c-2.1,0.5,0.7,5.6,0.7,6.3l-0.4,1.3c0,0.2,0.3,0.2,0.4,0.3c1.1,0.8-0.9-4,2.3-4.1c0.8,0,2.7,5,4.1,5.2c1.8,0.3,0-4.1,1.2-4.6   c0,0,0.6,2,1,2.1c0.3,0.1,0.9-0.8,1-0.4c0.1,0.5-0.6,1.4,0.2,2.2c0.9,1,0.9-1.1,1.4-1c0.7,0.2-1.8,1.4,0.6,1.6c0.2,0,2-0.3,2-0.4   c0-0.1-0.6-1.3,0.3-1c0,0,1.5,0.8,2.5,0.8c1.1,0,0.5-1.7,1.1-2.2c0.1-0.1,2.4,0.8,2.9,1.1c1,0.5,2.7,0.3,3.5,0.8   c0.5,0.3-1.1,0.1-1,0.4c0.1,0.2,0.6,0.3,0.5,0.5c-0.2,0.2-0.6,0.2-0.9,0.1c-0.3-0.1-1.8-1.9-2.1-0.6c-0.1,0.3,0.2,1.1-0.1,1   c-0.3-0.1-0.1-0.6-0.4-0.8c-0.8-0.6-2,2-2.1,2.2c-0.8,1-3.7,2.5-3.8,4.2c-0.1,1.3,1.4,2.7,1.6,4c0.1,1-0.7,2.4,0.3,3.3   c0.7,0.6,0.9,0.1,1.3-0.3c0.2-0.2,0.4-0.8,0.5-0.6c0.5,1.8-2.8,2.2-0.4,4.2c0.3,0.2,0.9-2.1,2-2.3c0.3-0.1,0.1,1.6,0.9,1.3   c0.4-0.2,1-1.6,1.7-0.6c0.1,0.1-0.1,0.7-0.3,1.7c-0.1,0.6-1.6,0.8-1.9,1.2c-0.3,0.5,0.7,1.4,0.6,1.6c-0.2,0.3-0.5,0.5-0.8,0.5   c-0.3,0-1.3-0.8-2.1-0.3c-0.5,0.3-1.3,3.1-0.9,3.7c0.4,0.4,1.4-0.1,1.6,0.5c0.1,0.3-0.4,0.4-0.6,0.5c-1.6,0.9-3.1,2.9-2.9,4.9   c0.2,0.2,0.3,0.7,0.4,1.3c0.2,0.4,0.5,0.8,1,1.2c0.2,0.2,1.7,0.3,1.8,0.5c0.4,1.3-2.2,0.2-2.5-0.4c-0.1-0.2-0.2-0.8-0.3-1.4   c-0.2-0.4-0.3-0.8-0.4-1.3c0,0,0-0.1-0.1-0.1c-0.4-0.3-1.1,0.1-1.6,0.2c-1.1,0.3,1.1,3.7,0,3.6c-1.2-0.1-1.2-3.3-2.9-3.4   c-1.3,0-3.5,1.1-4.6,0c0,0-0.9-1.7-1.3-1.5l0.1,1.1c-0.5,0.4-3.2-0.1-3.9-0.1c-1-0.1-2.4,2.1-3,1.9c-0.2-0.1-0.1-0.5-0.3-0.5   c-0.5,0.3-0.3,1.2-0.7,1.6c-1.6,1.6-4.4,0.8-5.7,2.7c-0.6,0.9,0,0.9,1,0.9c1.1,0,0.4,1,1.2,1.1c0.3,0.1,2.3-3.2,5-1.3   c1.3,0.9-2.2,2.9,1.2,4c0,0-2.4,0.9-2.6,2.1c-0.2,1.3,1.9,1.4,1.9,1.7l-1.4,0.3c-1.6,1.2-1.7,3.7-3.9,4.5c-0.7,0.3-1.4,0-2,0.1   c-0.7,0.1-1.3,1.1-1.9,1.2c-0.6,0.1-1.9-1-2.5-0.8c-0.5,0.2-1.8,1.5-2.4,1.8c0,0-2.8-1.1-3.1-1c-0.3,0.1-0.2,0.7-0.5,0.9   c-0.4,0.2-3.5,0.3-3.1,0.8c0.5,0.7,1.9,0.7,2.2,1.5c0.8,2.2-2.6,1.5-2.3,2.1c0.4,0.9,2.1,1.4,1.2,1.1c-0.4-0.1,0.5,0.6,0.6,0.9   c0.2,0.6-0.1,1.2,1.1,1.4c0.3,0.1,2.9,0,3.2-0.1c0.4-0.2,0.4-1,0.8-1.2c0.6-0.2,1.3,0.3,2,0.4c0.3,0.1,0.7,0.4,1,0.2   c0.2-0.1,0.3-0.2,0.5-0.2c0.3,0,0.4-0.1,0.4,0.1c0,0.4-0.4,1.6,0.3,1.9c0.5,0.2,2.9,0.8,2.9,0.9c0.2,0.8-3,0.1-3,0.2   c-0.2,0.1-0.1,0.5-0.2,0.7c-1.2,2.4,5.4,1,5.8,1.1c0.6,0.1,0.3,3.1,0.5,3.4c1.2,1.5,2.9,2.9,5.1,3.3c1.3,0.2,1.7-0.8,2.5-1.4   c2-1.6,3.1,0.4,5.6-0.5c1.3-0.5,2.4-1.7,3.8-2.1l1.1,0c0.2-0.2,0-0.7,0.2-0.7c1.2,0.3-1.1,1-4.1,3.3c-1.6,1.2-3.7,1.4-5.3,2.5   c-0.7,0.5-1,3-1.4,3.2c-3.1,1.3-8-3.1-11.5-3.5c-0.4,0-3.8-0.7-3.9-0.5c-0.9,1.3-0.2,3.1-2.5,3.6c-0.8,0.1-1.5-1.9-2.3-1.4   c-1.3,0.7-1,3.5-1.9,4.5c-0.7,0.7-2.4,0.8-3.2,1.5c0,0-0.8,1.2-0.8,1.2c-1.5,0.5-2.2-0.2-3.4,0.4c-0.7,0.4-0.2,0.7-0.4,1.3   c-0.4,1.3-1.4,0.4-2.1,0.8c-0.3,0.2-0.1,0.7-0.3,1c-2.1,2.1-9.2,0.5-9,3.2c0.2,2.7,2.9-0.5,3.4-0.3c1.5,0.5,2.3,4.7,2.4,4.8   l0.7-0.8c1.6-0.2,1.7-0.2,1.3-1.8c-0.1-0.4,0.8-0.4,1.2-0.7c0.3-0.2,0.3,0.5,0.3,0.5c0.7,0.2,0.8-0.9,1.3-1c0.6-0.1,1.4,0.3,2.1,0   c0.5-0.2,0.7-1.6,1.3-1.8c0.2,0,2.3,0.9,2.8,1c0.9,0.2,2.7-0.2,3.4,0.6c0.2,0.2,0.1,0.8,0.4,0.9c0.7,0.2,1.1,0.3,1.2,0.2   c-0.1-0.3,0.3,0,0,0c0,0,0,0.1,0,0.2c0,0.1,4.6,3.8,5.3,3.8c0,0,0.5-1.5,0.7-1.6c0.4-0.2,2.3-0.3,2.4-1.1c0.1-1.1-1.3,0.1-0.5-1.2   c0.2-0.3,0.8-0.1,1-0.4c0.7-0.9,1.4-2.7,1.4-3.9c0-0.6,0.2,1.6,0.9,1.7c0.7,0.1,1.7-1,2.4-1.1c1-0.1,2.2,0.7,3.3,0.6   c1.9-0.2,3.4,1.3,4.7,3c0.4,0.5,0.9,0.9,1.1,1.5c0.1,0.3-0.5,0.9-0.2,0.8c0.9-0.4-0.1-2.1,1.3-2c1.5,0.2,4,3.2,5.4,2.6   c2.5-1-1.4-1.7-0.5-3c0.1-0.2,0.4,0.1,0.6,0.2c0.2,0.1,0.5,0,0.6,0.2c0.1,0.2-0.1,0.6,0,0.7l1-0.4c0.7,0,0.8,0.2,1.6,0.1   c0.9-0.2,1.6,1,2.5,1c0.3,0,3.7-1,3.7-1.1c0.3-1-1.8-1.8-1.6-2.6c0.1-0.5,0.8,0.6,1.1,1c0.4,0.6,1.3,2.8,2.2,2.7   c1.1,0-0.5-2,1.2-1.1c0.7,0.4-0.1,0.9,0.5,0.5c1-0.6,1.2,0,1.7,0.5c0,0-0.8,4,1.6,1.8c0.1-0.1,0,0.4,0.1,0.4c2,0.5,5.1-0.6,7.2,0.1   c1.7,0.6,3.2,3.1,5,3.4c0.6,0.1,1.5-1.1,2.1-1.2c1.3-0.4,2.8,0.3,4.1,0c0.9-0.2,0.9-1,2-0.9c0,0,1.5,0.6,1.5,0.6   c0.9-0.1,1.1-1.4,2-1.9c1.8-1.1,5,0,5.8-2.5c0.1-0.2,0-0.5,0-0.7c0-0.2,0-0.5,0-0.7c0-0.2-0.1-0.5,0-0.7c0.4-0.7,0.9-0.7,1.2-1.5   c0,0-0.7-0.1-1-0.1c-0.3,0-0.7-0.1-1-0.1c-1.4-0.2-5.8,0.8-6.4-1.1c-0.2-0.6,1.8,0.1,1.7-0.1c-0.9-2.7-2.8,0-3.9-0.8   c-0.3-0.2-0.9-0.6-0.7-0.9c0.2-0.2,2.5,0.5,2.5-0.1c-0.1-1.9-4.3-0.8-4.4-1.1c-0.2-0.5,7-0.7,7.1-1c0.2-0.5-0.5-0.9-0.8-1.4   c-0.2-0.4,1,0.4,1.5,0.4c0.6-0.1,0.8-1.5,0.7-2c-0.4-1.2-2,0.5-2.6-0.3c-0.1-0.1-0.5-0.3-0.3-0.4c2-1.5,4.7,1.5,7.7-0.6   c0.1-0.1,0.3-0.2,0.3-0.3c-0.1-1-1.3,0.4-1.3-0.3c0,0,1.4-1.4,1.4-1.4c0-0.5-0.1-0.5,0.2-0.3c0.2,0.2,0.1,0.8,0.4,0.8   c0.4,0.1,1.8-1.7,2.2-1.9c0.5-0.3,1.1-0.2,1.6-0.3c0.9-0.2,1.2-2.9,1.5-3.5C721.8,474.1,723.7,473.2,722.7,468.5 M630.3,414.3c0,0-0.1-1.1-0.1-1.1c0,0,0.8-1.2,0.8-1.2c0.2-1.3-1.2-0.9-1.6-1.6c-0.7-1.2,0-3.1-0.8-4.4c-0.1-0.2-0.2-0.6-0.4-0.7   c-0.2-0.1-2.8,1.3-2.9,1.5c-0.2,0.5,0.6,1.1,0.3,1.6c-1.4,2.3-5.3-0.1-6.5-1.2c-0.8-0.7-4.3-6.5-3.9-7.2c0.5-0.9,4.6-0.1,5.5-0.8   c0.9-0.8-1.8-3.6,0.3-3.2c0.8,0.1,1.7,1.9,3.2,1.2c2.5-1.1,2.4-5.2,5.6-4.9l0.6,0c0.3-1.9,3-1.2,4.2-2.2c1.1-0.9-0.6,0.3-1.9-1.8   c-0.6-1-0.8-2.5-2.5-2.7c0,0,0.8,2.4,0.8,2.5l-0.8-0.7c0-0.2-1.6-0.6-2.2-0.4c-1.1,0.4,0,3.6-0.7,4.4l-1.4,0.2l-1.3,0.6   c-0.2-0.2,0.2-0.4,0.4-0.6c1.4-1.2,0,0.5,1.7-1.2c0.4-0.4,0.2-4.3,0.1-4.3c0,0-1.2,0.7-1,1.1c0.1,0.3-0.6,2.6-0.8,2.2   c-0.2-0.3,0.4-0.6,0.3-1c-0.1-1.3-0.1-1.9-0.4-2.3c-0.2-0.2-0.4,0.4-0.6,0.5c-0.5,0.1-1,0.9-1.2,1.2c0,0.1-0.1,0.1-0.1,0.1   s0-0.1,0.1-0.1c0,0,0.1-0.1,0-0.2c-0.2-0.4,0.1-1.1-0.5-1.6c-0.3-0.2-0.4,0.6-0.7,0.8c-0.4,0.3-1,0.1-1.5,0.2   c-0.2,0-0.6,0.3-0.6,0.1c0-0.4,0.6-1.2-1.1-1.1c-0.5,0-0.5,1.1-0.7,1.2c-0.6,0.8-1.6,0.4-2.3,1c-0.4,0.3,1,1,0.6,1.3   c-0.3,0.2-1.7-0.5-1.3,0.6c0.2,0.7,1.3,1.6,1,1.8c-0.4,0.3-2.2-1.5-2.8-0.7c-0.3,0.4,1.1,0.9,0.8,1.3c0,0.1-5.3-1.3-4.9,0.9   c0.2,1.2,3.3,2.4,4,2.4c0.2,0,0.5-0.2,0.5,0c0.1,0.5,0.6-0.5,1.1,0c0.5,0.5-0.9,0.7,0.1,0.8c0.7,0.1,2.6-0.1,2,0.4   c-0.5,0.4-2,0.8-2.8,1.7c-0.1,0.1-0.2,0.4-0.4,0.4c-0.9,0.2-1.6-0.6-2.1-0.8c-0.1,0-0.5,0.7-0.7,0.8c-0.5,0.2-2,0.1-2.4,0.6   c-1.2,1.3,2.1,0.3,1.7,1.3c-0.1,0.3-0.6-0.5-0.8-0.3c0,0,0.8,1.4,0.8,1.4c-0.3,0.4-0.6,0.8-1.1,1.1c-0.2,0.1-0.6-0.1-0.8-0.3   c0,0-0.7-1.7-0.7-1.7c-0.4-0.5-1.4-0.2-1.8-0.3c-0.7-0.3-1.2-1.9-2.3-1.6c-0.6,0.2-0.7,1.1-1.2,1.2c-1.3,0.4-1-2.1-1.2-2.5   c-0.6-1.4-0.6-0.1-1.5-0.2c-0.2,0-3.6-2.6-4.4-2.8c-1.9-0.4,0.1,1.2-0.2,1.7l-0.8-0.7c0,0-0.6,0.4-0.7,0.1   c-0.2-1.1-2.5-1.8-2.6-0.7c0,0.2,0.5,0.3,0.4,0.5c0,0.1-1.4,1.4-1.4,2c0,0.2,0.2,0.6,0.5,0.5c0.3-0.1,0.9-2.2,1.6-2.3   c0.4-0.1,0.8,0.6,0.7,1c-0.1,0.6-1.6,1.6-0.9,2.2c0,0,1.7-1.1,1.5-0.5c-0.2,0.5-1.7,0.7-1.5,1.6c0.2,1.2,1.2,1.5,0.6,2.4   c0,0-1.2-2-2.1,0.3c-0.2,0.4,4,0.2,4.5,1c0.3,0.6-1,1-1.1,1c-0.3,0.2,0.6,0.7,0.5,0.9c-0.1,0.9-3.5-1.1-4.4-0.6   c-0.9,0.5-0.3,2.3-0.8,2.6c-0.1,0.1-2.5,0.2-3,0.3c-0.4,0.1-1-0.8-1.2-0.5c-0.1,0.2,1.4,2.2,1,2.6c-0.3,0.3-0.9-0.7-1.5-0.1   c-0.1,0.1-0.5,0.2-0.4,0.4c0.2,0.4,0.1,0.8,2.3,1.6c1,0.4,1.3-1.1,2.3-0.2c1.1,0.9-2.3,0.4-1.9,1.5c0.2,0.5,0.9,0.8,1.4,0.9   c0.2,0,2.2-1.1,2.2-0.6c0.1,0.3,0.7,0.6,0.3,0.9c-0.7,0.5-3.2,1.7-1.3,1.7c0.4,0,0.7,0,0.8,0.3c0.3,1.7,6.6,1.2,7.5,2.1   c0.2,0.2,0,0.9,0,1.1c0,0.3-0.7,1.6-1,1.5c-0.2-0.1-0.1-0.7-0.2-0.8c-0.7-0.8-1.6,1.1-3.6-1c0,0-3,2.5-3.3,2.8   c-0.8,0.6-0.9,0.4,0,0.7c0.3,0.1,1,0.1,0.8,0.3c-0.9,0.7-2.2,2.5-3.1,2.8c-0.1,0-4.7,1.4-4.9,1.4c-0.5,0.1-1.4-0.4-1.6,0.1   c-0.2,0.4,0.8,0.6,1.3,0.6c0.8,0.1,2.8,0.1,3.6-0.2c0.2-0.1,0.2-0.6,0.4-0.6c0.2,0.1-0.1,0.5,0,0.7c0,0,1.3,1.2,1.3,1.2   c0.3,0.1,1,0.8,1.3,0.8c1.6,0.1,4.8-2.3,5.1-2.1c0.5,0.3-0.4,1.6-0.4,1.7c0,0.2,2.8,0.2,2.5,1.3c-0.1,0.3-2.2-0.7-2.7-0.6   c-0.9,0.2-3.4,0.4-4.6,0.1c-0.6-0.1-1-1-1.7-1c-0.3,0-0.4,0.5-0.6,0.5c-0.8,0.1-1.5-1.6-2.4-0.9c-0.2,0.1-0.7,0.9-0.7,1.2   c0,0.2,0.7,0.6,0.5,0.5c-0.7-0.3-4.3-0.4-4.3-0.2c0.9,1.9,2.5,0.4,0,2.2c-0.2,0.1-0.4,0.4-0.2,0.6c0.4,0.7,1.5,0,1.7,1   c0.1,0.3-0.6-0.3-1-0.4c-0.7-0.1-2.2,0-2.3-1.3c0-1.5,0.1,0.1-1.5,0c-0.2,0-0.5,0.1-0.6,0c-0.1-0.3,0.5-0.6,0.4-1   c-0.2-0.6-2.1,0.2-2.2,0.3c-0.2,0-0.4-0.4-0.6-0.2c-0.3,0.2-0.1,0.8-0.4,1c-0.2,0.1-1.7-1-1.7,0.8c0,0.5,0.4,0.5,0.8,0.7   c1.2,0.5,5.6,1.1,5.9,1.2c0.3,0.1,1.8,0.8,1.8,1.1c0,0.6-1.1-0.8-1.6-0.6c0,0-0.9,0.7-1.2,0.6c-0.3-0.1-0.4,0.4-0.7,0.5   c-0.9,0.3-3.9-0.7-4.3,0.5c-0.1,0.2,0.2,0.3,0.3,0.5c0,0.2,0.1,0.5-0.1,0.7c-0.1,0.1-1.7-0.5-1.9-0.4c-0.9,0.7,0.5,0.8,0.5,1   l-0.5,1.3c0.3,0.3,1.6-1.1,2.1-0.6c0.8,0.7-1.6,2.1-0.1,2.6c2,0.6,4.6-0.5,6.8-0.1c0.3,0.1,1-0.1,0.9,0.2c-0.1,0.3-3-0.3-3.4,0.5   c-0.1,0.2,0.5,0.4,0.3,0.5c-1.5,0.5-2.2-1.2-4.4,1.2c-0.3,0.4-1.6-0.8-1.4,0.6c0,0.1,0.2-0.3,0.3-0.2c0.3,0,0.5,0.2,0.8,0.3   c1.1,0.4,1.3-0.1,2.2-0.3c1.2-0.3,2.8,1,4.1,0.8c0.5-0.1,0.6-1.2,1.1-1c0.5,0.2,0.9,0.6,1,1.1c0.2,1-5,0.6-6.1,1.3   c-0.4,0.3-1,0.9-0.3,2.1c0.8,1.4,1.9-1,2.5-0.5c0.2,0.2,0.4,1.3,1.1,0.8c0.2-0.1,0-0.6,0.2-0.6c0.2-0.1,0.9,0.6,1.2,0.5   c0.2-0.1,0-0.6,0.2-0.6c0.8-0.1-0.2,1.8,0.1,2.2c0.4,0.6,1.1-0.2,1.3-0.3c0.6-0.2,0,0.7,0.9,0.7c1.5,0.1,1.3-0.4,1.6-0.5   c0.2-0.1-0.2-0.7,0-0.7c0.8-0.1,1.6,1.4,2.2,1.6c0.1,0.1,0.9-0.6,1.2-0.7c0.8-0.3,1.3,1.3,1.9,1.1c1-0.4,1.3-2.2,2.3,0.1   c0.3,0.6,0-1.8,0.7-1.9c0.2,0,4.4,1.5,3.7-1.7c0-0.2-0.7-0.7-0.9-0.9c-0.2-0.2,0.6-0.1,0.8,0.1c0.4,0.3,2,0.4,2.2,0.6   c0.4,0.6-1.6,0.7-1.7,0.8c-0.5,0.5,2.8,1.2,3,1.1c0.3-0.1,0.2-0.8,0.6-0.9l1.5,0.2c0.7-0.8-0.4-0.2,0.4-1.1   c0.1-0.1,0.2-0.4,0.4-0.4c1,0.1,2.2,1.3,3.7,0.6c1.9-0.9-0.9-1.8,0.5-2c0.2,0,0.3,0.5,0.5,0.5c0.6,0.2,1.2-0.5,1.8-0.5   c1.4,0.2,2.8,1.3,4.1,1.1c0.7-0.1-0.6,1,1.1,0.7c0.9-0.1,1-1.4,1-2.2c0-0.2-0.2-0.8,0-0.7c1.2,0.4,1.3,1.8,1.7,1.7   c0.3-0.1,0.7-0.2,0.9,0c0.3,0.2-0.9,0.5-0.7,0.8c0.1,0.1,4.2,1.8,5.1,2.1c0.1,0,0.2-0.2,0.3-0.3c1.2-1.2-0.2-0.7,0.3-2.1   c0.1-0.2,0.3-0.8,0.5-0.9l0.6-1.2c0.7-0.8,2.1-1.1,2.7-2c1-1.5,1.2-4,2.9-5.2c0.6-0.4,2.2-1.1,2.3-2.1c0.1-1,0.3-1.6,0.5-2.7   c0.2-1,0.3-2.6,0.3-3.5c0-0.6-1.2-1.4-0.8-2.1c0.5-1.1,1.7,0.3,2.1,0.3c0.1,0-0.9-1.5-0.6-2c0.5-0.9,1.2-0.8,1.6-2   c0.1-0.3-1-1.5-1.1-1.8c-0.5-1.7,1.6-3.2,1.1-4.7c-0.2-0.5-1-0.5-1.2-1.5c-0.9-4,4.9,1.4,3.1-1.5c-0.1-0.2,0-0.4,0-0.6l-0.2-0.4   c-0.1-0.1-0.2-0.1-0.3-0.2c0.1,0,0.1,0.1,0.2,0.1l-0.3-0.5C633.7,413.5,632.1,415.7,630.3,414.3"/>
                      <path data-border="bordfrancia" id="francia" fill="none" stroke="#A27A40" stroke-width="0" d="M765.6,617.4c-0.3-0.1-0.7,0.4-1,0.2c-0.4-0.4,0.7-1.1,0.5-1.7c-0.2-0.5-1.2-0.1-1.4-0.6c-0.4-0.9,1.3-1.7,1.3-2.2  c0.1-0.6-1-1.3-0.9-1.9c0.2-1.3,2.1-2.2-1.5-2.7c-6.8-1-5.2,3.4-6.3,4.2c-0.5,0.3-3.8,2.2-4.3,1c-0.1-0.3,0.5-0.3,0.6-0.6  c0.4-2.4,0.9-0.6,2-1.4c0.8-0.6,0.1-5.6,1.5-7.1c1.1-1.2,4.2-1.3,5-2.6c0.5-0.8-0.3-2.7,0.3-3.4c0.7-0.9,3.2-0.5,4.1-1.4  c0.7-0.7,1.4-1.9,2.3-2.8c1.2-1.1,3-1.9,3.5-2.4c0.1-0.2,0.5-0.3,0.4-0.5c-0.1-0.3-0.4-0.4-0.6-0.5c-0.2-0.1-1.5,0.3-1.3-0.6  c0.1-0.3,1.4-1.2,1.4-1.2l-0.1-1.1c3-1.2,2.5,2.8,5.6,2.3c0.9-0.2,2.3-2,3-2.7c-0.2-0.1-0.6-1.9-0.6-2.2c0.2-1.9,2.7-4.4,2.4-6.3  c-0.2-1.2-0.5-1.7,0.2-3.1c0.7-1.2,2-2.2,2.6-3.4c0.8-1.7,0.7-3.8,1.5-5.4c0.6-1.2,7.1-5.8,6.5-6.7c-2-3.1-6.6-1.1-8.6-3.8  c-0.4-0.5,0-1.3-0.4-1.8c-0.9-1-5.2,0.8-6.2,0.1l0.2-1.4c-1.4-2.1-2.9,0.4-3.4-0.2c-1.6-1.8-2-5.8-2.8-6.4c0,0-1.7-0.6-1.7-0.6  c-0.7-0.3-1.8-1.1-2.5-1.1c-0.6-0.1-2.1,0.9-2.6,0.6c-0.6-0.3-1.9-2-3.5-2.4c-0.6-0.1-2.8,0.5-3.2,0.1c-0.5-0.4,0.1-2-0.2-2.5  c0,0-1.5-0.6-1.5-0.6c-0.1-0.6,1.8-0.7,0-1.4c-0.3-0.1-0.6,0.3-0.9,0.2c-0.5-0.2-1.4-2.1-2.8-2.6c0,0-1.6-0.7-1.6-0.7  c-0.2-0.5,0.9-1.8,0.9-2.3c-0.1-1.6-1-1.2-0.1-2.8c0.1-0.1,1.1-1.8,1-1.9c-1.4-1.6-2.9,2-3.4,2.5c-0.6,0.5-7.6,0.8-6.9-1  c0.2-0.4,1.5-1.3,1.5-1.8c0,0-1.1-1.3-1.1-1.3c0-0.8,1.7-1.7,1.6-2.5c-0.1-1-4.6-3.1-5.5-2.9c-0.3,0.1-0.3,0.5-0.6,0.6  c-1.1,0.2,0-3.5-1-4.1c-1-0.6-3.5,0-4-1.5c-0.4-1.3,0.8-4.8-1-5.8c-0.7-0.4-2.5,1.6-3.2,1.4c-3.5-0.9-2.9-6.1-3-8.7  c-3.3,0.9-7.6-1.2-10.8,0.3c-3.6,1.7-3.2,6.2-4.6,9.6c-0.4,1-0.5,0.6,0,1.3c0.1,0.1,0.5,0.4,0.4,0.4c-0.6,0.3-1.6-0.1-1.5,1.4  c0.1,0.9,1.1,1.9,1.3,2.4c0.1,0.3-1.3-1.3-1.9-0.8c-8.1,6.5-10.6,2.6-19.3,5.6c-4,1.4-2.6,6,1.1,5.7c0.2,0,0.6-0.3,0.7-0.1  c0.2,0.4-3.1,0-3.3,0c-1.8,0-3.5,1.6-5.5,1.6c-1.6,0-7.4-3.7-9.5-4.8c-1.8-1-3.2,0.6-3.2,0.6c-0.1,0-1-3.6-1-4.9  c0-0.9,1.2-0.8,1.3-2c0-0.3,0.3-0.6,0.1-0.9c-0.9-1.2-6.6,0.8-8.7-3.1c-0.1-0.2-0.2,0.3-0.2,0.5c0,1,1.3,1.8,0.7,2.9  c-0.2,0.4-0.9,0.4-0.9,0.8c-0.2,1.1,0.2,4.1,1.1,4.6c0.5,0.3,0,1.3,0.4,2.6c0,0.1,0.4,1.9,0.4,1.9c-0.2,0.3-0.7,0.2-0.8,0.5  c-0.1,0.1-0.4,2.2,0.2,1.8c0.3-0.2,0.4,0,0.2,0.1c-0.1,0-1.7,3.4-1.7,3.5c0,0.4,0,2.6,0.5,3.4c0.1,0.1,2.3,1,1.7,1.5  c-0.4,0.3-0.9-0.6-1.4-0.6c-1.1,0-3.3,0.1-4.3-0.3c-1.7-0.7,0.2-3.5-1.6-2.6c-0.1,0.1,0,0.3-0.1,0.3c-0.2,0-0.4-0.2-0.7-0.2  c-1.9,0.2,0.7,3.8-0.9,3.3c-0.1,0,0.3-0.1,0.3-0.3c0.1-0.4-0.2-2.3-0.4-2.6c-0.6-0.8-1.3,0.5-2.6,0.7c-0.5,0.1,0.4-1.3-0.1-1.5  c0,0-1.3,0.4-1.3,0.4c0-0.1,2-1.2,0.7-1.6c-0.2-0.1-0.2,0.5-0.4,0.6c-1.3,0.8-1.3-0.7-2.1-0.2c-0.2,0.1,0.2,0.5,0,0.7  c-0.2,0.2-2.8,0.7-3.1,0.9c-0.2,0.1-0.2,0.7-0.4,0.6c-0.1,0-1.6-5.1-2-6.3c-0.4-1.4-1.2-1.5-2.3-0.3c-0.2,0.2,1.2-1.3,1.1-2.2  c0-0.1-0.1-0.1-0.2-0.1c-0.7-0.1-1.1-0.1-1.6,0.4c-0.1,0.1-0.4,0.6-0.4,0.4c0.8-2.7-0.9-0.3-2.8-0.8c-0.6-0.2,0.6-1.7-1.1-1.1  c-1.2,0.4-0.7,2.5-1.6,2.8c-0.7,0.3-1.9-2-2.8-1.9c-0.6,0.1-1,0.8-1,1.3c0,0.2,0.1,0.5,0,0.5c-1.1,0-0.7-4-2.3-1.8  c-0.1,0.2-0.3-0.4-0.6-0.5c-1.2-0.6-1.9,1.4-3,0.5c-0.7-0.5,1.1-0.7-0.1-1.1c-0.6-0.2-1.2,0.6-1.4,0.6c-0.3,0.1-1.9-0.9-2.1-0.3  c-0.3,1.1-3-0.4-4.4,4c-0.5,1.7,3.4,0.7,4.1,0.9c1.7,0.5-0.4,0.5,0.1,1.1c0.5,0.7,2.8-0.4,2.5,0.4c-0.1,0.3-0.7,0.2-0.9,0.5  c-0.4,0.5,2.1,0.5,1.7,0.9c-0.3,0.2-3.8-0.7-4.3-1c-1.1-0.5,0.4-1.4-0.6-1.3c-0.5,0.1-0.6,0.6-1,0.8c-0.4,0.1,0.5,0.6,0.7,0.9  c0.3,0.5-1.1,1.5-0.5,1.6c0.5,0.2,0.8-1,1.1-1.1c1-0.2,2.4,1.8,2.3,2.5c0,0.2-0.1,0.5-0.2,0.7c-0.3,0.5-4.6-1.7-6.5-0.2  c-0.2,0.2,0.5,0.2,0.8,0.3c1,0.3,2.3,1.4,2.7,2.3c0.8,1.8-1.2,4.9,2.3,4.3c0.8-0.1,1.1-2.3,1.4-2.1c1,0.7,0.7,2.4,1.7,1.6  c1.4-1.1,0.4,0.7,1.4,1.9c0.4,0.5,1.5,0,1.9,0.2c1.1,0.7,1.9,2.5,2.9,3.4c0.6,0.5,1.3-0.2,1.5-0.3c0.5-0.1,1.3-1.2,1.2-0.7  c-0.3,1-0.5,1.7-0.5,2c0,0,0,0.1,0,0.2c0.2,0.3,0.6,0.7,0.6,0.7c0.1,0,0.2,0,0.2-0.1c0-0.1,0.1-0.2,0.2-0.3c0.4-0.7,0.8-2.1,1.3-1.3  c0.1,0.2-0.3,0.4-0.2,0.7c0,0.1-0.5,0.3-0.9,0.5c-0.1,0-0.2,0.1-0.2,0.1c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.4,0.4,0.8,0.5,1  c0.4,0.9-1.3,2.3-0.7,3c1,1.2,0.2-1.6,0.8-1.9c0.5-0.2,1.6,0.1,2,0.6c0.1,0.1,0.4-1.1,0.4-1.3c0-0.1-0.3-0.4-0.1-0.4  c1.1,0.3,0.2,1.2,0.5,1.6c0.5,0.6,1.6-1.3,2.2-0.8c0.7,0.6-0.4,1.4,0.8,1.3c0.2,0,0-0.7,0.2-0.7c0.2,0.1,0.1,0.5,0,0.7  c-0.7,1.5-0.9,0.8,1.3,1.5c0.4,0.1-1.4,0.1-1.1,0.4c0,0,1.7,0.1,1.7,0.1c0.8,0.4,0.8,1,1.8,1.2c0.3,0.1-0.5-0.2-0.8-0.2  c-0.4-0.1-1.5-0.1-1.1,0.8c0.3,0.5,0.4,0.8,0.6,0.9c0.1,0,0.1,0.1,0.1,0.1c0,0,0,0-0.1-0.1c-0.2-0.1-0.5-0.1-1.2,0  c-0.2,0.1-0.6-0.1-0.7,0.2c-0.3,1.5,2.4,2.5-0.3,1.7c-0.5-0.1,0.7,0.9,1.2,1.1c1.2,0.3,1.6,1.2,1.8,1.2c1.4,0.4,1.7-1.9,4.1-0.6  c0.4,0.2,3.4,2.7,3.3,3.1c-0.2,0.5-1.1-0.4-1.5-0.8c-0.6-0.5-2.2-3.3-4.1-1.9c-0.4,0.3-0.3,0.9-0.4,1.3c-0.2,0.5-1.5,0.5-1.3,1.1  c0.3,0.8,3.6,1.3,2.8,3c-0.7,1.6-2.6,1.5-3.2,3.4c-0.1,0.3,2.2,3.4,2.2,3.5c0.9,1,0.4,2.9,0.5,4c0.2,1.1,1.6,1.5,2,2.1  c0.1,0.2-0.3,0.5-0.2,0.7c0,0,1.8,0.5,1.8,0.5c0.9,0.5-0.2,1.4,0.2,1.9c0,0,1.5,0,1.5,0c0.7,0.5,0.4,1.7,1.4,2.2  c0.2,0.1,0.3-1.8,1.7-0.6c1.3,1.1-2.6,1.8-2.2,2.6c0.6,1.4,0.7,1.4,1.2,2.8c0.1,0.3,0.6,0.8,0.3,0.8c-0.3,0-0.6-0.4-0.9-0.3  c-0.4,0.2,0.3,1,0.1,1.5c-0.1,0.2,0,0.4,0,0.5c0,0.2,0.1,0.5,0,0.5c-0.2,0.1-1.3,0.2-1.3,0.4c-0.5,1.2,0.9,2.1,1.1,3  c0,0-2.1-2.3-2.6-2c-1.3,0.7-0.4,1.9,0.2,2.2c1,0.6,1.8,2.2,2.2,3.1c0.8,2.2,2.5,3,2.5,5.7c0,1.2-0.2,2.4-0.4,3.6  c-0.1,1.1-0.1,0.6-0.1,1.4c0,0.1,0,0.2,0,0.3c0.1,0.2,0.2,0.5,0.2,0.8c0.2,0.5,0.3,0.7,0.2,0.9c0.1,0.2,0.1,0.5,0.2,0.8  c0.6,0.9,1.6,2.4-0.2,1.9l0.2-1.7c0-0.1,0-0.1,0-0.2c-0.2-0.3-0.3-0.6-0.3-0.6c0.1,0,0.1-0.1,0.1-0.1c-0.1-0.3-0.2-0.6-0.2-0.9  c-0.1-0.2-0.1-0.3-0.2-0.5c0-0.1,0-0.2,0-0.2c-0.2-0.7-0.3-1.4-0.4-3.1c0-2.8-1.9-5.2-2.8-7.5c-0.1-0.4-0.8,0.2-1.1,0.4  c-1.2,1-1.5,3.1-2,4.7c-1.2,3.9-4,7.7-4.8,11.8c-0.3,1.6,4.9-5.1,3.3,0.9c-0.1,0.5-2.4-0.6-2.4-0.6c-1.6,0.7-2.1,4.4-2.7,5.9  c-1.3,3.3-6.8,16.2-9.8,17.2c-1,0.3-2-0.2-2.7-0.4l0.1,0.4c0.5,0.6,1.5,2.3,2.2,2.6c0.8,0.3,2.5,0.3,3,1.3c0.8,1.5-1.8,2.6-2.1,3.7  c-0.4,1.7,2.6-0.4,2.7-0.3c0.2,0.1,0,0.5-0.1,0.7c0,0.2-0.2,0.5-0.1,0.7c1.3,2.3,5.7,2.1,7.4,3.8c0.8,0.8,0.4,3.2,1.3,3.9  c1.7,1.4,4.6-0.5,6.2,1.3c0.9,1,0.2,2.9,2,3.4c0.7,0.2,1.7-0.6,2.5-0.4c0.8,0.2,1.4,1.5,2.2,1.6c0,0,1-0.8,1-0.8  c1.1,0,3.5,2.3,4.6,1.5c0.7-0.5-0.5-3.2,1.5-2.8c1.1,0.2,4.1,2.1,4.8,2.9c0,0,0.7,1.6,0.7,1.6c0.7,0.5,2.5,0.3,3.1,1.1  c0.4,0.5,0.5,1.8,0.7,2.5c0.3-0.5,0.8-1,1.1-1c0.9-0.2,5.2,1.2,2.4,4.1c0.8,0.5,2.4,1,3,1.8c0.5,0.6,0,1.8,1.1,2  c1.2,0.3,2.6-0.8,3.8-0.6c0.8,0.2,5.1,3.5,5.5,3.3l0.6-1.6c1.8-1.5,5.8,0.6,7.6,1.3c-0.1-1.1-0.9-1.8-1.2-2.7  c-0.7-2,1.2-3.6,0.8-5.1c0-0.2-1.4-0.6-1.1-0.9c0.8-1,1.1-0.7,1.8-1c0.2-0.1,0.2-0.5,0.1-0.7c-0.6-2,1.6-1.3,1.1-2.6  c-0.2-0.4-0.9-0.5-0.3-1.1c0.7-0.6-0.2,0.9,0.6,0.8c0.7-0.1,1.7-1.9,2.3-2.3c1.5-1,2.6-0.2,4-0.6c1.3-0.3,2.4-1.8,3.8-2.5  c-0.4,0.1-0.6,0.2-0.5,0c0.8-0.7,2.8-2,4.1-2c3.1,0,2.1,1.9,4.1,2.8c0.6,0.3,5,1.2,5.1,1.8c0,0-0.7,0.9-0.7,0.9  c0,0.5,2.9,1.4,3.3,1.3c0.7-0.2,0.5-0.5,0.1-0.9c-0.1,0-0.1-0.1-0.2-0.1c-0.3-0.2-0.6-0.5-0.7-0.5c-0.2-0.5,0.5-1.5,0.4-2  c0-0.3-0.6-0.8-0.4-0.8c1.3,0.2-0.1,2.5,0.6,3.3c0,0,0.1,0.1,0.2,0.1c0.1,0.1,0.3,0.1,0.5,0.2c0.5,0,0.9-0.7,1.5-0.7  c0.4,0,1.7,1.1,2.2,0.4c0.5-0.7-0.8-1-0.7-1.5c0.2-1,1.3-1,1.9-0.4c0.2,0.2-0.2,0.5-0.1,0.7c0.7,1.4,0.7-0.2,1.5,0.3  c1.3,0.7-3.4,1.8-3.4,1.8c0,0.2,0.1,0.5,0.1,0.7c0.2,1.2,3.9,0.3,4.3,0.4c1.3,0.6-0.2,2.4,0.2,3.2c0.2,0.4,3.8,0.9,4.6,1.5  c1.5,1.2,1.4,3.3,2.2,3.2c1.9-0.3-0.3-1.8,1.3-1.5c0.5,0.1,0.9,0.6,1.4,0.9c0.4,0.2,1-0.1,1.2,0.2c0.9,1.4-0.8,0.2-0.7,0.9  c0,0.2,0.4,0.1,0.6,0.1c1.8,0.3-0.3-0.7,1.2-1.5c1.1-0.6,1.8,1.4,2.6,1.5c0.6,0.1,0.2-1.4,0.8-1.6c0.5-0.2,1,0.3,1.5,0.3  c2.1-0.2,1.8,0.3,3.1-1.4c0.1-0.2,0.5-0.3,0.3-0.5c0,0-1.7-0.3-1.7-0.3c-0.2-0.4,1-0.1,1.4-0.5c0.5-0.6,1.1-1.2,1.6-2.2  c0.3-0.6,1.4,0.7,2,0.3c0.8-0.6,1-1.7,1.6-2.2c0.8-0.6,2.3,0.2,2.5,0.1c0.4-0.2-0.1-1.7,0.6-2c2.3-0.8,3.4,0.3,5.3-1.6  c0.1-0.1,0.4-0.1,0.7,0c-0.1-0.4-0.2-1.6-0.2-1.6c0.4-1.2,5.7-4.2,3.5-6.1c-0.9-0.8-6.9,1.3-10.3-4.4c-0.8-1.4,0.2-1.9,0.4-2.7  c0.2-0.7-1.6-0.8-0.9-1.9c1.3-2,5.1-3.1,3.5-6.1c-0.6-1.2-3-1.5-3.5-2.7c-0.2-0.4,0.4-0.9,0.2-1.4c-0.1-0.5-1.7-1.9-1.6-2.4  c0.1-0.3,0.5-0.1,0.8-0.2c2.1-0.6,1.6,0.5,2.6,0.4c0.9,0,5.8-3.9,5.7-5c-0.1-0.9-2-1.7-2.3-2.5c0,0,0.1-1.6,0.1-1.6  c0-0.3,0.2-0.6,0-0.8c-1.5-3.5-5.2-2.9,1.7-6l0.1,0.3C766.3,619.6,766.4,617.7,765.6,617.4"/>
                      <path data-border="bordfrancia2" id="francia2" fill="none" stroke="#A27A40" stroke-width="0" d="M765.6,617.4c-0.3-0.1-0.7,0.4-1,0.2c-0.4-0.4,0.7-1.1,0.5-1.7c-0.2-0.5-1.2-0.1-1.4-0.6c-0.4-0.9,1.3-1.7,1.3-2.2  c0.1-0.6-1-1.3-0.9-1.9c0.2-1.3,2.1-2.2-1.5-2.7c-6.8-1-5.2,3.4-6.3,4.2c-0.5,0.3-3.8,2.2-4.3,1c-0.1-0.3,0.5-0.3,0.6-0.6  c0.4-2.4,0.9-0.6,2-1.4c0.8-0.6,0.1-5.6,1.5-7.1c1.1-1.2,4.2-1.3,5-2.6c0.5-0.8-0.3-2.7,0.3-3.4c0.7-0.9,3.2-0.5,4.1-1.4  c0.7-0.7,1.4-1.9,2.3-2.8c1.2-1.1,3-1.9,3.5-2.4c0.1-0.2,0.5-0.3,0.4-0.5c-0.1-0.3-0.4-0.4-0.6-0.5c-0.2-0.1-1.5,0.3-1.3-0.6  c0.1-0.3,1.4-1.2,1.4-1.2l-0.1-1.1c3-1.2,2.5,2.8,5.6,2.3c0.9-0.2,2.3-2,3-2.7c-0.2-0.1-0.6-1.9-0.6-2.2c0.2-1.9,2.7-4.4,2.4-6.3  c-0.2-1.2-0.5-1.7,0.2-3.1c0.7-1.2,2-2.2,2.6-3.4c0.8-1.7,0.7-3.8,1.5-5.4c0.6-1.2,7.1-5.8,6.5-6.7c-2-3.1-6.6-1.1-8.6-3.8  c-0.4-0.5,0-1.3-0.4-1.8c-0.9-1-5.2,0.8-6.2,0.1l0.2-1.4c-1.4-2.1-2.9,0.4-3.4-0.2c-1.6-1.8-2-5.8-2.8-6.4c0,0-1.7-0.6-1.7-0.6  c-0.7-0.3-1.8-1.1-2.5-1.1c-0.6-0.1-2.1,0.9-2.6,0.6c-0.6-0.3-1.9-2-3.5-2.4c-0.6-0.1-2.8,0.5-3.2,0.1c-0.5-0.4,0.1-2-0.2-2.5  c0,0-1.5-0.6-1.5-0.6c-0.1-0.6,1.8-0.7,0-1.4c-0.3-0.1-0.6,0.3-0.9,0.2c-0.5-0.2-1.4-2.1-2.8-2.6c0,0-1.6-0.7-1.6-0.7  c-0.2-0.5,0.9-1.8,0.9-2.3c-0.1-1.6-1-1.2-0.1-2.8c0.1-0.1,1.1-1.8,1-1.9c-1.4-1.6-2.9,2-3.4,2.5c-0.6,0.5-7.6,0.8-6.9-1  c0.2-0.4,1.5-1.3,1.5-1.8c0,0-1.1-1.3-1.1-1.3c0-0.8,1.7-1.7,1.6-2.5c-0.1-1-4.6-3.1-5.5-2.9c-0.3,0.1-0.3,0.5-0.6,0.6  c-1.1,0.2,0-3.5-1-4.1c-1-0.6-3.5,0-4-1.5c-0.4-1.3,0.8-4.8-1-5.8c-0.7-0.4-2.5,1.6-3.2,1.4c-3.5-0.9-2.9-6.1-3-8.7  c-3.3,0.9-7.6-1.2-10.8,0.3c-3.6,1.7-3.2,6.2-4.6,9.6c-0.4,1-0.5,0.6,0,1.3c0.1,0.1,0.5,0.4,0.4,0.4c-0.6,0.3-1.6-0.1-1.5,1.4  c0.1,0.9,1.1,1.9,1.3,2.4c0.1,0.3-1.3-1.3-1.9-0.8c-8.1,6.5-10.6,2.6-19.3,5.6c-4,1.4-2.6,6,1.1,5.7c0.2,0,0.6-0.3,0.7-0.1  c0.2,0.4-3.1,0-3.3,0c-1.8,0-3.5,1.6-5.5,1.6c-1.6,0-7.4-3.7-9.5-4.8c-1.8-1-3.2,0.6-3.2,0.6c-0.1,0-1-3.6-1-4.9  c0-0.9,1.2-0.8,1.3-2c0-0.3,0.3-0.6,0.1-0.9c-0.9-1.2-6.6,0.8-8.7-3.1c-0.1-0.2-0.2,0.3-0.2,0.5c0,1,1.3,1.8,0.7,2.9  c-0.2,0.4-0.9,0.4-0.9,0.8c-0.2,1.1,0.2,4.1,1.1,4.6c0.5,0.3,0,1.3,0.4,2.6c0,0.1,0.4,1.9,0.4,1.9c-0.2,0.3-0.7,0.2-0.8,0.5  c-0.1,0.1-0.4,2.2,0.2,1.8c0.3-0.2,0.4,0,0.2,0.1c-0.1,0-1.7,3.4-1.7,3.5c0,0.4,0,2.6,0.5,3.4c0.1,0.1,2.3,1,1.7,1.5  c-0.4,0.3-0.9-0.6-1.4-0.6c-1.1,0-3.3,0.1-4.3-0.3c-1.7-0.7,0.2-3.5-1.6-2.6c-0.1,0.1,0,0.3-0.1,0.3c-0.2,0-0.4-0.2-0.7-0.2  c-1.9,0.2,0.7,3.8-0.9,3.3c-0.1,0,0.3-0.1,0.3-0.3c0.1-0.4-0.2-2.3-0.4-2.6c-0.6-0.8-1.3,0.5-2.6,0.7c-0.5,0.1,0.4-1.3-0.1-1.5  c0,0-1.3,0.4-1.3,0.4c0-0.1,2-1.2,0.7-1.6c-0.2-0.1-0.2,0.5-0.4,0.6c-1.3,0.8-1.3-0.7-2.1-0.2c-0.2,0.1,0.2,0.5,0,0.7  c-0.2,0.2-2.8,0.7-3.1,0.9c-0.2,0.1-0.2,0.7-0.4,0.6c-0.1,0-1.6-5.1-2-6.3c-0.4-1.4-1.2-1.5-2.3-0.3c-0.2,0.2,1.2-1.3,1.1-2.2  c0-0.1-0.1-0.1-0.2-0.1c-0.7-0.1-1.1-0.1-1.6,0.4c-0.1,0.1-0.4,0.6-0.4,0.4c0.8-2.7-0.9-0.3-2.8-0.8c-0.6-0.2,0.6-1.7-1.1-1.1  c-1.2,0.4-0.7,2.5-1.6,2.8c-0.7,0.3-1.9-2-2.8-1.9c-0.6,0.1-1,0.8-1,1.3c0,0.2,0.1,0.5,0,0.5c-1.1,0-0.7-4-2.3-1.8  c-0.1,0.2-0.3-0.4-0.6-0.5c-1.2-0.6-1.9,1.4-3,0.5c-0.7-0.5,1.1-0.7-0.1-1.1c-0.6-0.2-1.2,0.6-1.4,0.6c-0.3,0.1-1.9-0.9-2.1-0.3  c-0.3,1.1-3-0.4-4.4,4c-0.5,1.7,3.4,0.7,4.1,0.9c1.7,0.5-0.4,0.5,0.1,1.1c0.5,0.7,2.8-0.4,2.5,0.4c-0.1,0.3-0.7,0.2-0.9,0.5  c-0.4,0.5,2.1,0.5,1.7,0.9c-0.3,0.2-3.8-0.7-4.3-1c-1.1-0.5,0.4-1.4-0.6-1.3c-0.5,0.1-0.6,0.6-1,0.8c-0.4,0.1,0.5,0.6,0.7,0.9  c0.3,0.5-1.1,1.5-0.5,1.6c0.5,0.2,0.8-1,1.1-1.1c1-0.2,2.4,1.8,2.3,2.5c0,0.2-0.1,0.5-0.2,0.7c-0.3,0.5-4.6-1.7-6.5-0.2  c-0.2,0.2,0.5,0.2,0.8,0.3c1,0.3,2.3,1.4,2.7,2.3c0.8,1.8-1.2,4.9,2.3,4.3c0.8-0.1,1.1-2.3,1.4-2.1c1,0.7,0.7,2.4,1.7,1.6  c1.4-1.1,0.4,0.7,1.4,1.9c0.4,0.5,1.5,0,1.9,0.2c1.1,0.7,1.9,2.5,2.9,3.4c0.6,0.5,1.3-0.2,1.5-0.3c0.5-0.1,1.3-1.2,1.2-0.7  c-0.3,1-0.5,1.7-0.5,2c0,0,0,0.1,0,0.2c0.2,0.3,0.6,0.7,0.6,0.7c0.1,0,0.2,0,0.2-0.1c0-0.1,0.1-0.2,0.2-0.3c0.4-0.7,0.8-2.1,1.3-1.3  c0.1,0.2-0.3,0.4-0.2,0.7c0,0.1-0.5,0.3-0.9,0.5c-0.1,0-0.2,0.1-0.2,0.1c-0.1,0.1-0.2,0.2-0.2,0.3c-0.1,0.4,0.4,0.8,0.5,1  c0.4,0.9-1.3,2.3-0.7,3c1,1.2,0.2-1.6,0.8-1.9c0.5-0.2,1.6,0.1,2,0.6c0.1,0.1,0.4-1.1,0.4-1.3c0-0.1-0.3-0.4-0.1-0.4  c1.1,0.3,0.2,1.2,0.5,1.6c0.5,0.6,1.6-1.3,2.2-0.8c0.7,0.6-0.4,1.4,0.8,1.3c0.2,0,0-0.7,0.2-0.7c0.2,0.1,0.1,0.5,0,0.7  c-0.7,1.5-0.9,0.8,1.3,1.5c0.4,0.1-1.4,0.1-1.1,0.4c0,0,1.7,0.1,1.7,0.1c0.8,0.4,0.8,1,1.8,1.2c0.3,0.1-0.5-0.2-0.8-0.2  c-0.4-0.1-1.5-0.1-1.1,0.8c0.3,0.5,0.4,0.8,0.6,0.9c0.1,0,0.1,0.1,0.1,0.1c0,0,0,0-0.1-0.1c-0.2-0.1-0.5-0.1-1.2,0  c-0.2,0.1-0.6-0.1-0.7,0.2c-0.3,1.5,2.4,2.5-0.3,1.7c-0.5-0.1,0.7,0.9,1.2,1.1c1.2,0.3,1.6,1.2,1.8,1.2c1.4,0.4,1.7-1.9,4.1-0.6  c0.4,0.2,3.4,2.7,3.3,3.1c-0.2,0.5-1.1-0.4-1.5-0.8c-0.6-0.5-2.2-3.3-4.1-1.9c-0.4,0.3-0.3,0.9-0.4,1.3c-0.2,0.5-1.5,0.5-1.3,1.1  c0.3,0.8,3.6,1.3,2.8,3c-0.7,1.6-2.6,1.5-3.2,3.4c-0.1,0.3,2.2,3.4,2.2,3.5c0.9,1,0.4,2.9,0.5,4c0.2,1.1,1.6,1.5,2,2.1  c0.1,0.2-0.3,0.5-0.2,0.7c0,0,1.8,0.5,1.8,0.5c0.9,0.5-0.2,1.4,0.2,1.9c0,0,1.5,0,1.5,0c0.7,0.5,0.4,1.7,1.4,2.2  c0.2,0.1,0.3-1.8,1.7-0.6c1.3,1.1-2.6,1.8-2.2,2.6c0.6,1.4,0.7,1.4,1.2,2.8c0.1,0.3,0.6,0.8,0.3,0.8c-0.3,0-0.6-0.4-0.9-0.3  c-0.4,0.2,0.3,1,0.1,1.5c-0.1,0.2,0,0.4,0,0.5c0,0.2,0.1,0.5,0,0.5c-0.2,0.1-1.3,0.2-1.3,0.4c-0.5,1.2,0.9,2.1,1.1,3  c0,0-2.1-2.3-2.6-2c-1.3,0.7-0.4,1.9,0.2,2.2c1,0.6,1.8,2.2,2.2,3.1c0.8,2.2,2.5,3,2.5,5.7c0,1.2-0.2,2.4-0.4,3.6  c-0.1,1.1-0.1,0.6-0.1,1.4c0,0.1,0,0.2,0,0.3c0.1,0.2,0.2,0.5,0.2,0.8c0.2,0.5,0.3,0.7,0.2,0.9c0.1,0.2,0.1,0.5,0.2,0.8  c0.6,0.9,1.6,2.4-0.2,1.9l0.2-1.7c0-0.1,0-0.1,0-0.2c-0.2-0.3-0.3-0.6-0.3-0.6c0.1,0,0.1-0.1,0.1-0.1c-0.1-0.3-0.2-0.6-0.2-0.9  c-0.1-0.2-0.1-0.3-0.2-0.5c0-0.1,0-0.2,0-0.2c-0.2-0.7-0.3-1.4-0.4-3.1c0-2.8-1.9-5.2-2.8-7.5c-0.1-0.4-0.8,0.2-1.1,0.4  c-1.2,1-1.5,3.1-2,4.7c-1.2,3.9-4,7.7-4.8,11.8c-0.3,1.6,4.9-5.1,3.3,0.9c-0.1,0.5-2.4-0.6-2.4-0.6c-1.6,0.7-2.1,4.4-2.7,5.9  c-1.3,3.3-6.8,16.2-9.8,17.2c-1,0.3-2-0.2-2.7-0.4l0.1,0.4c0.5,0.6,1.5,2.3,2.2,2.6c0.8,0.3,2.5,0.3,3,1.3c0.8,1.5-1.8,2.6-2.1,3.7  c-0.4,1.7,2.6-0.4,2.7-0.3c0.2,0.1,0,0.5-0.1,0.7c0,0.2-0.2,0.5-0.1,0.7c1.3,2.3,5.7,2.1,7.4,3.8c0.8,0.8,0.4,3.2,1.3,3.9  c1.7,1.4,4.6-0.5,6.2,1.3c0.9,1,0.2,2.9,2,3.4c0.7,0.2,1.7-0.6,2.5-0.4c0.8,0.2,1.4,1.5,2.2,1.6c0,0,1-0.8,1-0.8  c1.1,0,3.5,2.3,4.6,1.5c0.7-0.5-0.5-3.2,1.5-2.8c1.1,0.2,4.1,2.1,4.8,2.9c0,0,0.7,1.6,0.7,1.6c0.7,0.5,2.5,0.3,3.1,1.1  c0.4,0.5,0.5,1.8,0.7,2.5c0.3-0.5,0.8-1,1.1-1c0.9-0.2,5.2,1.2,2.4,4.1c0.8,0.5,2.4,1,3,1.8c0.5,0.6,0,1.8,1.1,2  c1.2,0.3,2.6-0.8,3.8-0.6c0.8,0.2,5.1,3.5,5.5,3.3l0.6-1.6c1.8-1.5,5.8,0.6,7.6,1.3c-0.1-1.1-0.9-1.8-1.2-2.7  c-0.7-2,1.2-3.6,0.8-5.1c0-0.2-1.4-0.6-1.1-0.9c0.8-1,1.1-0.7,1.8-1c0.2-0.1,0.2-0.5,0.1-0.7c-0.6-2,1.6-1.3,1.1-2.6  c-0.2-0.4-0.9-0.5-0.3-1.1c0.7-0.6-0.2,0.9,0.6,0.8c0.7-0.1,1.7-1.9,2.3-2.3c1.5-1,2.6-0.2,4-0.6c1.3-0.3,2.4-1.8,3.8-2.5  c-0.4,0.1-0.6,0.2-0.5,0c0.8-0.7,2.8-2,4.1-2c3.1,0,2.1,1.9,4.1,2.8c0.6,0.3,5,1.2,5.1,1.8c0,0-0.7,0.9-0.7,0.9  c0,0.5,2.9,1.4,3.3,1.3c0.7-0.2,0.5-0.5,0.1-0.9c-0.1,0-0.1-0.1-0.2-0.1c-0.3-0.2-0.6-0.5-0.7-0.5c-0.2-0.5,0.5-1.5,0.4-2  c0-0.3-0.6-0.8-0.4-0.8c1.3,0.2-0.1,2.5,0.6,3.3c0,0,0.1,0.1,0.2,0.1c0.1,0.1,0.3,0.1,0.5,0.2c0.5,0,0.9-0.7,1.5-0.7  c0.4,0,1.7,1.1,2.2,0.4c0.5-0.7-0.8-1-0.7-1.5c0.2-1,1.3-1,1.9-0.4c0.2,0.2-0.2,0.5-0.1,0.7c0.7,1.4,0.7-0.2,1.5,0.3  c1.3,0.7-3.4,1.8-3.4,1.8c0,0.2,0.1,0.5,0.1,0.7c0.2,1.2,3.9,0.3,4.3,0.4c1.3,0.6-0.2,2.4,0.2,3.2c0.2,0.4,3.8,0.9,4.6,1.5  c1.5,1.2,1.4,3.3,2.2,3.2c1.9-0.3-0.3-1.8,1.3-1.5c0.5,0.1,0.9,0.6,1.4,0.9c0.4,0.2,1-0.1,1.2,0.2c0.9,1.4-0.8,0.2-0.7,0.9  c0,0.2,0.4,0.1,0.6,0.1c1.8,0.3-0.3-0.7,1.2-1.5c1.1-0.6,1.8,1.4,2.6,1.5c0.6,0.1,0.2-1.4,0.8-1.6c0.5-0.2,1,0.3,1.5,0.3  c2.1-0.2,1.8,0.3,3.1-1.4c0.1-0.2,0.5-0.3,0.3-0.5c0,0-1.7-0.3-1.7-0.3c-0.2-0.4,1-0.1,1.4-0.5c0.5-0.6,1.1-1.2,1.6-2.2  c0.3-0.6,1.4,0.7,2,0.3c0.8-0.6,1-1.7,1.6-2.2c0.8-0.6,2.3,0.2,2.5,0.1c0.4-0.2-0.1-1.7,0.6-2c2.3-0.8,3.4,0.3,5.3-1.6  c0.1-0.1,0.4-0.1,0.7,0c-0.1-0.4-0.2-1.6-0.2-1.6c0.4-1.2,5.7-4.2,3.5-6.1c-0.9-0.8-6.9,1.3-10.3-4.4c-0.8-1.4,0.2-1.9,0.4-2.7  c0.2-0.7-1.6-0.8-0.9-1.9c1.3-2,5.1-3.1,3.5-6.1c-0.6-1.2-3-1.5-3.5-2.7c-0.2-0.4,0.4-0.9,0.2-1.4c-0.1-0.5-1.7-1.9-1.6-2.4  c0.1-0.3,0.5-0.1,0.8-0.2c2.1-0.6,1.6,0.5,2.6,0.4c0.9,0,5.8-3.9,5.7-5c-0.1-0.9-2-1.7-2.3-2.5c0,0,0.1-1.6,0.1-1.6  c0-0.3,0.2-0.6,0-0.8c-1.5-3.5-5.2-2.9,1.7-6l0.1,0.3C766.3,619.6,766.4,617.7,765.6,617.4"/>
                      <path data-border="bordespaña" id="españa" fill="none" stroke="#A27A40" stroke-width="0" d="M689.9,679.9l-0.6,1.6c-0.5,0.2-4.7-3.2-5.5-3.3c-1.2-0.3-2.6,0.8-3.8,0.6c-1.1-0.3-0.6-1.4-1.1-2c-0.6-0.7-2.2-1.3-3-1.8  c-4.4,0.7-4.4-1.4-3.6-2.9l0.1,0c-0.2-0.6-0.3-2.2-0.7-2.6c-0.6-0.8-2.4-0.6-3.1-1.1c0,0-0.7-1.6-0.7-1.6c-0.7-0.8-3.7-2.7-4.8-2.9  c-2-0.4-0.8,2.3-1.5,2.8c-1.1,0.8-3.5-1.5-4.6-1.5c0,0-1,0.8-1,0.8c-0.8-0.1-1.4-1.4-2.2-1.6c-0.7-0.2-1.7,0.6-2.5,0.4  c-1.8-0.5-1.1-2.4-2-3.4c-1.7-1.8-4.6,0.1-6.2-1.3c-0.9-0.8-0.5-3.1-1.3-3.9c-1.7-1.7-6.1-1.5-7.4-3.8c-0.1-0.2,0-0.5,0.1-0.7  c0-0.2,0.2-0.6,0.1-0.7c-0.1-0.1-3.1,2.1-2.7,0.3c0.2-1.1,2.9-2.2,2.1-3.7c-0.5-1-2.2-1-3-1.3c-0.7-0.3-1.7-2-2.2-2.6l-0.1-0.4  c-0.1,0-0.2,0-0.3-0.1c-0.9-0.1-1.4,1.1-1.9,1.3l-0.9-0.6c-0.8-0.1-1.9,0.5-2.7,0.3c-1.5-0.4-6.6-4.7-7.1-4.5  c-0.2,0.1-0.2,0.6-0.4,0.6c-0.7,0.1-0.1-1.4-0.5-1.9c-0.3-0.4-4-0.4-4.5,0.1c-0.2,0.2,0,0.5-0.1,0.7c0,0.2,0.2,0.8-0.1,0.7  c-1.7-0.5-3.3-4.3-5.6-4.2c-0.2,0-0.2,0.7-0.4,0.6c-1.5-0.5,1-1,0.9-1.2c-0.1-0.2-1.6-1.6-1.9-1.6c-2.4-0.5-2.6,1.4-4,1  c-1.2-0.4,2.4-0.8,0.5-1.7c-0.3-0.1-0.6-0.1-0.9-0.1c-0.3,0-0.6-0.2-0.9-0.1c-0.4,0.1-0.4,1-0.8,0.8c-1.3-0.4-4,0.1-5.3-0.6  c-3.1-1.5-8.7-3.6-12.1-6c-0.5-0.4-0.6-1.1-1.1-1.5c-0.3-0.2-0.6-0.3-1-0.3c-0.3,0-0.6,0.5-0.9,0.4c-0.3-0.1,0.5-0.3,0.7-0.5  c0.4-0.6-3.6-1.4-3.9-1.7c-0.2-0.1-1.1-3.1-1.9-3.2c-1.4-0.1-0.7,1.1-1.5,1.3c-1.7,0.4-3.4-1.2-4.4-1.8c-0.5-0.3-2.2,0.5-2.9,0.1  c-2.1-1-5-2.2-7.5-2.9c-0.9-0.3-1,0.2-1.6,0.7c-0.1,0.1-0.3,0.6-0.4,0.4c-0.3-0.4,1-1.4,0.8-1.5c-0.7-0.5-2.9-0.2-3.4-0.8  c-0.5-0.7-0.9-3.2-1.9-4.3c-0.7-0.8-1.6,0.2-2.1,0c-0.2-0.1,0.2-0.4,0.2-0.6c0-1.6-0.4-0.4-1.2-0.4c-0.5,0,1.2-1.2,0.7-1.2  c-0.6,0-2.1,0.9-2.5,0.9c-0.3,0-0.5-0.4-0.7-0.3c-0.3,0.2,0,1.1-0.4,1c-0.8-0.3,1.9-2.2,0.4-2.4c-1.9-0.3-9.4,2.7-11.7,3.4  c-2,0.6-4.8,1.9-6.9,1.9c-3.4,0,1.5-0.3-1.1-0.8c-0.4-0.1-0.7,0.6-1.1,0.7c-0.9,0.1-1.8-0.9-2.5,0.2c-0.5,0.7,1.7,0.5,1.7,0.6  c-0.1,0.4-0.8,0.1-1.2,0.3c-0.2,0.1-2,0.3-2,0.3c-0.6-0.2-0.1,1.4-0.4,1.9c-0.2,0.3-0.9,0.9-0.6,1.4c0.5,0.7,0.9-0.8,1.6-0.5  c0.9,0.3-0.2,3.2-0.2,3.4c0,0.3-0.2,1,0.2,1c0.3,0,0.5-0.3,0.7-0.5c0.1-0.1,0-0.3,0.1-0.3c0.9-0.1,1.4,0.3,2.1,0.1  c0.2,0,0.5,0,0.5,0.2c0,0.4-5.5,2.3-4.3,5c0.3,0.7,2.2-1.4,2.6-1.2c1.4,0.5,0-0.7,1.1-0.7c0.6,0,0.1,2.4,1.7,0.6  c0.4-0.5-0.6,1.1-1.1,1.4c-0.3,0.2-0.9,0-1.2,0.3c-0.5,0.5,0.2,1.6-0.7,1.9c-0.8,0.3-0.3-0.9-0.5-0.9c-1.7-0.6-0.5,1.9,0,2.2  c0.2,0.2,2.9,0.2,2.9,0.3c-0.1,0.6-4.4,1.5-4.3,2.1c0.1,1.9,3.8-0.2,4.2-0.3c0.3-0.1-0.3,0.7-0.6,0.9c-0.7,0.4-1.7,0.2-2.4,0.6  c-0.2,0.1-0.4,0.3-0.6,0.5c-0.3,0.2-0.9,0-1.1,0.3c-0.1,0.4,0.5,1.3,0.1,1.2c-0.5-0.2-0.2-1.3-1.2-0.5c-0.3,0.2-1.4,4.5-1.2,4.7  l1.5-0.7c0,0,0,0.1-0.1,0.2l0.9-0.5c2.9-1.2,8.4-1.5,10.1,0.8c1.2,1.7-5.6,2.3-2.4,5c1.2,1,3.4-1.5,4.2-0.3c0.1,0.2-0.4,0.5-0.2,0.7  c0.4,0.4,2.3,0.1,2.9,0.3c0.6,0.2,1.3,0.4,1.6,0.9c0.2,0.4-1.2,0.6-0.8,0.8c0,0,1.9,0,1.9,0c0.5,0.2,0.4,1.2,0.9,1.4  c0.4,0.2,3.9-0.1,4.2-0.3l0.2-1.4c0.6-0.3,2.9,1.5,3.5,1.8c0.7,0.3,1.4,1.1,1.9,0.3c0.1-0.1,0.1-0.5,0.3-0.4  c0.5,0.2,0.4,1.1,0.9,1.4c0.8,0.6,1.6-0.2,2.3,1c0.2,0.4-0.7,0.7-0.5,1.1c0.2,0.3,0.8,0,1,0.3c0.3,0.6-1.4,2.8-1.5,3.5  c-0.1,0.9,5.2,1.3,4,4.3c-0.4,1-4.1,3.3-5.1,3.7c-1.1,0.5-2.5-0.1-3.4,0.3c-1.4,0.6-2.4,2.6-3.8,3.1c-0.9,0.3-1.6-1.1-1.9,0.6  c-0.1,0.9,0.8,2,0.6,3c-0.2,1.4-1.5,5.5-2.4,6.8c0,0-1.1,0.7-1.1,0.7c-0.5,0.8,0.5,1.4,0.4,2c-0.4,2.1-5.2,0.5-5.1,3.3  c0,1.1,1.5,2,1.3,3.4c-0.1,1.3-3.1,5.5-4.3,5.8c-0.7,0.2-6.5-2.3-7.6-2.7c-0.3-0.1-0.6-0.5-0.8-0.3c-0.5,0.7,1.9,4.5,2,5.5  c0,0.2-1.7,3.3-0.8,5.5c0.2,0.5,0.9,0.6,1,1.1c0.1,0.3-0.5,0.7-0.3,1c0.6,0.9,2.5,0.4,2.5,2c-0.1,1.3-2.2,1.8-2.4,2.8  c-0.1,0.3,0.4,0.6,0.3,0.8c-0.5,0.8-3.7,0.8-4.5,1.3c-0.1,0-2.9,4.4-3,4.6c-0.4,0.9,0.4,1.1,0.6,2c0.2,1,0.3,4.2,0.9,4.9  c0,0,1.9,0.2,1.9,0.2c0.2,0.1,0.4,0.5,0.3,0.7c-0.8,3.7-4.2,1-5.9,2.2c-0.3,0.2-0.2,0.7-0.3,1c-1,1.7-2.5,1.6-3.9,2.6  c-3.5,2.7-2.8,7.1-3.6,11c2,0.3,4.8,1,5.5,1.3c0,0,1.3,1.2,1.3,1.2c0.7,0.2,1.5-1.1,2.1-0.9c0.5,0.2-1,0.9-0.8,1.4  c1,2.3,3.5,4.1,4.7,6.3c0.4,0.7,0.4,3.8,1.2,4c0.3,0.1,0.5-0.3,0.7-0.7c0-0.4,0-0.8,0.5-1c0.3-0.1,0.6,0.1,0.8,0.1  c0.3,0,0.6,0.1,0.8,0.1c0.2,0,0.6-0.4,0.6-0.1c0.4,1.1-2.2-0.1-2.3-0.1c-0.2,0.1-0.3,0.6-0.5,1c0,0.4,0.1,0.7-0.2,0.9  c-0.6,0.5-1.7-0.2-2,0.8c-0.8,2.4,2,2.4,2.1,4.3c0,0.4,0.4,0.9,0.5,1.2c0,0-1.1-0.7-2-1c-0.2-0.1,0.2,0.5,0.3,0.7  c0.2,0.5,0.4,0.9,0.5,1.4c0.3,1.4,0.3,2.6,0.8,3.9c0.2,0.5,0.1,2,0.4,2.3c0,0,1.9,0.6,1.9,0.6c1,0.9,2.4,4.6,3.9,5.3  c2.9,1.4,2.7-1.2,3.4-2.1c0.5-0.7,1.2,0.4,1.6,0.5l1-1.3c0.6-0.8,2.6-2.6,3.6-2.9c1-0.3,4.7-0.7,5.7-0.3c1.2,0.4,1.8,1.9,3.4,1.4  c1.5-0.4,3.6-2.9,5.1-3.1c1.4-0.2,11.1,2.6,12.8,3.2c0.9,0.3,1.7,1.6,2.7,1.9c1.4,0.3,3.8-0.3,6,0.4c2.4,0.7,3.6,3,5.8,3.1  c1.9,0.1,2.8-2.6,6.4-1c1.7,0.8,1.3,2.5,3.2,3c1.2,0.3,2.9-2.8,4.1-3.1c1.3-0.3,2.3-3.3,3.6-4.7c1.4-1.4,7.5-4.6,9.4-4.9  c1.3-0.2,2.9,1.4,3.6,1.3c0.2,0,0-0.5,0.2-0.7c0.2-0.2,0.6-0.1,0.9-0.1c1.9,0.1,3.6,2.4,5.8,0.8c0.4-0.3-2-1.5-1.8-3  c0.1-0.7,2.1-0.8,2.2-0.8c0.6-0.4,0.1-1.5,0.5-2c0.4-0.5,1.8-0.8,2-1.2c0.5-0.9,0-2.4,0.6-3.4c0.5-0.8,1.9,0,2.4-0.4  c0.6-0.5,0.4-2.1,1-2.6c0.4-0.4,1.2,0.4,1.7,0.1c0.5-0.3,0.3-1.5,1-1.9c1.6-0.7,3.4-0.4,4.9-0.5c1.1-0.1,0.3-0.9,0.9-1.2  c1.5-0.8,3.6-0.4,5.2-1.5c1.4-1.1-3.7-4.2-4.2-5.3c-1.1-2.1-1.6-11.4,0-13.1c1.4-1.5,6.9-7.4,8.2-8.2c2-1.3,4.3-2.5,6.2-4.1  c1.6-1.4,3.5-5.1,5.5-5.7c0.3-0.1,0.6,0,0.9,0.1c0.3,0,0.7-0.2,0.9,0.1c0.1,0.1-0.3,0.3-0.4,0.4c-0.6,0.7-1.9-0.3-1.4,0.6  c0.7,1,1.5-0.9,2.3-1.2c0.4-0.1,1.2,0.2,1.6,0c2.2-0.8-1.7-2.9-1.7-2.9c0.3-1.2,4.1-3.2,5.2-3.7c1.5-0.7,1.9-0.1,3.2,0.1  c0,0,1-0.8,1-0.8c1.2-0.3,3.4-0.2,4.6-0.3c2.8-0.2,6,0.9,8.8,0.3c1.8-0.4,2.6-2.2,4.1-3c4.4-2.2,12.3-2.5,16.1-5.7  c2.6-2.2-0.5-4.7,0.4-7c0.7-1.6,3.2,0.9,3.4-1.4c0-0.6-1.4-0.8-1.6-1c-0.8-1.2,0.2-0.9,0.1-1.7C695.7,680.5,691.7,678.4,689.9,679.9  "/>
                      <path data-border="bordmilan" id="milan" fill="none" stroke="#A27A40" stroke-width="0" d="M921.8,746.6c-0.3-0.5,0.7-1.5-0.2-2.1c-1.7-1.2-6-2.6-8.3-4c-2.5-1.5-3.8-4.1-6.6-5.4c-5.3-2.3-11.8-4.1-16.3-8  c-5.1-4.4,6-5.5,3.1-9.9c-1.2-1.8-5.4,0.1-7.2-0.4c-1.6-0.4-2.8,0.2-4.4,0.1c-2.9-0.2-7.9-2.5-10-4.4c-0.6-0.5,0.2-1.2-0.1-1.7  c-0.6-0.9-2.3-1-3-1.9c-3.6-4.8-6.3-7.1-8.1-13.3c-0.8-2.9-2-12.8-3.6-14.6c-2.1-2.4-2.3-1-4.5-2.8c-1.5-1.2-2.7-3-4.1-4.4  c-3.6-3.4-8.5-5.2-9.3-11c-0.4-3-0.9-7.2,0.5-10c0.3-0.7,0.8,1.3,1.9,0.9c0.5-0.2-0.5-1-0.4-1.4c0.1-0.2,0.8-0.4,0.7-0.1  c0,0.2,0.8-0.1,0.9-0.3c0.1-0.2,0.8-1.4,0.8-1.5c-0.6-0.5-2.2-2.3-2.2-2.3c-0.3,0.2,0.2-0.1-0.2-0.4c-0.2-0.1-0.6,0.1-0.7-0.1  c-0.3-0.5,0.5-0.4,0.6-0.8c0.1-0.7-0.3-1-0.3-1.6c0-0.2,0.3-0.7,0.1-0.7c-0.5-0.1-1.4,1.3-1.2-0.3c0.2-2.3-0.5,0.5-0.7-1.1  c0-0.2-0.2-0.4-0.1-0.5c1.2-0.9,2.4-2.5,2.5-2.9c-0.1,0-0.2,0.1-0.3,0.2c0.3-0.3,0.4-0.3,0.3-0.2c0.6-0.2,1.7,0.1,1.7-0.5  c0-0.3-0.7-0.6-0.4-0.7c0.3-0.2,0.6,0.4,0.9,0.4c0.7,0.1,0.1-1.7,1-0.6c0.2,0.2,1.2-0.2,1,0.1c-1.2,1.4-2,0.4-2.6,2.2  c0,0,1-0.4,2.5-1c1.8-0.7,4.1-2.3,6-2.4c0.3,0,3.2-0.1,2.5-1.2c-0.1-0.2-0.5,0.3-0.8,0.3c0,0-0.8-0.5-0.4-0.7c1-0.8,1.5-1.4,2.7-0.5  c0.5,0.4,1.6,0.1,2.1,0.5c0.2,0.2,0.4,0.4,0.4,0.7c0,0.3-0.7,0.4-0.5,0.6c0.2,0.2,0.5-0.3,0.8-0.4c1.1-0.6,1.3-2.6,2.8-1.4  c1.2,1,0.9,1.9,1.5,2.9c0.1,0.2,0.9,0.2,0.7,0.4c-0.2,0.3-0.6-0.1-1-0.1c-0.1,0-0.2,0.2-0.3,0.3c0.9,0.2,1.9,0.8,2.5,0  c1.5-1.9-3.1-3.6-3.9-4.6c-0.8-1.1,1.2-2.4,0.8-3.4c-0.3-0.6-2.4,0.7-2.1-0.9c0.1-0.8,3.4-2.3,2.9-3.2c-0.5-1-4.3-0.9-3.9-2.7  c0.5-2,4.4-1.2,5.1-4.4l0.2-0.3c-6.1-1.4-14-1.6-18.1-4.7c-0.5-0.4-0.5-1.6-1-1.8c-0.3-0.1-0.7,0.2-0.9-0.1  c-0.4-0.5,0.6-1.2,0.4-1.7c-0.2-0.6-1.7-0.7-2-1.2c-0.1-0.1-0.1-2,0-2.1c0.3-0.3,1.4-0.4,1.1-0.7c-0.6-0.8-2.9,0.1-3.7,0.3  c-2.2,0.5-10.5-0.4-11.2,0.1c-1,0.7-1.5,3.5-2.6,3.9c-0.3,0.1-3.8-0.9-3.9-1.1c-0.2-0.4,0.8-1.1-0.8-1.5c-0.9-0.2-1.9,0.5-2.8-0.3  l0-0.3c-0.3,1.5-1.3,2.6-1.7,4c-0.3,1.1,1.5,0.9,1.2,2.2l-0.6,1c-2.6,0.7-2.1-3.8-4.8-2.3c-2.5,1.4,0.4,3.7,0.4,4.2  c0,0-0.9,1.6-0.9,1.6c-0.1,1.3,1.7,1.4-0.3,2.1c-0.3,0.1-0.5,0.4-0.8,0.3c-0.8-0.4-0.4-3.1-1.2-3.6c-1.8-1.1-3.5,1.7-5,1.1  c-2.5-1-0.4-3.4-1.8-4.8c-0.3-0.3-0.4,1-0.8,0.9c-0.2,0-0.8-2.2-1.8-0.6c-0.2,0.2,0,0.6,0,0.9c0,0.7,0.3,2,0,2.6  c-0.9,2.1-5.4,3.9-5.3,6.6c0,0.6,2,2.7,0.1,3.1c-1.4,0.3-1.1-2.4-1.5-3l-1.6-0.9c-0.1-0.7,1.1-0.9,1.2-1.6c0-0.2-4.8-2.9-5.2-4.6  c-0.2-0.7,0.5-2.7,0.6-3.5c0-0.3,0.3-0.7,0.1-0.9c-0.4-0.4-4.4,2.5-5,2.8c-1.9,1.2,0.4,1,0.1,2.4c-0.2,0.8-5,4.7-5.3,4.8  c-1,0.1-2.4-2-3.6-2c-2.1,0-5,2-7.2,1c-0.3-0.1-0.5-0.5-0.7-0.8l-0.1-0.3c-6.9,3.1-3.2,2.5-1.7,6c0.1,0.3,0,0.5,0,0.8  c0,0-0.1,1.6-0.1,1.6c0.3,0.8,2.2,1.6,2.3,2.5c0.1,1.1-4.8,5-5.7,5c-1,0-0.6-1-2.6-0.4c-0.3,0.1-0.7,0-0.8,0.2  c-0.1,0.5,1.4,1.9,1.6,2.4c0.1,0.4-0.4,0.9-0.2,1.4c0.6,1.2,2.9,1.5,3.5,2.7c1.6,3-2.2,4.1-3.5,6.1c-0.7,1.1,1.1,1.2,0.9,1.9  c-0.2,0.9-1.3,1.3-0.4,2.7c3.4,5.7,9.4,3.7,10.3,4.4c2.2,1.9-3,4.9-3.5,6.1c0,0,0.2,1.2,0.2,1.6c0.8,0.1,1.8,0.5,2.2,0.5  c1.9-0.2,6.4-0.7,7.7-2.3c0.2-0.3-0.3-0.8-0.1-1.1c0.3-0.4,1-0.4,1.4-0.8c0.5-0.7-0.3-1,0.7-1.6c0.6-0.3,1.9-0.2,2.4-0.7  c0.5-0.5,0.4-1.6,0.5-2c0.3-0.7,4.6-2.3,5.3-2.4c0.2,0,5.1,2,5.2,2.1c0,0,0.3,2.1,1,1.5c0.3-0.2,0-1.1,0.4-1c1.2,0.4,6.7,6.5,8,7.7  c0.4,0.3-0.1-1.4,0.2-1.4c0.3,0.1,3.2,1.9,3.7,2.2c3.8,2.3,0.2,8.8,1.8,11.7c0.9,1.6,2.2,3.1,2.7,5.2c0.4,1.8-1.9,5-1.2,6.1  c0.3,0.5,2.7-0.4,3.7,0.8c1.1,1.3-0.7,1.8-0.5,2.4c0.2,0.7,2.4,1,2.9,1.4c0,0,3.3,5.1,3.3,5.2c0,2.1-2,0.4-1.5,2.3  c0.1,0.5,3.2,0.4,4.6,0.5c3.5,0.4,4.1,6.8,5.8,8.2c0,0,1.3,0.1,1.3,0.1c0.9,0.5,2.2,1.7,2.9,2.4c1.3,1.2,0.7,3,1.4,4.3  c0.6,1.1,2.6,1.7,3.4,2.8c0.5,0.7,1.2,3.4,2,3.6c0.3,0.1,0.5-0.3,0.8-0.3c0.5,0.1,0.9,1.3,1.4,1.5c1.8,0.7,2.1-0.4,3.4,2.4  c0,0,0.6,1.8,0.6,1.8c0.6,0.6,3-1.6,4-1.4c1.2,0.2,2,1.7,3.2,1.9c1.1,0.2,2-1,3.2-0.4c1.8,1,3.3,5.1,4,6.9c0.1,0.3,0.5,1.8,0.8,2.6  c0-0.1,0-0.1,0-0.1c0.1-0.2,0.3-0.3,0.5-0.3c0.5,0,0.7,0.7,1.3,0.8c0.5,0,0.9-0.6,1.4-0.6c0.7,0.1,3.4,2.2,3.2,3  c-0.2,1-3,1.1-2.8,2.2c0,0.2,0.3,0.4,0.5,0.4c0.7,0,1.5-1.3,2.2-1.2c1.8,0.1,3-0.5,4.8-0.4c1.2,0.1,2.9,4.7,3.1,5.7  c0.2,1.5-2,1.8-1.5,3.4c0.3,1,2.7,1.2,3.4,1.6c1.5,0.8,2.3,4.3,4.3,4c1.3-0.2,2.2-4.7,4.5,0.1c0.3,0.7,1.2,1.9,1.3,2.6  c0.1,1.9-0.2,4.7,1,6.6c0.9,1.4,2,2.4,2.5,4.3c0.5,2.2,0,4.7,0.7,6.9c0.7,2.1,2.2,1.3,1.7,3.9c-0.8,3.9-3.9,1-6.1,3.1  c-1.1,1,1.3,2.4,0.6,4c-2.5,6-2.1,2.3-4.6,4.7c-0.6,0.5-0.4,6.1,1.6,6.6c8,2.2,5.2-4.1,10-7.4c1.3-0.9,3.3-0.8,3.9-2.6  c0.9-2.6-1.2-5.3,0.9-7.5c3.5-3.7,9-0.2,9.9-4.1c0-0.1-1.3-1.3-1.3-1.8c0-0.7,0.6-1.4,0.6-2c0-0.8-0.8-1.5-0.4-2.4  c0,0,0.9-1.7,0.9-1.7c-0.3-0.6-1.3-0.3-1.9-0.8c-1.3-1-2.8-3.2-4.4-4c-1.3-0.6-2.6,0.3-3.7-1.2c0-0.2,0.1-0.9,0-1  c-1.5-3.7,1.2-2.4,1.8-5.1c0.1-0.6-0.4-1.1-0.5-1.7c0-0.2,4.7-7.4,5.4-8c1.9-1.9,2.6-0.6,4.5-0.5c0.5,0,1.4-0.5,1.9-0.3  c0.6,0.3-2.2,1.1-1.9,1.7c0.2,0.5,2.6,1.6,3.1,1.8c1.4,0.5,7.8,1,8.2,2c0.1,0.3,0.1,1.5,0.2,1.7c0.2,0.6,1.1,0.7,1.3,1.4  c0,0.1-0.2,0.2-0.3,0.3c-0.2,0.2-0.6,0.4-0.5,0.7c0.1,0.3,0.7,0.1,0.8,0.4c0.6,1.3,0.4,3,2.8,4.2c3.9,1.9,2.7-0.5,3.5-3.4  c0.4-1.3,1.6-1.1,1.6-2.7C929.4,750.9,922.8,748.3,921.8,746.6"/>
                      <path data-border="bordnavarra" id="navarra"  fill="none" stroke="#A27A40" stroke-width="0" d="M641.574,657.049 641.522,656.535     641.464,656.372 641.409,656.229 641.263,656.069 641.216,656.053 641.135,656.022 641.016,656.022 640.625,656.125     640.385,656.122 640.384,656.121 640.38,656.121 639.688,655.979 639.368,655.89 639.058,655.758 638.981,655.722 638.98,655.723     638.949,655.722 638.712,655.729 638.659,655.732 638.383,655.692 638.375,655.685 637.817,655.257 637.7,655.018     637.278,654.495 637.032,654.427 636.563,654.299 636.557,654.294 636.35,654.113 636.217,654.003 636.054,653.756     635.797,653.351 635.615,653.294 635.615,653.294 635.476,653.458 635.281,653.586 635.272,653.577 635.188,653.483     635.127,653.081 635.016,652.939 635.002,652.936 634.797,652.853 634.757,652.835 634.565,652.698 634.416,652.591     634.339,652.535 634.29,652.446 634.246,652.201 634.161,652.107 634.135,652.1 634.081,652.083 633.751,652.121 633.75,652.122     633.666,652.089 633.495,652.019 633.491,652.016 633.26,651.753 632.86,651.435 632.752,651.268 632.928,650.97 633.151,650.708     633.125,650.651 633.141,650.607 633.18,650.488 633.345,650.399 633.376,650.312 633.3,650.254 633.294,650.254 632.707,650.355     632.542,650.437 632.364,650.744 631.999,651.696 631.827,651.87 631.746,651.953 631.646,652.007 631.167,651.789     631.038,651.717 630.973,651.679 630.655,651.502 630.399,651.229 630.094,650.806 629.995,650.38 630.01,650.057     630.363,649.971 630.808,649.757 630.951,649.678 631.183,649.445 631.444,648.991 631.48,648.741 631.59,648.468     631.637,648.428 631.998,648.141 632.04,648.063 632.167,647.834 632.248,647.363 632.343,647.196 632.381,646.943     632.359,646.691 632.347,646.667 632.29,646.537 632.148,646.326 632.01,646.263 632.002,646.262 631.623,646.19 631.307,646.205     631.275,646.19 631.167,646.139 631.063,646.037 630.714,645.471 630.705,645.457 630.621,645.425 630.561,645.399     630.542,645.393 629.936,645.283 629.82,645.306 629.624,645.618 629.425,645.821 629.107,645.912 628.768,645.836     628.766,645.835 628.677,645.78 628.54,645.694 628.448,645.585 628.461,645.216 628.56,644.794 628.614,644.693 628.626,644.54     628.623,644.44 628.52,644.343 628.514,644.341 627.951,644.187 627.577,644.137 627.45,644.118 627.443,644.117 627.148,644.187     627.111,644.191 627.107,644.192 626.953,644.227 626.94,644.231 626.706,644.347 626.675,644.362 626.509,644.266     626.344,644.332 625.992,644.242 625.898,644.307 625.821,644.357 625.697,644.505 625.566,644.632 625.482,644.797     625.454,645.001 625.454,645.001 625.453,645.002 625.343,645.16 625.184,645.236 625,645.328 624.876,645.455 624.802,645.473     624.694,645.496 624.55,645.423 624.534,645.415 624.409,645.507 624.372,645.538 624.265,645.551 624.19,645.561 624.19,645.561     624.189,645.561 624.212,645.395 624.201,645.218 624.023,645.191 623.95,645.24 623.855,645.303 623.826,645.476     623.848,645.573 623.875,645.671 623.726,645.643 623.641,645.627 623.573,645.587 623.536,645.564 623.497,645.524     623.448,645.474 623.405,645.221 623.342,645.207 623.295,645.446 623.234,645.632 623.232,645.632 623.232,645.632     623.112,645.766 623.016,645.904 623.007,645.918 622.96,646.098 622.941,646.314 622.916,646.421 622.864,646.646     622.946,646.979 623.025,647.138 622.959,647.313 622.943,647.343 622.876,647.462 622.759,647.484 622.707,647.495     622.427,647.788 622.403,647.817 622.309,647.937 622.308,647.937 622.307,647.937 622.134,647.927 622.069,647.942     621.974,647.969 621.878,647.971 621.773,647.978 621.715,647.951 621.616,647.904 621.571,647.925 621.464,647.974     621.237,648.168 621.185,648.213 621.016,648.252 620.839,648.199 620.78,648.246 620.703,648.309 620.611,648.369     620.53,648.421 620.489,648.584 620.381,648.723 620.344,648.883 620.305,648.913 620.029,649.107 619.956,649.199     619.925,649.243 619.909,649.289 619.87,649.41 619.942,649.578 619.908,649.74 619.909,649.741 619.909,649.741 619.907,649.745     619.852,649.906 619.801,649.997 619.766,650.063 619.436,650.218 619.273,650.164 618.749,650.125 618.489,650.406     618.395,650.562 618.33,650.616 618.261,650.674 618.154,650.729 618.106,650.756 617.994,650.723 617.945,650.709     617.859,650.702 617.729,650.69 617.553,650.593 617.197,650.633 617.179,650.621 617.05,650.533 616.945,650.402     616.943,650.402 616.943,650.402 616.941,650.381 616.904,650.222 616.764,650.081 616.734,650.093 616.576,650.148     616.548,650.32 616.547,650.32 616.546,650.321 616.464,650.361 616.232,650.472 616.115,650.594 616.002,651.094     615.874,651.177 615.853,651.19 615.853,651.19 615.851,651.192 615.613,651.262 615.614,651.277 615.663,651.635     615.599,651.807 615.639,652.021 615.62,652.122 615.61,652.191 615.638,652.398 615.641,652.419 615.641,652.419 615.641,652.42     615.561,652.612 615.46,652.691 615.43,652.716 615.331,652.854 615.185,652.968 615.155,652.975 614.851,653.049     614.727,653.355 614.426,653.808 614.447,654.018 614.423,654.191 614.466,654.287 614.494,654.345 614.491,654.346     614.493,654.346 614.297,654.656 614.22,654.72 614.165,654.767 614.163,654.768 614.163,654.769 614.066,654.752     613.996,654.739 613.916,654.745 613.815,654.753 613.677,654.648 613.513,654.607 613.402,654.758 613.339,654.914     613.382,655.072 613.409,655.129 613.462,655.229 613.376,655.406 613.323,655.77 613.34,655.934 613.341,655.954     613.268,656.111 613.256,656.134 613.34,656.155 613.367,656.164 613.43,656.161 613.494,656.156 613.607,656.113 613.61,656.493     613.6,656.58 613.588,656.677 613.586,656.678 613.419,656.712 613.295,656.705 613.234,656.703 613.071,656.73 612.993,656.754     612.879,656.792 612.799,656.892 612.767,656.933 612.598,656.964 612.483,656.908 612.448,656.892 612.279,656.867     612.099,656.898 612.099,656.898 612.004,656.736 612.014,656.659 612.025,656.551 611.998,656.448 611.98,656.382     611.872,656.251 611.552,656.073 611.365,656.127 611.263,656.183 611.202,656.216 610.854,656.318 610.712,656.425     610.619,656.612 610.619,656.612 610.619,656.612 610.518,656.626 610.446,656.638 610.297,656.724 610.276,656.736     610.276,656.736 610.251,656.74 610.113,656.764 610.082,656.78 609.947,656.855 609.841,656.869 609.779,656.876     609.719,657.055 609.704,657.099 609.694,657.175 609.682,657.266 609.843,657.581 610.011,657.55 610.135,657.669     610.194,657.779 610.306,657.985 610.488,657.945 610.645,657.862 610.654,657.84 610.715,657.683 610.837,657.563     610.909,657.46 610.954,657.396 611.103,657.522 611.257,657.59 611.311,657.754 611.264,657.935 611.258,657.997     611.247,658.104 611.312,658.313 611.313,658.376 611.313,658.485 611.278,658.573 611.249,658.645 611.247,658.644     611.247,658.644 611.228,658.661 611.12,658.749 611.061,658.924 610.983,659.041 610.944,659.099 610.944,659.145     610.946,659.276 610.87,659.427 610.811,659.602 610.778,659.649 610.706,659.754 610.628,659.83 610.58,659.88 610.424,659.963     609.916,659.892 609.664,659.645 609.537,659.696 609.228,659.823 609.344,659.833 609.411,659.902 609.444,659.935     609.534,660.17 609.603,660.269 609.651,660.301 609.712,660.341 610.061,660.421 610.073,660.423 610.074,660.424     610.208,660.536 610.274,660.59 610.388,660.618 610.524,660.601 610.728,660.641 610.758,660.646 610.878,660.641     610.969,660.678 610.99,660.685 611.19,660.859 611.343,661.068 611.411,661.16 611.457,661.188 611.514,661.224 611.564,661.222     611.635,661.218 611.718,661.114 611.689,660.989 611.719,660.873 611.72,660.873 611.72,660.873 611.821,660.955 612,661.142     612.071,661.215 612.16,661.23 612.423,661.271 612.497,661.372 612.509,661.473 612.512,661.508 612.513,661.51 612.546,661.63     612.653,661.672 612.656,661.671 612.77,661.627 612.982,661.748 612.982,661.75 612.982,661.75 613.029,661.813 613.058,661.853     613.122,661.947 613.122,661.947 613.123,661.95 613.142,662.07 613.131,662.188 613.145,662.224 613.176,662.303     613.396,662.408 613.428,662.46 613.532,662.625 613.559,662.636 613.646,662.667 613.715,662.67 613.778,662.667 613.86,662.752     613.865,662.758 614.006,662.959 614.109,663.04 614.243,663.028 614.457,662.934 614.457,662.934 614.519,662.989     614.555,663.024 614.669,663.073 614.699,663.068 614.789,663.052 614.937,663.076 615.021,663.089 615.109,663.088     615.148,663.09 615.148,663.09 615.196,663.258 615.101,663.323 615.047,663.362 614.973,663.515 615.004,663.686     615.155,663.764 615.253,663.912 615.289,664.01 615.317,664.075 615.395,664.191 615.418,664.227 615.399,664.401     615.303,664.514 615.269,664.554 615.19,664.706 615.241,664.812 615.268,664.869 615.454,664.869 615.527,664.882     615.617,664.896 615.784,664.872 615.967,664.589 616.183,664.57 616.215,664.567 616.237,664.571 616.364,664.593     616.468,664.66 616.505,664.673 616.691,664.73 616.817,664.817 616.983,664.992 616.984,664.995 617.109,665.239 617.15,665.352     617.124,665.466 617.167,665.492 617.238,665.538 617.421,665.585 617.523,665.68 617.583,665.776 617.612,665.882     617.619,665.908 617.793,665.902 617.809,665.9 617.894,666.126 617.894,666.126 617.895,666.128 617.916,666.257     617.887,666.371 617.88,666.385 617.823,666.47 617.821,666.484 617.809,666.587 617.965,666.798 617.995,666.817 618.073,666.86     618.12,666.925 618.15,666.961 618.262,666.99 618.263,666.989 618.276,666.997 618.375,667.053 618.415,667.125 618.444,667.172     618.405,667.413 618.39,667.453 618.366,667.519 618.258,667.646 618.195,667.723 618.174,667.838 618.206,667.988     618.311,668.027 618.44,668.02 618.554,667.961 618.677,667.937 619.051,668.341 619.067,668.379 619.094,668.447     619.082,668.566 619.128,668.68 619.142,668.685 619.234,668.722 619.471,668.659 619.518,668.766 619.519,668.767     619.595,668.875 619.625,668.962 619.637,668.992 619.771,669.001 619.879,669.027 619.937,669.067 619.961,669.084     619.962,669.089 620.087,669.4 620.224,669.433 620.365,669.466 620.544,669.473 620.609,669.56 620.649,669.613 620.781,669.722     620.782,669.722 620.784,669.729 620.845,669.887 620.821,670.06 620.964,670.176 620.967,670.258 620.97,670.354     620.969,670.354 620.966,670.358 620.825,670.452 620.774,670.629 620.729,670.793 620.756,670.901 620.773,670.956     620.874,671.075 620.878,671.082 620.879,671.083 620.767,671.201 620.763,671.206 620.597,671.258 620.254,671.305     620.108,671.19 620.108,671.191 620.096,671.147 620.064,671.026 619.944,670.905 619.795,670.798 619.717,670.78     619.615,670.757 619.281,670.863 619.194,670.877 619.097,670.891 618.954,670.822 618.947,670.817 618.945,670.816     618.844,670.672 618.763,670.515 618.416,670.458 618.277,670.564 618.254,670.692 618.246,670.733 618.228,670.766     618.158,670.893 617.998,670.986 617.978,670.995 617.822,671.047 617.765,671.079 617.666,671.14 617.276,671.471     617.153,671.532 617.114,671.553 617.061,671.586 616.772,671.77 616.683,671.89 616.672,671.907 616.62,672.075 616.569,672.245     616.54,672.462 616.506,672.504 616.435,672.598 616.497,672.966 616.578,673.007 616.655,673.046 616.654,673.046     616.731,673.214 616.91,673.327 616.963,673.391 617.016,673.456 617.098,673.688 617.098,673.688 617.1,673.689 617.314,673.701     617.501,674.021 617.702,673.965 617.881,674.018 618.026,674.114 618.18,674.167 618.351,674.169 618.608,674.392     618.702,674.572 618.769,674.743 618.803,674.924 619.028,675.196 619.202,675.264 619.484,675.519 619.664,675.545     619.829,675.444 620.211,675.365 620.323,675.519 620.727,675.825 620.834,675.952 620.943,676.102 620.963,676.276     621.001,676.435 621.318,676.847 621.469,676.925 621.597,677.047 621.75,677.105 622.251,677.189 622.597,677.04     622.768,677.033 623.074,677.188 623.197,677.321 623.342,677.406 623.516,677.426 623.655,677.537 623.831,677.597     623.929,677.74 624.085,677.662 624.24,677.306 624.379,677.202 624.544,677.195 624.737,677.138 624.81,676.966 624.788,676.758     624.977,676.735 625.109,676.593 625.171,676.384 625.268,676.22 625.802,675.754 625.95,675.648 626.068,675.503     626.405,675.385 626.499,675.218 626.604,675.077 626.703,674.87 626.714,674.688 626.62,674.528 626.471,674.451     626.291,674.466 626.138,674.386 626.004,674.273 625.894,673.897 625.938,673.736 625.864,673.394 625.741,673.275     625.642,673.136 625.561,672.96 625.587,672.79 625.684,672.645 625.73,672.488 625.72,672.306 625.748,672.125 625.868,671.996     625.881,671.793 625.916,671.611 625.821,671.279 625.722,671.139 625.681,670.922 625.723,670.761 625.736,670.588     625.833,670.441 625.993,670.314 626.209,670.004 626.35,669.687 626.439,669.541 626.485,669.362 626.573,669.205     626.561,669.033 626.665,668.906 626.805,668.799 626.933,668.667 627.255,668.474 627.331,668.308 627.679,668.158     628.014,667.982 628.092,667.789 628.087,667.625 628.008,667.45 627.841,667.419 627.829,667.253 627.84,667.08 627.962,666.948     628.004,666.767 628.29,666.274 628.424,666.134 628.494,665.959 628.627,665.852 628.946,665.694 629.109,665.633     629.272,665.586 629.442,665.61 629.613,665.498 629.75,665.37 629.793,665.189 629.871,665.038 629.74,664.507 629.73,664.333     630.041,663.911 630.175,663.795 630.408,663.536 630.575,663.511 630.696,663.629 630.908,663.903 631.24,663.809     631.409,663.831 631.504,663.685 631.453,663.521 631.521,663.363 631.649,663.224 632.149,662.997 632.32,663.029     632.66,663.014 632.678,662.145 632.769,661.979 632.955,661.922 633.109,661.974 633.244,662.093 633.404,662.134     633.573,662.16 633.952,662.169 634.076,662.307 634.25,662.33 634.38,662.443 634.55,662.387 634.736,662.362 634.801,662.033     634.932,661.932 635.021,661.764 634.992,661.597 635.017,661.418 635.114,661.265 635.287,661.24 635.63,661.273 635.79,661.335     635.981,661.287 636.152,661.332 636.51,661.289 636.675,661.234 636.836,661.152 637.072,660.887 637.221,660.785     637.434,660.77 637.567,660.787 637.704,660.679 637.745,660.518 637.861,660.377 638.023,660.33 638.146,660.478 638.32,660.542     638.447,660.439 638.796,660.022 638.792,659.85 638.711,659.689 638.78,659.533 638.953,659.474 638.981,659.3 638.955,659.112     638.952,658.929 639.035,658.779 639.072,658.599 639.235,658.5 639.531,658.278 639.691,658.2 639.961,657.969 639.912,657.786     639.912,657.786 639.954,657.625 640.031,657.466 640.211,657.449 640.365,657.375 640.533,657.368 640.698,657.308     640.838,657.199 641,657.248 641.181,657.255 641.309,657.356 641.464,657.43 641.537,657.45   "/>
                    </g>                    
                  </svg> 
                  <div id="paises" style="position:absolute;left:0px;top:0px">                    
                    <h2>LA EXPULSIÓN DE LOS JUDÍOS DURANTE LOS SIGLOS XII Y XV</h2>
                    <p class="descrip_map">Listado ordenado cronologicamente de las expulsiones mas importantes producidas
                          entre los siglos XII y XV en el Oeste de Europa:</p>
                    <div id="menu" style="background:transparent;position:absolute;left:116px;top:250px;z-index:9999!important">
                      <p class="link_map_jude" data-pais="francia">1182, Reino de Francia</p><div class="link_map_jude2"></div>            
                      <p class="link_map_jude" data-pais="inglaterra">1290, Reino de Inglaterra</p><div class="link_map_jude2"></div>
                      <p class="link_map_jude" data-pais="francia2">1306, 1321-2, 1394, Reino de Francia</p><div class="link_map_jude2"></div>                 
                      <p class="link_map_jude" data-pais="austria">1421, Archiducado de Austria</p><div class="link_map_jude2"></div>
                      <p class="link_map_jude" data-pais="milan">1490, Ducado de Milan</p><div class="link_map_jude2"></div>               
                      <p class="link_map_jude" data-pais="españa">1492, Corona de Castilla y Aragon</p><div class="link_map_jude2"></div>                     
                      <p class="link_map_jude" data-pais="portugal">1493, Reino de Portugal</p><div class="link_map_jude2"></div>                           
                      <p class="link_map_jude" data-pais="sicilia">1493, Reino de Sicilia</p><div class="link_map_jude2"></div>                         
                      <p class="link_map_jude" data-pais="navarra">1498, Reino de Navarra</p><div class="link_map_jude2"></div>
                    </div>
                  </div>                  
                </div>
                </div>
              </div>    
          </div>
        </div>   
      </article>

      <article id="extra-granada-isabel" class="element extra hidden">
      
        <div class="device">

          <a class="arrow-left" href="#"></a> 
          <a class="arrow-right" href="#"></a>
          <a class="arrow-close" href="#" title="Pulsa para cerrar el especial"></a>

          <div class="swiper-container">

            <div class="swiper-wrapper">

              <div class="swiper-slide wraperVideo" data-slide="1" data-titulo="Video" data-callbackin="videoIntroExtraIN" data-callbackout="videoIntroExtraOUT">
                <div class="wrap-table" style="width: 100%">
                  <div class="wrap-table-cell">
                    <div class="video-wrap" data-filename="e10-nueva-granada"></div>
                  </div>
                </div>
              </div>

              <div id="extra-granada-isabel-paso-1" class="swiper-slide" data-slide="2" data-titulo="La Granada de Isabel">

                <div class="content-slide">           
                  <div class="cuadro-wrap">

                    <div class="title">
                      <div class="title-wrap">
                        <h1>La Granada de Isabel</h1>
                        <p>Granada se convirtió para Isabel la Católica en el símbolo de su reinado y, por ello, quiso cristianizarla conservando su grandeza. Descubre las claves de la Granada isabelina pinchando en los puntos clave de este mapa de Granada trazado por el arquitecto Ambrosio de Vico en 1613.</p>
                      </div>
                    </div> 

                    <img title="Mueve el ratón sobre los puntos para mayor información" 
                        alt="cuadro 'Plano de Granda en 1975'" src="/serie-isabel/conquista-de-granada/img/granada-isabel/plano_de_granada.jpg">

                    <div id="granada-v1" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Baños arabes</h2>
                        <p>La reina Isabel acaba con buena parte de los usos y costumbres de la Granada nazarí. Una de las medidas que tomó fue cerrar los baños árabes. Muchos de ellos se transforman en panaderías aprovechando sus hornos.</p>

                        <div class="video-wrap" data-filename="e10_mapa_10" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v2" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Albaicín</h2>
                        <p>El barrio del Albaicín es el que mejor conserva la herencia de la Granada musulmana medieval porque, al estar en alto, se fue retrasando su cristianización. Eso sí, la reina Isabel convirtió en convento el palacio en el que se refugió la reina Aixa al ser desplazada por Zorayda en la Alhambra.</p>
                        <div class="video-wrap" data-filename="e10_mapa_09" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v3" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Palacio de Carlos V</h2>
                        <p>Carlos V queda enamorado de Granada durante su viaje de novios con Isabel de Portugal y, como homenaje a la ciudad, construye un palacio renacentista dentro del recinto, aunque no se puede ver desde el exterior.</p>
                        <div class="video-wrap" data-filename="e10_mapa_11" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v4" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>La Alhambra</h2>
                        <p>Los Reyes Católicos hicieron alcaides de la Alhambra a los condes de Tendilla, cuyos descendientes serán los responsables del palacio hasta la Guerra de Sucesión, en el siglo XVIII. Tras esta fecha, Felipe V deja que el palacio lo ocupen varias familias, hasta que el escritor estadounidense Washington Irving populariza el monumento en el siglo XIX.</p>
                        <div class="video-wrap" data-filename="e10_mapa_12" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v5" class="pop pop-right"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Parador</h2>
                        <p>Isabel fue enterrada en un primer momento en un antiguo palacio nazarí que ella misma convirtó en convento franciscano tras la guerra. Ahora, el edificio alberga el parador nacional de Granada.</p>
                        <div class="video-wrap" data-filename="e10_mapa_13" data-controls="true"></div>
                      </div>
                    </div> 

                    <div id="granada-v6" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Hospital Real</h2>
                        <p>La preocupación por la gran cantidad de heridos durante las contiendas hizo a Isabel habilitar hospitales de campaña. Al llegar a Granada, levanta un centro hospitalario fuera del recinto amurallado, aunque murió antes de que empezaran las obras y fue Carlos I quien lo concluyó.</p>                     
                        <div class="video-wrap" data-filename="e10_mapa_08" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v7" class="pop"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Puerta de Elvira</h2>
                        <p>Al llegar los Reyes Católicos, Granada tenía 10 puertas de las que solo se conservan 4. La más importante es la puerta de Elvira, que proporcionaba uno de los accesos principales a la ciudad. Con todo, la entrada de los monarcas no fue por esta puerta sino que se hizo en secreto para evitar disturbios en la ciudad.
                        </p>
                        <div class="video-wrap" data-filename="e10_mapa_07" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v8" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Monumento a Colón</h2>
                        <p>En Granada, Isabel proporciona los recursos económicos necesarios a Colón para explorar la futura América. Una escultura de Mariano Benlliure en la plaza de Isabel la Católica, en Granada, recuerda el acontecimiento.</p>
                        <div class="video-wrap" data-filename="e10_mapa_02" data-controls="true"></div>
                      </div>
                    </div> 

                    <div id="granada-v9" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Madraza</h2>
                        <p>La escuela coránica o madraza fue la primera universidad con la que contó Granada. Fundad en 1349 por el rey Yusuf I, al acabar la guerra fue  transformada por Isabel en el primer ayuntamiento de la ciudad. En el edificio se han conservado los relieves árabes del oratorio y la primera sala de juntas.</p>
                        <div class="video-wrap" data-filename="e10_mapa_06" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v10" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Capilla Real</h2>
                        <p>Isabel quiere ser enterrada en Granada y manda construir una austera capilla anexa a la catedral pero muere antes de que se termine. Su nieto, Carlos I, contradice sus deseos y levanta la mayor capilla mortuoria de España. Además de Isabel, que muere en 1502, en ella están su esposo Fernando, su hija Juana y su yerno Felipe el Hermoso, padres de Carlos I.</p>
                        <div class="video-wrap" data-filename="e10_mapa_04" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v11" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Colección de Isabel</h2>
                        <p>Isabel es considerada como la primera gran coleccionista de arte. En el museo anexo a la capilla real mortuoria se encuentra una de la colecciones más importantes de pintura flamenca.</p>
                        <div class="video-wrap" data-filename="e10_mapa_05" data-controls="true"></div>
                      </div>
                    </div>

                    <div id="granada-v12" class="pop pop-top"><div class="pop-num ft-gothic">?</div>
                      <div class="pop-inn">
                        <h2>Centro Ciudad</h2>
                        <p>Tras la toma de Granada, Isabel inicia su transformación y modernización de la misma empezando por el centro. Sus dos primeros proyectos fueron la construcción de una catedral y de un tribunal de justicia. La importancia de Granada para Isabel es tan grande que incorpora a su escudo la granada, símbolo de la ciudad.</p>
                        <div class="video-wrap" data-filename="e10_mapa_03" data-controls="true"></div>
                      </div>
                    </div> 

                    <div id="granada-v13" class="pop pop-top"><div class="pop-num ft-gothic">?</div>

                      <div class="pop-inn">
                        <h2>Ayuntamiento</h2>
                        <p>Isabel forma en Granada el primer cabildo, origen de los ayuntamientos actuales. Estaba formado por 24 caballeros; seis de la corona, seis de la iglesia, seis del ejército y seis representantes de la ciudad.</p>
                        <div class="video-wrap" data-filename="e10_mapa_01" data-controls="true"></div>
                      </div>
                    </div>

                  </div>

                      <div class="cuadro-info-butt">
                        <div class="cuadro-info">
                          <div class="cuadro-info-wrap">
                            Plano de Granada en 1975<br>
                            <span><strong>Felix Prieto</strong> lo grabó en Salamanca</span>
                          </div> 
                        </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>       
      </article> 

      <article id="creditos" class="element batalla opacity hidden">

        <div class="wrap-table">
          <div class="wrap-table-cell">
            <h2>La conquista de Granada</h2>
            <p>Locución: <strong>Michelle Jenner</strong> y <strong>Alex Martínez</strong></p> 
            <p>Guión: <strong>Alberto Fernandez</strong> y <strong>Miriam Hernanz</strong></p>
            <p>Realización: <strong>Miguel Campos</strong> y <strong>César Vallejo</strong></p>
            <p>Diseño: <strong>Ismael Recio</strong></p> 
            <p>Desarrollo: <strong>Departamento técnico Lab RTVE.es</strong></p>
            <p>Ilustración / Animación: <strong>Ben Kovar / Vectorsoul</strong></p>
            <p>Ambientación musical: <strong>Noelia Romero</strong></p> 
            <p>Posproducción de sonido: <strong>Curro Escribano</strong></p>
            <p>Coordinación: <strong>Charo Marcos</strong></p>
            <p>Producción Ejecutiva RTVE: <strong>Ricardo Villa</strong></p>
            <p>Producción Ejecutiva TVE: <strong>Nicolás Romero</strong></p>            


            <br>
            <p>Con la colaboración de los historiadores <strong>Mabel Villagra</strong> y <strong>José Enrique Villuendas</strong> y de <strong>Paloma G. Quirós</strong>.</p>
            <br>
            <p>Agradecimientos:</p> 
            <p><strong>Museo del Ejercito</strong> - <strong>Museo Nacional del Prado</strong></p>
            <p><strong>Museo Nacional de Arte de Cataluña</strong> - <strong>Centro de Interpretacion de la Juderia de Sevilla</strong></p> 
            <p><strong>Diputación de Granada</strong> - <strong>Universidad de Barcelona</strong></p> 
            <p>A los guías de Granada: <strong>Gustavo Fernández</strong> y a <strong>Mª Angustias García Valedecasas (Cicerone)</strong></p>
          </div>
        </div>
      
      </article>

      <nav class="menu-main">
        <div class="menu-main-wrap">
          <div class="menu-left">

            <div class="menu-bando">
              <a href="#" class="bando-cristiano act" title="Navega las batallas desde la experiencia de Isabel">Castellano</a>
              <a href="#" class="bando-nazari" title="Navega las batallas desde la experiencia de Boabdil">Nazarí</a>
            </div>

            <div class="wrap-table">
              <ul class="menu-anyos">
                <h3 class="titulo">Batallas</h3>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/toma-zahara" data-nav="toma-zahara" id="nav-toma-zahara-1481" class="anyo act" title="Ir a la toma de Zahara">Zahara<span>1481</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/batalla-alhama" data-nav="batalla-alhama" id="nav-batalla-alhama-1482" class="anyo" title="Ir a la batalla de Alhama">Alhama<span>1482</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/batalla-lucena" data-nav="batalla-lucena" id="nav-batalla-lucena-1483" class="anyo" title="Ir a la batalla de Lucena">Lucena<span>1483</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/batalla-alora" data-nav="batalla-alora" id="nav-batalla-alora-1484" class="anyo" title="Ir a la batalla de Álora">Álora<span>1484</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/sitio-ronda" data-nav="sitio-ronda" id="nav-sitio-ronda-1485" class="anyo" title="Ir al sitio de Ronda">Ronda<span>1485</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/batalla-loja" data-nav="batalla-loja" id="nav-batalla-loja-1486" class="anyo" title="Ir a la batalla de Loja">Loja<span>1486</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/sitio-malaga" data-nav="sitio-malaga" id="nav-sitio-malaga-1487" class="anyo" title="Ir al Sitio de Málaga">Málaga<span>1487</span></a></li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/toma-baza" data-nav="toma-baza" id="nav-sitio-baza-1488" class="anyo" title="Ir a la toma de Baza">Baza<span>1488-1489</span></a> </li>
                <li><a href="/serie-isabel/conquista-de-granada/batalla/toma-granada" data-nav="toma-granada" id="nav-sitio-granada-1491" class="anyo" title="Ir a la toma de Granada">Granada<span>1491-1492</span></a></li>        
              </ul>   
            </div>     
          </div>

          <div class="menu-right">
            <div class="wrap-table">
              <ul class="menu-batallas">
                <h3 class="titulo">Monográficos</h3>
                <li><a href="/serie-isabel/conquista-de-granada/extra/reconquista" id="nav-extra-reconquista" data-nav="extra-reconquista" class="batalla" title="Visita el especial de la Reconquista">La Reconquista</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/inquisicion" id="nav-toma-zahara" data-nav="toma-zahara-extra-inquisicion" class="batalla" title="Visita el especial de la inquisición">Inquisición</a></li>
                <li class="menu-right-salto"><a href="/serie-isabel/conquista-de-granada/extra/nobleza" data-nav="batalla-alhama-extra-reestructuracion-nobleza" id="nav-batalla-alhama" class="batalla" title="Visita el especial de la Reestructuración de la nobleza">Reestructuración de la nobleza</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/principe" id="nav-batalla-lucena" data-nav="batalla-lucena-extra-principe-moderno" class="batalla" title="Visita el especial del príncipe moderno">El príncipe moderno</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/artilleria" id="nav-batalla-alora" data-nav="batalla-alora-extra-artilleria" class="batalla" title="Visita el especial de la Artillería">Artillería</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/iglesia" id="nav-sitio-ronda" data-nav="sitio-ronda-extra-relaciones-iglesia" class="batalla" title="Visita el especial de las relaciones con la iglesia">Las relaciones con la iglesia</a></li>
                <li class="menu-right-salto"><a href="/serie-isabel/conquista-de-granada/extra/isabel" data-nav="batalla-loja-extra-papel-isabel" id="nav-batalla-loja" class="batalla" title="Visita el especial del papel de isabel en la guerra">El papel de isabel en la guerra</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/sitio" id="nav-sitio-malaga" data-nav="sitio-malaga-extra-estado-sitio" class="batalla" title="Visita el especial del estado de sitio">Estado de sitio</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/perdedores" id="toma-baza-perdedores" data-nav="toma-baza-perdedores" class="batalla" title="Visita el especial del destino perdedores">Destino perdedores</a> </li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/expulsion-de-los-judios" id="nav-sitio-granada" data-nav="toma-granada-extra-judios" class="batalla" title="Visita el especial de la expulsión de los judíos">Expulsión de los judíos</a></li>
                <li><a href="/serie-isabel/conquista-de-granada/extra/granada-isabel" id="nav-extra-granada-isabel" data-nav="extra-granada-isabel" class="batalla" title="Visita el especial de la Granada de Isabel">La Granada de Isabel</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="menu-touch">
          <ul>
            <li class="menu-tc-social"><a title="comparte el proyecto en twitter" target="_blank" id="menu-tw"
                href="https://twitter.com/intent/tweet?button_hashtag=lab_rtvees&amp;via=lab_rtvees&amp;text=Repasa los últimos proyectos del Laboratorio de RTVE.es http://lab.rtve.es/" data-lang="es" data-related="lab_rtvees" data-url="http://lab.rtve.es/" via="lab_rtvees">tw</a></li>
            <li class="menu-tc-social"><a id="menu-fb" href="http://www.facebook.com/sharer.php?u=http://lab.rtve.es/"  title="comparte el proyecto en Facebook" target="_blank">fb</a></li>
            <li style="clear: left"><a href="#" class="active ft-gothic" href="/serie-isabel/conquista-de-granada/" id="click-help" title="Mostrar la ayuda">?</a></li>
            <li><a href="#" id="menu-expand">expande</a></li>
          </ul>
        </div>

      </nav>
    </section>

    <div id="help2" class="help">
      <a href="#" class="click-close" title="Oculta la ayuda">Oculta la ayuda</a>
      <div class="wrap-table">
        <div class="wrap-table-cell">
          <h1>La conquista de Granada</h1>
          <p class="subtitle">Revive las batallas de la mano de sus protagonistas</p>
          <div class="character-select">
            <a href="#" class="click-bando click-bando-cristiano" title="Selecciona a Isabel para que te cuente la Conquista de Granada">Isabel I,<br>reina de Castilla</a>
            <div class="char-sel-mid">Elige entre el bando cristiano o<br>musulmán para adentrarte en el final<br>de la Reconquista.</div>
            <a href="#" class="click-bando click-bando-arabe" title="Selecciona a Boabdil para que te cuente la Conquista de Granada">Boabdil, <br>rey de Granada</a>
          </div>
        </div>
      </div>
      <div class="help-bottom">Para navegar simplemente haz scroll <br>o muévete con las flechas de tu cursor</div>
      <div class="help-right">Para profundizar en la historia y conocer los<br>hechos puedes consultar los monográficos que <br>encontrarás en el menú lateral</div>
    </div>

  </aside>


  <footer id="lab-footer" class="lab-footer-fixed">
    <ul>
      <li><a class="go-link" href="/serie-isabel/conquista-de-granada/extra/creditos" data-id="creditos" title="Visita el créditos del proyecto">CRÉDITOS DEL WEBDOC</a></li>
      <li>. Copyright 2013 RTVE.es</li>
      <li>· <a href="https://twitter.com/lab_rtvees">SÍGUENOS EN TWITTER</a></li>
    </ul>
  </footer>
  <script>
    if(responsif) document.write('<!--');
  </script>
  <script><?php echo 'var conqData = {"url":"'.$seoData->url.'", "data": '.$filecont.', "act":'.$slideActive.'}'; ?></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/serie-isabel/conquista-de-granada/js/jquery-1.10.1.min.js"><\/script>')</script>
  <script type="text/javascript" src="/serie-isabel/conquista-de-granada/js/libs.js"></script>
  <script type="text/javascript" src="/serie-isabel/conquista-de-granada/js/base.js"></script>
  <script type="text/javascript" src="/serie-isabel/conquista-de-granada/js/raphael.js"></script>

</body>
</html>


 

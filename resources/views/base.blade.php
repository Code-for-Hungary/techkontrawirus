<!doctype html>
<html lang="{{ app()->getLocale() }}" data-crsf_token="{{ csrf_token() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (!empty($noindex))
        <meta name="robots" content="noindex">
    @endif

    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:url" content="https://tkv.code4.hu" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Tech Kontra Vírus" />
    <meta property="og:description" content="Tegyél a koronavírus ellen! Van egy ötleted, milyen informatikai alkalmazásra lenne szükség? Írd meg! Tudod, hogy lehetne megvalósítani? Javasolj fejlesztési megoldást, használj fel és fejlessz tovább már létező alkalmazásokat!" />
    <meta property="og:image" content="https://tkv.code4.hu/img/otletdoboz.png" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>

    <title>@yield('title')</title>
    @yield('meta-description')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body id="body">
    <div class="page">
        <div id="header" class="header">
            <div class="container d-flex justify-content-between">
                <div>
                    <p class="brand"><a href="/"><span class="icon-shield"></span> Tech Kontra Vírus</a></p>
                </div>
                <div class="d-flex align-items-center font-larger">
                    <a href="#" v-b-modal.faq><b>Gyakran ismételt kérdések</b></a>
                </div>
            </div>

            <div class="d-none">
                <b-modal id="faq" size="xl" title="Gyakran ismételt kérdések" ok-only>
                    <p><b>1. Hogyan működik?</b></p>
                    <p>Olyan ötleteket gyűjtünk össze, amiket fejlesztők és programozók képesek megvalósítani. Nem vagy benne biztos, hogy jó az ötleted? Írd meg, majd közösen eldöntjük! Ugyanakkor vedd komolyan és ne szemetelj haszontalan, életszerűtlen vagy bagatell ötletekkel. Ha értesz a programozáshoz, kapcsolódj be a beszélgetésbe, értékelj és <a href="https://docs.google.com/forms/d/e/1FAIpQLSeep6bUaI0nC-ZelkPjdUdw_kvzAJu2XJc8qpNhAJeIRSyZEA/viewform" target="new">csatlakozz ezen a formon</a> az ötletek kidolgozásához. Ha úgy érzitek, hogy készen áll egy ötlet a megvalósítására, folytassátok a <a href="https://codeforhungary.slack.com">Code for Hungary slacken</a>.</p>
                    <p class="mt-4"><b>2. Szükségem van valamire, de nincs konkrét ötletem. Mit tegyek?</b></p>
                    <p>Valamilyen problémára keresel megoldást, de még nincs kiforrott ötleted? Írd körül, hogy mire lenne szükség a probléma kezeléséhez és találjuk ki közösen a következő lépéseket!</p>
                    <p class="mt-4"><b>3. Hogyan értékeljük az ötleteket?</b></p>
                    <p>Kattints az ötlet neve mellett a pluszra, ha tetszik és a mínuszra, ha nem tartod jónak. Egy ötletre mindenkinek egy szavazata van. Így a platformot használók egész közössége által értékelődnek az ötletek. Ezen túl ott vannak a hozzászólások, ahol részletesebben kifejtheted a véleményed. Természetesen bárki saját maga is elkezdhet dolgozni egy-egy ötleten az értékelésektől függetlenül.</p>
                    <p class="mt-4"><b>4. Hogyan jutnak el az ötletek fejlesztőkhöz?</b></p>
                    <p>Igyekszünk minél több fejlesztőhöz eljuttatni az oldalt, hogy kövessék az ötleteket. Ha ismersz olyan embereket, csoportokat, akik szívesen segítenének, szólj nekik, juttasd el az oldalt hozzájuk!</p>
                    <p class="mt-4"><b>5. Milyen sorrendben jelennek meg az ötletek az oldalon?</b></p>
                    <p>A legtöbb pozitív értékelést kapott ötlet jelenik meg legfelül.</p>
                    <p class="mt-4"><b>6. Mik az oldal használatának szabályai?</b></p>
                    <ol>
                        <li>Új ötlet megírásakor légy figyelemmel a jogi környezetre (pl. adatvédelem) és az esetleges rendkívüli szabályokra.</li>
                        <li>Gondold át, hogy az ötleted nem okozhat-e problémát, károkat másoknak, és hogy milyen nem tervezett hatásai lehetnek.</li>
                        <li>Törekedj rá, hogy a fejlesztés nyílt forráskódú és ingyenes eszközökkel megvalósítható legyen.</li>
                        <li>A hozzászólásokat nem moderáljuk, de fenntartjuk a jogot a sértő és gyűlöletkeltő tartalom eltávolítására. A kereskedelmi tartalommal rendelkező üzeneteket eltávolítjuk.</li>
                    </ol>
                    <p class="mt-4"><b>8. Más, társadalmilag hasznos ötletem/technológiai igényem van. Mit tehetek?</b></p>
                    <p><a href="mailto:juhasz.attila@k-monitor.hu">Írj nekünk</a> és meglátjuk. Korlátosak a kapacitásaink, egy kört szívesen futunk új ötletekről.<br>
                    Vagy megpróbálhatsz fejlesztői támogatást szerezni az alábbi oldalakon:
                    <ol>
                        <li><a href="https://www.donatecode.com/">donatecode</a>
                        <li><a href="https://www.coding4good.net/about">Coding for Good</a>
                        <li><a href="https://app.code4socialgood.org/">Coding for Social Good</a>
                        <li><a href="https://socialcoder.org/Home/Index">Social Coder</a>
                    </p>
                    <p class="mt-4"><b>8. Ki az oldal üzemeltetője?</b></p>
                    <p>Az oldalt a Code for Hungary koordinátora, a <a href="https://k-monitor.hu">K-Monitor</a> üzemelteti. A Code for Hungary egy aktivistákból és önkéntes programozókból szerveződő közösség. A Code for All mozgalom tagjaként magyarországi társadalmi kezdeményezéseknek kívánunk technológiai segítséget nyújtani és ezáltal társadalmilag hasznos alkalmazások, programok létrehozását serkenteni. A K-Monitor egy korrupcióellenes civil szervezet, hisszük, hogy a korrupció legjobb ellenszere az átláthatóság és a társadalmi részvétel.<br>Az oldal lengyel változatát, a <a href="https://techkontrawirus.pl/">techkontrawirus.pl</a>-t a <a href="https://codeforpoland.org/about/">Code for Poland</a>ot koordináló <a href="https://epf.org.pl/en/">ePaństwo Foundation</a> készítette.</p>
                    <p class="text-center mt-4">
                        <img src="/img/kmonitor.png" class="svg" width="311" height="97" alt="K-Monitor">
                    </p>
                </b-modal>
            </div>
        </div>

        <div id="content-wrapper">
            @yield('content')
        </div>
    </div>
    <footer id="footer" class="d-flex flex-row justify-content-center align-items-center">
        <cookie-law button-text="OK">
            <div slot="message">
                Az oldal sütiket használ, hogy emlékezzen a felhasználók korábbi választásaira és lehtővé tegye a forgalmi adatok elemzését.
                Ha nem értesz egyet, változtasd meg a böngésződ a süti beállításait.

            </div>
        </cookie-law>
        <span class="mr-2">&copy; 2020</span>
        <a href="https://epf.org.pl"><img src="/img/logo-epanstwo.svgz" class="d-block ml-2" width="124" height="42" alt="Fundacja ePanstwo"></a>
        <a href="https://k-monitor.hu/"><img src="/img/kmonitor-sm.png" class="d-block ml-2" width="154" height="42" alt="K-Monitor"></a>
        <a href="https://k-monitor.hu/tevekenysegek/20200401-code-for-hungary"><img src="/img/c4hu_logo.png" class="d-block ml-2" width="66" height="42" alt="Code 4 Hungary"></a>
        <a href="https://kodujdlapolski.pl/o-nas/"><img src="/img/logo-kdp.png" class="d-block ml-2" width="91" height="42" alt="Koduj dla Polski"></a>
    </footer>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>

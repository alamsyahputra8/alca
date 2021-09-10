<?PHP 
$getSiteData    = $this->query->getData('configsite','*',"");
$site           = array_shift($getSiteData); 

$urlmenuact     = str_replace('page/','',$this->uri->uri_string());
$qSEO           = "select meta_desc,meta_key,menu,id_menu from menu_site where link='$urlmenuact'";
$getMetaSEO     = $this->query->getDatabyQ($qSEO);
$dataSEO        = array_shift($getMetaSEO);
if ($dataSEO['id_menu']==1) {
    $menutitle = '';
} else {
    if ($dataSEO['menu']!='') {
        $menutitle = $dataSEO['menu'].' | ';
    } else {
        $menutitle = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <meta name="description"content="<?PHP echo $dataSEO['meta_desc']; ?>">
    <meta name="keywords"content="<?PHP echo $dataSEO['meta_key']; ?>">
    <meta name="author" content="Parwatha" />
    <meta property="og:title" content="<?PHP echo $site['name_site']; ?>">
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?PHP echo $dataSEO['meta_desc']; ?>">
    <meta property="og:url" content="<?PHP echo base_url(); ?>">
    <meta property="og:image" content="<?PHP echo base_url().'images/'.$site['logo']; ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <!-- <meta property="fb:app_id" content=""> -->

    <!-- Document title -->
    <title><?PHP echo $menutitle; ?><?PHP echo $site['name_site']; ?></title>
    
    <!-- Facebook Pixel Code -->
    <!-- <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1066763796799012');
      fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1066763796799012&ev=PageView&noscript=1"/>
    </noscript> -->
    <!-- End Facebook Pixel Code -->

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '274255490491126'); 
        fbq('track', 'PageView');
    </script>
    <noscript>
         <img height="1" width="1" src="https://www.facebook.com/tr?id=274255490491126&ev=PageView &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Stylesheets & Fonts --><link href="<?PHP echo base_url(); ?>assets/polo/css/plugins.css" rel="stylesheet">
    <link href="<?PHP echo base_url(); ?>assets/polo/css/style.css" rel="stylesheet">
    <link href="<?PHP echo base_url(); ?>assets/polo/css/responsive.css" rel="stylesheet">
    <link href="<?PHP echo base_url(); ?>assets/polo/css/pageloader.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="<?PHP echo base_url(); ?>images/<?PHP echo $site['favicon']; ?>" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?PHP echo base_url(); ?>images/<?PHP echo $site['favicon']; ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?PHP echo base_url(); ?>images/<?PHP echo $site['favicon']; ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?PHP echo base_url(); ?>images/<?PHP echo $site['favicon']; ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?PHP echo base_url(); ?>images/<?PHP echo $site['favicon']; ?>">

    <!-- LOAD JQUERY LIBRARY -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
    
    <!-- LOADING FONTS AND ICONS -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:500%2C400%2C700" rel="stylesheet" property="stylesheet" type="text/css" media="all">
    
    <link rel="stylesheet" type="text/css" href="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/fonts/font-awesome/css/font-awesome.css">
    
    <!-- REVOLUTION STYLE SHEETS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/css/settings.css"> -->
    
    
    
    <style type="text/css">.tiny_bullet_slider .tp-bullet:before{content:" ";  position:absolute;  width:100%;  height:25px;  top:-12px;  left:0px;  background:transparent}</style>
    <style type="text/css">.bullet-bar.tp-bullets{}.bullet-bar.tp-bullets:before{content:" ";position:absolute;width:100%;height:100%;background:transparent;padding:10px;margin-left:-10px;margin-top:-10px;box-sizing:content-box}.bullet-bar .tp-bullet{width:60px;height:3px;position:absolute;background:#aaa;  background:rgba(204,204,204,0.5);cursor:pointer;box-sizing:content-box}.bullet-bar .tp-bullet:hover,.bullet-bar .tp-bullet.selected{background:rgba(204,204,204,1)}.bullet-bar .tp-bullet-image{}.bullet-bar .tp-bullet-title{}</style>
    
    <!-- REVOLUTION JS FILES -->
    <!-- <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script> -->
    
    <!-- SLICEY ADD-ON FILES -->
    <!-- <script type='text/javascript' src='<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/revolution-addons/slicey/js/revolution.addon.slicey.min.js?ver=1.0.0'></script> -->

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->    
    <!-- <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/polo/js/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script> -->

    <style>
    /*section { background: #429ed6 url('<?PHP echo base_url(); ?>images/divider.png') repeat-x center bottom; }*/
    section { 
        background: #FFF;
        padding: 0px 0px;
        /*border-bottom: 1px solid #f4f4f4;*/
    }
    .no-border {
        border: none!important;
        background: #FFF!important;
    }
    .background-dark {
        background-color: #333!important;
    }
    .heading-text.heading-section > h2 {
        font-size: 21px!important;
        background: #efefef;
        line-height: 40px;
        margin-bottom: 0px!important;
    }
    .heading-text {
        margin-bottom: 20px;
    }
    .heading-text.heading-section > h2:before {
        content: "";
        display: none!important;
        position: absolute;
        height: 2px;
        width: 100px;
        background-color: #FFF;
        bottom: -30px;
        left: 0;
        right: 0;
    }
    .background-overlay-dark:before {
        background: rgba(0, 0, 0, 0.6)!important;
    }
    @media (max-width: 991px) {
        #sarangvisuel #logo {
            text-align: left!important;
        }
        #header .header-extras {float: right!important;}
        #header .header-extras li { line-height: 70px!important; }
        #header #mainMenu:not(.menu-overlay) nav > ul > li.mega-menu-item .mega-menu-content .mega-menu-title {
            padding-top: 12px;
            padding-bottom: 12px;
            color: #FFF;
        }
    }
    #header .header-inner #logo a > img {
	    max-height: 100px;
        height: 100px;
	    margin-top: 15px;
    }
    .inspiro-slider .slide-captions .strong::after {
    	border: none!important;
    }
    .kenburns-bg.kenburns-bg-animate {
    	transform: scale(1);
    }
    .heading-text.heading-section > h2 {
    	font-size: 38px;
    }
    .product .product-price del {
        margin: 0px 0 -4px;
    }
    .owl-carousel.arrows-large .owl-nav [class*="owl-"] i {
        line-height: 38px;
        font-size: 28px;
    }
    .owl-carousel.arrows-large .owl-nav [class*="owl-"] {
        width: 38px;
        height: 38px;
        line-height: 38px;
    }

    /* Make the container relative */
    .swap-on-hover {
      position: relative;   
        margin:  0 auto;
        max-width: 400px;
    }

    /* Select the image and make it absolute to the container */
    .swap-on-hover img {
      position: absolute;
      top:0;
      left:0;
        overflow: hidden;
        /* Sets the width and height for the images*/
        width: 400px;
        height: 400px;
    }

    /* 
        We set z-index to be higher than the back image, so it's alwyas on the front.

    We give it an opacity leaner to .25s, that way when we hover we will get a nice fading effect. 
    */
    .swap-on-hover .swap-on-hover__front-image {
      z-index: 9999;
      transition: opacity .5s linear;
      cursor: pointer;
    }

    /* When we hover the figure element, the block with .swap-on-hover, we want to use > so the front-image is going to have opacity of 0, which means it will be hidden, to the back image will show */
    .swap-on-hover:hover > .swap-on-hover__front-image{
      opacity: 0;
    }
    @media (max-width: 480px) {
        .grid-4-columns .grid-item {
            width: 50%;
        }
        .portfolio-3-columns .portfolio-item {
            width: 33.333333333%;
        }
        .portfolio-3-columns .portfolio-item.large-width {
            width: 66.6666666666%;  
        }
        .portfolio-4-columns .portfolio-item { width: 25%; }
        .product {margin-bottom: 0px;}
        .product-size {margin:0 0px 0px 0;}
        .header-extras > ul .p-dropdown > a > i, .header-extras > ul > li > a > i {
            font-size: 24px !important;
        }
        .header-extras #shopping-cart {
            position: relative;
            margin-right: 15px;
            margin-top: 1px;
        }
    }
    .product .product-title h3, .product .product-title h3 a {
        white-space: nowrap;
        overflow: hidden;
    }
    </style>
</head>

<body id="sarangvisuel">
    <!-- Body Inner -->    
    <div class="body-inner">
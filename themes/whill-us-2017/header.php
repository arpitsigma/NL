<!doctype html>
<html lang="en" class="no-webp">
<head>
	<script defer src="<?= get_template_directory_uri() ?>/assets/dist/scripts/scripts2021.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, user-scalable=yes">
    <meta name="google-site-verification" content="LV-UwqJiVwF6lU0BKea3RR6kdc3XmK4mWSoksqVTofw" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <?php if(is_front_page()):?>
        <link rel="alternate" hreflang="en" href="https://whill.inc/us/" />
        <link rel="alternate" hreflang="ja" href="https://whill.inc/jp/" />
    <?php endif;?>
    <?php get_template_part( 'check_support_webp'); ?>
    <?php get_template_part( 'fonts-com'); ?>
    <?php wp_head(); ?>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
	$accessKey = 'LoBw5YrUelcIp9E';
    $current = strtoupper(substr($_SERVER['REQUEST_URI'],1,2));
	$currentUrl = substr($_SERVER['REQUEST_URI'],1,2);

    $country_sites = array(
  		'US' => array(
  			'country' => 'USA',
  			'href' => '/us',
  			'value' => 'en'
  		),
  		'CA' => array(
  			'country' => 'Canada (English)',
  			'href' => '/ca',
  			'value' => 'en'
  		),
      'FR' => array(
  			'country' => 'France',
  			'href' => '/fr',
  			'value' => 'fr'
  		),
      'DE' => array(
  			'country' => 'Germany',
  			'href' => '/de',
  			'value' => 'de'
  		),
      'IT' => array(
  			'country' => 'Italy',
  			'href' => '/it',
  			'value' => 'it'
  		),
      'NL' => array(
  			'country' => 'Netherlands',
  			'href' => '/nl',
  			'value' => 'nl'
  		),
      'ES' => array(
  			'country' => 'Spain',
  			'href' => '/es',
  			'value' => 'es'
  		),
      'GB' => array(
  			'country' => 'United Kingdom',
  			'href' => '/gb',
  			'value' => 'en'
  		),
		'PL' => array(
  			'country' => 'Poland',
  			'href' => '/pl',
  			'value' => 'pl'
  		),
		'DK' => array(
  			'country' => 'Denmark',
  			'href' => '/dk',
  			'value' => 'en'
  		),
		'NO' => array(
  			'country' => 'Norway',
  			'href' => '/no',
  			'value' => 'en'
  		),
		'SE' => array(
  			'country' => 'Sweden',
  			'href' => '/se',
  			'value' => 'en'
  		),
		'JP' => array(
  			'country' => 'Japan',
  			'href' => '/jp',
  			'value' => 'jp'
  		)
  	);
	if( (isset($_GET['loc'])) && !isset($_COOKIE['loc']) ){
		$exist = false;
		foreach ($country_sites as $key => $c){
			if(strtoupper($_GET['loc']) == $key){
				$exist = true;
				setcookie('loc',$c['value'],time()+31556926,"/".$currentUrl);
			}
		}
		if($exist == false) setcookie('loc','en');
	}
  	?>
</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HV78RW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="viewport" class="l-body whill-2021 view-<?php echo get_the_name(); ?>" data-fixed-body>
    <!--<header class="p-navbar" data-fixed-navbar data-scroll-addclass="p-navbar_small">-->
	<header class="p-navbar p-navbar_small" data-fixed-navbar>
      <?php if(!isset($_COOKIE['loc'])): ?>
  			<div id="storeSelect" class="">
  				<div class="custom-select-wrapper">
  				    <div class="custom-select">
  				        <div class="custom-select__trigger">
                    <?php foreach ($country_sites as $key => $c): ?>
                      <?php if($current == $key): // if country is the same as domain country ?>
      									<img src="<?= get_template_directory_uri() ?>/assets/dist/images/flags/<?=$current?>.png" alt="" />
      									<span><?php $str = str_replace("\r\n",'', $c['country']); echo $str; ?></span><div class="arrow"></div>
                      <?php endif;?>
                    <?php endforeach; ?>
  				        </div>
  				        <div class="custom-options">
                    <?php foreach ($country_sites as $key => $c): ?>
                      <?php if($current == $key): /*($country == $key) && $country == $current*/ // same as above for adding selected option ?>
                        <div class="custom-option selected">
                          <img src="<?= get_template_directory_uri() ?>/assets/dist/images/flags/<?=$current?>.png" alt="" />
      										<span class="" data-href="<?=$c['href']?>" data-value="<?=$c['value']?>"><?=$c['country']?></span>
                        </div>
                      <?php endif;?>
                    <?php endforeach; ?>

                      <?php foreach ($country_sites as $key => $c): ?>
  											<?php if(($country == $key) && $country != $current): // if country is not the same as domain country, add multi-language in the future?>
                          <!-- <div class="custom-option">
                            <img src='<?= "<?= get_template_directory_uri() ?>/assets/dist/images/flags/".$country.".png" ?>' alt="" />
    												<span class="" data-href="<?=$c['href']?>" data-value="<?=$c['value']?>"><?=$c['country']?></span>
                          </div> -->
  											<?php endif;?>
  										<?php endforeach; ?>
                      <div class="custom-option">
                        <img src="<?= get_template_directory_uri() ?>/assets/dist/images/flags/intl.png" alt="" />
    				            <span class="" data-value="other">Other Region</span>
                      </div>
  				        </div>
  				    </div>
  				</div>
  				<div class="close-btn">
  					<a href="#" id="store">
  						<span>✕</span></a>
  				</div>
  			</div>
  		<?php endif;?>
        <div class="c-container c-container_full">
            <div class="p-navbar__container">
                <div class="p-navbar__brand"><a href="<?php echo site_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/logo.svg" alt="WHILL"/></a>
                </div>
                <button class="p-navbar__toggle c-menu-btn" data-slidemenu-target=".slidemenu-target" title="menu">
                    <span></span></button>
                <div class="p-navbar__spacer"></div>

                <nav class="c-slidemenu p-navbar__slidemenu slidemenu-target" role="navigation">
                    <div class="p-navigation">

                        <ul class="p-navigation__items">

                            <?php wp_nav_menu( [
                                'theme_location' => 'primary',
                                'menu_class' => 'p-navigation',
                                'li_class' => 'p-navigation__item',
                                'link_before'   => '<span class="p-navigation__text">',
                                'link_after'    => '</span>',
                                'items_wrap'=> '%3$s',
                                'container' => false
                            ] );?>

                        </ul>

                    </div>
                </nav>
				<button class="p-navbar-search__toggle c-menu-btn" title="search-mobile">
                    <span></span></button>
<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
            </div>


        </div>

    </header>

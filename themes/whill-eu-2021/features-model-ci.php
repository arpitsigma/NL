<?php
/**
 * Template Name: Features Model C Page
 *
 */
get_header(); $hide = true; ?>

<main role="main">

	<?php if ( have_posts() ): ?>
		<?php the_post(); ?>

        <article>
					<div class="u-row-viewport-large-banner movie-center product-video" data-w="1920" data-h="1080">
						<?php $vidOff = true; if($vidOff == false): ?>
					    <video class="cover tgt-movie" muted autoplay playsinline loop poster="<?php echo get_post_thumbnail_src( 'origin_size' ); ?>">
							<?php if(!$isAndroid){?>
					            <source src="<?php echo get_template_directory_uri(); ?>/movies/maas-short/Whill-Model-Ci2-Copy.mov" type="application/x-mpegURL">
							<?php }?>
					        <source src="<?php echo get_template_directory_uri(); ?>/movies/maas-short/Whill-Model-Ci2-Copy.mov" type="video/mp4" />
					        動画を再生するにはvideoタグをサポートしたブラウザが必要です。
					    </video>
						<?php else: ?>
							<div id="product-video-bg" style="background: url('<?php echo get_post_thumbnail_src( 'origin_size' ); ?>') center top no-repeat; background-size: cover;">
							  <div class="p-main-visual__video">
								<iframe class="playerBox" src="https://www.youtube.com/embed/eO58zmI7vvc?autoplay=1&mute=1&loop=1&playlist=eO58zmI7vvc&modestbranding=1&controls=0&showinfo=0&rel=0&enablejsapi=1&version=3&playerapiid=mbYTP_video_1624289240454&origin=https%3A%2F%2Fwhill.inc&allowfullscreen=true&wmode=transparent&iv_load_policy=3&html5=1&widgetid=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							  </div>
							</div>
							<?php if($hide == false): ?><iframe id="product-video" src="https://www.youtube.com/embed/4xRLezK8pjY?enablejsapi=1&mute=1&autoplay=1&loop=1&controls=0&playlist=4xRLezK8pjY&disablekb=1&showinfo=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><?php endif; ?>
						<?php endif; ?>
							<div class="video-overlay intro-lg" style="background-color: rgba(0,0,0,.30);">
								<div class="overlay-content">
									<h1><?php wp_title("", true); ?></h1>
									<?php if ( $description = get_post_meta( get_the_ID(), 'page_description', true ) ): ?>
										<p class="no-margin"><?php echo $description; ?></p>
									<?php endif ?>
								</div>
							</div>
							<div class="btn-movie-play-wrapper" style="display: none;">
						    <a href="https://www.youtube.com/watch?v=4xRLezK8pjY" class="btn-movie-play vp-s" id="btn-maas-vision" data-yt="4xRLezK8pjY"><div class="inner"></div></a>
							</div>
					</div>
					<!-- <div class="vid-wrapper">
						<img id="video-cover" src="<?php echo get_post_thumbnail_src( 'origin_size' ); ?>" alt="<?php the_title(); ?>">
						<iframe id="player" class="yt-vid-banner" width="100%" height="315" src="https://www.youtube.com/embed/g_RDX_sNw30" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						<h1 class="p-page-header__title"><?php wp_title("", true); ?></h1>
						<?php if ( $description = get_post_meta( get_the_ID(), 'page_description', true ) ): ?>
														<div class="p-page-header__description">
						<?php echo wpautop( $description ); ?>
														</div>
						<?php endif ?>
						<button id="play" class="play-btn">
							<svg enable-background="new 0 0 141.73 141.73" height="141.73px" id="Warstwa_1" version="1.1" viewBox="0 0 141.73 141.73" width="141.73px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M101.628,40.092c-8.22-8.22-19.149-12.746-30.774-12.746c-11.624,0-22.553,4.526-30.772,12.746   c-16.968,16.969-16.967,44.578,0.001,61.546c8.22,8.22,19.149,12.747,30.773,12.747s22.553-4.526,30.772-12.746   s12.747-19.148,12.747-30.773S109.848,48.312,101.628,40.092z M100.214,100.225c-7.842,7.842-18.269,12.16-29.358,12.16   s-21.517-4.319-29.359-12.161c-16.188-16.188-16.188-42.529-0.001-58.718c7.842-7.842,18.269-12.16,29.358-12.16   c11.091,0,21.518,4.318,29.36,12.16c7.842,7.843,12.161,18.269,12.161,29.359S108.056,92.382,100.214,100.225z" fill="#ffffff"/><path d="M65.893,55.983c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l13.466,13.466L64.478,84.331   c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293L80.065,71.57   c0.391-0.391,0.391-1.023,0-1.414L65.893,55.983z" fill="#ffffff"/></g></svg>
						</button>
					</div> -->
            <!-- <div class="p-band p-band_primary" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/dist/images/model-c/model-c-mv.jpg);">
                <div class="c-container c-container_full">
                    <header class="p-page-header p-page-header_with-content p-page-header_<?php echo get_the_name(); ?> <?php if(!has_post_thumbnail()):?>p-page-header_no-image<?php endif;?>">
                        <div class="p-page-header__container">
                            <div class="p-page-header__text">
                                <h1 class="p-page-header__title"><?php wp_title("", true); ?></h1>
								<?php if ( $description = get_post_meta( get_the_ID(), 'page_description', true ) ): ?>
                                    <div class="p-page-header__description">
										<?php echo wpautop( $description ); ?>
                                    </div>
								<?php endif ?>

                            </div>
                        </div>

                    </header>
                </div>
            </div> -->


			<?php //get_template_part( 'partial/page-content', 'tight' ); ?>
			<?php the_content();?>
			<?php //get_template_part( 'partial/page-content', 'whilligfeed' ); ?>
			<?php //get_template_part( 'partial/page-content', 'whillmodels' ); ?>
			<?php get_template_part( 'partial/page-content', 'readytoride' ); ?>

        </article>

	<?php endif; ?>

</main>
<script type="text/javascript">
	$('#play').on('click', function(e) {
	e.preventDefault();
	$("#player")[0].src += "?autoplay=1";
	$('#player').show();
	$('#video-cover').hide();
	$('#play').hide();
	})
	function isMobile() {
		let check = false;
		(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}
	if(isMobile()) $("iframe.playerBox").detach();
</script>
<!--
<div class="cta-block">
    <span class="tooltip tooltip-left">Get in the Driver’s Seat</span>
    <a class="c-btn c-btn_primary" href="<?php echo site_url('/buy-personal-ev/'); ?>">Buy Now</a>
    <a class="c-btn c-btn_primary" href="<?php echo site_url('/test-drive-personal-ev/'); ?>">Test Drive</a>
</div> -->

<?php get_footer(); ?>

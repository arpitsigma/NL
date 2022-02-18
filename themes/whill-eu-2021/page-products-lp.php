<?php
/**
 * Template Name: Products Landing Page
 *
 */
get_header(); ?>

<main role="main">

	<?php if ( have_posts() ): ?>
		<?php the_post(); ?>

		<article>
			<div class="p-band p-band_primary our-products-banner"
				<?php if(has_post_thumbnail()):?>
			     style="background-image: url('<?php echo get_post_thumbnail_src( 'origin_size' ); ?>');"
				<?php endif;?>
				>
				<div class="c-container c-container_full">
					<header class="p-page-header p-page-header_with-content p-page-header_<?php echo get_the_name(); ?> <?php if(!has_post_thumbnail()):?>p-page-header_no-image<?php endif;?>">
						<div class="p-page-header__container">
							<div class="p-page-header__text header__text-pulltop">
								<h1 class="p-page-header__title"><?php the_title(); ?><!--Our Products--></h1>
								<?php if ( $description = get_post_meta( get_the_ID(), 'page_description', true ) ): ?>
									<div class="p-page-header__description">
										<!-- <p>With their compact size, intuitive controls and patented omni-wheels, WHILL products allow you to maneuver the world effortlessly.</p> -->
										<?php echo wpautop( $description ); ?>
									</div>
								<?php endif ?>

							</div>
						</div>

					</header>
				</div>
			</div>

			<section>
				<!-- <div class="c-container"> -->
					<?php the_content();?>
				<!-- </div> -->
			</section>

			<?php get_template_part( 'partial/page-content', 'readytoride' ); ?>

		</article>

	<?php endif; ?>

</main>

<?php get_footer(); ?>

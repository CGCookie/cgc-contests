<?php get_header();?>

<?php

	// get meta
	$rules 			= cgc_contest_meta( get_the_ID(),'_cgc_contest_rules' );
	$sponsors 		= cgc_contest_meta( get_the_ID(), '_cgc_contest_sponsors' );
	$awards  		= cgc_contest_meta( get_the_ID(),'_cgc_contest_awards' );
	$subtitle       = cgc_contest_meta( get_the_ID(), '_cgc_contest_subtitle');
	$banner_src   	= get_post_meta( get_the_ID(), '_cgc_contest_banner', true );
	$banner     	= wp_get_attachment_url($banner_src,'full');
	$accent_color   = cgc_contest_meta( get_the_ID(), '_cgc_contest_color' );

	$gform			= cgc_contest_meta( get_the_ID(), '_cgc_contest_gform_id' );
	$gfield			= cgc_contest_meta( get_the_ID(), '_cgc_contest_gform_field' );

	$expires       = get_post_meta( get_the_ID(), '_cgc_contest_expiration', true );

?>
<style>
.page-id-<?php echo get_the_ID();?> .cgc-contest-rules li:before{color:<?php echo $accent_color[0];?>;}
.page-id-<?php echo get_the_ID();?>.cgc-contest-page .page-content .button{background:<?php echo $accent_color[0];?>;}
.page-id-<?php echo get_the_ID();?>.cgc-contest-page .page-content a:not(.button){color:<?php echo $accent_color[0];?>;}
</style>
<div class="page-content">

	<section class="cgc-contest-header">
		<div class="cgc-contest-header-inner">
			<?php the_title('<h1>','</h1>');?>
			<?php if ( $subtitle ) { ?>
				<h2><?php echo $subtitle[0];?></h2>
			<?php } ?>
		</div>
		<div class="cgc-contest-header-img" style="background-image:url('<?php echo $banner;?>');"></div>
	</section>
	<div class="page-content-inner">

		<section class="cgc-contest-main">

			<div class="cgc-contest-info">
				<div class="cgc-contest-inner cgc-contest-back">
					<?php

					while ( have_posts() ) : the_post();
					the_content();
					endwhile;

					?>
				</div>
			</div>
			<div class="cgc-contest-sidebar">
				<div class="cgc-contest-inner cgc-contest-back">
					<h3>Challenge Rules</h3>
					<ul class="cgc-contest-rules">
						<?php
							if ( $rules ):

								foreach ( $rules as $rule ):

									printf('<li>%s</li>', $rule);

								endforeach;

							endif;
						?>
					</ul>
				</div>
			</div>

		</section>
		<section class="cgc-contest-sponsors-wrap ">
			<div class="cgc-contest-inner cgc-contest-back">
				<h4>The sponsors behind the challenge</h4>

				<ul class="cgc-contest-sponsor-logos">
					<?php
						if ( $sponsors ):

							foreach ( $sponsors as $sponsor ):

								$getimg = $sponsor['img'];
								$img    = wp_get_attachment_image($getimg);
								$link   = $sponsor['link'];

								printf('<li><a href="%s">%s</a></li>', $link, $img);

							endforeach;

						endif;
					?>
				</ul>
			</div>
		</section>

		<section class="cgc-contest-awards-wrap">
			<div class="cgc-contest-inner cgc-contest-back">
				<ul class="cgc-contest-awards">
					<?php
						if ( $awards ):

							foreach ( $awards as $award ):

								printf('<li><div class="cgc-contest-award-inner">%s</div></li>', wpautop($award) );

							endforeach;

						endif;
					?>
				</ul>
			</div>
		</section>

		<div class="cgc-contest-cta-wrap">
			<a href="cgc-contest-form" data-reveal-id="cgc-contest-form" class="button cgc-open-contest-modal">Submit your entry</a>
			<p>Entries must be recieved by <?php echo $expires;?></p>
		</div>

		<section class="cgc-contest-recent-entries">
			<div class="cgc-contest-inner cgc-contest-back">
				<h3>Recent Challenge Entries</h3>
				<?php echo do_shortcode('[cgc_contest id="'.$gform[0].'" position="'.$gfield[0].'"]');?>
			</div>
		</section>

	</div>
	<!-- Contest Modal -->
	<div id="cgc-contest-form" class="reveal-modal" data-reveal>
		<h3 class="reveal-modal-header">Entry Submission</h3>
		<?php
			gravity_form($gform[0], false, false, false, null, true);
		?>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>



<?php get_footer();?>
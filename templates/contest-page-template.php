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

?>
<style>
.page-id-<?php echo get_the_ID();?> .cgc-contest-rules li:before{color:<?php echo $accent_color[0];?>;}
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
					<h3>Halloween is upon us</h3>
					<?php the_content();?>
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
				<h4>The sponsors behind the challenge.</h4>

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
			<a class="button" href="#">Submit your entry</a>
			<p>Entries must be recieved by FUNTION TO GET ENTRY DEADLINE</p>
		</div>

		<section class="cgc-contest-recent-entries">
			<div class="cgc-contest-inner cgc-contest-back">
				<?php echo do_shortcode('[cgc_contests id=""]');?>
			</div>
		</section>

	</div>

</div>

<?php get_footer();?>
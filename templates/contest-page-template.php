<?php get_header();?>

<?php

if ( have_posts() ) : while ( have_posts() ) : the_post();

	// get meta
	$rules 			= cgc_contest_meta( get_the_ID(),'_cgc_contest_rules' );
	$sponsors 		= cgc_contest_meta( get_the_ID(), '_cgc_contest_sponsors' );
	$count_sponsors = count($sponsors);

	$awards  		= cgc_contest_meta( get_the_ID(),'_cgc_contest_awards' );
	$extra_awards  	= cgc_contest_meta( get_the_ID(),'_cgc_contest_extra_awards' );

	$count_awards   = count( $awards );
	$count_extra_awards = count($extra_awards);

	$faqs  			= cgc_contest_meta( get_the_ID(),'_cgc_contest_faq' );
	$subtitle       = cgc_contest_meta( get_the_ID(), '_cgc_contest_subtitle');
	$banner_src   	= get_post_meta( get_the_ID(), '_cgc_contest_banner', true );
	$banner     	= wp_get_attachment_url($banner_src,'full');
	$accent_color   = cgc_contest_meta( get_the_ID(), '_cgc_contest_color' );

	$gform			= get_post_meta( get_the_ID(), '_cgc_contest_gform_id', true );
	$gfield			= get_post_meta( get_the_ID(), '_cgc_contest_gform_field', true );

	$expires       = get_post_meta( get_the_ID(), '_cgc_contest_expiration', true );

	$all_entries	= cgc_contest_meta( get_the_ID(), '_cgc_contest_entries_page' );

	$entries_page  = $all_entries ? get_permalink($all_entries[0]) : null;

?>
<style>
.page-id-<?php echo get_the_ID();?> .cgc-contest-rules li:before,
.page-id-<?php echo get_the_ID();?>.cgc-contest-page .styled-list li:before,
.page-id-<?php echo get_the_ID();?>.cgc-contest-page .page-content a:not(.button){color:<?php echo $accent_color[0];?>;}
.page-id-<?php echo get_the_ID();?>.cgc-contest-page .page-content .button{background:<?php echo $accent_color[0];?>;}

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
				<h4>The sponsors behind the challenge</h4>

				<ul class="cgc-contest-sponsor-logos cgc-contest-<?php echo $count_sponsors;?>-blocks">
					<?php
						if ( $sponsors ):

							foreach ( $sponsors as $sponsor ):

								$getimg = $sponsor['img'];
								$img    = wp_get_attachment_image($getimg,'full');
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
				<ul id="cgc-contest-main-awards" class="cgc-contest-awards cgc-contest-<?php echo $count_awards;?>-blocks">
					<?php
						if ( $awards ):

							foreach ( $awards as $award ):

								printf('<li><div class="cgc-contest-award-inner">%s</div></li>', wpautop($award) );

							endforeach;

						endif;

					?>
				</ul>
				<ul class="cgc-contest-awards cgc-contest-extra-awards cgc-contest-<?php echo $count_extra_awards;?>-blocks">
					<?php

						if ( $extra_awards ):

							foreach ( $extra_awards as $extra_award ):

								printf('<li><div class="cgc-contest-award-inner">%s</div></li>', wpautop($extra_award) );

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
				<a class="cgc-contest-all-entries" href="<?php echo $entries_page;?>">View all entries <i class="icon icon-caret-right"></i></a>
				<?php echo do_shortcode('[cgc_contest id="'.$gform.'" position="'.$gfield.'" limit="9"]');?>
			</div>
		</section>

		<section class="cgc-contest-faq-wrap">
			<div class="cgc-contest-inner">
				<h3>Frequently Asked Questions</h3>
				<ul class="cgc-contest-faq">
					<?php
						if ( $faqs ):

							foreach ( $faqs as $faq ):

								$question = $faq['question'];
								$answer   = $faq['answer'];

								?><li>
									<h5 class="cgc-contest-faq-question"><?php echo $question;?></h5>
									<div class="cgc-contest-faw-answer"><?php echo wpautop($answer);?></div>
								</li><?php

							endforeach;

						endif;

					?>
				</ul>
			</div>
		</section>

	</div>
	<!-- Contest Modal -->
	<div id="cgc-contest-form" class="reveal-modal" data-reveal>
		<h3 class="reveal-modal-header">Entry Submission</h3>
		<?php gravity_form($gform, false, true, false, null, true);?>
		<a class="close-reveal-modal">&#215;</a>
	</div>
</div>

<?php endwhile;endif;



get_footer();?>
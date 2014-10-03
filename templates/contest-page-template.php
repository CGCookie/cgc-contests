<?php get_header();?>

<div class="page-content">

	<section class="cgc-contest-header">
		<h1>Title</h1>
		<h2>Section</h2>
		<div class="cgc-contest-header-img" style="background-image:url(http://placekitten.com/1200/400;background-size:cover;background-repeat:no-repeat;"></div>
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
						BUILD FUNCTION GET RULES
					</ul>
				</div>
			</div>

		</section>
		<section class="cgc-contest-sponsors-wrap ">
			<div class="cgc-contest-inner cgc-contest-back">
				<h4>The sponsors behind the challenge.</h4>

				<ul class="cgc-contest-sponsor-logos">
					BUILD FUNCTION GET LOGOS
				</ul>
			</div>
		</section>

		<section class="cgc-contest-awards-wrap">
			<div class="cgc-contest-inner cgc-contest-back">
				<ul class="cgc-contest-awards">
					BUILD FUNCTION GET AWARDS
				</ul>
			</div>
		</section>

		<div class="cgc-contest-cta-wrap">
			<a href="#">Submit your entry</a>
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
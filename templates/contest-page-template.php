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
				<h2>Halloween is upon us</h2>
				<?php the_content();?>
			</div>
			<div class="cgc-contest-sidebar">
				<h2>Challenge Rules</h2>
				<ul class="cgc-contest-rules">
					BUILD FUNCTION GET RULES
				</ul>
			</div>

		</section>
		<section class="cgc-contest-sponsors-wrap">
			<h2>The sponsors behind the challenge.</h2>

			<ul class="cgc-contest-sponsor-logos">
				BUILD FUNCTION GET LOGOS
			</ul>

		</section>

		<section class="cgc-contest-awards-wrap">
			<ul class="cgc-contest-awards">
				BUILD FUNCTION GET AWARDS
			</ul>
		</section>

		<div class="cgc-contest-cta-wrap">
			<a href="#">Submit your entry</a>
			<p>Entries must be recieved by FUNTION TO GET ENTRY DEADLINE</p>
		</div>

		<section class="cgc-contest-recent-entries">
			<?php echo do_shortcode('[cgc_contests id=""]');?>
		</section>

	</div>

</div>

<?php get_footer();?>
<?php get_header( ); ?>


<?php
	while(have_posts()){
		the_post();
		$SARTICLE::compose();
	}
?>

<?php get_footer( ); ?>


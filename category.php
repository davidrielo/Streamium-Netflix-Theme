<?php get_header(); ?>
	<main class="cd-main-content">

		<div class="main-spacer"></div>

		<section class="categories">
			<?php if ( have_posts() ) : ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 video-header-archive">
						<h3><?php printf( __( 'Viewing: %s', 'streamium' ), single_cat_title( '', false ) ); ?></h3>
						<!--<div class="dropdown video-header-archive-dropdown">
						  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    FILTER
						    <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
						    <li><a href="#">Most Like</a></li>
						    <li><a href="#">Recently Added</a></li>
						    <li><a href="#">Most Reviews</a></li>
						  </ul>
						</div>-->
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
			</div><!--/.container-->
			<div class="container-fluid">
				<div class="row static-row static-row-first">
					<?php
						
						$count = 0;
						$cat_count = 0; 
						$total_count = $wp_query->post_count;

						while ( have_posts() ) : the_post(); if ( has_post_thumbnail() ) { 
						$image   = wp_get_attachment_image_src( get_post_thumbnail_id(), 'streamium-video-poster' );
						$nonce = wp_create_nonce( 'streamium_likes_nonce' ); 
						?>
						<div class="col-md-5ths tile" data-id="<?php the_ID(); ?>" data-nonce="<?php echo $nonce; ?>" data-cat="static-<?php echo $cat_count; ?>">
							<?php if($post->premium) : ?>
								<div class="tile_payment_details">
									<div class="tile_payment_details_inner">
										<h2>Available on <?php echo str_replace(array("_"), " ", $post->plans[0]); ?></h2>
									</div>
								</div>
							<?php endif; ?>
					        <div class="tile_media">
					        	<img class="tile_img" src="<?php echo esc_url($image[0]); ?>" alt=""  />
					        </div>
					        <?php if(!($post->premium)) : ?>
						        <a class="play-icon-wrap hidden-xs" href="<?php the_permalink(); ?>">
									<div class="play-icon-wrap-rel">
										<div class="play-icon-wrap-rel-ring"></div>
										<span class="play-icon-wrap-rel-play">
											<i class="fa fa-play fa-1x" aria-hidden="true"></i>
							        	</span>
						        	</div>
					        	</a>
				        	<?php endif; ?>
					        <div class="tile_details">
					          	<div class="tile_meta">
					            	<h4><?php the_title(); ?></h4>						            	
					            	<a data-id="<?php the_ID(); ?>" data-nonce="<?php echo $nonce; ?>" data-cat="static-<?php echo $cat_count; ?>" class="tile_meta_more_info hidden-xs"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
					          	</div>
					        </div>
					        <?php if(is_user_logged_in() && get_theme_mod( 'streamium_enable_premium' )){
						    		$userId = get_current_user_id();
						    		$percentageWatched = get_post_meta( get_the_ID(), 'user_' . $userId, true );
						    ?>
							    <div class="progress tile_progress">
								  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percentageWatched; ?>"
								  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentageWatched; ?>%">
								    <span class="sr-only"><?php echo $percentageWatched; ?>% Complete</span>
								  </div>
								</div>
						    <?php } ?>
						</div>
						<?php
							$count++;
  							if ($count % (isMobile() ? 1 : 5) == 0 || $count == $total_count) { 
  						?>
  						</div>
  						</div>
  						<section class="s3bubble-details-full static-<?php echo $cat_count; ?>">
							<div class="s3bubble-details-full-overlay"></div>
							<div class="container-fluid s3bubble-details-inner-content">
								<div class="row">
									<div class="col-sm-5 col-xs-5 rel">
										<div class="synopis-outer">
											<div class="synopis-middle">
												<div class="synopis-inner">
													<h2 class="synopis hidden-xs"></h2>
													<p class="synopis"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-7 col-xs-7 rel">
										<a class="play-icon-wrap synopis" href="#">
											<div class="play-icon-wrap-rel">
												<div class="play-icon-wrap-rel-ring"></div>
												<span class="play-icon-wrap-rel-play">
													<i class="fa fa-play fa-3x" aria-hidden="true"></i>
									        	</span>
								        	</div>
							        	</a>
							        	<a href="#" class="synopis-video-trailer">Watch Trailer</a>
							        	<a href="#" class="s3bubble-details-inner-close"><i class="fa fa-times" aria-hidden="true"></i></a>
									</div><!--/.col-sm-12-->
								</div><!--/.row-->
							</div><!--/.container-->
						</section><div class="container-fluid"><div class="row static-row">
					<?php $cat_count++; } ?>
					<?php } endwhile; ?>
				</div><!--/.row-->
				<div class="row">
					<div class="col-sm-12">
						<?php if (function_exists("streamium_pagination")) {
						    streamium_pagination();
						} ?>
					</div>
				</div><!--/.row-->
			</div><!--/.container-->
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</section><!--/.videos-->

		<div class="main-spacer"></div>

<?php get_footer(); ?>
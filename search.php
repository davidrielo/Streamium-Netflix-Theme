<?php get_header(); ?>
	<main class="cd-main-content">
		
		<div class="main-spacer"></div>

		<section class="categories">

			<?php 
			$allsearch = new WP_Query("s=$s&showposts=-1"); 
			if ( $allsearch->have_posts() ) : ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 video-header-archive">
						<h3 class="pull-left"><?php printf( __( 'Search Results for: %s', 'streamium' ), get_search_query() ); ?></h3>
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
			</div><!--/.container-->
			<div class="container-fluid">
				<div class="row static-row static-row-first">
					<?php
						$cat_count = 0; 
						$count = 0;
						$total_count = $allsearch ->found_posts;
						while ( $allsearch->have_posts() ) : $allsearch->the_post(); 
						$image   = wp_get_attachment_image_src( get_post_thumbnail_id(), 'streamium-video-poster' );
						$fullImage  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'streamium-home-slider' );  
						$trimmed_content = wp_trim_words( get_the_excerpt(), 11 ); 
						?>
						<div class="col-sm-2 tile" data-id="<?php the_ID(); ?>" data-nonce="<?php echo $nonce; ?>" data-cat="static-<?php echo $cat_count; ?>">
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
						</div>
						<?php
							$count++;
  							if ($count % (isMobile() ? 1 : 6) == 0 || $count == $total_count) { 
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
					<?php endwhile; ?>
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 video-header-archive">
						<h3 class="pull-left"><?php printf( __( 'Search Results for: %s', 'streamium' ), get_search_query() ); ?></h3>
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
					</div><!--/.col-sm-12-->
				</div><!--/.row-->
			</div><!--/.row-->
			<?php endif; ?>
		</section><!--/.videos-->

		<div class="main-spacer"></div>
		
<?php get_footer(); ?>
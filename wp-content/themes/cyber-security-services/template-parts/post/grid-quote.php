<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */
?>


<?php $cyber_security_services_post_option = get_theme_mod( 'cyber_security_services_grid_column','3_column');
    if($cyber_security_services_post_option == '1_column'){ ?>
    <div class="col-lg-12 col-md-12">
<?php }else if($cyber_security_services_post_option == '2_column'){ ?>
    <div class="col-lg-6 col-md-6">
<?php }else if($cyber_security_services_post_option == '3_column'){ ?>
    <div class="col-lg-4 col-md-4">
<?php }else if($cyber_security_services_post_option == '4_column'){ ?>
    <div class="col-lg-3 col-md-3">
<?php }?>
	<div id="Category-section" class="entry-content w-100">
		<div id="post-<?php the_ID(); ?>" <?php post_class('quotepost'); ?>>
			<div class="postbox smallpostimage p-3 wow zoomIn">
				<?php $blog_archive_ordering = get_theme_mod('archieve_post_order', array('image', 'meta'));
				foreach ($blog_archive_ordering as $post_data_order) :
					if('image' === $post_data_order) :?>
				        <a href="<?php the_permalink(); ?>"><h1 class="quote-content"><?php  echo get_the_content();?></h1></a>
					<?php elseif ('meta' === $post_data_order) :?>
					    <div class="date-box mb-2 text-center">
					    	<?php if ( is_sticky() ) { ?>
				    			<span class="me-2"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_sticky_icon','fas fa-thumb-tack')); ?> me-2"></i><?php echo esc_html( __('Sticky', 'cyber-security-services') ); ?></span>
				    		<?php } ?>
							<?php if( get_option('cyber_security_services_date',false) != 'off'){ ?>
								<span class="me-2"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_date_icon','far fa-calendar-alt')); ?> me-2"></i><?php cyber_security_services_display_shop_date(); ?></span>
							<?php } ?>
							<?php if( get_option('cyber_security_services_admin',false) != 'off'){ ?>
								<span class="entry-author me-2"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_author_icon','fas fa-user')); ?> me-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
							<?php }?>
							<?php if( get_option('cyber_security_services_comment',false) != 'off'){ ?>
								<span class="entry-comments me-2"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_comment_icon','fas fa-comments')); ?> me-2"></i> <?php comments_number( __('0 Comments','cyber-security-services'), __('0 Comments','cyber-security-services'), __('% Comments','cyber-security-services')); ?></span>
							<?php }?>
							<?php if( get_option('cyber_security_services_tag',false) != 'off'){ ?>
								<span class="tags"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_tag_icon','fas fa-tags')); ?> me-2"></i> <?php cyber_security_services_display_post_tag_count(); ?></span>
							<?php }?>
						</div>
					<?php endif;
				endforeach;
				?>       
			  	<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<?php
/**
 *
 * Template Name: join
 *
 * The template used if you are using a page builder plugin
 *
 * @package freddo
 */

get_header(); ?>

	<div id="primary" class="content-area content-area_w">
		<main id="main" class="site-main">		
  			<?php
			$blog_cat    = get_category_by_slug('blog'); //blog
			$numberposts = 3;
			$myposts = get_posts('numberposts='.$numberposts.'&offset=0&cat='.$blog_cat->term_id);
			foreach($myposts as $post):
				$post_id       = $post->ID;
			    $the_title     = $post->post_title;
				$cut_str_post_title = cut_str($post->post_title,30);
				//link
				$the_permalink = apply_filters('the_permalink', get_permalink());
				//image
				$medium_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');//缩略图
				$post_image = empty($medium_image_url[0]) ? '' : $medium_image_url[0];
				//content desc
				if(!empty($post->post_excerpt)){
				    $post_desc = cut_str(strip_tags($post->post_excerpt),150);
				}else{
				    $post_desc = cut_str(strip_tags($post->post_content),150);
				}
				$post_date = $post->post_date;
				$post_comment_count = $post->comment_count;
				//author info
				$post_author = $post->post_author;
				$post_author_name = get_the_author_meta( 'user_login', $post->post_author );
				$post_author_display_name = get_the_author_meta( 'display_name', $post->post_author );
				$post_author_url = get_author_posts_url( $post_author );
				$post_author_user_nicename = get_the_author_meta('user_nicename', $post_author);
				//$post_author_url = str_replace('/'.$post_author_user_nicename, '/'.$post_author, $post_author_url);
			?>
			<article id="post-<?php echo $post_id;?>" class="fl">
			        <div class="entry-featuredImg">
			        	 <a href="https://crestaproject.com/demo/freddo/?p=76">
			        	 	<img width="980" height="600" src="https://crestaproject.com/demo/freddo/wp-content/uploads/2017/11/fresco-blog-2-980x600.jpg" class="attachment-freddo-the-post-small size-freddo-the-post-small wp-post-image" alt="">
			        	    <div class="entry-featuredImg-border"></div>
			             </a>
			         </div>				
			        
				     <header class="entry-header font_c">
						<h2 class="entry-title title_line">
							<a href="" rel="bookmark"><?php echo $the_title;?></a>
						</h2>		
						<div class="entry-meta">
							<span class="posted-on">
							     <i class="fa fa-calendar-o spaceRight" aria-hidden="true"></i>
							     <a href="" rel="bookmark">
							         <time class="entry-date published" datetime="2017-11-18T18:26:33+00:00"><?php echo $post_date;?></time>
							         <time class="updated" datetime="2017-11-18T18:32:30+00:00">November 18, 2017</time>
							     </a>
							</span>
							<span class="byline">
							     <i class="fa fa-user spaceLeftRight" aria-hidden="true"></i>
							     <span class="author vcard">
							        <a class="url fn n" href="<?php echo $post_author_url;?>"><?php echo $post_author_display_name;?></a>
							     </span>
							</span>
							<span class="comments-link">
								<i class="fa fa-comments-o spaceLeftRight" aria-hidden="true"></i>
							     <a href=""><?php echo $post_comment_count;?> Comment<span class="screen-reader-text"> on Welcome to Fresco WordPress Theme</span>
							     </a>
							</span>		
					    </div><!-- .entry-meta-->
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>?php echo $post_desc;?></p>
				     </div><!-- .entry-content -->
			    	<footer class="entry-footer">
							<span class="read-more"><a href="">Read More<i class="fa fa-caret-right spaceLeft" aria-hidden="true"></i></a></span>
					</footer><!-- .entry-footer -->
			</article> 
			<?php
			endforeach;
			wp_reset_query();
			?>
           
		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php
get_sidebar();
get_sidebar('push');   
get_footer();

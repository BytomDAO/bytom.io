<?php $showServices = freddo_options('_onepage_section_services', ''); ?>
<?php if ($showServices == 1) : ?>
	<?php
		$servicesSectionID = freddo_options('_onepage_id_services', 'services');
		$servicesTitle = freddo_options('_onepage_title_services', __('Services', 'freddo'));
		$servicesSubTitle = freddo_options('_onepage_subtitle_services', __('What We Offer', 'freddo'));
		$servicesPhrase = freddo_options('_onepage_phrase_services', '');
		$servicesTextarea = freddo_options('_onepage_textarea_services', '');
		$servicesImage = freddo_options('_onepage_servimage_services');
		$textLenght = freddo_options('_onepage_lenght_services', '30');
		$customMore = freddo_options('_excerpt_more', '&hellip;');
		$singleServiceBox = array();
		$singleServiceFont = array();
		for( $number = 1; $number < FREDDO_VALUE_FOR_SERVICES; $number++ ){
			$singleServiceBox["$number"] = freddo_options('_onepage_choosepage_'.$number.'_services', '');
			$singleServiceFont["$number"] = freddo_options('_onepage_fontawesome_'.$number.'_services', '');
		}
	?>
<section class="freddo_onepage_section freddo_services" id="<?php echo esc_attr($servicesSectionID); ?>">
	<div class="freddo_services_color"></div>
	<div class="freddo_action_services">
		<?php if($servicesTitle || is_customize_preview()): ?>
			<h2 class="freddo_main_text"><?php echo esc_html($servicesTitle); ?></h2>
		<?php endif; ?>
		<?php if($servicesSubTitle || is_customize_preview()): ?>
			<p class="freddo_subtitle"><?php echo esc_html($servicesSubTitle); ?></p>
		<?php endif; ?>
		<div class="services_columns" style="display:inherit;">
			
				<div class="community_box">
                    <p class=title><span class="h_line"></span>News & Events</p>
                    <div class="blog_columns">
                    <div class="blog">
					    <?php
					    //$posts_per_page = get_query_var('posts_per_page');
					    $posts_per_page = 3;
						$paged = get_query_var('paged');
						$page  = get_query_var('page');
						$page  = $paged > $page ? $paged : $page;
					    if(empty($page)) $page = 1;
					  	$offset_post = ($page-1)*$posts_per_page;
					    //$posts_all = get_posts('numberposts='.$posts_per_page.'&offset='.$offset_post);

					    $default_image_arr = array(
					    	0 => 'https://crestaproject.com/demo/freddo/wp-content/uploads/2017/11/fresco-blog-1-370x220.jpg',
					    	1 => 'https://crestaproject.com/demo/freddo/wp-content/uploads/2017/11/fresco-blog-7-370x220.jpg',
					    	2 => 'https://crestaproject.com/demo/freddo/wp-content/uploads/2017/11/fresco-blog-3-370x220.jpg'
					    );


					    global $wpdb;
					    $posts_news_sql = "select * from bytom_news where image != '' order by post_time desc limit $offset_post,$posts_per_page";
					    $posts_all = $wpdb->get_results($posts_news_sql);
					    // 本地数据库/线上
					    if(!empty($posts_all)):
					    	$order_key = 0;
					        foreach($posts_all as $k=>$this_post):
					            $the_permalink = $this_post->link;
					            $the_title = $this_post->title;
					            $the_title_cutstr = cut_str($the_title, 26);
					            $post_time = ($this_post->post_time)/1000;
					            $post_date = date("d F Y", $post_time);
					            $post_desc = cut_str($this_post->desc, 30);
					            $post_image = empty($this_post->image) ? $default_image_arr[$order_key] : $this_post->image;
					            if(!strstr($post_image, 'http')) $post_image = 'data:image/jpg;base64,'.$post_image;
					            ++$order_key;
					    ?>
						<div class="freddoBlogSingle">
							<div class="entry-featuredImg">
								<a href="<?php echo $the_permalink;?>" target="_blank" rel="nofollow">
									<img width="370" height="220" src="<?php echo $post_image;?>" class="attachment-freddo-little-post size-freddo-little-post wp-post-image" alt="" style="height: 12vw"><div class="entry-featuredImg-border"></div>
								</a>
							</div>						
							<div class="entry-meta one">
								<span class="byline">
									<span class="author vcard"><a class="url fn n" href="" style="font-size: 1.2em;color: #fff"><?php echo $the_title_cutstr;?></a></span>
								</span>
								<!-- <span class="posted-on">
									<a href="" rel="bookmark">
										<time class="entry-date published updated" datetime="2017-11-18T18:31:46+00:00"><?php echo $post_date;?></time>
									</a>
								</span> -->
								
						    </div>
						    <div class="entry-meta two">
						    	<!-- <span class="comments-link">
									<a href=""><?php echo $post_desc;?></a>
								</span> -->
								<span class="posted-on" style="float: left;">
									<a href="" rel="bookmark">
										<time class="entry-date published updated" datetime="2017-11-18T18:31:46+00:00"><?php echo $post_date;?></time>
									</a>
								</span>
						    </div><!-- .entry-meta -->
						</div>
						<?php
					        endforeach;
					    endif;
					    ?>
				    </div>
				    <p class=title><span class="h_line"></span>Follow us</p>
				    <div class="freddoContactForm">
						<div role="form" class="wpcf7" id="wpcf7-f150-o1" lang="zh-CN" dir="ltr">
						<div class="screen-reader-response"></div>
							<form action="/wordpress/?customize_changeset_uuid=5662284d-d3e1-4f57-9bec-08f227b6a4b4&amp;customize_theme=freddo&amp;customize_messenger_channel=preview-6&amp;customize_autosaved=on#wpcf7-f150-o1" method="post" class="wpcf7-form customize-unpreviewable" novalidate="novalidate">
								<div style="display: none;">
								<input type="hidden" name="_wpcf7" value="150">
								<input type="hidden" name="_wpcf7_version" value="5.0.1">
								<input type="hidden" name="_wpcf7_locale" value="zh_CN">
								<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f150-o1">
								<input type="hidden" name="_wpcf7_container_post" value="0">
								</div>
							    <p class="form_submit">
							        <span class="wpcf7-form-control-wrap your-email">
							        	<input type="email" name="your-email" value="" size="100" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Enter your E-mail address" style="color:#000">
							        	<span class="ajax-loader"></span>
							        </span>	   
							        <input type="submit" value="Subscribe" class="wpcf7-form-control wpcf7-submit">
							    </p>
							    
							    <div class="wpcf7-response-output wpcf7-display-none"></div>
							</form>
						</div>
					</div>
					<h3 style="text-align:center;margin-top: 2em" class="h_f">Let us embrace this intelligent blockchain era with Bytom!</h3>
				    <div class="btm-follow-us">
					  <div id="btm-social">
					    <ul>
					      <li>
					        <a target="_blank" href="https://twitter.com/Bytom_Official"><button class="border"><i class="fa fa-twitter spaceLeftRight"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>twitter.com</div>
					          <div>Bytom_Official</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="https://www.facebook.com/bytomofficial/"><button class="border"><i class="fa fa-facebook"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>facebook.com</div>
					          <div>bytomblockchain</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="http://mp.weixin.qq.com/s/fLCk33KYQTouevEAi0a0Kg"><button class="border"><i class="fa fa-weixin"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>Wechat</div>
					          <div>&nbsp;</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="http://weibo.com/u/5966947038?refer_flag=1001030101_"><button class="border"><i class="fa fa-weibo"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>@比原链</div>
					          <div>&nbsp;</div>

					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="https://github.com/Bytom/bytom"><button class="border"><i class="fa fa-github-alt"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>github.com</div>
					          <div>Bytom</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="https://discord.gg/U3RSYr5"><button class="border"><i class="fa icon iconfont icon-Grey_Discord"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>discord.gg</div>
					          <div>U3RSYr5</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="https://t.me/BytomInternational"><button class="border"><i class="fa fa-paper-plane-o"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>t.me</div>
					          <div>BytomInternational</div>
					        </div>
					      </li>

					      <li>
					        <a target="_blank" href="https://www.reddit.com/r/BytomBlockchain/"><button class="border"><i class="fa fa-reddit-alien"></i></button></a>
					        <br><br>
					        <div class="icon-caption">
					          <div>reddit.com/r/</div>
					          <div>BytomBlockchain</div>
					        </div>
					      </li>
					    </ul>
					  </div>
					</div>
		       </div>
	    </div>
	</div>
</section>
<?php endif; ?>
<?php $showFeatures = freddo_options('_onepage_section_features', ''); ?>
<?php if ($showFeatures == 1) : ?>
	<?php
		$featuresSectionID = freddo_options('_onepage_id_features', 'features');
		$featuresTitle = freddo_options('_onepage_title_features', __('Elements', 'freddo'));
		$featuresSubTitle = freddo_options('_onepage_subtitle_features', __('Amazing Features', 'freddo'));
		$howManyBoxes = freddo_options('_onepage_manybox_features', '3');
		$textLenght = freddo_options('_onepage_lenght_features', '20');
		$customMore = freddo_options('_excerpt_more', '&hellip;');
	?>

<section class="freddo_onepage_section freddo_features" id="<?php echo esc_attr($featuresSectionID); ?>">
	<div class="freddo_features_color"></div>
	<div class="freddo_action_features">
		<?php if($featuresTitle || is_customize_preview()): ?>
			<h2 class="freddo_main_text"><?php echo esc_html($featuresTitle); ?></h2>
		<?php endif; ?>
		<?php if($featuresSubTitle || is_customize_preview()): ?>
			<p class="freddo_subtitle"><?php echo esc_html($featuresSubTitle); ?></p>
		<?php endif; ?>
		<div class="features_columns">
			<?php if ($howManyBoxes == 1): ?>
			<?php
				$fontAwesomeIcon1 = freddo_options('_onepage_fontawesome_1_features', 'fa fa-bell');
				$choosePageBox1 = freddo_options('_onepage_choosepage_1_features');
				$textButton1 = freddo_options('_onepage_boxtextbutton_1_features', __('More Information', 'freddo'));
				$linkButton1 = freddo_options('_onepage_boxlinkbutton_1_features', '#');
			?>
			<div class="one features_columns_single">
				<?php if($fontAwesomeIcon1): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox1): ?>
					<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
					<?php
					$post_content1 = get_post(intval($choosePageBox1));
					$content1 = $post_content1->post_content;
					?>
					<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton1 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ($howManyBoxes == 2): ?>
			<?php
				$fontAwesomeIcon1 = freddo_options('_onepage_fontawesome_1_features', 'fa fa-bell');
				$choosePageBox1 = freddo_options('_onepage_choosepage_1_features');
				$textButton1 = freddo_options('_onepage_boxtextbutton_1_features', __('More Information', 'freddo'));
				$linkButton1 = freddo_options('_onepage_boxlinkbutton_1_features', '#');
				$fontAwesomeIcon2 = freddo_options('_onepage_fontawesome_2_features', 'fa fa-bell');
				$choosePageBox2 = freddo_options('_onepage_choosepage_2_features');
				$textButton2 = freddo_options('_onepage_boxtextbutton_2_features', __('More Information', 'freddo'));
				$linkButton2 = freddo_options('_onepage_boxlinkbutton_2_features', '#');
			?>
			<div class="two features_columns_single">
				<?php if($fontAwesomeIcon1): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox1): ?>
					<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
					<?php
					$post_content1 = get_post(intval($choosePageBox1));
					$content1 = $post_content1->post_content;
					?>
					<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton1 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
				<?php endif; ?>
			</div>
			<div class="two features_columns_single">
				<?php if($fontAwesomeIcon2): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon2); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox2): ?>
					<h3><?php echo get_the_title(intval($choosePageBox2)); ?></h3>
					<?php
					$post_content2 = get_post(intval($choosePageBox2));
					$content2 = $post_content2->post_content;
					?>
					<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton2 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton2); ?>"><?php echo esc_html($textButton2); ?></a></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ($howManyBoxes == 3): ?>
			<?php
				$fontAwesomeIcon1 = freddo_options('_onepage_fontawesome_1_features', 'fa fa-bell');
				$choosePageBox1 = freddo_options('_onepage_choosepage_1_features');
				$textButton1 = freddo_options('_onepage_boxtextbutton_1_features', __('More Information', 'freddo'));
				$linkButton1 = freddo_options('_onepage_boxlinkbutton_1_features', '#');
				$fontAwesomeIcon2 = freddo_options('_onepage_fontawesome_2_features', 'fa fa-bell');
				$choosePageBox2 = freddo_options('_onepage_choosepage_2_features');
				$textButton2 = freddo_options('_onepage_boxtextbutton_2_features', __('More Information', 'freddo'));
				$linkButton2 = freddo_options('_onepage_boxlinkbutton_2_features', '#');
				$fontAwesomeIcon3 = freddo_options('_onepage_fontawesome_3_features', 'fa fa-bell');
				$choosePageBox3 = freddo_options('_onepage_choosepage_3_features');
				$textButton3 = freddo_options('_onepage_boxtextbutton_3_features', __('More Information', 'freddo'));
				$linkButton3 = freddo_options('_onepage_boxlinkbutton_3_features', '#');
			?>
			<!-- 代码部分begin -->
			    <h3 style="text-align:center" class="h_f">Rapid and steady development，to achieve our goal.</h3>
				<div class="tabbox">
					<div class="tab clearfix">
				    	<a href="javascript:;" class="wow fadeInUp on">
				    		<p class="circle"><span class="max_circle">Project Established</span></p>
				    		<p style="padding-top:0;margin-top: 1.5em"><b>2017.1</b></p>
				    	</a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.1s">
				        	<p class="circle"><span class="min_circle">Testnet Released</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2017.9</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.2s">
				        	<p class="circle"><span class="max_circle">Mainnet launched</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2018.4.24</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.3s">
				        	<p class="circle"><span class="min_circle">Mainnet Swap</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b> 2018.5-7</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.4s">
				        	<p class="circle"><span class="min_circle">Smart Contract Launch</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2018.7.26</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.5s">
				        	<p class="circle"><span class="max_circle">Mainnet Improvement</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2018.7-9</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.6s">
				        	<p class="circle"><span class="min_circle">ToB DAPP Dev Support</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2018.10-12</b></p>
				        </a>
				        <a href="javascript:;" class="wow fadeInUp" data-wow-delay="0.7s">
				        	<p class="circle"><span class="max_circle">Ecosystem and Business</span></p>
				        	<p style="padding-top:0;margin-top: 1.5em"><b>2019.1-3</b></p>
				        </a>
				    </div>
				    <div class="content clearfix">
				    	<ul class="clearfix">
				        	<li>
				        		<h2 class="freddo_main_text">Project Established</h2>
				        		<p>The Bytom Blockchain project formally begins in January 2017.</p>
				        	</li>
				            <li>
				            	<h2 class="freddo_main_text">Testnet Released</h2>
				            	<p>Bytom 0.1.0 BigBang version released. China Hangzhou’s First Public Chain Bytom Releases The Alpha Testnet "BigBang".</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">Mainnet launched</h2>
				            	<p>Version 1.0 of the Bytom Blockchain(Mainnet) is officially released.</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">Mainnet Swap</h2>
				            	<p>Complete Mainnet swap, POW support and optimization.</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">Smart Contract Launch</h2>
				            	<p>BThe release of smart contract also marks the establishment of its core, which will further promote the commercialization of the project.</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">Network / Basic Expansions / Contract Support</h2>
								<p>Network: Large-scale deployment and monitoring of full nodes and light nodes, and peer-to-peer network communication and route upgrades.<br/>Basic Expansions: Polish Blockchain Explorer, mobile wallet, ODIN-based public chain ID system.<br/>Contract Support: SDK Development, Enterprise-level Smart Asset Signature System, Bytom Virtual, Machine(BVM) Multi-language Support Phase1.</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">ToB DAPP Development Support</h2>
				            	<p>Business side compliance commercial application DAPP development support: Corporate Digital Financial Management System, Multi-asset configuration DAPP series, Peer-to-peer financial application suite, Blockchainized assets market, BVM Virtual Machine Multi-language Support Phase2.</p>
				            </li>
				            <li>
				            	<h2 class="freddo_main_text">Ecosystem and Business</h2>
				            	<p>1、The first batch of partners reach cooperation. 2、Realize the circulation of multiple asset on chain. 3、Bytom First Developer Conference Bytom Devcon 1. 4、Bytom Asset Ecology Conference Asset 2020</p>
				            </li>
				        </ul>
				    </div>
				</div>
			
				<script>
					$(function(){
						$(".tabbox .tab a").mouseover(function(){
							$(this).addClass('on').siblings().removeClass('on');
							var index = $(this).index();
							number = index;
							$('.tabbox .content li').hide();
							$('.tabbox .content li:eq('+index+')').show();
						});
						
						// var auto = 1;  //等于1则自动切换，其他任意数字则不自动切换
						// if(auto ==1){
						// 	var number = 1;
						// 	var maxNumber = $('.tabbox .tab a').length;
						// 	function autotab(){
						// 		number++;
						// 		number == maxNumber? number = 0 : number;
						// 		$('.tabbox .tab a:eq('+number+')').addClass('on').siblings().removeClass('on');
						// 		$('.tabbox .content ul li:eq('+number+')').show().siblings().hide();
						// 	}
						// 	var tabChange = setInterval(autotab,3000);
						// 	//鼠标悬停暂停切换
						// 	$('.tabbox').mouseover(function(){
						// 		clearInterval(tabChange);
						// 	});
						// 	$('.tabbox').mouseout(function(){
						// 		tabChange = setInterval(autotab,300000);
						// 	});
						//   }
					});
					</script>
				<!-- 代码部分end -->
			<?php endif; ?>
			<?php if ($howManyBoxes == 4): ?>
			<?php
				$fontAwesomeIcon1 = freddo_options('_onepage_fontawesome_1_features', 'fa fa-bell');
				$choosePageBox1 = freddo_options('_onepage_choosepage_1_features');
				$textButton1 = freddo_options('_onepage_boxtextbutton_1_features', __('More Information', 'freddo'));
				$linkButton1 = freddo_options('_onepage_boxlinkbutton_1_features', '#');
				$fontAwesomeIcon2 = freddo_options('_onepage_fontawesome_2_features', 'fa fa-bell');
				$choosePageBox2 = freddo_options('_onepage_choosepage_2_features');
				$textButton2 = freddo_options('_onepage_boxtextbutton_2_features', __('More Information', 'freddo'));
				$linkButton2 = freddo_options('_onepage_boxlinkbutton_2_features', '#');
				$fontAwesomeIcon3 = freddo_options('_onepage_fontawesome_3_features', 'fa fa-bell');
				$choosePageBox3 = freddo_options('_onepage_choosepage_3_features');
				$textButton3 = freddo_options('_onepage_boxtextbutton_3_features', __('More Information', 'freddo'));
				$linkButton3 = freddo_options('_onepage_boxlinkbutton_3_features', '#');
				$fontAwesomeIcon4 = freddo_options('_onepage_fontawesome_4_features', 'fa fa-bell');
				$choosePageBox4 = freddo_options('_onepage_choosepage_4_features');
				$textButton4 = freddo_options('_onepage_boxtextbutton_4_features', __('More Information', 'freddo'));
				$linkButton4 = freddo_options('_onepage_boxlinkbutton_4_features', '#');
			?>
			<div class="four features_columns_single">
				<?php if($fontAwesomeIcon1): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon1); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox1): ?>
					<h3><?php echo get_the_title(intval($choosePageBox1)); ?></h3>
					<?php
					$post_content1 = get_post(intval($choosePageBox1));
					$content1 = $post_content1->post_content;
					?>
					<p><?php echo wp_trim_words($content1 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton1 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton1); ?>"><?php echo esc_html($textButton1); ?></a></div>
				<?php endif; ?>
			</div>
			<div class="four features_columns_single">
				<?php if($fontAwesomeIcon2): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon2); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox2): ?>
					<h3><?php echo get_the_title(intval($choosePageBox2)); ?></h3>
					<?php
					$post_content2 = get_post(intval($choosePageBox2));
					$content2 = $post_content2->post_content;
					?>
					<p><?php echo wp_trim_words($content2 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton2 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton2); ?>"><?php echo esc_html($textButton2); ?></a></div>
				<?php endif; ?>
			</div>
			<div class="four features_columns_single">
				<?php if($fontAwesomeIcon3): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon3); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox3): ?>
					<h3><?php echo get_the_title(intval($choosePageBox3)); ?></h3>
					<?php
					$post_content3 = get_post(intval($choosePageBox3));
					$content3 = $post_content3->post_content;
					?>
					<p><?php echo wp_trim_words($content3 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton3 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton3); ?>"><?php echo esc_html($textButton3); ?></a></div>
				<?php endif; ?>
			</div>
			<div class="four features_columns_single">
				<?php if($fontAwesomeIcon4): ?>
					<div class="featuresIcon"><i class="<?php echo esc_attr($fontAwesomeIcon4); ?>" aria-hidden="true"></i></div>
				<?php endif; ?>
				<?php if($choosePageBox4): ?>
					<h3><?php echo get_the_title(intval($choosePageBox4)); ?></h3>
					<?php
					$post_content4 = get_post(intval($choosePageBox4));
					$content4 = $post_content4->post_content;
					?>
					<p><?php echo wp_trim_words($content4 , intval($textLenght), esc_html($customMore) ); ?></p>
				<?php endif; ?>
				<?php if($textButton4 || is_customize_preview()): ?>
					<div class="freddoButton features"><a href="<?php echo esc_url($linkButton4); ?>"><?php echo esc_html($textButton4); ?></a></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php endif; ?>
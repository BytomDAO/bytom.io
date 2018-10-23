<?php $showTeam = freddo_options('_onepage_section_team', ''); ?>
<?php if ($showTeam == 1) : ?>
	<?php
		$teamSectionID = freddo_options('_onepage_id_team', 'team');
		$teamTitle = freddo_options('_onepage_title_team', __('Our Team', 'freddo'));
		$teamSubTitle = freddo_options('_onepage_subtitle_team', __('Nice to meet you', 'freddo'));
		$customMore = freddo_options('_excerpt_more', '&hellip;');
		$textLenght = freddo_options('_onepage_lenght_team', '50');
		$teamTestimonialBox = array();
		for( $number = 1; $number < FREDDO_VALUE_FOR_TEAM; $number++ ){
			$teamTestimonialBox["$number"] = freddo_options('_onepage_choosepage_'.$number.'_team', '');
		}
	?>
<section class="freddo_onepage_section freddo_team" id="<?php echo esc_attr($teamSectionID); ?>">
	<div class="freddo_team_color"></div>
	<div class="freddo_action_team">
		<?php if($teamTitle || is_customize_preview()): ?>
			<h2 class="freddo_main_text"><?php echo esc_html($teamTitle); ?></h2>
		<?php endif; ?>
		<?php if($teamSubTitle || is_customize_preview()): ?>
			<p class="freddo_subtitle"><?php echo esc_html($teamSubTitle); ?></p>
		<?php endif; ?>
		<div>
						<div class="slide-container" id="slide-container">
						    <div class="slide-body" id="slide-body">
						      <ul class="slide-content" id="slide-content" style="">
						       
						        <li class="slide-item" data-code="ecommerce" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_1.png" alt="">
						            <div class="mask">
						              <div class="bg "></div>
						              <div class="content">
						               <!--  <div class="item-img-panel" style="height: 72px;">
						                  <img src="https://img.alicdn.com/tps/TB1aivqLXXXXXbwXVXXXXXXXXXX-144-144.png" alt="" class="item-img">
						                  <img src="https://img.alicdn.com/tps/TB1fEPxLXXXXXa9XFXXXXXXXXXX-144-144.png" alt="" class="item-img-hover">
						                </div> -->
						 
						                <h3 class="item-title">Oracle<br>Systems</h3>
						                <p class="item-desc">
						                Consistently deliver the highest levels of security, reliability, efficiency, and performance for a wide range of enterprise applications. 
						                </p>
						                
						              </div>
						            </div>
						          </div>
						        </li>
						        
						        <li class="slide-item" data-code="app" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_2.png" alt="">
						            <div class="mask">
						              <div class="bg other-bg"></div>
						              <div class="content">
						               
						 
						                <h3 class="item-title">Decentralized<br>Trading<br>Systems</h3>
						                <p class="item-desc">
						                 A decentralized trading system built on Bytom can place asseting custody, matching transactions, and asset clearing on the blockchain through open source smart contracts.
						                </p>
						                
						              </div>
						            </div>
						          </div>
						        </li>
						        
						        <li class="slide-item" data-code="game" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_3.png" alt="">
						            <div class="mask">
						              <div class="bg "></div>
						              <div class="content">
						               
						 
						                <h3 class="item-title">P2P clearing <br>Settlement <br>Payment systems</h3>
						                <p class="item-desc">
						                  Decentralized exchange built on Bytom does not need to rely on a third party service to hold the customer’s funds. Instead, trades occur directly between users through an automated process.
						                </p>
						                
						              </div>
						            </div>
						          </div>
						        </li>
						        
						        <li class="slide-item" data-code="web" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_4.png" alt="">
						            <div class="mask">
						              <div class="bg other-bg"></div>
						              <div class="content">
						               
						 
						                <h3 class="item-title">Bytom <br>Wallet</h3>
						                <p class="item-desc">
						                 Bytom wallet allows you to trade with the entire world. You can receive BTM from other people using BTM addresses generated in Bytom wallets and vice versa
						                 <a class="item-link btn_download" href="/wallet">Download</a>
						                </p>
						                
						              </div>
						            </div>
						          </div>
						        </li>
						        
						        <li class="slide-item" data-code="media" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_5.png" alt="">
						            <div class="mask">
						              <div class="bg "></div>
						              <div class="content">
						               
						 
						                <h3 class="item-title">Identity <br>Verification</h3>
						                <p class="item-desc">
						                 using Blockchain technology that hash proves the contents of the file and the time stamp proves when the document was created, Bytom can provide a secure, traceable data transaction service to any identy verification.
						                </p>
						                
						              </div>
						            </div>
						          </div>
						        </li>
						        
						        <li class="slide-item" data-code="inance" style="">
						          <div href="javascript:;" target="_blank" style="display:block;height: 100%">
						            <img class="item-bg" src="<?php bloginfo('template_url'); ?>/images/app/application_6.png" alt="">
						            <div class="mask">
						              <div class="bg other-bg"></div>
						              <div class="content">
						               
						 
						                <h3 class="item-title">Asset <br>Tokenization</h3>
						                <p class="item-desc">
						                  All aspects of asset registration, transaction, and settlement can be completed on the bytom blockchain. In this whole process, Bytom is precisely the role of the "infrastructure" of the asset tokenization.
						                </p>
						                
						              </div>
						            </div>
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
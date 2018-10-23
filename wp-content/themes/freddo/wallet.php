<?php
/**
 *
 * Template Name: wallet
 *
 * The template used if you are using a page builder plugin
 *
 * @package freddo
 */

get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/wallet.css" type="text/css" media="screen" />  
<div class="flexslider" style="display:none"></div>
<section class="wallet_about">
	<div class="by-container">
		<h2 class="wallet_about_title">
			Get started with Bytom Wallet
		</h2>
		<div class="wallet_about_dec">
			<div class="wallet_desktop_line" style="margin-bottom: 30px;"></div>
			Bytom wallet is the official wallet highly recommended for everyone, as it’s feature-rich, user-friendly, easy to setup and it supports mining. 
			By using Bytom wallet, you can send or receive BTM coin with Mainnet address.
		</div>
		<div class="wallet_about_thumb">
			<img src="<?php echo get_template_directory_uri();?>/images/wallet/wallet_screen_1.png"  alt="">
		</div>
	</div>
</section>

<section class="bytom_section wallet_desktop">
	<div class="wallet_desktop_bg"></div>
	<div class="by-container">
		<div class="bytom_section_header">
			Bytom Wallet <span>for desktop</span>
		</div>
		<div class="wallet_desktop_columns clearfix">
			<div class="desktop_column one">
				<img src="<?php echo get_template_directory_uri();?>/images/wallet/desktop_1.png">
			</div>
			<div class="desktop_column two">
				<h2>
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/bytom_logo.png" class="wallet_btmlogo">Bytom Wallet
				</h2>
				<p class="wallet_p" style="">
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_macosx.svg">
					<span>Bytom Wallet</span>
					<span  class="dec"><span>for macOS</span>V1.06</span>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/releases/download/v1.0.6rc1/bytom-wallet-desktop-1.0.6rc1-mac.zip" target="_blank">Download</a>
				</p>
				<p class="wallet_p" style="">
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_win.svg">
					<span>Bytom Wallet</span>
					<span class="dec"><span>for Windows</span>v1.06</span>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/releases/download/v1.0.6rc1/bytom-wallet-desktop-1.0.6rc1-win-x64.zip" target="_blank">Win 64</a>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/releases/download/v1.0.6rc1/bytom-wallet-desktop-1.0.6rc1-win-ia32.zip" target="_blank" style="margin-right:10px">Win 32</a>
				</p>
				<p class="wallet_p" style="">
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_linux.svg">
					<span>Bytom Wallet</span>
					<span  class="dec"><span>for Linux</span>v1.06</span>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/releases/download/v1.0.6rc1/bytom-wallet-desktop-1.0.6rc1-linux-x64.zip" target="_blank">Linux 64</a>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/releases/download/v1.0.6rc1/bytom-wallet-desktop-1.0.6rc1-linux-ia32.zip" target="_blank" style="margin-right:10px">Linux 32</a>
				</p>
				<p class="wallet_p" style="">
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_compressed.svg">
					<span>Source code</span>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/archive/v1.0.6rc1.tar.gz" target="_blank">Tar.gz</a>
					<a class="wallet_btn" href="https://github.com/Bytom/bytom/archive/v1.0.6rc1.zip" target="_blank" style="margin-right:10px">Zip</a>
				</p>
				<p class="wallet_p" style="">
					<img src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_doc.svg">
					<span>Bytom User Manual V1.0</span>
					<a class="wallet_btn" href="<?php echo get_template_directory_uri();?>/download/BytomUsermanualV1.0_en.pdf" target="_blank">English</a>
					<a class="wallet_btn" href="<?php echo get_template_directory_uri();?>/download/BytomUsermanualV1.0_ch.pdf" target="_blank" style="margin-right:10px">中文</a>
				</p>
			</div>
		</div>

		<div class="wallet_desktop_version">
			<div class="bytom_table_responsive">
				<table class="bytom_table bytom_table_lg">
					<thead>
						<tr>
							<th>Versions</th>
							<th>Files</th>
							<th>Checksums（MD5）</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Bytom Wallet for macOS v1.06</td>
							<td>bytom-wallet-desktop-1.06-mac.zip</td>
							<td>afa48ef74af418efed096d6c914c9c91</td>
						</tr>
						<tr>
							<td>Bytom Wallet for Win 32 v1.06</td>
							<td>bytom-wallet-desktop-1.06-win-ia32.zip</td>
							<td>85c8ab65a52d90f311f38b334cda1561</td>
						</tr>
						<tr>
							<td>Bytom Wallet for Win 64 v1.06</td>
							<td>bytom-wallet-desktop-1.06-win-x64.zip</td>
							<td>b7af838ef8377e391e19fb87d28b5c5c</td>
						</tr>
						<tr>
							<td>Bytom Wallet for Linux 32 v1.06</td>
							<td>bytom-wallet-desktop-1.06-linux-ia32.zip</td>
							<td>8a097910e8fec5a5aaba22ae78261520</td>
						</tr>
						<tr>
							<td>Bytom Wallet for Linux 64 v1.06</td>
							<td>bytom-wallet-desktop-1.06-linux-x64.zip</td>
							<td>66213e2f1fb475f33b602f8f8acac07f</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="wallet_desktop_more">
			<a href="https://github.com/Bytom/bytom/releases" target="_blank">More versions ></a>
		</div>

		<div class="wallet_desktop_line" style="margin-bottom: 50px;"></div>
		<div class="bytom_table_responsive">
			<table class="bytom_table bytom_table_center">
				<thead>
					<tr>
						<th>Files</th>
						<th>Height</th>
						<th>Size</th>
						<th>Checksums（MD5）</th>
						<th>Last update</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><img width="20" style="margin-right:5px;" src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_compressed_zip.svg">180726-Update.db.zip</td>
						<td>83824</td>
						<td>201.1 MB</td>
						<td>f083bd3406cc10a54f74487dfc5c</td>
						<td>2018-08-30 15:41:58 <small>(GMT+8)</small></td>
						<td>
							<a href="http://p853yonds.bkt.clouddn.com/180830-Update.db.zip" target="_blank">
								<img width="20" style="margin-right:5px" src="<?php echo get_template_directory_uri();?>/images/wallet/icon/icon_download.svg">
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="wallet_desktop_work">
			<div class="wallet_desktop_work_img">
				<img src="<?php echo get_template_directory_uri();?>/images/wallet/how-this-work.svg" alt="">
			</div>
			<ul>
				<li>
					<span>1.</span>Make sure that you have last version of Bytom Wallet (v1.06  ) and have enough free space in destination disk.
				</li>
				<li>
					<span>2.</span>Download object file and make sure you close Bytom Wallet software, 
					<p>- For Windows users, replace object file in shortcut '%APPDATA%/Roaming/Bytom/data/core.db'</p>
					<p>- For Mac users, replace object file in shortcut '~/Library/Bytom/data/core.db'</p>
					<p>- For Linux users, replace object file in shortcut '~/.bytom/data/core.db' </p>
				</li>
				<li>
					<span>3.</span>Make sure that you set correct destination for datadir and replace object file to your downloaded bytom wallet folder.
				</li>
			</ul>
		</div>
	</div>
</section>
<?php
get_sidebar();
get_sidebar('push');   
get_footer();

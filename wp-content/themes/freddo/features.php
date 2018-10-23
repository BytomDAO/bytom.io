<?php
/**
 *
 * Template Name: features
 *
 * The template used if you are using a page builder plugin
 *
 * @package freddo
 */

get_header(); ?>
	<div id="primary" class="content-area content-area_w">
		<main id="main" class="site-main clearfix">
                 <article class="fl">
                 	<!-- <div class="">
			        	 <img width="600" height="240" src="https://crestaproject.com/demo/freddo/wp-content/uploads/2017/11/fresco-blog-2-980x600.jpg" class="attachment-freddo-the-post-small size-freddo-the-post-small wp-post-image" alt="">     
			         </div>		 -->		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Compatible with the UTXO</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>Bytom consists of three layers: data transaction and transmission layer, contract layer and asset interaction layer. The asset interaction layer operates on the assets by calling contracts. The data transaction and transmission layer is compatible with the UTXO model and the transaction data structure of Bitcoin to achieve high-speed concurrence and controllable anonymity.</p>
				     </div><!-- .entry-content -->
				 </article>
				 <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">General address format</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>BIP32, BIP43 and BIP441are used in the design of Bytom wallet to provide support for multi-currency, multi-account, multi-address and multi-key with Hierarchical Deterministic Wallets (or "HD Wallets"). BIP44 provides a five-layer path recommendation: (1) to determine the path rules; (2) types of currency; (3) account; (4) change; (5) index of address index. Users can control wallet for all assets by saving one master private key.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Compatible with National Encryption Standard</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>The asset management and operation of Bytom involves private key, public key and address system, which is achieved through ESCDA encryption and SHA256 hashing in Bitcoin’s design. Bytom will support the Public Key Cryptographic Algorithm SM2 Based on Elliptic Curves 2 and SM3 Cryptographic Hash Algorithm 3 that are compliant with Chinese National standard. In terms of similar computational complexity, SM2 is much faster than RSA and DSA in processing private keys, thus a higher efficiency in encryption. The compression function of SM3 algorithm has similar structure to that of SHA-256. But the design of SM3 algorithm is more complicated. For example, two message words are used for each round of compression function.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">POW algorithm that is friendly to AI ASIC-chips</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c" style="height:301px">
					     <p>Use a new POW algorithm, Matrix and convolution calculation is introduced into the hashing process so that the miners can be used for AI hardware acceleration services.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Asset naming using ODIN</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>The naming of assets will follow ODIN (Open Data Index Name) standards to ensure the uniqueness of assets across the entire network and blockchain. Unlike other blockchain-based identification solutions, ODIN is based on the Bitcoin blockchain and supports the introduction of other blockchains (public blockchain, consortium blockchain, private blockchain) through multi-level marking. ODIN uses blockchain height as naming index instead of registration of character string.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Separate transaction signatures from the rest of the data in a transaction</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>In Bytom’s design, there is a DLT protocol that allows interaction between a variety of assets. Multiple blockchains that adopt the same protocol can exist independently and can be traded cross-chain, making different operators to interact in the same format. Following the principle of minimum authority, Bytom Separate transaction signatures from the rest of the data in a transaction,in the design to achieve isolation between asset management and synchronized distributed ledgers. Such design achieves better programmability and contract support, and reserve interface for bypass channel in the future.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Enhanced trading flexibility</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>Unlike the Ethereum account model, BUTXO can verify transactions in parallel by adopting a mechanism similar to nonce to ensure that each unspent outputs could only be quoted by one transaction. In addition, Bytom is lighter than Ethereum in nature as participants only need to remember unspent outputs as the trade itself carries other relevant information (such as asset ID, units, controller program). Another feature of Bytom is: compact verification, which allows the client to verify the relevant transaction only instead of all the transactions in the block by trusting the amounts signed by the sender. The whole process is realized via Merkle proof.</p>
				     </div><!-- .entry-content -->
				 </article>
				  <article class="fl">		
			        
				     <header class="entry-header">
						<h2 class="entry-title title_line font_c">
							<a href="javascript:;" rel="bookmark">Cross-chain asset dividends distribution through side-chain</a>
						</h2>		
						
				     </header><!-- .entry-header -->
				      <div class="entry-summary font_c">
					     <p>Developers can create a tiny version of the X chain (other blockchains) or Xrelay based on Bytom platform,They could also perform API calls via smart contract to verify network activities on X blockchain, thus achieving cross-chain communication, asset transaction and dividend distribution in the contract.</p>
				     </div><!-- .entry-content -->
				 </article>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_sidebar('push');   
get_footer();

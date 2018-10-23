<?php
/**
 *
 * Template Name: blog
 *
 * The template used if you are using a page builder plugin
 *
 * @package freddo
 */

get_header(); ?>

    <div id="primary" class="content-area content-area_w">
    	<main id="main" class="site-main clearfix">	
    		<div class="blog">
			    <div id="list_content">
			    <?php
			    //$posts_per_page = get_query_var('posts_per_page');
			    $posts_per_page = 20;
				$paged = get_query_var('paged');
				$page  = get_query_var('page');
				$page  = $paged > $page ? $paged : $page;
			    if(empty($page)) $page = 1;
			  	$offset_post = ($page-1)*$posts_per_page;
			    //$posts_all = get_posts('numberposts='.$posts_per_page.'&offset='.$offset_post);

			    global $wpdb;
			    $posts_news_sql = "select * from bytom_news order by post_time desc limit $offset_post,$posts_per_page";
			    $posts_all = $wpdb->get_results($posts_news_sql);
			    if(!empty($posts_all)):
			        foreach($posts_all as $k=>$this_post){
			            $the_permalink = $this_post->link;
			            $the_title = $this_post->title;
			            $post_time = ($this_post->post_time)/1000;
			            $post_date = date("d F Y", $post_time);
			    ?>
			            <div class="blog-container clearfix">
			                <div class="inner">
			                    <a class="post-title" href="<?php echo $the_permalink;?>" target="_blank" rel="nofollow">
			                    	<span  class="fl"><?php echo $the_title;?></span>
			                    	<span  class="fr"><time datetime="<?php echo $post_time;?>"><?php echo $post_date;?></time></span>
			                    </a>
			                </div>     
			            </div>
			    <?php
			        }
			    endif;
			    ?>
			    </div>
			    <?php
			    $url_this = home_url(add_query_arg());
			    $next_page = $page + 1;
			    $url_next_page = home_url(add_query_arg(array('page'=>$next_page)));
			    $prev_page = $page - 1;
			    $url_prev_page = home_url(add_query_arg(array('page'=>$prev_page)));
			    ?>
			    <div class="section-container-a" style="float:left;">
			        <div class="inner" style="" >
			            <a href="javascript:;" class="load_more load_more_prev" style="float: right;color: #fff;margin-top:3em;<?php if($page <= 1){echo 'display:none;';}?>">&gt;&gt;prev</a>
			            <input type="hidden" class="list_more_input" id="list_prev_page" value="<?php echo $url_prev_page;?>" data-id="<?php echo $prev_page;?>" />
			        </div>
			    </div>
			    <div class="section-container-a">
			        <div class="inner" style="" >
			            <a href="javascript:;" class="load_more load_more_next" style="float: right;color: #fff;margin-top:3em">next>></a>
			            <input type="hidden" class="list_more_input" id="list_next_page" value="<?php echo $url_next_page;?>" data-id="<?php echo $next_page;?>" />
			        </div>
			    </div>
			</div>
			<script type="text/javascript">
			//加载更多(分页)
			$('.load_more').click(function(){
			    var _this = $(this);
			    var page_url = $(this).parent().find(".list_more_input").val();
				$.ajax({
					url : page_url,
			        type : 'GET',
			        dataType : 'html',
			        beforeSend:function(XMLHttpRequest){
			        	//_this.find('.request_more_list_a').html('<i class="fa fa-fw fa-chevron-left"></i> waiting...');
			       	},
			        success : function(result){
			        	//_this.find('.request_more_list_a').html('<i class="fa fa-fw fa-chevron-left"></i> more>>');
			        	var new_html = $(result).find("#list_content").html();
			        	if($(result).find("#list_content .blog-container").html()){
			        		$("#list_prev_page").val($(result).find("#list_prev_page").val());
			        		$("#list_next_page").val($(result).find("#list_next_page").val());
			        		$("#list_content").html(new_html);

			        		if($(result).find("#list_prev_page").attr('data-id') > 0){
			        			$(".load_more_prev").css('display','block');
			        		}else{
			        			$(".load_more_prev").css('display','none');
			        		}
			        	}else{
			        		alert("It's the last page.");
			        		//_this.css('display','none');
			        	}
			        }
			    })
			});
			</script>
        </main>
    </div>
<?php
//get_sidebar();
get_sidebar('push');   
get_footer();

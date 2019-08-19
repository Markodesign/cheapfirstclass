<?php
/*
Plugin Name:SEO Friend Link
Plugin URI: http://liucheng.name/
Description: SEO Friend Link. SEO自助友链插件。WP博客挂了这个插件后，别人只需在他的网站首页里挂上你的链接，并从首页点击过来，并完成链接互换的过程。
Author: 柳城
Version: 1.6
Author URI: http://liucheng.name/1427/
*/

/*****************************

v1.0 *SEO自助友链
v1.1 *优化智能获取title， 解决gbk乱码的问题， 
     *优化来源页面是否首页的判断(所有一级和二级域名)。
v1.2 *更加精确的截取title
     *判断来源页面是否有自己的链接
	 *排除是nofollow的链接
	 *新建一个分类seo_friend_link，把url都存放到这个分类。对正常的链接不造成影响
v1.3 *自定义一个 Widget 小工具。在后台开启
v1.4 *fix a bug
v1.5 *优化爬虫
v1.6 * 要求友链的PR值>=1

******************************/
function iconv_utf8($string){
	return iconv("gb2312", "utf-8",$string);
}

function mb_split_title($str, $encoding = 'utf-8') { 
    mb_regex_encoding($encoding); 
    $pattern = array('–', '-', ':', '_', '=', ',', ', ', '!', '~'); #'&', '#'
    $replacement = '|'; 
    for ($i=0; $i<sizeof($pattern); $i++) { 
        $str = mb_ereg_replace($pattern[$i], $replacement, $str); 
    } 
    return $str; 
}

function short_url($url){
	$short_url = str_replace('http://', '', $url);
	$short_url = preg_replace('/^www\./i', '', $short_url);
	if ('/' == substr($short_url, -1)) {$short_url = substr($short_url, 0, -1); }
	return $short_url;
}

function curl_file_get_contents($durl){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $durl);
   curl_setopt($ch, CURLOPT_TIMEOUT, 3);
   curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
   curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $r = curl_exec($ch);
   curl_close($ch);
   return $r;
}

function seo_friend_link(){
	global $wpdb;
	$url = $_SERVER['HTTP_REFERER'];
	$argc = $_SERVER['argc'];
	$all_slash = preg_match_all("/\//", $url, $out);
	if( preg_match("/^http\:\/\/.*?\/$/Ui", $url) && $all_slash=='3' ){ $is_url = 1;  $short_url = short_url($url); }

	$my_home_short = preg_quote( short_url( get_bloginfo('url') ), '/' );
	#$home =  preg_quote($my_home_short,'/');
	if( !preg_match("/$my_home_short/mi",$url) ){ $not_myself = '1'; }

	if( is_home() && $not_myself && $is_url && $argc == '0' ){
		###### get PR ###########
		$pr = pagerank("$short_url");
		if(!$pr){ exit; } ########## 退出

		/** Get the current time **/
	    $blogtime = current_time('mysql'); 
	    list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $blogtime );
	    $link_updated = "$today_year-$today_month-$today_day $hour:$minute:$second";

		$contents = curl_file_get_contents($url);
		if(!$contents){ 
			#无奈有些网站的首页由于网络原因暂时无法抓取到。就不作判断了。
			#$contents = file_get_contents($url);
			$is_link_true = 1;
			$is_not_nofollow = 1;
		}
		if($contents){
			if( preg_match("/<title>(.*?)<\/title>/is",$contents,$result) ){
				$desc = trim($result[1]);
				if(preg_match("/<meta.*?charset=gb/i",$contents)){ $desc = iconv_utf8($desc); }
				#$desc = mb_split_title($result[1]); #old
				#list($title) = explode('|', $desc); #old
				$result = mb_split("–|-|:|_|=|,|，|!|~|\|", $desc); #new
				$title = $result[0]; #new
				$title = trim($title);
			}
			$is_link_true = preg_match_all("/<a(.*?href=.*?$my_home_short.*?)>/mi", $contents, $outputs);
			if($is_link_true){
				foreach ($outputs[1] as $output){
					$is_not_nofollow = !preg_match("/nofollow/mi", $output);
					if($is_not_nofollow) { break; }
				}
			}
		}#end contents

		if(!$title){ $title = $short_url; $no_contents = TRUE; }


		if($title && $is_link_true && $is_not_nofollow){
			$sql_select = "
							SELECT link_id,link_url,link_rating
							FROM $wpdb->terms, $wpdb->term_relationships, $wpdb->term_taxonomy, $wpdb->links
							WHERE slug = 'seo_friend_link'
							AND link_id = object_id
							AND $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id
							AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
							AND  link_url='$url'
						";
			$result_select = $wpdb->get_results($sql_select);
			if($result_select){
				foreach($result_select as $result){
					$link_id = $result->link_id;
					$link_url = $result->link_url;
					$link_rating = $result->link_rating;
				}
				if( $short_url == short_url($link_url) ){ $is_exist_link = 1; }
			}#end result_select

			if($link_id && $is_exist_link){
				$link_rating++;
				if($no_contents){
					$wpdb->update( $wpdb->links, array('link_updated'=>$link_updated, 'link_url'=>$url,  'link_rating'=>$link_rating), array('link_id'=>$link_id) );
				}else{
					$wpdb->update( $wpdb->links, array('link_updated'=>$link_updated, 'link_name'=>$title, 'link_url'=>$url, 'link_description'=>$desc,  'link_rating'=>$link_rating), array('link_id'=>$link_id) );
				}
			}else{
				global $term_taxonomy_id;

				$wpdb->insert($wpdb->links, array('link_url'=>$url , 'link_name'=>$title , 'link_image'=>'' , 'link_target'=>'_blank' , 'link_category'=>'0' , 'link_description'=>$desc , 'link_visible'=>'Y' , 'link_owner'=>'1' , 'link_rating'=>'0' , 'link_updated'=>$link_updated , 'link_rel'=>'' , 'link_notes'=>'' , 'link_rss'=>''));
				$link_id = $wpdb->insert_id;
				$wpdb->insert($wpdb->term_relationships, array('object_id'=>$link_id , 'term_taxonomy_id'=>$term_taxonomy_id, 'term_order'=>'0'));

				#更新count
				$query = "select count from $wpdb->term_taxonomy where term_taxonomy_id='$term_taxonomy_id'";
				$results = $wpdb->get_results($query);
				if($results){
					foreach ($results as $result){
						$count = $result->count;
					}
				}
				$count++;
				if($count){
					$wpdb->update( $wpdb->term_taxonomy , array('count'=>$count), array('term_taxonomy_id'=>$term_taxonomy_id) );
				}
			}# end link_id
		}#end title
	}# end is_home
}#end function


######################### PR值
function pagerank($domain)
{    
    $StartURL = "http://toolbarqueries.google.com/tbr?client=navclient-auto&features=Rank&q=info:";
    $GoogleURL = $StartURL.$domain. '&ch='.HashURL($domain);
    $fcontents = file_get_contents("$GoogleURL");
    $pagerank = substr($fcontents,9);
    if (!$pagerank) return "0";else return $pagerank;
}
   
function HashURL($url)
{   
    $SEED = "Mining PageRank is AGAINST GOOGLE’S TERMS OF SERVICE.";
    $Result = 0x01020345;
    for ($i=0; $i<strlen($url); $i++) 
    {
        $Result ^= ord($SEED{$i%87}) ^ ord($url{$i});
        $Result = (($Result >> 23) & 0x1FF) | $Result << 9 & 0xFFFFFFFF;
    }
    return sprintf("8%x", $Result);
}



function seo_friend_link_activate(){
	global $term_taxonomy_id;
	if(!$term_taxonomy_id){
		global $wpdb;
		$name = 'SEO Friend Link';
		$slug = 'seo_friend_link';
		$wpdb->insert($wpdb->terms, array('name'=>$name , 'slug'=>$slug, 'term_group'=>'0'));
		$term_id = $wpdb->insert_id;
		if($term_id){
			$wpdb->insert($wpdb->term_taxonomy, array('term_id'=>$term_id , 'taxonomy'=>'link_category', 'parent'=>'0'));
		}
	}
}

function term_taxonomy_id(){
	global $wpdb;
	global $term_taxonomy_id;

	$query = "SELECT term_taxonomy_id FROM woodsf54h00yeah_terms AS a, woodsf54h00yeah_term_taxonomy AS b
		     WHERE slug = 'seo_friend_link'
	         AND a.term_id = b.term_id
		     LIMIT 0 , 1";
	$results = $wpdb->get_results($query);
	if($results){
		foreach($results as $result){
			$term_taxonomy_id = $result->term_taxonomy_id;
		}
	}
	#return $term_taxonomy_id;
}

add_action('wp_head','seo_friend_link');
#add_action('wp_footer','seo_friend_link');
register_activation_hook( __FILE__, 'seo_friend_link_activate' );
add_action('init','term_taxonomy_id');



#

/**
 * Links widget class
 *
 * @since 2.8.0
 */
class SEO_Friend_Link_Widget extends WP_Widget {

	function SEO_Friend_Link_Widget() {
		$widget_ops = array('description' => __( "SEO自助友链" ) );
		$this->WP_Widget('seo_friend_link', __('SEO Friend Link'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'SEO Friend Link' ) : $instance['title'], $instance, $this->id_base);
		$limit = empty( $instance['limit'] ) ? '5' : $instance['limit'];

		/*if ( is_admin() && !$category ) {
			// Display All Links widget as such in the widgets screen
			echo $before_widget . $before_title. __('All Links') . $after_title . $after_widget;
			return;
		}*/

		$before_widget = preg_replace('/id="[^"]*"/','id="%id"', $before_widget);
		wp_list_bookmarks(apply_filters('widget_links_args', array(
			'category_name' => 'SEO Friend Link', 'title_li' => __($title),
			'title_before' => $before_title, 'title_after' => $after_title,
			'category_before' => $before_widget, 'category_after' => $after_widget,
			'orderby' => 'updated', 'order' => 'DESC', 'class' => 'linkcat widget',
			'limit' => $limit, 'categorize' => 0
		)));
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = intval($new_instance['limit']);

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'SEO Friend Link', 'limit' => '5') );
		$title = esc_attr( $instance['title'] );
		$limit = intval( $instance['limit'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit:' ); ?></label> <input type="text" value="<?php echo $limit; ?>" name="<?php echo $this->get_field_name('limit'); ?>" id="<?php echo $this->get_field_id('limit'); ?>" class="widefat" />
		</p>
<?php
	}

}

function seo_friend_link_widgets_init() {
	register_widget('SEO_Friend_Link_Widget'); 
	#do_action('widgets_init');
	
}
add_action('widgets_init', 'seo_friend_link_widgets_init');
#add_action('init', 'seo_friend_link_widgets_init');
?>
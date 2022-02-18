<?php
/**
 * @package Cactus Masonry
 * @version 1.1.0.3
 */
/*
 * Plugin Name: Cactus Masonry Classic
 * Plugin URI: http://cactuscomputers.com.au/masonry
 * Description: A highly customizable masonry styled gallery of post thumbnails.  Please refer to the <a href="http://cactuscomputers.com.au/masonry">plugin Home Page</a> for detailed instructions.
 * Version: 1.1.0.3
 * Author: Cactus Computers
 * Author URI: http://www.cactuscomputers.com.au/masonry
 * License: Licenced to Thrill... but also GPLv2.
 */
 /*  Copyright 2014  Cactus Computers  (email : forum@cactus.cloud)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	Simply put - from the author:  This plugin is designed to be helpful,
	and we will take all reasonable efforts to maintain the plugin's quality for all
	those who use it.
	
	However, there is no guarantee as to the effectiveness of the plugin, nor is 
	there any guarantee that the plugin will be supported indefinitely.  One day the plugin
	may become insecure or obsolete due to changing online conditions and/or a lack of 
	updates.  This plugin also relies on third party JavaScript modules and thus may 
	become ineffective due to these modules becoming obsolete.
	
	Any loss arising directly or indirectly from the plugin is unfortunate and unintentional.
	However, by using this plugin you agree to accept any risk of loss caused and not
	hold the authors or distributors liable for any such loss.  This plugin is supplied
	with the best of intentions, free of charge, to help those who wish to use it.
	
	By using this plugin you agree to accept this risk of loss caused and not hold the
	author responsible.
	
	I really hope this plugin can help you and that you have a great experience with it!
*/


/* TO DO:
	- Update Wordpress Version
	- document 'post_id' CSV IDs
	- document 'display_custom_field'
	*/

class Cactus_Masonry {	
	private static $id = "CM_GALLERY_";
	private static $CM_version = "1.1.0.3";
	private static $a = null;
	private static $post_count = 0;
	
	private static $noscript_text;
	private static $nomasonry_text;
	
	static public function init() {
		include_once('cactus-masonry-options.php');
		add_shortcode("cactus-masonry", array(__CLASS__, "masonrypostgallery_handler"));
		add_shortcode("masonry-post-gallery", array(__CLASS__, "masonrypostgallery_handler"));
		add_action("wp_headers", array(__CLASS__, "cmpg_add_header"));
		add_action("wp_enqueue_scripts", array(__CLASS__, "cmpg_add_dependencies"));
		//ADD JQUERY TO HEAD
		add_action('admin_menu', 'cmpg_add_instructions');
		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", array(__CLASS__, 'plugin_settings_link'));
	}

	static public function cmpg_add_dependencies() {
		wp_enqueue_script('jquery');		
	}
	
	//Attempts to stop iNTERNET eXPLORER!!!!!! from entering incompatibility mode
	static public function cmpg_add_header($head) {
		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) $head['X-UA-Compatible'] = 'IE=edge,chrome=1';
		return $head;
	}
	
	static public function plugin_settings_link($links) {
		$newlink = "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=cactus%40cactuscomputers%2ecom%2eau&amp;lc=AU&amp;currency_code=AUD&amp;bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted'>Donate</a>";
		array_unshift($links, $newlink);
		$newlink = "<a href='http://cactuscomputers.com.au/masonry/' target='_blank'>Our Website</a>";
		array_unshift($links, $newlink);
		$newlink = "<a href='http://cactuscomputers.com.au/masonry/how-to-use/' target='_blank'>Instructions</a>";
		array_unshift($links, $newlink);
		return $links;
	}

	static private function cmpg_prep_JS_globals() {
		return "
			<script type='text/javascript'>
				IE_LT_9" . self::$id . " = false;//Lower than IE9
			</script>
			<!--[if lt IE 9 ]>
				<script type='text/javascript'>
					IE_LT_9" . self::$id . " = true;
				</script>
			<![endif]-->";
	}

	static public function masonrypostgallery_handler($atts) {
		global $CM_JS_MSG_COUNTER;
		global $CM_LOADER_COUNTER;
		if(!isset($CM_LOADER_COUNTER)) $CM_LOADER_COUNTER = 0;
		if(!isset($CM_JS_MSG_COUNTER)) $CM_JS_MSG_COUNTER = 0;
		self::$id = "CM_GALLERY_" . mt_rand(10000,99999);
		self::$post_count = 0;
		
		//Accept input parameters
		self::$a = shortcode_atts(array(
			'quality' 					=> 	"thumbnail", 
			'masonry' 					=> 	true,
			'max_width'					=> 	"none", 
			'max_height' 				=> 	"none", 
			'width' 					=> 	"auto",
			'height'					=> 	"auto", 
			'horizontal_spacing' 		=> 	10,
			'vertical_spacing' 			=> 	10, 
			'fit_width' 				=> 	false,
			'border_color' 				=>	"#000000", 
			'border_thickness' 			=>	"0px",
			'outer_border_color' 		=>	"#000000",  
			'outer_border_thickness'	=>	"0px",
			'post_category' 			=>	"", 
			'post_order'				=>	"DESC", 
			'post_orderby' 				=>	"post_date", 
			'post_id'					=>	"",
			'gallery_align' 			=>	"center",
			'image_background_color' 	=>	"#ffffff", 
			'hover_color' 				=>	"#ffffff", 
			'hover_intensity' 			=>	"0.5",
			'upscale_narrow_images'		=>	0, 
			'upscale_short_images' 		=>	0, 
			'max_upscale_quality' 		=>	"large",
			'noscript_width' 			=>	"auto", 
			'noscript_height' 			=>	"auto",
			'noscript_max_width' 		=>	"none",
			'noscript_max_height' 		=>	"none",
			'upscale_max_width' 		=>	"none", 
			'upscale_max_height' 		=>	"none",
			'link_location' 			=>	"post", 
			'show_lightbox' 			=>	false,
			'browse_with_lightbox' 		=>	false, 
			'show_lightbox_title' 		=>	false, 
			'soft_gutter' 				=>	0,
			'infinite_scroll' 			=>	true, 
			'posts_per_page' 			=>	30,
			'show_loader' 				=>	true, 
			'search_start'				=>	0, 
			'page_size' 				=>	1000, 
			'test_mode' 				=>	false, 
			'default_image_id' 			=>	false, 
			'show_posts' 				=>	true,
			'show_pages' 				=>	false,
			'require_javascript' 		=>	false,
			'javascript_error_message' 	=>	'Please enable JavaScript to properly view this page.',
			'infinite_scroll_buffer' 	=>	400,
			'display_post_titles' 		=>	false,
			'display_post_excerpts' 	=>	false,
			'display_post_categories' 	=>	false,
			'custom_post_types' 		=>	"",
			'load_js'					=>	true,
			'force_auto_width'			=>	false,
			'crop_images'				=>	false,
			'link_custom_class'			=>	'',
			'post_parent_id'			=>	'',
			'post_tag_slug'				=>	'',
			'post_taxonomy'				=>	'',
			'post_taxonomy_term'		=>	'',
			'link_custom_rel'			=>	'',
			'transition_duration'		=>	0,
			'open_in_new_windows'		=>	false,
			'category_as_brick_class'	=>	false,
			'id_as_brick_class'			=>	false,
			'stamp_id'					=>	'',
			'category_and'				=>	'',
			'category_ids'				=>	'',
			'author_ids'				=>	'',
			'custom_id'					=>	'',
			'display_custom_field'		=>	''
			), $atts);
		
		//Get custom Id
		if(self::$a['custom_id'] != '') self::$id = self::$a['custom_id'];		
		//Prepare output variable
		$output = self::cmpg_prep_JS_globals();
		//Find global variable
		global $post;
		
		//Fix boolean parameter values
		self::$a['show_lightbox'] = self::cmpg_fix_boolean(self::$a['show_lightbox'], false);
		self::$a['browse_with_lightbox'] = self::cmpg_fix_boolean(self::$a['browse_with_lightbox'], false);
		self::$a['show_lightbox_title'] = self::cmpg_fix_boolean(self::$a['show_lightbox_title'], false);
		self::$a['masonry'] = self::cmpg_fix_boolean(self::$a['masonry'], true);
		self::$a['fit_width'] = self::cmpg_fix_boolean(self::$a['fit_width'], false);
		self::$a['infinite_scroll'] = self::cmpg_fix_boolean(self::$a['infinite_scroll'], true);
		self::$a['show_loader'] = self::cmpg_fix_boolean(self::$a['show_loader'], true);
		self::$a['test_mode'] = self::cmpg_fix_boolean(self::$a['test_mode'], false);
		self::$a['show_pages'] = self::cmpg_fix_boolean(self::$a['show_pages'], false);
		self::$a['show_posts'] = self::cmpg_fix_boolean(self::$a['show_posts'], true);
		self::$a['require_javascript'] = self::cmpg_fix_boolean(self::$a['require_javascript'], false);
		self::$a['display_post_titles'] = self::cmpg_fix_boolean(self::$a['display_post_titles'], false);
		self::$a['display_post_excerpts'] = self::cmpg_fix_boolean(self::$a['display_post_excerpts'], false);
		self::$a['display_post_categories'] = self::cmpg_fix_boolean(self::$a['display_post_categories'], false);
		self::$a['load_js'] = self::cmpg_fix_boolean(self::$a['load_js'], true);
		self::$a['force_auto_width'] = self::cmpg_fix_boolean(self::$a['force_auto_width'], true);
		self::$a['crop_images'] = self::cmpg_fix_boolean(self::$a['crop_images'], true);
		self::$a['open_in_new_windows'] = self::cmpg_fix_boolean(self::$a['open_in_new_windows'], false);
		self::$a['category_as_brick_class'] = self::cmpg_fix_boolean(self::$a['category_as_brick_class'], false);
		self::$a['id_as_brick_class'] = self::cmpg_fix_boolean(self::$a['id_as_brick_class'], false);
		//Load external libraries
		if(self::$a['load_js']) {
			wp_enqueue_style('MPG_style', plugin_dir_url(__FILE__) . 'masonry-post-gallery.min.css');
			if(self::$a['show_lightbox']) wp_enqueue_style('Lightbox_style', plugin_dir_url(__FILE__) . 'lightbox.min.css');
			wp_enqueue_script('Masonry', plugin_dir_url(__FILE__) . 'masonry.pkgd.min.js');
			wp_enqueue_script('ImagesLoaded', plugin_dir_url(__FILE__) . 'imagesloaded.pkgd.min.js');
			wp_enqueue_script('Spin', plugin_dir_url(__FILE__) . 'spin.min.js');
			wp_enqueue_script('CactusMasonry', plugin_dir_url(__FILE__) . 'cactus-masonry.min.js');
			if(self::$a['show_lightbox']) wp_enqueue_script('Lightbox', plugin_dir_url(__FILE__) . 'lightbox.min.js', array('jquery'));
		}
		//Disable masonry in IE 7 and lower
		if(preg_match('/(?i)msie [5-7]/',$_SERVER['HTTP_USER_AGENT'])) self::$a['masonry'] = false;
		//Fix transition duration
		if(self::$a['transition_duration'] != 0) self::$a['transition_duration'] = "'".self::$a['transition_duration']."'";
		//Start the Main DIV
		$output .= "
	<div class='CM_area' data-plugin='Cactus Masonry' data-version='" . self::$CM_version . "'>" . self::cmpg_create_styles() . "
		<div data-version='" . self::$CM_version . "' class='masonry_post_gallery'>
			<noscript>";
		if(self::$a['javascript_error_message'] != "" && self::$a['masonry']) {
			if($CM_JS_MSG_COUNTER == 0) $output .= "
				<h3 class='cmpg_javascript_error'>" . self::$a['javascript_error_message'] . "</h3>";
			$CM_JS_MSG_COUNTER++;
		}
		//Prepare & Execute WordPress query
		$post_type = array('cactus_none');
		if(self::$a['show_pages']) array_push($post_type, 'page');
		if(self::$a['show_posts']) array_push($post_type, 'post');
		//Parse category_and
		$temp = explode(",", self::$a['category_and']);
		$i_size = count($temp);
		self::$a['category_and'] = array();
		for($i = 0; $i < $i_size; $i++) {
			if(strlen($temp[$i]) > 0) {
				$out = intval($temp[$i]);
				if($out > 0) array_push(self::$a['category_and'], $out);
			}
		}
		//Parse category_ids
		$temp = explode(",", self::$a['category_ids']);
		$i_size = count($temp);
		self::$a['category_ids'] = array();
		for($i = 0; $i < $i_size; $i++) {
			if(strlen($temp[$i]) > 0) {
				$out = intval($temp[$i]);
				if($out != 0) array_push(self::$a['category_ids'], $out);
			}
		}
		//Parse author_ids
		$temp = explode(",", self::$a['author_ids']);
		$i_size = count($temp);
		self::$a['author_ids'] = array();
		for($i = 0; $i < $i_size; $i++) {
			if(strlen($temp[$i]) > 0) {
				$out = intval($temp[$i]);
				if($out != 0) array_push(self::$a['author_ids'], $out);
			}
		}
		
		//Set up query
		$args = array(	'posts_per_page' => self::$a['page_size'], 
						'offset' => self::$a['search_start'],
						'orderby' => self::fix_sort_column(self::$a['post_orderby']), 
						'order' => self::$a['post_order'],
						'post_parent' => self::$a['post_parent_id'],
						'tag' => self::$a['post_tag_slug'],
						'post_type' => array_merge($post_type, explode(',', self::$a['custom_post_types']))
						);
		//category_and
		if(count(self::$a['category_and']) > 0) $args['category__and'] = self::$a['category_and'];
		//category_ids
		if(count(self::$a['category_ids']) > 0) $args['category'] = implode(',',self::$a['category_ids']);
		//Generic category
		if(strlen(self::$a['post_category']) > 0) $args['category_name'] = self::$a['post_category'];
		//author_ids
		if(count(self::$a['author_ids']) > 0) $args['author'] = implode(',',self::$a['author_ids']);
		//Taxonomy
		if(strlen(self::$a['post_taxonomy']) > 0 && strlen(self::$a['post_taxonomy_term']) > 0) $args[self::$a['post_taxonomy']] = self::$a['post_taxonomy_term'];
		
		$post_ids = explode(",", self::$a['post_id']);
		$posts_in = array();
		$posts_out = array();
		for($i = 0, $j = count($post_ids); $i < $j; $i++) {
			$t = intval($post_ids[$i]);
			if($t > 0) $posts_in[] = $t;
			else if($t < 0) $posts_out[] = abs($t);
		}
		$args['post__in'] = $posts_in;
		$args['post__not_in'] = $posts_out;
		
		//Check thumbnail
		if(self::$a['default_image_id'] === false) $args['meta'] = array (
																		'key'	=> '_thumbnail_id',
																		'compare' => 'EXISTS'
																	);
		
		$lastposts = get_posts($args);
		//Parse stamp IDs
		self::$a['stamp_id'] = explode(",", self::$a['stamp_id']);
		$i_size = count(self::$a['stamp_id']);
		for($i = 0; $i < $i_size; $i++) {
			self::$a['stamp_id'][$i] = intval(self::$a['stamp_id'][$i]);
		}
		
		//For each post found by the query:
		$script_text = "";
		self::$noscript_text = "";
		self::$nomasonry_text = "";
		foreach($lastposts as $post) {
			setup_postdata($post);
			$script_text .= self::render_post();
			self::$post_count++;
		}
		//Broadcast post count
		global $GLOBALS; 
		$GLOBALS['cactus_masonry_post_count'] = self::$post_count;
		$output .= self::$noscript_text . "
			</noscript>
		</div>";
		self::$noscript_text = "";
		if(self::$a['masonry']) {
			$output .= "
			<script>
				var elems" . self::$id . " = Array();
				var timer" . self::$id . " = null;
				var s = '';
				var el = null;\n";
		
			$output .= $script_text . "</script>";
		}
		$output .= "
		<div id='" . self::$id . "' data-version='" . self::$CM_version . "' class='masonry_post_gallery'>";
		if(!self::$a['masonry']) $output .= self::$nomasonry_text;
		self::$nomasonry_text = "";
		$output .= "
		</div>";
		$script_text = "";
		wp_reset_postdata();
		//Draw loading box
		if(self::$a['show_loader'] && $CM_LOADER_COUNTER == 0) {
			$CM_LOADER_COUNTER++;
			$output .= "
		<div id='MPG_Loader_Container'>
			<div id='MPG_Loader_Color'>
				<div id='MPG_Spin_Box'>
				</div>
				<div id='MPG_Loader'>
					Loading...
				</div>
			</div>
		</div>";
		}
		$output .= "
	</div>";
		return $output . self::cmpg_create_javascript();
	}

	static private function fix_sort_column($col) {
		if($col == 'author' || $col ==  'date' || $col ==  'modified' || $col ==  'parent' || $col == 'title' || $col == 'excerpt' || $col == 'content') return 'post_' . $col;
		return $col;
	}

	static private function remove_special_chars($str, $hide_new_lines = true) {
		$str = trim($str);
		$str = str_replace("'", "&#39;", $str);
		$str = str_replace('‘', "&lsquo;", $str);
		$str = str_replace('’', "&rsquo;", $str);
		$str = str_replace('“', "&ldquo;", $str);
		$str = str_replace('”', "&rdquo;", $str);
		if($hide_new_lines) $str = str_replace(array("\r\n","\r","\n"), "", $str);
		else $str = str_replace(array("\r\n","\r","\n"), "<br/>", $str);
		return wptexturize($str);
	}
	
	static private function render_post() {
		global $post;
		$output = "";
		$data_text = "";
		$tit = addslashes(self::remove_special_chars(get_post_field("post_title",($post->ID), "display")));
		//Excerpt
		if(self::$a['display_post_excerpts']) $excerpt = addslashes(self::remove_special_chars(get_post_field("post_excerpt",($post->ID), "display"), false));
		else $excerpt = "";
		//Get the categories
		if(self::$a['display_post_categories']) $cats = get_the_category($post->ID);
		else $cats = array();
		//Custom field for databox
		if(self::$a['display_custom_field'] != '') $custom = addslashes(self::remove_special_chars(preg_replace("/\[.+?\]/", "", get_post_field(self::$a['display_custom_field'],($post->ID), "display")), false));
		else $custom = "";
		//Should databox be shown?
		$show_databox = (!empty($cats) || (self::$a['display_post_titles'] && strlen($tit) > 0) || strlen($excerpt) > 0 || strlen($custom) > 0);
		if(has_post_thumbnail()) $iid = get_post_thumbnail_id($post->ID);
		else $iid = self::$a['default_image_id'];
		$thumbnail = self::cmpg_upsize_image($iid, self::$a['quality'], self::$a['max_upscale_quality'], self::$a['upscale_max_width'], self::$a['upscale_max_height'], self::$a['upscale_narrow_images'], self::$a['upscale_short_images']);		
		if(!$thumbnail) {
			$output.="console.log('Cactus Masonry Error: -" . self::$a['default_image_id'] . "- Image with ID={$iid} cannot be found');";
			return $output;
		}
		$link_type = "a";
		$link_class = "masonry_brick_a";
		if(self::$a['link_custom_class'] != '') $link_class .= " " . self::$a['link_custom_class'];
		$lightbox_text = " data-lightbox='";
		if(self::$a['browse_with_lightbox'] === true) {
			$lightbox_text .= "thispage'";
			$data_lightbox = "thispage";
		} else {
			$lightbox_text .= $post->ID . "'";
			$data_lightbox = $post->ID;
		}
		if(self::$a['show_lightbox_title'] === true) $lightbox_text .= " data-title='" . $tit . "'";
		//Set where each image links and handle any interference with the show_lightbox parameter
		if(has_post_thumbnail()) {
			switch(self::$a['link_location']) {
				case "image":
					$lnk = $thumbnail[0];
					break;
				case "thumbnail":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'thumbnail');
					$lnk = $lnka[0];
					break;
				case "medium":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
					$lnk = $lnka[0];
					break;
				case "large":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
					$lnk = $lnka[0];
					break;
				case "full":
					$lnka = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
					$lnk = $lnka[0];
					break;
				case "none":
					$lnk = "";
					$link_type = "div";
					self::$a['show_lightbox'] = false;
					break;
				default:
					$lnk = get_permalink();	
					self::$a['show_lightbox'] = false;
			}
		} else switch(self::$a['link_location']) {//Default Image
			case "image":
				$lnk = $thumbnail[0];
				break;
			case "thumbnail":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'thumbnail');
				$lnk = $lnka[0];
				break;
			case "medium":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'medium');
				$lnk = $lnka[0];
				break;
			case "large":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'large');
				$lnk = $lnka[0];
				break;
			case "full":
				$lnka = wp_get_attachment_image_src(self::$a['default_image_id'],'full');
				$lnk = $lnka[0];
				break;
			case "none":
				$lnk = "";
				$link_type = "div";
				self::$a['show_lightbox'] = false;
				break;
			default:
				$lnk = get_permalink();	
				self::$a['show_lightbox'] = false;
		}
		if(!(self::$a['show_lightbox'] === true)) {
			$lightbox_text = "";
			$data_lightbox = "";
		}
		//Sort out databox
		if($show_databox) {
			$data_text = "<div class='cactus_masonry_databox'>";
			if(self::$a['display_post_titles'] && strlen($tit) > 0) $data_text .= "<div class='cm_title'>{$tit}</div>";
			if(strlen($excerpt) > 0) $data_text .= "<div class='cm_exerpt cm_excerpt'>{$excerpt}</div>";
			if(strlen($custom) > 0) $data_text .= "<div class='cm_custom'>{$custom}</div>";
			//Draw categories
			if(!empty($cats)) {
				$data_text .= "<div class='cm_categories'>";
				for($i = 0, $j = count($cats); $i < $j; $i++) {
					$data_text .= "<span>" . $cats[$i]->name . "</span>";
				}
				$data_text .= "</div>";	
			}
			$data_text .= "</div>";	
		}
		//Get div max dimensions
		if($thumbnail[4]) $max_height = self::$a['upscale_max_height'];
		else $max_height = self::$a['max_height'];
		if($thumbnail[5]) $max_width = self::$a['upscale_max_width'];
		else $max_width = self::$a['max_width'];
		//Add borders to max-heights if px values
		if(substr(strtoupper($max_width), -2) == 'PX') {
			$tmw = (int)(substr($max_width, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$max_width = "" . $tmw . "px";
		}
		if(substr(strtoupper($max_height), -2) == 'PX') {
			$tmh = (int)(substr($max_height, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$max_height = "" . $tmh . "px";
		}
		//Get div normal dimensions
		$norm_width = self::$a['width'];
		$norm_height = self::$a['height'];
		if(substr(strtoupper($norm_width), -2) == 'PX') {
			$tmw = (int)(substr($norm_width, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmw += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$norm_width = "" . $tmw . "px";
		}
		if(substr(strtoupper($norm_height), -2) == 'PX') {
			$tmh = (int)(substr($norm_height, 0, -2));
			if(substr(strtoupper(self::$a['border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['border_thickness'], 0, -2));
			if(substr(strtoupper(self::$a['outer_border_thickness']), -2) == 'PX') $tmh += (int)(substr(self::$a['outer_border_thickness'], 0, -2));
			$norm_height = "" . $tmh . "px";
		}
		if(self::$a['masonry'] === true) {
			/*
				DRAW JAVASCRIPT BOX
			*/
			//Write the JavaScript
			//Start with the innerHTML of the masonry_brick DIVs
			$output .= "				s = \"<img class='masonry_brick_img size-thumbnail' src='{$thumbnail[0]}' alt='{$tit}' style='";
			if(!($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) && (self::$a['width'] != 'auto')) $output .= "width: 100%; ";
			$output .= "height: " . self::$a['height'] . "; ";		
			$output .= "max-height: " . self::$a['max_height'] . "; ";
			if(self::$a['crop_images']) $output .= "visibility: hidden; ";
			$output .= "'/>";
			if(self::$a['crop_images']) $output .= "<div class='cactus_masonry_cropped' style='background-image: url({$thumbnail[0]});'></div>";
			//Add the databox containing the title and excerpt
			if($show_databox) $output .= $data_text;
			//Create DOM Element for masonry_brick DIV
			$output .= "\";
				lk = document.createElement('{$link_type}');
				lk.className = '{$link_class}';\n";
			if(self::$a['link_custom_rel'] != "") $output .= "lk.rel = '" . self::$a['link_custom_rel'] . "';\n";
			if(self::$a['open_in_new_windows']) $output .=  "lk.setAttribute('target', '_blank');\n";
			$output .= "				lk.style.display = 'block';
				lk.href = \"{$lnk}\";";
			if($data_lightbox != "")
				$output .= "
				lk.setAttribute('data-lightbox', '{$data_lightbox}');";
			if(self::$a['show_lightbox_title'] === true)
				$output .= "
				lk.setAttribute('data-title', \"{$tit}\");";
			$output .= "
				lk.innerHTML = s;
				el = document.createElement('div');";
			$i_class = "";
			if(self::$a['category_as_brick_class']) {
				$cats = wp_get_post_categories($post->ID);
				$i_size = count($cats);
				for($i = 0; $i < $i_size; $i++) {
					$i_out = str_replace(" ","_",trim(get_category($cats[$i])->name));
					$i_out = trim(preg_replace("/[^\d\w_]/","",$i_out));
					if(count($i_out) > 0) $i_class .= " mpg_" . strtolower($i_out);
				}
			}
			if(self::$a['id_as_brick_class']) $i_class .= " mpg_id_" . $post->ID;
			$main_class = "masonry_brick";
			if(in_array($post->ID, self::$a['stamp_id'])) $main_class = "masonry_stamp mpg_id_" . $post->ID;
			$output .= "
				el.className = '{$main_class}{$i_class}';
				el.style.opacity = '0';
				el.style.display = 'inline-block';
				el.style.height = '" . $norm_height . "';
				el.appendChild(lk);\n";
			//Set width
			if($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) $output .= "			el.style.width = 'auto';\n";
			else $output .= "				el.style.width = '" . $norm_width . "';\n";
			$output .= "				el.style.maxWidth = '" . $max_width . "';\n";
			$output .= "				el.style.maxHeight = '" . $max_height . "';\n";
			$output .= "				elems" . self::$id . ".push(el);\n";
			/*
				DRAW NOSCRIPT BOX
			*/
			if(!self::$a['require_javascript']) {
				self::$noscript_text .= "		
					<div class='{$main_class}{$i_class}' style='height: " . self::$a['noscript_height'] . "; width: " . self::$a['noscript_width'] . ";	max-height: " . self::$a['noscript_max_height'] . "; max-width: " . self::$a['noscript_max_width'] . ";'>
						<{$link_type} class='{$link_class}' style='display: block; height: 100%; width: 100%;' href='{$lnk}'>
							<img class='masonry_brick_img' style='display: block; height: 100%; width: 100%;' src='{$thumbnail[0]}' alt='{$tit}'/>";
				if($show_databox) self::$noscript_text .= $data_text;		
				self::$noscript_text .= "
						</{$link_type}>
					</div>";
			}
		/*
			MASONRY IS OFF
		*/
		} else if(!self::$a['masonry']) {//Masonry Off
			self::$nomasonry_text .= "
			<div class='masonry_brick' style='display: inline-block; width: {$norm_width}; height: {$norm_height}; max-width: {$max_width}; max-height: {$max_height};' >
			<{$link_type} {$lightbox_text} class='{$link_class}' href='{$lnk}'>
				<img class='masonry_brick_img' src='{$thumbnail[0]}' alt='{$tit}' style='";
			if(!($thumbnail[5] && strpos(self::$a['upscale_max_width'], '%') !== false) && (self::$a['width'] != 'auto')) self::$nomasonry_text .= "width: 100%; ";
			if(self::$a['crop_images']) self::$nomasonry_text .= "visibility: hidden; ";
			self::$nomasonry_text .= "height: " . self::$a['height'] . "; ";		
			self::$nomasonry_text .= "max-height: " . self::$a['max_height'] . "; ";
			self::$nomasonry_text .= "'/>";
			if(self::$a['crop_images']) self::$nomasonry_text .= "<div class='cactus_masonry_cropped' style='background-image: url({$thumbnail[0]});'></div>";
			if($show_databox) self::$nomasonry_text .= $data_text;
			self::$nomasonry_text .= "
			</{$link_type}>
		</div>\n";
		}
		return $output;
	}

	static private function cmpg_bool_to_string($bool) {
		return ($bool) ? "true" : "false";
	}

	static private function cmpg_fix_boolean($val, $default) {
		if($val === true || $val === false) return $val;
		if(strtolower($val) == "true") return true;
		if(strtolower($val) == "false") return false;
		return $default;
	}

	static private function cmpg_search_array_for_index($value, $arr, $default) {
		$i_size = count($arr);
		for($i = 0; $i < $i_size; $i++) {
			if($arr[$i] == $value) return $i;
		}
		return $default;
	}

	static private function cmpg_get_next_image_size($original, $max) {
		$sizes = array("thumbnail", "medium", "large", "full");
		//Get index of $max size - this will be as far as we search
		$max_size_index = cmpg_search_array_for_index($max, $sizes, count($sizes)-1)+1;
		//Return the next index value after the original element
		$found = false;
		$i_size = $max_size_index;
		for($i = 0; $i < $i_size; $i++) {
			if($found) return $sizes[$i];
			$found = ($sizes[$i] == $original);
		}
		return $original;
	}

	static private function cmpg_text_to_number($txt) {
		$out = filter_var($txt, FILTER_SANITIZE_NUMBER_INT);
		if($out == "") return 0;
		return $out;
	}

	static private function cmpg_upsize_image($ID, $quality, $max_quality, $max_width, $max_height, $min_width, $min_height) {
		$thumb = wp_get_attachment_image_src($ID,$quality);
		if(!$thumb) return false;
		//1 - width - 2 - height
		//Exit if required
		if(($min_width == 0 && $min_height == 0) || ($thumb[1] >= $min_width && $thumb[2] >= $min_height)) {
			array_push($thumb, false);
			array_push($thumb, false);
			return $thumb;
		}
		$nextsize = cmpg_get_next_image_size($quality, $max_quality);
		//Sanitize maximums
		$max_height = cmpg_text_to_number($max_height);
		$max_width = cmpg_text_to_number($max_width);
		//Record nature of upsize
		$width_resize = (($thumb[1] < $min_width) && ($thumb[1] < $max_width || $max_width == 0));
		$height_resize = (($thumb[2] < $min_height) && ($thumb[2] < $max_height || $max_height == 0));
		//While
		//	- Either thumb width or height is less than minimum
		//	- There is a larger size thumbnail available
		//	- Both thumb width and height are less than maximum (unless maximum is 0)
		while(($thumb[1] < $min_width || $thumb[2] < $min_height) && ($nextsize != $quality) && ($thumb[1] < $max_width || $max_width == 0) && ($thumb[2] < $max_height || $max_height == 0)) {
			$quality = $nextsize;
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($ID),$nextsize);	
			$nextsize = cmpg_get_next_image_size($quality, $max_quality);
		}
		if(!$thumb) return false;
		array_push($thumb, $width_resize);
		array_push($thumb, $height_resize);
		return $thumb;
	}

	/**		Creates the stylesheet for the gallery		**/
	static private function cmpg_create_styles() {
		return "
		<style scoped>
			div.masonry_brick {
				margin-bottom: " . round(self::$a['vertical_spacing']/2,1) . "px;
				padding-right: " . round(self::$a['horizontal_spacing']/2,1) . "px;
				padding-left: " . round(self::$a['horizontal_spacing']/2,1) . "px;
				margin-top: " . round(self::$a['vertical_spacing']/2,1) . "px;
				display: block;
			}
			.masonry_brick_a {
				border-width: " . self::$a['outer_border_thickness'] . ";
				border-color: " . self::$a['outer_border_color'] . ";
				background-color: " . self::$a['hover_color'] . ";
			}
			img.masonry_brick_img:hover {
				opacity: " . self::$a['hover_intensity'] . ";
			}
			div.masonry_post_gallery {
				margin-top: -" . round(self::$a['vertical_spacing']/2,1) . "px;
				" . self::cmpg_return_if_true(self::$a['gallery_align'] == "left" || self::$a['gallery_align'] == "center", "margin-right: auto;") . "
				" . self::cmpg_return_if_true(self::$a['gallery_align'] == "right" || self::$a['gallery_align'] == "center", "margin-left: auto;") . "
			}
			img.masonry_brick_img, div.cactus_masonry_cropped {
				border-width: " . self::$a['border_thickness'] . ";
				border-color: " . self::$a['border_color'] . ";
				background-color: " . self::$a['image_background_color'] . ";
			}
		</style>";
	}

	static private function cmpg_return_if_true($test, $text_if_true, $text_if_false = "") {
		if($test) return $text_if_true;
		return $text_if_false;
	}

	static private function cmpg_create_javascript() {
		$output = "";
		if(self::$a['masonry'] === true)
		{
			//JavaScript to load the gallery.  If the gallery is AJAXed, then the external JS files may not be ready.
			//   So, set the load on a timer and check for readiness if not already uh.. ready...
			$output .= "
		<script type='text/javascript'>
				var " . self::$id . ";
			jQuery(document).ready(function() {
				
				function " . self::$id . "_drawGallery() {		
					" . self::$id . " = new cactusMasonry();
					" . self::$id . ".init('" . self::$id ."', 
										{showLoader : " . self::cmpg_bool_to_string(self::$a['show_loader']) . ", 
										infiniteScroll : " . self::cmpg_bool_to_string(self::$a['infinite_scroll']) . ",
										postsPerPage : " . self::$a['posts_per_page'] . ", 
										isIe9 : IE_LT_9" . self::$id . ",
										width : '" . self::$a['width'] . "', 
										softGutter : " . self::$a['soft_gutter'] . ",
										fitWidth : " . self::cmpg_bool_to_string(self::$a['fit_width']) . ",
										forceAutoWidth : " . self::cmpg_bool_to_string(self::$a['force_auto_width']) . ", 
										transitionDuration : " . self::$a['transition_duration'] . "});
					" . self::$id . ".drawGallery(elems" . self::$id . ");	
					//alert('Sorry, I\'m lazy and live test on my publicly facing page.  Cactus Masonry is currently being updated and may not work properly on this page.  Sorry for the inconvenience.');
				}
				function " . self::$id . "_testGallery() {
					if(typeof cactusMasonry === 'function') {
						window.clearInterval(timer" . self::$id . ");
						" . self::$id . "_drawGallery();
					}
				}
				if(typeof cactusMasonry === 'function') " . self::$id . "_drawGallery();
				else timer" . self::$id . " = window.setInterval(" . self::$id . "_testGallery,10);
			});
		</script>\n";
		}
		return $output;
	}
}
Cactus_Masonry::init();
?>
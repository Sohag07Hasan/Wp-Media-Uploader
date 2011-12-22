<?php
/*
 * plugin name: An Advanced meta box demo
 * author: Sohag Hasan
 * */
 
 if(!class_exists('advanced_metabox_image_galary')):
	class advanced_metabox_image_galary{
		function advanced_box($post){
			//make the post as golbal using it in callback function
			global $post;
			add_meta_box('post-meta-image',__('Image Set'),array($this,'callback_func'),'post','normal','high');
		}
		
		//calback function 
		function callback_func($post){
			
			//retreiving meta data
			$image_link = get_post_meta($post->ID,'_post_meta_image',true);
			
			?>
			<input id="custom-field-image" type="text"  value="<?php echo esc_url($image_link); ?>" name="post_meta_image" />
			<input type="button" id="wp_add_meta_image" value="Media Libray Image"/>
			<p>Enter an image URL or use an image from the Media Library</p>
			<div class="form-show-meta" id="meta_form_show"><div>

<?php
		}
		
		//saving meta data
		function save_meta($post_id){
			if(isset($_REQUEST['post_meta_image'])){
				update_post_meta($post_id,'_post_meta_image',esc_url_raw($_REQUEST['post_meta_image']));
			}
		}
		
		//adding jquery
		function javascript_adition(){
			
			wp_enqueue_script('jquery');
			wp_enqueue_script('ehllo_script',plugins_url('/advanced-meta-box/js/script.js'),array('jquery','media-upload','thickbox'));
		}
		
		//adding styles
		function adding_css(){
			wp_enqueue_style('thickbox');
		}
		
	}
	
	$meta_data_galery_image = new advanced_metabox_image_galary();
	add_action('add_meta_boxes',array($meta_data_galery_image,'advanced_box'));
	add_action('save_post',array($meta_data_galery_image,'save_meta'));
	
	//admin_print_styles action hook is used to define the page where i want to load the jquery files
	add_action('admin_print_scripts-post.php',array($meta_data_galery_image,'javascript_adition'));
	add_action('admin_print_scripts-post-new.php',array($meta_data_galery_image,'javascript_adition'));
	add_action('adimn_print_styles-post.php',array($meta_data_galery_image,'adding_css'));
	add_action('adimn_print_styles-post-new.php',array($meta_data_galery_image,'adding_css'));
	
	

	
 endif;
?>

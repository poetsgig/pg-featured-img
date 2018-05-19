<?php
/**
    Plugin Name: PG Featured Image
    Plugin URI: 
    Description: This plugin shows the featured image on the sidebar, for single posts. 
    Author: Amy Aulisi
	Author URI: 
    Version: 1.0
    License: GNU General Public License v2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: pg_featured_img
    Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Register and load the widget
function pg_featured_img_load_widget() {
    register_widget( 'pg_featured_img' );
}
add_action( 'widgets_init', 'pg_featured_img_load_widget' );
 
// Create widget 
class pg_featured_img extends WP_Widget {

 	function __construct() {
		parent::__construct(
 
			'pg_featured_img', // Base ID 

			__('Featured Image (PG)', 'pg_featured_img'), // Widget name

			array( 'description' => __( 'This plugin shows the featured image on the sidebar, and inside contents of posts and pages. ', 'pg_featured_img' ), ) 
			); // Widget description
	}
	
		// Widget backend 
	public function form( $instance ) {

                $instance = wp_parse_args( (array) $instance, self::get_defaults() );

		if ( isset( $instance[ 'title' ] ) ) {
		      $title = $instance[ 'title' ];
		}
		else {
		      $title = __( 'New title', 'pg_featured_img' );
		}
		if ( isset( $instance[ 'img-size' ] ) ) {
		      $instance['image-size'] = (!$instance['image-size'] || $instance['image-size'] == '') ? 'post-thumbnail' : $instance['image-size'];
		}
		else {
                      $img_size = __('Select image size', 'pg-featured-image');
		}
		if ( isset( $instance[ 'display_caption' ] ) ) {
		      $instance['display_caption'] = $instance[ 'display_caption' ];
		}
		if ( isset( $instance[ 'display_description' ] ) ) {
		      $instance['display_description'] = $instance[ 'display_description' ];
		}
		if ( isset( $instance[ 'display_excerpt' ] ) ) {
		      $instance['display_excerpt'] = $instance[ 'display_excerpt' ];
		}


		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pg_featured_img' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('img-size'); ?>"><?php _e( 'Select image size:', 'pg_featured_img' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('img-size'); ?>" name="<?php echo $this->get_field_name('img-size'); ?>">
                <?php foreach (get_intermediate_image_sizes() as $intermediate_image_size) : ?>
        <?php
        $selected = ($instance['img-size'] == $intermediate_image_size) ? ' selected="selected"' : '';
        ?>
        <option value="<?php echo $intermediate_image_size; ?>"<?php echo $selected; ?>><?php echo $intermediate_image_size; ?></option>
                <?php endforeach; ?>
		</select>
		</p>
                <p>
               <input class="checkbox" id="<?php echo $this->get_field_id('display_caption'); ?>" type="checkbox" <?php checked( $instance[ 'display_caption' ], 1 ); ?> name="<?php echo $this->get_field_name( 'display_caption' ); ?>"   /> 
    <label for="<?php echo $this->get_field_id( 'display_caption' ); ?>">Display caption</label>
               </p>
                <p>
               <input class="checkbox" id="<?php echo $this->get_field_id('display_description'); ?>" type="checkbox" <?php checked( $instance[ 'display_description' ], 1 ); ?> name="<?php echo $this->get_field_name( 'display_description' ); ?>"   /> 
    <label for="<?php echo $this->get_field_id( 'display_description' ); ?>">Display description</label>
               </p>
                <p>
               <input class="checkbox" id="<?php echo $this->get_field_id('display_excerpt'); ?>" type="checkbox" <?php checked( $instance[ 'display_excerpt' ], 1 ); ?> name="<?php echo $this->get_field_name( 'display_excerpt' ); ?>"   /> 
    <label for="<?php echo $this->get_field_id( 'display_excerpt' ); ?>">Display excerpt</label>
               </p>
        <?php
	}
        // Sanitize widget form values as they are saved
    	// Update widget to replace old instances with new
	public function update( $new_instance, $instance ) {
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                //Add isset to check if key is set
                $instance['display_caption'] = isset( $new_instance['display_caption'] ) ? 1 : 0;
                $instance['display_description'] = isset( $new_instance['display_description'] ) ? 1 : 0;
                $instance['display_excerpt'] = isset( $new_instance['display_excerpt'] ) ? 1 : 0;

                $updated_instance = wp_parse_args( (array) $instance, self::get_defaults() );
                return $updated_instance;
	}
	
	// Render an array of default values
        private static function get_defaults() {
               $defaults = array(
                  'display_caption' => 1,
                  'display_description' => 0,
                  'display_excerpt' => 0
               );
               return $defaults;
        }
	// Widget front-end
	public function widget( $args, $instance ) {
                extract( $args );
		$size = isset( $instance['img-size'] );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$display_caption = isset( $instance[ 'display_caption' ] ) ? 1 : 0;
                $display_description = isset( $instance[ 'display_description' ] ) ? 1 : 0;
                $display_excerpt = isset( $instance[ 'display_excerpt' ] ) ? 1 : 0;
                
		global $post;
 
		if (has_post_thumbnail($post->ID)) {
			     // Before and after widget arguments are defined by themes
		        echo $args['before_widget'];

			    if ( ! empty( $title ) )
			   echo $args['before_title'] . $title . $args['after_title'];
 
			   // Run the code and display the output
                           ?>
                          <div id='pg-featured-img'>
			    <?php echo get_the_post_thumbnail($post->ID, $size); ?>  

                                <?php if( 1 == $instance[ 'display_caption' ] ) : ?>
                                       <div class="pg-featured-img-caption">
                                          <?php echo get_the_post_thumbnail_caption($post); ?>
                                       </div>
                                  <?php endif; ?>

                                <?php if( 1 == $instance[ 'display_description' ] ) : ?>
                                       <div class="pg-featured-img-desc">
                                          <?php $img_id = get_post( get_post_thumbnail_id() ); ?>
                                          <?php $description = $img_id->post_content; ?>
                                          <?php echo $description; ?>
                                       </div>
                                <?php endif; ?>

                                <?php if( 1 == $instance[ 'display_excerpt' ] ) : ?>
                                       <div class="pg-featured-img-excerpt">
                                          <?php echo get_the_excerpt($post); ?>
                                       </div>
                                <?php endif; ?>

                          </div>
            
		       <?php echo $args['after_widget'];
		          } elseif ($post->post_parent && has_post_thumbnail($post->post_parent)) {
		    
                       echo $args['before_widget'];
			if ( $title ) { 
				echo $before_title . $title . $after_title;
			} ?>
                       <div id='pg-featured-img'>
			<?php echo get_the_post_thumbnail($post->ID, $size); ?>
                                <?php if( 1 == $instance[ 'display_caption' ] ) : ?>
                                       <div class="pg-featured-img-caption">
                                          <?php echo get_the_post_thumbnail_caption($post); ?>
                                       </div>
                                  <?php endif; ?>

                                <?php if( 1 == $instance[ 'display_description' ] ) : ?>
                                       <div class="pg-featured-img-desc">
                                          <?php $img_id = get_post( get_post_thumbnail_id() ); ?>
                                          <?php $description = $img_id->post_content; ?>
                                          <?php echo $description; ?>
                                       </div>
                                <?php endif; ?>

                                <?php if( 1 == $instance[ 'display_excerpt' ] ) : ?>
                                       <div class="pg-featured-img-excerpt">
                                          <?php echo get_the_excerpt($post); ?>
                                       </div>
                                <?php endif; ?>
                        
                       </div>
			<?php echo $args['after_widget'];
			} else {
				// Do nothing if there is no featured image
			}
	}

} // End of class pg_featured_img


	

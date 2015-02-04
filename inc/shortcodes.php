<?php

add_shortcode('gallery', 'sc_gallery_func');

function sc_gallery_func($attr) {
	        $post = get_post();
	
        static $instance = 0;
        $instance++;

	        if ( ! empty( $attr['ids'] ) ) {
                // 'ids' is explicitly ordered, unless you specify otherwise.
	            if ( empty( $attr['orderby'] ) )
	                    $attr['orderby'] = 'post__in';
	             $attr['include'] = $attr['ids'];
	        }

        // Allow plugins/themes to override the default gallery template.
	        $output = apply_filters('post_gallery', '', $attr);
	        if ( $output != '' )
	                return $output;
	
	        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	        if ( isset( $attr['orderby'] ) ) {
	                $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	                if ( !$attr['orderby'] )
	                        unset( $attr['orderby'] );
	        }
	
	        extract(shortcode_atts(array(
	                'order'      => 'ASC',
	                'orderby'    => 'menu_order ID',
	                'id'         => $post ? $post->ID : 0,
	                'itemtag'    => 'div',
	                'icontag'    => 'div',
	                'captiontag' => 'div',
	                'columns'    => 3,
	                'size'       => 'thumbnail',
	                'include'    => '',
					'exclude'    => '',
	                'link'       => ''
	        ), $attr, 'gallery'));
	
	        $id = intval($id);
	        if ( 'RAND' == $order )
	                $orderby = 'none';
	
	        if ( !empty($include) ) {
	                $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	                $attachments = array();
	                foreach ( $_attachments as $key => $val ) {
	                        $attachments[$val->ID] = $_attachments[$key];
	                }
	        } elseif ( !empty($exclude) ) {
	                $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	        } else {
	                $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	        }
	
	        if ( empty($attachments) )
	                return '';
	
	        if ( is_feed() ) {
	                $output = "\n";
	                foreach ( $attachments as $att_id => $attachment )
	                        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	                return $output;
	        }
	
	        $itemtag = tag_escape($itemtag);
	        $captiontag = tag_escape($captiontag);
	        $icontag = tag_escape($icontag);
	        $valid_tags = wp_kses_allowed_html( 'post' );
	        if ( ! isset( $valid_tags[ $itemtag ] ) )
	                $itemtag = 'dl';
	        if ( ! isset( $valid_tags[ $captiontag ] ) )
	                $captiontag = 'dd';
	        if ( ! isset( $valid_tags[ $icontag ] ) )
	                $icontag = 'dt';
	
	        $columns = intval($columns);
	        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	        $float = is_rtl() ? 'right' : 'left';
	
	        $selector = "gallery-{$instance}";
	
	        $gallery_style = $gallery_div = '';
	        if ( apply_filters( 'use_default_gallery_style', true ) )
	                $gallery_style = "
	                <style type='text/css'>
	                        #{$selector} {
									margin: auto;
	                        }
	                        #{$selector} .gallery-item {
	                                float: {$float};
	                                
	                                text-align: center;
	                                width: {$itemwidth}%;
									border:0px solid #eee;
	                        }
	                        #{$selector} img {
	                            width:100%;
								height:auto;
	                        }
	                        #{$selector} .gallery-caption {
	                                margin-left: 0;
	                        }
							
							.gallery-title
							{
								border-bottom:1px dashed #eee;
								border-top:1px dashed #eee;
								margin-top:30px;
								margin-bottom:10px;
							}
							
							.gallery-title h4
							{
								font-weight:bold;
							}
							
							
	                </style>";
	        $size_class = sanitize_html_class( $size );
			$g_header = '<div class="gallery-title"><h4>Gallery photos</h4></div>';
	        $gallery_div = "<div id='$selector' class='clearfix gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	        $output = apply_filters( 'gallery_style', $g_header . $gallery_style . "\n\t\t" . $gallery_div );
			
			
			
	        $i = 0;
	        foreach ( $attachments as $id => $attachment ) {
	                if ( ! empty( $link ) && 'file' === $link )
	                        $image_output = wp_get_attachment_link( $id, $size, false, false );
	                elseif ( ! empty( $link ) && 'none' === $link )
	                        $image_output = wp_get_attachment_image( $id, $size, false );
	                else
	                        $image_output = wp_get_attachment_link( $id, $size, true, false );
	
	                $image_meta  = wp_get_attachment_metadata( $id );

	                $orientation = '';
	                if ( isset( $image_meta['height'], $image_meta['width'] ) )
	                        $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
	
	                $output .= "<{$itemtag} class='gallery-item'>";
	                $output .= "
	                        <{$icontag} class='gallery-icon {$orientation}'>
	                                $image_output
	                        </{$icontag}>";
	               /* if ( $captiontag && trim($attachment->post_excerpt) ) {
	                        $output .= "
	                                <{$captiontag} class='wp-caption-text gallery-caption'>
	                                " . wptexturize($attachment->post_excerpt) . "
	                                </{$captiontag}>";
	                } */
	                $output .= "</{$itemtag}>";
					
	        }
	
	        $output .= "</div>\n";
	
	        return $output;
	}


?>
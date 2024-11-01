<?php
/*
Plugin Name: Blitzcorner Sports Rankings Widget
Plugin URI: http://www.blitzcorner.com/website/rankingWidget/11
Description: Sports Ranking Widget for Sports Blogs
Version: 1.0
Author: Blitzcorner
Author URI: http://www.blitzcorner.com
License: GPL2

Copyright 2012 Blitzcorner (email: info@blitzcorner.com)

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
*/

/* Add our function to the widgets_init hook. */
add_action('widgets_init', 'bc_sports_rankings_widget');

/* Function that registers our widget. */
function bc_sports_rankings_widget()
{
    register_widget('Bc_Sports_Ranking_Widget');
}

class Bc_Sports_Ranking_Widget extends WP_Widget
{
    function Bc_Sports_Ranking_Widget()
    {
        /* Widget settings. */
        $widget_ops = array('classname' => 'BcSportsRankingWidget', 'description' => 'Sports rankings widget for sports blogs');

        /* Widget control settings. */
        $control_ops = array('id_base' => 'bc-sports-ranking-widget');

        /* Create the widget. */
        $this->WP_Widget('bc-sports-ranking-widget', 'Sports Ranking Widget', $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        extract($args);

        /* User-selected settings. */
        //$title = apply_filters('widget_title', $instance['title']);
        $title= "Sports Ranking Widget";
		$shadow_color = $instance['shadow_color'];
        $background_color = $instance['background_color'];
        $text_color = $instance['text_color'];

        /* Before widget (defined by themes). */
        echo $before_widget;

        /* Title of widget (before and after defined by themes). */
        /*
        if ($title)
            echo $before_title.$title.$after_title;
        */

        /* Display the widget. */
		echo '<div id="dojoRankingWidget" style="position:relative; left:-47px;"></div><script type="text/javascript" src="http://www.blitzcorner.com/js/rankingWidget.js"></script><script type="text/javascript" >dojo.api.rankingOptions={baseUrlCode:\'http://www.blitzcorner.com\',website_id:"0",source:"0",categories:"1-2-3-4-5-6-7-8-9-11-12-13-14-15-16-17-18-19-20-21-22-23-24-25-10",bgColor:"#'.$background_color.'",textColor:"#'.$text_color.'",shadow:"'.$shadow_color.'"};</script>';

        /* After widget (defined by themes). */
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        /* Strip tags (if needed) and update the widget settings. */
        $instance['background_color'] = $new_instance['background_color'];
        $instance['text_color'] = $new_instance['text_color'];
		$instance['shadow_color'] = $new_instance['shadow_color'];

        return $instance;
    }

    function form($instance)
    {
        /* Set up some default widget settings. */
        $defaults = array('background_color'=>'ffffff', 'text_color'=>'000000', 'shadow_color'=>'black');
        $instance = wp_parse_args((array)$instance, $defaults);
    ?>

        <p>
            <label for="<?php echo $this->get_field_id('background_color'); ?>">Background Color:</label>
            <input id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" value="<?php echo $instance['background_color']; ?>" style="width:90%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text_color'); ?>">Text Color:</label>
            <input id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" value="<?php echo $instance['text_color']; ?>" style="width:90%;" />
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id('shadow_color'); ?>">Divider Color:</label>
			<select id="<?php echo $this->get_field_id('shadow_color'); ?>" name="<?php echo $this->get_field_name('shadow_color'); ?>">
				<option value='black' <?php if ( 'black' == $instance['shadow_color'] ) echo 'selected="selected"'; ?>>black</option>
				<option value='white' <?php if ( 'white' == $instance['shadow_color'] ) echo 'selected="selected"'; ?>>white</option>
			</select>
		</p>
    <?php
    }
}
?>
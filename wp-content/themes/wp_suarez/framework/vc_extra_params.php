<?php
add_action('init', 'cshero_vc_extra_param');

/* add extra param for vc shortcodes */
function cshero_vc_extra_param()
{
    global $post;
    if (function_exists('vc_add_param')) {
        vc_remove_param( "vc_row", "full_height" );
        vc_remove_param( "vc_row", "content_placement" );
        vc_remove_param( "vc_row", "video_bg" );
        vc_remove_param( "vc_row", "video_bg_url" );
        //vc_remove_param( "vc_row", "parallax" );
        vc_remove_param( "vc_row", "parallax_image" );
        vc_remove_param( "vc_row", "video_bg_parallax" );

        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", 'wp_suarez'),
            "param_name" => "bg_attachment",
            "value" => array(''=>'', 'Scroll' => 'scroll', 'Fixed' => 'fixed', 'Local' => 'local','Initial' => 'initial','Inherit' => 'inherit'),
            "group" => __("Design Options", 'wp_suarez'),
        ));
        
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", 'wp_suarez'),
            "param_name" => "bg_repeat",
            "value" => array(''=>'', 'No-Repeat' => 'no-repeat', 'Repeat' => 'repeat', 'Repeat-X' => 'repeat-x','Repeat-Y' => 'repeat-y'),
            "group" => __("Design Options", 'wp_suarez'),
        ));
        // Adding stripes to rows
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => __('Responsive utilities', 'wp_suarez'),
            "param_name" => "row_responsive_large",
            "value" => array(
                __("Hidden (Large devices)", 'wp_suarez') => true
            ),
            "group" => __("Responsive", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_medium",
            "value" => array(
                __("Hidden (Medium devices)", 'wp_suarez') => true
            ),
            "group" => __("Responsive", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_small",
            "value" => array(
                __("Hidden (Small devices)", 'wp_suarez') => true
            ),
            "group" => __("Responsive", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "heading" => '',
            "param_name" => "row_responsive_extra_small",
            "value" => array(
                __("Hidden (Extra small devices)", 'wp_suarez') => true
            ),
            "group" => __("Responsive", 'wp_suarez'),
            "description" => __("For faster mobile-friendly development, use these utility classes for showing and hiding content by device via media query.", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("ID Name for Navigation", 'wp_suarez'),
            "param_name" => "dt_id",
            "value" => "",
            "group" => __("One Page", 'wp_suarez'),
            "description" => __("If this row wraps the content of one of your sections, set an ID. You can then use it for navigation. Ex: work", 'wp_suarez')
        ));
        vc_add_param('vc_row', array(
            'type' => 'dropdown',
            'heading' => "Full Width",
            'param_name' => 'full_width',
            'value' => array(
                "No" => "false",
                "Yes" => "true"
            ),
            'description' => "Only activated on main layout full width"
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color", 'wp_suarez'),
            "param_name" => "row_head_color",
            "value" => "",
            "description" => __("Select color for head.", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Link color", 'wp_suarez'),
            "param_name" => "row_link_color",
            "value" => "",
            "description" => __("Select color for link.", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Link color hover", 'wp_suarez'),
            "param_name" => "row_link_color_hover",
            "value" => "",
            "description" => __("Select color for link hover.", 'wp_suarez')
        ));

        vc_add_param("vc_row_inner", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Same height", 'wp_suarez'),
            "param_name" => "same_height",
            "value" => array(
                "" => 'true'
            ),
            "description" => __("Set the same hight for all column in this row.", 'wp_suarez')
        ));

        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Animation", 'wp_suarez'),
            "admin_label" => true,
            "param_name" => "animation",
            "value" => array(
                "None" => "",
                "Right To Left" => "right-to-left",
                "Left To Right" => "left-to-right",
                "Bottom To Top" => "bottom-to-top",
                "Top To Bottom" => "top-to-bottom",
                "Scale Up" => "scale-up",
                "Fade In" => "fade-in"
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Row style", 'wp_suarez'),
            "admin_label" => true,
            "param_name" => "type",
            "value" => array(
                "Default" => "",
                "Custom" => "ww-custom",
                "Full Screen" => "full-screen",
                "Row Flex" => "row-flex"
            ),
            "group" => __("Style", 'wp_suarez')
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Enable parallax", 'wp_suarez'),
            "param_name" => "enable_parallax",
            "value" => array(
                "" => "false"
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Background ratio", 'wp_suarez'),
            "param_name" => "parallax_speed",
            "value" => "0.8",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay Color", 'wp_suarez'),
            "param_name" => "bg_video_color",
            "value" => "",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "not_empty" => true
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __("Video poster", 'wp_suarez'),
            "param_name" => "poster",
            "value" => "",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Loop", 'wp_suarez'),
            "param_name" => "loop",
            "value" => array(
                __("Yes, please", 'wp_suarez') => true
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Autoplay", 'wp_suarez'),
            "param_name" => "autoplay",
            "value" => array(
                __("Yes, please", 'wp_suarez') => true
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Muted", 'wp_suarez'),
            "param_name" => "muted",
            "value" => array(
                __("Yes, please", 'wp_suarez') => true
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Controls", 'wp_suarez'),
            "param_name" => "controls",
            "value" => array(
                __("Yes, please", 'wp_suarez') => true
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "checkbox",
            "class" => "",
            "heading" => __("Show Button Play", 'wp_suarez'),
            "param_name" => "show_btn",
            "value" => array(
                __("Yes, please", 'wp_suarez') => true
            ),
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (mp4)", 'wp_suarez'),
            "param_name" => "bg_video_src_mp4",
            "value" => "",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (ogv)", 'wp_suarez'),
            "param_name" => "bg_video_src_ogv",
            "value" => "",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));

        vc_add_param("vc_row", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Video background (webm)", 'wp_suarez'),
            "param_name" => "bg_video_src_webm",
            "value" => "",
            "group" => __("Style", 'wp_suarez'),
            "dependency" => array(
                "element" => "type",
                "value" => array(
                    "ww-custom"
                )
            )
        ));
        /* vc column */
        vc_remove_param( "vc_column", "css_animation" );
        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Animation", 'wp_suarez'),
            "admin_label" => true,
            "param_name" => "animation",
            "value" => array(
                "None" => "",
                "Right To Left" => "right-to-left",
                "Left To Right" => "left-to-right",
                "Bottom To Top" => "bottom-to-top",
                "Top To Bottom" => "top-to-bottom",
                "Scale Up" => "scale-up",
                "Fade In" => "fade-in"
            )
        ));

        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Text Align", 'wp_suarez'),
            "admin_label" => true,
            "param_name" => "text_align",
            "value" => array(
                "None" => "",
                "Inherit" => "inherit",
                "Initial" => "initial",
                "Justify" => "justify",
                "Left" => "left",
                "Right" => "right",
                "Center" => "center",
                "Start" => "start",
                "End" => "end"
            )
        ));
        vc_add_param("vc_column", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Column Heading Style", 'wp_suarez'),
            "admin_label" => true,
            "param_name" => "column_style",
            "value" => array(
                "Default" => "",
                "Title Primary Color" => "title-preset1",
                "Title Secondary Color" => "title-preset2",
                "Title Feature Box" => "title-feature-box"
            ),
            "description" => __("Add some styles to column", 'wp_suarez')
        ));
        // Pie chart
        vc_add_param("vc_pie", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Heading size", 'wp_suarez'),
            "param_name" => "heading_size",
            "value" => array(
                "Default" => "h4",
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6"
            ),
            "description" => 'Select your heading size for title.'
        ));
        vc_add_param("vc_pie", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __('Title Color', 'wp_suarez'),
            "param_name" => "title_color"
        ));
        vc_add_param("vc_pie", array(
            'type' => 'textfield',
            'heading' => __('Pie icon', 'wp_suarez'),
            'param_name' => 'icon',
            'value' => '',
            'admin_label' => true
        ));
        vc_add_param("vc_pie", array(
            'type' => 'textfield',
            'heading' => __('Icon Size', 'wp_suarez'),
            'param_name' => 'icon_size',
            'description' => __('Font size of icon', 'wp_suarez'),
            'value' => '24',
            'admin_label' => true
        ));
        vc_add_param("vc_pie", array(
            'type' => 'colorpicker',
            'heading' => __('Icon Color', 'wp_suarez'),
            'param_name' => 'icon_color',
            'value' => '#888',
            'admin_label' => true
        ));
        vc_remove_param("vc_pie", "color");
        vc_add_param("vc_pie", array(
            'type' => 'colorpicker',
            'heading' => __('Bar color', 'wp_suarez'),
            'param_name' => 'color',
            'value' => '#00c3b6', // $pie_colors,
            'description' => __('Select pie chart color.', 'wp_suarez'),
            'admin_label' => true,
            'param_holder_class' => 'vc-colored-dropdown'
        ));
        vc_add_param("vc_pie", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bar Width", 'wp_suarez'),
            "param_name" => "pie_width",
            "value" => "12"
        ));
        vc_add_param("vc_pie", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Description", 'wp_suarez'),
            "param_name" => "desc",
            "value" => ""
        ));
        vc_add_param("vc_pie", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Style", 'wp_suarez'),
            "param_name" => "style",
            "value" => array(
                "Style 1" => "style1",
                "Style 2" => "style2",
                "Style 3" => "style3"
            ),
            "description" => __("Select style for pie.", 'wp_suarez'),
            "admin_label" => true
        ));
        vc_add_param("vc_pie", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", 'wp_suarez'),
            "param_name" => "icon",
            "value" => "",
            "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', 'wp_suarez')
        ));
        /*
         * Separator
         */
        vc_remove_param('vc_separator', 'el_class');
        vc_remove_param('vc_separator', 'el_width'); 
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Element width", 'wp_suarez'),
            "param_name" => "separator_width",
            "value" =>array(
                "100%" => "100%",
                "90%" => "90%",
                "80%" => "80%",
                "70%" => "70%",
                "60%" => "60%",
                "50%" => "50%",
                "40%" => "40%",
                "30%" => "30%",
                "20%" => "20%",
                "10%" => "10%",
                "Custom" => "custom",
            ),
            "description" => "Separator element width in percents."
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Custom Width", 'wp_suarez'),
            "param_name" => "separator_width_custom",
            "value" => "",
            "description" => "Enter your custom width",
            "dependency" => array(
                "element" => 'separator_width',
                "value" => array(
                    "custom"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Style Border Width", 'wp_suarez'),
            "param_name" => "border_width",
            "value" => "1",
            "description" => "Defualt 1"
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Show Arrow", 'wp_suarez'),
            "param_name" => "separator_arrow",
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "heading" => __("Arrow Type", 'wp_suarez'),
            "param_name" => "separator_arrow_type",
            "value" => array(
                "Border" => "border",
                "Image" => "image",
                "Icon" => "icon"
            ),
            "group" => __("Arrow", 'wp_suarez'),
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Arrow Width", 'wp_suarez'),
            "param_name" => "arrow_width",
            "value" => "12",
            "group" => __("Arrow", 'wp_suarez'),
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            ),
            "description" => "Set Width for Arrow (Default 12)"
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Arrow Color", 'wp_suarez'),
            "param_name" => "arrow_color",
            "dependency" => array(
                "element" => 'separator_arrow',
                "value" => array(
                    "yes"
                )
            ),
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __("Arrow Image", 'wp_suarez'),
            "param_name" => "arrow_image",
            "value" => "",
            "group" => __("Arrow", 'wp_suarez'),
            "dependency" => array(
                "element" => 'separator_arrow_type',
                "value" => array(
                    "image"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Icon Class", 'wp_suarez'),
            "param_name" => "icon_class",
            "group" => __("Arrow", 'wp_suarez'),
            "dependency" => array(
                "element" => 'separator_arrow_type',
                "value" => array(
                    "icon"
                )
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Width (px)", 'wp_suarez'),
            "param_name" => "icon_width",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Height (px)", 'wp_suarez'),
            "param_name" => "icon_height",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'wp_suarez'),
            "param_name" => "icon_bg",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "colorpicker",
            "heading" => __("Border Color", 'wp_suarez'),
            "param_name" => "icon_border_color",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Border Style", 'wp_suarez'),
            "param_name" => "icon_border_style",
            "value" => array(
                "none" => "none",
                "dotted" => "dotted",
                "dashed" => "dashed",
                "solid" => "solid",
                "double" => "double"
            ),
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Border Width (px)", 'wp_suarez'),
            "param_name" => "icon_border_width",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Border Radius (px)", 'wp_suarez'),
            "param_name" => "icon_border_radius",
            "group" => __("Arrow", 'wp_suarez')
        ));
        vc_add_param("vc_separator", array(
            "type" => "dropdown",
            "heading" => __("Enable Back To Top", 'wp_suarez'),
            "param_name" => "separator_arrow_type_link",
            "group" => __("Extra", 'wp_suarez'),
            "value" => array(
                "No" => "0",
                "Yes" => "1",
            )
        ));
        vc_add_param("vc_separator", array(
            "type" => "textfield",
            "heading" => __("Back to section ID", 'wp_suarez'),
            "param_name" => "separator_arrow_type_link_id",
            "group" => __("Extra", 'wp_suarez'),
            "description" => "Enter section ID name you want back link to.",
            "dependency" => array(
                "element" => 'separator_arrow_type_link',
                "value" => array(
                    "1"
                )
            )
        ));
        /*
         * Separator with Text
         */
        vc_add_param("vc_text_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Style Border Width", 'wp_suarez'),
            "param_name" => "border_width",
            "value" => "1px 0 0 0",
            "description" => "Enter border width style for Top/Right/Bottom/Left. Default is 1px 0 0 0"
        ));

        vc_add_param("vc_text_separator", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color", 'wp_suarez'),
            "param_name" => "heading_font_color",
            "value" => "",
            "description" => ""
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "dropdown",
            "heading" => __("Heading size", 'wp_suarez'),
            "param_name" => "heading_size",
            "value" => array(
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6",
                "Div"       => 'div'
            ),
            "description" => 'Select your heading size for text.'
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Heading Font size", 'wp_suarez'),
            "param_name" => "heading_font_size",
            "value" => "",
            "description" => ""
        ));
        vc_add_param("vc_text_separator", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Text Transform", 'wp_suarez'),
            "param_name" => "text_transform",
            "value" => array(
                "None" => "",
                "Lowercase" => "lowercase",
                "Uppercase" => "uppercase"
            ),
            "description" => "Uppercase & Lowercase for Text"
        ));
 
        /* accordion */
        vc_add_param("vc_accordion_tab", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", 'wp_suarez'),
            "param_name" => "icon",
            "value" => "",
            "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', 'wp_suarez')
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color", 'wp_suarez'),
            "param_name" => "title_color"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Tab", 'wp_suarez'),
            "param_name" => "background_tab"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Content", 'wp_suarez'),
            "param_name" => "background_content"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Active Color", 'wp_suarez'),
            "param_name" => "title_active_color"
        ));
        vc_add_param("vc_accordion_tab", array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background Tab Active", 'wp_suarez'),
            "param_name" => "background_tab_active"
        ));
        vc_add_param("vc_accordion", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Item Margin Bottom", 'wp_suarez'),
            "param_name" => "item_margin_bottom",
            "value" => '',
            "description" => __('margin bottom each accordion tab. Ex: 10px', 'wp_suarez')
        ));
        vc_add_param("vc_accordion", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Item Border", 'wp_suarez'),
            "param_name" => "item_border",
            "value" => '',
            "description" => __('Border of each accordion tab. Ex: 1px solid #444', 'wp_suarez')
        ));
        vc_add_param("vc_accordion", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Title Align", 'wp_suarez'),
            "param_name" => "title_align",
            "value" => array(
                'Left' => 'left',
                'Right' => 'right',
                'Center' => 'center'
            )
        ));
        /* VC Button */
        vc_remove_param('vc_button', 'color');
        vc_remove_param('vc_button', 'icon');
        vc_remove_param('vc_button', 'size');
        $button_type = array(
            __('Button Default', 'wp_suarez') => 'btn btn-default',
            __('Button Default Alt', 'wp_suarez') => 'btn btn-default-alt',
            __('Button Default White', 'wp_suarez') => 'btn btn-white',
            __('Button Border', 'wp_suarez') => 'btn btn-border',
            __('Button Border White', 'wp_suarez') => 'btn btn-border-white',
            __('Button Primary', 'wp_suarez') => 'btn btn-primary',
            __('Button Primary Alt', 'wp_suarez') => 'btn btn-primary-alt',
            __('Button Primary Alt White', 'wp_suarez') => 'btn btn-primary-alt btn-white',
            __('Button Warning', 'wp_suarez') => 'btn btn-warning',
            __('Button Danger', 'wp_suarez') => 'btn btn-danger',
            __('Button Success', 'wp_suarez') => 'btn btn-success',
            __('Button Info', 'wp_suarez') => 'btn btn-info',
            __('Button Inverse', 'wp_suarez') => 'btn btn-inverse' 
        );
        vc_add_param("vc_button", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button Type", 'wp_suarez'),
            "param_name" => "type",
            "value" => $button_type
        ));
        $size_arr = array(
            __('Default', 'wp_suarez') => 'btn btn-default',
            __('Large', 'wp_suarez') => 'btn-lg btn-large',
            __('Medium', 'wp_suarez') => 'btn-md btn-medium',
            __('Small', 'wp_suarez') => 'btn-sm btn-small',
            __('Mini', 'wp_suarez') => "btn-xs btn-mini"
        );
        vc_add_param("vc_button", array(
            'type' => 'dropdown',
            'heading' => __('Size', 'wp_suarez'),
            'param_name' => 'size',
            'value' => $size_arr,
            'description' => __('Button size.', 'wp_suarez')
        ));
        vc_add_param("vc_button", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button Block", 'wp_suarez'),
            "param_name" => "button_block",
            "value" => array(
                __('No', 'wp_suarez') => '0',
                __('Yes', 'wp_suarez') => '1'
                
            ),
        ));
        /* VC Tab */
        vc_add_param("vc_tab", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon", 'wp_suarez'),
            "param_name" => "icon_title",
            "value" => "",
            "description"=>__('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', 'wp_suarez')
        ));

        /*
         * VC Custom Heading
         */
        vc_add_param("vc_custom_heading", array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Letter Spacing", 'wp_suarez'),
            "param_name" => "letter_spacing",
            "value" => "",
            "description"=>__('Enter letter spacing you want. Default is Normal', 'wp_suarez')
        ));

        /*
         * Contact form-7
         */
        vc_add_param("contact-form-7", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Contact Style", 'wp_suarez'),
            "param_name" => "html_class",
            "value" => array(
                'Default' => 'default',
                'Style 1' => 'contact-style-1',
                'Style 2' => 'contact-style-2',
                'Style 3' => 'contact-style-3',
                'Style 4' => 'contact-style-4',
                'Style 5' => 'contact-style-5'
            )
        ));
    }
}
// intergrate VC
cs_integrateWithVC();

function cs_integrateWithVC()
{
    $vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
    /*
     * Tabs ----------------------------------------------------------
     */
    $tab_id_1 = time() . '-1-' . rand(0, 100);
    $tab_id_2 = time() . '-2-' . rand(0, 100);
    vc_map(array(
        "name" => __('Tabs', 'wp_suarez'),
        'base' => 'vc_tabs',
        'show_settings_on_create' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-ui-tab-content',
        'category' => __('Content', 'wp_suarez'),
        'description' => __('Tabbed content', 'wp_suarez'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Widget title', 'wp_suarez'),
                'param_name' => 'title',
                'description' => __('Enter text which will be used as widget title. Leave blank if no title is needed.', 'wp_suarez')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Auto rotate tabs', 'wp_suarez'),
                'param_name' => 'interval',
                'value' => array(
                    __('Disable', 'wp_suarez') => 0,
                    3,
                    5,
                    10,
                    15
                ),
                'std' => 0,
                'description' => __('Auto rotate tabs each X seconds.', 'wp_suarez')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Color', 'wp_suarez'),
                'param_name' => 'tab_color',
                'std' => '#444'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Color Active', 'wp_suarez'),
                'param_name' => 'tab_color_active',
                'std' => '#444'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Background Color', 'wp_suarez'),
                'param_name' => 'tab_background_color'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Tab Background Color Active', 'wp_suarez'),
                'param_name' => 'tab_background_color_active'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'wp_suarez'),
                'param_name' => 'el_class',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wp_suarez')
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'heading' => __('Style', 'wp_suarez'),
                'value' => array(
                    "Style 1" => "style1",
                    "Style 2" => "style2",
                    "Style 3" => "style3"
                ),
                'std' => 'style1'
            )
        ),
        'custom_markup' => '
	<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
	<ul class="tabs_controls">
	</ul>
	%content%
	</div>',
        'default_content' => '
	[vc_tab title="' . __('Tab 1', 'wp_suarez') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
	[vc_tab title="' . __('Tab 2', 'wp_suarez') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
	',
        'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
    ));
     
    /*
     * Call to Action Button ----------------------------------------------------------
     */
    $target_arr = array(
        __('Same window', 'wp_suarez') => '_self',
        __('New window', 'wp_suarez') => "_blank"
    );
    $button_type = array(
        __('Button Default', 'wp_suarez') => 'btn btn-default',
        __('Button Default Alt', 'wp_suarez') => 'btn btn-default-alt',
        __('Button Default White', 'wp_suarez') => 'btn btn-white',
        __('Button Border', 'wp_suarez') => 'btn btn-border',
        __('Button Border White', 'wp_suarez') => 'btn btn-border-white',
        __('Button Primary', 'wp_suarez') => 'btn btn-primary',
        __('Button Primary Alt', 'wp_suarez') => 'btn btn-primary-alt',
        __('Button Primary Alt White', 'wp_suarez') => 'btn btn-primary-alt btn-white',
        __('Button Warning', 'wp_suarez') => 'btn btn-warning',
        __('Button Danger', 'wp_suarez') => 'btn btn-danger',
        __('Button Success', 'wp_suarez') => 'btn btn-success',
        __('Button Info', 'wp_suarez') => 'btn btn-info',
        __('Button Inverse', 'wp_suarez') => 'btn btn-inverse' 
    );

    $size_arr = array(
        __('Default', 'wp_suarez') => 'btn btn-default',
        __('Large', 'wp_suarez') => 'btn-lg btn-large',
        __('Medium', 'wp_suarez') => 'btn-md btn-medium',
        __('Small', 'wp_suarez') => 'btn-sm btn-small',
        __('Mini', 'wp_suarez') => "btn-xs btn-mini"
    );
    vc_map(array(
        'name' => __('Call to Action Button', 'wp_suarez'),
        'base' => 'vc_cta_button',
        'icon' => 'icon-wpb-call-to-action',
        'category' => __('Content', 'wp_suarez'),
        'description' => __('Catch visitors attention with CTA block', 'wp_suarez'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Icon', 'wp_suarez'),
                'param_name' => 'call_icon',
                'description' => __('Font Awesome.', 'wp_suarez')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Icon size', 'wp_suarez'),
                'param_name' => 'call_icon_size',
                'description' => __('Icon on font size px.', 'wp_suarez')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Icon color', 'wp_suarez'),
                'param_name' => 'call_icon_color',
                'description' => __('Icon on color.', 'wp_suarez')
            ),
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => __('Title', 'wp_suarez'),
                'param_name' => 'call_text',
                'value' => __('Click edit button to change this text.', 'wp_suarez'),
                'description' => __('Enter your content.', 'wp_suarez')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Title heading size', 'wp_suarez'),
                'param_name' => 'call_text_heading_size',
                'description' => __('Choose heading style.', 'wp_suarez'),
                'value'  => array(
                    'Span' => 'span',
                    'H1' => 'h1',
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                    'H6' => 'h6',
                    'Div' => 'div',
                    'Span' => 'span',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title font size', 'wp_suarez'),
                'param_name' => 'call_text_font_size',
                'description' => __('Text on font size px.', 'wp_suarez')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Title color', 'wp_suarez'),
                'param_name' => 'call_text_color',
                'description' => __('Text on color.', 'wp_suarez')
            ),
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => __('Sub Text', 'wp_suarez'),
                'param_name' => 'call_sub_text',
                'value' => '',
                'description' => __('Enter your content.', 'wp_suarez')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Text on the button', 'wp_suarez'),
                'param_name' => 'title',
                'value' => __('Text on the button', 'wp_suarez'),
                'description' => __('Text on the button.', 'wp_suarez')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('URL (Link)', 'wp_suarez'),
                'param_name' => 'href',
                'description' => __('Button link.', 'wp_suarez')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Target', 'wp_suarez'),
                'param_name' => 'target',
                'value' => $target_arr,
                'dependency' => array(
                    'element' => 'href',
                    'not_empty' => true
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button Type ', 'wp_suarez'),
                'param_name' => 'button_type',
                'value' => $button_type,
                'description' => __('Button Type.', 'wp_suarez'),
                'param_holder_class' => 'vc-button-type-dropdown'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button size', 'wp_suarez'),
                'param_name' => 'size',
                'value' => $size_arr,
                'description' => __('Button size.', 'wp_suarez')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Button align', 'wp_suarez'),
                'param_name' => 'position',
                'value' => array(
                    __('Align right', 'wp_suarez') => 'cs_align_right',
                    __('Align left', 'wp_suarez') => 'cs_align_left'
                ),
                'description' => __('Select button alignment.', 'wp_suarez')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'wp_suarez'),
                'param_name' => 'el_class',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wp_suarez')
            )
        ),
        'js_view' => 'VcCallToActionView'
    ));
}

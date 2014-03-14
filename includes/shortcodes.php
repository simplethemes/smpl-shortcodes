<?php
/**
 * SMPL Shortcodes
 *
 * (1) Columns
 *    - one_sixth
 *    - one_fourth
 *    - one_third
 *    - one_half
 *    - two_third
 *    - three_fourth
 *    - one_fifth
 *    - two_fifth
 *    - three_fifth
 *    - four_fifth
 *    - three_tenth
 *    - seven_tenth
 * (2) Components
 *      - alert
 *    - button
 *      - divider
 *    - cta
 *      - callout
 * (3) Inline Elements
 *      - blockquote
 *      - youtube
 *      - vimeo
 * (3) Tabs, Accordion, & Toggles
 *    - tabs
 *    - accordion
 *    - toggle
 * (6) Display Posts
 *    - post_grid
 */

/*-----------------------------------------------------------*/
/* Columns
/*-----------------------------------------------------------*/

/**
 * Columns
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @param string $tag Current shortcode tag
 */
function smpl_shortcode_column( $atts, $content = null, $tag = '' ) {

    // Determine if column is last in row
  $last = '';
  if( isset( $atts[0] ) && trim( $atts[0] ) == 'last')
    $last = ' last';

    // Determine width of column
  $class = '';

    switch ( $tag ) {

        case 'one_sixth' :
            $class .= 'one_sixth';
            break;

        case 'one_fourth' :
            $class .= 'one_fourth';
            break;

        case 'one_third' :
            $class .= 'one_third';
            break;

        case 'one_half' :
            $class .= 'one_half';
            break;

        case 'two_third' :
        case 'two_thirds' :
            $class .= 'two_thirds';
            break;

        case 'three_fourth' :
        case 'three_fourths' :
            $class .= 'three_fourths';
            break;

        case 'one_fifth' :
            $class .= 'one_fifth';
            break;

        case 'two_fifth' :
        case 'two_fifths' :
            $class .= 'two_fifths';
            break;

        case 'three_fifth' :
        case 'three_fifths' :
            $class .= 'three_fifth';
            break;

        case 'four_fifth' :
        case 'four_fifths':
            $class .= 'four_fifth';
            break;

    }

    // Is user adding additional classes?
    if ( isset( $atts['class'] ) ) {
        $class .= ' '.$atts['class'];
    }

    // Force wpautop in shortcode? (not relevant if columns not wrapped in [raw])
    if ( isset( $atts['wpautop'] ) && trim( $atts['wpautop'] ) == 'true') {
        $content = wpautop( $content );
    }

    // Return column
  $content = '<div class="'.$class.$last.'">'.$content.'</div>';
    return do_shortcode( $content );

}



function smpl_shortcode_legacy_column_last( $atts, $content = null, $tag = '' ) {


    // Determine width of column
    $class = '';

    switch ( $tag ) {

        case 'one_sixth_last' :
            $class .= 'one_sixth last';
            break;

        case 'one_fourth_last' :
            $class .= 'one_fourth last';
            break;

        case 'one_third_last' :
            $class .= 'one_third last';
            break;

        case 'one_half_last' :
            $class .= 'one_half last';
            break;

        case 'two_third_last' :
        case 'two_thirds_last' :
            $class .= 'two_thirds last';
            break;

        case 'three_fourth_last' :
        case 'three_fourths_last' :
            $class .= 'three_fourths last';
            break;

        case 'one_fifth_last' :
            $class .= 'one_fifth last';
            break;

        case 'two_fifth_last' :
        case 'two_fifths_last' :
            $class .= 'two_fifths last';
            break;

        case 'three_fifth_last' :
        case 'three_fifths_last' :
            $class .= 'three_fifth last';
            break;

        case 'four_fifth_last' :
        case 'four_fifths_last' :
            $class .= 'four_fifth last';
            break;

    }

    // Is user adding additional classes?
    if ( isset( $atts['class'] ) ) {
        $class .= ' '.$atts['class'];
    }

    // Force wpautop in shortcode? (not relevant if columns not wrapped in [raw])
    if ( isset( $atts['wpautop'] ) && trim( $atts['wpautop'] ) == 'true') {
        $content = wpautop( $content );
    }

    // Return column
    $content = '<div class="'.$class.'">'.$content.'</div><div class="clear"></div>';
    return do_shortcode( $content );

}

/**
 * Clear Row
 *
 * @since 1.0.0
 */
function smpl_shortcode_clear() {
  return '<div class="clear"></div>';
}

/*-----------------------------------------------------------*/
/* Components
/*-----------------------------------------------------------*/

/**
 * Button
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */


function smpl_shortcode_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link' => '',
        'size' => 'medium',
        'color' => '',
        'class' => '',
        'block' => 'false',
        'icon_before'  => '',
        'target' => '_self',
        'caption' => '',
        'align' => 'right'
    ), $atts));
    $button ='';
    $button .= '<div class="button '.$size.' '. $align.' '. $class.'">';
    $button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
    $button .= $content;
    if ($caption != '') {
    $button .= '<br /><span class="btn_caption">'.$caption.'</span>';
    };
    $button .= '</a></div><div class="clear"></div>';
    return $button;
}


/**
 * Info Boxes
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */
function smpl_shortcode_cta( $atts, $content = null ) {

    $output = '';
    $has_icon = '';

    $default = array(
        'style'   => 'blue', // blue, green, grey, orange, purple, red, teal, magenta
        'icon'    => ''
    );
    extract( shortcode_atts( $default, $atts ) );

    // Classes
    $classes = sprintf( 'cta info-box-%s', $style );

    // Add icon
    if( $icon ) {
      $classes .= ' info-box-has-icon';
      $content = sprintf( '<i class="icon fa fa-%s"></i>%s', $icon, do_shortcode($content) );
    }

    $output = sprintf( '<div class="%s">%s</div>', $classes, do_shortcode($content) );

    return $output;
}

/**
 * Callout Boxes (CTA)
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */
function smpl_shortcode_callout( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'style' => 'white',
      'title' => '',
      'align' => 'center',
      'centertitle' => '',
      'width' => ''
      ), $atts ) );

if (!empty($width)) {
    // regex to check for percentage or px symbol
    $pattern = "/%|px/";
    // if specified
    if (preg_match ($pattern, $width)) {
        $width = 'style="width:' . $width .';" ';
    // else, just add px by default
    } else {
        $width = 'style="width:' . $width .'px;" ';
    }
    // empty. defaults to css
} else {
        $width = '';
}
if (!empty($centertitle) && $centertitle == "true") {
    $centertitle = 'center';
} else {
    $centertitle = '';
}

    if (!empty($title)) {
    $st_callout = '<div class="st-callout hastitle ' . esc_attr($style) . ' ' . esc_attr($align) . '" '.$width.'>';
    $st_callout .= '<h4 class="st-callout-title '.esc_attr($centertitle).'">'.esc_attr($title).'</h4><div class="inside">';
    } else {
    $st_callout = '<div class="st-callout ' . esc_attr($style) . ' ' . esc_attr($align) . '" '.$width.'><div class="inside">';
    }
    $st_callout .= do_shortcode($content);
    $st_callout .= '</div></div><div class="clear"></div>';
    return $st_callout;
}


/**
 * Alerts
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */
function smpl_shortcode_alert( $atts, $content = null ) {

    $default = array(
        'class' => '',
        'style' => 'info', // 'info','alert','warn','success','idea'
        'show_icon' => 'true'
    );
    extract( shortcode_atts( $default, $atts ) );

    // CSS classes
    $classes = 'note';


    if( in_array( $style, array( 'info','alert','warn','success','download','idea' ) ) || in_array( $class, array( 'info','alert','warn','success','download','idea' ) ) ) {
      $classes .= sprintf( ' %s', $style );
        $classes .= sprintf( ' %s', $class );
    }
    if ($show_icon == "false") {
        $classes .= ' no-icon';
    }

    // Start output
    $output = sprintf( '<div class="%s"><div class="note-inner">', $classes );

    // Finish output
    $output .= $content.'</div></div>';

    return $output;
}

/**
 * Divider
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 */
function smpl_shortcode_divider( $atts, $content = null ) {

    $default = array(
        'style' => 'solid' // dashed, shadow, solid
    );
    extract( shortcode_atts( $default, $atts ) );

    switch ($style) {
        case 'solid':
            return '<hr/>';
            break;
        case 'dashed':
            return '<hr class="dashed"/>';
            break;
        case 'shadow':
            return '<div class="clearfade"></div>';
            break;
        default:
           return '<hr/>';
            break;
    }
}



/**
 * Clear Fade
 *
 * @since 1.0.1
 */
function smpl_shortcode_clearfade() {
    return '<div class="clear"></div><div class="clearfade"></div>';
}


/**
 * Blockquote
 *
 * @since 1.2.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 */
function smpl_shortcode_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'quote'         => '',
        'source'        => '',      // Source of quote
        'source_link'   => '',      // URL to link source to
        'align'         => '',      // How to align blockquote - left, right
        'class'         => ''       // Any additional CSS classes
    ),$atts));

    $atts = wp_parse_args( $atts, $defaults );

    $output .= '<blockquote>';
    $output .= $quote;
    if ($source) {
        if ($source_link) {
            $output .= sprintf( '<br /><em><a rel="external" href="%s">%s</a></em>', $source_link,$source );
        } else {
            $output .= sprintf( '<br /><em>&mdash; %s</em>', $source );
        }
    }
    $output.= '</blockquote>';

    return $output;
}


/*-----------------------------------------------------------*/
/* Tabs, Accordion, & Toggles
/*-----------------------------------------------------------*/

/**
 * Tabs
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */

function smpl_shortcode_tabgroup( $atts, $content ){
    $GLOBALS['tab_count'] = 0;
    do_shortcode( $content );
    if( is_array( $GLOBALS['tabs'] ) ){
        foreach( $GLOBALS['tabs'] as $tab ){
            $tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
            $panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
        }
    $return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
    }
    return $return;
}

function smpl_shortcode_tab( $atts, $content ){

    extract(shortcode_atts(array(
        'title' => '%d',
        'id' => '%d'),
    $atts));

    $x = $GLOBALS['tab_count'];

    $GLOBALS['tabs'][$x] = array(
        'title' => sprintf( $title, $GLOBALS['tab_count']),
        'content' =>  do_shortcode($content),
        'id' =>  $id);

    $GLOBALS['tab_count']++;
}

/**
 * Accordion
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */
function smpl_shortcode_accordion( $atts, $content = null ) {

    $accordion_id = uniqid( 'accordion_'.rand() );

    $output = sprintf( '<div id="%s" class="accordion">%s</div>', $accordion_id, do_shortcode( $content ) );

    return $output;
}

/**
 * Toggles
 *
 * @since 1.0.0
 *
 * @param array $atts Standard WordPress shortcode attributes
 * @param string $content The enclosed content
 * @return string $output Content to output for shortcode
 */
function smpl_shortcode_toggle( $atts, $content = null ) {

  $default = array(
        'title' => '',
        'open'  => 'false'
    );
  extract( shortcode_atts( $default, $atts ) );

    // Individual toggle ID
  $toggle_id = uniqid( 'toggle_'.rand() );


        // Is toggle open?
        $classes = 'panel-collapse collapse';
        if( $open == 'true' ) {
            $classes .= ' in';
        }

        $output = '
                <p class="trigger">
                    <a href="#'.$toggle_id.'">'.$title.'</a>
                </p>
                <div class="toggle_container" style="display:none;">
                    <div class="block">
                        '.do_shortcode( $content ).'
                    </div>
                </div>
            <div class="clear"></div>';


    return $output;
}



/*-----------------------------------------------------------------------------------*/
// Responsive YouTube Videos
// Usage: [youtube responsive="true" autoplay="true" controls="true" id="oHg5SJYRHA0" showinfo="true"]
/*-----------------------------------------------------------------------------------*/


// id // video id to embed
// responsive // true or false
// center // true or false
// width // width of video (if not responsive)
// height // height of video (if not responsive)
// autoplay // true or false
// controls // true or false
// showinfo // true or false

function smpl_shortcode_youtube( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'id'          => 'oHg5SJYRHA0',
      'responsive'  => 'true',
      'showinfo'    => 'false',
      'branding'    => 'false',
      'hd'          => 'true',
      'related'     => 'false',
      'width'       => '',
      'height'      => '',
      'center'      => 'false',
      'autoplay'    => '0',
      'theme'       => 'dark',
      'controls'    => 'true'),$atts));

$theme = esc_attr($theme);

$show_info = esc_attr($showinfo);
if ($show_info == "true") { $info = '1'; }
if ($show_info == "false") { $info = '0'; }
//$info

$branding = esc_attr($branding);
if ($branding == "false") { $modestbranding = '1'; }
if ($branding == "true") { $modestbranding = '0'; }
//$modestbranding

$related = esc_attr($related);
if ($related == "true") { $related = '1'; }
if ($related == "false") { $related = '0'; }
//$related

$hd = esc_attr($hd);
if ($hd == "true") { $showhd = '1'; }
if ($hd == "false") { $showhd = '0'; }
//$show_hd

$show_info = esc_attr($showinfo);
if ($show_info == "true") { $info = '1'; }
if ($show_info == "false") { $info = '0'; }
//$info

$theme = esc_attr($theme);
//$theme

if (esc_attr($autoplay) == 'true') {$autoplay = '1';}
if (esc_attr($autoplay) == 'false') {$autoplay = '0';}

if (esc_attr($controls) == 'true') {$controls = '1';}
if (esc_attr($controls) == 'false') {$controls = '0';}

if (esc_attr($responsive) == 'true') {$responsive = 'true';}
if (esc_attr($responsive) == 'false') {$responsive = 'false';}

if (esc_attr($center) == 'true') {$center = 'margin:0px auto;';}
if (esc_attr($center) == 'false') {$center = '';}


$video_width = esc_attr($width);
$video_height = esc_attr($height);

if (!isset($video_width) || !isset($video_height)) {
    $video = '<div class="video false"><iframe id="player" type="text/html" frameborder="0" ';
} else {
    $video = '<div class="video '.$responsive.'" style="width:'.$video_width.'px;height:'.$video_height.'px;'.$center.'"><iframe id="player" type="text/html" frameborder="0" ';
}

if (!empty($video_width)) {
$video .= 'width="'.$video_width.'" ';
}
if (!empty($video_height)) {
$video .= 'height="'.$video_height.'" ';
}

$video .= 'src="http://www.youtube.com/embed/'.esc_attr($id).'?autoplay='.$autoplay.'&amp;controls='.$controls.'&amp;showinfo='.$info.'&amp;hd='.$showhd.'&amp;modestbranding='.$modestbranding.'&amp;theme='.$theme.'&amp;rel='.$related.'';
$video .= '"></iframe></div>';

return $video;
}


/*-----------------------------------------------------------------------------------*/
// Responsive Vimeo Videos
// Usage: [vimeo responsive="true" id="6686768"]
/*-----------------------------------------------------------------------------------*/


// id // video id to embed
// responsive // true or false
// center // true or false
// width // width of video (if not responsive)
// height // height of video (if not responsive)

function smpl_shortcode_vimeo( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'id'          => '6686768',
      'responsive'  => 'true',
      'width'       => '',
      'height'      => '',
      'center'      => 'false'),$atts));


if (esc_attr($responsive) == 'true') {$responsive = 'true';}
if (esc_attr($responsive) == 'false') {$responsive = 'false';}

if (esc_attr($center) == 'true') {$center = 'margin:0px auto;';}
if (esc_attr($center) == 'false') {$center = '';}


$video_width = esc_attr($width);
$video_height = esc_attr($height);

if (!isset($video_width) || !isset($video_height)) {
    $video = '<div class="video false"><iframe id="player" type="text/html" frameborder="0" ';
} else {
    $video = '<div class="video '.$responsive.'" style="width:'.$video_width.'px;height:'.$video_height.'px;'.$center.'"><iframe id="player" type="text/html" frameborder="0" ';
}

if (!empty($video_width)) {
$video .= 'width="'.$video_width.'" ';
}
if (!empty($video_height)) {
$video .= 'height="'.$video_height.'" ';
}
$video .= 'src="//player.vimeo.com/video/'.esc_attr($id).'" ';

$video .= 'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

return $video;
}

/*-----------------------------------------------------------------------------------*/
//
// Latest Posts
// Shortcode Parameters:
//
/*-----------------------------------------------------------------------------------*/
// excerpt="true|false"         ------  display the excerpt or <!--more--> tag break
// length="50"                  ------  excerpt character length
// thumbs="true|false"          ------  display featured thumbnail
// width="50"                   ------  featured thumbnail width
// cols="2"                     ------  split the results into X number of columns (4 max)
// height="50"                  ------  featured thumbnail height
// num="6"                      ------  number of entries to display
// cat="1,-2"                   ------  categories to include or exclude (-)
// morelink="Read More..."      ------  more link text
// offset="0"                   ------  offset/skip X number of posts
// type="page|post"             ------  query type
// parent="1" (page only)       ------  page parent
// orderby="date|customfield"   ------  custom ordering
// order="ASC|DESC"             ------  sort order
/*-----------------------------------------------------------------------------------*/

// Example: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

/*-----------------------------------------------------------------------------------*/

function smpl_shortcode_latest($atts, $content = null) {
    extract(shortcode_atts(array(
    "offset" => '',
    "num" => '4',
    "cols" => '1',
    "thumbs" => 'false',
    "date" => 'false',
    "excerpt" => 'false',
    "length" => '50',
    "morelink" => '',
    "width" => '100',
    "height" => '100',
    "type" => 'post',
    "parent" => '',
    "cat" => '',
    "orderby" => 'date',
    "order" => 'ASC'
    ), $atts));
    global $post;

    $do_not_duplicate[] = $post->ID;
    $args = array(
      'post__not_in' => $do_not_duplicate,
    'cat' => $cat,
        'post_type' => $type,
        'post_parent'   => $parent,
        'showposts' => $num,
        'orderby' => $orderby,
        'offset' => $offset,
        'order' => $order
        );

    // query
    $myposts = new WP_Query($args);


    // set some variables for quicker math processing
    $count = 1;
    $col_count = $cols;
    $num_of_posts = $myposts->post_count;
    $post_per_column = ceil($num_of_posts / $col_count);

    switch ($col_count) {
        case '4':
            $div = "one_fourth";
            break;
        case '3':
            $div = "one_third";
            break;
        case '2':
            $div = "one_half";
            break;
        default:
            $div = "row";
            break;
    }
    // container
    $result='<div id="category-'.$cat.'" class="latestposts">';

    // begin loop
    while($myposts->have_posts()) : $myposts->the_post();

        // remove left margin from first column
        if ($count == 1)    {
            $result.='<div class="'.$div.' alpha">';
        }

        // math to determine interior/last columns
        switch ($col_count) {
        case '4':
            if ($count == $post_per_column * 3 + 1) {
                $result.='<div class="'.$div.' last">';
                // $result.='BEGIN LAST';
            } elseif ($count == $post_per_column + 1 || $count == $post_per_column * 2 + 1) {
                $result.='<div class="'.$div.'">';
                // $result.='BEGIN INNER';
            }
            break;
        case '3':
            if ($count == $post_per_column * 2 + 1) {
                $result.='<div class="'.$div.' last">';
                // $result.='BEGIN LAST';
            } elseif ($count == $post_per_column + 1) {
                $result.='<div class="'.$div.'">';
                // $result.='BEGIN INNER';
            }
            break;
        case '2':
            // get first item of last set
            if ($count == $post_per_column + 1) {
                $result.='<div class="'.$div.' last">';
                // $result.='BEGIN LAST';
            }
            break;
        default:
                $result.='';
            break;
        }

        // item open
        $result.='<div class="latest-item clearfix">';

        // title
        if ($excerpt == 'true') {
            $result.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
        } else {
            $result.='<div class="latest-title"><a href="'.get_permalink().'">'.the_title("","",false).'</a></div>';
        }

        // post date
        if ($date == 'false') {
            $result.='<div class "postmeta small"><span class="post_written">'.get_the_date().'</span></div>';
            # code...
        }

        // thumbnail
        if (has_post_thumbnail() && $thumbs == 'true') {
            if ( function_exists( 'st_timthumb' ) ) {
            $result.= '<img alt="'.get_the_title().'" class="alignleft latest-img" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
            } else {
            $result .= get_the_post_thumbnail( $post->ID, 'thumbnail',  array('class' => 'alignleft latest-img') );
            }
        }

        // excerpt
        if ($excerpt == 'true') {
            // allowed tags in excerpts
            $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
            // filter the content
            $text = preg_replace('/\[.*\]/', '', strip_tags(get_the_excerpt(), $allowed_tags));
            // remove the more-link
            $pattern = '/(<a.*?class="button more-link"[^>]*>)(.*?)(<\/a>)/';
            // display the new excerpt
            $content = preg_replace($pattern,"", $text);
            $result.= '<div class="latest-excerpt">'.smpl_limit_words($content,$length,'...').'</div>';
        }

        // more link
        if ($morelink) {
            $result.= '<a class="more-link" href="'.get_permalink().'">'.$morelink.'</a>';
        }

        // item close
        $result.='</div>';

        // close columns if open
        if ($count == $post_per_column || $count == $num_of_posts || $count % $post_per_column == 0)    {
            $result.='</div>';
        }

        // rinse and repeat
        $count++;

    endwhile;
    wp_reset_postdata();

    // container close
    $result.='<div class="clear"></div></div>';
    return $result;
}



function smpl_excerpt($words = 40, $link_text = 'Continue reading this entry &#187;', $allowed_tags = '', $container = 'p', $smileys = 'no' )
{
    global $post;

    if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';

    $text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, $allowed_tags));

    $text = explode(' ', $text);
    $tot = count($text);

    for ( $i=0; $i<$words; $i++ ) : $output .= $text[$i] . ' '; endfor;

    if ( $smileys == "yes" ) $output = convert_smilies($output);

    ?><p><?php echo force_balance_tags($output) ?><?php if ( $i < $tot ) : ?> ...<?php else : ?></p><?php endif; ?>
    <?php if ( $i < $tot ) :
        if ( $container == 'p' || $container == 'div' ) : ?></p><?php endif;
            if ( $container != 'plain' ) : ?><<?php echo $container; ?> class="more"><?php if ( $container == 'div' ) : ?><p><?php endif; endif; ?>

    <a href="<?php the_permalink(); ?>" title="<?php echo $link_text; ?>"><?php echo $link_text; ?></a><?php

            if ( $container == 'div' ) : ?></p><?php endif; if ( $container != 'plain' ) : ?></<?php echo $container; ?>><?php endif;
        if ( $container == 'plain' || $container == 'span' ) : ?></p><?php endif;
        endif;

}

/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function smpl_limit_words($string, $word_limit, $ending=false) {
    // creates an array of words from $string (this will be our excerpt)
    // explode divides the excerpt up by using a space character
    $words = explode(' ', $string);
    // this next bit chops the $words array and sticks it back together
    // starting at the first word '0' and ending at the $word_limit
    // the $word_limit which is passed in the function will be the number
    // of words we want to use
    // implode glues the chopped up array back together using a space character
    return implode(' ', array_slice($words, 0, $word_limit)).$ending;
}


function smpl_content_formatter( $content ) {
    $new_content = '';
    $pattern_full = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );
    foreach( $pieces as $piece ) {
        if( preg_match( $pattern_contents, $piece, $matches ) )
            $new_content .= $matches[1];
        else
            $new_content .= shortcode_unautop( wpautop( wptexturize( $piece ) ) );
    }
    return $new_content;
}
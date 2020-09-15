<?php
function wpst_page_navi($pages = '', $range = 4){

    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
    if(1 != $pages){
        echo "<div class=\"pagination\"><ul>";
        
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>" . esc_html__( 'First', 'wpst' ) . "</a></li>";
        if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>" . esc_html__( 'Previous', 'wpst' ) . "</a></li>";
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<li><a class=\"current\">".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">" . esc_html__( 'Next', 'wpst' ) . "</a></li>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>" . esc_html__( 'Last', 'wpst' ) . "</a></li>";
        echo "</ul></div>\n";
    }
}
/**** return page number ****/
function wpst_page_number( $separator = '' ){
    global $paged;
    if( $paged > 1 ){
        echo $separator . 'page ' . $paged;
    }else{
        return false;
    }
}
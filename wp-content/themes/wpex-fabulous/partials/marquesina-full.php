<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
global $post;
?>

    <div class="slider-tags" id="marquesina-contenido-">
        <marquee behavior="scroll" direction="left" scrollamount="2">
            <font face="Arial" size="2">
<?php
    $argumentos = array (
        'showposts'=>'5',
        'cat'=>'6',
        'orderby'=>'rand',
        /*'date_query' => array(
            array(
                'after' => '6 week ago'
                ))*/
        );
    $_posts = new WP_Query( $argumentos );

/*echo "<pre>";
    var_dump($_posts);
echo "</pre>";*/
    if ( $_posts->have_posts() ) {
        while ( $_posts->have_posts() ) {
            $_posts->the_post(); ?>
            <a href="<?php the_permalink() ?>"><?php echo get_the_title().": "; ?></a> <?php echo get_the_excerpt(); ?> |
<?php 
    }
        } 
    wp_reset_postdata();?>
            </font>
		</marquee>
  </div> 
	<!--Fin marquesina-full -->


 <script type="text/javascript">
    <!--
    var $j = jQuery.noConflict();
    $j(function () {
        // Marquesina con ajustes        
        $j('div.slider-tags marquee').marquee('pointer').mouseover(function () {
            $j(this).trigger('stop');
        }).mouseout(function () {
            $j(this).trigger('start');
        }).mousemove(function (event) {
            if ($j(this).data('drag') == true) {
                this.scrollLeft = $j(this).data('scrollX') + ($j(this).data('x') - event.clientX);
            }
        }).mousedown(function (event) {
            $j(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function () {
            $j(this).data('drag', false);
        });
    });
    //-->
</script>
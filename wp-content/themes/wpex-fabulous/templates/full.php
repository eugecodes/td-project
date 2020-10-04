<?php 
/* 
Template Name: Ancho Full
*/ 
?>
<?php get_header(); // add header  ?>  


<section class="categorias" style="padding-bottom: 0px;">
    <div class="anchoCat">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <div <?php post_class('categoria') ?> id="post-<?php the_ID(); ?>">

                <div class="no-image"></div>
                    <div class="article-full">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <div class="entry"><br />
                          <?php the_content('');?>
                          <?php wp_link_pages();?>
                        </div>
                    </div>
                    <div class="clear"></div>
            </div>
        </article>
        <?php endwhile;  endif; ?>
    </div>
    <div class="clear"></div>
</section>
<?php get_footer();?>
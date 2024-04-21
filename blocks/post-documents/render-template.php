<?php
/**
 * Post objects block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 *
 */

    global $post;
    $post_type = get_field('post_type');

    // get a list of available taxonomies for a post type
    $taxonomies = get_taxonomies (
        [ 'object_type' => [ $post_type ] ]
    );
?>


<div <?php echo ( !$is_preview ) ? get_block_wrapper_attributes() : ''; ?>>
    
    <form class="mixit-form-wrapper">
        <fieldset class="reset-group" data-filter-group>
            <button class="show-all-button" type="reset" data-filter="all">Visa alla</button>
        </fieldset>

        <?php

            $terms_id = 0;
            foreach ($taxonomies as $taxonomy) {
                $taxonomy_name = $taxonomy;
                $taxonomy_name_new = $terms_id++;
                $int_to_string = sprintf('%d', $taxonomy_name_new);
                $string = 'taxonomy';
                $new_variable = $string.$int_to_string;
                $var = get_terms( array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => true,
                ) );

                ?>
                    
                    <fieldset class="filter-group" data-filter-group>
                        <?php var_dump($taxonomy); ?>
                        <?php foreach( $var as $term ) { ?>
                            <button type="button" data-toggle=".tax-<?php echo $term->slug; ?>">
                            <span><?php echo $term->name; ?></span>
                        </button>
                        <?php } ?>
                    </fieldset>
                <?php
            }

        ?>

        <fieldset class="filter-group">
            <button type="button" data-sort="order:descending">Senaste</button>
            <button type="button" data-sort="order:asc">Äldsta</button>
        </fieldset>
        
    </form>

    <div class="posts-wrapper">
        <?php
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'order' => 'ASC',
        );
        $the_query = new WP_Query( $args ); ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <?php $i = 0; ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div data-order="<?php echo $i++; ?>" class="mix post <?php $terms_id = 0; foreach ($taxonomies as $taxonomy) { $taxonomy_name = $taxonomy; $taxonomy_name_new = $terms_id++; $int_to_string = sprintf('%d', $taxonomy_name_new); $string = 'taxonomy'; $new_variable = $string.$int_to_string; $var = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true, ) ); ?><?php foreach ( get_the_terms( get_the_ID(), $taxonomy_name ) as $tax ) {echo 'tax-'; echo $tax->slug . ' '; }?><?php } ?>">
                        <h4><?php the_title(); ?></h4>                            
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif;
        ?>
    </div>
</div>
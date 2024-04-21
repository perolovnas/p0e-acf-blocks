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
$post_type = get_field("post_type");

// get a list of available taxonomies for a post type
$taxonomies = get_taxonomies(["object_type" => [$post_type]]);
?>

<div <?php echo !$is_preview ? get_block_wrapper_attributes() : ""; ?>>

    <form class="mixit-form-wrapper">
        <fieldset class="reset-group" data-filter-group>
            <h4>Nollställ</h4>
            <button class="button-primary" type="reset" data-filter="all">Visa alla</button>
        </fieldset>

        <?php
        $terms_id = 0;
        foreach ($taxonomies as $taxonomy) {

            $taxonomy_name = $taxonomy;
            $taxonomy_name_new = $terms_id++;
            $int_to_string = sprintf("%d", $taxonomy_name_new);
            $string = "taxonomy";
            $new_variable = $string . $int_to_string;
            $var = get_terms([
                "taxonomy" => $taxonomy,
                "hide_empty" => true,
            ]);
            ?>
                    <?php $a = get_taxonomy($taxonomy); ?>
                    <fieldset class="filter-group" data-filter-group>
                        <h4><?php echo $a->label; ?></h4>
                        <?php foreach ($var as $term) { ?>
                            <button class="button-primary" type="button" data-toggle=".tax-<?php echo $term->slug; ?>">
                            <span><?php echo $term->name; ?></span>
                        </button>
                        <?php } ?>
                    </fieldset>
                <?php
        }
        ?>

        <fieldset class="filter-group">
            <h4>Sortera</h4>
            <button class="button-primary" type="button" data-sort="order:descending">Senaste</button>
            <button class="button-primary" type="button" data-sort="order:asc">Äldsta</button>
        </fieldset>

    </form>

    <div class="posts-wrapper">
        <?php
        $args = [
            "post_type" => $post_type,
            "posts_per_page" => -1,
            "order" => "ASC",
        ];
        $the_query = new WP_Query($args);
        ?>

            <?php if ($the_query->have_posts()): ?>
                <?php $i = 0; ?>
                <?php while ($the_query->have_posts()):
                    $the_query->the_post(); ?>
                        <?php
                        $file = get_field("file", $post->ID);
                        $if_pdf = ".pdf";
                        $if_mp4 = ".mp4";
                        $if_zip = ".zip";
                        $author = get_the_author_firstname();
                        ?>

                        <a data-order="<?php echo $i++; ?>" href="<?php echo $file[
    "url"
]; ?>" download class="mix post <?php
$terms_id = 0;
foreach ($taxonomies as $taxonomy) {
    $taxonomy_name = $taxonomy;
    $taxonomy_name_new = $terms_id++;
    $int_to_string = sprintf("%d", $taxonomy_name_new);
    $string = "taxonomy";
    $new_variable = $string . $int_to_string;
    $var = get_terms(["taxonomy" => $taxonomy, "hide_empty" => true]);
    foreach (get_the_terms(get_the_ID(), $taxonomy_name) as $tax) {
        echo "tax-";
        echo $tax->slug . " ";
    }
}
?>">
                            <?php if (
                                strpos($file["url"], $if_pdf) !== false
                            ) { ?>
                                        <div class="file-meta">
                                            <img src="<?php bloginfo(
                                                "template_url"
                                            ); ?>/assets/images/file-pdf.svg" alt="pdf">
                                        </div>
                                    <?php } elseif (
                                strpos($file["url"], $if_mp4) !== false
                            ) { ?>
                                        <div class="file-meta">
                                            <img src="<?php bloginfo(
                                                "template_url"
                                            ); ?>/assets/images/file-media.svg" alt="media">
                                        </div>
                                    <?php } elseif (
                                strpos($file["url"], $if_zip) !== false
                            ) { ?>
                                        <div class="file-meta">
                                            <img src="<?php bloginfo(
                                                "template_url"
                                            ); ?>/assets/images/file-rar.svg" alt="rar">
                                        </div>
                                    <?php } else { ?>
                                        <div class="file-meta">
                                            <img src="<?php bloginfo(
                                                "template_url"
                                            ); ?>/assets/images/file-file.svg" alt="rar">
                                        </div>
                                    <?php } ?>
                            <h4><?php the_title(); ?></h4>

                            <p>
                                Publicerad av <strong><?php echo $author; ?></strong>,
                                <span>
                                    <?php echo $file["date"]; ?>
                                </span>
                            </p>

                        </a>



                <?php
                endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
    </div>
</div>

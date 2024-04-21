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
?>
<div <?php echo ( !$is_preview ) ? get_block_wrapper_attributes() : ''; ?>>
	<div class="post-loop-wrapper">
	
	<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1
		);

		$custom_query = new WP_Query( $args );

		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				?>
					<div class="post-loop-item">
						<h4><?php the_title(); ?></h4>
						<div class="user-meta-avatar">
							<svg width="600" height="613" viewBox="0 0 600 613" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M566.667 478.673V293.74C566.667 275.93 566.65 267.02 564.487 258.73C562.567 251.387 559.417 244.436 555.153 238.155C550.34 231.067 543.653 225.19 530.247 213.461L370.247 73.4609C345.36 51.6846 332.917 40.8019 318.913 36.6606C306.573 33.0116 293.42 33.0116 281.08 36.6606C267.087 40.7989 254.66 51.6712 229.812 73.4146L69.7592 213.461C56.3548 225.19 49.6682 231.067 44.8568 238.155C40.5932 244.436 37.4185 251.387 35.4992 258.73C33.3335 267.02 33.3335 275.93 33.3335 293.74V478.673C33.3335 509.733 33.3335 525.26 38.4082 537.513C45.1745 553.847 58.1442 566.84 74.4795 573.607C86.7308 578.683 102.262 578.683 133.325 578.683C164.388 578.683 179.936 578.683 192.187 573.607C208.523 566.84 221.489 553.85 228.255 537.513C233.33 525.263 233.333 509.733 233.333 478.67V445.337C233.333 408.517 263.18 378.67 300 378.67C336.82 378.67 366.667 408.517 366.667 445.337V478.67C366.667 509.733 366.667 525.263 371.74 537.513C378.507 553.85 391.477 566.84 407.813 573.607C420.063 578.683 435.597 578.683 466.657 578.683C497.72 578.683 513.27 578.683 525.52 573.607C541.857 566.84 554.823 553.847 561.59 537.513C566.663 525.26 566.667 509.733 566.667 478.673Z" stroke="black" stroke-width="66.6667" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<?php the_author(); ?>
						</div>
						<?php the_content(); ?>
					</div>
				<?php
			}
		} else {
			echo "Inga poster :(";
		}

		wp_reset_postdata();
	?>

	</div>
</div>


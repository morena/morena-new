
<div class='latest_post_holder <?php echo $type.' '.$columns_number.' '.$rows_number; ?>' >
    <ul>
    <?php while ($q->have_posts()) : $q->the_post();
        $cat = get_the_category(); ?>

        <li class="clearfix">
            <div class="boxes_image">
                <a itemprop="url" href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'latest_post_boxes'); ?></a>
            </div>
            <div class="latest_post"  <?php echo $padding_latest_post; ?>>
                <div class="latest_post_text">
                    <div class="latest_post_inner">
                        <div itemprop="dateCreated" class="latest_post_date entry_date updated">
                            <div class="latest_post_day"><?php echo get_the_time('d'); ?></div>
                            <div class="latest_post_month"><?php echo get_the_time('M'); ?></div>
                            <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(qode_get_page_id()); ?>" />
                        </div>

                        <div class="latest_post_text_inner">
                            <<?php echo $title_tag; ?> itemprop="name" class="latest_post_title entry_title"><a itemprop="url" href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></<?php echo $title_tag; ?>>
                            <?php echo $this_object->getExcerpt(get_the_ID(), $params['text_length']); ?>
                            <span class="post_infos">

                                <?php if($display_category == '1'){ ?>
                                    <?php foreach ($cat as $categ) { ?>
                                       <a itemprop="url" href="<?php echo get_category_link($categ->term_id); ?>"><?php echo $categ->cat_name;?> </a>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($blog_hide_comments != "yes" && $display_comments == "1") {
                                    $comments_count = get_comments_number();
                                    switch ($comments_count) {
                                        case 0:
                                            $comments_count_text = __('No comment', 'qode');
                                            break;
                                        case 1:
                                            $comments_count_text = $comments_count . ' ' . __('Comment', 'qode');
                                            break;
                                        default:
                                            $comments_count_text = $comments_count . ' ' . __('Comments', 'qode');
                                            break;
                                    }   ?>
                                    <a itemprop="url" class="post_comments" href="<?php echo get_comments_link(); ?>"><?php echo $comments_count_text; ?></a>
                                <?php } ?>

                                <?php if($qode_like == "on" && function_exists('qode_like') && $display_like == '1') { ?>
                                        <span class="blog_like"><?php echo qode_like_latest_posts(); ?></span>
                                <?php } ?>

                                <?php if($display_share == '1'){
									echo do_shortcode('[social_share]');
                                } ?>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>
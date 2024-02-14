<?php
/*
 * This file serve HTML for block
 * For this particular code challange i am giving this file an other responsibility of providing
 * a custom API endpoint for callback function in admin preview
 * This way we are avoiding duplication of code.
 * Note : we can not use this application on production level as this approach need more security
 * checks to be used for production level
 *
 */
function generateAuthorHTML($id) {
    ob_start();
    if(!empty($id) && $id!=="undefined"){
        $authorInfo = get_userdata( $id );
        $get_author_gravatar = get_avatar_url($id, array('size' => 450));

        ?>
        <div class="author-callout">

            <div class="author-callout__photo" style="background-image: url(<?php echo $get_author_gravatar ?>)">


            </div>
            <div class="author-callout__text">
                <h5><?php echo $authorInfo->user_nicename; ?></h5>
                <p><?php echo wp_trim_words($authorInfo->user_description, 20); ?></p>
                <p><strong><a href="<?php echo get_author_posts_url($id) ?>">Learn more about <?php echo $authorInfo->user_nicename; ?> &raquo;</a></strong></p>

            </div>

        </div>
        <?php


    }
    return ob_get_clean();

}
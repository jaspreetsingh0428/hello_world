<?php
/* * *************
 * Display any value of plugin field
 * [AllSchemas value = "allSchema_youtube_url"]
 */

function social_organization_schema($atts) {
    return get_option($atts['value']);
}

add_shortcode('AllSchemas', 'social_organization_schema');
/* * *************
 * Display list of social links with icons
 * [OrganizationStructuredData]
 */

function social_organization_structured_data($atts) {
    ?>   
    <ul id="social-organization-schemas-wrap" class="social-organization-schemas-wrap">
        <?php if (get_option('allSchema_facebook_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_facebook_url'); ?>">
                    <span class="<?php echo get_option('allSchema_facebook_code'); ?>"></span>
                </a>
            </li>  
        <?php } ?>
        <?php if (get_option('allSchema_twitter_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_twitter_url') ?>">
                    <span class="<?php echo get_option('allSchema_twitter_code') ?>"></span>
                </a>
            </li>
        <?php } ?>
        <?php if (get_option('allSchema_instagram_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_instagram_url') ?>">
                    <span class="<?php echo get_option('allSchema_instagram_code') ?>"></span>
                </a>
            </li>
        <?php } ?>
        <?php if (get_option('allSchema_linkedin_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_linkedin_url') ?>">
                    <span class="<?php echo get_option('allSchema_linkedin_code') ?>"></span>
                </a>
            </li>
        <?php } ?>
        <?php if (get_option('allSchema_youtube_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_youtube_url') ?>">
                    <span class="<?php echo get_option('allSchema_youtube_code') ?>"></span>
                </a>
            </li>
        <?php } ?>
        <?php if (get_option('allSchema_google_plus_url')) { ?>
            <li>
                <a target="_blank" href="<?php echo get_option('allSchema_google_plus_url') ?>">
                    <span class="<?php echo get_option('allSchema_google_plus_code'); ?>"></span>
                </a>   
            </li>
        <?php } ?>
    </ul>
    <?php
    return;
    //return $social_html;  
}

add_shortcode('OrganizationStructuredData', 'social_organization_structured_data');
/* * *************
 * Display Value of NAP Post Meta Field Values
 * [OrganizationStructuredData]
 */

function display_nap_field_values($atts) {
    return esc_attr(get_post_meta(get_the_ID(), 'nap_attorney_name', true));
}

add_shortcode('attorney_name_nap', 'display_nap_field_values');

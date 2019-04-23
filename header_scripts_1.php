<?php
add_action('wp_head', 'add_structured_data_Schema');

function add_structured_data_Schema() {


    /*     * ****
     * Organization Schemas
     */

    $website_name = !empty(get_option('allSchema_website_name')) ? get_option('allSchema_website_name') : '';
    $website_url = get_site_url();
    $website_description = !empty(get_option('allSchema_website_description')) ? get_option('allSchema_website_description') : '';
    $website_logo = !empty(get_option('allSchema_website_logo')) ? get_option('allSchema_website_logo') : '';
    $facebook_url = !empty(get_option('allSchema_facebook_url')) ? get_option('allSchema_facebook_url') : '';
    $twitter_url = !empty(get_option('allSchema_twitter_url')) ? get_option('allSchema_twitter_url') : '';
    $instagram_url = !empty(get_option('allSchema_instagram_url')) ? get_option('allSchema_instagram_url') : '';
    $myspace_url = !empty(get_option('allSchema_myspace_url')) ? get_option('allSchema_myspace_url') : '';
    $linkedin_url = !empty(get_option('allSchema_linkedin_url')) ? get_option('allSchema_linkedin_url') : '';
    $pininterest_url = !empty(get_option('allSchema_pininterest_url')) ? get_option('allSchema_pininterest_url') : '';
    $youtube_url = !empty(get_option('allSchema_youtube_url')) ? get_option('allSchema_youtube_url') : '';
    $google_plus = !empty(get_option('allSchema_google_plus_url')) ? get_option('allSchema_google_plus_url') : '';
    /* Describe what the code snippet does so you can remember later on */



//Local Business
    $local_business_image_default_logo = !empty(get_option('allSchema_local_business_website_logo_checkbox')) ? get_option('allSchema_local_business_website_logo_checkbox') : '';
    $local_business_image_logo = !empty(get_option('allSchema_local_business_image')) ? get_option('allSchema_local_business_image') : '';



    if (get_option('allSchema_disable_organization_schema') == 'Yes') {
        
    } else {
        ?>
        <script type="application/ld+json">
            {
            "@context":"https://schema.org",
            "@type" : "Organization",
            "@id":"<?php echo bloginfo('url'); ?>/#organization",
            <?php if (get_option('allSchema_organization_name_checkbox') == 'Yes') { ?>
                "name":"<?php echo $website_name; ?>",
            <?php } ?>
            <?php if (get_option('allSchema_organization_url_checkbox') == 'Yes') { ?>
                "url":"<?php echo $website_url; ?>",
            <?php } ?>
            <?php if (get_option('allSchema_organization_logo_checkbox') == 'Yes') { ?>     
                "logo":"<?php echo $website_logo; ?>",
            <?php } ?>
            <?php if (get_option('allSchema_organization_description_checkbox') == 'Yes') { ?> 
                "description":"<?php echo $website_description; ?>",
            <?php } ?>
            "sameAs":["<?php echo $twitter_url; ?>","<?php echo $facebook_url; ?>","<?php echo $instagram_url; ?>","<?php echo $myspace_url; ?>","<?php echo $linkedin_url; ?>", "<?php echo $pininterest_url; ?>",  "<?php echo $youtube_url; ?>", "<?php echo $google_plus; ?>"]
            }

        </script>
        <?php
    } // end organization loop
    ?>    
    <script type="application/ld+json">
          {
            "@context":"https://schema.org",
            "@type" : "LegalService",
            "@id":"<?php echo bloginfo('url'); ?>/#legalservice",
            "priceRange":"N/A",
            "name":"<?php echo $website_name; ?>",
    <?php if ($local_business_image_default_logo == "Yes") { ?> 
                                                            "image":"<?php echo $website_logo; ?>",
    <?php } else { ?>
                                                         "image":"<?php echo $local_business_image_logo; ?>",
    <?php } ?>
    <?php
    $cm = 1;

    $featured_nap_loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1, 'meta_key' => 'is_featured_nap_location', 'meta_value' => 'yes'));
    $count_nap_posts_num1 = $featured_nap_loop->found_posts;
    ?>      
    <?php
    if ($featured_nap_loop->have_posts()) {
        ?>                  "address" :
                                    [
        <?php
        while ($featured_nap_loop->have_posts()) : $featured_nap_loop->the_post();

            $nap_id = get_the_ID();
            ?>                                 { 
                                                                                                  "@type": "PostalAddress",
                                                                                                     "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?>",
                                                                                                    "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                                                                                    "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                                                                                    "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                                                                                    "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                                                                                    "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                                                                        }   
                                              
                                            
            <?php if (($cm >= 1) && ($count_nap_posts_num1 != $cm)) { ?>  , <?php } ?> 
                                              
                                                           
            <?php
            $cm++;
        endwhile;
        ?>
                          ] 
        <?php
        wp_reset_query();
    } else {
        ?> 
        <?php
        $c = 1;
        $count_nap_posts = wp_count_posts($post_type = 'nap_location');
        $selected_nap = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
        // print_r($selected_nap);
        $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1));
        ?>
        <?php
        if ($loop->have_posts()) :

            $count_nap_posts_num = $count_nap_posts->publish;
         
        $selected_nap_chekbox_count = count($selected_nap);
            ?>
                                                    "address" :
                                                [
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $nap_id = get_the_ID();
                ?>

                                              
                <?php if ($selected_nap == 0) { ?>
                                                                             {
                                                                                                                          "@type": "PostalAddress",
                                                                                                                             "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?>",
                                                                                                                            "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                                                                                                            "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                                                                                                            "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                                                                                                            "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                                                                                                            "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                                                                                                }
                    <?php if (($c >= 1) && ($count_nap_posts_num != $c)) { ?>  , <?php } ?> 
                <?php } else { ?>
                    <?php if (in_array(get_the_ID(), $selected_nap)) {
                        ?>                                 { 
                                                                                                                                  "@type": "PostalAddress",
                                                                                                                                     "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?>",
                                                                                                                                    "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                                                                                                                    "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                                                                                                                    "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                                                                                                                    "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                                                                                                                    "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                                                                                                        }   
                        <?php
                        $selected_nap_without0 = array_diff($selected_nap, array('0'));
                      $selected_nap_chekbox_count = count($selected_nap_without0);
                        if (($c >= 1) && ($selected_nap_chekbox_count != $c)) {
                            ?>  , <?php } ?> 
                    <?php } // close selected nap        ?>
                                                            
                <?php } ?>
                                                                       
                <?php
                $c++;
            endwhile;
            ?>
                                      ] 
            <?php
        endif;
        wp_reset_query();
    }
    ?> 
        }                        
                 
    </script>   

    <?php
}

// end add_structured_data_schema

    
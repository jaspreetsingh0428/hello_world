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
        if (get_option('allSchema_enable_organization_schema_for_all_pages') == 'Yes') {
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
        } else {
            if (is_home() || is_front_page()) {
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
            } // only home page
        } // end of all pages
    } // end organization loop
    ?>   
    <?php $local_business_schema_type = get_option('allSchema_local_business_schema_type'); ?>
    <?php if ($local_business_schema_type == "allSchema_LegalService") { ?>
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
            $count_nap_posts_num1 = $featured_nap_loop->found_posts;
            ?>      
            <?php
            $c = 1;
            $count_nap_posts = wp_count_posts($post_type = 'nap_location');
            $selected_nap = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
            $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1));
            ?>
            <?php
            if ($loop->have_posts()) {
                $count_nap_posts_num = $count_nap_posts->publish;
                $selected_nap_chekbox_count = count($selected_nap);
                //print_r($selected_nap);
                ?>
                "address" :
                [
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    $nap_id = get_the_ID();
                    ?>
                    <?php if (!array_filter($selected_nap)) { ?>
                        {
                        "@type": "PostalAddress",
                        "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                        "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                        "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                        "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                        "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                        "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                        }
                        <?php if (($c >= 1) && ($count_nap_posts_num != $c)) { ?>  , <?php } ?> 
                        <?php
                        $c++;
                    } else {
                        ?>
                        <?php if (in_array(get_the_ID(), $selected_nap)) {
                            ?>                                 { 
                            "@type": "PostalAddress",
                            "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                            "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                            "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                            "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                            "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                            "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                            }   
                            <?php
                            $selected_nap_without0 = array_diff($selected_nap, array('0'));
                            $selected_nap_chekbox_count = count($selected_nap_without0);
                            if (($c >= 1) && ($selected_nap_chekbox_count != $c)) {
                                ?>  , <?php } ?> 
                            <?php
                            $c++;
                        } // close selected nap          
                        ?>
                    <?php } ?> <?php
                endwhile;
                ?>
                ] 
                <?php
                wp_reset_query();
            }
            ?>
            }                        
        </script> 
    <?php }// legalservice type end   ?>
    <?php if (get_option('allSchema_enable_local_business_schema') == 'Yes') { ?>
        <script type="application/ld+json">
            {
            "@context":"https://schema.org",
            "@type" : "LocalBusiness",
            "@id":"<?php echo bloginfo('url'); ?>/#localbusiness",
            "priceRange":"N/A",
            "name":"<?php echo $website_name; ?>",
        <?php if ($local_business_image_default_logo == "Yes") { ?> 
                    "image":"<?php echo $website_logo; ?>",
        <?php } else { ?>
                    "image":"<?php echo $local_business_image_logo; ?>",
        <?php } ?>
        <?php if (get_option('allSchema_localbusiness_schema_email')) { ?>
                                    "email" : "<?php echo get_option('allSchema_localbusiness_schema_email'); ?>",
        <?php } ?> 
        <?php if (get_option('allSchema_localbusiness_schema_phone')) { ?>
                                    "telephone" : "<?php echo get_option('allSchema_localbusiness_schema_phone'); ?>",
        <?php } ?> 
        <?php
        $cm = 1;
        $count_nap_posts_num1 = $featured_nap_loop->found_posts;
        ?>      
        <?php
        $c = 1;
        $count_nap_posts = wp_count_posts($post_type = 'nap_location');
        $selected_nap = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
        $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1));
        ?>
        <?php
        if ($loop->have_posts()) {
            $count_nap_posts_num = $count_nap_posts->publish;
            $selected_nap_chekbox_count = count($selected_nap);
            ?>
                    "address" :
                    [
            <?php
            while ($loop->have_posts()) : $loop->the_post();

                $nap_id = get_the_ID();
                ?>
                <?php if (!array_filter($selected_nap)) { ?>
                                    {
                                    "@type": "PostalAddress",
                                    "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                    "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                    "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                    "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                    "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                                    "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                    }
                    <?php if (($c >= 1) && ($count_nap_posts_num != $c)) { ?>  , <?php } ?> 
                    <?php
                    $c++;
                } else {
                    ?>
                    <?php if (in_array(get_the_ID(), $selected_nap)) {
                        ?>                                 { 
                                            "@type": "PostalAddress",
                                            "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                            "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                            "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                            "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                            "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                                            "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                            }   
                        <?php
                        $selected_nap_without0 = array_diff($selected_nap, array('0'));
                        $selected_nap_chekbox_count = count($selected_nap_without0);

                        if (($c >= 1) && ($selected_nap_chekbox_count != $c)) {
                            ?>  , <?php } ?> 
                        <?php
                        $c++;
                    } // close selected nap          
                    ?>
                <?php } ?>
                <?php
            endwhile;
            ?>
                    ] 
            <?php
            wp_reset_query();
        }
        ?>
            } 
        </script> 
    <?php }//if localbusiness checked
    ?>
    <?php if (get_option('allSchema_enable_website_schema') == 'Yes') { ?>
        <script type="application/ld+json">
            {"@context":"https://schema.org","@type":"WebSite","@id":"<?php echo get_site_url(); ?>/#website","url":"<?php echo get_site_url(); ?>","name":"<?php echo get_option('allSchema_website_name'); ?>","potentialAction":{"@type":"SearchAction","target":"<?php echo get_site_url(); ?>?s={search_term_string}","query-input":"required name=search_term_string"}}
        </script>
    <?php } // end enable website schema ?>
    <?php if (get_option('allSchema_enable_client_review_schema') == 'Yes') { ?>
        <?php $star_rating = get_post_meta(get_the_ID(), 'client_review_star_rating', true); ?>
        <?php if ($star_rating) { ?>
            <script type="application/ld+json">
                {
                "@context": "https://schema.org/",
                "@type": "Review",
                "itemReviewed": {
                "@type": "thing",
                "name" : "<?php echo get_post_meta(get_the_ID(), 'client_review_review_title_field', true); ?>"
                },
                "reviewRating": {
                "@type": "Rating",
                "ratingValue": " <?php echo $star_rating; ?>",      
                "worstRating" : "1",
                "bestRating" : "5"
                },
                "author": {
                "@type": "Person",
                "name" : "<?php echo get_post_meta(get_the_ID(), 'client_review_reviewed_by_field', true); ?>"
                }                     
                }   
            </script>  
        <?php } ?>
    <?php } // end enable review schema  ?>
    <?php if (get_option('allSchema_enable_medical_schema') == 'Yes') { ?>
        <?php $medical_schema_type = get_option('allSchema_medical_schema_type'); ?>
        <?php if ($medical_schema_type == "allSchema_Medical_Organization") { ?>
            <script type="application/ld+json">
                {  
                "@context": "https://schema.org/",
                "@type": "MedicalOrganization",
                "image" : "<?php echo $website_logo; ?>",
                <?php if (get_option('allSchema_medical_org_clinic_name')) { ?>
                    "name" : "<?php echo get_option('allSchema_medical_org_clinic_name'); ?>",
                <?php } ?>
                <?php if (get_option('allSchema_medical_schema_specialty')) { ?>
                    "medicalSpecialty" : "<?php echo get_option('allSchema_medical_schema_specialty'); ?>",
                <?php } ?>
                <?php if (get_option('allSchema_medical_schema_email')) { ?>
                    "email" : "<?php echo get_option('allSchema_medical_schema_email'); ?>",
                <?php } ?> 
                <?php if (get_option('allSchema_medical_schema_phone')) { ?>
                    "telephone" : "<?php echo get_option('allSchema_medical_schema_phone'); ?>",
                <?php } ?> 

                <?php
                $cm = 1;
                $count_nap_posts_num1 = $featured_nap_loop->found_posts;
                ?>      
                <?php
                $c = 1;
                $count_nap_posts = wp_count_posts($post_type = 'nap_location');
                $selected_nap = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
                $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1));
                ?>
                <?php
                if ($loop->have_posts()) {
                    $count_nap_posts_num = $count_nap_posts->publish;
                    $selected_nap_chekbox_count = count($selected_nap);
                    ?>
                    "address" :
                    [
                    <?php
                    while ($loop->have_posts()) : $loop->the_post();
                        $nap_id = get_the_ID();
                        ?>
                        <?php if (!array_filter($selected_nap)) { ?>
                            {
                            "@type": "PostalAddress",
                            "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                            "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                            "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                            "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                            "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                            "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                            }
                            <?php if (($c >= 1) && ($count_nap_posts_num != $c)) { ?>  , <?php } ?> 
                            <?php
                            $c++;
                        } else {
                            ?>
                            <?php if (in_array(get_the_ID(), $selected_nap)) {
                                ?>                                 { 
                                "@type": "PostalAddress",
                                "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                                "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                }   
                                <?php
                                $selected_nap_without0 = array_diff($selected_nap, array('0'));
                                $selected_nap_chekbox_count = count($selected_nap_without0);

                                if (($c >= 1) && ($selected_nap_chekbox_count != $c)) {
                                    ?>  , <?php } ?> 
                                <?php
                                $c++;
                            } // close selected nap          
                            ?>
                        <?php } ?>
                        <?php
                    endwhile;
                    ?>
                    ] 
                    <?php
                    wp_reset_query();
                }
                ?>


                }   
            </script>  
        <?php } else if ($medical_schema_type == "allSchema_Medical_Clinic") { ?>
            <script type="application/ld+json">
                {
                "@context": "https://schema.org/",
                "@type": "MedicalClinic",
            <?php if (get_option('allSchema_medical_schema_specialty')) { ?>
                        "medicalSpecialty" : <?php echo get_option('allSchema_medical_schema_specialty'); ?>
            <?php } ?>
            <?php if (get_option('allSchema_medical_schema_email')) { ?>
                        "email" : <?php echo get_option('allSchema_medical_schema_email'); ?>
            <?php } ?> 
            <?php if (get_option('allSchema_medical_schema_phone')) { ?>
                        "phone" : <?php echo get_option('allSchema_medical_schema_phone'); ?>
            <?php } ?> 
            <?php if (get_option('allSchema_medical_org_clinic_name')) { ?>
                        "name" : <?php echo get_option('allSchema_medical_org_clinic_name'); ?>
            <?php } ?>
                "image" : <?php echo $website_logo; ?>  
            <?php
            $cm = 1;
            $count_nap_posts_num1 = $featured_nap_loop->found_posts;
            ?>      
            <?php
            $c = 1;
            $count_nap_posts = wp_count_posts($post_type = 'nap_location');
            $selected_nap = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
            $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1));
            ?>
            <?php
            if ($loop->have_posts()) {
                $count_nap_posts_num = $count_nap_posts->publish;
                $selected_nap_chekbox_count = count($selected_nap);
                ?>
                        "address" :
                        [
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    $nap_id = get_the_ID();
                    ?>
                    <?php if (!array_filter($selected_nap)) { ?>
                                                {
                                                "@type": "PostalAddress",
                                                "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                                "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                                "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                                "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                                "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                                                "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                                }
                        <?php if (($c >= 1) && ($count_nap_posts_num != $c)) { ?>  , <?php } ?> 
                        <?php
                        $c++;
                    } else {
                        ?>
                        <?php if (in_array(get_the_ID(), $selected_nap)) {
                            ?>                                 { 
                                                            "@type": "PostalAddress",
                                                            "streetAddress": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)) ?> , <?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)) ?>",
                                                            "addressLocality": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)) ?>",
                                                            "addressRegion": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)) ?>",
                                                            "postalCode": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)) ?>",
                                                            "addressCountry": "<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)) ?>",
                                                            "telephone":"<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)) ?>"
                                                            }   
                            <?php
                            $selected_nap_without0 = array_diff($selected_nap, array('0'));
                            $selected_nap_chekbox_count = count($selected_nap_without0);

                            if (($c >= 1) && ($selected_nap_chekbox_count != $c)) {
                                ?>  , <?php } ?> 
                            <?php
                            $c++;
                        } // close selected nap          
                        ?>
                    <?php } ?>
                    <?php
                endwhile;
                ?>
                        ] 
                <?php
                wp_reset_query();
            }
            ?>
                }   
            </script>    
            <?php
        } else {
            
        }
        ?> 
    <?php } // end enable Medical schema  ?>       
    <?php
}

// end add_structured_data_schema

    
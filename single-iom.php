<?php get_header(); ?>

    <div class="container">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <!-- Gets the title and content -->
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

            <hr/>

            <!-- Text output -->
            <?php
            $text = get_post_meta( get_the_ID(), 'iomMeta_text', true );
            echo esc_html( $text );
            ?>

            <hr/>

            <!-- Email output -->
            <?php
            $email = get_post_meta( get_the_ID(), 'iomMeta_email', true );
            echo esc_html( $email );
            ?>

            <hr/>

            <!-- URL output -->
            <?php
            $url = get_post_meta( get_the_ID(), 'iomMeta_url', true );
            echo esc_html( $url );
            ?>

            <hr/>

            <!-- Text area output -->
            <?php
            $textarea = get_post_meta( get_the_ID(), 'iomMeta_textarea', true );
            echo esc_html( $textarea );
            ?>

            <hr/>

            <!-- Time picker output -->
            <?php
            $texttime = get_post_meta( get_the_ID(), 'iomMeta_texttime', true );
            echo esc_html( $texttime );
            ?>

            <hr/>

            <!-- Color picker output -->
            <div class="your_element" style=" height: 50px; width: 50px; background-color:
                <?php
                $colorpicker = get_post_meta( get_the_ID(), 'iomMeta_colorpicker', true );
                echo esc_html( $colorpicker );
                ?>
            "></div>

            <hr/>

            <!-- Checkbox output -->
            <?php if ( get_post_meta( get_the_ID(), 'iomMeta_checkbox', 1 ) ) : ?>
                <div>The checkbox is checked</div>
            <?php endif; ?>

            <hr/>

            <!-- Radio output -->
            <?php
            $radio = get_post_meta( get_the_ID(), 'iomMeta_radio', true );
            echo esc_html( $radio );
            ?>

            <hr/>

            <!-- Select output -->
            <?php
            $select = get_post_meta( get_the_ID(), 'iomMeta_select', true );
            echo esc_html( $select );
            ?>

            <hr/>

            <!-- Editor output -->
            <?php
            $editor = get_post_meta( get_the_ID(), 'iomMeta_editor', true );
            echo $editor;
            ?>

            <hr/>

            <!-- Single image output -->
            <?php
            $file = get_post_meta( get_the_ID(), 'iomMeta_file', true );
            echo '<img src="'. $file .'">';
            ?>

            <hr/>

            <!-- Image/file list output -->
            <?php
            function cmb2_output_file_list( $file_list_meta_key, $img_size = 'full' ) {

                // Get the list of files
                $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );

                echo '<div class="image">';
                // Loop through them and output an image
                foreach ( (array) $files as $attachment_id => $attachment_url ) {
                    echo '<a href="'. $attachment_url .'">';
                    echo wp_get_attachment_image( $attachment_id, $img_size );
                    echo '</a>';
                }
                echo '</div>';
            };

            cmb2_output_file_list( 'iomMeta_files', 'full' );
            ?>

            <hr/>

            <!-- Embed output -->
            <?php
            $embed = esc_url( get_post_meta( get_the_ID(), 'iomMeta_embed', 1 ) );
            echo wp_oembed_get( $embed);
            ?>


        <?php endwhile; else: ?>
            <p><?php _e('Sorry, the page does not exist.'); ?></p>
        <?php endif; ?>

    </div>

<?php get_footer(); ?>
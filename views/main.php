

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <form id="zureo-importer-page" method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
        <div id="universal-message-container">
            <h2>Universal Message</h2>

            <div class="options">
                <p>
                    <label>What message would you like to display above each post?</label>
                    <br />
                    <input type="text" name="acme-message" value="" />
                </p>
            </div>
            <!-- #universal-message-container -->
        <?php
            wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );
            submit_button();
        ?>
    </form>
    <button id="zureo-importer-buttom" onclick="return false;"></button>
</div>


<?php


function my_enqueue() {
        wp_enqueue_script('datapicker', "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js", [], null, false);
        wp_register_style('datepicker', "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css", [], null, null, 'all');

        wp_enqueue_script('zureo', plugins_url('js/zureo.js', __FILE__), ['jquery'], "1.0", false);
        wp_localize_script('zureo', 'zureo_ajax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}

add_action( 'admin_enqueue_scripts', 'my_enqueue' );


?>


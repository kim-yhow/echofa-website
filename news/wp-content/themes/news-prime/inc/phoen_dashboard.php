<?php 
add_action( 'load-themes.php',  'news_prime_activation_admin_notice_main' );

function news_prime_admin_import_notice(){
    ?>
    <div class="updated notice notice-success notice-alt is-dismissible">
        <p><?php printf( esc_html__( 'Save time by import our demo data, your website will be set up and ready to customize in minutes. %s', 'news-prime' ), '<a class="button button-secondary" href="'.esc_url( add_query_arg( array( 'page' => 'news_prime_pro&importer=phoen-data-importer&amp;importer_new=3'), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Import Demo Data', 'news-prime' ).'</a>'  ); ?></p>
    </div>
    <?php
}

function news_prime_activation_admin_notice_main(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		
        add_action( 'admin_notices', 'news_prime_admin_import_notice' );
    }
}
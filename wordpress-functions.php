<?php

/* Gets the current user’s ID if logged in
 * Ref: https://developer.wordpress.org/reference/functions/get_current_user_id/
*/
get_current_user_id();

/* Gets the current user’s ID if logged in
 * Ref: https://developer.wordpress.org/reference/functions/wp_get_current_user/
*/
wp_get_current_user();





// WooCommerce functions 

/**
 * Send order details link to cutomer after purchase. Link can be seen while logged in into the system
 */
add_action( 'woocommerce_thankyou', 'send_order_public_url' );
function send_order_public_url( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $public_view_order_url = esc_url( $order->get_view_order_url() );
     
    $customer_email = $order->get_billing_email();
        
        $to = $customer_email;
        $subject = 'Your order details is here';
        $body = "View Your Order Details ". $public_view_order_url ;
        wp_mail($to, $subject, $body);  
      
    
}
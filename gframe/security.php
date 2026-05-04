<?php
/**
 * Security functions for Custom Login URL
 * Logic to replace wp-login.php and wp-admin with /wp-gaccess
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class GTheme_Security {
    private $slug = 'wp-gaccess';

    public function __construct() {
        // Rewrite rules
        add_action('init', array($this, 'add_rewrite_rules'));
        add_filter('query_vars', array($this, 'add_query_vars'));
        add_action('parse_request', array($this, 'handle_custom_login_request'));
        
        // Protection
        add_action('init', array($this, 'block_direct_access_init'));
        add_action('login_init', array($this, 'block_direct_access_login'));

        
        // URL Filtering
        add_filter('site_url', array($this, 'filter_urls'), 10, 4);
        add_filter('network_site_url', array($this, 'filter_urls'), 10, 4);
        add_filter('wp_redirect', array($this, 'filter_redirects'), 10, 2);
        
        // Handle logout and other actions
        add_filter('logout_url', array($this, 'filter_logout_url'), 10, 2);
    }

    /**
     * Register rewrite rules for the custom slug
     */
    public function add_rewrite_rules() {
        add_rewrite_rule('^' . $this->slug . '/?$', 'index.php?' . $this->slug . '=1', 'top');
    }

    /**
     * Add custom query var
     */
    public function add_query_vars($vars) {
        $vars[] = $this->slug;
        return $vars;
    }

    /**
     * If the custom query var is present, load the login page
     */
    public function handle_custom_login_request($wp) {
        if (isset($wp->query_vars[$this->slug])) {
            // Define a constant to indicate we are using the authorized path
            if (!defined('GACCESS_AUTHORIZED')) {
                define('GACCESS_AUTHORIZED', true);
            }
            require_once ABSPATH . 'wp-login.php';
            exit;
        }
    }

    /**
     * Block direct access to wp-admin and wp-login.php at init level
     */
    public function block_direct_access_init() {
        if (is_user_logged_in() || is_admin() || defined('DOING_AJAX')) {
            return;
        }

        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        // If it's the custom slug, don't block
        if (strpos($request_uri, $this->slug) !== false) {
            return;
        }

        // If trying to access wp-admin or wp-login.php directly
        if (strpos($request_uri, 'wp-admin') !== false || strpos($request_uri, 'wp-login.php') !== false) {
            $this->trigger_block();
        }
    }

    /**
     * Block direct access at login_init level (double check)
     */
    public function block_direct_access_login() {
        // If we are not using the authorized constant and not logged in, block
        if (!defined('GACCESS_AUTHORIZED') && !is_user_logged_in()) {
            // Check if it's a legitimate action that shouldn't be blocked (like post password)
            if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'postpass') {
                return;
            }
            
            $this->trigger_block();
        }
    }

    /**
     * Common block action (redirect to 404 or home)
     */
    private function trigger_block() {
        wp_safe_redirect(home_url('404'), 404);
        exit;
    }


    /**
     * Filter URLs to point to our custom slug
     */
    public function filter_urls($url, $path, $scheme, $blog_id) {
        if (strpos($url, 'wp-login.php') !== false) {
            // Only filter if we are already in the custom flow, if the user is logged in (for logout links),
            // or if the current request is already for our custom slug.
            if (defined('GACCESS_AUTHORIZED') || is_user_logged_in() || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], $this->slug) !== false)) {
                return str_replace('wp-login.php', $this->slug, $url);
            }
        }
        return $url;
    }


    public function filter_redirects($location, $status) {
        if (strpos($location, 'wp-login.php') !== false) {
            if (defined('GACCESS_AUTHORIZED') || is_user_logged_in() || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], $this->slug) !== false)) {
                return str_replace('wp-login.php', $this->slug, $location);
            }
        }
        return $location;
    }


    /**
     * Special handling for logout to ensure it works correctly
     */
    public function filter_logout_url($logout_url, $redirect) {
        return str_replace('wp-login.php', $this->slug, $logout_url);
    }
}

// Initialize the security class
new GTheme_Security();

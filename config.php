<?php
/**
 * BT ParkShare Configuration
 *
 * Copy this file and adjust settings for your environment.
 * The SQLite database is stored in the data/ directory.
 */

// Site settings
define('SITE_NAME', 'BT ParkShare');
define('SITE_URL', 'https://btparkshare.com'); // Change to your domain
define('TIMEZONE', 'America/Los_Angeles');

// Database (SQLite file path — kept outside web root ideally, but .htaccess protects it)
define('DB_PATH', __DIR__ . '/data/parkshare.db');

// Email settings (uses PHP mail() by default; configure SMTP on Plesk if needed)
define('MAIL_FROM', 'noreply@btparkshare.com');
define('MAIL_FROM_NAME', 'BT ParkShare');
define('ADMIN_EMAIL', 'admin@btparkshare.com');

// Session
define('SESSION_LIFETIME', 86400); // 24 hours

// Cron security token — set this to a random string and use it in your cron URL
define('CRON_TOKEN', 'CHANGE_ME_TO_RANDOM_STRING');

date_default_timezone_set(TIMEZONE);

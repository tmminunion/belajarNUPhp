<?php

define('BASE_DIR', $_ENV['BASE_DIR']);

// Database MySQL koneksi
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_NAME', $_ENV['DB_NAME']);

// Auth System
define('AUTH', filter_var($_ENV['AUTH'], FILTER_VALIDATE_BOOLEAN));

// Email System SMTP
define('SMTP_HOST', $_ENV['SMTP_HOST']);
define('EMAIL_NAMA', $_ENV['EMAIL_NAMA']);
define('EMAIL_ADR', $_ENV['EMAIL_ADR']);
define('EMAIL_PASS', $_ENV['EMAIL_PASS']);

// Version
define('APP_VERSION', $_ENV['APP_VERSION']);
define('NUPHP', $_ENV['NUPHP']);

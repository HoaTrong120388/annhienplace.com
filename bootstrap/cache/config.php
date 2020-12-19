<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://lug.tuanxuong.com/',
    'timezone' => 'Asia/Ho_Chi_Minh',
    'locale' => 'vi',
    'languages' => 
    array (
      0 => 'vi',
      1 => 'en',
    ),
    'fallback_locale' => 'vi',
    'key' => 'base64:1haAWZgysjarN5RTuNOEkLclegezE3PqrC30ti/ZeT0=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'App\\Providers\\HelperServiceProvider',
      27 => 'App\\Providers\\ComposerServiceProvider',
      28 => 'Barryvdh\\DomPDF\\ServiceProvider',
      29 => 'Intervention\\Image\\ImageServiceProvider',
      30 => 'Jenssegers\\Agent\\AgentServiceProvider',
      31 => 'RenatoMarinho\\LaravelPageSpeed\\ServiceProvider',
      32 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Str' => 'Illuminate\\Support\\Str',
      'Carbon' => 'Carbon\\Carbon',
      'FCommon' => 'App\\Helpers\\FCommon',
      'LogActivity' => 'App\\Helpers\\LogActivity',
      'Minify' => 'App\\Helpers\\Minify',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
    ),
    'debug_blacklist' => 
    array (
      '_COOKIE' => 
      array (
        0 => 'XSRF-TOKEN',
        1 => 'laravel_session',
      ),
      '_SERVER' => 
      array (
        0 => 'REDIRECT_HTTPS',
        1 => 'REDIRECT_SSL_TLS_SNI',
        2 => 'REDIRECT_STATUS',
        3 => 'HTTPS',
        4 => 'SSL_TLS_SNI',
        5 => 'HTTP_HOST',
        6 => 'HTTP_CONNECTION',
        7 => 'HTTP_SEC_CH_UA',
        8 => 'HTTP_SEC_CH_UA_MOBILE',
        9 => 'HTTP_DNT',
        10 => 'HTTP_UPGRADE_INSECURE_REQUESTS',
        11 => 'HTTP_USER_AGENT',
        12 => 'HTTP_ACCEPT',
        13 => 'HTTP_SEC_FETCH_SITE',
        14 => 'HTTP_SEC_FETCH_MODE',
        15 => 'HTTP_SEC_FETCH_USER',
        16 => 'HTTP_SEC_FETCH_DEST',
        17 => 'HTTP_ACCEPT_ENCODING',
        18 => 'HTTP_ACCEPT_LANGUAGE',
        19 => 'HTTP_COOKIE',
        20 => 'PATH',
        21 => 'SERVER_SIGNATURE',
        22 => 'SERVER_SOFTWARE',
        23 => 'SERVER_NAME',
        24 => 'SERVER_ADDR',
        25 => 'SERVER_PORT',
        26 => 'REMOTE_ADDR',
        27 => 'DOCUMENT_ROOT',
        28 => 'REQUEST_SCHEME',
        29 => 'CONTEXT_PREFIX',
        30 => 'CONTEXT_DOCUMENT_ROOT',
        31 => 'SERVER_ADMIN',
        32 => 'SCRIPT_FILENAME',
        33 => 'REMOTE_PORT',
        34 => 'REDIRECT_URL',
        35 => 'GATEWAY_INTERFACE',
        36 => 'SERVER_PROTOCOL',
        37 => 'REQUEST_METHOD',
        38 => 'QUERY_STRING',
        39 => 'REQUEST_URI',
        40 => 'SCRIPT_NAME',
        41 => 'PHP_SELF',
        42 => 'REQUEST_TIME_FLOAT',
        43 => 'REQUEST_TIME',
        44 => 'SHELL_VERBOSITY',
        45 => 'APP_ENV',
        46 => 'APP_KEY',
        47 => 'APP_DEBUG',
        48 => 'APP_LOG_LEVEL',
        49 => 'APP_URL',
        50 => 'DB_CONNECTION',
        51 => 'DB_HOST',
        52 => 'DB_PORT',
        53 => 'DB_DATABASE',
        54 => 'DB_USERNAME',
        55 => 'DB_PASSWORD',
        56 => 'BROADCAST_DRIVER',
        57 => 'CACHE_DRIVER',
        58 => 'SESSION_DRIVER',
        59 => 'QUEUE_DRIVER',
        60 => 'REDIS_HOST',
        61 => 'REDIS_PASSWORD',
        62 => 'REDIS_PORT',
        63 => 'MAIL_DRIVER',
        64 => 'MAIL_HOST',
        65 => 'MAIL_PORT',
        66 => 'MAIL_USERNAME',
        67 => 'MAIL_PASSWORD',
        68 => 'MAIL_ENCRYPTION',
        69 => 'PUSHER_KEY',
        70 => 'PUSHER_SECRET',
        71 => 'PUSHER_APP_ID',
      ),
      '_ENV' => 
      array (
        0 => 'SHELL_VERBOSITY',
        1 => 'APP_ENV',
        2 => 'APP_KEY',
        3 => 'APP_DEBUG',
        4 => 'APP_LOG_LEVEL',
        5 => 'APP_URL',
        6 => 'DB_CONNECTION',
        7 => 'DB_HOST',
        8 => 'DB_PORT',
        9 => 'DB_DATABASE',
        10 => 'DB_USERNAME',
        11 => 'DB_PASSWORD',
        12 => 'BROADCAST_DRIVER',
        13 => 'CACHE_DRIVER',
        14 => 'SESSION_DRIVER',
        15 => 'QUEUE_DRIVER',
        16 => 'REDIS_HOST',
        17 => 'REDIS_PASSWORD',
        18 => 'REDIS_PORT',
        19 => 'MAIL_DRIVER',
        20 => 'MAIL_HOST',
        21 => 'MAIL_PORT',
        22 => 'MAIL_USERNAME',
        23 => 'MAIL_PASSWORD',
        24 => 'MAIL_ENCRYPTION',
        25 => 'PUSHER_KEY',
        26 => 'PUSHER_SECRET',
        27 => 'PUSHER_APP_ID',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => '',
        'options' => 
        array (
          'cluster' => NULL,
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/Users/hoakaka/code/annhienplace.com/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'constants' => 
  array (
    'domain' => 'https://',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'duhoc',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'duhoc',
        'username' => 'root',
        'password' => 'admin1234',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'mysql2' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'duhoc',
        'username' => 'root',
        'password' => 'admin1234',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'duhoc',
        'username' => 'root',
        'password' => 'admin1234',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'duhoc',
        'username' => 'root',
        'password' => 'admin1234',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/var/tmp/',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/Users/hoakaka/code/annhienplace.com/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/Users/hoakaka/code/annhienplace.com/storage/app/public',
        'visibility' => 'public',
      ),
      'upload' => 
      array (
        'driver' => 'local',
        'root' => '/Users/hoakaka/code/annhienplace.com/storage/app/upload',
        'visibility' => 'upload',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'your-key',
        'secret' => 'your-secret',
        'region' => 'your-region',
        'bucket' => 'your-bucket',
      ),
    ),
  ),
  'laravel-page-speed' => 
  array (
    'enable' => true,
    'skip' => 
    array (
      0 => '*.xml',
      1 => '*.less',
      2 => '*.pdf',
      3 => '*.doc',
      4 => '*.txt',
      5 => '*.ico',
      6 => '*.rss',
      7 => '*.zip',
      8 => '*.mp3',
      9 => '*.rar',
      10 => '*.exe',
      11 => '*.wmv',
      12 => '*.doc',
      13 => '*.avi',
      14 => '*.ppt',
      15 => '*.mpg',
      16 => '*.mpeg',
      17 => '*.tif',
      18 => '*.wav',
      19 => '*.mov',
      20 => '*.psd',
      21 => '*.ai',
      22 => '*.xls',
      23 => '*.mp4',
      24 => '*.m4a',
      25 => '*.swf',
      26 => '*.dat',
      27 => '*.dmg',
      28 => '*.iso',
      29 => '*.flv',
      30 => '*.m4v',
      31 => '*.torrent',
      32 => 'wlm-admin/*',
    ),
    'php' => 
    array (
      'enable' => true,
      'skip' => 
      array (
        0 => '*.xml',
        1 => '*.less',
        2 => '*.pdf',
        3 => '*.doc',
        4 => '*.txt',
        5 => '*.ico',
        6 => '*.rss',
        7 => '*.zip',
        8 => '*.mp3',
        9 => '*.rar',
        10 => '*.exe',
        11 => '*.wmv',
        12 => '*.doc',
        13 => '*.avi',
        14 => '*.ppt',
        15 => '*.mpg',
        16 => '*.mpeg',
        17 => '*.tif',
        18 => '*.wav',
        19 => '*.mov',
        20 => '*.psd',
        21 => '*.ai',
        22 => '*.xls',
        23 => '*.mp4',
        24 => '*.m4a',
        25 => '*.swf',
        26 => '*.dat',
        27 => '*.dmg',
        28 => '*.iso',
        29 => '*.flv',
        30 => '*.m4v',
        31 => '*.torrent',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => 'ttrong12388@gmail.com',
    'password' => 'khongco',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/Users/hoakaka/code/annhienplace.com/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/Users/hoakaka/code/annhienplace.com/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/Users/hoakaka/code/annhienplace.com/resources/views',
    ),
    'compiled' => '/Users/hoakaka/code/annhienplace.com/storage/framework/views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/Users/hoakaka/code/annhienplace.com/storage/fonts/',
      'font_cache' => '/Users/hoakaka/code/annhienplace.com/storage/fonts/',
      'temp_dir' => '/var/tmp/',
      'chroot' => '/Users/hoakaka/code/annhienplace.com',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);

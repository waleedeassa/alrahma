<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

  'default' => env('FILESYSTEM_DISK', 'local'),

  /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

  'disks' => [

    'local' => [
      'driver' => 'local',
      'root' => storage_path('app'),
      'throw' => false,
    ],

    'backup' => [
      'driver' => 'local',
      'root' => storage_path('app/backups'),
      'throw' => false,
    ],

    'public' => [
      'driver' => 'local',
      'root' => storage_path('app/public'),
      'url' => env('APP_URL') . '/storage',
      'visibility' => 'public',
      'throw' => false,
    ],

    's3' => [
      'driver' => 's3',
      'key' => env('AWS_ACCESS_KEY_ID'),
      'secret' => env('AWS_SECRET_ACCESS_KEY'),
      'region' => env('AWS_DEFAULT_REGION'),
      'bucket' => env('AWS_BUCKET'),
      'url' => env('AWS_URL'),
      'endpoint' => env('AWS_ENDPOINT'),
      'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
      'throw' => false,
    ],

    'uploads' => [
      'driver' => 'local',
      'root' => public_path('uploads'),
      'url' => env('APP_URL') . '/uploads',
      'visibility' => 'public',
      'throw' => false,
      'permissions' => [
        'file' => [
          'public' => 0644,
          'private' => 0600,
        ],
        'dir' => [
          'public' => 0755,
          'private' => 0700,
        ],
      ],
    ],

    // 'google' => [
    //   'driver' => 'google',
    //   'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
    //   'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
    //   'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
    //   'folder' => env('GOOGLE_DRIVE_FOLDER'), 
    //   // 'folderId' => env('GOOGLE_DRIVE_BACKUP_FOLDER_ID'), 
    //   //'teamDriveId' => env('GOOGLE_DRIVE_TEAM_DRIVE_ID'),
    //   //'sharedFolderId' => env('GOOGLE_DRIVE_SHARED_FOLDER_ID'),
    //   //  'options' => [
    //   //       'verify' => false, // Bypass SSL verification
    //   //    ],
    // ]


    // 'google' => [
    //   'driver' => 'google',
    //   'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
    //   'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
    //   'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
    //   'folder' => env('GOOGLE_DRIVE_FOLDER'), 
    // ]

        // القرص الأول: للنسخ الاحتياطي
        'google_backups' => [
          'driver' => 'google',
          'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
          'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
          'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
          'folder' => env('GOOGLE_DRIVE_BACKUP_FOLDER_NAME'), // يشير إلى مجلد 'ProjectBackups'
      ],
  
      // القرص الثاني: للمرفقات
      'google_attachments' => [
          'driver' => 'google',
          'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
          'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
          'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
          'folder' => env('GOOGLE_DRIVE_ATTACHMENTS_FOLDER_NAME'), // يشير إلى مجلد 'ProjectAttachments'
      ],

  ],

  /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

  'links' => [
    public_path('storage') => storage_path('app/public'),
  ],

];

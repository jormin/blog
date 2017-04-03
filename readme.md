个人博客项目，实现简单的文章管理功能，文章采用 `markdown` 格式，在线访问：[悟禅小书童](https://blog.lerzen.com)

## 安装

clone 代码后，需要修改 `.env.php` 文件，完善相关配置：

### 邮件（Sentry 服务使用到了）

```php
MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### 七牛（当前只用于文章图片上传和数据库备份）

```php
QINIU_ACCESS_KEY=null
QINIU_SECRET_KEY=null
QINIU_BUCKET=null
QINIU_DOMAIN=null
```

### 微信（当前只用到了微信分享）

```php
WECHAT_APPID=null
WECHAT_SECRET=null
WECHAT_TOKEN=null
WECHAT_OAUTH_SCOPES=null
```

### Sentry（异常上报统计服务）

`Sentry` 使用的是自己搭的服务，搭建方法详见 [源码搭建教程](https://laravel-china.org/articles/4295/centos6-install-python-based-on-sentry)

```php
SENTRY_DSN=null
```

> 如果不想使用 `Sentry` ，可以在 `composer.json` 移除扩展包依赖 `"sentry/sentry-laravel": "^0.6.1"`。

### 备份

博客默认使用了 `laravel-backup` 来备份数据库，备份驱动包含 `local` 和 `qiniu` , 详见 `app/Console/Kernel.php` 和 `config/laravel-backup.php`

#### 备份脚本

```php
...
$schedule->command('backup:clean')->daily()->at('00:30');
$schedule->command('backup:run --only-db')->daily()->at('01:00');
...
```

#### 备份配置

```php
...
'destination' => [
    /*
     * The filename prefix used for the backup zip file.
     */
    'filename_prefix' => 'blog_backup_',

    /*
     * The disk names on which the backups will be stored.
     */
    'disks' => [
        'local',
        'qiniu',
    ],
],
...
```

需要自行在系统中增加计划任务
 
```shell
* * * * * vagrant /usr/bin/php /path/to/project/artisan schedule:run >> /dev/null 2>&1
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

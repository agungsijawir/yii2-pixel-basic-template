<p align="center">
    <h1 align="center">
        <a href="https://github.com/yiisoft/yii2" target="_blank">Yii 2 Basic Template</a> feat. <a href="https://wrapbootstrap.com/?ref=agungsijawir" target="_blank">PixelAdmin</a>
    </h1>
    <br>
</p>

Basic Template adalah kerangka proyek aplikasi berbasis [Yii 2](http://www.yiiframework.com/) untuk percepatan pembuatan
aplikasi skala kecil.

Template pada repository ini sudah termasuk template dari PixelAdmin, dan beberapa fungsi dasar, seperti: login, logout,
lupa password, halaman kontak. Repositori proyek juga sudah termasuk konfigurasi dasar agar aplikasi dapat bekerja 
sebagai mana mestinya.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
         extras/          contains extra application configurations, i.e: default value for application, RBAC Config, etc.
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

PERSIAPAN
---------

Sebelum memulai instalasi, Anda diwajibkan membuat sebuah basis-data (database).
Contohnya, basis-data yang hendak dibuat bernama `basic_template`.

Dalam MySQL, perintah yang digunakan adalah sebagai berikut:

```SQL
CREATE DATABASE `basic_template` COLLATE 'utf8mb4_general_ci';
```

Setelah selesai membuat basis-data, catat hal-hal berikut yang nantinya digunakan untuk mengakses basis-data:
 * `username`
 * `password`
 * `mysql host`
 * `mysql port` 

INSTALASI
----------

### Clone Repo `git clone`

Proses intalasi dengan `git clone` sangat mudah, yaitu dengan menjalankan perintah:

```bash
git clone https://gitlab.com/agungandika/yii2-pixeladmin-themes.git basic-template
```

Perintah di atas akan mengkloning repository ke dalam folder `basic-template`.

### UBAH `db.php`

Buka file `config/db.php`, dan sesuaikan dengan konfigurasi database yang telah dibuat sebelumnya. 


**NOTES:**
- Yii tidak membuat database secara otomatis, Anda harus melakukannya manual.
- Cek dan edit file lainnya pada folder `config/` untuk kostumasi aplikasi sesuai kebutuhan.
- Rujuk file README pada folder `tests` untuk informasi spesifik terkait testing aplikasi.

### UBAH `web.php`

Atur kunci validasi cookie pada file `config/web.php` dengan karakter string acak:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

### Install `dependency packages`
Jalankan `composer` untuk instalasi `dependency packages` dan hal-hal dasar lainnya.

```bash
composer update -vvvv
```

### Inisialisasi Database
Setelah melakukan instalasi `dependency packages`, langkah selanjutnya adalah melakukan inisialisasi aplikasi.
Hal ini ditujukan untuk `import` setelan aplikasi dan data-data awal ke dalam database yang sudah diatur pada file
`config/db.php`.

Jalankan perintah berikut dalam `console`:

```bash
$ php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
$ php yii migrate --interactive=0
$ php yii init-rbac/install
```

### Jalankan Aplikasi
Sekarang, Anda sudah dapat mengakses aplikasi melalui URL berikut, asumsi `basic-tempalte` adalah direktori yang berada
di dalam Web root.

~~~
http://localhost/basic-template/web/
~~~

 
TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2_basic_tests` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.


### PENGAKUAN / ACKNOWLEDGEMENT

 * [Notifications Icon](https://www.flaticon.com/packs/notifications-6) made by [Freepik](https://www.flaticon.com/authors/freepik) from [FlatIcon](https://www.flaticon.com/)
 * [Management Icon](https://www.flaticon.com/packs/management-2) made by [Freepik](https://www.flaticon.com/authors/freepik) from [FlatIcon](https://www.flaticon.com/)
 * [Teamwork Icon](https://www.flaticon.com/packs/teamwork-46) made by [Freepik](https://www.flaticon.com/authors/freepik) from [FlatIcon](https://www.flaticon.com/)
 * [Business and Office](https://www.flaticon.com/packs/business-and-office) made by [Freepik](https://www.flaticon.com/authors/freepik) from [FlatIcon](https://www.flaticon.com/)
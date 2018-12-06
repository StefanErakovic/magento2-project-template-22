<?php

namespace Deployer;

require 'magento/vendor/jalogut/magento2-deployer-plus/recipe/magento_2_2_5.php';

// Use timestamp for release name
set('release_name', function () {
    return date('YmdHis');
});

// Magento dir into the project root. Set "." if magento is installed on project root
set('magento_dir', 'magento');
// [Optional] Git repository. Only needed if not using build + artifact strategy
set('repository', '');
// Space separated list of languages for static-content:deploy
set('languages', 'en_US');

// OPcache configuration
task('cache:clear:opcache', 'sudo systemctl reload php-fpm');
after('cache:clear', 'cache:clear:opcache');

// Build host
localhost('build');

// Remote Servers
localhost('master')
    ->set('deploy_path', '~')
    ->stage('prod');

// ---- Multi-server Configuration ----
// Tasks available only for specific roles
// task('config:import')->onRoles('master');
// task('database:upgrade')->onRoles('master');
// task('crontab:update')->onRoles('master');
//
//host('prod_slave_1')
//    ->hostname('<hostname>')
//    ->user('<user>')
//    ->set('deploy_path', '~')
//    ->stage('prod')
//    ->roles('slave');
//
//host('prod_slave_2')
//    ->hostname('<hostname>')
//    ->user('<user>')
//    ->set('deploy_path', '~')
//    ->stage('prod')
//    ->roles('slave');

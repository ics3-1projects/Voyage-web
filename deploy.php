<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Voyage-web');

// Project repository
set('repository', 'git@github.com:ics3-1projects/Voyage-web.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('188.166.89.126')
    ->user('deployer')
    ->set('deploy_path', '/var/www/voyage.com/html/Voyage-web');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

desc('Install passport');
task('artisan:passport:install', function () {
    run('{{bin/php}} {{release_path}}/artisan passport:install');
});

desc('Install voyager admin');
task('artisan:voyager:install', function () {
    run('{{bin/php}} {{release_path}}/artisan voyager:install --force');
});

// install npm and build
task('npm:install', function () {
    run('npm install');
    run('npm run production');
});

// Migrate database before symlink new release.

before('deploy:symlink', [
    'artisan:migrate',
    'artisan:passport:install',
    'artisan:voyager:install',
    'npm:install'
]);

<?php

namespace Deployer;

require __DIR__.'/contao.php';
require __DIR__.'/contao-rsync.php';

set('keep_releases', 10);

add('exclude', [
    '.DS_Store',
    '/.githooks',
    '/backups',
    '/themes/*/assets',
    '/package.json',
    '/package-lock.json',
    '/yarn.lock',
    '/.php-version',
    '/.php-cs-fixer.dist.php',
    '/tailwind-preset.js',
    '/node_modules',
]);

task('encore:compile', function () {
    runLocally('yarn run prod');
});

before('deploy', 'encore:compile');

after('deploy:failed', 'deploy:unlock');

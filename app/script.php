<?php

require 'vendor/autoload.php';

use Predis\Client;

$redis = new Client('tcp://redis:6379');

$lockAcquired = $redis->exists('script_lock');

if ($lockAcquired) {
    echo "\nСкрипт уже запущен\n";

    $time = $redis->ttl('script_lock');
    echo "Повторный запуск возможен через: " . $time . " секунд\n";

    exit;
} else {
    echo "Выполнение скрипта\n";
    $redis->set('mykey', 'Hello Redis!');
    $value = $redis->get('mykey');
    echo $value . "\n";

    $redis->set('script_lock', 'locked');
    $redis->expire('script_lock', 5);

    $time = $redis->ttl('script_lock');
    echo "Блокировка истечет через: " . $time . " секунд\n";

    echo "Выполнение скрипта завершено.\n";
}

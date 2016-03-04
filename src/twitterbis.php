<?php

require __DIR__.'/../vendor/autoload.php';

$ioHandler = new TwitterBis\IO\StandardIOHandler();
$messageList = new TwitterBis\DataStructure\InMemoryMessageList(new \TwitterBis\DataStructure\InMemoryReversedSortedList());
$userList = new TwitterBis\DataStructure\InMemoryUserSet();

$app = new TwitterBis\Application\Application($ioHandler, $userList, $messageList);
$app->run();
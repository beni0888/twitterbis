<?php

require __DIR__.'/../vendor/autoload.php';

$ioHandler = new TwitterBis\IO\StandardIOHandler();
$messageList = new TwitterBis\DataStructure\InMemoryMessageList(new \TwitterBis\DataStructure\InMemoryReversedSortedList());
$userList = new TwitterBis\DataStructure\InMemoryUserSet();
$commandParser = new TwitterBis\Application\Command\Parser($ioHandler, $userList, $messageList);

$app = new TwitterBis\Application\Application($ioHandler, $userList, $messageList, $commandParser);
$app->run();
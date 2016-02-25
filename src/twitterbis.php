<?php

require __DIR__.'/../vendor/autoload.php';

$ioHandler = new TwitterBis\IO\StandardIOHandler();
$messageList = new \TwitterBis\DataStructure\InMemoryMessageList(new \TwitterBis\DataStructure\InMemoryReversedSortedList());
$userList = new \TwitterBis\DataStructure\InMemoryUserSet();
$commandParser = new \TwitterBis\Application\Command\Parser($ioHandler, $userList, $messageList);

$app = new \TwitterBis\Application\Application($ioHandler, $userList, $messageList);
$app->loadUsers();

while (\TwitterBis\Application\Application::EXIT_COMMAND !== ($userInput = $app->readCommand())) {
    try {
        $command = $commandParser->parse($userInput);
        $command->run();
    } catch (\Exception $e) {
        $ioHandler->writeLine(sprintf('ERROR: %s', $e->getMessage()));
    }
}

$ioHandler->writeLine('BYE!');




$ioHandler->writeLine('');
$ioHandler->writeLine('Users:');

foreach ($userList as $k => $v) {
//    $ioHandler->writeLine(sprintf('%s => %s', $k, $v));
    var_dump($v->getFollowedUsers());
}

$ioHandler->writeLine('Messages:');

foreach ($messageList as $item) {
    $ioHandler->writeLine($item);
}
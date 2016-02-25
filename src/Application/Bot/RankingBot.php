<?php

namespace TwitterBis\Application\Bot;


use TwitterBis\Entity\UserRanking;

class RankingBot extends AbstractBot
{
    const NAME = 'ranking';

    /**
     * Return the command name.
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * Run the bot.
     * @return string
     */
    public function run()
    {
        $ranking = new UserRanking($this->users, $this->messages);
        $i = 0;
        foreach ($ranking->getRanking() as $userName => $messageCount) {
            $this->printRankingLine(++$i, $userName, $messageCount, $userName === $this->user->getName());
        }
    }

    /**
     * Write a ranking line properly formatted.
     * @param int $position
     * @param string $name
     * @param int $messageNumber
     * @param bool $isCurrentUser
     */
    private function printRankingLine($position, $name, $messageNumber, $isCurrentUser)
    {
        $this->ioHandler->writeLine(sprintf('%d. %s (%d) %s', $position, $name, $messageNumber, ($isCurrentUser ? '<-' : '')));
    }
}
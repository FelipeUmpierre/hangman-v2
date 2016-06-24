<?php

namespace Hangman\Controller;

use Hangman\Service\Game\Game;
use Hangman\Service\Config\Config;
use Hangman\Service\Game\GameStatus;
use Hangman\Service\Word\Word;
use Hangman\Model\Game as GameModel;

abstract class Controller
{
    /**
     * @var Word
     */
    protected $words;

    /**
     * @return Word
     */
    protected function word()
    {
        if ($this->words == null) {
            $this->words = new Word(
                Config::getConfig('words_file')
            );
        }

        return $this->words;
    }

    /**
     * @param GameModel $game
     * @return GameStatus
     */
    protected function buildStatus(GameModel $game)
    {
        return new GameStatus($game);
    }

    /**
     * @return Game
     */
    protected function buildGame()
    {
        return new Game($this->word());
    }

    protected function buildGameModel()
    {
        
    }
}
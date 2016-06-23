<?php

namespace Hangman\Service\Game;

use Hangman\Helper\GameStatusHelper;
use Hangman\Model\Game as GameModel;

class GameStatus
{
    use GameStatusHelper;

    protected $game;

    public function __construct(GameModel $game)
    {
        $this->game = $game;
    }

    /**
     * Check if the player was hanged
     *
     * @return bool
     */
    private function hanged()
    {
        return 0 == $this->getGame()->getGameStatus()->getTriesLeft();
    }

    /**
     * Check if the player has won
     *
     * @return bool
     */
    private function won()
    {
        $missing = 0;

        foreach ($this->getGame()->getWord()->getGuessingDottedWord() as $index => $word) {
            if ($word == '.') {
                $missing++;
            }
        }

        return 0 == $missing;
    }

    /**
     * Validate the game status
     *
     * @return bool
     */
    private function ended()
    {
        if ($this->won()) {
            $this->getGame()->getGameStatus()->setStatus(Game::WON);
        } else if ($this->hanged()) {
            $this->getGame()->getGameStatus()->setStatus(Game::HANGED);
        } else {
            return false;
        }

        return true;
    }

    /**
     * Check the character
     *
     * @param string $character
     * @return bool
     */
    public function checkCharacter($character)
    {
        // check if the game already ended
        if ($this->ended()) {
            return false;
        }

        $this->check($character);

        // check again, after check the character
        $this->ended();
    }

    /**
     * @return GameModel
     */
    public function getGame()
    {
        return $this->game;
    }

    public function toArray()
    {
        return $this->getGame()->toArray();
    }
}

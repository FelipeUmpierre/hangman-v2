<?php

namespace Hangman\Helper;

use Hangman\Model\Game;

trait GameStatusHelper
{
    /**
     * Function to check the character in a word
     *
     * @param string $character
     * @return $this
     */
    private function check($character)
    {
        $this->getGame()->getWord()->setLettersTried($character);
        $this->getGame()->getGameStatus()->addTried();
        $this->searchForLetter($character);

        return $this;
    }

    /**
     * Generate the dotted string for the word
     *
     * @param Game $game
     * @return Game
     */
    public static function generateDots(Game $game)
    {
        $guessing = [];

        foreach (str_split($game->getWord()->getWord()) as $index => $letter) {
            $guessing[$index] = '.';
        }

        $game->getWord()->setGuessingDottedWord($guessing);

        return $game;
    }

    /**
     * Look through the word and search for the character
     *
     * @param string $character
     * @return Game
     */
    private function searchForLetter($character)
    {
        $wordModel = $this->getGame()->getWord();

        foreach (str_split($wordModel->getWord()) as $index => $letter) {
            if ($letter == $character) {
                $this->getGame()->getWord()->setLettersFound($character);
                $this->getGame()->getWord()->setGuessedLetter($index, $letter);
            }
        }

        return $this;
    }
}

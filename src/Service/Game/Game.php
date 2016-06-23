<?php

namespace Hangman\Service\Game;

use Hangman\Helper\SessionHelper;
use Hangman\Service\Word\Word;
use Hangman\Service\Config\Config;
use Hangman\Model\Game as GameModel;
use Hangman\Model\Word as WordModel;

class Game
{
    use SessionHelper;

    const WON = 'won';
    const HANGED = 'hanged';
    const PLAYING = 'playing';

    /**
     * @var GameModel
     */
    protected $game;

    /**
     * @var int
     */
    protected $attempts;

    /**
     * @var Word
     */
    protected $word;

    /**
     * @param Word $word
     * @param GameModel $game
     */
    public function __construct(Word $word, GameModel $game = null)
    {
        $this->game = $game ?: new GameModel();
        $this->word = $word;
        $this->attempts = Config::getConfig('attempts');
    }

    /**
     * Generate a new word
     *
     * @return GameModel
     */
    public function newGame()
    {
        $this->addNewWord();

        GameStatus::generateDots($this->game);

        $this->save($this->game);

        return $this->game;
    }

    /**
     * @param GameModel $game
     */
    public function save(GameModel $game)
    {
        $this->setSession($game->getWord()->getId(), $game);
    }

    /**
     * @param int $id
     * @return GameModel
     */
    public function load($id)
    {
        $this->game = $this->getSession($id);

        return $this->game;
    }

    /**
     * Rand new word and generate the WordModel
     */
    protected function addNewWord()
    {
        $id = $this->word->randKey();

        $this->game->setWord(
            new WordModel(
                $id,
                $this->word->getByKey($id)
            )
        );
    }
}

<?php

namespace Hangman\Model;

use Illuminate\Contracts\Support\Arrayable;

class Game implements Arrayable
{
    /**
     * @var GameStatus
     */
    protected $gameStatus;

    /**
     * @var Word
     */
    protected $word;

    /**
     * @param Word $word
     * @param GameStatus $gameStatus
     */
    public function __construct(
        Word $word = null,
        GameStatus $gameStatus = null
    ) {
        $this->gameStatus = $gameStatus ?: new GameStatus();
        $this->word = $word ?: new Word();
    }

    /**
     * @return GameStatus
     */
    public function getGameStatus()
    {
        return $this->gameStatus;
    }

    /**
     * @param GameStatus $gameStatus
     */
    public function setGameStatus($gameStatus)
    {
        $this->gameStatus = $gameStatus;
    }

    /**
     * @return Word
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param Word $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getWord()->getId(),
            'status' => $this->getGameStatus()->toArray(),
            'word' => $this->getWord()->toArray(),
        ];
    }
}
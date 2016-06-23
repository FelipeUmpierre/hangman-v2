<?php

namespace Hangman\Model;

use Hangman\Service\Config\Config;
use Hangman\Service\Game\Game as GameService;
use Illuminate\Contracts\Support\Arrayable;

class GameStatus implements Arrayable
{
    /**
     * @var int
     */
    protected $totalTries;

    /**
     * @var int
     */
    protected $triesLeft;

    /**
     * @var int
     */
    protected $totalTriesAllowed;

    /**
     * @var string
     */
    protected $status;

    public function __construct(
        $totalTries = 0,
        $triesLeft = null,
        $status = GameService::PLAYING
    ) {
        $this->totalTries = $totalTries;
        $this->triesLeft = $triesLeft ?: Config::getConfig('attempts');
        $this->totalTriesAllowed = Config::getConfig('attempts');
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getTotalTries()
    {
        return $this->totalTries;
    }

    public function addTried()
    {
        $this->totalTries++;
        $this->triesLeft--;
    }

    /**
     * @return int
     */
    public function getTriesLeft()
    {
        return $this->triesLeft;
    }

    /**
     * @return int
     */
    public function getTotalTriesAllowed()
    {
        return $this->totalTriesAllowed;
    }

    /**
     * @param int $totalTriesAllowed
     */
    public function setTotalTriesAllowed($totalTriesAllowed)
    {
        $this->totalTriesAllowed = $totalTriesAllowed;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'tries' => $this->getTotalTries(),
            'tries_left' => $this->getTriesLeft(),
            'total_tries_allowed' => $this->getTotalTriesAllowed(),
            'status' => $this->getStatus(),
        ];
    }
}
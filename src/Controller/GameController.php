<?php

namespace Hangman\Controller;

use Hangman\Helper\SessionHelper;
use Hangman\Model\Game as GameModel;

class GameController extends Controller
{
    use SessionHelper;

    /**
     * Create a new game
     *
     * @return array
     */
    public function index()
    {
        $game = $this->buildGame()->newGame();

        return $this->returnResponse($game);
    }

    /**
     * @param int $id
     * @return array
     */
    public function load($id)
    {
        $game = $this->buildGame()->load($id);

        return $this->returnResponse($game);
    }

    /**
     * @param int $id
     * @param string $char
     * @return array
     */
    public function guess($id, $char)
    {
        $game = $this->buildGame()->load($id);

        $this->buildStatus($game)->checkCharacter($char);

        return $this->returnResponse($game);
    }

    /**
     * @param GameModel $game
     * @return array
     * @internal param int $id
     */
    public function returnResponse(GameModel $game)
    {
        return $this->buildStatus($game)->toArray();
    }
}

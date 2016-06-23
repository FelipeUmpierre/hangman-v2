<?php

namespace Hangman\Model;

use Illuminate\Contracts\Support\Arrayable;

class Word implements Arrayable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $lettersFound;

    /**
     * @var array
     */
    protected $lettersTried;

    /**
     * @var array
     */
    protected $guessingDottedWord;

    /**
     * @var string
     */
    protected $word;

    /**
     * @var string
     */
    protected $totalLetters;

    /**
     * @param $id
     * @param null $word
     * @param array $lettersFound
     * @param array $lettersTried
     * @param array $guessingDottedWord
     */
    public function __construct(
        $id = null,
        $word = null,
        array $lettersFound = [],
        array $lettersTried = [],
        array $guessingDottedWord = []
    ) {
        $this->id = $id;
        $this->word = $word;
        $this->lettersFound = $lettersFound;
        $this->lettersTried = $lettersTried;
        $this->guessingDottedWord = $guessingDottedWord;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /**
     * @return string
     */
    public function getTotalLetters()
    {
        return count($this->getGuessingDottedWord());
    }

    /**
     * @return array
     */
    public function getLettersFound()
    {
        return $this->lettersFound;
    }

    /**
     * @param string $lettersFound
     */
    public function setLettersFound($lettersFound)
    {
        if (!in_array($lettersFound, $this->lettersFound)) {
            $this->lettersFound[] = $lettersFound;
        }
    }

    /**
     * @return array
     */
    public function getLettersTried()
    {
        return $this->lettersTried;
    }

    /**
     * @param string $lettersTried
     */
    public function setLettersTried($lettersTried)
    {
        if (!in_array($lettersTried, $this->lettersTried)) {
            $this->lettersTried[] = $lettersTried;
        }
    }

    /**
     * @return array
     */
    public function getGuessingDottedWord()
    {
        return $this->guessingDottedWord;
    }

    /**
     * @param array $guessingDottedWord
     */
    public function setGuessingDottedWord($guessingDottedWord)
    {
        $this->guessingDottedWord = $guessingDottedWord;
    }

    /**
     * @param int $index
     * @param string $letter
     */
    public function setGuessedLetter($index, $letter)
    {
        if (array_key_exists($index, $this->getGuessingDottedWord())) {
            $this->guessingDottedWord[$index] = $letter;
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'letters_found' => $this->getLettersFound(),
            'letters_tried' => $this->getLettersTried(),
            'guessing_word' => $this->getGuessingDottedWord(),
            'word' => $this->__toString(),
            'total_letters' => $this->getTotalLetters(),
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode('', $this->getGuessingDottedWord());
    }
}
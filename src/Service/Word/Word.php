<?php

namespace Hangman\Service\Word;

use Hangman\Exception\InvalidFilePathException;

class Word
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var array
     */
    protected $words;

    /**
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Load the file and decode from json to array
     *
     * @return array
     * @throws InvalidFilePathException
     */
    public function load()
    {
        if ($this->words == null) {
            if (!is_file($this->file)) {
                throw new InvalidFilePathException('the file passed is invalid');
            }

            $this->words = json_decode(
                file_get_contents($this->file),
                true
            );
        }

        return $this->words;
    }

    /**
     * @param int $key
     * @return bool|string
     * @throws InvalidFilePathException
     */
    public function getByKey($key)
    {
        if (array_key_exists($key, $this->load())) {
            return $this->load()[$key];
        }

        return false;
    }

    /**
     * @return int
     * @throws InvalidFilePathException
     */
    public function randKey()
    {
        return array_rand($this->load(), 1);
    }

    /**
     * @return bool|string
     */
    public function generateNewRandWord()
    {
        return $this->getByKey($this->randKey());
    }
}

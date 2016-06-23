<?php

namespace Hangman\Helper;

use Hangman\Service\Config\Config;
use Symfony\Component\HttpFoundation\Session\Session;

trait SessionHelper
{
    /**
     * @var Session
     */
    protected $session;

    private function loadSession()
    {
        if ($this->session == null) {
            $this->session = new Session();
        }

        if ($this->session->getId() == null) {
            $this->session->start();
        }
    }

    /**
     * Create a new session with the name and value passed
     *
     * @param string $name
     * @param string|object|array $value
     */
    public function setSession($name, $value)
    {
        $this->loadSession();

        $this->session->set(
            $this->buildSessionKey($name),
            $value
        );
    }

    /**
     * Return a session by the name
     *
     * @param string $name
     * @return mixed
     */
    public function getSession($name)
    {
        $this->loadSession();

        return $this->session->get(
            $this->buildSessionKey($name)
        );
    }

    /**
     * Verify if the session exists
     *
     * @param string $name
     * @return bool
     */
    public function hasSession($name)
    {
        $this->loadSession();

        return $this->session->has(
            $this->buildSessionKey($name)
        );
    }

    /**
     * Remove a session item and return the value of the session
     * before it is removed.
     *
     * @param $name
     * @return mixed
     */
    public function removeSession($name)
    {
        $this->loadSession();

        $currentSession = $this->getSession($name);

        $this->session->remove($name);

        return $currentSession ?: null;
    }

    /**
     * Build the prefix with the name, for the session
     *
     * @param string $name
     * @return string
     */
    private function buildSessionKey($name)
    {
        return Config::getConfig('session_prefix') . $name;
    }
}
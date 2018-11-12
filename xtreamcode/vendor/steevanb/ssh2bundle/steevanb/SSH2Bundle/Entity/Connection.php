<?php

namespace steevanb\SSH2Bundle\Entity;

use steevanb\SSH2Bundle\Exception\ConnectionException;

/**
 * SSH2 connection
 */
class Connection
{
    const STATE_NOT_ESTABLISHED = 0;
    const STATE_INVALID_ADDRESS = 1;
    const STATE_INVALID_LOGIN = 2;
    const STATE_CONNECTED = 3;
    /**
     * @var Resource
     */
    protected $connection;

    /**
     * @var int
     */
    protected $state = self::STATE_NOT_ESTABLISHED;

    /**
     * @var Profile
     */
    protected $profile;

    /**
     * Constructor
     *
     * @param Profile $profile
     * @param bool $autoConnect
     */
    public function __construct(Profile $profile, $autoConnect = true)
    {
        $this->profile = $profile;
        if ($autoConnect) {
            $this->assertConnect();
        }
    }

    /**
     * Do the connection
     *
     * @return bool
     */
    public function connect()
    {
        $return = false;
        $profile = $this->getProfile();
        $this->connection = @ssh2_connect($profile->getAddress(), $profile->getPort());
        if ($this->connection === false) {
            $this->state = self::STATE_INVALID_ADDRESS;
        } else {
            $auth = @ssh2_auth_password($this->connection, $profile->getLogin(), $profile->getPassword());
            if ($auth === false) {
                $this->state = self::STATE_INVALID_LOGIN;
            } else {
                $this->state = self::STATE_CONNECTED;
                $return = true;
            }
        }

        return $return;
    }

    /**
     * Do the connection, and assert it
     */
    public function assertConnect()
    {
        $this->connect();
        $this->assertConnected();
    }

    /**
     * Assert connection is established
     *
     * @throws ConnectionException
     */
    public function assertConnected()
    {
        if ($this->getState() != self::STATE_CONNECTED) {
            switch ($this->getState()) {
                case self::STATE_INVALID_ADDRESS :
                    $message = 'invalid address';
                    break;
                case self::STATE_INVALID_LOGIN :
                    $message = 'invalid login';
                    break;
                default :
                    $message = 'unknow error';
                    break;
            }
            //throw new ConnectionException('Connection error : ' . $message, $this->getProfile());
        }
    }

    /**
     * Return state
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Return connection profile
     *
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Execute a command
     *
     * @param string $command
     * @return string
     */
    public function exec($command)
    {
        $this->assertConnected();

        $stream = ssh2_exec($this->connection, $command);
        stream_set_blocking($stream, true);
        $streamOut = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
        return stream_get_contents($streamOut);
    }

    /**
     * Execute a command and explode the result
     *
     * @param string $command
     * @param string $separator
     * @return array
     */
    public function execExplode($command, $separator = ' ')
    {
        return explode($separator, $this->exec($command));
    }

    /**
     * Execute a command, explode the result, and return the $index part of the explode
     *
     * @param string $command
     * @param int $index Index of the part to return
     * @param string $separator Separator
     * @param mixed $default Default value if $index is not found
     * @return string
     */
    public function execExplodeIndex($command, $index, $separator = ' ', $default = null)
    {
        $parts = $this->execExplode($command, $separator);
        return (array_key_exists($index, $parts)) ? $parts[$index] : $default;
    }

    /**
     * Execute a command and return the result by line
     *
     * @param type $command
     * @return array
     */
    public function execLines($command)
    {
        $result = $this->exec($command);
        $result = str_replace("\r\n", "\n", $result);
        return explode("\n", $result);
    }

    /**
     * Execute a command and return the line $index
     *
     * @param string $command
     * @param int $index Index of the line to return
     * @param string $default Default value
     * @return string
     */
    public function execLine($command, $index = 0, $default = null)
    {
        $lines = $this->execLines($command);
        return (array_key_exists($index, $lines)) ? $lines[$index] : $default;
    }
}

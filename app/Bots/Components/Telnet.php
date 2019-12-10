<?php

namespace App\Bots\Components;

use Bestnetwork\Telnet\TelnetClient;
use Bestnetwork\Telnet\TelnetException;

class Telnet extends TelnetClient
{
    /**
     * @var bool
     */
    public $connected = false;

    /**
     * @var  string
     */
    public $last_output;

    /**
     * @var bool
     */
    public $logged_in = false;

    /**
     * @var bool
     */
    public $login_failed = false;

    /**
     * Constructor. Initialises host, port and timeout parameters
     * defaults to localhost port 23 (standard telnet port)
     *
     * @param string $host    Host name or IP address
     * @param int    $port    TCP port number
     * @param int    $timeout Connection timeout in seconds
     * @param string $prompt
     * @param string $err_prompt
     * @throws TelnetException
     */
    public function __construct( $host = '127.0.0.1', $port = 23, $timeout = 10, $prompt = '>', $err_prompt = 'ERROR' ){
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
        $this->prompt = $prompt;
        $this->err_prompt = $err_prompt;

        // set some telnet special characters
        $this->NULL = chr(0);
        $this->CR = chr(13);
        $this->DC1 = chr(17);
        $this->WILL = chr(251);
        $this->WONT = chr(252);
        $this->DO = chr(253);
        $this->DONT = chr(254);
        $this->IAC = chr(255);

        $this->connected = $this->connect();
    }

    /**
     * Attempts connection to remote host. Returns TRUE if successful.
     *
     * @return bool
     * @throws TelnetException
     */
    public function connect(){
        // check if we need to convert host to IP
        if( !preg_match('/([0-9]{1,3}\\.){3,3}[0-9]{1,3}/', $this->host) ){
            $ip = gethostbyname($this->host);

            if( $this->host == $ip ){
                throw new TelnetException('Cannot resolve ' . $this->host);
            }else{
                $this->host = $ip;
            }
        }

        // attempt connection
        $this->socket = @fsockopen($this->host, $this->port, $this->errno, $this->errstr, $this->timeout);

        return ($this->socket) ? true : false;
    }

    /**
     * Attempts login to remote host.
     * This method is a wrapper for lower level private methods and should be
     * modified to reflect telnet implementation details like login/password
     * and line prompts. Defaults to standard unix non-root prompts
     *
     * @param string $username Username
     * @param string $password Password
     * @throws TelnetException
     */
    public function login( $username, $password ){
        if ( ! $this->connected ) {
            return $this;
        }

        try{
            $this->setPrompt('Login:');
            $this->execute((string) $username, 'Password:');

            if ($this->sendPassword($password)) {
                return $this;
            }

            return $this;

        } catch( TelnetException $e ){

            \Log::info($e->getMessage());

            return false;
        }
    }

    /**
     * @return string '>' or '#' for Zhone
     */
    protected function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * Get us back to the default mode
     *
     * @return void
     */
    protected function refreshEnvironment()
    {
        if ($this->getPrompt() == '#')
        {
            $this->setPrompt('>');
            $this->execute('top');
        }
    }

    /**
     * Send the password to the ONT during authentication
     * @param  string $password
     * @return boolean
     */
    protected function sendPassword($password)
    {
        try {

            $this->last_output = $this->execute((string) $password, '>', 'Login:');

            $this->logged_in = true;
            $this->login_failed = false;

            $this->setPrompt('>');

            return true;
        } catch (TelnetException $e) {

            $this->logged_in = false;
            $this->login_failed = true;
            return false;
        }
    }
}

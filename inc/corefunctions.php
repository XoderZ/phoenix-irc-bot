<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************

//Checks
function begins_with($haystack, $needle)
{
    return strpos($haystack, $needle) === 0;
}
if (!isset($nickname) || !isset($ident) || !isset($realname) || !isset($prefix) || !isset($ircserver) || !isset($port)) {
    die("Please check your inc/config.php\r\n");
}
if ($nickname == "" || $ident == "" || $realname == "" || $prefix == "" || $ircserver == "" || $port == "") {
    die("Please check your inc/config.php\r\n");
}
if (isset($nickserv) == true) {
    if ($nickserv == "") {
        unset($nickserv);
    }
}

//Core of the bot
class IRC
{

    //Core
	public function connect($socketserver, $serverport)
	{
		$this->connection = @fsockopen($socketserver, $serverport, $errno, $errstr, 2);
		echo $errstr;
	}
	public function getData()
	{
		$this->buffer = fgets($this->connection, 1024);
	}
	public function send($cmd)
	{
		@fwrite($this->connection, $cmd, strlen($cmd)); //sends the command to the server
		echo "[SEND] $cmd"; //displays it on the screen
	}

	//Commands core
	public function parseData($data, $cmd="")
	{
		preg_match("/^(?:[:](\S+) )?(\S+)(?: (?!:)(.+?))?(?: [:](.+))?$/", $data, $this->parsedData);
		$this->host = $this->parsedData[1];
		$this->rawCode = $this->parsedData[2];
		$this->channel = $this->parsedData[3];
		if (isset($cmd) && $cmd != "") {
			$this->cmd = $cmd;
			$explode = explode($cmd, $this->parsedData[4]);
			$this->args = $explode[1];
		}
	}
}
?>

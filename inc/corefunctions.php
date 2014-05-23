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
	public function parseData($data, $cmd)
	{
		preg_match("/^(?:[:](\S+) )?(\S+)(?: (?!:)(.+?))?(?: [:](.+))?$/", $data, $this->parsedData);
		$this->host = $this->parsedData[1];
		$this->channel = $this->parsedData[3];
		$this->cmd = $cmd;
		$explode = explode($cmd, $this->parsedData[4]);
		$this->args = $explode[1];
	}
	 
	 
	 //Modules Core
	function getNowPlaying($sc_url_ip,$sc_url_port)
	{
		// This script is provided free of charge
		// from http://streamfinder.com
		$open = fsockopen($sc_url_ip,$sc_url_port,$errno,$errstr,'.5'); 
		if ($open) { 
			fputs($open,"GET /7.html HTTP/1.1\nUser-Agent:Mozilla\n\n"); 
			stream_set_timeout($open,'1');
			$read = fread($open,200);
			$text = explode(",",$read);
			if($text[6] == '' || $text[6] == '</body></html>'){ $msg = ' live stream '; } else { $msg = $text[6]; }
			$text = 'Now Playing ('.$src.'): '.$msg; 
		} else {  return false; } 
		fclose($open);
		return $text;	
	}
}
?>

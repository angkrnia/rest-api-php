<?php
class ClientError extends Exception
{
	public function __construct($message = "bad request", $code = 400, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}

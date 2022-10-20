<?php
class NotFoundError extends ClientError
{
	public function __construct($message = "not found", $code = 404, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}

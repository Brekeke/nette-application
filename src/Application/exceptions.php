<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Application;

use Nette\Http;


/**
 * The exception that is thrown when user attempts to terminate the current presenter or application.
 * This is special "silent exception" with no error message or code.
 */
class AbortException extends \Exception
{
}


/**
 * Application fatal error.
 */
class ApplicationException extends \Exception
{
}


/**
 * The exception that is thrown when a presenter cannot be loaded.
 */
class InvalidPresenterException extends \Exception
{
}


/**
 * The exception that indicates client error with HTTP code 4xx.
 */
class BadRequestException extends \Exception
{
	/** @var int */
	protected $code = Http\IResponse::S404_NOT_FOUND;


	public function __construct(string $message = '', int $httpCode = 0, \Exception $previous = NULL)
	{
		parent::__construct($message, $httpCode ?: $this->code, $previous);
	}


	public function getHttpCode(): int
	{
		return $this->code;
	}

}


/**
 * Forbidden request exception - access denied.
 */
class ForbiddenRequestException extends BadRequestException
{
	/** @var int */
	protected $code = Http\IResponse::S403_FORBIDDEN;

}


/**
 * The exception that indicates request rejected by framework.
 */
class RejectRequestException extends UI\BadSignalException
{
	const NO_ROUTE = 1;
	const WRONG_PRESENTER = 2;
	const WRONG_SIGNAL = 3;
	const WRONG_ARGUMENT = 4;

	/** @var int */
	private $reason;

	public function __construct($message, $reason, \Exception $previous = NULL)
	{
		parent::__construct($message, Http\IResponse::S404_NOT_FOUND, $previous);
	}


	/**
	 * @return int
	 */
	public function getReason()
	{
		return $this->reason;
	}

}

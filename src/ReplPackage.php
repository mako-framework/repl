<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl;

use mako\application\Package;
use mako\repl\commands\Repl;

/**
 * Repl package.
 */
class ReplPackage extends Package
{
	/**
	 * {@inheritDoc}
	 */
	protected string $packageName = 'mako/repl';

	/**
	 * {@inheritDoc}
	 */
	protected array $commands = [
		'repl' => Repl::class,
	];
}

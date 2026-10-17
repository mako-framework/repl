<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl;

use mako\application\Package;
use mako\repl\commands\Repl;
use Override;

/**
 * Repl package.
 */
class ReplPackage extends Package
{
	/**
	 * {@inheritDoc}
	 */
	#[Override]
	protected string $packageName = 'mako/repl';

	/**
	 * {@inheritDoc}
	 */
	#[Override]
	protected array $commands = [
		'repl' => Repl::class,
	];
}

<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl;

use mako\application\Package;

/**
 * Repl package.
 */
class ReplPackage extends Package
{
	/**
	 * {@inheritDoc}
	 */
	protected $packageName = 'mako/repl';

	/**
	 * {@inheritDoc}
	 */
	protected $commands =
	[
		'repl' => mako\repl\commands\Repl::class,
	];
}

<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl;

use mako\application\Package;

/**
 * Repl package.
 *
 * @author  Frederic G. Østby
 */
class ReplPackage extends Package
{
	/**
	 * {@inheritdoc}
	 */
	protected $packageName = 'mako/repl';

	/**
	 * {@inheritdoc}
	 */
	protected $commands =
	[
		'repl' => 'mako\repl\commands\Repl',
	];
}

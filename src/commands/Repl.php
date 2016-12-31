<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl\commands;

use mako\database\midgard\ORM;
use mako\database\query\Result;
use mako\database\query\ResultSet;
use mako\reactor\Command;
use mako\repl\Caster;
use mako\syringe\ContainerAwareTrait;

use Psy\Configuration;
use Psy\Shell;

/**
 * Command that starts a interactive shell.
 *
 * @author Frederic G. Østby
 */
class Repl extends Command
{
	/**
	 * Make the command strict.
	 *
	 * @var bool
	 */
	protected $isStrict = true;

	/**
	 * Command information.
	 *
	 * @var array
	 */
	protected $commandInformation =
	[
		'description' => 'Starts a interactive shell.',
	];

	/**
	 * Displays a helping message.
	 *
	 * @access protected
	 */
	protected function displayHelp()
	{
		$message  = '----------------------------------------------';
		$message .= PHP_EOL;
		$message .= 'Type <yellow>help</yellow> to see a list of available commands.';
		$message .= PHP_EOL;
		$message .= '----------------------------------------------';

		$this->write($message);
	}

	/**
	 * Returns a container aware class.
	 *
	 * @access protected
	 * @return object
	 */
	protected function getMako()
	{
		$mako = new class
		{
			use ContainerAwareTrait;

			public function getContainer()
			{
				return $this->container;
			}
		};

		$mako->setContainer($this->container);

		return $mako;
	}

	/**
	 * Builds the shell configuration.
	 *
	 * @access protected
	 * @return \Psy\Configuration
	 */
	protected function buildConfiguration(): Configuration
	{
		$configuration = new Configuration;

		$configuration->addCasters(
		[
			ORM::class       => Caster::class . '::orm',
			Result::class    => Caster::class . '::result',
			ResultSet::class => Caster::class . '::resultSet',
		]);

		return $configuration;
	}

	/**
	 * Starts the interactive shell.
	 *
	 * @access protected
	 */
	protected function startShell()
	{
		$shell = new Shell($this->buildConfiguration());

		$shell->setScopeVariables(
		[
			'mako' => $this->getMako(),
		]);

		$shell->run();
	}

	/**
	 * Executes the command.
	 *
	 * @access public
	 */
	public function execute()
	{
		$this->displayHelp();

		$this->startShell();
	}
}

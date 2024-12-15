<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\repl\commands;

use mako\cli\output\components\Alert;
use mako\database\midgard\ORM;
use mako\database\query\Result;
use mako\database\query\ResultSet;
use mako\reactor\attributes\CommandDescription;
use mako\reactor\Command;
use mako\repl\Caster;
use mako\syringe\traits\ContainerAwareTrait;
use Psy\Configuration;
use Psy\Shell;

/**
 * Command that starts a interactive shell.
 */
#[CommandDescription('Starts a interactive shell.')]
class Repl extends Command
{
	/**
	 * Displays a helping message.
	 */
	protected function displayHelp(): void
	{
		$this->nl();
		$this->alert('Type <bg_white> help </bg_white> to see a list of available commands.', Alert::INFO);
		$this->nl();
	}

	/**
	 * Returns a container aware class.
	 */
	protected function getMako(): object
	{
		$mako = new class {
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
	 */
	protected function buildConfiguration(): Configuration
	{
		$configuration = new Configuration($this->config->get('mako-repl::configuration'));

		$configuration->addCasters([
			ORM::class       => Caster::class . '::orm',
			Result::class    => Caster::class . '::result',
			ResultSet::class => Caster::class . '::resultSet',
		]);

		return $configuration;
	}

	/**
	 * Starts the interactive shell.
	 */
	protected function startShell(): void
	{
		$shell = new Shell($this->buildConfiguration());

		$shell->setScopeVariables([
			'mako' => $this->getMako(),
		]);

		$shell->run();
	}

	/**
	 * Executes the command.
	 */
	public function execute(): void
	{
		$this->displayHelp();

		$this->startShell();
	}
}

<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

$console = new Application('Mailbox Task Runner', '1.0');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'prod'));
$console->setDispatcher($app['dispatcher']);
$console
    ->register('import-messages')
    ->setDescription('This command seed the database with some messages to work with.')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {

        $items = json_decode(file_get_contents($app['import.file.path']));
        if (!$items || !isset($items->messages)) {
            $output->writeln('<error>No items to import</error>');
            return;
        }

        $process = new Process($app['import.cmd']);
        $process->setInput(json_encode($items->messages));
        $process->run();

        if (!$process->isSuccessful()) {
            $exception = new ProcessFailedException($process);
            $output->writeln('<error>' . $exception->getMessage() . '</error>');
            return;
        }   
        
        $output->writeln($process->getOutput());
        $output->writeln('<info>Messages were imported successfully</info>');
    })
;

return $console;

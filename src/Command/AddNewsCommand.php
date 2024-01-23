<?php

namespace App\Command;

use App\Entity\NewsFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Uid\NilUuid;
use Symfony\Component\Uid\Uuid;

#[AsCommand(
    name: 'app:add-news',
    description: 'Add a short description for your command',
)]
class AddNewsCommand extends Command
{
    public function __construct(private EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::REQUIRED, 'New title')
            ->addArgument('text', InputArgument::REQUIRED, 'New description')
            ->addArgument('status', InputArgument::OPTIONAL, 'Status', 1)
            ->addArgument('createdBy', InputArgument::OPTIONAL, 'Created by', '44266dc6-18d0-46bd-a2b5-238de53db2cb')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $title = $input->getArgument('title');
        $text = $input->getArgument('text');
        $status = $input->getArgument('status');
        $createdBy = $input->getArgument('createdBy');

        if ($title) {
            $io->note(sprintf('You passed an argument: %s', $title));
        }

		if ($text) {
            $io->note(sprintf('You passed an argument: %s', $text));
        }

		if ($status) {
            $io->note(sprintf('You passed an argument: %s', $status));
        }

		if ($createdBy) {
			$uuid = Uuid::fromString($createdBy);
            $io->note(sprintf('You passed an argument: %s', $uuid));
        }
		else {
			$uuid = new NilUuid();
		}

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');


		$entity = NewsFactory::create(
			title: $title,
			text: $text,
			createdBy: $uuid
		);

		$this->manager->persist($entity);
		$this->manager->flush();
		$io->success('Post is saved: ' . $entity);

        return Command::SUCCESS;
    }
}

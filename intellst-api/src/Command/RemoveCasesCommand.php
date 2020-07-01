<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\IdentifiedCaseRepository;

class RemoveCasesCommand extends Command
{
    /** @var IdentifiedCaseRepository */
    private $identifiedCaseRepository;

    public function __construct(
        IdentifiedCaseRepository $identifiedCaseRepository
    )
    {
        $this->identifiedCaseRepository = $identifiedCaseRepository;
        parent::__construct();
    }

    protected static $defaultName = 'app:remove-cases';

    protected function configure()
    {
        $this
            ->setDescription('Remove cases')
            ->setHelp('This command allows you to delete all cases that are no longer needed...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->identifiedCaseRepository->removeCases();
        return Command:: SUCCESS;
    }
}

<?php
namespace App\Command;

use App\Service\ImportFokontanyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-fokontany')]
class ImportFokontanyCommand extends Command
{
    private  $importFokontanyService;
    public function __construct (
         ImportFokontanyService $importFokontanyService
    )
    {
        $this->importFokontanyService = $importFokontanyService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des Fokontany...');
        $this->importFokontanyService->importFokontany($io);

        return Command::SUCCESS;
        

    }
    
}

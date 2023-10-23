<?php
namespace App\Command;

use App\Service\ImportCommuneService;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-communes')]
class ImportCommunesCommand extends Command
{
    private  $importCommuneService;
    public function __construct (
         ImportCommuneService $importCommuneService,
    )
    {
        $this->importCommuneService = $importCommuneService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des Communes...');
        $this->importCommuneService->importCommune($io);
      
        return Command::SUCCESS;
        

    }
    
}

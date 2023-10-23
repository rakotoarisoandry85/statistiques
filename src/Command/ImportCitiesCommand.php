<?php
namespace App\Command;

use App\Service\ImportCitiesService;
use Symfony\Component\Console\Attribute\AsCommand;
//use Symfony\Component\Command\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-regions')]
class ImportCitiesCommand extends Command
{
    private  $importCitiesService;
    public function __construct (
         ImportCitiesService $importCitiesService,
    )
    {
        $this->importCitiesService = $importCitiesService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des régions...');
        $this->importCitiesService->importCities($io);
      
        return Command::SUCCESS;
        

    }
    
}

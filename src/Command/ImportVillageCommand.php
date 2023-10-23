<?php
namespace App\Command;

use App\Service\ImportVillageService;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-villages')]
class ImportVillageCommand extends Command
{
    private  $importVillageService;
    public function __construct (
         ImportVillageService $importVillageService,
    )
    {
        $this->importVillageService = $importVillageService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des Villages...');
        $this->importVillageService->importVillage($io);
      
        return Command::SUCCESS;
        

    }
    
}

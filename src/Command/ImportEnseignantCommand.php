<?php
namespace App\Command;

use App\Service\ImportEnseignantService;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-enseignants')]
class ImportEnseignantCommand extends Command
{
    private  $importEnseignantService;
    public function __construct (
         ImportEnseignantService $importEnseignantService,
    )
    {
        $this->importEnseignantService = $importEnseignantService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des Enseignants...');
        $this->importEnseignantService->importEnseignant($io);
      
        return Command::SUCCESS;       

    }
    
}

<?php
namespace App\Command;

use App\Service\ImportEtablissementService;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-etablissement')]
class ImportEtablissementCommand extends Command
{
    private  $importEtablissementService;
    public function __construct (
         ImportEtablissementService $importEtablissementService,
    )
    {
        $this->importEtablissementService = $importEtablissementService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des ETABLISSEMENTS...');
        $this->importEtablissementService->importEtablissement($io);
      
        return Command::SUCCESS;
        

    }
    
}

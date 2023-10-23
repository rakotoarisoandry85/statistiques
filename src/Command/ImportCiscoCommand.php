<?php
namespace App\Command;

use App\Service\ImportCiscoService;
use Symfony\Component\Console\Attribute\AsCommand;
//use Symfony\Component\Command\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-cisco')]
class ImportCiscoCommand extends Command
{
    private  $importCiscoService;
    public function __construct (
         ImportCiscoService $importCiscoService
    )
    {
        $this->importCiscoService = $importCiscoService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des Ciscos...');
        $this->importCiscoService->importCisco($io);

        return Command::SUCCESS;
        

    }
    
}

<?php
namespace App\Command;

use App\Service\ImportCommuneService;
use App\Service\ImportZapService;
use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name:'app:import-zap')]
class ImportZapCommand extends Command
{
    private  $importZapService;
    public function __construct (
         ImportZapService $importZapService,
    )
    {
        $this->importZapService = $importZapService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output):int
    {
        
        $io = new SymfonyStyle($input,$output);
      	$io->title('Importation des ZAP...');
        $this->importZapService->importZap($io);
      
        return Command::SUCCESS;
        

    }
    
}

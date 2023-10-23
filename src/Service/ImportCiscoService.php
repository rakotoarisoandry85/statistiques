<?php
namespace App\Service;

use App\Entity\Cisco;
use App\Entity\Dren;
use App\Repository\CiscoRepository;
use App\Repository\DrenRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportCiscoService
{
    public function __construct(
       private  CiscoRepository $repoCisco,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importCisco(SymfonyStyle $io)
    {
        //$io->title('Importation des cisco en fonction des régions (dren) !');

        $ciscos = $this->readCsvFile();
       // dd(count($ciscos));
        $io->progressStart(count($ciscos));
       // dd($ciscos);
        foreach($ciscos as $cisco){
            $io->progressAdvance();
      
         $ciscObjet =  $this->createOrUpdateCisco($cisco);
      
         $this->em->persist($ciscObjet);
        }
        $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation de tous les ciscos terminée!'); 
    }
    private function readCsvFile():Reader
    {
        //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Ciscos.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
    //echo $csv->toString();
        return $csv;
    }
    private function createOrUpdateCisco(array $arrayCisco):Cisco
    {
       //$dren = $this->repoCisco->findOneBy(['code_sisco' => $arrayCisco['code_sisco']]);

      // dd($arrayRegion['nom_dren']);
       $cisco = $this->repoCisco->findAll();
       if(!$cisco){
        $cisco = new Cisco();
       }
       $cisco->setCodeSisco($arrayCisco['code_sisco'])
              ->setNomCisco($arrayCisco['nom_cisco']);
	
       return $cisco;
    }
}

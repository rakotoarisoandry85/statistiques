<?php
namespace App\Service;

use App\Entity\Cisco;
use App\Entity\Dren;
use App\Repository\DrenRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportCitiesService
{
    public function __construct(
       private  DrenRepository $repoRegion,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importCities(SymfonyStyle $io)
    {
        //$io->title('Importation des régions!');

        $regions = $this->readCsvFile();

        $io->progressStart(count($regions));
        //dd($regions);
        foreach($regions as $region){
            $io->progressAdvance();
          
         $dren =  $this->createOrUpdateCity($region);
        
         $this->em->persist($dren);
        }
        $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Regions.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
    //  echo $csv->toString();
        return $csv;
    }
    private function createOrUpdateCity(array $arrayRegion):Dren
    {
       $dren = $this->repoRegion->findOneBy(['code_dren' => $arrayRegion['code_dren']]);
      // dd($arrayRegion['nom_dren']);
      // $dren = $this->repoRegion->findAll();
       if(!$dren){
        $dren = new Dren();
       }
       $dren->setCodeDren($arrayRegion['code_dren'])
            ->setNomDren($arrayRegion['nom_dren']);
	
       return $dren;
    }
}

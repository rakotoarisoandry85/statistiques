<?php
namespace App\Service;

use App\Entity\Village;

use App\Repository\VillageRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportVillageService
{
    public function __construct(
       private  VillageRepository $repoVillage,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importVillage(SymfonyStyle $io)
    {
        $io->title('Importation des Villages !');

        $villages = $this->readCsvFile();

        $io->progressStart(count($villages));
      
        foreach($villages as $village){
            $io->progressAdvance();
         $zapObject =  $this->createOrUpdateVillage($village);
        
         $this->em->persist($zapObject);
        }
        $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Village.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
    
    echo $csv->toString();
        return $csv;
    }
    private function createOrUpdateVillage(array $arrayVillage):Village
    {
       $village = $this->repoVillage->findOneBy(['nom_village' => $arrayVillage['nom_village']]);
     //  dd($arrayCommune['nom_commune']);
      // $dren = $this->repoRegion->findAll();
       if(!$village){
        $village = new Village();
       }
       $village->setNomVillage($arrayVillage['nom_village']);
               
	
       return $village;
    }
}

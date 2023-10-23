<?php
namespace App\Service;

use App\Entity\Communes;
use App\Repository\CommuneRepository;
use App\Repository\CommunesRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportCommuneService
{
    public function __construct(
       private  CommunesRepository $repoCommune,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importCommune(SymfonyStyle $io)
    {
        $io->title('Importation des Communes !');

        $communes = $this->readCsvFile();

        $io->progressStart(count($communes));
      
        foreach($communes as $commune){
            $io->progressAdvance();
           // dd($commune);
         $communeObject =  $this->createOrUpdateCity($commune);
        
         $this->em->persist($communeObject);
        }
        $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Communes.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
       // $csv->array_slice()
    echo $csv->toString();
        return $csv;
    }
  
    private function createOrUpdateCity(array $arrayCommune):Communes
    {
       $commune = $this->repoCommune->findOneBy(['code_commune' => $arrayCommune['code_commune']]);
      // dd($commune);
      // $dren = $this->repoRegion->findAll();
       if(!$commune){
        $commune = new Communes();
       }
       $commune->setCodeCommune($arrayCommune['code_commune'])
               ->setNomCommune($arrayCommune['nom_commune'])
               ->setCatCommune($arrayCommune['cat_commune']);
	
       return $commune;
    }
}

<?php
namespace App\Service;

use App\Entity\Fokontany;
use App\Entity\Zaps;
use App\Repository\FokontanyRepository;
use App\Repository\ZapsRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportFokontanyService
{
    public function __construct(
       private  FokontanyRepository $repoFokontany,
       private  ZapsRepository $repoZap,
       private EntityManagerInterface $em,
    )
    {
        
    }
   
    public function importFokontany(SymfonyStyle $io  )
    {
        $io->title('Importation des zap pour les Fokontany !');
        
        $fokontany = $this->readCsvFile();

        $io->progressStart(count($fokontany));
      
        foreach($fokontany as $foko)
        {
            $io->progressAdvance();

            $fokontanyObject =  $this->createOrUpdateFokotany($foko);
        
            $this->em->persist($fokontanyObject);
        }
        $this->em->flush();


       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Fokontany.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
       // $csv->array_slice()
   // echo $csv->toString();
        return $csv;
    }
    //fonction permettant de retourner un objet zap en fonction de array'code_zap' dans Fokontany
    private function loadZap( array $arrayFokontany):Zaps
    {
     //dd($arrayFokontany);
     
     
     //eto----> $Zap = $this-> repoZap->findOneBy(['fokoetab'=>$arrayFokontany['code_zap']]);
     $Zap = $this-> repoZap->findOneBy(['fokoetab'=>$arrayFokontany['code_zap']]);     
     return $Zap;   
    }
    //fonction permettant de charger les fokontany...
    
    private function createOrUpdateFokotany(array $arrayFokontany):Fokontany
    {
       $fokontany = $this->repoFokontany->findOneBy(['code_fokontany' => $arrayFokontany['code_fokontany']]);
       $fokontanyZapObject = $this->loadZap($arrayFokontany);

      
       if(!$fokontany){
        $fokontany = new Fokontany();
       }
      // dd($zapObject);
      $fokontany ->setCodeFokontany($arrayFokontany['code_fokontany'])
                 ->setNomFokontany($arrayFokontany['nom_fokontany'])
                 //changer en objet les variables 'code_zap' passé en parametre $arrayFokontany...
                 ->setZapfoko($fokontanyZapObject)
               ;
	
       return $fokontany; 
    }
 

}

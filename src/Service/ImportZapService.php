<?php
namespace App\Service;

use App\Entity\Communes;
use App\Entity\Zaps;
use App\Repository\CommunesRepository;
use App\Repository\ZapsRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportZapService
{
    public function __construct(
       private  ZapsRepository $repoZap,
       private  CommunesRepository $repoCommune,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importZap(SymfonyStyle $io)
    {
        $io->title('Importation des ZAP !');

        $zaps = $this->readCsvFile();

        $io->progressStart(count($zaps));
      
        foreach($zaps as $zap){
            $io->progressAdvance();
         $zapObject =  $this->createOrUpdateZap($zap);
        
        // $this->em->persist($zapObject);
        }
       // $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Zap.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
    
    echo $csv->toString();
        return $csv;
    }

      //fonction permettant de retourner un objet commune en fonction de array'code_commune' dans table Zaps
      private function loadCommune( array $arrayZap):Communes
      {
       // dd($arrayZap);
        $commune = $this->repoCommune->findOneBy(['code_commune'=>$arrayZap['code_commune']]);
        // dd($commune);          
         return $commune;   
      }

    private function createOrUpdateZap(array $arrayZap):Zaps
    {
        $zap = $this->repoZap->findOneBy(['code_zap' => $arrayZap['code_zap']]);
     
        $zapCommObject = $this->repoCommune->findOneBy(['code_commune'=>$arrayZap['code_commune']]);
       //dd($zapCommObject);
        if(!$zap)
        {
            $zap = new Zaps();
        }
       $zap->setCodeZap($arrayZap['code_zap'])
           ->setNomZap($arrayZap['nom_zap'])
           ->setZapcom($zapCommObject)
           ;	
       return $zap;
    }
}

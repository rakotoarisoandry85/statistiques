<?php
namespace App\Service;

use App\Entity\Etablissement;
use App\Entity\Fokontany;
use App\Repository\EtablissementRepository;
use App\Repository\FokontanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportEtablissementService
{
    public function __construct(
       private  EtablissementRepository $repoEtablissement,
       private  FokontanyRepository $repoFokontany,
       private EntityManagerInterface $em,
    )
    {
        
    }
    public function importEtablissement(SymfonyStyle $io)
    {
        $io->title('Importation des Etablissement !');

        $etablissements = $this->readCsvFile();

        $io->progressStart(count($etablissements));
      
        foreach($etablissements as $etablissement)
        {
            $io->progressAdvance();
         
         $etablissementObject =  $this->createOrUpdateFokotany($etablissement);
        
         $this->em->persist($etablissementObject);
        }
        $this->em->flush();
      //dd($etablissementObject);
       $io->progressFinish(); 

      $io->success('Importation terminée!'); 
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Etablissement.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
       // $csv->array_slice()
   // echo $csv->toString();
        return $csv;
    }

    //fonction permettant de retourner un objet zap en fonction de array'code_zap' dans Fokontany
    private function loadFokontany( array $arrayEtablissement):Fokontany
    {
    // dd($arrayEtablissement['foko_etab']);   
     //eto----> $Zap = $this-> repoZap->findOneBy(['fokoetab'=>$arrayFokontany['code_zap']]);
     $fokontany = $this->repoFokontany->findOneBy(['code_fokontany' => $arrayEtablissement['foko_etab']]);
  // dd($fokontany);    
     return $fokontany;   
    }

    private function createOrUpdateFokotany(array $arrayEtablissement):Etablissement
    {
       $etablissement = $this->repoEtablissement->findOneBy(['code_etab' => $arrayEtablissement['code_etab']]);
      // print_r($arrayEtablissement['foko_etab']);
    // echo  $arrayEtablissement['foko_etab'];
       if($arrayEtablissement['foko_etab']==''){
        $fokoObject = new Fokontany();
       }
      // $fokoObject = $this->repoFokontany->findOneBy(['foko_etab'=>$arrayEtablissement['foko_etab']]);
      $fokoObject = $this->loadFokontany($arrayEtablissement);
      // dd($fokoObject);
       //  $fokontany = $this->repoFokontany->findBy('');
     //  dd($arrayFokontany['nom_Fokontany']);
      // $dren = $this->repoRegion->findAll();
       if(!$etablissement){
        $etablissement = new Etablissement();
       }
      //$etablissement->setFokoetab($arrayEtablissement['fokoetab_id'])
      $etablissement
                    // ->setFokoetab($fokoObject)
                     ->setCodeEtab($arrayEtablissement['code_etab'])
                     ->setNomEtab($arrayEtablissement['nom_etab'])
                     ->setTelephone($arrayEtablissement['telephone'])
                     ->setNomProprio($arrayEtablissement['nom_proprio'])
                     ->setNomDirecteur($arrayEtablissement['nom_directeur'])
                     ->setCodeTypeAffiliation($arrayEtablissement['code_type_affiliation'])
                     ->setTypeAffiliation($arrayEtablissement['type_affiliation'])
                     ->setNIF($arrayEtablissement['nif'])
                     ->setFokoetab($fokoObject)
               ;
	
       return $etablissement;
    }
}

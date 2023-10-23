<?php
namespace App\Service;

use App\Entity\Enseignant;
use App\Entity\Etablissement;
use App\Entity\Fokontany;
use App\Repository\EnseignantRepository;
use App\Repository\EtablissementRepository;
use App\Repository\FokontanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Style\SymfonyStyle;
class ImportEnseignantService
{
    public function __construct(
       private  EnseignantRepository $repoEnseignant,
       private  FokontanyRepository $repoFokontany,
       private EtablissementRepository $repoEtablissment,
       private EntityManagerInterface $em,
       
    )
    {
        
    }
    public function importEnseignant(SymfonyStyle $io)
    {
          $io->title('Importation des Enseignants !');

          $enseignants = $this->readCsvFile();

          $io->progressStart(count($enseignants));
       // $i=0;
        foreach($enseignants as $enseignant){
         
         // if($i != 10){
          $io->progressAdvance();

         /* $date = strtotime($enseignant['date_naiss']);
          $newformatDate['date_naiss'] = date('Y-m-d',$date);*/
         // dd($newformatDate);
         //dd($enseignant['sexe']);
          $enseignantObject =  $this->createOrUpdateEnseignant($enseignant); //updateSexeEnseignant

          $this->em->persist($enseignantObject);
          //$i++;
      //  }  
      }
      
        $this->em->flush();

       $io->progressFinish(); 

      $io->success('Importation terminée!');
      
    }
    private function readCsvFile():Reader
    {
         //*.csv separateur de ";" ...
        $csv = Reader::createFromPath('%kernel.root_dir%/../import/Enseignant.csv','r');
        $csv->setHeaderOffset(0);
      	$csv->setDelimiter(';');
       // $csv->array_slice()
   // echo $csv->toString();
        return $csv;
    }
    private function createOrUpdateEnseignant(array $arrayEnseignant):Enseignant
    {
       $enseignant = $this->repoEnseignant->findOneBy(['cin' => $arrayEnseignant['cin']]);
     //  dd($arrayFokontany['nom_Fokontany']);
      // $dren = $this->repoRegion->findAll();
      if($arrayEnseignant['code_fokontany'] ==''){
        $fokoObject = new Fokontany();
       }

      $fokoObject = $this->loadFokontany($arrayEnseignant);

      if($arrayEnseignant['code_etablissement'] ==''){
        $etabObject = new Etablissement();
       }

      $etabObject = $this->loadEtablissement($arrayEnseignant);

       if(!$enseignant){
        $enseignant = new Enseignant();
       }

    /*   $arrayDate['date_naiss'] = strtotime($arrayEnseignant['date_naiss']);
       $newformatDate['date_naiss'] = date('Y-m-d',$arrayDate['date_naiss']);

       $arrayDate[] = strtotime($arrayEnseignant['agent_etat_admin']);
       $newformatDate[''] = date('Y-m-d',$arrayDate[]);
     */
   // $date_naiss['date_naiss'] =  strtotime($arrayEnseignant['date_naiss']);
    //$agent_etat_admin = strtotime($arrayEnseignant['agent_etat_admin']);

   // $format_date_naiss['date_naiss'] = date('Y-m-d',$date_naiss);
   // $format_agent_etat_admin = date('Y-m-d',$agent_etat_admin);
   //$newformatDate['date_naiss'] = date('Y-m-d',$arrayEnseignant['date_naiss']);
   
       $enseignant->setCin($arrayEnseignant['cin'])
                  ->setPassport($arrayEnseignant['passeport'])
                  ->setNomPrenoms($arrayEnseignant['nom_prenoms'])
                  ->setDateNaissance($arrayEnseignant['date_naiss'])
                 // ->setDateNaissance($newformatDate['date_naiss'])
                 // ->setCodeDistrictNaiss($arrayEnseignant['code_district_naiss'])
                  ->setSexe($arrayEnseignant['sexe'])
                  ->setCodeFonction($arrayEnseignant['code_fonction'])
                  ->setCodeStatut($arrayEnseignant['code_statut'])
                  ->setStatut($arrayEnseignant['statut'])
                  ->setAgentEtatAdmin($arrayEnseignant['agent_etat_admin'])
                  ->setFokoEnseignant($fokoObject)
                  ->setEtabenseignant($etabObject)
                  ;
              
	
       return $enseignant;
    }

 //fonction permettant de retourner un objet zap en fonction de array'code_zap' dans Fokontany
 private function loadFokontany( array $arrayEnseignant):Fokontany
 { 
    $fokontany = $this->repoFokontany->findOneBy(['code_fokontany' => $arrayEnseignant['code_fokontany']]);

    return $fokontany;   
 }
 //fonction permettant de retourner un objet zap en fonction de array'code_zap' dans Fokontany
 private function loadEtablissement( array $arrayEnseignant):Etablissement
 { 
    $etablissement = $this->repoEtablissment->findOneBy(['code_etab' => $arrayEnseignant['code_etablissement']]);

    return $etablissement;   
 }
}

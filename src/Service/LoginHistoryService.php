<?php 

namespace App\Service;

use App\Entity\LoginHistory;
use App\Entity\User;
use DeviceDetector\DeviceDetector;
use Doctrine\ORM\EntityManagerInterface;


/**
 * 
 * Class de gestion de l'historique de connexion des utilisateurs
 */
class LoginHistoryService
{

    // fonction constructeur pour injecter l'EntityManager
    // readonly : le service ne peut pas modifier l'EntityManager
    public function __construct(readonly private EntityManagerInterface $em) {}




    // fonction ajouter l'historique
    public function addHistory(User $user, string $userAgent, string $ip){

        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();

            $loginHistory = new LoginHistory();
            $loginHistory
                ->setUser($user)
                ->setIpAddress($ip)
                ->setDevice($deviceDetector->getDeviceName())
                ->setOs($deviceDetector->getOs()['name'])
                ->setBrowser($deviceDetector->getClient()['name'])
                ;
                
            $this->em->persist($loginHistory);
            $this->em->flush();

    }

}

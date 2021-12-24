<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return $this->render('home/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function a(ServiceRepository $serviceRepository)
    {
        return $this->render('home/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }
    /**
     * @Route("/mesSer", name="mesSer")
     */
    public function mesSer(ServiceRepository $serviceRepository)
    {
        return $this->render('home/mespublication.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new/{id}", name="vente_path")
     */
    public function newpath(Service $service): Response
    {
        $vente = new Vente();
        $vente->setService($service);
        $vente->setClient($this->getUser());
                
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vente);
            $entityManager->flush();

            return $this->redirectToRoute('mesSer');
        

        
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function indx()
    {
        return $this->redirectToRoute('service_index');
    }
}

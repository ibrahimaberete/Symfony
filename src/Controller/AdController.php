<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Repository\AdRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        //$repo = $this->getDoctrine() ->getRepository(Ad::class);
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
           'ads' => $ads
        ]);
    }




     /**
     * Permet de crée une annonce
     *
     * @Route("ads/new", name_="ads_create")
     * 
     * @return Response
     */
    public function create( Request $_request, EntityManagerInterface $manager){
        $ad = new Ad();
       

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($_request);


        if($form->isSubmitted() && $form->isValid()){
           // $manager = $this->getDoctrine()->getManager();

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()} <strong> a bien été enrefistrée ! "
            );
           

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
                
            ]);
            
        }


        return $this->render('ad/new.html.twig',[
            'form' => $form->createView()
        ]);
    }




    /**
     * Permet d'afficher une seule annonece 
     *
     * @Route("/ads/{slug}", name="ads_show")
     * @return Response
     */
    public function show(Ad $ad){

        //je recuper l'annonce qui correspond au slug !
        //$ad = $repo->findOneBySlug($slug);
        return $this->render('ad/show.html.twig',[
            'ad' => $ad
        ] );
    }
  
}

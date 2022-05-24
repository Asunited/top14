<?php

namespace App\Controller;

use App\Repository\EquipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use App\Form\ChoiceType;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function main(EquipRepository $equipRepository): Response
    {
        // $equipChoice = $this->createForm(ChoiceType::class);

        return $this->render('main/index.html.twig', [
            'equips' => $equipRepository->findAll(),
            // 'equipChoice' => $equipChoice->createView(),
        ]);
    }
}

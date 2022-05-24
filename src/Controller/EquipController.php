<?php

namespace App\Controller;

use App\Entity\Equip;
use App\Form\EquipType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equip')]
class EquipController extends AbstractController
{
    #[Route('/', name: 'app_equip_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $equips = $entityManager
            ->getRepository(Equip::class)
            ->findAll();

        return $this->render('equip/index.html.twig', [
            'equips' => $equips,
        ]);
    }

    #[Route('/new', name: 'app_equip_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equip = new Equip();
        $form = $this->createForm(EquipType::class, $equip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equip);
            $entityManager->flush();

            return $this->redirectToRoute('app_equip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equip/new.html.twig', [
            'equip' => $equip,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equip_show', methods: ['GET'])]
    public function show(Equip $equip): Response
    {
        return $this->render('equip/show.html.twig', [
            'equip' => $equip,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equip_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equip $equip, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipType::class, $equip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equip/edit.html.twig', [
            'equip' => $equip,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equip_delete', methods: ['POST'])]
    public function delete(Request $request, Equip $equip, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equip->getId(), $request->request->get('_token'))) {
            $entityManager->remove($equip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_equip_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employee;
use App\Form\EmployeeType;

class EmployeeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $employee = new Employee();        

        $form = $this->createForm(EmployeeType::class, $employee);

        $entryManager = $doctrine->getManager();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $employee = $form->getData();

             

            

            $entryManager->Persist($employee);
            $entryManager->flush();

            $this->redirectToRoute('homepage');
        }
        else if($form->isSubmitted() && !$form->isValid())
        {
            $this->addFlash(
                'warning',
                'One or more of the employee details was invalid!'
            );

            $this->redirectToRoute('homepage');
        }

        $repository = $doctrine->getRepository(Employee::class);

        $employees = $repository->findAll();


        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
            'form' => $form,
            'employees' => $employees

        ]);
    }
}

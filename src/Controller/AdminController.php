<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/create-employee", name="admin_create_employee")
     */
    public function createEmployee(Request $request) : Response
    {
        $employee = new Employee();

        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash('success', 'employee.created_successfully');

            return $this->redirectToRoute('team');
        }

        return $this->render('admin/create_employee.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }
}

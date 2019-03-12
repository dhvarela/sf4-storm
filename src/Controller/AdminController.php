<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Project;
use App\Entity\WorkContract;
use App\Form\EmployeeType;
use App\Form\ProjectType;
use App\Form\WorkContractType;
use App\Repository\EmployeeRepository;
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
    public function createEmployee(Request $request): Response
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

        return $this->render('admin/create_edit_employee.html.twig', [
            'employee' => $employee,
            'form'     => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/create-work-contract", name="admin_create_work_contract")
     */
    public function createWorkContract(Request $request): Response
    {
        $workContract = new WorkContract();

        $form = $this->createForm(WorkContractType::class, $workContract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($workContract);
            $em->flush();

            $this->addFlash('success', 'work_contract.created_successfully');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/create_work_contract.html.twig', [
            'workContract' => $workContract,
            'form'         => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/create-project", name="admin_create_project")
     */
    public function createProject(Request $request): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'project.created_successfully');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/create_project.html.twig', [
            'project' => $project,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/list-employees", name="admin_list_employees")
     * @param EmployeeRepository $employeeRepository
     * @return Response
     */
    public function listEmployees(EmployeeRepository $employeeRepository): Response
    {
        $employees = $employeeRepository->findAll();

        return $this->render('admin/list_employees.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/admin/edit-employee/{id}", name="admin_edit_employee")
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function editEmployee(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            $this->addFlash('success', 'employee.updated_successfully');

            return $this->redirectToRoute('admin_list_employees');
        }

        return $this->render('admin/create_edit_employee.html.twig', [
            'employee' => $employee,
            'form'     => $form->createView(),
            'editing'  => true
        ]);
    }

}

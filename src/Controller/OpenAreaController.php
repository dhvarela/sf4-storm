<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Events;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenAreaController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('open_area/home.html.twig', [
            'controller_name' => 'OpenAreaController',
        ]);
    }

    /**
     * @Route("/team", name="team")
     *
     * @param EmployeeRepository $employeeRepository
     *
     * @return Response
     */
    public function team(EmployeeRepository $employeeRepository)
    {
        $employees = $employeeRepository->findAll();

        return $this->render('open_area/team.html.twig', [
            'employees' => $employees
        ]);
    }

    /**
     * @Route("/team/{id}", methods={"GET"}, name="team_detail")
     *
     * @param Employee $employee
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     */
    public function teamDetail(Employee $employee, EventDispatcherInterface $eventDispatcher)
    {
        $event = new GenericEvent($employee);

        $eventDispatcher->dispatch(Events::PROFILE_SEEN, $event);

        return $this->render('open_area/team_detail.html.twig', [
            'employee' => $employee
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('open_area/contact.html.twig', [
            'controller_name' => 'OpenAreaController',
        ]);
    }

    /**
     * @Route({
     *     "es": "/sobre-nosotros",
     *     "en": "/about-us"
     * }, name="about_us")
     */
    public function about()
    {
        return $this->render('open_area/about.html.twig', [
            'controller_name' => 'OpenAreaController',
        ]);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EmployeesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getEmployeesData() as [$fullname, $email, $incorporation]) {
            $employee = new Employee();
            $employee
                ->setName($fullname)
                ->setEmail($email)
                ->setIncorporationDate($incorporation);

            $manager->persist($employee);
        }
        $manager->flush();
    }

    private function getEmployeesData(): array
    {
        return [
            // $userData = [$fullname, $email, $incorporation];
            ['Cristian Parra', 'cristian.parra@symfony.com', new \DateTime('2017-10-18')],
            ['Sergio Llac', 'sergio.llac@symfony.com', new \DateTime('2018-07-11')],
            ['Nuria Rodríguez', 'nuria.rodriguez@symfony.com', new \DateTime('2011-01-02')],
        ];
    }
}
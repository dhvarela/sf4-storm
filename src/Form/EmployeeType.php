<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Project;
use App\Entity\WorkContract;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // For the full reference of options defined by each form field type
        // see https://symfony.com/doc/current/reference/forms/types.html
        // By default, form fields include the 'required' attribute, which enables
        // the client-side form validation. This means that you can't test the
        // server-side validation errors from the browser. To temporarily disable
        // this validation, set the 'required' attribute to 'false':
        // $builder->add('title', null, ['required' => false, ...]);
        $builder
            ->add('name', TextType::class, [
                'attr'  => ['autofocus' => true],
                'label' => 'label.name',
            ])
            ->add('email', TextType::class, [
                'label' => 'label.email',
            ])
            ->add('incorporationDate', DateTimeType::class, [
                'label' => 'label.incorporationDate',
                'help'  => 'help.incorporationDate',
            ])
            ->add('workContract', EntityType::class, [
                'class'         => WorkContract::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('wc')
                        ->orderBy('wc.name', 'ASC');
                },
            ])
            ->add('projects', EntityType::class, [
                'class'         => Project::class,
                'query_builder' => function (ProjectRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.title', 'ASC');
                },
                'multiple'      => true
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
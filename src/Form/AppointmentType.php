<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Session;
use App\Entity\Location;
use App\Entity\Practitioner;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\PractitionerRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AppointmentType extends AbstractType
{
    private $om;

    public function __construct(ObjectManager $objectManager)
    {
        $this->om = $objectManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reason', TextType::class, [
                'attr' => [
                    'placeholder' => 'Motif de la consultation'
                ]
            ])

            ->add('session', EntityType::class,[
                'class' => Session::class,
                'choice_label' => 'type',
            ])

            ->add('location', EntityType::class,[
                'class' => Location::class,
                'choice_label' => 'city',
            ])

            ->add('practitioner', EntityType::class,[
                'class' => Practitioner::class,
                'em' =>
                'choice_label' => 'id',
            ])
            

            ->add('save', SubmitType::class, [
                'label' => 'Valider mon rendez-vous'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}

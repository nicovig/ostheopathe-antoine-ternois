<?php


namespace App\Form;

use App\Entity\Patient;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sex', ChoiceType::class,[
                'choices' => $this->getSexChoices()
            ])
            ->add('birthday', DateTimeType::class, [
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'
                ],

            ])
            ->add('address')
            ->add('city')
            ->add('postalcode')
            ->add('profession')
            ->add('athlete', ChoiceType::class,[
                'choices' => $this->getAthleteChoices()
            ])
            ->add('user', UserType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
            'translation_domain' => 'patientForm'
        ]);
    }

    private function getSexChoices(){

        $sexChoices = Patient::SEX;
        $output = [];

        foreach ($sexChoices as $k => $v){
            //k KEY v VALUE
            $output[$v] = $k;
        }

        return $output;
    }

    private function getAthleteChoices(){

        $athleteChoices = Patient::ATHLETE;
        $output = [];

        foreach ($athleteChoices as $k => $v){
            //k KEY v VALUE
            $output[$v] = $k;
        }

        return $output;
    }


}
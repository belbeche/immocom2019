<?php

namespace App\Form;

use App\Entity\Search;
use App\Entity\Annonce;
use App\Entity\OptionAnnonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SearchType extends AbstractType
{

    const PRICE = ['1000','2000','10000','20000'];
    const SURFACE = ['10','50','100','200','300','400'];
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location', CheckboxType::class, [ 
                'required' => false,
                'attr' => [
                    'class' => 'form-group'
                ],
            ])
            ->add('Achat', CheckboxType::class, [ 
                'required' => false,
                'attr' => [
                    'class' => 'form-group'
                ],
            ])
            ->add('minSurface')
            ->add('maxPrice')
            ->add('annonces', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => OptionAnnonce::class,
                'choice_label' => 'name',
                'multiple' => true
             ])
             ->add('Rechercher', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\OptionAnnonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('chauffage', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('optionAnnonces', EntityType::class, [
                'class' => OptionAnnonce::class,
                'choice_label' => 'name',
                'multiple' => true,
                'placeholder' => 'Choose an option',
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Ajout image',
            ])
            ->add('ville')
            ->add('adresse')
            ->add('code_postale')
            ->add('sold')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getChoices()
    {
        $choices = Annonce::CHAUFFAGE;
        $output= [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}

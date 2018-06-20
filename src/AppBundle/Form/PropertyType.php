<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('city', TextType::class)
            ->add('locality', TextType::class)
            ->add('state', TextType::class)
            ->add('country', TextType::class)
            ->add('status', TextType::class)
            ->add('status', ChoiceType::class, array(
                'choices'  => [
                    'Active' => 'active',
                    'Inactive' => 'inactive'
                ]
            ))
            ->add('save', SubmitType::class, array(
                'label' => $options['data']->getId() > 0 ? 'Update Property' : 'Add Property'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Property'
        ));
    }

    // public function getBlockPrefix()
    // {
    //     return '';
    // }
}

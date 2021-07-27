<?php

namespace Alloservice\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class JoberType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,array('attr'=>array('maxlength'=>60,'autocomplete'=>'off', 'required'=>'required', 'placeholder'=>'Nom')))
        ->add('lastname',TextType::class,array('attr'=>array('maxlength'=>60,'autocomplete'=>'off', 'required'=>'required', 'placeholder'=>'Prénom')))
        ->add('city',EntityType::class,[
                    'label'=>'Ville',
                    'placeholder' => '- Ville -',
                    'class'=>'AlloserviceSiteBundle:City',
                    'query_builder' => function (EntityRepository $er) {
                        return $er  ->createQueryBuilder('e')
                                    ->orderBy('e.name', 'ASC');
                    },
                    'choice_label' => function($entity) {
                        return '('.$entity->getCp().') '. $entity->getName();
                    },
                    'multiple'=>false,
                    'expanded'=>false,
                    'required'=>true,
                ])
        ->add('email',EmailType::class,array('attr'=>array('maxlength'=>60,'autocomplete'=>'off', 'required'=>'required', 'placeholder'=>'E-mail')))
        ->add('plainPassword',RepeatedType::class,array(
                  'type' => PasswordType::class,
                  'invalid_message' => 'Les deux mots de passe ne sont pas identiques!',
                  'options'=>array('attr'=>array('maxlength'=>20)),
                  'required'=>true,
                  'first_options'=>array('attr'=>array('placeholder'=>'Mot de passe')),
                  'second_options'=>array('attr'=>array('placeholder'=>'Confirmer ici le mot de passe')),
                  )
             )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alloservice\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'alloservice_userbundle_user';
    }


}

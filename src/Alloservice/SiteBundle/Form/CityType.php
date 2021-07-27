<?php

namespace Alloservice\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,[
                    'label' => 'Nom de la ville',
                    'attr' => [
                        'maxlength' => 100,
                    ],
                ])
                ->add('cp',TextType::class,[
                    'label' => 'Code postal',
                    'attr' => [
                        'maxlength' => 10,
                    ],
                ])
                ->add('country',EntityType::class,[
                    'label'=>'Pays',
                    'placeholder' => '- Sélectionner -',
                    'class'=>'AlloserviceSiteBundle:Country',
                    'query_builder' => function (EntityRepository $er) {
                        return $er  ->createQueryBuilder('e')
                                    ->orderBy('e.code', 'ASC');
                    },
                    'choice_label' => function($entity) {
                        return $entity->getName().' ['.$entity->getCode().']';
                    },
                    'multiple'=>false,
                    'expanded'=>false,
                    'required'=>true,
                ]);

        if (isset($options['edit']) && $options['edit'] === true) {
            $builder->add('file',FileType::class,[
                        'label' => 'Image (352x234)',
                        'required' => false,
                    ])
                    ->add('submit',SubmitType::class,[
                        'label' => 'Mis à jour',
                        'attr' => [
                            'class' => 'btn btn-yellow',
                        ],
                    ]);
        }else{
            $builder->add('file',FileType::class,[
                        'label' => 'Image (352x234)',
                    ])
                    ->add('submit',SubmitType::class,[
                        'label' => 'Publier...',
                        'attr' => [
                            'class' => 'btn btn-yellow',
                        ],
                    ]);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alloservice\SiteBundle\Entity\City',
            'edit' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'city';
    }


}

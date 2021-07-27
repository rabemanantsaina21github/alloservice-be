<?php

namespace Alloservice\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PartnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,[
                        'label' => 'Nom de partenaire',
                        'attr' => [
                            'maxlength' => 100,
                        ],
                    ])
                ->add('svg',TextareaType::class,[
                        'label' => 'Image svg ou <i class="fa fa-..."></i>',
                        'attr' => [
                            'style' => 'height:80px;min-height:80px',
                        ],
                        'required' => false,
                    ])
                ->add('description',TextareaType::class,[
                        'label' => 'Description',
                        'attr' => [
                            'maxlength' => 255,
                            'style' => 'height:80px;min-height:80px',
                        ],
                        'required' => false,
                    ])
                ->add('file',FileType::class,[
                        'label' => 'Image (Conseilé: 200x200)',
                        'required' => false,
                    ]);

        if (isset($options['edit']) && $options['edit'] === true) {
            $builder->add('submit',SubmitType::class,[
                        'label' => 'Mis à jour',
                        'attr' => [
                            'class' => 'btn btn-yellow',
                        ],
                    ]);
        }else{
            $builder->add('submit',SubmitType::class,[
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
            'data_class' => 'Alloservice\SiteBundle\Entity\Partner',
            'edit' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'partner';
    }


}

<?php

namespace Alloservice\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,[
                    'label' => 'Titre de la section',
                ])
                ->add('description',TextType::class,[
                    'label' => 'Description de la section',
                    'required' => false,
                ])
                ->add('subtitle1',TextType::class,[
                    'label' => 'Titre de la colonne 1',
                    'required' => false,
                ])
                ->add('img1',TextType::class,[
                    'label' => 'Image 1 ou icone 1',
                    'required' => false,
                    'attr' => [
                        'placeholder' => '<img src="https://..."> ou <i class="fa fa-icone"></i>',
                    ],
                ])
                ->add('text1',TextareaType::class,[
                    'label' => 'Paragraphe de la colonne 1',
                    'required' => false,
                ])
                ->add('subtitle2',TextType::class,[
                    'label' => 'Titre de la colonne 2',
                    'required' => false,
                ])
                ->add('img2',TextType::class,[
                    'label' => 'Image 2 ou icone 2',
                    'required' => false,
                    'attr' => [
                        'placeholder' => '<img src="https://..."> ou <i class="fa fa-icone"></i>',
                    ],
                ])
                ->add('text2',TextareaType::class,[
                    'label' => 'Paragraphe de la colonne 2',
                    'required' => false,
                ])
                ->add('subtitle3',TextType::class,[
                    'label' => 'Titre de la colonne 3',
                    'required' => false,
                ])
                ->add('img3',TextType::class,[
                    'label' => 'Image 3 ou icone 3',
                    'required' => false,
                    'attr' => [
                        'placeholder' => '<img src="https://..."> ou <i class="fa fa-icone"></i>',
                    ],
                ])
                ->add('text3',TextareaType::class,[
                    'label' => 'Paragraphe de la colonne 3',
                    'required' => false,
                ])
                ->add('subtitle4',TextType::class,[
                    'label' => 'Titre de la colonne 4',
                    'required' => false,
                ])
                ->add('img4',TextType::class,[
                    'label' => 'Image 4 ou icone 4',
                    'required' => false,
                    'attr' => [
                        'placeholder' => '<img src="https://..."> ou <i class="fa fa-icone"></i>',
                    ],
                ])
                ->add('text4',TextareaType::class,[
                    'label' => 'Paragraphe de la colonne 4',
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
            'data_class' => 'Alloservice\AdminBundle\Entity\Section',
            'edit' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'section';
    }


}

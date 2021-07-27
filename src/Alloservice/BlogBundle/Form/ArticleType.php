<?php

namespace Alloservice\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,[
                        'label' => 'Titre',
                        'attr' => [
                            'maxlength' => 100,
                        ],
                    ])
                ->add('subtitle',TextareaType::class,[
                    'label' => 'Sous-title',
                    'attr' => [
                        'maxlength' => 255,
                        'style' => 'height:80px;min-height:80px',
                    ],
                ])
                ->add('category',EntityType::class,[
                    'label'=>'Catégorie',
                    'placeholder' => '- Sélectionner -',
                    'class'=>'AlloserviceBlogBundle:ArticleCategory',
                    'query_builder' => function (EntityRepository $er) {
                        return $er  ->createQueryBuilder('e')
                                    ->orderBy('e.name', 'ASC');
                    },
                    'choice_label'=>'name',
                    'multiple'=>false,
                    'expanded'=>false,
                ])
                ->add('content',TextareaType::class,[
                    'label' => 'Contenu',
                    'attr' => [
                        'class' => 'wysiwyg',
                    ],
                    'required' => false,
                ])
                ->add('state',CheckboxType::class,[
                    'label' => "Je veux publier cet article maintenant",
                ])
                ;
        if (isset($options['edit']) && $options['edit'] === true) {
            $builder->add('file',FileType::class,[
                        'label' => 'Image (Conseilé: 900x480)',
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
                        'label' => 'Image (Conseilé: 900x480)',
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
            'data_class' => 'Alloservice\BlogBundle\Entity\Article',
            'edit' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'article';
    }


}

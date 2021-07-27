<?php

namespace Alloservice\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ServiceType extends AbstractType
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
                ->add('description',TextareaType::class,[
                        'label' => 'Description',
                    ])
                ->add('metaTitle',TextType::class,[
                        'label' => 'Titre de la page',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Service de bricolage",
                        ],
                    ])
                ->add('serviceType',TextType::class,[
                        'label' => 'Question texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: De quel service d'aménagement avez-vous besoin ?",
                        ],
                    ])
                ->add('otherJob',TextType::class,[
                        'label' => 'Autre job texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Autre job de bricolage",
                        ],
                    ])
                ->add('ourJobers',TextType::class,[
                        'label' => 'Nos jobbeurs texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Nos bricoleurs sont à votre service",
                        ],
                    ])
                ->add('lastServicePub',TextType::class,[
                        'label' => 'Dernières annonces texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Dernières annonces de bricolage",
                        ],
                    ])
                ->add('jobCity',TextType::class,[
                        'label' => 'Jobbeurs ville texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Le bricolage près de chez vous",
                        ],
                    ])
                ->add('jobBlog',TextType::class,[
                        'label' => 'Job blog texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Le blog du bricolage",
                        ],
                    ])
                ->add('button1',TextType::class,[
                        'label' => 'Bouton 1 texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Demander un service de bricolage à domicile",
                        ],
                    ])
                ->add('button2',TextType::class,[
                        'label' => 'Button 2 texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Voir toutes les annonces de bricolage",
                        ],
                    ])
                ->add('button3',TextType::class,[
                        'label' => 'Button 3 texte',
                        'attr' => [
                            'maxlength' => 255,
                            'placeholder' => "Ex: Voir tous les bricoleurs",
                        ],
                    ])
                ;

        if (isset($options['niv']) && $options['niv'] == "niv-2") {
            $builder->add('service',EntityType::class,[
                    'label'=>'Service (Catégorie)',
                    'placeholder' => '- Sélectionner -',
                    'class'=>'AlloserviceAdminBundle:Service',
                    'query_builder' => function (EntityRepository $er) {
                        return $er  ->createQueryBuilder('e')
                                    ->where('e.service is null AND e.supService is null')
                                    ->orderBy('e.title', 'ASC');
                    },
                    'choice_label'=>'title',
                    'multiple'=>false,
                    'expanded'=>false,
                    'required'=>false,
                ]);
        }elseif (isset($options['niv']) && $options['niv'] == "niv-3") {
            $builder->add('supService',EntityType::class,[
                        'label'=>'Service (Catégorie)',
                        'placeholder' => '- Sélectionner -',
                        'class'=>'AlloserviceAdminBundle:Service',
                        'query_builder' => function (EntityRepository $er) {
                            return $er  ->createQueryBuilder('e')
                                        ->where('e.supService is null')
                                        ->orderBy('e.service','ASC')
                                        ->addOrderBy('e.title', 'ASC');
                        },
                        'choice_label'=>'title',
                        'preferred_choices' => function ($choice, $key, $value) {
                            return is_null($choice->getService());
                        },
                        'multiple'=>false,
                        'expanded'=>false,
                    ]);
        }

        if (isset($options['edit']) && $options['edit'] === true) {
            $builder->add('file',FileType::class,[
                        'label' => 'Image (450x300)',
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
                        'label' => 'Image (450x300)',
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
            'data_class' => 'Alloservice\AdminBundle\Entity\Service',
            'edit' => false,
            'niv' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'service';
    }


}

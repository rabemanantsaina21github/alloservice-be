<?php

namespace Alloservice\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,[
                        'label' => 'Nom',
                        'attr' => [
                            'maxlength' => 50,
                        ],
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
            'data_class' => 'Alloservice\BlogBundle\Entity\ArticleCategory',
            'edit' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'articlecategory';
    }


}

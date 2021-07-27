<?php

namespace Alloservice\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::Class, array('attr'=>array('maxlength'=>60, 'autocomplete'=>'off', 'required'=>true), 'label'=>'Adresse e-mail'))
        ->add('description', TextareaType::Class, ['attr'=>['maxlength'=>255, 'autocomplete'=>'off', 'required'=>true], 'label'=>'Description'])
        ->add('categories', ChoiceType::Class, ['choices'=>[
              '-'=>'null',
              'Fonctionnement du site'=>'fonctionnement_du_site',
              'Inscription'=>'inscription',
              'Perte d\'identifiant'=>'perte_d_identifiant',
              'Annulation'=>'annulation',
              'Modifier / Supprimer une demande'=>'modifier_supprimer_ma_demande',
              'Paiement'=>'paiement',
              'Remboursement'=>'remboursement',
              'Déclarer un désaccord'=>'declarer_un_desaccord',
              'Déclaratif / Assurance'=>'declaratif_assurance',
              'Demande de documents'=>'demande_de_documents',
              'Demande de partenariat'=>'demande_de_partenariat'],'attr'=>['autocomplete'=>'off', 'required'=>'required']])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alloservice\SiteBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'alloservice_sitebundle_contact';
    }


}

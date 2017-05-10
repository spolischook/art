<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ArtWork;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArtWorkAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('')
                ->add('title', 'text', array('label' => 'Title'))
                ->add('description', 'text', array('label' => 'Full description'))
             ->end()
             ->with('Properties')
                ->add(
                'date',
                'sonata_type_datetime_picker',
                [
                    'dp_side_by_side'       => false,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_use_minutes'        => false,
                    'format' => "dd/MM/yyyy",
                    'label'                 => 'Creation date'
                ]

                )
                ->add('materials', 'text', array('label' => 'Materials'))

                ->add('width', 'integer', array('label' => 'Widht'))
                ->add('height', 'integer', array('label' => 'Height'))

                ->add('price', 'money', array(
                    'currency' => 'USD',
                    'grouping' => true,
                    'label'    => 'Price'
                ))
                ->add('inStock', 'choice', array(
                       'choices' => array(
                           'Available' => true,
                           'Sold' => false,
                  ),
                ))
                ->add('isPublished', 'choice', array(
                   'choices' => array(
                    'On front' => true,
                    'Not active' => false,
                   ),
                ))
            ->end()
            ->with('Info')
                ->add('slug', 'text', array('label' => 'Slug'))
                ->add('picture', 'file', array('label' => 'Main image'))
                ->add('images', 'file', array(
                     'multiple' => true,
                     'label'    => 'Additional images'
                 ))
            ->end()
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('translations.title', null, array('label' => 'Title'))
            ->add('date')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('translations.title', null, array('label' => 'Title'))
            ->add('date')
            ->add('price')
            ->add('inStock')
            ->add('isPublished')
        ;
    }

    public function toString($object)
    {
        return $object instanceof ArtWork
            ? $object->getTitle()
            : 'ArtWork';
    }
}
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
            ->with('Basic', ['class' => 'col-md-8'])
                ->add('title', 'text', ['label' => 'Title'])
                ->add('description', 'textarea',
                    [
                        'attr' => [
                            'style' => 'height:400px',
                        ],
                        'label' => 'Full description',
                    ])
             ->end()
             ->with('Properties', ['class' => 'col-md-4'])
                ->add(
                'date',
                'sonata_type_datetime_picker',
                [
                    'dp_side_by_side' => false,
                    'dp_use_current' => false,
                    'dp_use_seconds' => false,
                    'dp_use_minutes' => false,
                    'format' => 'dd/MM/yyyy',
                    'label' => 'Creation date',
                ]

                )
                ->add('materials', 'text', ['label' => 'Materials'])

                ->add('width', 'integer', ['label' => 'Width'])
                ->add('height', 'integer', ['label' => 'Height'])

                ->add('price', 'money', [
                    'currency' => 'USD',
                    'grouping' => true,
                    'label' => 'Price',
                ])
                ->add('inStock', 'choice', [
                       'choices' => [
                           'Available' => true,
                           'Sold' => false,
                  ],
                ])
                ->add('isPublished', 'choice', [
                   'choices' => [
                    'On front' => true,
                    'Not active' => false,
                   ],
                ])
            ->end()
            ->with('Info', ['class' => 'col-md-8'])
                ->add('slug', 'text', ['label' => 'Slug'])
                ->add(
                    'picture',
                    'sonata_type_model_list',
                    [
                        'btn_list' => true,
                    ],
                    [
                        'link_parameters' => [
                            'context' => 'picture',
                            'provider' => 'sonata.media.provider.image',
                        ],
                    ])
            ->add(
                'images',
                'sonata_type_collection',
                [
                    'label' => 'Additional images',
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'link_parameters' => [
                        'context' => 'foto',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
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
            ->add('title', 'srting')
            ->add('date', 'date')
            ->add('price')
            ->add('inStock')
            ->add('isPublished')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    public function toString($object)
    {
        return $object instanceof ArtWork
            ? $object->getTitle()
            : 'ArtWork';
    }
}

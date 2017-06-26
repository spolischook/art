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
                        'required' => false,
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
                    'required' => false,

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
                    'Unpublished' => false,
                   ],
                ])
            ->end()
            ->with('Info', ['class' => 'col-md-8'])
                ->add('slug', 'text', ['label' => 'Slug', 'required' => false])
                ->add(
                    'picture',
                    'sonata_type_model_list',
                    [],
                    [
                        'link_parameters' => [
                            'context' => 'art work',
                            'provider' => 'sonata.media.provider.image',
                        ],
                    ])

            ->add(
                'galleryHasMedia',
                'sonata_type_collection',
                [
                    'required' => false,
                    'label' => 'Additional images',
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'targetEntity' => 'Application\Sonata\MediaBundle\Entity\GalleryHasMedia',
                    'admin_code' => 'sonata.media.admin.gallery_has_media',
                    'link_parameters' => [
                        'context' => 'additional images',
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
            ->add('title', null, ['label' => 'Title'])
            ->add('date')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('picture', 'srting', ['label' => 'Main image', 'template' => '::admin/avatar.html.twig'])
            ->add('title', 'string', ['label' => 'Title'])
            ->add('date', 'date')
            ->add('price')
            ->add('inStock', null, [
                'editable' => true,
            ])
            ->add('isPublished', null, [
                'editable' => true,
                ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    public function toString($object)
    {
        return $object instanceof ArtWork
            ? $object->getTitle()
            : 'ArtWork';
    }
}

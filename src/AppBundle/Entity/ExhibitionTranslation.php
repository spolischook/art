<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="exhibition_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_exhibition_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class ExhibitionTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Exhibition", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}

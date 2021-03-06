<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Application\Sonata\MediaBundle\Entity\GalleryHasMedia;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * ArtWork.
 *
 * @ORM\Table(name="art_work")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtWorkRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ArtWorkTranslation")
 * @UniqueEntity("slug")
 * @AppAssert\SlugEdit
 * @AppAssert\PriceEdit
 */
class ArtWork extends AbstractPersonalTranslatable implements TranslatableInterface
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="materials", type="string", length=255)
     */
    private $materials;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var float
     *
     * @Assert\Type("float")
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="in_stock", type="boolean")
     */
    private $inStock;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="in_published", type="boolean")
     */
    private $isPublished;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @ORM\Column(name="was_published", type="boolean")
     */
    private $wasPublished;

    /**
     * @var Media
     * @Assert\Valid()
     * @Assert\Type("object")
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     */
    private $picture;

    /**
     * @var ArrayCollection|GalleryHasMedia[]
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\GalleryHasMedia", cascade={"persist"})
     */
    private $galleryHasMedia;

    /**
     * @var ArrayCollection|Exhibition[]
     * @ORM\ManyToMany(
     *     targetEntity="AppBundle\Entity\Exhibition", inversedBy="artWorks", cascade={"persist"}, fetch="LAZY"
     * )
     */
    private $exhibitions;

    /**
     * @var ArrayCollection|ArtWorkTranslation[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\ArtWorkTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    public function __construct()
    {
        parent::__construct();
        $this->isPublished = false;
        $this->wasPublished = false;
        $this->exhibitions = new ArrayCollection();
        $this->galleryHasMedia = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return ArtWork
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return ArtWork
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set materials.
     *
     * @param string $materials
     *
     * @return ArtWork
     */
    public function setMaterials($materials)
    {
        $this->materials = $materials;

        return $this;
    }

    /**
     * Get materials.
     *
     * @return string
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Get slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return ArtWork
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set width.
     *
     * @param int $width
     *
     * @return ArtWork
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height.
     *
     * @param int $height
     *
     * @return ArtWork
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return ArtWork
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return ArtWork
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set inStock.
     *
     * @param bool $inStock
     *
     * @return ArtWork
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get inStock.
     *
     * @return bool
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * Set isPublished.
     *
     * @param bool $isPublished
     *
     * @return ArtWork
     */
    public function setIsPublished($isPublished)
    {
        if ($isPublished) {
            $this->wasPublished = true;
        }
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get inPublished.
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Get wasPublished.
     *
     * @return bool
     */
    public function getWasPublished()
    {
        return $this->wasPublished;
    }

    /**
     * Symlink to getWasPublished method
     *
     * @return bool
     */
    public function isWasPublished()
    {
        return $this->getWasPublished();
    }

    /**
     * Set picture.
     *
     * @param Media $picture
     *
     * @return ArtWork
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add exhibition.
     *
     * @param Exhibition $exhibition
     *
     * @return ArtWork
     */
    public function addExhibition($exhibition)
    {
        if (!$exhibition) {
            $this->exhibitions = new ArrayCollection();
        }

        if (!$this->exhibitions->contains($exhibition)) {
            $this->exhibitions->add($exhibition);
            $exhibition->addArtWork($this);
        }

        return $this;
    }

    /**
     * Remove exhibition.
     *
     * @param Exhibition $exhibition
     *
     * @return ArtWork
     */
    public function removeExhibition($exhibition)
    {
        $this->getExhibitions()->removeElement($exhibition);

        return $this;
    }

    /**
     * Get exhibitions.
     *
     * @return ArrayCollection
     */
    public function getExhibitions()
    {
        return $this->exhibitions;
    }

    /**
     * Add galleryHasMedia.
     *
     * @param \Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     *
     * @return ArtWork
     */
    public function addGalleryHasMedia(\Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedia[] = $galleryHasMedia;

        return $this;
    }
    /**
     * Remove galleryHasMedia.
     *
     * @param \Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     */
    public function removeGalleryHasMedia(\Application\Sonata\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedia->removeElement($galleryHasMedia);
    }
    /**
     * Get galleryHasMedia.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleryHasMedia()
    {
        return $this->galleryHasMedia;
    }

    public function getClass()
    {
        return 'artwork';
    }
}

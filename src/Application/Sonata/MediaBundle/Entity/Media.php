<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Entity;

use AppBundle\Entity\ArtWork;
use Sonata\MediaBundle\Entity\BaseMedia as BaseMedia;
use Doctrine\ORM\Mapping as ORM;

/**
 * This file has been generated by the Sonata EasyExtends bundle.
 *
 * @link https://sonata-project.org/bundles/easy-extends
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Media extends BaseMedia
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArtWork
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\ArtWork", inversedBy="images")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="artWork", referencedColumnName="id")
     * })
     */
    private $artWork;

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set art work.
     *
     * @param ArtWork $artWork
     *
     * @return Media
     */
    public function setArtWork(ArtWork $artWork)
    {
        $this->artWork = $artWork;

        return $this;
    }

    /**
     * Get atr work.
     *
     * @return ArtWork
     */
    public function getArtWork()
    {
        return $this->artWork;
    }
}
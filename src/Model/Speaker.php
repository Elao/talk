<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Speaker
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Speaker
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;
}

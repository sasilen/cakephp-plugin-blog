<?php
declare(strict_types=1);

namespace Sasilen\Blog\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property int $ref_id
 * @property string $file
 * @property string|null $name
 * @property int $position
 * @property string|null $caption
 *
 * @property \Blog\Model\Entity\Ref $ref
 */
class Media extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
/*        'ref' => true,
        'ref_id' => true,
        'file' => true,
        'name' => true,
        'position' => true,
        'caption' => true,*/
    ];
}

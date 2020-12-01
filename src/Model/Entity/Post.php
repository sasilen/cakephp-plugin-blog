<?php
declare(strict_types=1);

namespace Blog\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $summary
 * @property string $body
 * @property bool|null $online
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool|null $auth
 * @property int|null $tag_count
 *
 * @property \Blog\Model\Entity\User $user
 */
class Post extends Entity
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
/*        'id' => true,
        'name' => true,
        'summary' => true,
        'body' => true,
        'online' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'auth' => true,
        'tag_count' => true,
        'user' => true,
        'medias' => true,*/
    ];
}

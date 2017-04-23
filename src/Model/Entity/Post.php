<?php
namespace Blog\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $summary
 * @property string $parent_id
 * @property string $body
 * @property bool $published
 * @property string $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $startdate
 * @property \Cake\I18n\Time $enddate
 * @property string $link
 * @property bool $auth
 * @property bool $darken
 *
 * @property \Blog\Model\Entity\ParentPost $parent_post
 * @property \Blog\Model\Entity\User $user
 * @property \Blog\Model\Entity\ChildPost[] $child_posts
 * @property \Blog\Model\Entity\Category[] $categories
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
        'id' => false
    ];
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Card Entity
 *
 * @property int $id
 * @property int|null $position
 * @property string $name
 * @property int $lane_id
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $due_date
 * @property bool|null $archived
 *
 * @property \App\Model\Entity\Lane $lane
 * @property \App\Model\Entity\Checklist[] $checklists
 */
class Card extends Entity
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
        'position' => true,
        'name' => true,
        'lane_id' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'due_date' => true,
        'archived' => true,
        'lane' => true,
        'checklists' => true,
    ];
}

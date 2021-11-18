<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Checklist Entity
 *
 * @property int $id
 * @property int|null $position
 * @property string $name
 * @property int $card_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Card $card
 * @property \App\Model\Entity\ChecklistItem[] $checklist_items
 */
class Checklist extends Entity
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
        'card_id' => true,
        'created' => true,
        'card' => true,
        'checklist_items' => true,
    ];
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Professore Entity
 *
 * @property int $id
 * @property int|null $siape
 * @property string|null $nome
 * @property string|null $email
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $users_id
 *
 * @property \App\Model\Entity\User $user
 */
class Professore extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'siape' => true,
        'nome' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'users_id' => true,
        'user' => true,
    ];
}

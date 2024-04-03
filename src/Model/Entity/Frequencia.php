<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Frequencia Entity
 *
 * @property int $id
 * @property string $dia
 * @property string $horas
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $saida
 * @property int|null $semanas_id
 *
 * @property \App\Model\Entity\Semana $semana
 */
class Frequencia extends Entity
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
        'dia' => true,
        'horas' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'saida' => true,
        'semanas_id' => true,
        'semana' => true,
    ];
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Solicitaco Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $data
 * @property string|null $dia
 * @property string|null $horarios
 * @property string|null $justificativa
 * @property string|null $tipo
 * @property int|null $status
 * @property int|null $registro
 * @property int $diarios_id
 *
 * @property \App\Model\Entity\Diario $diario
 */
class Solicitaco extends Entity
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
        'data' => true,
        'dia' => true,
        'horarios' => true,
        'justificativa' => true,
        'tipo' => true,
        'status' => true,
        'registro' => true,
        'diarios_id' => true,
        'diario' => true,
    ];
}

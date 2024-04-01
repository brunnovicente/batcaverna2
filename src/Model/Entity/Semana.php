<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Semana Entity
 *
 * @property int $id
 * @property string $descricao
 * @property string $carga
 * @property \Cake\I18n\FrozenDate $inicio
 * @property \Cake\I18n\FrozenDate $fim
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $monitorias_id
 * @property string|null $cumprido
 *
 * @property \App\Model\Entity\Monitoria $monitoria
 */
class Semana extends Entity
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
        'descricao' => true,
        'carga' => true,
        'inicio' => true,
        'fim' => true,
        'created' => true,
        'modified' => true,
        'monitorias_id' => true,
        'cumprido' => true,
        'monitoria' => true,
    ];
}

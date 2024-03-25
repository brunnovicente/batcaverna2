<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Monitoria Entity
 *
 * @property int $id
 * @property string|null $descricao
 * @property string|null $carga
 * @property string|null $periodo
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $alunos_id
 * @property int|null $professores_id
 *
 * @property \App\Model\Entity\Aluno $aluno
 * @property \App\Model\Entity\Professore $professore
 */
class Monitoria extends Entity
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
        'periodo' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'alunos_id' => true,
        'professores_id' => true,
        'aluno' => true,
        'professore' => true,
    ];
}

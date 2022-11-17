<?php
/* @var $models  */

foreach ($models as $model){
    echo \yii\widgets\DetailView::widget([
        'model'      => $model,
        'attributes' => [
            [
                'attribute'=>'module_name',
                'label'=>'Modulo'
            ],
            [
                'attribute'=>'materia_code',
                'label'=>'Materia'
            ],
            [
                'attribute'=>'tema_name',
                'label'=>'Tema'
            ],
            [
                'attribute'=>'attempt',
                'label'=>'Intentos'
            ],
            [
                'attribute'=>'dead_line',
                'label'=>'Fecha limite'
            ],
        ]
    ]);
}






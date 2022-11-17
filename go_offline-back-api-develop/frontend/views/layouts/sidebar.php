<?php

use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Go Offline</a>
            </div>
        </div>
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii', 'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Administración Sistema',
                        //     'visible' => Yii::$app->user->can('sysadmin'),
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Backend routes',
                                'url' => '#',
                                'items' => [
                                    ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['/user-management/user/index']],
                                    ['label' => UserManagementModule::t('back', 'Roles'), 'url' => ['/user-management/role/index']],
                                    ['label' => UserManagementModule::t('back', 'Permissions'), 'url' => ['/user-management/permission/index']],
                                    ['label' => UserManagementModule::t('back', 'Permission groups'), 'url' => ['/user-management/auth-item-group/index']],
                                    ['label' => UserManagementModule::t('back', 'Visit log'), 'url' => ['/user-management/user-visit-log/index']],
                                ],

                            ],
                        ],
                    ],
                    ['label' => 'USER routes',
                        'items' => [
                            ['label' => 'Login', 'url' => ['/user-management/auth/login']],
                            ['label' => 'Logout', 'url' => ['/user-management/auth/logout']],
                            ['label' => 'Registration', 'url' => ['/user-management/auth/registration']],
                            ['label' => 'Change own password', 'url' => ['/user-management/auth/change-own-password']],
                            ['label' => 'Password recovery', 'url' => ['/user-management/auth/password-recovery']],
                            ['label' => 'E-mail confirmation', 'url' => ['/user-management/auth/confirm-email']],
                        ],
                    ],
                    ['label' => 'Frontend',
                        'items' => [
                            ['label' => 'Módulos', 'url' => ['/module/index']],
                            ['label' => 'Temas', 'url' => ['/topic/index']],
                            ['label' => 'Asignaturas', 'url' => ['/careersubject/index']],
                            ['label' => 'Año escolar', 'url' => ['/schoolyear/index']],
                            ['label' => 'Pensum', 'url' => ['/pensum/index']],
                            ['label' => 'Pensum-modulos', 'url' => ['/pensummodule/index']],
                            ['label' => 'Plan academico', 'url' => ['/academicplanning/index']],
                            ['label' => 'Periodo', 'url' => ['/period/index']],
                            ['label' => 'Geo data usuarios', 'url' => ['/geouserdata/index']],
                            ['label' => 'Asignacion de usuario al periodo', 'url' => ['/userperiod/index']],
                            ['label' => 'Respuestas de los estudiantes', 'url' => ['/answerquestionnaire/index']],
                        ],
                    ],
                ],

            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
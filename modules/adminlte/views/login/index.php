<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="login-box">
        <div class="card card-outline card-primary p-3">
            <div class="card-header ">                 
                    <h3 class="mb-0 text-center"> 
                        Панель администратора
                    </h3>
                 </div>
            <div class="card-body login-card-body">
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        // 'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        // 'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        // 'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]) ?>              
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input type="text" id="loginform-login" class="form-control" name="LoginForm[login]" aria-required="true">
                            <label for="loginform-login">Логин</label> 
                        </div>
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" aria-required="true">
                            <label for="loginform-password">Пароль</label> 
                        </div>
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div>
                    
                    
                  
                    <div class="row mt-5 mb-3">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label> </div>
                        </div> <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2"> 
                                <?= Html::submitButton('Вход', ['class' => "btn btn-primary"]) ?>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                <?php ActiveForm::end() ?>
                
                
            </div> <!-- /.login-card-body -->
        </div>
    </div>
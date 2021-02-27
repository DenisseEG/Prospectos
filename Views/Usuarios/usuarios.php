<?php
    headerTemplate($data);
    getModal('modalUsuarios', $data);
?>
<div id="content_ajax"></div>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fas fa-user-tag"></i> <?= $data['page_title']; ?>
                    <?php if(!empty($_SESSION['permisos_modulo']['escribir'])):?>
                    <button class="btn btn-primary" type="button" onclick="userActions('new', null)"><i class="fas fa-plus-circle"></i> Nuevo</button>
                    <?php endif; ?>
                </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>/usuarios"><?= $data['page_title']; ?></a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php footerTemplate($data); ?>

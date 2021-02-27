<?php
headerTemplate($data);
getModal('modalProspectos', $data);
?>
<div id="content_ajax"></div>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> <?= $data['page_title']; ?>
                <?php if(!empty($_SESSION['permisos_modulo']['escribir'])):?>
                <button class="btn btn-primary" type="button" onclick="clientActions('new', null)"><i class="fas fa-plus-circle"></i> Nuevo</button>
                <?php endif; ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/prospectos"><?= $data['page_title']; ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="clientsTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Estatus</th>
                                <th>Observaciones</th>
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

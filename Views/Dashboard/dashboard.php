<?php headerTemplate($data); ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fas fa-tachometer-alt"></i> <?= $data['page_title']; ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard"><?= $data['page_title']; ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="widget-small info"><i class="icon fas fa-paper-plane fa-3x"></i></i>
                <div class="info">
                    <h4>Prospectos enviados</h4>
                    <span class="count-clients" id="enviados"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-small success"><i class="icon fas fa-user-check fa-3x"></i>
                <div class="info">
                    <h4>Prospectos autorizados</h4>
                    <span class="count-clients"id="autorizados"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-small danger"><i class="icon fas fa-user-times fa-3x"></i>
                <div class="info">
                    <h4>Prospectos rechazados</h4>
                    <span class="count-clients" id="rechazados"></span>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerTemplate($data); ?>
<!-- Modal -->
<div class="modal fade" id="modalPermissions" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title_permissions">Permisos roles de ususario</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formPermissions" name="formPermissions">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Módulo</th>
                                                    <th>Ver</th>
                                                    <th>Crear</th>
                                                    <th>Actualizar</th>
                                                    <th>Eliminar</th>
                                                    <th>Aprobar/Rechazar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($data as $key_module => $value_module): ?>
                                                <tr>
                                                    <td>
                                                        <?= $value_module['id_modulo'] ?>
                                                        <input type="hidden" name="modulos[<?= $key_module ?>][modulo_id]" value="<?= $value_module['id_modulo'] ?>">
                                                    </td>
                                                    <td> <?= $value_module['titulo'] ?></td>
                                                    <?php foreach($value_module['permisos'] as $key_permission => $value_permission): ?>
                                                        <td>
                                                            <?php if($key_permission != 'evaluar' || $key_permission == 'evaluar' && $value_module['titulo'] == 'Prospectos' ): ?>
                                                                <div class="toggle-flip">
                                                                    <label>
                                                                        <input type="checkbox" name="modulos[<?= $key_module ?>][<?= $key_permission ?>]" value="1" <?= $value_permission ? 'checked' : '' ?>>
                                                                        <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                                    </label>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    <sapan id="save_form_permissions">Guardar</sapan>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-secondary" type="button" onclick="cancelModal('modalPermissions', 'formPermissions', 2, false)">
                                    <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
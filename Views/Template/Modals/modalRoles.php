<!-- Modal -->
<div class="modal fade" id="modalFormRole" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title_role">Nuevo Rol</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formRole" name="formRole">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="rol_nombre" name="nombre" type="text" placeholder="Nombre del rol" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripción</label>
                                <textarea class="form-control" id="rol_descripcion" name="descripcion" rows="2" placeholder="Descripción del rol" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rol_estatus">Estatus</label>
                                <select class="form-control" id="rol_estatus" name="estatus" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    <sapan id="save_form_role">Guardar</sapan>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-secondary" type="button" onclick="cancelModal('modalFormRole', 'formRole', 1, false)">
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


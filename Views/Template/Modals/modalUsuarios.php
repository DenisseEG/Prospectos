<!-- Modal -->
<div class="modal fade" id="modalFormUser" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title_user">Nuevo Rol</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formUser" name="formUser" class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Nombre/s</label>
                                <input class="form-control validate" id="usuario_nombre" name="nombre" type="text"
                                       placeholder="Nombre/s" onkeyup="validateData('text', this, 'usuario_nombre_msj')" required>
                                <span class="invalid-msg" id="usuario_nombre_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Apellido paterno</label>
                                <input class="form-control validate" id="usuario_apll_paterno" name="apll_paterno" type="text"
                                       placeholder="Apellido paterno" onkeyup="validateData('text', this, 'usuario_apll_paterno_msj')" required>
                                <span class="invalid-msg" id="usuario_apll_paterno_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Apellido materno</label>
                                <input class="form-control validate" id="usuario_apll_materno" name="apll_materno" type="text"
                                       placeholder="Apellido materno" onkeyup="validateData('text', this, 'usuario_apll_materno_msj')" required>
                                <span class="invalid-msg" id="usuario_apll_materno_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Correo</label>
                                <input class="form-control validate" id="usuario_correo" name="correo" type="email"
                                       placeholder="Correo" onkeyup="validateData('email', this, 'usuario_correo_msj')" required>
                                <span class="invalid-msg" id="usuario_correo_msj">No es un correo válido</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rol_id">Rol</label>
                                <select class="form-control" id="usuario_rol" name="rol_id" required>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rol_estatus">Estatus</label>
                                <select class="form-control" id="rol_estatus" name="estatus" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Contraseña</label>
                                <input class="form-control" id="usuario_contrasena" name="contrasena" type="password" placeholder="Contraseña" required>
                            </div>
                            <div class="tile-footer col-md-12">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    <sapan id="save_form_user">Guardar</sapan>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-secondary" type="button" onclick="cancelModal('modalFormUser', 'formUser', 2, true)">
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

<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del usuario</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID:</td>
                        <td id="uv_id_user"></td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td id="uv_nombre"></td>
                    </tr>
                    <tr>
                        <td>Apellido paterno:</td>
                        <td id="uv_apll_paterno"></td>
                    </tr>
                    <tr>
                        <td>Apellido materno:</td>
                        <td id="uv_apll_materno"></td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td id="uv_correo"></td>
                    </tr>
                    <tr>
                        <td>Rol:</td>
                        <td id="uv_rol"></td>
                    </tr>
                    <tr>
                        <td>Estatus:</td>
                        <td id="uv_estatus"></td>
                    </tr>
                    <tr>
                        <td>Fecha de creación:</td>
                        <td id="uv_fecha"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="tile-footer col-md-12 text-right">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

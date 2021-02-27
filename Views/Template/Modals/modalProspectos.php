<!-- Modal -->
<div class="modal fade" id="modalFormClient" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title_client">Nuevo Prospecto</h5>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formClient" name="formClient" class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Nombre/s</label>
                                <input class="form-control validate" id="prospecto_nombre" name="nombre" type="text"
                                       placeholder="Nombre/s" onkeyup="validateData('text', this, 'prospecto_nombre_msj')" required>
                                <span class="invalid-msg" id="prospecto_nombre_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Apellido paterno</label>
                                <input class="form-control validate" id="prospecto_apll_paterno" name="apll_paterno" type="text"
                                       placeholder="Apellido paterno" onkeyup="validateData('text', this, 'prospecto_apll_paterno_msj')" required>
                                <span class="invalid-msg" id="prospecto_apll_paterno_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Apellido materno</label>
                                <input class="form-control validate" id="prospecto_apll_materno" name="apll_materno" type="text"
                                       placeholder="Apellido materno" onkeyup="validateData('text', this, 'prospecto_apll_materno_msj')" required>
                                <span class="invalid-msg" id="prospecto_apll_materno_msj">Solo se permiten letras</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Calle</label>
                                <input class="form-control validate" id="prospecto_calle" name="calle" type="text"
                                       placeholder="Calle" onkeyup="validateData('address', this, 'prospecto_calle_msj')" required>
                                <span class="invalid-msg" id="prospecto_calle_msj">Solo se permiten letras, números, puntos(.), guiones(-) y diagonales(/)</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Número</label>
                                <input class="form-control validate" id="prospecto_numero" name="numero" type="number"
                                       placeholder="Número" onkeyup="validateData('number', this, 'prospecto_numero_msj')" required>
                                <span class="invalid-msg" id="prospecto_numero_msj">Solo se permiten números</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Colonia</label>
                                <input class="form-control validate" id="prospecto_colonia" name="colonia" type="text"
                                       placeholder="Colonia" onkeyup="validateData('address', this, 'prospecto_colonia_msj')" required>
                                <span class="invalid-msg" id="prospecto_colonia_msj">Solo se permiten letras, números, puntos(.), guiones(-) y diagonales(/)</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Código postal</label>
                                <input class="form-control validate" id="prospecto_codigo_postal" name="codigo_postal" type="number"
                                       placeholder="Código postal" onkeyup="validateData('number', this, 'prospecto_codigo_postal_msj')" required>
                                <span class="invalid-msg" id="prospecto_codigo_postal_msj">Solo se permiten números</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Teléfono</label>
                                <input class="form-control validate" id="prospecto_telefono" name="telefono" type="number"
                                       placeholder="Teléfono" onkeyup="validateData('number', this, 'prospecto_telefono_msj')" required>
                                <span class="invalid-msg" id="prospecto_telefono_msj">Solo se permiten números</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">RFC</label>
                                <input class="form-control validate" id="prospecto_rfc" name="rfc" type="text"
                                       placeholder="RFC" onkeyup="validateData('rfc', this, 'prospecto_rfc_msj')" maxlength="10" required>
                                <span class="invalid-msg" id="prospecto_rfc_msj">Solo se permiten letras mayúsculas sin acentos y números</span>
                            </div>
                            <input name="estatus_prospecto" id="prospecto_estatus_prospecto" type="hidden">
                            <div class="tile-footer col-md-12">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    <sapan id="save_form_client">Guardar</sapan>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-secondary" type="button" onclick="cancelModal('modalFormClient', 'formClient', 0, true)">
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
<div class="modal fade" id="modalViewClient" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del prospecto</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID:</td>
                        <td id="pv_id_prospecto"></td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td id="pv_nombre"></td>
                    </tr>
                    <tr>
                        <td>Apellido paterno:</td>
                        <td id="pv_apll_paterno"></td>
                    </tr>
                    <tr>
                        <td>Apellido materno:</td>
                        <td id="pv_apll_materno"></td>
                    </tr>
                    <tr>
                        <td>Calle:</td>
                        <td id="pv_calle"></td>
                    </tr>
                    <tr>
                        <td>Número:</td>
                        <td id="pv_numero"></td>
                    </tr>
                    <tr>
                        <td>Colonia:</td>
                        <td id="pv_colonia"></td>
                    </tr>
                    <tr>
                        <td>Código postal:</td>
                        <td id="pv_codigo_postal"></td>
                    </tr>
                    <tr>
                        <td>Teléfono:</td>
                        <td id="pv_telefono"></td>
                    </tr>
                    <tr>
                        <td>RFC:</td>
                        <td id="pv_rfc"></td>
                    </tr>
                    <tr>
                        <td>Estatus:</td>
                        <td id="pv_estatus_prospecto"></td>
                    </tr>
                    <tr>
                        <td>Observaciones:</td>
                        <td id="pv_observaciones"></td>
                    </tr>
                    <tr>
                        <td>Creador:</td>
                        <td id="pv_usuario"></td>
                    </tr>
                    <tr>
                        <td>Fecha de creación:</td>
                        <td id="pv_fecha"></td>
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

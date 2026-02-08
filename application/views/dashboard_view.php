<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Gestión Escolar</h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#alumnos">Alumnos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#grupos">Grupos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#carreras">Carreras</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#turnos">Turnos</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#grados">Grados</button></li>
    </ul>

    <div class="tab-content pt-3" id="myTabContent">

        <div class="tab-pane fade show active" id="alumnos">
            <div class="row">
                <div class="col-md-4">
                    <h4>Agregar Alumno</h4>
                    <form action="<?= base_url('dashboard/guardar_alumno') ?>" method="post" id="formAlumnos">
                        <input type="hidden" name="id_alumno" id="id_alumno"> 

                        <div class="mb-2">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
                        </div>

                        <div class="mb-2">
                            <input type="text" name="ap_paterno" id="ap_paterno" class="form-control" placeholder="Apellido Paterno" required>
                        </div>

                        <div class="mb-2">
                            <input type="text" name="ap_materno" id="ap_materno" class="form-control" placeholder="Apellido Materno" required>
                        </div>

                        <div class="mb-2">
                            <select name="id_grupo" id="id_grupo" class="form-control">
                                <?php foreach($grupos as $g): ?>
                                    <option value="<?= $g->id ?>"><?= $g->nombre_grupo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">Cancelar</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <thead><tr><th>Nombre</th><th>Grupo</th><th>Carrera</th><th>Acciones</th></tr></thead>
                        <tbody>
                            <?php foreach($alumnos as $a): ?>
                            <tr>
                                <td><?= $a->nombre . ' ' . $a->ap_paterno ?></td>
                                <td><?= $a->nombre_grupo ?></td>
                                <td><?= $a->carrera ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-editar" 
                                        data-id="<?= $a->id ?>"
                                        data-nombre="<?= $a->nombre ?>"
                                        data-paterno="<?= $a->ap_paterno ?>"
                                        data-materno="<?= $a->ap_materno ?>"
                                        data-grupo="<?= $a->id_grupo ?>"
                                    >
                                        Editar
                                    </button>

                                    <a href="<?= base_url('dashboard/eliminar/alumnos/'.$a->id) ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Seguro que deseas eliminar?');">X</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="grupos">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-3">Gestión de Grupos</h4>
                    <form action="<?= base_url('dashboard/guardar_grupo') ?>" method="post" id="formGrupos">
                        
                        <input type="hidden" name="id_grupo" id="id_grupo">

                        <div class="mb-3">
                            <label>Nombre del Grupo</label>
                            <input type="text" name="nombre_grupo" id="g_nombre" class="form-control" placeholder="Ej: TIC-401" required>
                        </div>

                        <div class="mb-3">
                            <label>Carrera</label>
                            <select name="id_carrera" id="g_carrera" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <?php foreach($carreras as $c): ?>
                                    <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Turno</label>
                            <select name="id_turno" id="g_turno" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <?php foreach($turnos as $t): ?>
                                    <option value="<?= $t->id ?>"><?= $t->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Grado</label>
                            <select name="id_grado" id="g_grado" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <?php foreach($grados as $gr): ?>
                                    <option value="<?= $gr->id ?>"><?= $gr->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="btnGuardarGrupo">Guardar Grupo</button>
                        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="limpiarFormularioGrupo()">Cancelar / Limpiar</button>
                    </form>
                </div>

                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Grupo</th>
                                <th>Carrera</th>
                                <th>Turno</th>
                                <th>Grado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($grupos)): ?>
                                <?php foreach($grupos as $g): ?>
                                <tr>
                                    <td><?= $g->nombre_grupo ?></td>
                                    <td><?= $g->carrera ?></td>
                                    <td><?= $g->turno ?></td>
                                    <td><?= $g->grado ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-editar-grupo"
                                            data-id="<?= $g->id ?>"
                                            data-nombre="<?= $g->nombre_grupo ?>"
                                            data-carrera="<?= $g->id_carrera ?>"
                                            data-turno="<?= $g->id_turno ?>"
                                            data-grado="<?= $g->id_grado ?>"
                                        >Editar</button>

                                        <a href="<?= base_url('dashboard/eliminar/grupos/'.$g->id) ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Borrar este grupo?');">X</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center">No hay grupos registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="carreras">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-3">Gestión de Carreras</h4>
                    <form action="<?= base_url('dashboard/guardar_carrera') ?>" method="post" id="formCarreras">
                        <input type="hidden" name="id_carrera" id="id_carrera">
                        <div class="mb-3">
                            <label>Nombre de la Carrera</label>
                            <input type="text" name="nombre" id="c_nombre" class="form-control" placeholder="Ej: Ingeniería en Sistemas" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btnGuardarCarrera">Guardar Carrera</button>
                        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="limpiarFormularioCarrera()">Cancelar / Limpiar</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Carrera</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($carreras)): ?>
                                <?php foreach($carreras as $c): ?>
                                <tr>
                                    <td><?= $c->nombre ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-editar-carrera"
                                            data-id="<?= $c->id ?>"
                                            data-nombre="<?= $c->nombre ?>"
                                        >Editar</button>
                                        <a href="<?= base_url('dashboard/eliminar/carreras/'.$c->id) ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Borrar esta carrera?');">X</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="2" class="text-center">No hay carreras registradas</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="turnos">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-3">Gestión de Turnos</h4>
                    <form action="<?= base_url('dashboard/guardar_turno') ?>" method="post" id="formTurnos">
                        <input type="hidden" name="id_turno" id="id_turno">
                        <div class="mb-3">
                            <label>Nombre del Turno</label>
                            <input type="text" name="nombre" id="t_nombre" class="form-control" placeholder="Ej: Matutino" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btnGuardarTurno">Guardar Turno</button>
                        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="limpiarFormularioTurno()">Cancelar / Limpiar</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Turno</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($turnos)): ?>
                                <?php foreach($turnos as $t): ?>
                                <tr>
                                    <td><?= $t->nombre ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-editar-turno"
                                            data-id="<?= $t->id ?>"
                                            data-nombre="<?= $t->nombre ?>"
                                        >Editar</button>
                                        <a href="<?= base_url('dashboard/eliminar/turnos/'.$t->id) ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Borrar este turno?');">X</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="2" class="text-center">No hay turnos registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="grados">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-3">Gestión de Grados</h4>
                    <form action="<?= base_url('dashboard/guardar_grado') ?>" method="post" id="formGrados">
                        <input type="hidden" name="id_grado" id="id_grado">
                        <div class="mb-3">
                            <label>Nombre del Grado</label>
                            <input type="text" name="nombre" id="gr_nombre" class="form-control" placeholder="Ej: Cuarto" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="btnGuardarGrado">Guardar Grado</button>
                        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="limpiarFormularioGrado()">Cancelar / Limpiar</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Grado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($grados)): ?>
                                <?php foreach($grados as $gr): ?>
                                <tr>
                                    <td><?= $gr->nombre ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm btn-editar-grado"
                                            data-id="<?= $gr->id ?>"
                                            data-nombre="<?= $gr->nombre ?>"
                                        >Editar</button>
                                        <a href="<?= base_url('dashboard/eliminar/grados/'.$gr->id) ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Borrar este grado?');">X</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="2" class="text-center">No hay grados registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // Funcionalidad para alumnos
        const botonesEditar = document.querySelectorAll(".btn-editar");
        botonesEditar.forEach(boton => {
            boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");
                const paterno = this.getAttribute("data-paterno");
                const materno = this.getAttribute("data-materno");
                const grupo = this.getAttribute("data-grupo");

                document.getElementById("id_alumno").value = id;
                document.getElementById("nombre").value = nombre;
                document.getElementById("ap_paterno").value = paterno;
                document.getElementById("ap_materno").value = materno;
                document.getElementById("id_grupo").value = grupo;
                document.getElementById("btnGuardar").innerText = "Actualizar Alumno";
                document.getElementById("nombre").focus();
            });
        });

        // Funcionalidad para grupos
        const botonesEditarGrupo = document.querySelectorAll(".btn-editar-grupo");
        botonesEditarGrupo.forEach(boton => {
            boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");
                const carrera = this.getAttribute("data-carrera");
                const turno = this.getAttribute("data-turno");
                const grado = this.getAttribute("data-grado");

                document.getElementById("id_grupo").value = id;
                document.getElementById("g_nombre").value = nombre;
                document.getElementById("g_carrera").value = carrera;
                document.getElementById("g_turno").value = turno;
                document.getElementById("g_grado").value = grado;
                document.getElementById("btnGuardarGrupo").innerText = "Actualizar Grupo";
                document.getElementById("g_nombre").focus();
            });
        });

        // Funcionalidad para carreras
        const botonesEditarCarrera = document.querySelectorAll(".btn-editar-carrera");
        botonesEditarCarrera.forEach(boton => {
            boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");

                document.getElementById("id_carrera").value = id;
                document.getElementById("c_nombre").value = nombre;
                document.getElementById("btnGuardarCarrera").innerText = "Actualizar Carrera";
                document.getElementById("c_nombre").focus();
            });
        });

        // Funcionalidad para turnos
        const botonesEditarTurno = document.querySelectorAll(".btn-editar-turno");
        botonesEditarTurno.forEach(boton => {
            boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");

                document.getElementById("id_turno").value = id;
                document.getElementById("t_nombre").value = nombre;
                document.getElementById("btnGuardarTurno").innerText = "Actualizar Turno";
                document.getElementById("t_nombre").focus();
            });
        });

        // Funcionalidad para grados
        const botonesEditarGrado = document.querySelectorAll(".btn-editar-grado");
        botonesEditarGrado.forEach(boton => {
            boton.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");

                document.getElementById("id_grado").value = id;
                document.getElementById("gr_nombre").value = nombre;
                document.getElementById("btnGuardarGrado").innerText = "Actualizar Grado";
                document.getElementById("gr_nombre").focus();
            });
        });
    });

    function limpiarFormulario() {
        document.getElementById("formAlumnos").reset();
        document.getElementById("id_alumno").value = ""; 
        document.getElementById("btnGuardar").innerText = "Guardar";
    }

    function limpiarFormularioGrupo() {
        document.getElementById("formGrupos").reset();
        document.getElementById("id_grupo").value = ""; 
        document.getElementById("btnGuardarGrupo").innerText = "Guardar Grupo";
    }

    function limpiarFormularioCarrera() {
        document.getElementById("formCarreras").reset();
        document.getElementById("id_carrera").value = ""; 
        document.getElementById("btnGuardarCarrera").innerText = "Guardar Carrera";
    }

    function limpiarFormularioTurno() {
        document.getElementById("formTurnos").reset();
        document.getElementById("id_turno").value = ""; 
        document.getElementById("btnGuardarTurno").innerText = "Guardar Turno";
    }

    function limpiarFormularioGrado() {
        document.getElementById("formGrados").reset();
        document.getElementById("id_grado").value = ""; 
        document.getElementById("btnGuardarGrado").innerText = "Guardar Grado";
    }
</script>
</body>
</html>
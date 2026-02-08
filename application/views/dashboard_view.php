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

        <div class="tab-pane fade" id="carreras">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('dashboard/guardar_carrera') ?>" method="post">
                        <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre Carrera">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <ul class="list-group">
                        <?php foreach($carreras as $c): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $c->nombre ?>
                                <a href="<?= base_url('dashboard/eliminar/carreras/'.$c->id) ?>" class="badge bg-danger rounded-pill text-decoration-none">X</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        
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
</script>
</body>
</html>
<?php
session_start();
include("config.php");

// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- LOGIN ---
if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Los campos están vacíos.</p>";
    } else {
        $stmt = $conexion->prepare("SELECT id_usuario, nombre, apellido, contraseña, rol FROM usuarios WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($datos = $resultado->fetch_assoc()) {
            if (password_verify($password, $datos['contraseña'])) {
                $_SESSION['id_usuario'] = $datos['id_usuario'];
                $_SESSION['nombre'] = $datos['nombre'];
                $_SESSION['apellido'] = $datos['apellido'];
                $_SESSION['rol'] = $datos['rol'];

                // Redirigir según rol
                if ($datos['rol'] == "cliente") header("Location: ../Cliente/index.php");
                elseif ($datos['rol'] == "empleado") header("Location: ../Empleado/index.php");
                elseif ($datos['rol'] == "admin") header("Location: ../Admin/index.php");
                exit;
            } else {
                echo "<p style='color:red;'>Contraseña incorrecta.</p>";
            }
        } else {
            echo "<p style='color:red;'>El usuario no existe.</p>";
        }
    }
}

// --- REGISTRO ---
if (isset($_POST["register"])) {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    if ($password !== $confirmar) {
        echo "<p style='color:red;'>Las contraseñas no coinciden.</p>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, email, contraseña, rol) VALUES (?, ?, ?, ?, 'cliente')");
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $hash);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Usuario registrado con éxito. Ahora puedes iniciar sesión.</p>";
        } else {
            echo "<p style='color:red;'>Error al registrar el usuario: " . $stmt->error . "</p>";
        }
    }
}

// --- CRUD RESERVAS ---
if (isset($_POST["add_reservation"])) {
    $cliente_id = $_SESSION['id_usuario'];
    $id_vehiculo = $_POST["id_vehiculo"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $servicio = $_POST["servicio"];
    $estado = "Pendiente";

    // Validation
    $errors = [];
    $allowed_services = ["Cambio de aceite", "Revisión general", "Cambio de neumáticos", "Reparación de frenos", "Otro"];

    if (!in_array($servicio, $allowed_services)) {
        $errors[] = "Servicio no válido.";
    }

    if (strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        $errors[] = "La fecha de inicio no puede ser posterior a la fecha de fin.";
    }

    if (strtotime($fecha_inicio) < strtotime(date('Y-m-d'))) {
        $errors[] = "La fecha de inicio no puede ser en el pasado.";
    }

    // Check if vehicle belongs to user
    $stmt_check = $conexion->prepare("SELECT id_vehiculo FROM vehiculos WHERE id_vehiculo=? AND id_cliente=?");
    $stmt_check->bind_param("ii", $id_vehiculo, $cliente_id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows == 0) {
        $errors[] = "Vehículo no encontrado o no pertenece al usuario.";
    }

    // Check for overlapping reservations
    $stmt_overlap = $conexion->prepare("SELECT id_reserva FROM reservas WHERE id_vehiculo=? AND ((fecha_inicio <= ? AND fecha_fin >= ?) OR (fecha_inicio <= ? AND fecha_fin >= ?)) AND estado != 'Cancelada'");
    $stmt_overlap->bind_param("issss", $id_vehiculo, $fecha_fin, $fecha_inicio, $fecha_inicio, $fecha_fin);
    $stmt_overlap->execute();
    if ($stmt_overlap->get_result()->num_rows > 0) {
        $errors[] = "Ya existe una reserva para este vehículo en las fechas seleccionadas.";
    }

    if (!empty($errors)) {
        echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
        exit;
    }

    $stmt = $conexion->prepare("INSERT INTO reservas (id_cliente, id_vehiculo, fecha_inicio, fecha_fin, servicio, estado) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $cliente_id, $id_vehiculo, $fecha_inicio, $fecha_fin, $servicio, $estado);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Reserva creada exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al crear reserva: " . $stmt->error]);
    }
    exit;
}

if (isset($_POST["update_reservation"])) {
    $id_reserva = $_POST["id_reserva"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $servicio = $_POST["servicio"];
    $estado = $_POST["estado"];

    // Validation
    $errors = [];
    $allowed_services = ["Cambio de aceite", "Revisión general", "Cambio de neumáticos", "Reparación de frenos", "Otro"];
    $allowed_states = ["Pendiente", "Confirmada", "Completada", "Cancelada"];

    if (!in_array($servicio, $allowed_services)) {
        $errors[] = "Servicio no válido.";
    }

    if (!in_array($estado, $allowed_states)) {
        $errors[] = "Estado no válido.";
    }

    if (strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        $errors[] = "La fecha de inicio no puede ser posterior a la fecha de fin.";
    }

    if (strtotime($fecha_inicio) < strtotime(date('Y-m-d'))) {
        $errors[] = "La fecha de inicio no puede ser en el pasado.";
    }

    // Check if reservation belongs to user
    $stmt_check = $conexion->prepare("SELECT id_reserva FROM reservas WHERE id_reserva=? AND id_cliente=?");
    $stmt_check->bind_param("ii", $id_reserva, $_SESSION['id_usuario']);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows == 0) {
        $errors[] = "Reserva no encontrada o no pertenece al usuario.";
    }

    if (!empty($errors)) {
        echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
        exit;
    }

    $stmt = $conexion->prepare("UPDATE reservas SET fecha_inicio=?, fecha_fin=?, servicio=?, estado=? WHERE id_reserva=?");
    $stmt->bind_param("ssssi", $fecha_inicio, $fecha_fin, $servicio, $estado, $id_reserva);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Reserva actualizada exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar reserva: " . $stmt->error]);
    }
    exit;
}

if (isset($_POST["delete_reservation"])) {
    $id_reserva = $_POST["id_reserva"];

    // Validation
    $errors = [];

    // Check if reservation belongs to user
    $stmt_check = $conexion->prepare("SELECT id_reserva FROM reservas WHERE id_reserva=? AND id_cliente=?");
    $stmt_check->bind_param("ii", $id_reserva, $_SESSION['id_usuario']);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows == 0) {
        $errors[] = "Reserva no encontrada o no pertenece al usuario.";
    }

    if (!empty($errors)) {
        echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM reservas WHERE id_reserva=?");
    $stmt->bind_param("i", $id_reserva);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Reserva eliminada exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar reserva: " . $stmt->error]);
    }
    exit;
}
?>

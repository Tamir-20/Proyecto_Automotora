<?php
include("../Comercial/session_check.php"); // Valida sesión
include("../Comercial/config.php");        // Conexión DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicio = trim($_POST['servicio'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');

    if (empty($servicio) || empty($fecha)) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos.']);
        exit;
    }

    $id_cliente = $_SESSION['id_usuario'];

    $stmt = $conexion->prepare("INSERT INTO solicitudes_servicio (id_cliente, servicio, fecha_solicitud) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id_cliente, $servicio, $fecha);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id_solicitud' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear solicitud.']);
    }
}
?>

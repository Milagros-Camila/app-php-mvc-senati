<?php
// Controlador AgendaController.php
class AgendaController {
    public function index() {
        include 'views/layouts/header.php';
        include 'views/agenda/index.php';  // La vista de la agenda
        include 'views/layouts/footer.php';
    }
}

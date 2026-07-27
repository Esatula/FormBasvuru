<?php
// app/Controllers/BaseController.php

namespace App\Controllers;

class BaseController {

    protected function checkAuth() {
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            $this->redirect('/login');
        }
    }

    protected function redirect($path) {
        header('Location: ' . url($path));
        exit();
    }

    /**
     * Session'a flash mesaj ekler.
     * @param string $type Mesaj tipi (success, error, info).
     * @param string $text Gösterilecek mesaj.
     */
    protected function setFlash($type, $text) {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'text' => $text
        ];
    }

    /**
     * Header, footer ve ana view dosyasını yükler.
     */
    public function view($viewName, $data = []) {
        extract($data);

        require_once __DIR__ . "/../Views/partials/header.view.php";
        require_once __DIR__ . "/../Views/{$viewName}.view.php";
        require_once __DIR__ . "/../Views/partials/footer.view.php";
    }
}
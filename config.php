<?php
    // Dados de conexão ao banco
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'id20507025_taxidojair');
    define('DB_USER', 'id20507025_admin');
    define('DB_PASSWORD', 'WWH96Fb#rP65vnA');
    define('DB_CHARSET', 'utf8');

    mysqli_report(MYSQLI_REPORT_STRICT);

    function open_database() {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            return $conn;
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';

            return null;
        }
    }

    function close_database($conn) {
        try {
            mysqli_close($conn);
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
?>
<?php

class ResetController {
    public static function resetDatabase() {
        $pdo = Flight::db();
        
        try {
            $pdo->beginTransaction();
            $pdo->exec("DELETE FROM BNGRC_donation WHERE id_donation > 10");
            $pdo->exec("DELETE FROM BNGRC_besoin WHERE id_besoin > 10");
            
            $pdo->commit();
            
            Flight::redirect('/');
        } catch (Exception $e) {
            $pdo->rollBack();
            Flight::error($e);
        }
    }
}

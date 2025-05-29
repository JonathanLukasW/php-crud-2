<?php
use App\Database\TransactionDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionDao = new TransactionDAO();
    $transactionDao->delete($id);
    header('Location: /transactions');
}

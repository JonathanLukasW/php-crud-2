<?php
use App\Database\TransactionDAO;
use App\Database\UserDAO;

$transactionDao = new TransactionDAO();
$userDao = new UserDAO();
$transaction = $transactionDao->get($id);
$user = $userDao->get($transaction->getUserId());
?>

<h2>Transaction Detail</h2>
<a href="/transactions">Back to List</a><br><br>

<table>
    <tr><th>ID</th><td><?= $transaction->getId() ?></td></tr>
    <tr><th>User</th><td><?= $user ? $user->getName() : 'Unknown' ?></td></tr>
    <tr><th>Amount</th><td><?= $transaction->getAmount() ?></td></tr>
    <tr><th>Type</th><td><?= $transaction->getTransactionType() ?></td></tr>
    <tr><th>Created At</th><td><?= $transaction->getCreatedAt() ?></td></tr>
</table>

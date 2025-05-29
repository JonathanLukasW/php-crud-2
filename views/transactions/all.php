<?php
use App\Database\TransactionDAO;
use App\Database\UserDAO;

$transactionDao = new TransactionDAO();
$userDao = new UserDAO();
$users = [];
foreach ($userDao->all() as $user) {
    $users[$user->getId()] = $user->getName();
}
$transactions = $transactionDao->all();
?>

<h2>Transaction List</h2>
<a href="/transactions/create">Create New Transaction</a><br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($transactions as $tx): ?>
        <tr>
            <td><?= $tx->getId() ?></td>
            <td><?= $users[$tx->getUserId()] ?? 'Unknown' ?></td>
            <td><?= $tx->getAmount() ?></td>
            <td><?= $tx->getTransactionType() ?></td>
            <td><?= $tx->getCreatedAt() ?></td>
            <td>
                <a href="/transactions/<?= $tx->getId() ?>">Lihat</a> |
                <a href="/transactions/<?= $tx->getId() ?>/edit">Ubah</a> |
                <form action="/transactions/<?= $tx->getId() ?>/delete" method="POST" style="display:inline">
                    <button type="submit" style="background:none;border:none;color:blue;text-decoration:underline;cursor:pointer;">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

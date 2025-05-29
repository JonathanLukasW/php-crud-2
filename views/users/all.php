<?php
use App\Database\UserDAO;

$userDao = new UserDAO();
$users = $userDao->all();
?>

<h2>User List</h2>
<table style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
    <a href="/users/create">Create New User</a>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getCreatedAt() ?></td>
            <td><?= $user->getBalance() ?></td>
            <td><a href="/users/<?= $user->getId() ?>">Lihat</a> <a href="/users/<?= $user->getId() ?>/edit">Ubah</a> <form action="/users/<?= $user->getId() ?>/delete" method="POST">
    <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; font:inherit; padding:0;">
        Hapus
    </button>
</form></td>
        </tr>
        <?php endforeach ?>
        
    </tbody>
</table>


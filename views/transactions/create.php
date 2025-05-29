<?php
use App\Database\UserDAO;
use App\Database\TransactionDAO;
use App\Models\Transaction;

$userDao = new UserDAO();
$users = $userDao->all();

$user_id = '';
$amount = '';
$transaction_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $transaction_type = $_POST['transaction_type'];

    $transactionDao = new TransactionDAO();
    $transactionDao->create(new Transaction(null, $user_id, $amount, $transaction_type, null));
    header('Location: /transactions');
}
?>

<h2>Create Transaction</h2>
<a href="/transactions">Back to List</a><br><br>

<form method="POST">
    <label for="user_id">User:</label><br>
    <select id="user_id" name="user_id" required>
        <option value="">-- Pilih User --</option>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user->getId() ?>" <?= $user->getId() == $user_id ? 'selected' : '' ?>>
                <?= $user->getName() ?> (<?= $user->getEmail() ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="amount">Amount:</label><br>
    <input type="number" step="0.01" id="amount" name="amount" value="<?= $amount ?>" required><br><br>

    <label for="transaction_type">Transaction Type:</label><br>
    <select id="transaction_type" name="transaction_type" required>
        <option value="">-- Pilih Tipe --</option>
        <option value="deposit" <?= $transaction_type === 'deposit' ? 'selected' : '' ?>>Deposit</option>
        <option value="withdrawal" <?= $transaction_type === 'withdrawal' ? 'selected' : '' ?>>Withdrawal</option>
    </select><br><br>

    <button type="submit">Create</button>
</form>

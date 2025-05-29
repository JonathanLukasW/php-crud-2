<?php
use App\Database\TransactionDAO;
use App\Database\UserDAO;
use App\Models\Transaction;

$transactionDao = new TransactionDAO();
$userDao = new UserDAO();
$transaction = $transactionDao->get($id);
$users = $userDao->all();

$user_id = $transaction->getUserId();
$amount = $transaction->getAmount();
$transaction_type = $transaction->getTransactionType();
$created_at = $transaction->getCreatedAt();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $created_at = date('Y-m-d H:i:s', strtotime($_POST['created_at']));
    $transactionDao->updateDateOnly($id, $created_at);
    header('Location: /transactions');
    exit;
}
?>

<h2>Edit Transaction</h2>
<a href="/transactions">Back to List</a><br><br>

<form method="POST">
    <label for="user_id">User:</label><br>
    <select id="user_id" name="user_id" disabled>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user->getId() ?>" <?= $user->getId() == $user_id ? 'selected' : '' ?>>
                <?= $user->getName() ?> (<?= $user->getEmail() ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="amount">Amount:</label><br>
    <input type="number" step="0.01" id="amount" name="amount" value="<?= $amount ?>" readonly><br><br>

    <label for="transaction_type">Transaction Type:</label><br>
    <select id="transaction_type" name="transaction_type" disabled>
        <option value="deposit" <?= $transaction_type === 'deposit' ? 'selected' : '' ?>>Deposit</option>
        <option value="withdrawal" <?= $transaction_type === 'withdrawal' ? 'selected' : '' ?>>Withdrawal</option>
    </select><br><br>

    <label for="created_at">Created At:</label><br>
<input type="datetime-local" id="created_at" name="created_at" value="<?= date('Y-m-d\TH:i', strtotime($created_at)) ?>" required><br><br>


    <button type="submit">Save</button>
</form>

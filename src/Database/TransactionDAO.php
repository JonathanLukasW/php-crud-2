<?php
namespace App\Database;

use App\Models\Transaction;

class TransactionDAO extends Connection
{
    public function all(): array
    {
        $sql = 'SELECT * FROM transactions';
        $data = self::query($sql);
        $transactions = [];

        foreach ($data as $row) {
            $transactions[] = new Transaction($row['id'], $row['user_id'], $row['amount'], $row['transaction_type'], $row['created_at']);
        }
        return $transactions;
    }

    public function get(int $id): ?Transaction
    {
        $sql = 'SELECT * FROM transactions WHERE id = ?';
        $params = [$id];
        $data = self::query($sql, $params);
        if (count($data) > 0) {
            return new Transaction($data[0]['id'], $data[0]['user_id'], $data[0]['amount'], $data[0]['transaction_type'], $data[0]['created_at']);
        }
        return null;
    }

    public function create(Transaction $transaction)
    {
        $stmt = $this->pdo->prepare('INSERT INTO transactions (user_id, amount, transaction_type, created_at) VALUES (?, ?, ?, ?)');
        $stmt->execute([
            $transaction->getUserId(),
            $transaction->getAmount(),
            $transaction->getTransactionType(),
            $transaction->getCreatedAt()
        ]);

        // Update balance user
        $amount = $transaction->getAmount();
        $userId = $transaction->getUserId();
        if ($transaction->getTransactionType() === 'deposit') {
            $this->pdo->prepare('UPDATE users SET balance = balance + ? WHERE id = ?')->execute([$amount, $userId]);
        } elseif ($transaction->getTransactionType() === 'withdrawal') {
            $this->pdo->prepare('UPDATE users SET balance = balance - ? WHERE id = ?')->execute([$amount, $userId]);
        }
    }

    public function update(Transaction $transaction)
    {
        $sql = 'UPDATE transactions SET created_at = ? WHERE id = ?';
        $params = [$transaction->getCreatedAt(), $transaction->getId()];
        return self::query($sql, $params);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM transactions WHERE id = ?';
        $params = [$id];

        return self::query($sql, $params);
    }

    public function updateDateOnly($id, $created_at)
    {
        $stmt = $this->pdo->prepare('UPDATE transactions SET created_at = ? WHERE id = ?');
        $stmt->execute([$created_at, $id]);
    }
}

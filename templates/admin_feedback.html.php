<h1>Feedback from Users</h1>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Feedback</th>
        <th>Date Submitted</th>
    </tr>
    <?php foreach ($feedbacks as $feedback): ?>
        <tr>
            <td><?= htmlspecialchars($feedback['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($feedback['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($feedback['name'] ? $feedback['name'] : 'Guest User', ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($feedback['feedback_message'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($feedback['time'], ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
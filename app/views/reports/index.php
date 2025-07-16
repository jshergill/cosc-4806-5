<?php require_once 'app/views/templates/header.php'; ?>

<main class="container mt-5">
    <h2 class="mb-4">Reports</h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            All Reminders
        </div>
        <div class="card-body">
            <?php if (!empty($data['all_reminders'])): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Subject</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['all_reminders'] as $reminder): ?>
                            <tr>
                                <td><?= htmlspecialchars($reminder['user_id']) ?></td>
                                <td><?= htmlspecialchars($reminder['username'])?></td>
                                <td><?= htmlspecialchars($reminder['subject']) ?></td>
                                <td><?= htmlspecialchars($reminder['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No reminders found.</p>
            <?php endif; ?>
        </div>
    </div>

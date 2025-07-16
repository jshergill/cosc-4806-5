<?php require_once 'app/views/templates/header.php'; ?>

<main class="container mt-5">
    <h2 class="mb-4">Reports</h2>

    <div class="card mb-4">
        <div class="card-header text-black">
          <strong> Reminders </strong> 
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
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header backgroundcolor-black text-white">
          <strong>  User with highest Reminders</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($data['user_with_most_reminders'])): ?>
                <p><strong><?= htmlspecialchars($data['user_with_most_reminders']['username']) ?></strong> with <strong><?= $data['user_with_most_reminders']['total'] ?></strong> reminders.</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <strong>Total Logins</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($data['get_login_counts'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Total Logins by users</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['get_login_counts'] as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= $row['total'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
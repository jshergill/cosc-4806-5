<?php require_once 'app/views/templates/header.php'; ?>
<main class="container mt-5 mb-5" style="max-width: 1000px;">

    
    <div class="text-center mb-5">
        <h2 class="fw-semibold display-6"> Reports</h2>
       
    </div>

    
    <div class="card shadow-sm rounded-4 border-0 mb-5">
        <div class="card-header bg-white fw-bold fs-5 text-dark border-0 py-3 rounded-top-4">
            All Reminders
        </div>
        <div class="card-body p-4">
            <?php if (!empty($data['all_reminders'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">User&nbsp;ID</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['all_reminders'] as $reminder): ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($reminder['user_id']) ?></td>
                                    
                                    <td>
                                        <span class="badge bg-dark text-light px-3 py-2 rounded-pill">
                                            <?= htmlspecialchars($reminder['subject']) ?>
                                        </span>
                                    </td>
                                    <td class="text-muted"><?= htmlspecialchars($reminder['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center rounded-pill">
                    No reminders found.
                </div>
            <?php endif; ?>
        </div>
    </div>

   
    <div class="card shadow-sm rounded-4 border-0 mb-5">
        <div class="card-header bg-white fw-bold fs-5 text-dark border-0 py-3 rounded-top-4">
             User with Most Reminders
        </div>
        <div class="card-body p-4 text-center">
            <?php if (!empty($data['user_with_most_reminders'])): ?>
                <p class="fs-5 mb-0">
                    <span class="badge bg-dark text-light px-4 py-2 rounded-pill">
                        <?= htmlspecialchars($data['user_with_most_reminders']['username']) ?>
                        <?= htmlspecialchars($data['user_id_with_most_reminders']['user_id']) ?>
                    </span>
                    <br>
                    <small class="text-muted">has</small>
                    <strong class="text-success"><?= (int)$data['user_with_most_reminders']['total'] ?></strong>
                    reminders.
                </p>
            <?php else: ?>
                <div class="alert alert-info rounded-pill">No data available.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card shadow-sm rounded-4 border-0 mb-5">
        <div class="card-header bg-white fw-bold fs-5 text-dark border-0 py-3 rounded-top-4">
             Total Logins by User
        </div>
        <div class="card-body p-4">

            <?php if (!empty($data['get_login_counts'])): ?>
                <div class="table-responsive mb-4">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Username</th>
                                <th>All Attempts</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['get_login_counts'] as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                   
                                    <td class="text-muted"><?= (int)$row['total_attempts'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center rounded-pill">
                    No login attempts found.
                </div>
            <?php     endif; ?>
            
    
            <div class="card shadow-sm rounded-4 border-0 mb-4">
                <div class="card-header bg-white fw-semibold fs-5 text-dark border-0 py-3 rounded-top-4">
                  <strong>  Login Attempt Visualization</strong>
                </div>
                <div class="card-body text-center" style="background:#f9f9f9; height:300px;">
                    <canvas id="Chart" style="width:100%; height:100%;"></canvas>
                </div>
            </div>
            </main>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function(){

                const el = document.getElementById('Chart');
                if (!el) return;
                const ctx = el.getContext('2d');

                // PHP → JS data (raw)
                const rawData = <?= json_encode($data['get_login_counts'] ?? [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT); ?>;

                // Labels
                const labels = rawData.map(r => r.username);

                // Value resolution: prefer total_attempts, then total_logins, then total
                const values = rawData.map(r => {
                    const v = (r.total_attempts ?? r.total_logins ?? r.total ?? 0);
                    return Number(v);
                });

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Total Logins',
                            data: values,
                            backgroundColor: 'rgba(0,0,0,0.85)',   
                            borderWidth: 0,
                            borderRadius: 8,
                            maxBarThickness: 48
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#333',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                cornerRadius: 8,
                                callbacks: {
                                    label: ctx => ` ${ctx.parsed.y} login${ctx.parsed.y === 1 ? '' : 's'}`
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: {
                                    color: '#333',
                                    font: { size: 14, family: 'SF Pro Text, Helvetica, Arial' }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: '#eee' },
                                ticks: {
                                    color: '#333',
                                    stepSize: 1,
                                    font: { size: 14, family: 'SF Pro Text, Helvetica, Arial' }
                                }
                            }
                        }
                    }
                });
            });
            </script>



<?php require_once 'app/views/templates/footer.php'; ?>

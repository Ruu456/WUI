<?php
$students = [
    ['id' => '20241001', 'name' => 'Ayu Rahma', 'generation' => '2021', 'status' => 'Sudah disubmit'],
    ['id' => '20241002', 'name' => 'Budi Santoso', 'generation' => '2021', 'status' => 'Belum disubmit'],
    ['id' => '20241003', 'name' => 'Citra Lestari', 'generation' => '2022', 'status' => 'Sudah disubmit'],
    ['id' => '20241004', 'name' => 'Dewi Putri', 'generation' => '2022', 'status' => 'Tidak berlaku'],
    ['id' => '20241005', 'name' => 'Eko Prasetyo', 'generation' => '2020', 'status' => 'Sudah disubmit'],
];

$search = strtolower(trim($_GET['search'] ?? ''));
$statusFilter = $_GET['status'] ?? 'Semua';
$filteredStudents = array_filter($students, function ($student) use ($search, $statusFilter) {
    $matchesSearch = $search === '' || strpos(strtolower($student['id'] . ' ' . $student['name'] . ' ' . $student['generation']), $search) !== false;
    $matchesStatus = $statusFilter === 'Semua' || $student['status'] === $statusFilter;
    return $matchesSearch && $matchesStatus;
});

$submittedCount = count(array_filter($students, fn ($student) => $student['status'] === 'Sudah disubmit'));
$pendingCount = count(array_filter($students, fn ($student) => $student['status'] === 'Belum disubmit'));
$invalidCount = count(array_filter($students, fn ($student) => $student['status'] === 'Tidak berlaku'));

function statusClass(string $status): string
{
    return match ($status) {
        'Sudah disubmit' => 'submitted',
        'Belum disubmit' => 'pending',
        default => 'invalid',
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pengajuan Skripsi</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f7fb; color: #1f2937; }
        .page { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { margin-bottom: 22px; }
        h1 { margin: 0 0 8px; color: #111827; font-size: 28px; }
        .subtitle { margin: 0; color: #6b7280; }
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 22px; }
        .summary-card, .panel { background: #fff; border-radius: 10px; box-shadow: 0 5px 16px rgba(0,0,0,.07); }
        .summary-card { padding: 18px; border-left: 5px solid #2563eb; }
        .summary-card.pending-card { border-left-color: #f59e0b; }
        .summary-card.invalid-card { border-left-color: #dc2626; }
        .summary-card span { display: block; color: #6b7280; font-size: 13px; margin-bottom: 8px; }
        .summary-card strong { color: #111827; font-size: 28px; }
        .panel { padding: 22px; }
        .toolbar { display: flex; justify-content: space-between; gap: 14px; align-items: center; margin-bottom: 18px; }
        .toolbar h2 { margin: 0; color: #111827; font-size: 20px; }
        form { display: flex; gap: 8px; flex-wrap: wrap; }
        input, select, button { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; }
        input { min-width: 220px; }
        button { background: #2563eb; color: #fff; border-color: #2563eb; cursor: pointer; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { color: #374151; background: #f9fafb; font-size: 12px; text-transform: uppercase; }
        .status { display: inline-block; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .submitted { background: #dcfce7; color: #166534; }
        .pending { background: #fef3c7; color: #92400e; }
        .invalid { background: #fee2e2; color: #991b1b; }
        .empty { padding: 24px 0; text-align: center; color: #6b7280; }
        @media (max-width: 700px) { .summary { grid-template-columns: 1fr; } .toolbar { align-items: flex-start; flex-direction: column; } input { min-width: 0; width: 100%; } table { min-width: 620px; } .table-wrap { overflow-x: auto; } }
    </style>
</head>
<body>
    <main class="page">
        <header class="header">
            <h1>List Pengajuan Skripsi</h1>
            <p class="subtitle">Monitoring pengajuan proposal skripsi mahasiswa.</p>
        </header>

        <section class="summary" aria-label="Submission summary">
            <div class="summary-card"><span>Sudah disubmit</span><strong><?= $submittedCount ?></strong></div>
            <div class="summary-card pending-card"><span>Belum disubmit</span><strong><?= $pendingCount ?></strong></div>
            <div class="summary-card invalid-card"><span>Tidak berlaku</span><strong><?= $invalidCount ?></strong></div>
        </section>

        <section class="panel">
            <div class="toolbar">
                <h2>Daftar Pengajuan</h2>
                <form method="get">
                    <input type="search" name="search" placeholder="Cari nama atau NIM" value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
                    <select name="status">
                        <?php foreach (['Semua', 'Sudah disubmit', 'Belum disubmit', 'Tidak berlaku'] as $option): ?>
                            <option value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>" <?= $statusFilter === $option ? 'selected' : '' ?>><?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>

            <div class="table-wrap">
                <?php if ($filteredStudents): ?>
                    <table>
                        <thead><tr><th>NIM</th><th>Nama Mahasiswa</th><th>Angkatan</th><th>Status Proposal</th></tr></thead>
                        <tbody>
                            <?php foreach ($filteredStudents as $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($student['generation'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><span class="status <?= statusClass($student['status']) ?>"><?= htmlspecialchars($student['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="empty">Data pengajuan tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

<?php
$students = [
    [
        'id' => '20241001',
        'name' => 'Ayu Rahma',
        'generation' => '2021',
        'status' => 'Aktif',
        'thesis_proposal' => 'Sudah disubmit',
        'subjects' => [
            ['name' => 'Algoritma', 'score' => 92],
            ['name' => 'Basis Data', 'score' => 88],
            ['name' => 'Pemrograman Web', 'score' => 95],
            ['name' => 'Matematika Diskrit', 'score' => 90],
            ['name' => 'Jaringan Komputer', 'score' => 87],
        ]
    ],
    [
        'id' => '20241002',
        'name' => 'Budi Santoso',
        'generation' => '2021',
        'status' => 'Cuti',
        'thesis_proposal' => 'Belum disubmit',
        'subjects' => [
            ['name' => 'Algoritma', 'score' => 80],
            ['name' => 'Basis Data', 'score' => 82],
            ['name' => 'Pemrograman Web', 'score' => 84],
            ['name' => 'Matematika Diskrit', 'score' => 78],
            ['name' => 'Jaringan Komputer', 'score' => 79],
        ]
    ],
    [
        'id' => '20241003',
        'name' => 'Citra Lestari',
        'generation' => '2022',
        'status' => 'Aktif',
        'thesis_proposal' => 'Sudah disubmit',
        'subjects' => [
            ['name' => 'Algoritma', 'score' => 94],
            ['name' => 'Basis Data', 'score' => 90],
            ['name' => 'Pemrograman Web', 'score' => 96],
            ['name' => 'Matematika Diskrit', 'score' => 91],
            ['name' => 'Jaringan Komputer', 'score' => 88],
        ]
    ],
    [
        'id' => '20241004',
        'name' => 'Dewi Putri',
        'generation' => '2022',
        'status' => 'Drop Out',
        'thesis_proposal' => 'Tidak berlaku',
        'subjects' => [
            ['name' => 'Algoritma', 'score' => 60],
            ['name' => 'Basis Data', 'score' => 65],
            ['name' => 'Pemrograman Web', 'score' => 58],
            ['name' => 'Matematika Diskrit', 'score' => 63],
            ['name' => 'Jaringan Komputer', 'score' => 66],
        ]
    ],
    [
        'id' => '20241005',
        'name' => 'Eko Prasetyo',
        'generation' => '2020',
        'status' => 'Aktif',
        'thesis_proposal' => 'Sudah disubmit',
        'subjects' => [
            ['name' => 'Algoritma', 'score' => 88],
            ['name' => 'Basis Data', 'score' => 86],
            ['name' => 'Pemrograman Web', 'score' => 89],
            ['name' => 'Matematika Diskrit', 'score' => 82],
            ['name' => 'Jaringan Komputer', 'score' => 85],
        ]
    ],
];

$search = strtolower(trim($_GET['search'] ?? ''));
$selectedId = $_GET['student_id'] ?? $students[0]['id'];

$filteredStudents = [];

foreach ($students as $student) {
    if ($search === '') {
        $filteredStudents[] = $student;
        continue;
    }

    $haystack = strtolower($student['id'] . ' ' . $student['name'] . ' ' . $student['generation']);
    if (strpos($haystack, $search) !== false) {
        $filteredStudents[] = $student;
    }
}

if (empty($filteredStudents)) {
    $selectedStudent = null;
} else {
    $selectedStudent = null;

    foreach ($filteredStudents as $student) {
        if ($student['id'] === $selectedId) {
            $selectedStudent = $student;
            break;
        }
    }

    if ($selectedStudent === null) {
        $selectedStudent = $filteredStudents[0];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .page {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .panel {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            padding: 24px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 28px;
            margin: 0;
            color: #111827;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box input {
            width: 260px;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        .search-box button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .table-wrap {
            overflow-x: auto;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
            color: #374151;
            font-size: 13px;
            text-transform: uppercase;
        }

        tr:hover {
            background: #f8fafc;
        }

        .student-link {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 600;
        }

        .student-link:hover {
            text-decoration: underline;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-aktif { background: #dcfce7; color: #166534; }
        .status-cuti { background: #fef3c7; color: #92400e; }
        .status-drop-out { background: #fee2e2; color: #991b1b; }

        .detail-card {
            background: #f8fafc;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 22px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
        }

        .detail-label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }

        .subjects-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .subjects-table th,
        .subjects-table td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            text-align: left;
        }

        .subjects-table th {
            background: #eef2ff;
            color: #3730a3;
        }

        .no-result {
            padding: 16px;
            color: #6b7280;
            text-align: center;
            background: #f9fafb;
            border: 1px dashed #d1d5db;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="panel">
            <div class="topbar">
                <h1 class="title">List Mahasiswa</h1>

                <form method="GET" class="search-box">
                    <input
                        type="text"
                        name="search"
                        value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Cari nama atau NIM..."
                    >
                    <button type="submit">Cari</button>
                </form>
            </div>

            <?php if (empty($filteredStudents)): ?>
                <div class="no-result">
                    Tidak ada data mahasiswa yang sesuai dengan pencarian.
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filteredStudents as $student): ?>
                                <?php
                                    $statusClass = strtolower(str_replace(' ', '-', $student['status']));
                                ?>
                                <tr>
                                    <td>
                                        <a
                                            class="student-link"
                                            href="?search=<?php echo urlencode($search); ?>&student_id=<?php echo urlencode($student['id']); ?>"
                                        >
                                            <?php echo htmlspecialchars($student['id']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            class="student-link"
                                            href="?search=<?php echo urlencode($search); ?>&student_id=<?php echo urlencode($student['id']); ?>"
                                        >
                                            <?php echo htmlspecialchars($student['name']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($student['generation']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo htmlspecialchars($statusClass, ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php echo htmlspecialchars($student['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($selectedStudent): ?>
                    <div class="detail-card">
                        <h2 style="margin-top:0; margin-bottom:18px;">Detail Mahasiswa</h2>

                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">NIM</span>
                                <span class="detail-value"><?php echo htmlspecialchars($selectedStudent['id']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Nama</span>
                                <span class="detail-value"><?php echo htmlspecialchars($selectedStudent['name']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Angkatan</span>
                                <span class="detail-value"><?php echo htmlspecialchars($selectedStudent['generation']); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-value"><?php echo htmlspecialchars($selectedStudent['status']); ?></span>
                            </div>
                        </div>

                        <div class="detail-item" style="margin-bottom: 20px;">
                            <span class="detail-label">Proposal Skripsi</span>
                            <span class="detail-value"><?php echo htmlspecialchars($selectedStudent['thesis_proposal']); ?></span>
                        </div>

                        <h3 style="margin:0 0 10px;">Nilai per Mata Kuliah</h3>
                        <table class="subjects-table">
                            <thead>
                                <tr>
                                    <th>Mata Kuliah</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($selectedStudent['subjects'] as $subject): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($subject['name']); ?></td>
                                        <td><?php echo htmlspecialchars($subject['score']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
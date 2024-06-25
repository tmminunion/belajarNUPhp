<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .page_break { page-break-before: always; }
    </style>
</head>

<body>
    <h1>First Page</h1>
<p>This content will appear on the first page.</p>

<div class="page_break"></div>

    <h2>Laporan Donasi</h2>
    <h3>Total Kredit: <?php echo e($totals->total_kredit); ?> | Total Debit: <?php echo e($totals->total_debit); ?> | Saldo Akhir: <?php echo e($totals->saldo_akhir); ?> | Saldo per Anggota: <?php echo e($saldo_per_anggota); ?></h3>

    <!-- Tabel Transaksi Kredit -->
    <table>
        <caption>Transaksi Kredit</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>NOMER</th>
                <th>Transaksi</th>
                <th>Noreg</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php $__currentLoopData = $transactions->where('type', 'kredit'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($no++); ?></td>
                <td><?php echo e($transaction->judul); ?></td>
                <td><?php echo e($transaction->type); ?></td>
                <td><?php echo e($transaction->member->noreg); ?></td>
                <td><?php echo e($transaction->member->nama); ?></td>
                <td><?php echo e($transaction->status); ?></td>
                <td><?php echo e($transaction->jumlah); ?></td>
                <td><?php echo e($transaction->date); ?></td>
                <td><?php echo e($transaction->keterangan); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Tabel Transaksi Debit -->
    <table>
        <caption>Transaksi Debit</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>NOMER</th>
                <th>Transaksi</th>
                <th>Noreg</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php $__currentLoopData = $transactions->where('type', 'debit'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($no++); ?></td>
                <td><?php echo e($transaction->judul); ?></td>
                <td><?php echo e($transaction->type); ?></td>
                <td><?php echo e($transaction->member->noreg); ?></td>
                <td><?php echo e($transaction->member->nama); ?></td>
                <td><?php echo e($transaction->status); ?></td>
                <td><?php echo e($transaction->jumlah); ?></td>
                <td><?php echo e($transaction->date); ?></td>
                <td><?php echo e($transaction->keterangan); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<div class="page_break"></div>

     <h1>First Page</h1>
<p>This content will appear on the first page.</p>


</body>

</html>
<?php /**PATH C:\laragon\www\kas\templates/pdf/donasi.blade.php ENDPATH**/ ?>
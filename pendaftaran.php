<section>
    <h2>Form Pendaftaran</h2>

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success">Pendaftaran berhasil diproses dan disimpan ke session.</div>
    <?php endif; ?>

    <?php include 'frm_pendaftaran.php'; ?>
</section>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-file-earmark-plus me-2"></i>Ajukan Legalisir</h5>
    </div>
    <div class="card-body p-4">
        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
        <?= form_open_multipart('legalisir/create') ?>

        <div class="mb-3">
            <label class="form-label fw-semibold">Scan Ijazah (PDF) <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="diploma" accept="application/pdf" required>
            <small class="text-muted">Upload scan ijazah Anda dalam format PDF.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah Lembar Legalisir <span class="text-danger">*</span></label>
            <input class="form-control" type="number" min="1" max="50" name="quantity" placeholder="Contoh: 5">
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Catatan (opsional)</label>
            <textarea class="form-control" name="notes" rows="3" placeholder="Catatan tambahan untuk petugas..."></textarea>
        </div>

        <div class="d-grid gap-2 d-md-flex">
            <button class="btn btn-primary px-4" type="submit">
                <i class="bi bi-send me-1"></i> Kirim Pengajuan
            </button>
            <a href="<?= site_url('legalisir') ?>" class="btn btn-outline-secondary">Kembali</a>
        </div>

        <?= form_close() ?>
    </div>
</div>

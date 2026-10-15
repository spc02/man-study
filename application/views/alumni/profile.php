<div class="card">
    <div class="card-body">
        <?=form_open('alumni/profile')?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input class="form-control" type="text" name="nik" value="<?=html_escape($alumni['nik'])?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" value="<?=html_escape($alumni['email'])?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="L" <?= $alumni['gender'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= $alumni['gender'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">No. HP</label>
                <input class="form-control" type="text" name="phone" value="<?=html_escape($alumni['phone'])?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat Lahir</label>
                <input class="form-control" type="text" name="birth_place" value="<?=html_escape($alumni['birth_place'])?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input class="form-control" type="date" name="birth_date" value="<?=html_escape($alumni['birth_date'])?>">
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" name="address" rows="2"><?=html_escape($alumni['address'])?></textarea>
            </div>
            
            <div class="col-12"><hr class="mt-2 mb-2"></div>
            
            <div class="col-md-4">
                <label class="form-label">Jurusan</label>
                <select name="jurusan_id" class="form-select" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <?php foreach($jurusan as $j): ?>
                        <option value="<?=$j['id']?>" <?= $alumni['jurusan_id'] == $j['id'] ? 'selected' : '' ?>><?=html_escape($j['name'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun Lulus</label>
                <select name="tahun_lulus_id" class="form-select" required>
                    <option value="">-- Pilih Tahun Lulus --</option>
                    <?php foreach($tahun as $t): ?>
                        <option value="<?=$t['id']?>" <?= $alumni['tahun_lulus_id'] == $t['id'] ? 'selected' : '' ?>><?=html_escape($t['name'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Status Saat Ini</label>
                <select name="status_alumni_id" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <?php foreach($status as $s): ?>
                        <option value="<?=$s['id']?>" <?= $alumni['status_alumni_id'] == $s['id'] ? 'selected' : '' ?>><?=html_escape($s['name'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 mt-4">
                <button class="btn btn-primary">Simpan Profil</button>
            </div>
        </div>
        <?=form_close()?>
    </div>
</div>

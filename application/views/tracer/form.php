<style>
    /* Radio Card Styling */
    .radio-card-wrapper {
        position: relative;
        display: block;
        height: 100%;
        cursor: pointer;
    }
    .radio-card-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .radio-card {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        transition: all 0.2s ease;
        height: 100%;
        background: white;
    }
    .radio-card:hover {
        border-color: #94a3b8;
        background: #f8fafc;
    }
    .radio-card-input:checked + .radio-card {
        border-color: var(--primary);
        background: rgba(25, 135, 84, 0.05);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.1);
    }
    .radio-card-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #cbd5e1;
        position: relative;
        margin-bottom: 12px;
    }
    .radio-card-input:checked + .radio-card .radio-card-indicator {
        border-color: var(--primary);
    }
    .radio-card-input:checked + .radio-card .radio-card-indicator::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        background: var(--primary);
        border-radius: 50%;
    }
    
    /* Stepper Styling */
    .stepper-item {
        position: relative;
        padding-left: 3rem;
        margin-bottom: 2rem;
    }
    .stepper-item:last-child {
        margin-bottom: 0;
    }
    .stepper-item::before {
        content: '';
        position: absolute;
        left: 1.2rem;
        top: 2rem;
        bottom: -2rem;
        width: 2px;
        background: #e2e8f0;
    }
    .stepper-item:last-child::before {
        display: none;
    }
    .stepper-circle {
        position: absolute;
        left: 0;
        top: 0;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #64748b;
        z-index: 1;
        border: 2px solid white;
        transition: all 0.3s;
    }
    .stepper-item.active .stepper-circle {
        background: var(--primary);
        color: white;
    }
    .stepper-item.completed .stepper-circle {
        background: #dcfce7;
        color: #15803d;
    }
    .stepper-item.active::before {
        background: #dcfce7;
    }
    .stepper-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0;
        line-height: 1.2;
    }
    .stepper-desc {
        font-size: 0.8rem;
        color: #94a3b8;
    }
    
    /* Circular Progress */
    .circular-progress {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(var(--primary) calc(var(--progress) * 1%), #f1f5f9 0deg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    .circular-progress::before {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
    }
    .progress-value {
        position: relative;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .progress-value span {
        font-size: 0.75rem;
        font-weight: 500;
        color: #64748b;
        margin-top: -5px;
    }
</style>

<div class="d-flex align-items-center mb-4">
    <a href="<?= site_url('dashboard') ?>" class="btn btn-link text-dark p-0 me-3"><i class="bi bi-arrow-left fs-4"></i></a>
    <h3 class="fw-bold mb-0"><?= isset($is_update) && $is_update ? 'Perbarui Tracer Study' : 'Isi Tracer Study' ?></h3>
</div>

<div class="row g-4">
    <!-- Sidebar Stepper -->
    <div class="col-lg-3">
        <div class="card shadow-sm border-0 mb-4 sticky-top" style="top: 2rem;">
            <div class="card-body p-4">
                <?php if(isset($is_update) && $is_update && isset($existing_answers[1])): ?>
                    <h6 class="fw-bold text-center mb-4">Status Anda Saat Ini</h6>
                    <div class="text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-check-fill" style="font-size: 2.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1" id="currentStatusText"><?= html_escape($existing_answers[1]) ?></h5>
                        <span class="badge bg-light text-secondary border px-3 py-2 mt-2 rounded-pill">Data Telah Diisi</span>
                    </div>
                <?php else: ?>
                    <h6 class="fw-bold text-center mb-4">Progres Pengisian</h6>
                    <div class="circular-progress mb-5" id="progressChart" style="--progress: 0;">
                        <div class="progress-value">
                            <div id="progressText">0%</div>
                            <span>Selesai</span>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($is_update) && $is_update): ?>
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold mb-4 text-center">Detail Jawaban Anda</h6>
                        <div style="max-height: 450px; overflow-y: auto; padding-right: 10px;">
                            <?php foreach($grouped_questions as $cat => $questions): ?>
                                <?php 
                                $has_answer = false;
                                foreach($questions as $q) {
                                    if (isset($existing_answers[$q['id']]) && $existing_answers[$q['id']] !== '') {
                                        $has_answer = true;
                                        break;
                                    }
                                }
                                if ($has_answer): 
                                ?>
                                <div class="mb-4 bg-light p-3 rounded-3">
                                    <strong class="text-success small d-block mb-2 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;"><i class="bi bi-bookmarks me-1"></i> <?= html_escape($cat) ?></strong>
                                    <?php foreach($questions as $q): ?>
                                        <?php if(isset($existing_answers[$q['id']]) && $existing_answers[$q['id']] !== ''): ?>
                                            <div class="mb-2">
                                                <span class="text-secondary d-block" style="font-size: 0.75rem; line-height: 1.3;"><?= html_escape($q['question']) ?></span>
                                                <span class="text-dark fw-semibold" style="font-size: 0.85rem;"><?= html_escape($existing_answers[$q['id']]) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="stepper-container">
                        <?php 
                        $step_idx = 1; 
                        foreach($grouped_questions as $cat => $questions): 
                        ?>
                        <div class="stepper-item <?= $step_idx === 1 ? 'active' : '' ?>" id="stepper_nav_<?= $step_idx ?>">
                            <div class="stepper-circle"><?= $step_idx ?></div>
                            <p class="stepper-title"><?= html_escape($cat) ?></p>
                            <span class="stepper-desc" id="stepper_desc_<?= $step_idx ?>"><?= $step_idx === 1 ? 'Sedang diisi' : 'Belum diisi' ?></span>
                        </div>
                        <?php $step_idx++; endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-primary bg-primary bg-opacity-10 border-0 d-flex align-items-start gap-2 mt-4 mb-0 p-3 rounded-3">
                    <i class="bi bi-info-circle text-primary"></i>
                    <small class="text-primary-emphasis" style="font-size: 0.75rem;">Data yang Anda isi bersifat rahasia dan hanya digunakan untuk keperluan pengembangan madrasah.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Content -->
    <div class="col-lg-9">
        <?=form_open('tracer', array('id' => 'tracerForm'))?>
        
        <?php 
        $step_idx = 1; 
        $total_steps = count($grouped_questions);
        foreach($grouped_questions as $cat => $questions): 
        ?>
            <div class="step-content" id="step_content_<?= $step_idx ?>" <?= $step_idx > 1 ? 'style="display:none;"' : '' ?>>
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle">
                                <i class="bi bi-clipboard2-check-fill fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0"><?= html_escape($cat) ?></h4>
                                <p class="text-muted small mb-0">Lengkapi pertanyaan pada bagian ini dengan benar.</p>
                            </div>
                        </div>
                        <hr class="text-muted opacity-25">
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="alert alert-success bg-success bg-opacity-10 border border-success border-opacity-25 d-flex justify-content-between p-3 rounded-3 mb-4">
                            <div class="d-flex gap-2">
                                <i class="bi bi-lightbulb-fill text-success"></i>
                                <div>
                                    <h6 class="text-success fw-bold mb-1" style="font-size: 0.85rem;">Petunjuk Pengisian</h6>
                                    <p class="mb-0 text-success-emphasis small">Pilih atau isi jawaban yang paling sesuai dengan kondisi Anda saat ini.</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php foreach($questions as $q): ?>
                            <?php 
                            $parent_attr = !empty($q['parent_id']) ? 'data-parent="'.$q['parent_id'].'" data-parent-value="'.htmlspecialchars($q['parent_value']).'"' : '';
                            $display = !empty($q['parent_id']) ? 'style="display:none;"' : '';
                            ?>
                            <div class="mb-5 question-block" data-id="<?=$q['id']?>" <?= $parent_attr ?> <?= $display ?>>
                                <h6 class="fw-bold mb-3"><?=html_escape($q['question'])?></h6>
                                
                                <?php 
                                $o=array_filter(array_map('trim',explode('|',(string)$q['options']))); 
                                $val = isset($existing_answers[$q['id']]) ? $existing_answers[$q['id']] : '';
                                $val_arr = $val !== '' ? array_map('trim', explode(',', (string)$val)) : array();
                                ?>
                                
                                <?php if($q['type']==='radio'): ?>
                                    <div class="row g-3">
                                        <?php foreach($o as $idx => $v): ?>
                                            <div class="col-md-6 col-lg-4">
                                                <label class="radio-card-wrapper">
                                                    <input type="radio" class="radio-card-input q-input q-required" name="q_<?=$q['id']?>" value="<?= html_escape($v) ?>" <?= ($val === trim($v)) ? 'checked' : '' ?>>
                                                    <div class="radio-card">
                                                        <div class="radio-card-indicator"></div>
                                                        <p class="fw-bold text-dark mb-1" style="font-size: 0.9rem;"><?= html_escape($v) ?></p>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php elseif($q['type']==='checkbox'): ?>
                                    <div class="row g-3">
                                        <?php foreach($o as $idx => $v): ?>
                                            <div class="col-md-6">
                                                <label class="radio-card-wrapper">
                                                    <input type="checkbox" class="radio-card-input q-input" name="q_<?=$q['id']?>[]" value="<?= html_escape($v) ?>" <?= in_array(trim($v), $val_arr) ? 'checked' : '' ?>>
                                                    <div class="radio-card d-flex align-items-center gap-3">
                                                        <div class="radio-card-indicator" style="border-radius: 6px; margin-bottom: 0;"></div>
                                                        <span class="fw-semibold text-dark"><?= html_escape($v) ?></span>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php elseif($q['type']==='select'): ?>
                                    <select class="form-select form-select-lg q-input q-required border-light-subtle" name="q_<?=$q['id']?>">
                                        <option value="">-- Pilih salah satu --</option>
                                        <?php foreach($o as $v): ?>
                                            <option value="<?= html_escape($v) ?>" <?= ($val === trim($v)) ? 'selected' : '' ?>><?= html_escape($v) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php elseif($q['type']==='textarea'): ?>
                                    <textarea class="form-control q-input border-light-subtle" name="q_<?=$q['id']?>" rows="4" placeholder="Tuliskan jawaban Anda di sini..."><?= html_escape($val) ?></textarea>
                                <?php else: ?>
                                    <input class="form-control form-control-lg q-input border-light-subtle" type="<?=$q['type']==='number'?'number':($q['type']==='date'?'date':'text')?>" name="q_<?=$q['id']?>" placeholder="Jawaban Anda" value="<?= html_escape($val) ?>">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="alert alert-primary bg-primary bg-opacity-10 border-0 d-flex align-items-center gap-2 p-3 mt-4 rounded-3">
                            <i class="bi bi-info-circle-fill text-primary"></i>
                            <small class="text-primary-emphasis mb-0">Jawaban Anda pada beberapa pertanyaan dapat menentukan pertanyaan selanjutnya.</small>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between justify-content-md-end gap-3 mt-2">
                    <?php if($step_idx > 1): ?>
                        <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-semibold btn-prev" data-target="<?= $step_idx - 1 ?>">
                            <i class="bi bi-arrow-left me-2"></i> Sebelumnya
                        </button>
                    <?php endif; ?>
                    
                    <?php if($step_idx < $total_steps): ?>
                        <button type="button" class="btn btn-success px-4 py-2 fw-semibold btn-next" data-target="<?= $step_idx + 1 ?>">
                            Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold shadow-sm">
                            <?= isset($is_update) && $is_update ? 'Perbarui Kuesioner' : 'Kirim Kuesioner' ?> <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php $step_idx++; endforeach; ?>
        
        <?=form_close()?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const totalSteps = <?= $total_steps ?>;

    // STEP-to-CATEGORY mapping (must match the order from PHP $grouped_questions)
    // Step 1 = Status Alumni, Step 2 = Pendidikan Lanjutan, Step 3 = Pekerjaan
    // Step 4 = Wirausaha, Step 5 = Evaluasi Sekolah, Step 6 = Masukan Alumni
    // Categories that are ALWAYS shown (not conditional):
    const ALWAYS_SHOWN_STEPS = [1, <?= $total_steps - 1 ?>, <?= $total_steps ?>]; // Status Alumni, Evaluasi Sekolah, Masukan Alumni

    // Step categories that are CONDITIONAL — only shown if this activity value is selected
    // This maps: step_index -> required activity value from question 1 (id=1)
    const CONDITIONAL_STEPS = {
        <?php
        $sidx = 1;
        $cond_entries = [];
        foreach($grouped_questions as $cat => $qlist) {
            // Check if the FIRST question in this step has parent_id = 1
            // This defines the dependency for the whole category
            if (count($qlist) > 0 && !empty($qlist[0]['parent_id']) && $qlist[0]['parent_id'] == 1) {
                $pval = $qlist[0]['parent_value'];
                $cond_entries[] = "        {$sidx}: " . json_encode($pval);
            }
            $sidx++;
        }
        echo implode(",\n", $cond_entries);
        ?>
    };

    let currentStep = 1;

    function getActivityValue() {
        // Question 1 (id=1) is always the first question: "Apa aktivitas utama Anda saat ini?"
        let checked = document.querySelector('input[name="q_1"]:checked');
        return checked ? checked.value : null;
    }

    function isStepVisible(stepIdx) {
        if (ALWAYS_SHOWN_STEPS.includes(stepIdx)) return true;
        if (CONDITIONAL_STEPS[stepIdx] !== undefined) {
            let activity = getActivityValue();
            return activity === CONDITIONAL_STEPS[stepIdx];
        }
        return true; // If not conditional, show it
    }

    function getNextValidStep(from) {
        for (let i = from + 1; i <= totalSteps; i++) {
            if (isStepVisible(i)) return i;
        }
        return totalSteps;
    }

    function getPrevValidStep(from) {
        for (let i = from - 1; i >= 1; i--) {
            if (isStepVisible(i)) return i;
        }
        return 1;
    }

    function showStep(stepIdx) {
        document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
        let target = document.getElementById('step_content_' + stepIdx);
        if (target) target.style.display = 'block';
        currentStep = stepIdx;
        window.scrollTo({top: 0, behavior: 'smooth'});
        updateStepperAndProgress();
    }

    function updateStepperAndProgress() {
        let visibleSteps = [];
        for (let i = 1; i <= totalSteps; i++) {
            if (isStepVisible(i)) visibleSteps.push(i);
        }

        let currentValidIndex = visibleSteps.indexOf(currentStep);
        if (currentValidIndex === -1) currentValidIndex = 0;

        let percentage = 0;
        if (visibleSteps.length > 1) {
            percentage = Math.round((currentValidIndex / (visibleSteps.length - 1)) * 100);
        }
        if (percentage > 100) percentage = 100;

        let pChart = document.getElementById('progressChart');
        let pText = document.getElementById('progressText');
        if (pChart) pChart.style.setProperty('--progress', percentage);
        if (pText) pText.innerText = percentage + '%';

        let cStatus = document.getElementById('currentStatusText');
        let activity = getActivityValue();
        if (cStatus && activity) {
            cStatus.innerText = activity;
        }

        // Update Stepper - only show visible steps
        let displayIndex = 1;
        for (let i = 1; i <= totalSteps; i++) {
            let item = document.getElementById('stepper_nav_' + i);
            let desc = document.getElementById('stepper_desc_' + i);
            if (!item || !desc) continue;

            if (!visibleSteps.includes(i)) {
                item.style.display = 'none';
                continue;
            }

            item.style.display = 'block';
            let circle = item.querySelector('.stepper-circle');
            let stepValidIdx = visibleSteps.indexOf(i);

            item.classList.remove('active', 'completed');

            if (stepValidIdx < currentValidIndex) {
                item.classList.add('completed');
                desc.innerText = 'Selesai';
                if (circle) circle.innerHTML = '<i class="bi bi-check-lg"></i>';
            } else if (i === currentStep) {
                item.classList.add('active');
                desc.innerText = 'Sedang diisi';
                if (circle) circle.innerText = displayIndex;
            } else {
                desc.innerText = 'Belum diisi';
                if (circle) circle.innerText = displayIndex;
            }
            displayIndex++;
        }
    }

    // Show/hide dependent questions within a step
    function evaluateLogic() {
        let values = {};
        document.querySelectorAll('.q-input').forEach(function(input) {
            let name = input.name.replace('[]', '');
            let id = name.replace('q_', '');
            if (input.type === 'radio' || input.type === 'checkbox') {
                if (input.checked) {
                    if (!values[id]) values[id] = [];
                    values[id].push(input.value);
                }
            } else {
                if (input.value) values[id] = [input.value];
            }
        });

        document.querySelectorAll('.question-block[data-parent]').forEach(function(block) {
            let pid = block.getAttribute('data-parent');
            let pval = block.getAttribute('data-parent-value');
            let shouldShow = values[pid] && values[pid].includes(pval);

            if (shouldShow) {
                block.style.display = 'block';
                block.querySelectorAll('.q-input').forEach(i => i.disabled = false);
            } else {
                block.style.display = 'none';
                block.querySelectorAll('.q-input').forEach(i => {
                    i.disabled = true;
                    if (i.type === 'radio' || i.type === 'checkbox') i.checked = false;
                    else i.value = '';
                });
            }
        });

        // After evaluateLogic, update stepper because visible steps may have changed
        updateStepperAndProgress();
    }

    // Navigation buttons
    document.querySelectorAll('.btn-next').forEach(btn => {
        btn.addEventListener('click', function() {
            let next = getNextValidStep(currentStep);
            showStep(next);
        });
    });

    document.querySelectorAll('.btn-prev').forEach(btn => {
        btn.addEventListener('click', function() {
            let prev = getPrevValidStep(currentStep);
            showStep(prev);
        });
    });

    // Listen for changes on all inputs
    document.querySelectorAll('.q-input').forEach(function(input) {
        input.addEventListener('change', function() {
            evaluateLogic();
            setTimeout(evaluateLogic, 50);
        });
        if (input.tagName === 'INPUT' && (input.type === 'text' || input.type === 'number')) {
            input.addEventListener('keyup', updateStepperAndProgress);
        }
    });

    // Initial run
    evaluateLogic();
    showStep(1);
});
</script>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
            /* Prevent text selection */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            /* Prevent drag and drop */
            -webkit-user-drag: none;
            -khtml-user-drag: none;
            -moz-user-drag: none;
            -o-user-drag: none;
            user-drag: none;
            /* Prevent image dragging */
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: transparent;
        }

        .cat-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        .navigation-panel {
            width: 300px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: left 0.3s, transform 0.3s;
            z-index: 1050;
        }

        .navigation-panel.hide-nav {
            left: -300px;
            transform: translateX(-100%);
        }

        @media (max-width: 991.98px) {
            .cat-container {
                flex-direction: column;
            }
            .navigation-panel {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 80vw;
                max-width: 320px;
                box-shadow: 2px 0 10px rgba(0,0,0,0.2);
                background: #2c3e50;
                transform: translateX(-100%);
                transition: transform 0.3s;
                z-index: 1050;
            }
            .navigation-panel.show-nav {
                transform: translateX(0);
            }
            .main-content {
                width: 100vw;
            }
            .toggle-nav-btn {
                display: block;
            }
        }

        .toggle-nav-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: #34495e;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            font-size: 22px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .close-nav-btn {
            display: none;
        }

        @media (max-width: 991.98px) {
            .close-nav-btn {
                display: block;
                background: none;
                border: none;
                color: #fff;
                font-size: 28px;
                position: absolute;
                top: 10px;
                right: 15px;
                z-index: 1101;
            }
        }

        .main-content {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header-bar {
            background: #34495e;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .timer-display {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 18px;
        }

        .question-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .question-navigation {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .question-number {
            width: 40px;
            height: 40px;
            border: 2px solid #bdc3c7;
            background: white;
            color: #2c3e50;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .question-number:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .question-number.answered {
            background: #27ae60;
            color: white;
            border-color: #27ae60;
        }

        .question-number.marked {
            background: #f39c12;
            color: white;
            border-color: #f39c12;
        }

        .question-number.current {
            background: #3498db;
            color: white;
            border-color: #3498db;
            transform: scale(1.1);
        }

        .question-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .question-header {
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .question-text {
            font-size: 18px;
            line-height: 1.6;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .option-item {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-item:hover {
            background: #e3f2fd;
            border-color: #2196f3;
        }

        .option-item.selected {
            background: #e8f5e8;
            border-color: #4caf50;
            color: #2e7d32;
        }

        .control-buttons {
            background: #ecf0f1;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-cat {
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cat:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .legend {
            margin-top: 20px;
            padding: 15px;
            background: #34495e;
            border-radius: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            margin-right: 10px;
        }

        .question-image {
            text-align: center;
            margin: 20px 0;
        }

        .question-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .navigation-panel {
                width: 250px;
            }

            .question-area {
                padding: 15px;
            }

            .header-bar {
                padding: 10px 15px;
            }

            .timer-display {
                font-size: 14px;
                padding: 8px 15px;
            }
        }

        @media (max-width: 991.98px) {
            .control-buttons {
                position: static;
                width: 100%;
                background: none;
                box-shadow: none;
                padding: 0;
                flex-direction: row;
                gap: 0;
            }
            .btn-cat {
                width: 48vw;
                max-width: 180px;
                font-size: 1.1rem;
                margin-bottom: 0 !important;
            }
            .question-area {
                padding-bottom: 20px !important;
            }
        }

        @media (max-width: 575.98px) {
            .btn-cat {
                width: 100%;
                max-width: none;
                font-size: 1rem;
                margin-bottom: 8px;
            }
            .control-buttons {
                flex-direction: column;
                gap: 8px;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<?php
$waktu_mulai = isset($applicant_assessment->waktu_mulai) ? strtotime($applicant_assessment->waktu_mulai) : null;
$now_server = time();
?>
<button class="toggle-nav-btn d-lg-none" id="toggleNavBtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>
<div class="cat-container">
    <!-- Navigation Panel -->
    <div class="navigation-panel" id="navigationPanel">
        <button class="close-nav-btn d-lg-none" id="closeNavBtn" onclick="toggleNav()"><i class="fas fa-times"></i></button>
        <div class="text-center mb-4">
            <h5 class="mb-1"><?= $assessment->judul ?></h5>
            <small class="text-light">Soal <?= $question_number ?> dari <?= $total_questions ?></small>
        </div>

        <div class="question-navigation" id="questionNavigation">
            <?php for ($i = 1; $i <= $total_questions; $i++): ?>
                <div class="question-number <?= $i == $question_number ? 'current' : '' ?>"
                     data-question="<?= $i ?>"
                     onclick="navigateToQuestion(<?= $i ?>)">
                    <?= $i ?>
                </div>
            <?php endfor; ?>
        </div>

        <div class="legend">
            <div class="legend-item">
                <div class="legend-color" style="background: #27ae60;"></div>
                <span>Sudah Dijawab</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #f39c12;"></div>
                <span>Ditandai Ragu</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #3498db;"></div>
                <span>Soal Aktif</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: white; border: 2px solid #bdc3c7;"></div>
                <span>Belum Dijawab</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header Bar -->
        <div class="header-bar">
            <div>
                <h6 class="mb-0">Ujian CAT - <?= $assessment->judul ?></h6>
            </div>
            <div class="timer-display" id="assessmentTimer" data-time-limit="<?= $assessment->batas_waktu ?>">
                <i class="fas fa-clock me-2"></i>
                <span id="timeRemaining">--:--</span>
            </div>
        </div>

        <!-- Question Area -->
        <div class="question-area">
            <?php if ($current_question): ?>
                <div class="question-card">
                    <div class="question-header">
                        <h6 class="text-primary mb-2">Pertanyaan <?= $question_number ?></h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-info">Poin: <?= $current_question->poin ?></span>
                            <span class="badge bg-secondary"><?= ucfirst(str_replace('_', ' ', $current_question->jenis_soal)) ?></span>
                        </div>
                    </div>

                    <!-- Question Image -->
                    <?php if (!empty($current_question->gambar_soal)): ?>
                        <div class="question-image">
                            <img src="<?= base_url('uploads/gambar_soal/' . $current_question->gambar_soal) ?>"
                                 class="question-img"
                                 alt="Gambar Soal <?= $question_number ?>"
                                 onclick="showImageModal(this.src)">
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                            </small>
                        </div>
                    <?php endif; ?>

                    <!-- Question Text -->
                    <div class="question-text">
                        <?= nl2br(htmlspecialchars($current_question->teks_soal)) ?>
                    </div>

                    <!-- Answer Options -->
                    <div id="answerArea">
                        <?php if ($current_question->jenis_soal == 'pilihan_ganda'): ?>
                            <?php foreach ($current_question->options as $option): ?>
                                <div class="option-item <?= $current_question->id_pilihan_terpilih == $option->id ? 'selected' : '' ?>"
                                     data-option-id="<?= $option->id ?>"
                                     onclick="selectOption(<?= $option->id ?>)">
                                    <i class="fas fa-circle me-2"></i>
                                    <?= htmlspecialchars($option->teks_pilihan) ?>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif ($current_question->jenis_soal == 'esai'): ?>
                            <textarea class="form-control"
                                      id="essayAnswer"
                                      rows="8"
                                      placeholder="Tulis jawaban Anda di sini..."
                                      onchange="saveEssayAnswer()"><?= htmlspecialchars($current_question->teks_jawaban ?? '') ?></textarea>
                        <?php endif; ?>
                    </div>
                    <div class="control-buttons mt-4">
                        <div>
                            <?php if ($question_number > 1): ?>
                                <button class="btn btn-secondary btn-cat" onclick="navigateToQuestion(<?= $question_number - 1 ?>)">
                                    <i class="fas fa-chevron-left me-2"></i>Sebelumnya
                                </button>
                            <?php endif; ?>
                        </div>
                        <div>
                            <button class="btn btn-warning btn-cat me-2" id="markButton" onclick="toggleMarkQuestion()">
                                <i class="fas fa-flag me-2"></i>
                                <span id="markText"><?= $current_question->ditandai_ragu ? 'Batal Ragu' : 'Tandai Ragu' ?></span>
                            </button>
                            <?php if ($question_number < $total_questions): ?>
                                <button class="btn btn-primary btn-cat" onclick="navigateToQuestion(<?= $question_number + 1 ?>)">
                                    Selanjutnya<i class="fas fa-chevron-right ms-2"></i>
                                </button>
                            <?php else: ?>
                                <button class="btn btn-success btn-cat" onclick="showSubmitConfirmation()">
                                    <i class="fas fa-check me-2"></i>Selesai
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <h4 class="text-secondary">Soal tidak ditemukan</h4>
                    <p class="text-muted">Terjadi kesalahan dalam memuat soal.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Hidden form for submission -->
<form id="submitForm" action="<?= base_url('pelamar/kirim-penilaian-cat') ?>" method="post" style="display: none;">
    <input type="hidden" name="assessment_id" value="<?= $assessment->id ?>">
    <input type="hidden" name="application_id" value="<?= $application_id ?>">
    <input type="hidden" name="applicant_assessment_id" value="<?= $applicant_assessment->id ?>">
</form>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

<script>
    
    const assessmentId = <?= $assessment->id ?>;
    const applicationId = <?= $application_id ?>;
    const applicantAssessmentId = <?= $applicant_assessment->id ?>;
    const currentQuestionNumber = <?= $question_number ?>;
    const totalQuestions = <?= $total_questions ?>;
    const currentQuestionId = <?= $current_question ? $current_question->id : 0 ?>;
    const questionType = '<?= $current_question ? $current_question->jenis_soal : '' ?>';
    let isMarkedDoubtful = <?= $current_question && $current_question->ditandai_ragu ? 'true' : 'false' ?>;

    // Tambahkan di awal script
    const securityViolationKey = 'cat_security_violation_count_<?= isset($application_id) ? $application_id : 'ujian' ?>';
    localStorage.setItem(securityViolationKey, '0');
    let securityViolationCount = 0;

    const waktuMulai = <?= $waktu_mulai ? $waktu_mulai : 'null' ?>;
    const nowServer = <?= $now_server ?>;
    const batasWaktu = <?= $assessment->batas_waktu ?> * 60; // detik
    let timeRemaining = waktuMulai ? (waktuMulai + batasWaktu) - nowServer : batasWaktu;

    let isExamActive = true;
    let focusLossTimeout = null;
    let focusLossInterval = null;
    let focusLossCountdownActive = false;

    document.addEventListener('DOMContentLoaded', function() {
        initializeTimer();
        updateNavigationStatus();
        preventBrowserActions();
    });

    
    function initializeTimer() {
        const timerElement = document.getElementById('assessmentTimer');
        const timerInterval = setInterval(function() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            document.getElementById('timeRemaining').textContent =
                String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            if (timeRemaining <= 300) {
                timerElement.style.background = '#e74c3c';
                timerElement.style.animation = 'pulse 1s infinite';
            }
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                autoSubmitAssessment();
            }
            timeRemaining--;
        }, 1000);
    }

    
    function navigateToQuestion(questionNumber) {
        if (questionNumber < 1 || questionNumber > totalQuestions) return;

        
        saveCurrentAnswer();

        
        loadQuestionAjax(questionNumber);
    }

    function loadQuestionAjax(questionNumber) {
        
        Swal.fire({
            title: 'Memuat Soal...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        
        fetch(`<?= base_url('pelamar/get-question-cat') ?>`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `applicant_assessment_id=${applicantAssessmentId}&question_number=${questionNumber}`
        })
        .then(response => response.json())
        .then(data => {
            Swal.close();

            if (data.status === 'success') {
                
                updateQuestionContent(data.question, questionNumber);

                
                const newUrl = `<?= base_url('pelamar/cat-penilaian/') ?>${assessmentId}/${applicationId}/${questionNumber}`;
                window.history.pushState({questionNumber: questionNumber}, '', newUrl);

                
                updateNavigationStatus();
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'Gagal memuat soal',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.close();
            console.error('Error:', error);

            
            allowNavigation = true;
            window.location.href = `<?= base_url('pelamar/cat-penilaian/') ?>${assessmentId}/${applicationId}/${questionNumber}`;
        });
    }

    function updateQuestionContent(question, questionNumber) {
        
        currentQuestionId = question.id;
        questionType = question.jenis_soal;
        isMarkedDoubtful = question.ditandai_ragu ? true : false;

        
        document.querySelector('.text-center small').textContent = `Soal ${questionNumber} dari ${totalQuestions}`;

        
        document.querySelectorAll('.question-number').forEach(btn => {
            btn.classList.remove('current');
        });
        document.querySelector(`[data-question="${questionNumber}"]`).classList.add('current');

        
        document.querySelector('.question-header h6').textContent = `Pertanyaan ${questionNumber}`;
        document.querySelector('.badge.bg-info').textContent = `Poin: ${question.poin}`;
        document.querySelector('.badge.bg-secondary').textContent = question.jenis_soal.replace('_', ' ').toUpperCase();

        
        const questionImageDiv = document.querySelector('.question-image');
        if (question.gambar_soal) {
            if (!questionImageDiv) {
                
                const imageDiv = document.createElement('div');
                imageDiv.className = 'question-image';
                imageDiv.innerHTML = `
                    <img src="<?= base_url('uploads/gambar_soal/') ?>${question.gambar_soal}"
                         class="question-img"
                         alt="Gambar Soal ${questionNumber}"
                         onclick="showImageModal(this.src)">
                    <small class="text-muted d-block mt-2">
                        <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                    </small>
                `;
                document.querySelector('.question-text').parentNode.insertBefore(imageDiv, document.querySelector('.question-text'));
            } else {
                questionImageDiv.innerHTML = `
                    <img src="<?= base_url('uploads/gambar_soal/') ?>${question.gambar_soal}"
                         class="question-img"
                         alt="Gambar Soal ${questionNumber}"
                         onclick="showImageModal(this.src)">
                    <small class="text-muted d-block mt-2">
                        <i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar
                    </small>
                `;
            }
        } else if (questionImageDiv) {
            questionImageDiv.remove();
        }

        
        document.querySelector('.question-text').innerHTML = question.teks_soal.replace(/\n/g, '<br>');

        
        const answerArea = document.getElementById('answerArea');
        if (question.jenis_soal === 'pilihan_ganda') {
            let optionsHtml = '';
            question.options.forEach(option => {
                const selected = question.id_pilihan_terpilih == option.id ? 'selected' : '';
                optionsHtml += `
                    <div class="option-item ${selected}"
                         data-option-id="${option.id}"
                         onclick="selectOption(${option.id})">
                        <i class="fas fa-circle me-2"></i>
                        ${option.teks_pilihan}
                    </div>
                `;
            });
            answerArea.innerHTML = optionsHtml;
        } else if (question.jenis_soal === 'esai') {
            answerArea.innerHTML = `
                <textarea class="form-control"
                          id="essayAnswer"
                          rows="8"
                          placeholder="Tulis jawaban Anda di sini..."
                          onchange="saveEssayAnswer()">${question.teks_jawaban || ''}</textarea>
            `;
        }

        
        const markText = document.getElementById('markText');
        markText.textContent = isMarkedDoubtful ? 'Batal Ragu' : 'Tandai Ragu';

        
        const prevButton = document.querySelector('.btn-secondary.btn-cat');
        const nextButton = document.querySelector('.btn-primary.btn-cat, .btn-success.btn-cat');

        if (prevButton) {
            if (questionNumber > 1) {
                prevButton.style.display = 'inline-block';
                prevButton.setAttribute('onclick', `navigateToQuestion(${questionNumber - 1})`);
            } else {
                prevButton.style.display = 'none';
            }
        }

        if (nextButton) {
            if (questionNumber < totalQuestions) {
                nextButton.className = 'btn btn-primary btn-cat';
                nextButton.innerHTML = 'Selanjutnya<i class="fas fa-chevron-right ms-2"></i>';
                nextButton.setAttribute('onclick', `navigateToQuestion(${questionNumber + 1})`);
            } else {
                nextButton.className = 'btn btn-success btn-cat';
                nextButton.innerHTML = '<i class="fas fa-check me-2"></i>Selesai';
                nextButton.setAttribute('onclick', 'showSubmitConfirmation()');
            }
        }
    }

    function updateNavigationStatus() {
        fetch('<?= base_url('pelamar/dapatkan-status-navigasi-cat') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `applicant_assessment_id=${applicantAssessmentId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateNavigationButtons(data.data);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateNavigationButtons(statusData) {
        statusData.forEach(item => {
            const button = document.querySelector(`[data-question="${item.urutan}"]`);
            if (button) {
                button.classList.remove('answered', 'marked');

                if (item.dijawab) {
                    button.classList.add('answered');
                }

                if (item.ditandai_ragu) {
                    button.classList.add('marked');
                }
            }
        });
    }

    
    function selectOption(optionId) {
        
        document.querySelectorAll('.option-item').forEach(item => {
            item.classList.remove('selected');
        });

        
        document.querySelector(`[data-option-id="${optionId}"]`).classList.add('selected');

        
        saveAnswer('pilihan_ganda', optionId);
    }

    function saveEssayAnswer() {
        const textAnswer = document.getElementById('essayAnswer').value;
        saveAnswer('esai', null, textAnswer);
    }

    function saveCurrentAnswer() {
        if (questionType === 'pilihan_ganda') {
            const selectedOption = document.querySelector('.option-item.selected');
            if (selectedOption) {
                const optionId = selectedOption.getAttribute('data-option-id');
                saveAnswer('pilihan_ganda', optionId);
            }
        } else if (questionType === 'esai') {
            const textAnswer = document.getElementById('essayAnswer').value;
            if (textAnswer.trim()) {
                saveAnswer('esai', null, textAnswer);
            }
        }
    }

    function saveAnswer(answerType, selectedOption = null, textAnswer = null) {
        const formData = new FormData();
        formData.append('applicant_assessment_id', applicantAssessmentId);
        formData.append('question_id', currentQuestionId);
        formData.append('answer_type', answerType);

        if (selectedOption) {
            formData.append('selected_option', selectedOption);
        }

        if (textAnswer) {
            formData.append('text_answer', textAnswer);
        }

        fetch('<?= base_url('pelamar/simpan-jawaban-cat') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateNavigationStatus();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    
    function toggleMarkQuestion() {
        isMarkedDoubtful = !isMarkedDoubtful;

        fetch('<?= base_url('pelamar/tandai-ragu-cat') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `applicant_assessment_id=${applicantAssessmentId}&question_id=${currentQuestionId}&ragu=${isMarkedDoubtful ? 1 : 0}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('markText').textContent = isMarkedDoubtful ? 'Batal Ragu' : 'Tandai Ragu';
                updateNavigationStatus();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function preventBrowserActions() {
        
        document.addEventListener('contextmenu', e => {
            e.preventDefault();
            return false;
        });

        
        document.addEventListener('keydown', function(e) {
            
            if (e.key === 'F12' ||
                (e.ctrlKey && e.shiftKey && e.key === 'I') ||
                (e.ctrlKey && e.shiftKey && e.key === 'C') ||
                (e.ctrlKey && e.shiftKey && e.key === 'J') ||
                (e.ctrlKey && e.key === 'u') ||
                (e.ctrlKey && e.key === 'U')) {
                e.preventDefault();
                showSecurityWarning('Akses developer tools diblokir!');
                return false;
            }

            
            if (e.altKey && e.key === 'Tab') {
                e.preventDefault();
                showSecurityWarning('Pergantian aplikasi diblokir!');
                return false;
            }

            
            if (e.key === 'Meta' || e.key === 'OS' || e.keyCode === 91 || e.keyCode === 92) {
                e.preventDefault();
                showSecurityWarning('Tombol Windows diblokir!');
                return false;
            }

            
            if ((e.ctrlKey && e.altKey && e.key === 'Delete') ||
                (e.ctrlKey && e.shiftKey && e.key === 'Escape')) {
                e.preventDefault();
                showSecurityWarning('Akses task manager diblokir!');
                return false;
            }

            
            if (e.altKey && e.key === 'F4') {
                e.preventDefault();
                showSecurityWarning('Penutupan jendela diblokir!');
                return false;
            }

            
            if (e.key === 'F11') {
                e.preventDefault();
                return false;
            }

            
            if (e.key === 'Escape') {
                e.preventDefault();
                return false;
            }

            
            if (e.ctrlKey && (e.key === 'n' || e.key === 'N' || e.key === 't' || e.key === 'T')) {
                e.preventDefault();
                showSecurityWarning('Pembukaan tab/jendela baru diblokir!');
                return false;
            }

            
            if (e.ctrlKey && (e.key === 'w' || e.key === 'W')) {
                e.preventDefault();
                showSecurityWarning('Penutupan tab diblokir!');
                return false;
            }

            
            if ((e.ctrlKey && (e.key === 'r' || e.key === 'R')) || e.key === 'F5') {
                e.preventDefault();
                showSecurityWarning('Refresh halaman diblokir!');
                return false;
            }

            
            if (e.key === 'PrintScreen') {
                e.preventDefault();
                showSecurityWarning('Screenshot diblokir!');
                return false;
            }
        });

        
        document.addEventListener('visibilitychange', function() {
            if (document.hidden && isExamActive) {
                
                logSecurityViolation('Tab switching detected');

                Swal.fire({
                    title: 'Pelanggaran Keamanan!',
                    text: 'Anda tidak diperbolehkan meninggalkan halaman ujian! Pelanggaran ini telah dicatat.',
                    icon: 'error',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Kembali ke Ujian'
                });
            }
        });

        
        window.addEventListener('blur', function() {
            if (isExamActive) {
                logSecurityViolation('Window lost focus');
                setTimeout(() => {
                    window.focus();
                }, 100);
            }
        });

        
        document.addEventListener('dragstart', function(e) {
            e.preventDefault();
            showSecurityWarning('Drag & drop diblokir!');
            return false;
        });

        document.addEventListener('drop', function(e) {
            e.preventDefault();
            showSecurityWarning('Drop file diblokir!');
            return false;
        });

        document.addEventListener('dragover', function(e) {
            e.preventDefault();
            return false;
        });

        
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
            return false;
        });

        
        document.addEventListener('copy', function(e) {
            e.preventDefault();
            showSecurityWarning('Copy diblokir!');
            return false;
        });

        document.addEventListener('cut', function(e) {
            e.preventDefault();
            showSecurityWarning('Cut diblokir!');
            return false;
        });

        document.addEventListener('paste', function(e) {
            e.preventDefault();
            showSecurityWarning('Paste diblokir!');
            return false;
        });

        
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.addEventListener('dragstart', function(e) {
                    e.preventDefault();
                    return false;
                });
                img.addEventListener('contextmenu', function(e) {
                    e.preventDefault();
                    return false;
                });
            });
        });
    }

    function showSecurityWarning(message) {
        // Tambahkan counter setiap kali peringatan muncul
        securityViolationCount++;
        localStorage.setItem(securityViolationKey, securityViolationCount);

        // Jika sudah 3x, ujian otomatis selesai
        if (securityViolationCount >= 3) {
            Swal.fire({
                icon: 'error',
                title: 'Ujian Dihentikan',
                text: 'Anda telah 3 kali melakukan pelanggaran keamanan. Ujian dihentikan otomatis.',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(() => {
                finishExam('Ujian dihentikan karena pelanggaran keamanan 3x');
            });
            return;
        }

        // Tampilkan warning biasa jika belum 3x
        const warning = document.createElement('div');
        warning.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff4444;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 10000;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        `;
        warning.textContent = message + ` (Peringatan ke-${securityViolationCount}/3)`;
        document.body.appendChild(warning);
        setTimeout(() => {
            if (warning.parentNode) {
                warning.parentNode.removeChild(warning);
            }
        }, 3000);
    }

    function logSecurityViolation(violation) {
        
        fetch('<?= base_url('pelamar/log-security-violation') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `applicant_assessment_id=${applicantAssessmentId}&violation=${encodeURIComponent(violation)}&timestamp=${Date.now()}`
        }).catch(error => console.error('Security log error:', error));
    }

    
    function showImageModal(imageSrc) {
        Swal.fire({
            imageUrl: imageSrc,
            imageAlt: 'Gambar Soal',
            showConfirmButton: false,
            showCloseButton: true,
            width: '80%',
            padding: '1rem'
        });
    }

    
    function showSubmitConfirmation() {
        Swal.fire({
            title: 'Selesaikan Ujian?',
            text: 'Apakah Anda yakin ingin menyelesaikan ujian? Jawaban tidak dapat diubah setelah dikumpulkan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Selesaikan',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                finishExam();
            }
        });
    }

    function autoSubmitAssessment() {
        finishExam('Waktu ujian telah berakhir');
    }

    function finishExam(reason = 'Ujian diselesaikan oleh peserta') {
        
        isExamActive = false;

        
        allowNavigation = true;

        
        logSecurityViolation(`Exam finished: ${reason}`);

        Swal.fire({
            title: reason.includes('Waktu') ? 'Waktu Habis!' : 'Ujian Selesai!',
            text: reason.includes('Waktu') ? 'Waktu ujian telah berakhir. Jawaban akan dikumpulkan secara otomatis.' : 'Terima kasih telah mengikuti ujian. Jawaban Anda akan diproses.',
            icon: reason.includes('Waktu') ? 'warning' : 'success',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(() => {
            saveCurrentAnswer();

            setTimeout(() => {
                document.getElementById('submitForm').submit();
            }, 500);
        });
    }

    function toggleNav() {
        const navPanel = document.getElementById('navigationPanel');
        navPanel.classList.toggle('show-nav');
    }
    // Tutup nav jika klik di luar panel pada mobile
    document.addEventListener('click', function(e) {
        const navPanel = document.getElementById('navigationPanel');
        const toggleBtn = document.getElementById('toggleNavBtn');
        const closeBtn = document.getElementById('closeNavBtn');
        if (window.innerWidth <= 991 && navPanel.classList.contains('show-nav')) {
            if (!navPanel.contains(e.target) && !toggleBtn.contains(e.target) && !closeBtn.contains(e.target)) {
                navPanel.classList.remove('show-nav');
            }
        }
    });
    // Sembunyikan nav saat pindah soal di mobile
    function navigateToQuestion(questionNumber) {
        if (questionNumber < 1 || questionNumber > totalQuestions) return;
        saveCurrentAnswer();
        loadQuestionAjax(questionNumber);
        if (window.innerWidth <= 991) {
            document.getElementById('navigationPanel').classList.remove('show-nav');
        }
    }

    // Gunakan localStorage agar reload tidak mengulang counter
    const pelanggaranKey = 'cat_pelanggaran_count_<?= isset($application_id) ? $application_id : 'ujian' ?>';
    let pelanggaran = parseInt(localStorage.getItem(pelanggaranKey) || '0');

    function logKecuranganCAT() {
        // Kirim ke backend (opsional, untuk log)
        fetch('<?= base_url('pelamar/log_security_violation') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'applicant_assessment_id=<?= isset($applicant_assessment_id) ? $applicant_assessment_id : '' ?>&question_id=&violation=Tab/Window switched&timestamp=' + Date.now()
        });
    }

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            pelanggaran++;
            localStorage.setItem(pelanggaranKey, pelanggaran);
            logKecuranganCAT();
            if (pelanggaran < 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan Kecurangan',
                    text: 'Anda terdeteksi berpindah tab/jendela atau membuka aplikasi lain saat ujian. Jika terjadi 3 kali, ujian akan dihentikan otomatis. (Peringatan ke-' + pelanggaran + '/3)',
                    confirmButtonText: 'Kembali ke Ujian',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ujian Dihentikan',
                    text: 'Anda telah 3 kali terdeteksi melakukan pelanggaran. Ujian dihentikan otomatis.',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(() => {
                    // Submit ujian otomatis (bisa AJAX atau redirect ke endpoint selesai)
                    window.location.href = '<?= base_url('pelamar/kirim_penilaian_cat') ?>';
                });
            }
        }
    });

    // Event tambahan untuk deteksi split-screen/floating app di HP
    window.addEventListener('blur', function() {
        // Perlakuan sama seperti visibilitychange
        securityViolationCount++;
        localStorage.setItem(securityViolationKey, securityViolationCount);
        if (securityViolationCount >= 3) {
            Swal.fire({
                icon: 'error',
                title: 'Ujian Dihentikan',
                text: 'Anda telah 3 kali melakukan pelanggaran keamanan. Ujian dihentikan otomatis.',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(() => {
                finishExam('Ujian dihentikan karena pelanggaran keamanan 3x');
            });
            return;
        }
        showSecurityWarning('Fokus Anda hilang dari browser! (Peringatan ke-' + securityViolationCount + '/3)');
    });

    // Fungsi untuk mulai timer 3 detik saat kehilangan fokus
    function startFocusLossTimer() {
        if (focusLossTimeout || focusLossCountdownActive) return;
        focusLossCountdownActive = true;
        let timeLeft = 3;
        const countdownDiv = document.getElementById('focus-loss-countdown');
        const timerSpan = document.getElementById('focus-loss-timer');
        countdownDiv.style.display = 'block';
        timerSpan.textContent = timeLeft;
        focusLossInterval = setInterval(() => {
            timeLeft--;
            timerSpan.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(focusLossInterval);
                focusLossInterval = null;
                focusLossTimeout = null;
                focusLossCountdownActive = false;
                countdownDiv.style.display = 'none';
                finishExam('Ujian dihentikan karena Anda tidak kembali ke browser dalam 3 detik setelah kehilangan fokus.');
            }
        }, 1000);
        focusLossTimeout = setTimeout(() => {
            if (focusLossInterval) clearInterval(focusLossInterval);
            focusLossTimeout = null;
            focusLossCountdownActive = false;
            countdownDiv.style.display = 'none';
            finishExam('Ujian dihentikan karena Anda tidak kembali ke browser dalam 3 detik setelah kehilangan fokus.');
        }, 3000);
    }

    // Fungsi untuk membatalkan timer jika kembali fokus
    function cancelFocusLossTimer() {
        if (focusLossTimeout) {
            clearTimeout(focusLossTimeout);
            focusLossTimeout = null;
        }
        if (focusLossInterval) {
            clearInterval(focusLossInterval);
            focusLossInterval = null;
        }
        focusLossCountdownActive = false;
        const countdownDiv = document.getElementById('focus-loss-countdown');
        countdownDiv.style.display = 'none';
    }

    // Event kehilangan fokus (blur/visibilitychange)
    window.addEventListener('blur', function() {
        if (typeof isExamActive === 'undefined' || isExamActive === false) return;
        startFocusLossTimer();
    });
    document.addEventListener('visibilitychange', function() {
        if (typeof isExamActive === 'undefined' || isExamActive === false) return;
        if (document.hidden) {
            startFocusLossTimer();
        } else {
            cancelFocusLossTimer();
        }
    });
    window.addEventListener('focus', function() {
        if (typeof isExamActive === 'undefined' || isExamActive === false) return;
        cancelFocusLossTimer();
    });
</script>

<!-- Countdown kehilangan fokus (pojok kanan atas) -->
<div id="focus-loss-countdown" style="display:none; position:fixed; top:20px; right:20px; background:#e74c3c; color:#fff; padding:16px 28px; border-radius:8px; font-size:2rem; font-weight:bold; z-index:9999; box-shadow:0 2px 8px rgba(0,0,0,0.2);">
  Kehilangan fokus! Ujian akan dihentikan dalam <span id="focus-loss-timer">3</span> detik
</div>
</body>
</html>

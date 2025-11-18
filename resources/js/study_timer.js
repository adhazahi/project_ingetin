// resources/js/study_timer.js

document.addEventListener('DOMContentLoaded', () => {
    // --- Konfigurasi Waktu (dalam detik) ---
    const TIME_CONFIG = {
        focus: 25 * 60,
        shortBreak: 5 * 60,
        longBreak: 15 * 60,
    };

    // --- Variabel Status Global ---
    let timeRemaining = TIME_CONFIG.focus;
    let isRunning = false;
    let currentMode = 'focus';
    let intervalId = null;
    let cyclesCompleted = 0;
    let tasks = [];

    // --- Elemen DOM ---
    const timerDisplay = document.getElementById('timer-display');
    const modeStatus = document.getElementById('mode-status');
    const modeDescription = document.getElementById('mode-description');
    const startPauseBtn = document.getElementById('start-pause-btn');
    const resetBtn = document.getElementById('reset-btn');
    const timerApp = document.getElementById('timer-app');
    const modeSelector = document.getElementById('mode-selector');
    const modeTabs = document.querySelectorAll('.mode-tab');

    // Elemen Tugas
    const taskForm = document.getElementById('task-form');
    const newTaskInput = document.getElementById('new-task-input');
    const taskList = document.getElementById('task-list');

    // --- Fungsi Utilitas ---
    const formatTime = (seconds) => {
        const minutes = String(Math.floor(seconds / 60)).padStart(2, '0');
        const secs = String(seconds % 60).padStart(2, '0');
        return `${minutes}:${secs}`;
    };

    // --- MODE SWITCHING CORE ---

    const changeMode = (newMode, auto = false) => {
        if (!auto) {
            pauseTimer();
        }

        currentMode = newMode;
        timeRemaining = TIME_CONFIG[newMode];
        updateDisplay();
    };

    const switchModeAuto = () => {
        if (currentMode === 'focus') {
            cyclesCompleted++;
            let nextMode = (cyclesCompleted % 4 === 0) ? 'longBreak' : 'shortBreak';
            changeMode(nextMode, true);
        } else {
            changeMode('focus', true);
        }

        startTimer();
    };

    const tick = () => {
        if (timeRemaining <= 0) {
            switchModeAuto();
            return;
        }
        timeRemaining--;
        updateDisplay();
    };

    // --- Update UI ---

    const updateDisplay = () => {
        timerDisplay.textContent = formatTime(timeRemaining);
        document.title = `${formatTime(timeRemaining)} | ${currentMode.toUpperCase()} | Inget.in Timer`;

        // Teks dan Warna
        let modeText, modeDesc, textColor, borderColorClass, btnColor;

        switch (currentMode) {
            case 'focus':
                modeText = 'FOKUS';
                modeDesc = 'Waktunya untuk fokus dan produktif!';
                textColor = 'text-blue-800';
                borderColorClass = 'border-blue-300';
                btnColor = 'bg-blue-600 hover:bg-blue-700 active:bg-blue-800';
                break;
            case 'shortBreak':
                modeText = 'JEDA SINGKAT';
                modeDesc = 'Istirahat 5 menit untuk me-refresh diri.';
                textColor = 'text-green-800';
                borderColorClass = 'border-green-300';
                btnColor = 'bg-green-600 hover:bg-green-700 active:bg-green-800';
                break;
            case 'longBreak':
                modeText = 'JEDA PANJANG';
                modeDesc = `Istirahat lebih lama (Siklus ke-${cyclesCompleted} selesai)!`;
                textColor = 'text-red-800';
                borderColorClass = 'border-red-300';
                btnColor = 'bg-red-600 hover:bg-red-700 active:bg-red-800';
                break;
        }

        modeStatus.textContent = modeText;
        modeDescription.textContent = modeDesc;

        // Atur warna border timer
        timerApp.classList.remove('border-blue-300', 'border-green-300', 'border-red-300');
        timerApp.classList.add(borderColorClass);

        modeStatus.className = `text-3xl font-bold ${textColor} tracking-wide transform transition-all duration-300 ease-in-out`;
        modeDescription.className = `text-md mt-2 ${textColor.replace('-800', '-600')}`;

        // Update Button (Start/Pause/Lanjut)
        startPauseBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'active:bg-blue-800',
            'bg-yellow-500', 'hover:bg-yellow-600', 'active:bg-yellow-700',
            'bg-green-600', 'hover:bg-green-700', 'active:bg-green-800',
            'bg-red-600', 'hover:bg-red-700', 'active:bg-red-800',
            'text-white', 'text-gray-900');

        if (isRunning) {
            startPauseBtn.innerHTML = '<i class="fas fa-pause mr-3"></i> Jeda';
            startPauseBtn.classList.add('bg-yellow-500', 'hover:bg-yellow-600', 'active:bg-yellow-700', 'text-gray-900');
        } else {
            const btnText = timeRemaining === TIME_CONFIG[currentMode] ? 'Mulai' : 'Lanjut';
            startPauseBtn.innerHTML = `<i class="fas fa-play mr-3"></i> ${btnText}`;
            startPauseBtn.classList.add(btnColor, 'text-white');
        }

        // Update Tabs (Warna Tab Aktif)
        modeTabs.forEach(tab => {
            tab.classList.remove('bg-blue-600', 'text-white', 'bg-green-600', 'bg-red-600', 'shadow-md', 'hover:bg-opacity-80', 'hover:bg-gray-300');
            tab.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200'); // Default netral

            let activeBgColor;
            if (tab.dataset.mode === 'focus') activeBgColor = 'bg-blue-600 hover:bg-blue-700';
            else if (tab.dataset.mode === 'shortBreak') activeBgColor = 'bg-green-600 hover:bg-green-700';
            else if (tab.dataset.mode === 'longBreak') activeBgColor = 'bg-red-600 hover:bg-red-700';

            if (tab.dataset.mode === currentMode) {
                // Terapkan styling aktif
                tab.classList.add(activeBgColor, 'text-white', 'shadow-md');
                tab.classList.remove('bg-gray-100', 'text-gray-700');
            } else {
                // Terapkan styling hover pada tab non-aktif
                tab.classList.add('hover:bg-gray-300');
            }
        });
    };

    // --- Kontrol Timer ---
    const startTimer = () => {
        if (isRunning) return;
        isRunning = true;
        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(tick, 1000);
        updateDisplay();
    };

    const pauseTimer = () => {
        if (!isRunning) return;
        isRunning = false;
        clearInterval(intervalId);
        updateDisplay();
    };

    const toggleStartPause = () => {
        if (isRunning) {
            pauseTimer();
        } else {
            startTimer();
        }
    };

    const resetTimer = () => {
        pauseTimer();
        timeRemaining = TIME_CONFIG[currentMode];
        updateDisplay();
    };

    // --- Manajemen Tugas (Task Manager) ---
    const saveTasks = () => { localStorage.setItem('ingetin_tasks', JSON.stringify(tasks)); };
    const loadTasks = () => { const storedTasks = localStorage.getItem('ingetin_tasks'); tasks = storedTasks ? JSON.parse(storedTasks) : []; renderTasks(); };

    // FUNGSI RENDER TASKS YANG DIPERBAIKI
    const renderTasks = () => {
        taskList.innerHTML = '';
        if (tasks.length === 0) {
            taskList.innerHTML = '<li class="text-gray-500 text-center py-4">Silakan tambahkan tugas pertama Anda!</li>';
            return;
        }
        let firstActiveTask = null;
        tasks.forEach((task, index) => {
            if (!task.completed && !firstActiveTask) {
                firstActiveTask = task;
                task.active = true;
            } else if (firstActiveTask && firstActiveTask !== task) {
                task.active = false;
            }

            const li = document.createElement('li');
            li.className = `flex items-center justify-between p-3 rounded-lg border transition duration-150 ease-in-out ${
                // BARIS INI MENYEBABKAN TULISAN TERCERET (line-through) JIKA task.completed TRUE
                task.completed ? 'bg-gray-100 border-gray-300 line-through text-gray-500' :
                    (task.active ? 'bg-blue-50 border-blue-400 font-semibold cursor-default' : 'bg-white border-gray-300 hover:bg-gray-50 cursor-pointer')
                }`;

            if (!task.completed && !task.active) {
                li.onclick = () => selectTask(index);
            }

            const leftContent = document.createElement('div');
            leftContent.className = 'flex items-center space-x-3';

            // Tombol CHECKLIST (Ikon)
            const completeBtn = document.createElement('button');
            // BARIS INI MENYEBABKAN IKON MENJADI HIJAU (text-green-500) JIKA task.completed TRUE
            completeBtn.innerHTML = `<i class="fas fa-check-circle text-lg ${task.completed ? 'text-green-500' : 'text-gray-400 hover:text-green-500'}"></i>`;
            completeBtn.onclick = (e) => { e.stopPropagation(); toggleTaskCompletion(index); };

            const taskText = document.createElement('span');
            taskText.textContent = task.name;

            leftContent.appendChild(completeBtn);
            leftContent.appendChild(taskText);

            const rightContent = document.createElement('div');

            // Tombol HAPUS (Ikon)
            const deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = '<i class="fas fa-trash-alt text-lg text-gray-400 hover:text-red-500"></i>';
            deleteBtn.onclick = (e) => { e.stopPropagation(); deleteTask(index); };

            rightContent.appendChild(deleteBtn);

            li.appendChild(leftContent);
            li.appendChild(rightContent);
            taskList.appendChild(li);
        });
        saveTasks();
    };

    const selectTask = (index) => {
        tasks.forEach(t => t.active = false);
        if (!tasks[index].completed) {
            tasks[index].active = true;
        }
        renderTasks();
    }

    const addTask = (e) => {
        e.preventDefault();
        const taskName = newTaskInput.value.trim();
        if (taskName) {
            tasks.push({ name: taskName, completed: false, active: false });
            newTaskInput.value = '';
            renderTasks();
        }
    };

    const toggleTaskCompletion = (index) => {
        tasks[index].completed = !tasks[index].completed;
        renderTasks();
    };

    const deleteTask = (index) => {
        tasks.splice(index, 1);
        renderTasks();
    };


    // --- Event Listeners ---
    startPauseBtn.addEventListener('click', toggleStartPause);
    resetBtn.addEventListener('click', resetTimer);
    taskForm.addEventListener('submit', addTask);

    // Event Listener untuk Tombol Mode 
    modeSelector.addEventListener('click', (e) => {
        const target = e.target.closest('.mode-tab');
        if (target) {
            changeMode(target.dataset.mode, false);
        }
    });

    // --- Inisialisasi Awal ---
    loadTasks();
    updateDisplay();
});
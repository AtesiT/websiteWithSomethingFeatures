<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Сайт Алексея</title>
    <!-- Подключаем Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Светлая тема */
            --bg-gradient: linear-gradient(135deg, #E0F7FF 0%, #B3E0FF 100%);
            --text-color: #003366;
            --card-bg: rgba(255, 255, 255, 0.85);
            --card-shadow: rgba(173, 216, 230, 0.2);
            --accent-color: #0077b6;
            --accent-hover: #00509E;
            --secondary-text: #00509E;
            --playlist-bg: #f8f9fa;
            --playlist-border: #e9ecef;
            --playlist-hover: #e9ecef;
            --city-link: #0077b6;
        }

        body.dark-mode {
            /* Тёмная тема */
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --text-color: #e2e8f0;
            --card-bg: rgba(30, 41, 59, 0.85);
            --card-shadow: rgba(0, 0, 0, 0.4);
            --accent-color: #38bdf8;
            --accent-hover: #0ea5e9;
            --secondary-text: #94a3b8;
            --playlist-bg: #334155;
            --playlist-border: #475569;
            --playlist-hover: #475569;
            --city-link: #7dd3fc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }
        
        body {
            background: var(--bg-gradient);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Канвас для фона */
        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        
        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 10px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            z-index: 100;
            box-shadow: 0 4px 10px var(--card-shadow);
        }
        .theme-toggle:hover {
            background: var(--accent-color);
            color: white;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            padding: 40px 20px;
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--card-shadow);
            backdrop-filter: blur(10px);
        }
        h1 {
            color: var(--text-color);
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .subtitle {
            color: var(--secondary-text);
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .info-block {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            box-shadow: 0 8px 25px var(--card-shadow);
            border-left: 5px solid var(--accent-color);
            backdrop-filter: blur(5px);
        }
        .info-item {
            margin: 15px 0;
            font-size: 1.1em;
            color: var(--text-color);
        }
        .info-item strong {
            color: var(--accent-color);
        }
        /* Стили для города в погоде */
        #weather-city {
            cursor: pointer;
            border-bottom: 1px dashed var(--city-link);
            color: var(--city-link);
            transition: all 0.2s;
        }
        #weather-city:hover {
            border-bottom-style: solid;
            opacity: 0.8;
        }

        .media-section {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
            box-shadow: 0 8px 25px var(--card-shadow);
            backdrop-filter: blur(5px);
        }
        .section-title {
            color: var(--accent-color);
            font-size: 2em;
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 10px;
            display: inline-block;
        }
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin: 25px 0;
        }
        .media-card {
            background: var(--playlist-bg);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .media-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px var(--card-shadow);
        }
        .image-container {
            width: 280px;
            height: 280px;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 15px;
            position: relative;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .media-card h3 {
            color: var(--accent-color);
            margin-bottom: 10px;
            font-size: 1.3em;
        }
        .media-card p {
            color: var(--secondary-text);
            font-size: 0.95em;
        }
        .sketchfab-embed-wrapper {
            width: 100%;
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--card-shadow);
            margin: 20px 0;
        }
        .sketchfab-embed-wrapper iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .video-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--card-shadow);
        }
        .video-container iframe {
            width: 100%;
            height: 450px;
            border: none;
        }
        .music-player {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 5px 15px var(--card-shadow);
            backdrop-filter: blur(5px);
        }
        .track-info {
            text-align: center;
            margin: 15px 0;
            font-size: 1.3em;
            font-weight: bold;
            color: var(--accent-color);
        }
        .player-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }
        .player-controls button {
            padding: 12px 25px;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }
        .player-controls button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            filter: brightness(1.1);
        }
        .playlist {
            margin: 20px 0;
        }
        .playlist button {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            background: var(--playlist-bg);
            border: 2px solid var(--playlist-border);
            color: var(--text-color);
            border-radius: 10px;
            cursor: pointer;
            text-align: left;
            font-size: 1em;
            transition: all 0.3s ease;
        }
        .playlist button:hover {
            background: var(--playlist-hover);
            border-color: var(--accent-color);
        }
        .playlist button.active {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            color: white;
            border-color: var(--accent-hover);
        }
        audio {
            width: 100%;
            margin: 15px 0;
            border-radius: 25px;
        }
        #threejs-container, #shadertoy-container {
            width: 100%;
            height: 500px;
            border-radius: 15px;
            margin: 20px 0;
            background: rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--card-shadow);
        }
        #shadertoy-container canvas {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: var(--text-color);
            font-size: 0.9em;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
                padding-top: 60px;
            }
            .theme-toggle {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
                font-size: 1em;
            }
            h1 {
                font-size: 2em;
            }
            .media-grid {
                grid-template-columns: 1fr;
            }
            .player-controls {
                flex-direction: column;
                align-items: center;
            }
            .player-controls button {
                width: 200px;
            }
            #threejs-container, #shadertoy-container {
                height: 350px;
            }
            .sketchfab-embed-wrapper {
                height: 400px;
            }
            .image-container {
                width: 250px;
                height: 250px;
            }
        }
    </style>
    <!-- Подключаем Three.js библиотеку -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>
    <!-- Канвас для анимации фона (снег) -->
    <canvas id="bg-canvas"></canvas>

    <div class="container">
        <!-- Кнопка смены темы -->
        <button class="theme-toggle" id="theme-toggle" title="Переключить тему">
            <i class="fas fa-moon"></i>
        </button>

        <header>
            <h1>Алексей</h1>
            <div class="subtitle">Персональный сайт</div>
        </header>
        <div class="info-block">
            <div class="info-item">
                <strong>Дата рождения:</strong> Секрет
            </div>
            <div class="info-item">
                <strong>Статус:</strong> Разработчик этого сайта
            </div>
            <div class="info-item">
                <strong>Учебное заведение:</strong> Чебоксарский институт (филиал) Московского Политеха
            </div>
            <!-- Блок погоды -->
            <div class="info-item">
                <strong>Погода:</strong> 
                <span id="weather-city" title="Нажмите, чтобы изменить город">Определяем...</span> 
                <span id="weather-temp"></span>
                <span id="weather-icon"></span>
            </div>
            <!-- Блок валют -->
            <div class="info-item">
                <strong>Курс USD:</strong> <span id="currency-usd">Загрузка...</span> ₽
            </div>
        </div>
        <!-- 3D модель Sketchfab -->
        <div class="media-section">
            <h2 class="section-title">3D Модель из Sketchfab</h2>
            <div class="sketchfab-embed-wrapper">
                <iframe title="Frozen scene test" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/08e866ed66a94d8c8c335c2c735d54bb/embed"></iframe>
            </div>
        </div>
        <!-- Видео с RuTube -->
        <div class="media-section">
            <h2 class="section-title">Видео</h2>
            <div class="video-container">
                <iframe width="720" height="405" src="https://rutube.ru/play/embed/7e279d038cb2ceb1689bf685ff0eebbe/" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
            <p>Моё любимое видео с платформы RuTube</p>
        </div>
        <!-- Галерея с зимними изображениями -->
        <div class="media-section">
            <h2 class="section-title">Зимняя галерея</h2>
            <div class="media-grid">
                <div class="media-card">
                    <div class="image-container">
                        <img src="https://99px.ru/sstorage/86/2016/01/image_861201160147077775821.gif" alt="Падающие снежинки" />
                    </div>
                    <h3>Падающие снежинки</h3>
                    <p>GIF анимация с падающими снежинками</p>
                </div>
                <div class="media-card">
                    <div class="image-container">
                        <img src="https://zefirka.club/wallpapers/uploads/posts/2023-02/1676357210_zefirka-club-p-estetika-zimnego-goroda-vecher-60.png" alt="Зимний город вечером" />
                    </div>
                    <h3>Зимний город</h3>
                    <p>PNG изображение вечернего зимнего города</p>
                </div>
                <div class="media-card">
                    <div class="image-container">
                        <img src="https://icdn.lenta.ru/images/2019/08/28/15/20190828152359438/square_320_3aa31e9993ca773a476a9a2d162f29f3.jpg" alt="Зимний пейзаж" />
                    </div>
                    <h3>Зимний пейзаж</h3>
                    <p>JPG изображение заснеженного леса</p>
                </div>
            </div>
        </div>
        <!-- Музыкальный плеер с зимними треками -->
        <div class="media-section">
            <h2 class="section-title">Зимние треки</h2>
            <div class="music-player">
                <div class="track-info" id="track-info">Нажмите play, чтобы начать</div>
                <audio id="audio-player" controls> Ваш браузер не поддерживает аудио элементы. </audio>
                <div class="player-controls">
                    <button id="prev-btn"><i class="fas fa-backward"></i> Пред.</button>
                    <button id="play-pause-btn"><i class="fas fa-play"></i> Воспроизвести</button>
                    <button id="next-btn">След. <i class="fas fa-forward"></i></button>
                </div>
                <div class="playlist" id="playlist"></div>
            </div>
        </div>
        
        <!-- Three.js: Взрывающаяся снежинка -->
        <div class="media-section">
            <h2 class="section-title">Магия льда (Three.js)</h2>
            <p style="margin-bottom: 15px; color: var(--secondary-text);">Один большой кристалл распадается на множество осколков и собирается обратно</p>
            <div id="threejs-container"></div>
        </div>

        <!-- Зимний шейдер -->
        <div class="media-section">
            <h2 class="section-title">Зимний пейзаж со снегом (WebGL)</h2>
            <div id="shadertoy-container"></div>
        </div>
    </div>
    <footer>
        <p>© 2025 Сайт Алексея. Все права защищены.</p>
    </footer>
    <script>
        // --- Погода и Курс Валют ---
        const weatherApiKey = '58e310878dcae97b7fd2ed9b73f6d716';
        const weatherCityElem = document.getElementById('weather-city');
        const weatherTempElem = document.getElementById('weather-temp');
        const weatherIconElem = document.getElementById('weather-icon');
        const currencyElem = document.getElementById('currency-usd');

        // Получение иконки по температуре
        function getWeatherEmoji(temp) {
            if (temp < 20) return '🧊'; // Лёд  
            if (temp < 0) return '❄️'; // Снежинка
            if (temp > 10) return '🌤️'; // Солнце
            if (temp > 20) return '🔥'; // Огонек
            return '☁️'; // Облако (от 0 до 20)
        }

        // Загрузка погоды
        async function fetchWeather(cityOrCoords) {
            let url;
            if (typeof cityOrCoords === 'string') {
                url = `https://api.openweathermap.org/data/2.5/weather?q=${cityOrCoords}&appid=${weatherApiKey}&units=metric&lang=ru`;
            } else {
                url = `https://api.openweathermap.org/data/2.5/weather?lat=${cityOrCoords.lat}&lon=${cityOrCoords.lon}&appid=${weatherApiKey}&units=metric&lang=ru`;
            }

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Город не найден');
                const data = await response.json();
                
                weatherCityElem.textContent = data.name;
                const temp = Math.round(data.main.temp);
                weatherTempElem.textContent = `${temp}°C`;
                weatherIconElem.textContent = getWeatherEmoji(temp);
            } catch (error) {
                console.error(error);
                weatherCityElem.textContent = 'Ошибка';
                weatherTempElem.textContent = '';
                weatherIconElem.textContent = '';
                if (typeof cityOrCoords === 'object') {
                    // Если не удалось по координатам, пробуем дефолтный город
                    fetchWeather('Москва');
                }
            }
        }

        // Загрузка валют (ЦБ РФ)
        async function fetchCurrency() {
            try {
                const response = await fetch('https://www.cbr-xml-daily.ru/daily_json.js');
                const data = await response.json();
                const usd = data.Valute.USD.Value.toFixed(2);
                currencyElem.textContent = usd;
            } catch (error) {
                console.error(error);
                currencyElem.textContent = 'Ошибка';
            }
        }

        // Определение местоположения
        function initWeather() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        fetchWeather({
                            lat: position.coords.latitude,
                            lon: position.coords.longitude
                        });
                    },
                    (error) => {
                        console.log('Геолокация недоступна, используем дефолтный город');
                        fetchWeather('Чебоксары');
                    }
                );
            } else {
                fetchWeather('Чебоксары');
            }
        }

        // Смена города по клику
        weatherCityElem.addEventListener('click', () => {
            const newCity = prompt('Введите название города (на английском или русском):');
            if (newCity && newCity.trim() !== '') {
                fetchWeather(newCity.trim());
            }
        });

        // Запуск при старте
        initWeather();
        fetchCurrency();


        // --- Управление фоном (Снег) ---
        const bgCanvas = document.getElementById('bg-canvas');
        const bgCtx = bgCanvas.getContext('2d');
        
        let bgWidth, bgHeight;
        let bgAnimationId;

        const snowflakes = [];
        const maxSnowflakes = 350;

        function resizeBg() {
            bgWidth = window.innerWidth;
            bgHeight = window.innerHeight;
            bgCanvas.width = bgWidth;
            bgCanvas.height = bgHeight;
        }
        window.addEventListener('resize', resizeBg);
        resizeBg();

        function createSnowflake() {
            return {
                x: Math.random() * bgWidth,
                y: Math.random() * bgHeight - bgHeight,
                radius: Math.random() * 3 + 1,
                speed: Math.random() * 1 + 0.5,
                drift: Math.random() * 1 - 0.5,
                opacity: Math.random() * 0.5 + 0.3
            };
        }

        for (let i = 0; i < maxSnowflakes; i++) {
            let s = createSnowflake();
            s.y = Math.random() * bgHeight;
            snowflakes.push(s);
        }

        function drawSnow() {
            bgCtx.clearRect(0, 0, bgWidth, bgHeight);
            bgCtx.fillStyle = 'white';
            
            snowflakes.forEach(flake => {
                bgCtx.beginPath();
                bgCtx.arc(flake.x, flake.y, flake.radius, 0, Math.PI * 2);
                bgCtx.globalAlpha = flake.opacity;
                bgCtx.fill();
                
                flake.y += flake.speed;
                flake.x += flake.drift;
                
                if (flake.y > bgHeight) {
                    flake.y = -10;
                    flake.x = Math.random() * bgWidth;
                }
                if (flake.x > bgWidth + 10) flake.x = -10;
                if (flake.x < -10) flake.x = bgWidth + 10;
            });
            bgCtx.globalAlpha = 1.0;
        }

        function animateBg() {
            drawSnow();
            bgAnimationId = requestAnimationFrame(animateBg);
        }
        animateBg();

        // --- Логика Темной Темы ---
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = themeToggleBtn.querySelector('i');
        const body = document.body;

        themeToggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        });

        // --- Музыкальный плеер ---
        const audioPlayer = document.getElementById('audio-player');
        const trackInfo = document.getElementById('track-info');
        const playPauseBtn = document.getElementById('play-pause-btn');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const playlist = document.getElementById('playlist');
        
        const tracks = [
            { 
                title: "Idina Menzel – Let It Go", 
                src: "https://dl1.mp3party.net/online/9899618.mp3" 
            },
            { 
                title: "Coca-Cola – Праздник к нам приходит", 
                src: "https://dl1.mp3party.net/online/7125894.mp3" 
            },
            { 
                title: "Christmas Songs – Jingle Bells", 
                src: "https://dl1.mp3party.net/online/815480.mp3" 
            }
        ];
        
        let currentTrackIndex = 0;
        let isTrackLoaded = false;
        
        function renderPlaylist() {
            playlist.innerHTML = '';
            tracks.forEach((track, index) => {
                const button = document.createElement('button');
                button.textContent = `${index + 1}. ${track.title}`;
                button.addEventListener('click', () => {
                    playTrack(index);
                });
                if (isTrackLoaded && index === currentTrackIndex) {
                    button.classList.add('active');
                }
                playlist.appendChild(button);
            });
        }
        
        function playTrack(index) {
            currentTrackIndex = index;
            const track = tracks[currentTrackIndex];
            audioPlayer.src = track.src;
            trackInfo.textContent = `🎵 Сейчас играет: ${track.title}`;
            isTrackLoaded = true;
            renderPlaylist();
            audioPlayer.play().then(() => {
                playPauseBtn.innerHTML = '<i class="fas fa-pause"></i> Пауза';
            }).catch(error => {
                console.log('Автовоспроизведение заблокировано:', error);
            });
        }
        
        function nextTrack() {
            currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
            playTrack(currentTrackIndex);
        }
        
        function prevTrack() {
            currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
            playTrack(currentTrackIndex);
        }
        
        playPauseBtn.addEventListener('click', () => {
            if (!isTrackLoaded) {
                playTrack(0);
            } else {
                if (audioPlayer.paused) {
                    audioPlayer.play();
                    playPauseBtn.innerHTML = '<i class="fas fa-pause"></i> Пауза';
                } else {
                    audioPlayer.pause();
                    playPauseBtn.innerHTML = '<i class="fas fa-play"></i> Воспроизвести';
                }
            }
        });
        
        prevBtn.addEventListener('click', prevTrack);
        nextBtn.addEventListener('click', nextTrack);
        audioPlayer.addEventListener('ended', nextTrack);
        audioPlayer.addEventListener('play', () => {
            playPauseBtn.innerHTML = '<i class="fas fa-pause"></i> Пауза';
        });
        audioPlayer.addEventListener('pause', () => {
            playPauseBtn.innerHTML = '<i class="fas fa-play"></i> Воспроизвести';
        });
        
        renderPlaylist();

        // --- Three.js: Взрывающаяся снежинка ---
        function initSnowflakeAnimation() {
            const container = document.getElementById('threejs-container');
            if (!container) return;

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            camera.position.z = 15;

            const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setClearColor(0x000000, 0);
            container.appendChild(renderer.domElement);

            const crystalCount = 100;
            const crystals = [];
            const group = new THREE.Group();
            
            const material = new THREE.MeshPhongMaterial({
                color: 0xaecbe0,
                emissive: 0x112244,
                specular: 0xffffff,
                shininess: 100,
                flatShading: true
            });

            const geometry = new THREE.TetrahedronGeometry(0.5, 0);

            for (let i = 0; i < crystalCount; i++) {
                const mesh = new THREE.Mesh(geometry, material);
                const direction = new THREE.Vector3(
                    Math.random() - 0.5,
                    Math.random() - 0.5,
                    Math.random() - 0.5
                ).normalize();
                
                mesh.userData = {
                    dir: direction,
                    speed: 2 + Math.random() * 5,
                    rotSpeed: {
                        x: (Math.random() - 0.5) * 0.1,
                        y: (Math.random() - 0.5) * 0.1,
                        z: (Math.random() - 0.5) * 0.1
                    }
                };
                group.add(mesh);
                crystals.push(mesh);
            }
            scene.add(group);

            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);
            const pointLight = new THREE.PointLight(0x00aaff, 1, 50);
            pointLight.position.set(5, 5, 10);
            scene.add(pointLight);
            const pointLight2 = new THREE.PointLight(0xff00aa, 0.5, 50);
            pointLight2.position.set(-5, -5, 5);
            scene.add(pointLight2);

            function animate() {
                requestAnimationFrame(animate);
                const time = Date.now() * 0.001;
                const expansion = (Math.sin(time * 0.8) + 1) / 2; 

                group.rotation.y += 0.005;

                crystals.forEach((mesh) => {
                    const targetPos = mesh.userData.dir.clone().multiplyScalar(mesh.userData.speed * expansion * 5);
                    if (expansion < 0.1) {
                         mesh.position.copy(mesh.userData.dir.clone().multiplyScalar(2));
                    } else {
                         mesh.position.copy(targetPos);
                    }
                    mesh.rotation.x += mesh.userData.rotSpeed.x;
                    mesh.rotation.y += mesh.userData.rotSpeed.y;
                    mesh.rotation.z += mesh.userData.rotSpeed.z;
                });
                renderer.render(scene, camera);
            }
            animate();

            window.addEventListener('resize', () => {
                camera.aspect = container.clientWidth / container.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, container.clientHeight);
            });
        }

        // --- Shadertoy (Зимний пейзаж) ---
        function initShadertoy() {
            const container = document.getElementById('shadertoy-container');
            if (!container) return;
            container.innerHTML = '';
            
            const canvas = document.createElement('canvas');
            container.appendChild(canvas);
            
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (!gl) return;

            function resizeCanvas() {
                const width = container.clientWidth;
                const height = container.clientHeight;
                canvas.width = width;
                canvas.height = height;
                gl.viewport(0, 0, width, height);
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            const vertexShaderSource = `
                attribute vec2 a_position;
                void main() {
                    gl_Position = vec4(a_position, 0.0, 1.0);
                }
            `;

            const fragmentShaderSource = `
                precision highp float;
                uniform float u_time;
                uniform vec2 u_resolution;
                
                #define iTime u_time
                #define iResolution vec3(u_resolution, 0.0)
                
                const vec3 palette_dark = vec3(76.0, 86.0, 106.0)/255.0;
                const vec3 palette_light = vec3(236.0, 239.0, 244.0)/255.0;

                const float SPEED = 0.5;
                const float WIND = 3.0;
                const float MAX_DEPTH = 2.0;
                const float DEPTH_STEP = 0.2;
                const float TIME_OFFSET = 0.0;
                const int OCTAVES = 9;

                float hash(vec2 co) {
                    return fract(sin(dot(co.xy ,vec2(12.9898,78.233))) * 43758.5453);
                }

                float noise( in vec2 p ) {
                    vec2 i = floor( p );
                    vec2 f = fract( p );
                    vec2 u = f*f*f*(f*(f*6.0-15.0)+10.0);
                    float va = hash( i + vec2(0.0,0.0) );
                    float vb = hash( i + vec2(1.0,0.0) );
                    float vc = hash( i + vec2(0.0,1.0) );
                    float vd = hash( i + vec2(1.0,1.0) );
                    return va+(vb-va)*u.x+(vc-va)*u.y+(va-vb-vc+vd)*u.x*u.y;
                }

                vec3 noised( in vec2 p ) {
                    vec2 i = floor( p );
                    vec2 f = fract( p );
                    vec2 u = f*f*f*(f*(f*6.0-15.0)+10.0);
                    vec2 du = 30.0*f*f*(f*(f-2.0)+1.0);
                    float va = hash( i + vec2(0.0,0.0) );
                    float vb = hash( i + vec2(1.0,0.0) );
                    float vc = hash( i + vec2(0.0,1.0) );
                    float vd = hash( i + vec2(1.0,1.0) );
                    return vec3( va+(vb-va)*u.x+(vc-va)*u.y+(va-vb-vc+vd)*u.x*u.y, 
                                 du*(u.yx*(va-vb-vc+vd) + vec2(vb,vc) - va) ); 
                }

                float snow(vec2 coord, float depth, float time, float speed) {
                    float snow = 0.0;
                    for(int k=0;k<6;k++){
                        for(int i=0;i<20;i++){
                            if (float(i) >= depth*4.0) break;
                            float cellSize = 2.0 + (float(i)*3.0);
                            float downSpeed = 0.3+(sin(time*0.4+float(k+i*20))+1.0)*0.00008;
                            vec2 uv = (coord.xy / iResolution.x)+vec2(0.01*sin((time+float(k*6185))*0.6+float(i))*(5.0/float(i))+time*speed*0.3,downSpeed*(time+float(k*1352))*(1.0/float(i)));
                            vec2 uvStep = (ceil((uv)*cellSize-vec2(0.5,0.5))/cellSize);
                            float x = fract(sin(dot(uvStep.xy,vec2(12.9898+float(k)*12.0,78.233+float(k)*315.156)))* 43758.5453+float(k)*12.0)-0.5;
                            float y = fract(sin(dot(uvStep.xy,vec2(62.2364+float(k)*23.0,94.674+float(k)*95.0)))* 62159.8432+float(k)*12.0)-0.5;
                            float d = 5.0*distance((uvStep.xy + vec2(x*sin(y),y)*(sin(time*2.5)*0.7/cellSize) + vec2(y,x)*(cos(time*2.5)*0.7/cellSize)),uv.xy);
                            float omiVal = fract(sin(dot(uvStep.xy,vec2(32.4691,94.615)))* 31572.1684);
                            if(omiVal<0.08){
                                float newd = (x+1.0)*0.4*clamp(1.2-d*(15.0+(x*6.3))*(cellSize/1.4),0.0,1.0);
                                snow += newd / float(i)*4.0;
                            }
                        }
                    }
                    return snow*noise(coord/iResolution.y*10.0 + iTime);
                }

                void fbmd(in vec2 st, float h, float dist, out float value, out vec2 grad) {
                    const float gain = 0.5;
                    const float gaind = 0.4;
                    const float lacunarity = 2.0;
                    float scale = (1.0-pow(gain, float(OCTAVES)))/(1.0-gain);
                    float scaled = (1.0-gaind)/(1.0-pow(gaind, float(OCTAVES)));
                    value = 0.0;
                    grad = vec2(0);
                    float amplitude = 1.0;
                    float amplituded = 1.0;
                    float frequency = 1.;
                    float remaining_amp = scale;
                    for (int i = 0; i < 20; i++) {
                        if (i >= OCTAVES + int(log2(1.0/dist))) break;
                        vec3 n = noised(st * frequency + vec2(i));
                        value += amplitude * n.r;
                        grad += amplituded * frequency * n.gb;
                        remaining_amp -= amplitude;
                        if (h > value + remaining_amp) {
                            value = 0.0;
                            return;
                        }
                        frequency *= lacunarity;
                        amplitude *= gain;
                        amplituded *= gaind;
                    }
                    value /= scale;
                    grad *= scaled;
                }

                void terraind(vec2 pos, float h, float dist, out float value, out vec2 grad) {
                    const float a = 0.2;
                    const float b = 0.05;
                    float c = -0.5-0.5*pos.y*b + pos.y*a + a*b*pos.y*pos.y;
                    float d = (1.0+pos.y*b);
                    fbmd(pos*0.4, (h-c)/d, dist, value, grad); 
                    value = d*value + c;
                    grad *= 0.4;
                    grad.x = (b*pos.y + 1.0)*grad.x;
                    grad.y = (b*pos.y + 1.0)*grad.y + b*value + 2.0*a*b*pos.y + a - 0.5*b;
                }

                void mainImage( out vec4 fragColor, in vec2 fragCoord ) {
                    vec2 pos = (fragCoord.xy - iResolution.xy/2.0) / (iResolution.y/2.0);
                    pos.y -= 0.5;
                    float depth = 1000.0;
                    float time = (iTime+TIME_OFFSET)*SPEED;
                    float terr;
                    vec2 grad;
                    vec3 col = mix(palette_light, palette_light, smoothstep(-0.5, 1.0, pos.y));
                    for (int i=0; i<11; i++) {
                        float z = float(i) * DEPTH_STEP;
                        if (z > MAX_DEPTH) break;
                        vec2 p = vec2(pos.x + time/(1.0+z), z)*(1.0+z);
                        terraind(p, pos.y+1.2, 1.0+z, terr, grad);
                        if (pos.y+1.2 < terr) {
                            float terrtrue;
                            terraind(p+vec2(0, (pos.y+1.0)-terr)*(1.0+z), -10.0, 1.0+z, terrtrue, grad);
                            float flatness = smoothstep(0.6, 0.5, length(grad));
                            vec3 ground = mix(palette_dark, palette_light, flatness*0.7);
                            col = mix(ground, col, min(z/MAX_DEPTH*0.95, 1.0));
                            depth = 1.0 + z*2.5;
                            break;
                        }
                    }
                    col = mix(col, palette_light, noise(pos+vec2(time*SPEED*WIND, 0.0))*0.4);
                    float s = snow(gl_FragCoord.xy, depth, time/SPEED, SPEED*WIND)*10.0;
                    col = mix(col, palette_light, min(1.0, s));
                    col += s*(pos.y+1.0)*0.1;
                    fragColor = vec4(col, 1);
                }
                
                void main() {
                    mainImage(gl_FragColor, gl_FragCoord.xy);
                }
            `;

            function compileShader(source, type) {
                const shader = gl.createShader(type);
                gl.shaderSource(shader, source);
                gl.compileShader(shader);
                if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                    gl.deleteShader(shader);
                    return null;
                }
                return shader;
            }

            const vertexShader = compileShader(vertexShaderSource, gl.VERTEX_SHADER);
            const fragmentShader = compileShader(fragmentShaderSource, gl.FRAGMENT_SHADER);
            if (!vertexShader || !fragmentShader) return;

            const program = gl.createProgram();
            gl.attachShader(program, vertexShader);
            gl.attachShader(program, fragmentShader);
            gl.linkProgram(program);
            if (!gl.getProgramParameter(program, gl.LINK_STATUS)) return;
            
            gl.useProgram(program);

            const positionBuffer = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
            gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 1,-1, -1,1, 1,1]), gl.STATIC_DRAW);
            
            const positionAttributeLocation = gl.getAttribLocation(program, "a_position");
            gl.enableVertexAttribArray(positionAttributeLocation);
            gl.vertexAttribPointer(positionAttributeLocation, 2, gl.FLOAT, false, 0, 0);

            const timeUniformLocation = gl.getUniformLocation(program, "u_time");
            const resolutionUniformLocation = gl.getUniformLocation(program, "u_resolution");

            let startTime = Date.now();
            function render() {
                const currentTime = (Date.now() - startTime) * 0.001;
                gl.uniform1f(timeUniformLocation, currentTime);
                gl.uniform2f(resolutionUniformLocation, canvas.width, canvas.height);
                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                requestAnimationFrame(render);
            }
            render();
        }

        window.addEventListener('load', function() {
            initSnowflakeAnimation();
            initShadertoy();
        });
    </script>
</body>
</html>
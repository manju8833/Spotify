<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #1db954;
            --background-color: #121212;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --sidebar-width: 350px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.5;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: rgba(0, 0, 0, 0.8);
            padding: -130px;
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            left: 103px;
            top: 0;
            transition: transform 0.3s ease;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 20px;
            background: linear-gradient(to bottom, #1a1a1a, #000000);
            min-height: 100vh;
        }

        .logo {
            width: 130px;
            margin-bottom: 30px;
        }

        .nav-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }

        .nav-tab {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .nav-tab.active {
            color: var(--text-primary);
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 4px;
            color: var(--text-primary);
            font-size: 14px;
        }

        .search-input:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .tracks-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .track-item {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .track-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .track-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .track-art {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            margin-right: 12px;
            object-fit: cover;
        }

        .track-info {
            flex: 1;
            min-width: 0;
        }

        .track-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .track-artist {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .track-duration {
            font-size: 12px;
            color: var(--text-secondary);
            margin-right: 12px;
        }

        .track-menu {
            position: relative;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .track-item:hover .track-menu {
            opacity: 1;
        }

        .menu-button {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 4px 8px;
            font-size: 16px;
            transition: color 0.2s ease;
        }

        .menu-button:hover {
            color: var(--text-primary);
        }

        .menu-content {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #282828;
            border-radius: 4px;
            padding: 4px;
            min-width: 180px;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            display: none;
        }

        .menu-content.active {
            display: block;
        }

        .menu-item {
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
            cursor: pointer;
            border-radius: 2px;
            transition: background-color 0.2s ease;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .now-playing {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .now-playing-art {
            width: 300px;
            height: 300px;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
            object-fit: cover;
        }

        .now-playing-info {
            text-align: center;
        }

        .now-playing-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .now-playing-artist {
            font-size: 16px;
            color: var(--text-secondary);
        }

        .player-controls {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .control-button {
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
            padding: 8px;
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .control-button:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .play-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--text-primary);
            color: var(--background-color);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .menu-button-mobile {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
            padding: 8px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 999;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-button-mobile {
                display: block;
            }

            .now-playing-art {
                width: 200px;
                height: 200px;
            }

            .now-playing-title {
                font-size: 24px;
            }
        }

        .volume-control {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        .volume-slider {
            width: 100px;
            height: 4px;
            -webkit-appearance: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            outline: none;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            background: var(--text-primary);
            border-radius: 50%;
            cursor: pointer;
        }

        .loading {
            position: relative;
            width: 100%;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            to {
                transform: translateX(200%);
            }
        }
    </style>
</head>
<body>
    <button class="menu-button-mobile">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <div class="container">
        <div class="sidebar">
            <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_RGB_White.png" alt="Spotify" class="logo">
            
            <div class="nav-tabs">
                <a href="#" class="nav-tab active" data-tab="for-you">For You</a>
                <a href="#" class="nav-tab" data-tab="top-tracks">Top Tracks</a>
                <a href="#" class="nav-tab" data-tab="new-releases">Favorites</a>
                <a href="#" class="nav-tab" data-tab="recently-played">Recently Played</a>
            </div>

            <div class="search-container">
                <input type="search" class="search-input" placeholder="Search Song, Artist">
            </div>

            <div class="tracks-container"></div>
        </div>

        <div class="main-content">
            <div class="now-playing">
                <img src="" alt="" class="now-playing-art">
                <div class="now-playing-info">
                    <div class="now-playing-title"></div>
                    <div class="now-playing-artist"></div>
                </div>
                <div class="player-controls">
                    <button class="control-button previous">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="19 20 9 12 19 4 19 20"></polygon>
                            <line x1="5" y1="19" x2="5" y2="5"></line>
                        </svg>
                    </button>
                    <button class="control-button play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </button>
                    <button class="control-button next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="5 4 15 12 5 20 5 4"></polygon>
                            <line x1="19" y1="5" x2="19" y2="19"></line>
                        </svg>
                    </button>
                </div>
                <div class="volume-control">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                    </svg>
                    <input type="range" class="volume-slider" min="0" max="100" value="100">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample music data with actual cover images
        const musicData = [
           
            
            {
                id: 1,
                title: "Death Bed",
                artist: "Powfu",
                duration: "4:10",
                cover: "https://samplesongs.netlify.app/album-arts/death-bed.jpg",
                audio: "https://samplesongs.netlify.app/Death%20Bed.mp3",
                color: "#3a1a2a"
            },
            {
                id: 2,
                title: "Bad Liar",
                artist: "Imagine Dragons",
                duration: "4:10",
                cover: "https://samplesongs.netlify.app/album-arts/bad-liar.jpg",
                audio: "https://samplesongs.netlify.app/Bad%20Liar.mp3",
                color: "#1a1a2a"
            },
            {
                id: 3,
                title: "Faded",
                artist: "Alan Walke",
                duration: "3:40",
                cover: "https://samplesongs.netlify.app/album-arts/faded.jpg",
                audio: "https://samplesongs.netlify.app/Faded.mp3",
                color: "#2a1a2a"
            },
            {
                id: 4,
                title: "Hate Me",
                artist: "Ellie Goulding",
                duration: "3:56",
                cover: "https://samplesongs.netlify.app/album-arts/hate-me.jpg",
                audio: "https://samplesongs.netlify.app/Hate%20Me.mp3",
                color: "#4a1a2a"
            },
            {
                id: 5,
                title: "Solo",
                artist: "Clean Bandit",
                duration: "5:02",
                cover: "https://samplesongs.netlify.app/album-arts/solo.jpg",
                audio: "https://samplesongs.netlify.app/Solo.mp3",
                color: "#3a1a2a"
            },
            {
                id: 6,
                title: "Without Me",
                artist: "Halsey",
                duration: "4:03",
                cover: "https://samplesongs.netlify.app/album-arts/without-me.jpg",
                audio: "https://samplesongs.netlify.app/Without%20Me.mp3",
                color: "#3a1a2a"
            },
            {
                id: 7,
                title: "Demons",
                artist: "Imagine Dragons",
                duration: "5:24",
                cover: "https://via.placeholder.com/300/2a1a2a/ffffff?text=Demons",
                audio: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3",
                color: "#2a1a2a"
            },
            {
                id: 8,
                title: "Ghost Stories",
                artist: "Coldplay",
                duration: "3:10",
                cover: "https://via.placeholder.com/300/1a2a3a/ffffff?text=Ghost+Stories",
                audio: "https://www.jiosaavn.com/song/starboy/N10nfC18Xng",
                color: "#1a2a3a"
            },
            {
                id: 9,
                title: "Viva La Vida",
                artist: "Coldplay",
                duration: "5:32",
                cover: "https://via.placeholder.com/300/3a1a2a/ffffff?text=Viva+La+Vida",
                audio: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3",
                color: "#3a1a2a"
            },

            
        ];

        // State
        let currentTrack = null;
        let isPlaying = false;
        let audio = new Audio();
        
        // Load saved data
        
        let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
        let recentlyPlayed = JSON.parse(sessionStorage.getItem('recentlyPlayed')) || [];

        // DOM Elements
        const tracksContainer = document.querySelector('.tracks-container');
        const searchInput = document.querySelector('.search-input');
        const navTabs = document.querySelectorAll('.nav-tab');
        const menuButtonMobile = document.querySelector('.menu-button-mobile');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const playButton = document.querySelector('.play-button');
        const prevButton = document.querySelector('.previous');
        const nextButton = document.querySelector('.next');
        const volumeSlider = document.querySelector('.volume-slider');

        // Functions
        function renderTracks(tracks) {
            tracksContainer.innerHTML = '';
            
            if (tracks.length === 0) {
                tracksContainer.innerHTML = '<div class="loading"></div>'.repeat(4);
                return;
            }

            tracks.forEach(track => {
                const trackElement = document.createElement('div');
                trackElement.className = `track-item ${currentTrack?.id === track.id ? 'active' : ''}`;
                trackElement.innerHTML = `
                    <img src="${track.cover}" alt="${track.title}" class="track-art">
                    <div class="track-info">
                        <div class="track-title">${track.title}</div>
                        <div class="track-artist">${track.artist}</div>
                    </div>
                    <div class="track-duration">${track.duration}</div>
                    <div class="track-menu">
                        <button class="menu-button">•••</button>
                        <div class="menu-content">
                            <div class="menu-item favorite-button">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="${favorites.includes(track.id) ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                                ${favorites.includes(track.id) ? 'Remove from Favorites' : 'Add to Favorites'}
                            </div>
                        </div>
                    </div>
                `;

                // Event Listeners
                trackElement.addEventListener('click', (e) => {
                    if (!e.target.closest('.menu-button')) {
                        playTrack(track);
                    }
                });

                const menuButton = trackElement.querySelector('.menu-button');
                const menuContent = trackElement.querySelector('.menu-content');
                
                menuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    closeAllMenus();
                    menuContent.classList.add('active');
                });

                trackElement.querySelector('.favorite-button').addEventListener('click', () => {
                    toggleFavorite(track.id);
                    menuContent.classList.remove('active');
                });

                tracksContainer.appendChild(trackElement);
            });
        }

        function closeAllMenus() {
            document.querySelectorAll('.menu-content').forEach(menu => {
                menu.classList.remove('active');
            });
        }

        function playTrack(track) {
            if (currentTrack?.id === track.id) {
                togglePlay();
                return;
            }

            currentTrack = track;
            audio.src = track.audio;
            audio.play().catch(console.error);
            isPlaying = true;
            updatePlayerUI();
            updateBackground(track.color);
            addToRecentlyPlayed(track.id);
        }

        function togglePlay() {
            if (!currentTrack) return;
            
            if (isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
            isPlaying = !isPlaying;
            updatePlayerUI();
        }

        function updatePlayerUI() {
            if (!currentTrack) return;

            // Update now playing
            document.querySelector('.now-playing-art').src = currentTrack.cover;
            document.querySelector('.now-playing-title').textContent = currentTrack.title;
            document.querySelector('.now-playing-artist').textContent = currentTrack.artist;

            // Update play button
            playButton.innerHTML = isPlaying 
                ? '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>'
                : '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>';

            // Update track list
            renderTracks(getCurrentTracks());
        }

        function updateBackground(color) {
            mainContent.style.background = `linear-gradient(to bottom, ${color}, #000000)`;
        }

        function toggleFavorite(trackId) {
            const index = favorites.indexOf(trackId);
            if (index === -1) {
                favorites.push(trackId);
            } else {
                favorites.splice(index, 1);
            }
            localStorage.setItem('favorites', JSON.stringify(favorites));
            renderTracks(getCurrentTracks());
        }

        function addToRecentlyPlayed(trackId) {
            recentlyPlayed = [trackId, ...recentlyPlayed.filter(id => id !== trackId)].slice(0, 10);
            sessionStorage.setItem('recentlyPlayed', JSON.stringify(recentlyPlayed));
        }

        function getCurrentTracks() {
            const activeTab = document.querySelector('.nav-tab.active').dataset.tab;
            const searchQuery = searchInput.value.toLowerCase();
            
            let tracks = activeTab === 'top-tracks' 
                ? [...musicData].sort(() => Math.random() - 0.5)
                : musicData;

            if (searchQuery) {
                tracks = tracks.filter(track => 
                    track.title.toLowerCase().includes(searchQuery) ||
                    track.artist.toLowerCase().includes(searchQuery)
                );
            }

            return tracks;
        }

        // Event Listeners
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.track-menu')) {
                closeAllMenus();
            }
        });

        menuButtonMobile.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        searchInput.addEventListener('input', () => {
            renderTracks(getCurrentTracks());
        });

        navTabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                navTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                renderTracks(getCurrentTracks());
            });
        });

        playButton.addEventListener('click', togglePlay);
        prevButton.addEventListener('click', () => {
            if (!currentTrack) return;
            const currentIndex = musicData.findIndex(track => track.id === currentTrack.id);
            const prevTrack = musicData[(currentIndex - 1 + musicData.length) % musicData.length];
            playTrack(prevTrack);
        });

        nextButton.addEventListener('click', () => {
            if (!currentTrack) return;
            const currentIndex = musicData.findIndex(track => track.id === currentTrack.id);
            const nextTrack = musicData[(currentIndex + 1) % musicData.length];
            playTrack(nextTrack);
        });

        volumeSlider.addEventListener('input', (e) => {
            audio.volume = e.target.value / 100;
        });

        // Initialize
        renderTracks(musicData);
    </script>
</body>
</html>
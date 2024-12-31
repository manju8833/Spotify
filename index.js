const express = require('express');
const app = express();
const port = 8080;
const path = require('path');

// Serve the file publicly
app.use(express.static('public'));

// Endpoint to serve the specific file
app.get('.../index.php', (req, res) => {
    res.sendFile(path.join(__dirname,"C:\laragon\www\Spotify-laragon\wp-content\themes\spotify-gui\index.html"));
});

app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});

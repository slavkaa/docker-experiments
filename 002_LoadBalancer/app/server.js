const express = require('express');
const fs = require('fs');
const app = express();
const port = process.env.PORT || 3000;

app.get('/', (req, res) => {
    const message = `App instance ${process.env.HOSTNAME} received a request.\n`;
    fs.appendFileSync('/var/log/app.log', message); // Write to log file
    res.send(message);
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});

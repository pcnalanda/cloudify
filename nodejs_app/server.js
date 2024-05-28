// nodejs_app/server.js
const express = require('express');
const app = express();
const port = 3000;

app.get('/nodejs', (req, res) => {
  res.send('Hello from Node.js!');
});

app.listen(port, () => {
  console.log(`Node.js app listening at http://localhost:${port}`);
});

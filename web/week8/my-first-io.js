const fs = require('fs');

var file = process.argv[2];

var buffer = fs.readFileSync(file).toString();

var array = buffer.split('\n');

console.log(array.length - 1);
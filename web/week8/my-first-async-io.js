const fs = require('fs');

var file = process.argv[2];


function callback(err, data) {
    if (!err) {

        var array = data.toString().split('\n');
        console.log(array.length - 1);
    }
    

}

var buffer = fs.readFile(file, callback);




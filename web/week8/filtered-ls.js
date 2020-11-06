const fs = require('fs');
const path = require('path');

var filePath = process.argv[2];

fs.readdir(filePath, callback)

function callback(err, pathList) {
    if(!err)
    {
        pathList.forEach(foundPath => {
            if (path.extname(foundPath) == "." + process.argv[3])
            {
                console.log(foundPath);
            }

        });
    }
}
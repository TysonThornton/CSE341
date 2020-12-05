'use strict' 

function buildVinylCollection(data) {
 // Build vinyl collection into HTML table components and inject into DOM.
    // Grabs the element in HTML
    let vinylDisplay = document.getElementById("vinylDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Band / Artist</th><th>Album</th><th>Release Year</th><th>Condition</th><th>Genre</th></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over the array and put each in a row 
    data.forEach(function (element) { 
     // Create table cell with vinyl info 
     dataTable += `<tr><td>${element.vinylband}</td>`;
     dataTable += `<tr><td>${element.vinylalbum}</td>`;
     dataTable += `<tr><td>${element.vinylyear}</td>`;
     dataTable += `<tr><td>${element.vinylcondition}</td>`;
     dataTable += `<tr><td>${element.vinygenre}</td>`;
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Product Management view 
    vinylDisplay.innerHTML = dataTable; 
   }
// This will 1) listen to the categories select element to detect when a new category is selected. 
// When a change occurs it will ask the products controller to fetch the products for the category and send them back, and 
// 2) when the products data is returned, it will send the data, as a JavaScript object, to a new JavaScript function to build the 
// table structure around it, then inject it into the table that we just added to the product management view.

'use strict' 


 // Build products into HTML table components and inject into DOM. This is called in code above. Needs 'data' passed to it
function buildVinylCollection(data) {
    // Grabs the element in HTML
    let vinylDisplay = document.getElementById("vinylDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vinyl Record</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all products and put each in a row 
    data.forEach(function (element) { 
     console.log(element.vinylid + ", " + element.vinylalbum);
     // Create table cell with product name 
     dataTable += `<tr><td>${element.vinylalbum}</td>`;
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Product Management view 
    vinylDisplay.innerHTML = dataTable; 
   }
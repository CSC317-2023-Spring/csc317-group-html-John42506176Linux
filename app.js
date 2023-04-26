const form = document.getElementById("my-form");
const deleteButton = document.getElementById("delete");
var isChartSet =  false;
var prevChart = null;


deleteButton.addEventListener("click", function(event) {
    fetch('http://localhost/delete.php', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(json => {
        alert("Deleted database");
    })
    .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
    });

});
// Add an event listener for the form submit event
form.addEventListener("submit", function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();
  
    // Get the form data and send it to the server
    console.log("I am here");
    const xValue = $('#x-variable').val();
    const yValue = $('#y-variable').val();
  
    // Make the GET request
    fetch(`http://localhost/chart.php?X=${encodeURIComponent(xValue)}&Y=${encodeURIComponent(yValue)}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      },
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(json => {
      console.log(json);
      let xValues = [];
      let yValues = [];
  
      json.forEach(function(obj) {
        if (xValue == 'date') {
          xValues.push(Date.parse(obj[xValue]));
        } else {
          xValues.push(parseFloat(obj[xValue]));
        }
  
        if (yValue == 'date') {
          yValues.push(Date.parse(obj[yValue]));
        } else {
          yValues.push(parseFloat(obj[yValue]));
        }
      });
  
      let dataPoints = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
  
      const data = {
        datasets: [{
          label: 'Scatter Plot',
          data: dataPoints,
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          trendlineLinear: {
            colorMin: "#3e95cd",
            lineStyle: "line",
            width: 1,
            projection: true
          }
        }]
      };
  
      // Configuration options for the chart
      const options = {
        scales: {
          x: {
            type: 'linear',
            position: 'bottom'
          },
          y: {
            type: 'linear',
            position: 'left'
          }
        },
      };
  
      // Create the chart
      if (isChartSet) {
        prevChart.destroy();
      }
      const ctx = document.getElementById('mycanvas').getContext('2d');
      prevChart = new Chart(ctx, {
        type: 'scatter',
        data: data,
        options: options
      });
      isChartSet = true;
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
  });
  
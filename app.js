const form = document.getElementById("my-form");
const deleteButton = document.getElementById("delete");
var isChart1Set =  false;
var isChart2Set =  false;
var prevChartL1 = null;
var prevChartR1 = null;
var prevChartL2 = null;
var prevChartR2 = null;

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


setInterval(function() {
  console.log("I AM HERE");
  const runID1 = $('#runID1').val();
  const runID2 = $('#runID2').val();

  fetch(`http://localhost/view.php?runID=${encodeURIComponent(runID1)}`, {
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
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['leftwheel']));
    });

    let dataPointsL1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['rightwheel']));
    });
    let dataPointsR1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));

    const dataL1 = {
      datasets: [{
        label: 'Scatter Plot',
        data: dataPointsL1,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        trendlineLinear: {
          colorMin: "#3e95cd",
          lineStyle: "line",
          width: 1,
          projection: true
        }
      }]
    };

    const dataR1 = {
      datasets: [{
        label: 'Scatter Plot',
        data: dataPointsR1,
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
    if (isChart1Set) {
      prevChartL1.destroy();
      prevChartR1.destroy();
    }
    const ctx1 = document.getElementById('canvasL1').getContext('2d');
    const ctx2 = document.getElementById('canvasR1').getContext('2d');
    prevChartL1 = new Chart(ctx1, {
      type: 'scatter',
      data: dataL1,
      options: options
    });

    prevChartR1 = new Chart(ctx2, {
      type: 'scatter',
      data: dataR1,
      options: options
    });

    isChart1Set = true;
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

  // Make the GET request
  fetch(`http://localhost/view.php?runID=${encodeURIComponent(runID2)}`, {
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
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['leftwheel']));
    });

    let dataPointsL1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['rightwheel']));
    });
    let dataPointsR1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));

    const dataL1 = {
      datasets: [{
        label: 'Scatter Plot',
        data: dataPointsL1,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        trendlineLinear: {
          colorMin: "#3e95cd",
          lineStyle: "line",
          width: 1,
          projection: true
        }
      }]
    };

    const dataR1 = {
      datasets: [{
        label: 'Scatter Plot',
        data: dataPointsR1,
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
    if (isChart1Set) {
      prevChartL2.destroy();
      prevChartR2.destroy();
    }
    const ctx1 = document.getElementById('canvasL2').getContext('2d');
    const ctx2 = document.getElementById('canvasR2').getContext('2d');
    prevChartL2 = new Chart(ctx1, {
      type: 'scatter',
      data: dataL1,
      options: options
    });

    prevChartR2 = new Chart(ctx2, {
      type: 'scatter',
      data: dataR1,
      options: options
    });

    isChart1Set = true;
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

}, 300);
  
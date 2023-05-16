const form = document.getElementById("my-form");
const deleteButton = document.getElementById("delete");
var isChart1Set =  false;
var isChart2Set =  false;
var prevChartL1 = null;
var prevChartR1 = null;
var prevChartL2 = null;
var prevChartR2 = null;
var prevChartS1 = null;
var prevChartS2 = null;


setInterval(function() {
  const runID1 = $('#runID1').val();
  const runID2 = $('#runID2').val();

  fetch(`http://raspberrypi75.local/view.php?runID=${encodeURIComponent(runID1)}`, {
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
    let xValues = [];
    let yValues = [];

    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['leftwheel']));
    });

    let dataPointsL1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));

    yValues.clear();
    xValues.clear();
    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['rightwheel']));
    });

    let dataPointsR1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
    
    yValues.clear();
    xValues.clear();
    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['obstacle']));
    });
    let dataPointsS1 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));


    const dataL1 = {
      datasets: [{
        label: `RunID: ${runID1} Left Wheel`,
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
        label: `RunID: ${runID1} Right Wheel`,
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

    const dataS1 = {
      datasets: [{
        label: `RunID: ${runID1} Sensor`,
        data: dataPointsS1,
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
          position: 'bottom',
          ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, ticks) {
                  return new Date(value).toLocaleString();
              }
          }
        },
        y: {
          type: 'linear',
          position: 'left'
        }
      },
      animation: {
          duration: 0
      },
    };

    // Create the chart
    if (isChart1Set) {
      prevChartL1.data = dataL1;
      prevChartR1.data = dataR1;
      prevChartS1.data = dataS1;
      prevChartL1.update();
      prevChartR1.update();
      prevChartS1.update();
    }
    else{
      const ctx1 = document.getElementById('canvasL1').getContext('2d');
      const ctx2 = document.getElementById('canvasR1').getContext('2d');
      const ctx3 = document.getElementById('canvasS1').getContext('2d');
      prevChartL1 = new Chart(ctx1, {
        type: 'line',
        data: dataL1,
        options: options
      });

      prevChartR1 = new Chart(ctx2, {
        type: 'line',
        data: dataR1,
        options: options
      });

      prevChartR1 = new Chart(ctx3, {
        type: 'line',
        data: dataS1,
        options: options
      });

      isChart1Set = true;
    }
    
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

  // Make the GET request
  fetch(`http://raspberrypi75.local/view.php?runID=${encodeURIComponent(runID2)}`, {
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
    yValues.clear();
    xValues.clear();

    let dataPointsL2 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['rightwheel']));
    });

    yValues.clear();
    xValues.clear();

    let dataPointsR2 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));

    json.forEach(function(obj) {
      xValues.push(Date.parse(obj['timestamp']));
      yValues.push(parseFloat(obj['obstacle']));
    });
    let dataPointsS2 = xValues.map((x, i) => ({ x: x, y: yValues[i] }));
    yValues.clear();
    xValues.clear();

    const dataL2 = {
      datasets: [{
        label: `RunID: ${runID2} Left Wheel`,
        data: dataPointsL2,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        trendlineLinear: {
          colorMin: "#3e95cd",
          lineStyle: "line",
          width: 1,
          projection: true
        }
      }]
    };

    const dataR2 = {
      datasets: [{
        label: `RunID: ${runID2} Right Wheel`,
        data: dataPointsR2,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        trendlineLinear: {
          colorMin: "#3e95cd",
          lineStyle: "line",
          width: 1,
          projection: true
        }
      }]
    };

    const dataS2 = {
      datasets: [{
        label: `RunID: ${runID2} Sensor`,
        data: dataPointsS2,
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
          position: 'bottom',
          ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, ticks) {
                  return new Date(value).toLocaleString();
              }
          }
        },
        y: {
          type: 'linear',
          position: 'left'
        }
      },
      animation: {
          duration: 0
      },
    };

    // Create the chart
    if (isChart2Set) {
      prevChartL2.data = dataL2
      prevChartR2.data = dataR2
      prevChartS2.data =  dataS2
      prevChartL2.update();
      prevChartR2.update();
      prevChartS2.update();
    }
    else{
      const ctx1 = document.getElementById('canvasL2').getContext('2d');
      const ctx2 = document.getElementById('canvasR2').getContext('2d');
      const ctx3 = document.getElementById('canvasS2').getContext('2d');
      prevChartL2 = new Chart(ctx1, {
        type: 'line',
        data: dataL2,
        options: options
      });

      prevChartR2 = new Chart(ctx2, {
        type: 'line',
        data: dataR2,
        options: options
      });

      prevChartS2 = new Chart(ctx3, {
        type: 'line',
        data: dataS2,
        options: options
      });

      isChart2Set = true;
    }
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

}, 300);
  
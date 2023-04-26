import csv
import requests

# Open the CSV file
with open('data.csv') as csv_file:
    csv_reader = csv.DictReader(csv_file)

    # Iterate over each row in the CSV file
    for row in csv_reader:

        # Extract all of the values from the row
        date = row['date']
        id = row['id']
        windspeed = row['windspeed']
        winddirection = row['winddirection']
        airtemp = row['airtemp']
        humidity = row['humidity']
        rainfall = row['rainfall']
        shortwave = row['shortwave']
        longwave = row['longwave']
        pressure = row['pressure']
        surfacetemp = row['surfacetemp']
        subsurfacetemp = row['subsurfacetemp']
        salinity = row['salinity']
        waterpressure = row['waterpressure']
        current = row['current']

        # Make a request with all of the extracted values
        response = requests.get(f'http://localhost/input1.php?date={date}&id={id}&windspeed={windspeed}&winddirection={winddirection}&airtemp={airtemp}&humidity={humidity}&rainfall={rainfall}&shortwave={shortwave}&longwave={longwave}&pressure={pressure}&surfacetemp={surfacetemp}&subsurfacetemp={subsurfacetemp}&salinity={salinity}&waterpressure={waterpressure}&current={current}')
        # Do something with the response
        print(response.status_code)

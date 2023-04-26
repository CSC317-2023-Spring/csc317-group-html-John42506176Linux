import csv
from datetime import datetime
from faker import Faker

data = []

with open('weather_generated.dat', 'r') as file:
    for line in file:
        fields = line.strip().split('|')
        record = {
            'Station': fields[0],
            'GEO Location': fields[1],
            'Local Time': fields[2],
            'Conditions': fields[3],
            'Temperature': float(fields[4]),
            'Pressure': float(fields[5]),
            'Humidity': int(fields[6])
        }
        data.append(record)

fake = Faker()

# create a list to hold the processed data
processed_data = []

# iterate over the lines in the data file
for line in data:
    # extract the fields we're interested in
    date_str = line['Local Time']
    date = datetime.strptime(date_str, '%Y-%m-%d %H:%M:%S')
    stationid = line['Station']
    airtemp = line['Temperature']
    pressure = line['Pressure']
    humidity = line['Humidity']
    
    # generate fake data for the remaining fields
    windspeed = fake.pyfloat(min_value=0, max_value=20, right_digits=2)
    winddirection = fake.pyint(min_value=0, max_value=359)
    rainfall = fake.pyfloat(min_value=0, max_value=50, right_digits=2)
    shortwave = fake.pyfloat(min_value=0, max_value=2000, right_digits=2)
    longwave = fake.pyfloat(min_value=-100, max_value=1000, right_digits=2)
    surfacetemp = fake.pyfloat(min_value=-10, max_value=40, right_digits=2)
    subsurfacetemp = fake.pyfloat(min_value=-10, max_value=40, right_digits=2)
    salinity = fake.pyfloat(min_value=0, max_value=40, right_digits=2)
    waterpressure = fake.pyfloat(min_value=0, max_value=200, right_digits=2)
    current = fake.pyfloat(min_value=0, max_value=1, right_digits=2)
    
    # create a dictionary with the processed data
    row = {
        'date': date.strftime('%Y-%m-%d %H:%M:%S'),
        'id': fake.random_int(min=1, max=100),
        'windspeed': windspeed,
        'winddirection': winddirection,
        'airtemp': airtemp,
        'humidity': humidity,
        'rainfall': rainfall,
        'shortwave': shortwave,
        'longwave': longwave,
        'pressure': pressure,
        'surfacetemp': surfacetemp,
        'subsurfacetemp': subsurfacetemp,
        'salinity': salinity,
        'waterpressure': waterpressure,
        'current': current
    }
    
    # add the row to the processed data list
    processed_data.append(row)

# write the processed data to a csv file
with open('data.csv', 'w', newline='') as csvfile:
    fieldnames = ['date', 'id', 'windspeed', 'winddirection', 'airtemp', 'humidity', 'rainfall', 'shortwave', 'longwave', 'pressure', 'surfacetemp', 'subsurfacetemp', 'salinity', 'waterpressure', 'current']
    writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
    
    writer.writeheader()
    for row in processed_data:
        writer.writerow(row)

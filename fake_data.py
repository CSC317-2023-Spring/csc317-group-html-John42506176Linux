import csv
from faker import Faker

fake = Faker()

# Generate 1000 rows of data
rows = []
for i in range(1000):
    row = [
        fake.date(), # Date
        fake.random_int(min=1, max=100), # ID
        fake.random_int(min=0, max=20), #WINDSPEED
        fake.random_int(min=0, max=360), # WIND DIRECTION
        fake.random_int(min=-20, max=50), # Air temperature
        fake.random_int(min=0, max=100), # Humidity
        fake.random_int(min=0, max=20), # rainfall
        fake.random_int(min=0, max=100),
        fake.random_int(min=0, max=100),
        fake.random_int(min=900, max=1100),
        fake.random_int(min=-20, max=40),
        fake.random_int(min=-20, max=40),
        fake.random_int(min=30, max=40),
        fake.random_int(min=0, max=100),
        fake.random_int(min=-5, max=5),
    ]
    rows.append(row)

# Write data to CSV file
with open('data.csv', 'w', newline='') as f:
    writer = csv.writer(f)
    writer.writerow(['date', 'id', 'windspeed', 'winddirection', 'airtemp', 'humidity', 'rainfall', 'shortwave', 'longwave', 'pressure', 'surfacetemp', 'subsurfacetemp', 'salinity', 'waterpressure', 'current'])
    writer.writerows(rows)

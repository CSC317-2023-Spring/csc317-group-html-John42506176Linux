import signal
import requests
from datetime import datetime
import time
import random
import RPi.GPIO as GPIO
from sys import exit

running = 1
runID = 0

def genData(id):
    # current time to 1/100 of a second in '2023-05-06 12:34:56.12' format
        data = {
        'runID': id,
                'timestamp' : datetime.now().strftime('%Y-%m-%d %H:%M:%S.%f')[:-4],
                'leftwheel' : 6.0 + random.uniform(-0.2, 0.2),
                'rightwheel' : 6.0 + random.uniform(-0.2, 0.2),
                'sensor' : 5,
                'obstacle' : GPIO.input(17)
                }
        return data


def handler(signum, frame):
        running = 0
        print ("Cleaning up")
        GPIO.cleanup()
        try:
                # current time to 1/100 of a second in '2023-05-06 12:34:56.12' format
                current_datetime = datetime.now().strftime('%Y-%m-%d %H:%M:%S.%f')[:-4]
        
                data = {'timestamp': current_datetime, 'runID': runID}

                response = requests.post(urlend, data=data)
                response_code = response.status_code
                response_message = response.text
                print(f'{response_code} | Response: {response_message}')

        except requests.exceptions.RequestException as e:
                print(f'An error occurred: {e}')

        exit(0)

# Replace this URL with the target API endpoint you want to send POST requests to
urlstart = 'raspberrypi75.local/start.php'
urlrun = 'raspberrypi75.local/data.php'
urlend = 'raspberrypi75.local/end.php'

signal.signal(signal.SIGINT, handler)
GPIO.setmode(GPIO.BCM)
GPIO.setup(17, GPIO.IN)

try:
        current_datetime = datetime.now().strftime('%Y-%m-%d %H:%M:%S.%f')[:-4]
        data = {
                        'timestamp': current_datetime,
                        'CarName': 'PI Blue Lock',
                        'ID': str(runID),             
                        }
        response = requests.post(urlstart, data=data)
        response_code = response.status_code
        response_message = response.text
        runID = response_message
        print(f'{response_code} | Response: {response_message}')
        runID+=1
                
                        
except requests.exceptions.RequestException as e:
    print(f'An error occurred: {e}')


while running:
        try:
                # current time to 1/100 of a second in '2023-05-06 12:34:56.12' format
                current_datetime = datetime.now().strftime('%Y-%m-%d %H:%M:%S.%f')[:-4]
        
                data = genData(runID)

                response = requests.post(urlrun, data=data)
                response_code = response.status_code
                response_message = response.text
                print(f'{response_code} | Response: {response_message}')
                sleepTime = random.uniform(0.1, 0.4)
                time.sleep(sleepTime)

        except requests.exceptions.RequestException as e:
                print(f'An error occurred: {e}')
                break


print ("Cleaning up")
GPIO.cleanup()
try:
        # current time to 1/100 of a second in '2023-05-06 12:34:56.12' format
        current_datetime = datetime.now().strftime('%Y-%m-%d %H:%M:%S.%f')[:-4]
        
        data = {'timestamp': current_datetime, 'runID': runID}

        response = requests.post(urlend, data=data)
        response_code = response.status_code
        response_message = response.text
        print(f'{response_code} | Response: {response_message}')

except requests.exceptions.RequestException as e:
        print(f'An error occurred: {e}')





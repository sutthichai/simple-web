#second program
from sense_hat import SenseHat
import time
import csv
import datetime

sense = SenseHat()

def writeData(temp, pressure, humidity) :
    path = '/var/www/html/simple-web/data.csv'
    oldData = ''
    with open(path) as csvfile:
        readCSV = csv.reader(csvfile, delimiter=',')
        for row in readCSV:
            line = "{0},{1},{2},{3} \n".format(time.time(), row[0], row[1], row[2])
            oldData += line

    first_line = "{0:.1f},{1:.1f},{2:.1f},{3:.1f} \n".format(time.time(), temp, pressure, humidity)
    f = open(path, 'w')
    f.write(first_line)
    f.write(oldData)
    f.close()

count = 0
while count < 10:
    temp = sense.get_temperature()
    print("Teamperature: %f C" % temp)

    pressure = sense.get_pressure()
    print("Pressure: %f mbar" % pressure)

    humidity = sense.get_humidity()
    print("Hunidity: %f %%" % humidity)

    orientaion = sense.get_orientation()
    pitch = orientaion['pitch']
    roll = orientaion['roll']
    yaw = orientaion['yaw']
    print("pitch={0}, roll={1}, yaw={2}".format(pitch, roll, yaw))

    north = sense.get_compass()
    print("North %s" % north)

    #sense.show_message("T:{0:.1f}, P:{1:.1f}, H:{2:.1f}".format(temp, pressure, humidity))

    writeData(temp, pressure, humidity)
    count = count + 1
    time.sleep(30)





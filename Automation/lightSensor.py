import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BCM)
GPIO.setup(4,GPIO.IN)

print (GPIO.input(4))

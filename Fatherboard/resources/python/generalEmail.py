import smtplib
from email.message import EmailMessage
import random
import string
import sys
import os
#from dotenv import load_dotenv


#env_path = "/home/polyfilter/Uni-Code/FatherBoard/Fatherboard/.env"
#load_dotenv(env_path)



def sendEmail(address, subject, content):
    message =  EmailMessage()

    message.set_content(f"{content}")
    message['Subject'] = subject
    message['From'] = "fatherboard321@gmail.com"
    message['To'] = address


    smtp_server= smtplib.SMTP('smtp.gmail.com', 587)
    smtp_server.ehlo()
    smtp_server.starttls()

    smtp_server.login(email,password)

    smtp_server.send_message(message)
    smtp_server.quit()
    return content


if __name__=="__main__":
    #email = os.getenv("EMAIL_USER")

    email = "fatherboard321@gmail.com"

    #password = os.getenv("EMAIL_PASS")
 
    password = "lfuj hhbm vura eewj"
    if (len(sys.argv) >=3):
        print(sendEmail(sys.argv[1], sys.argv[2], sys.argv[3]), end="")



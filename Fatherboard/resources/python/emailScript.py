import smtplib
from email.message import EmailMessage
import random
import string
import sys
import os
#from dotenv import load_dotenv


#env_path = "/home/polyfilter/Uni-Code/FatherBoard/Fatherboard/.env"
#load_dotenv(env_path)

def passGen(size=6, chars=string.ascii_uppercase + string.digits):
    return ''.join(random.choice(chars) for _ in range(size))

base_url = "https://cs2team24.cs2410-web01pvm.aston.ac.uk/"
def sendEmail(address):
    message =  EmailMessage()
    content = passGen()
    message.set_content(f"Reset code is: {content} \n Go to {base_url}reset/{content}")
    message['Subject'] = "Reset Password Request"
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
    print(sendEmail(sys.argv[1]), end="")

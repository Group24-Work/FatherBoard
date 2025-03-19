import smtplib
from email.message import EmailMessage
import random
import string

def passGen(size=6, chars=string.ascii_uppercase + string.digits):
    return ''.join(random.choice(chars) for _ in range(size))

def sendEmail(address):
    message =  EmailMessage()
    content = passGen()
    message.set_content(f"Your new password is: {content}")
    message['Subject'] = "Reset Password Request"
    message['From'] = "fatherboard321@gmail.com"
    message['To'] = address
    smtp_server= smtplib.SMTP('smtp.gmail.com', 587)
    smtp_server.ehlo()
    smtp_server.starttls()

    smtp_server.login("fatherboard321@gmail.com","lfuj hhbm vura eewj")

    smtp_server.send_message(message)
    smtp_server.quit()
    print("success!")
    return content

sendEmail()

import smtplib
from email.message import EmailMessage


message =  EmailMessage()

message.set_content("Your new password is:")
message['Subject'] = "Reset Password Request"
message['From'] = "fatherboard321@gmail.com"
message['To'] = "mohammedridwan@protonmail.com"



smtp_server= smtplib.SMTP('smtp.gmail.com', 587)
smtp_server.ehlo()
smtp_server.starttls()

smtp_server.login("fatherboard321@gmail.com","lfuj hhbm vura eewj")

smtp_server.send_message(message)
smtp_server.quit()

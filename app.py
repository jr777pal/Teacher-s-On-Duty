from flask import Flask, request, render_template_string, redirect, url_for
import pymysql
from werkzeug.security import generate_password_hash

app = Flask(__name__)

@app.route('/register', methods=['POST'])
def register():
    # Get form data
    username = request.form.get('username')
    email = request.form.get('email')
    password = generate_password_hash(request.form.get('password'))
    first_name = request.form.get('first_name')
    middle_name = request.form.get('middle_name')
    last_name = request.form.get('last_name')
    pan_no = request.form.get('pan_no')
    aadhar_no = request.form.get('aadhar_no')
    phone_no = request.form.get('phone_no')
    whatsapp_no = request.form.get('whatsapp_no')
    qualifications = request.form.get('qualifications')
    description = request.form.get('description')
    age = request.form.get('age')
    terms_accepted = 1 if request.form.get('terms') else 0

    # Connect to MySQL
    conn = pymysql.connect(host='localhost', user='chiku', password='chiku@2004', db='teachers_on_duty')
    cursor = conn.cursor()
    try:
        sql = """
        INSERT INTO teachers (username, email, password, first_name, middle_name, last_name, pan_no, aadhar_no, phone_no, whatsapp_no, qualifications, description, age, terms_accepted)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """
        cursor.execute(sql, (username, email, password, first_name, middle_name, last_name, pan_no, aadhar_no, phone_no, whatsapp_no, qualifications, description, age, terms_accepted))
        conn.commit()
        return "Registration successful! <a href='teacher.html'>Try Again</a>"
    except Exception as e:
        return f"Error: {e}"
    finally:
        cursor.close()
        conn.close()

if __name__ == '__main__':
    app.run(debug=True)

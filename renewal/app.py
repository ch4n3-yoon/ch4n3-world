#!/usr/bin/python
# coding: utf-8

from flask import Flask, render_template, session

app = Flask(__name__)
app.secret_key = "ch4n3isthesecretkey"

@app.route('/')
def index():
    session['username'] = "ch4n3"
    session['nickname'] = "admin123"
    print session
    return render_template("index.html", id=session['username'])

if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True)
